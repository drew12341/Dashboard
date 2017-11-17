<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends Auth_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->output->set_template('default');
        $this->load->model('Indicator_model');
    }

    function index($year = ''){
        $data = array();
        if($year == '') {
            $data['year'] = date("Y");;
        }
        else{
            $data['year'] = $year;
        }
        $data['sections'] = $this->Indicator_model->getYearlyMeasures($this->ion_auth->user()->row()->id, $data['year']);
        $this->load->view('report/index_view', $data);
    }
}