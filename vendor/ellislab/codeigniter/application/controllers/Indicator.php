<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indicator extends Auth_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->output->set_template('default');
        $this->load->model('Indicator_model');
    }

    function index(){
        $id = $this->ion_auth->user()->row()->id;
        $data['dataSet'] = $this->Indicator_model->getIndicators($id);
        $this->load->view('indicator/index_view', $data);
    }


    function newIndicator(){
        $this->load->library('form_builder');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('description', 'Description','trim|required');
        $this->form_validation->set_rules('type', 'Type','trim|required|is_unique[users.username]');

        $this->form_validation->set_rules('value','Value','trim|required');

        $wh = explode(",", $this->config->item('indicator_types'));
        $types = array(''=>'None');
        foreach($wh as $w){
            $types[$w] = $w;
        }
        $data['types'] = $types;


        if($this->form_validation->run()===FALSE)
        {
            unset($_SESSION['message']);
            $this->load->view('indicator/new_view', $data);
        }
        else {
            $record = $this->input->post();
            unset($record['submit']);
            $record['userid'] = $this->ion_auth->user()->row()->id;
            $id = $this->Indicator_model->addIndicator($record);

            if($id){
                $_SESSION['message'] = 'Indicator added';
                $this->load->view('indicator/new_view', $data);
            }
            else{
                $_SESSION['message'] = 'Could not create record';
                $this->load->view('indicator/new_view', $data);
            }
        }
    }

    function editIndicator($id){
        $this->load->library('form_builder');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('description', 'Description','trim|required');
        $this->form_validation->set_rules('type', 'Type','trim|required');

        $this->form_validation->set_rules('value','Value','trim|required');

        $data['dataSet'] = $this->Indicator_model->getIndicator($id);

        $wh = explode(",", $this->config->item('indicator_types'));


        $types = array(''=>'None');
        foreach($wh as $w){
            $types[$w] = $w;
        }
        $data['types'] = $types;

        if($this->form_validation->run()===FALSE)
        {
            unset($_SESSION['message']);
            $this->load->view('indicator/edit_view', $data);
        }
        else {
            $record = $this->input->post();
            unset($record['submit']);
            $record['userid'] = $this->ion_auth->user()->row()->id;
            $this->Indicator_model->updateIndicator($record);

            $_SESSION['message'] = 'Indicator updated';
            $this->load->view('indicator/edit_view', $data);

        }
    }
}