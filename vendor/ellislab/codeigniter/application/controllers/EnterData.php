<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EnterData extends Auth_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->output->set_template('default');
        $this->load->model('Indicator_model');
    }

    function index(){
        $this->load->library('form_validation');

        $wh = explode(",", $this->config->item('dash_periods'));
        $types = array();
        $count = 1;
        foreach($wh as $w){
            $types[$count++] = $w;
        }
        $data['periods'] = $types;
        $year = date("Y");

        $period = month_to_period(date('n'));

        $data['year'] = $year;
        $data['period'] = $period;

        $data['measures'] = $this->Indicator_model->getAllMeasures($this->ion_auth->user()->row()->id);

        $this->form_validation->set_rules('year', 'Year','trim|required');
        $this->form_validation->set_rules('period', 'Period','trim|required');

        if($this->form_validation->run()===FALSE)
        {
            $this->load->helper('form');
            $this->load->view('enterdata/index_view', $data);
        }
        else {
            $record = $this->input->post();
            redirect(site_url('EnterData/data/').$record['year'].'/'.$record['period']);
        }
    }

    function data($year, $period){
        $this->load->library('form_validation');

        $wh = explode(",", $this->config->item('dash_periods'));
        $types = array();
        $count = 1;
        foreach($wh as $w){
            $types[$count++] = $w;
        }
        $data['periods'] = $types;
        $data['sections'] = $this->Indicator_model->getForUser($this->ion_auth->user()->row()->id);

        $data['id'] = $this->ion_auth->user()->row()->id;
        $data['year'] = $year;
        $data['period'] = $period;
        $data['period_txt'] = $types[$period];

        //calculate previous value (year then base 6)
        if($period > 1){
            $previousyear = $year;
            $previousperiod = $period - 1;
        }
        else{
            $previousyear = $year - 1;
            $previousperiod = 6;
        }

        $data['current_values'] = $this->Indicator_model->getMeasures($this->ion_auth->user()->row()->id, $year.'-'.$period);
        $data['previous_values'] = $this->Indicator_model->getMeasures($this->ion_auth->user()->row()->id, $previousyear.'-'.$previousperiod);
        $data['status'] = $this->Indicator_model->getMeasuresStatus($this->ion_auth->user()->row()->id, $year.'-'.$period);


        $validations = array();
        //$this->form_validation->set_rules('year', 'Year','trim|required');
        $this->form_validation->set_rules('year', 'Year','trim|required');
        $this->form_validation->set_rules('period', 'Period','trim|required');

//        foreach ($data['sections'] as $key => $value){
//            foreach($value as $row){
//                $validations[] = array('field' => 'data['.$row['id'].']',
//                                    'label' => $row['description'],
//                                    'rules' => 'required');
//            }
//        }

        $this->form_validation->set_rules($validations);

        if($this->form_validation->run()===FALSE)
        {
            $this->load->helper('form');
            $this->load->view('enterdata/data_view', $data);
        }
        else {
            //Shave recordsh
            $record = $this->input->post();

            foreach($record['data'] as $key=>$value){
                $measure['userid'] = $this->ion_auth->user()->row()->id;
                $measure['indicatorid'] = $key;
                $measure['value'] = $value;
                $measure['period'] = $year.'-'.$period;
                $measure['committed'] = $record['committed'];
                $this->Indicator_model->upsertmeasure($measure);
            }
            $data['current_values'] = $this->Indicator_model->getMeasures($this->ion_auth->user()->row()->id, $year.'-'.$period);
            $data['status'] = $this->Indicator_model->getMeasuresStatus($this->ion_auth->user()->row()->id, $year.'-'.$period);

            $this->load->view('enterdata/data_view', $data);
        }
    }
}