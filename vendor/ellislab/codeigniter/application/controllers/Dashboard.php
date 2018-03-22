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

    function index($year = '', $period = '')
    {
        $data = array();
        $wh = explode(",", $this->config->item('dash_periods'));
        $types = array();
        $count = 1;
        foreach ($wh as $w) {
            $types[$count++] = $w;
        }


        //echo $year.' '.$period.' '.date('n');
        $userid = 0;
        $utswide = false;
        $completed_proportion = '';

        if (isset($_SESSION['emulate'])) {
            $userid = $_SESSION['emulate'];
            //Userid '0' is UTS Wide
            if ($userid == 0) {
                $utswide = true;


            }
            //echo "<b>EMULATING".$userid."</b>";

        }


        if ($year == '' && $period == '') {
            $recent = $this->Indicator_model->mostRecentMeasures($userid);
            if($recent){
                //split
                $splits = explode('-', $recent);
                $year = $splits[0];
                $period = $splits[1];
            }
            else{
                $year = date("Y");
                $period = month_to_period(date('n'));
            }
        }


        if($utswide){
            $p = $year.'-'.$period;
            $numerator = $this->Indicator_model->completedforPeriod($p);
            $denominator = $this->Indicator_model->totalUsers();
            $completed_proportion = $numerator.' of '.$denominator;

        }

        $data['year'] = $year;
        $data['period'] = $period;
        $data['period_txt'] = $types[$period];
        $data['utswide'] = $utswide;
        $data['completed_proportion'] = $completed_proportion;

        $data['periods'] = $types;
        $data['sections'] = $this->Indicator_model->getFullMeasures($userid, $year . '-' . $period, $utswide);
        $data['chartData'] = $this->Indicator_model->getMeasuresChartData($userid, $year . '-' . $period, $utswide);
        if (!$utswide) {
            $data['date_committed'] = $this->Indicator_model->getCommittedDate($userid, $year . '-' . $period);

            $measuremeta = $this->Indicator_model->get_measure_meta($userid, $year . '-' . $period);
            $data['comments'] = $measuremeta['comments'];
        }
        $this->load->view('dashboard/index_view', $data);
    }
}