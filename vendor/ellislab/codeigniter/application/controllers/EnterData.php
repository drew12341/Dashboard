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

        $wh = explode(",", $this->config->item('dash_periods'));
        $types = array();
        foreach($wh as $w){
            $types[$w] = $w;
        }
        $data['periods'] = $types;
        $data['sections'] = $this->Indicator_model->getForUser($this->ion_auth->user()->row()->id);
        $this->load->view('enterdata/index_view', $data);
    }
}