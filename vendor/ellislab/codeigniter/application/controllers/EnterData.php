<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EnterData extends Auth_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->output->set_template('default');

    }

    function index(){

        $this->load->view('enterdata/index_view');
    }
}