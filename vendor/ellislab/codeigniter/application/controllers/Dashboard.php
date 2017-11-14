<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->output->set_template('default');
        $this->load->model('Indicator_model');
    }

    function index(){
        $data = array();
        $wh = explode(",", $this->config->item('dash_periods'));
        $types = array();
        $count = 1;
        foreach($wh as $w){
            $types[$count++] = $w;
        }

        $userid = 4;
        $year = 2017;
        $period = 2;

        $data['periods'] = $types;
        $data['sections'] = $this->Indicator_model->getFullMeasures($userid, $year.'-'.$period);
        $data['chartData'] = $this->Indicator_model->getMeasuresChartData($userid, $year.'-'.$period);
        $this->load->view('dashboard/index_view', $data);
    }
}