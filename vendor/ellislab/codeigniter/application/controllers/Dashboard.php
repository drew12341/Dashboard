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

    function index($year = '', $period = ''){
        $data = array();
        $wh = explode(",", $this->config->item('dash_periods'));
        $types = array();
        $count = 1;
        foreach($wh as $w){
            $types[$count++] = $w;
        }

//        $userid = 4;
//        $year = 2017;
//        $period = 2;

        if($year == ''){
            $year = date("Y");
        }
        if($period == ''){
            //Could represent this as a function
            // Using switch for the time being
            switch(intval(date('n'))){
                case 2:
                case 3:
                    $period = 1;
                    break;
                case 4:
                case 5:
                    $period = 2;
                    break;
                case 6:
                case 7:
                    $period = 3;
                    break;
                case 8:
                case 9:
                    $period = 4;
                    break;
                case 10:
                case 11:
                    $period = 5;
                    break;
                case 12:
                case 1:
                    $period = 6;
                    break;

            }
        }

        //echo $year.' '.$period.' '.date('n');

        $userid = $this->ion_auth->user()->row()->id;

        $data['year'] = $year;
        $data['period'] = $period;

        $data['periods'] = $types;
        $data['sections'] = $this->Indicator_model->getFullMeasures($userid, $year.'-'.$period);
        $data['chartData'] = $this->Indicator_model->getMeasuresChartData($userid, $year.'-'.$period);
        $this->load->view('dashboard/index_view', $data);
    }
}