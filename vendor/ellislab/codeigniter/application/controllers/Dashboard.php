<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->output->set_template('default');

    }

    function index(){

        $this->load->view('dashboard/index_view');
    }
}