<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller  {

    function __construct()
    {
        parent::__construct();
        $this->output->set_template('default');
    }

    public function index()
    {
        if($this->ion_auth->is_admin()===FALSE)
        {
            redirect('/');
        }

        $data = array('dataSet'=>$this->ion_auth->getUsers());

        $this->load->view('user/index_view', $data);
    }

    public function profile(){

        $data = array();

        $this->load->view('user/profile_view', $data);
    }

    public function changepassword($userid){
        if($userid != $this->ion_auth->user()->row()->id && $this->ion_auth->is_admin()===FALSE)
        {
            redirect('/');
        }

        $this->load->library('form_builder');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('password','Password','trim|min_length[8]|max_length[20]|required');
        $this->form_validation->set_rules('confirm_password','Confirm password','trim|matches[password]|required');
        if($this->form_validation->run()===FALSE)
        {
            unset($_SESSION['edit_message']);
            $groups = $this->ion_auth->listGroups();
            $data = array('dataSet'=>$this->ion_auth->getUser($userid),
                'groups'=>$groups);
            $this->load->view('user/edit_view', $data);
        }
        else
        {
            unset($_SESSION['edit_message']);
            $id = $this->input->post('id');

            $dataSet['password'] = $this->input->post('password');

            $this->load->library('ion_auth');
            if($this->ion_auth->update($id,$dataSet))
            {
                $_SESSION['edit_message'] = 'Password has been updated.';
            }
            else
            {
                $_SESSION['edit_message'] = $this->ion_auth->errors();
            }

            $groups = $this->ion_auth->listGroups();

            $dataSet['user_id'] = $id;
            $data = array('dataSet'=>$this->ion_auth->getUser($id),
                'groups'=>$groups);
            $this->load->view('user/edit_view', $data);
        }
    }

    public function edit($userid)
    {
        if($userid != $this->ion_auth->user()->row()->id && $this->ion_auth->is_admin()===FALSE)
        {
            redirect('/');
        }

        $this->load->library('form_builder');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('orgunit_name', 'orgunit_name','trim|required');
        $this->form_validation->set_rules('username','Username', 'trim|required');
        $this->form_validation->set_rules('email','Email', 'trim');

        if($this->form_validation->run()===FALSE)
        {
            unset($_SESSION['edit_message']);
            $this->load->helper('form');
            $data = array('dataSet'=>$this->ion_auth->getUser($userid),
                'groups'=>$this->ion_auth->listGroups());
            $this->load->view('user/edit_view', $data);
        }
        else
        {
            unset($_SESSION['edit_message']);
            $id = $this->input->post('id');

            $dataSet['orgunit_name'] = $this->input->post('orgunit_name');
            $dataSet['username'] = $this->input->post('username');
            $dataSet['email'] = $this->input->post('email');


            $config = array();
            $config['upload_path'] = APPPATH.'../tmp/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = 'user_profile_'.$id;
            $config['overwrite'] = true;
            $this->load->library('upload', $config);

            if (isset($_FILES['userfile']['name']) && !empty($_FILES['userfile']['name'])) {
                if (!$this->upload->do_upload()) {
                    $_SESSION['edit_message'] = $this->upload->display_errors();
                    $groups = $this->ion_auth->listGroups();
                    $data = array('dataSet'=>$this->ion_auth->getUser($id),
                        'groups'=>$groups);
                    $this->load->view('user/edit_view', $data);


                }
                $dataSet['profilepic'] = $this->upload->data('file_name');
            }



            $this->load->library('ion_auth');
            if($this->ion_auth->update($id,$dataSet))
            {
                $_SESSION['edit_message'] = 'User has been updated.';
            }
            else
            {
                $_SESSION['edit_message'] = $this->ion_auth->errors();
            }
            //fix up groups
            $groups = $this->ion_auth->listGroups();


            $data = array('dataSet'=>$this->ion_auth->getUser($id),
                'groups'=>$groups);
            $this->load->view('user/edit_view', $data);
            //redirect(site_url('user/edit/').$id);
        }


    }

    public function delete_user($userid){
            $this->ion_auth->delete_user($userid);
            $_SESSION['ar_message'] = 'User has been deleted';
            $this->session->mark_as_flash('ar_message');
            redirect('User');

    }


    function email_check($str)
    {
        $parts = explode('@',$str);

        if(isset($parts[1]) && $parts[1] == 'uts.edu.au') return true;

        //if (stristr($str,'@uts.edu.au') !== false) return true;


        $this->form_validation->set_message('email_check', 'Email must have a @uts.edu.au suffix');
        return FALSE;
    }

    public function register()
    {

        $this->load->library('form_builder');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('orgunit_name', 'OrgUnit Name','trim|required');
        $this->form_validation->set_rules('username', 'username','trim|required|is_unique[users.username]');

        $this->form_validation->set_rules('password','Password','trim|min_length[8]|max_length[20]|required');
        $this->form_validation->set_rules('confirm_password','Confirm password','trim|matches[password]|required');
        //$this->form_validation->set_rules('email', 'Email', 'callback_email_check');

        if($this->form_validation->run()===FALSE)
        {
            $this->load->helper('form');
            $this->load->view('user/register_view');
        }
        else
        {
            $username = $this->input->post('username');
            $orgunit_name = $this->input->post('orgunit_name');

            $email = strtolower($this->input->post('email'));
            $password = $this->input->post('password');

            $additional_data = array(
                'orgunit_name' => $orgunit_name,
                'active'=>true,

            );

            $this->load->library('ion_auth');
            $group = array('2');
            $userid = $this->ion_auth->register($username,$password,$email,$additional_data, $group);
            if($userid)
            {


                $_SESSION['register_message'] = 'The user: '.$username .' has been created.';
                $this->session->mark_as_flash('register_message');

                //redirect('user/edit/'.$userid);
                $this->load->view('user/register_view');
                //Auto login after register
//                if ($this->ion_auth->login($email, $password, True))
//                {
//                    redirect('sds');
//                }
//                else{
//                    redirect('user/login');
//                }
            }
            else
            {
                $_SESSION['register_message'] = $this->ion_auth->errors();
                $this->session->mark_as_flash('register_message');
                redirect('user/register');

            }
        }
    }



    public function login()
    {
        $this->load->library('form_builder');
        $this->data['title'] = "Login";

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $data = array();
        $data['users'] = $this->ion_auth->get_all();
        array_unshift($data['users'],'Select Org Unit');
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->helper('form');
            $this->load->view('user/login_view', $data);
            //$this->render('user/login_view');
        }
        else
        {
            $remember = (bool) $this->input->post('remember');
            if ($this->ion_auth->login(strtolower($this->input->post('username')), $this->input->post('password'), $remember))
            {
                $_SESSION['emulate'] = $this->ion_auth->user()->row()->id;
                redirect('dashboard');
            }
            else
            {
                $_SESSION['auth_message'] = $this->ion_auth->errors();
                $this->session->mark_as_flash('auth_message');
                redirect('user/login');
            }
        }
    }

    public function logout()
    {
        $this->ion_auth->logout();
        redirect('user/login');
    }
}