<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends Auth_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->output->set_template('default');

    }

    function index(){

        $this->load->view('report/index_view');
    }
}