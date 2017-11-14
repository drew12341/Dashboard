<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends Auth_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Indicator_model');
        ini_set('display_errors', 'On');
        error_reporting(E_ALL);
    }

    function reloadDashboard($userid, $period)
    {
        $d = explode('-', $period);

        $period = $d[1];
        $year = $d[0];


        $data = array();

        $data['currentmeasures']    = $this->Indicator_model->getFullMeasures($userid, $year.'-'.$period);
        echo json_encode($data);
    }

    function getMeasuresChartData(){
        $ret = $this->Indicator_model->getMeasuresChartData(4, '2017-2');
        echo json_encode($ret);
    }
}