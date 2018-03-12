<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller
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
        $ret = $this->Indicator_model->getMeasuresChartData(4, '2017-4');
        echo json_encode($ret);
    }

    function setSession($id, $desc){
        $_SESSION['emulate'] = $id;
        $_SESSION['emulated_name'] = $desc;
        echo json_encode(array('success'=>true));
    }

    function testSections(){
        echo json_encode( $this->Indicator_model->getFullMeasures(12, '2017'.'-'.'6', 0));
    }
}