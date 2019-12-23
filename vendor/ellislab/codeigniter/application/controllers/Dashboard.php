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

    function getDashData($year = '', $period = ''){
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
            //24 dec 2019 - default to the current month, regardless of when the
            //last measures were entered
            $recent = false;
            //$recent = $this->Indicator_model->mostRecentMeasures($userid);

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

        if ($userid == 0) {
            $utswide = true;


        }
        if($utswide){
            //echo "UTS";
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
			$data['data_entered_by'] = $measuremeta['data_entered_by'];
        }
        else {
            $remove_these = Array('Safety and Wellbeing Essentials', 'Preventing Bullying in the Workplace', 'H&S for Supervisors', 'Consent Matters', 'Consent Matters (casual staff)');

            //remove these sections for UTSwide user
            foreach ($data['sections'] as $key => &$section) {
                if ($key == '3_informed_and_engaged') {
                    foreach ($section as $k => &$row) {
                        if (in_array($row['description'], $remove_these)) {
                            unset($section[$k]);
                        }
                    }
                }
            }
            // also remove for chart data
            foreach ($data['chartData'] as $key => &$section) {
                if ($key == '3_informed_and_engaged') {
                    foreach ($section as $k => &$row) {
                        foreach ($row as $j => $v) {
                            if (in_array($j, $remove_these)) {
                                unset($row[$j]);

                            }
                        }

                    }
                }
            }
        }
        return $data;
    }

    function index($year = '', $period = '')
    {
        $data = $this->getDashData($year, $period);
        $this->load->view('dashboard/index_view', $data);
    }

    function meetingPackReport(){
        ini_set('max_execution_time', 300);


        $year = date("Y");
        $period = month_to_period(date('n'));

        $collection = array();
        $em = $this->ion_auth->get_all_id();

        foreach($em as $key=>$value) {
            $_SESSION['emulate'] = $key;
            $data = $this->getDashData($year, $period);
            $data['emulated_name'] = $value;

            $collection[] = $data;
        }


        $total = array();
        $total['collection'] = $collection;

        //$this->output->set_template('modal');
        $this->output->unset_template();
        $this->load->view('dashboard/meeting_pack_report' , $total);
    }
    function meetingPackPDF()
    {
        ini_set('max_execution_time', 300);
        ini_set('memory_limit', '256M');

        $year = date("Y");
        $period = month_to_period(date('n'));

        $collection = array();
        $em = $this->ion_auth->get_all_id();


        foreach ($em as $key => $value) {
            $_SESSION['emulate'] = $key;
            $data = $this->getDashData($year, $period);
            $data['emulated_name'] = $value;

            $collection[] = $data;

            //exit early whilst developing
            //break;
        }


        $total = array();
        $total['collection'] = $collection;

        //$this->output->set_template('modal');
        $this->output->unset_template();
        $this->load->view('dashboard/meeting_pack_report', $total);
        unset($_SESSION['emulate']);
        return;


        //$this->load->helper(array('wkhtmltopdf', 'file'));
        $html = $this->load->view('dashboard/meeting_pack_report', $total, true);


        // Set parameters
        $apikey = 'c6029753-0d5a-43d5-9988-80755b267cee';
        $value = $html; // can aso be a url, starting with http..

        $postdata = http_build_query(
            array(
                'apikey' => $apikey,
                'value' => $value,
                'MarginBottom' => '10',
                'MarginTop' => '10',
                'UseLandscape'=>'true',

            )
        );

        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );

        $context = stream_context_create($opts);

// Convert the HTML string to a PDF using those parameters
        $result = file_get_contents('http://api.html2pdfrocket.com/pdf', false, $context);

// Save to root folder in website
        //$file_name = APPPATH.'../tmp/mypdf-1.pdf';
        //file_put_contents($file_name, $result);

        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename=' . 'Meeting-Pack-Report.pdf');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . strlen($result));

        echo $result;
    }
}