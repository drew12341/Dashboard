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

        if($year == ''){
            $year = date("Y");
        }
        if($period == ''){
            $period = month_to_period(date('n'));
        }

        //echo $year.' '.$period.' '.date('n');
        $userid = 0;
        $utswide = false;

        if(isset($_SESSION['emulate'])){
            $userid = $_SESSION['emulate'];
            //Userid '0' is UTS Wide
            if($userid == 0){
                $utswide = true;
            }
            //echo "<b>EMULATING".$userid."</b>";
        }


        $data['year'] = $year;
        $data['period'] = $period;
        $data['period_txt'] = $types[$period];
        $data['utswide'] = $utswide;

        $data['periods'] = $types;
        $data['sections'] = $this->Indicator_model->getFullMeasures($userid, $year.'-'.$period, $utswide);
        $data['chartData'] = $this->Indicator_model->getMeasuresChartData($userid, $year.'-'.$period, $utswide);
        if(!$utswide){
            $data['date_committed'] = $this->Indicator_model->getCommittedDate($userid, $year . '-' . $period);

            $measuremeta = $this->Indicator_model->get_measure_meta($userid, $year.'-'.$period);
            $data['comments'] = $measuremeta['comments'];
        }
        $this->load->view('dashboard/index_view', $data);
    }
}