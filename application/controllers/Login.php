<?php

if (!defined('BASEPATH')) 
    exit('No direct script access allowed');

class Login extends CI_Controller {

    private $data;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('User_model');
        $this->load->library('form_validation');
        
        $this->data = array(
            'title' => set_value('title'),
            'action' => site_url('login/login_user')
        );
    }

    function index() 
    {        
        $this->load->view('templates/header_login', $this->data);
        $this->load->view('login/login', $this->data);
        //$this->load->view('templates/footer', $data);
    }

    function login_user()
    {
        $this->cart->destroy();

        $this->form_validation->set_rules('email', 'e-mail adres', 'trim|required|min_length[6]|max_length[50]|valid_email');
        $this->form_validation->set_rules('password', 'wachtwoord', 'trim|required|min_length[6]|max_length[50]');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $result = $this->Login_model->login_user();

            switch($result) {
                case 'logged_in':
                    redirect('bestel');
                    break;
                case 'admin_logged_in':
                    redirect('user/information');
                case 'incorrect_password':
                    $this->data['failed'] = 'Password is incorrect.';
                    $this->load->view('templates/header_login');
                    $this->load->view('login/login', $this->data);
                    break;
                case 'not_activated':
                    $this->data['failed'] = 'Account not activated.';
                    $this->load->view('templates/header_login');
                    $this->load->view('login/login', $this->data);
                    break;
                case 'email_not_found':
                    $this->data['failed'] = 'E-mail address not found.';
                    $this->load->view('templates/header_login');
                    $this->load->view('login/login', $this->data);
                    break;
            }
        }      
    }

    function logout_user() 
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            $this->cart->destroy();
            $this->session->sess_destroy();
            redirect('login');
        }
    }

    // activated when clicked on "Wachtwoord vergeten"
    function forgot_password_link()
    {
        $data = array (
            'action' => site_url('login/reset_password')
        );
        $this->load->view('templates/header_login');
        $this->load->view('login/reset_pw_index', $data);
    }

    // called when the email has been submitted to reset the password
    function reset_password()
    {
        $this->form_validation->set_rules('veri_email', 'e-mail adres', 'trim|required|min_length[6]|max_length[50]|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->forgot_password_link();
        }  else {
            $result = $this->User_model->send_resetpassword_email();
            if ($result) {
                $data = array (
                    'action' => site_url('login/reset_password'),
                    'success' => 'An e-mail has been sent to reset your password.'
                );
                $this->load->view('templates/header_login');
                $this->load->view('login/reset_pw_index', $data);
            } else {
                $this->forgot_password_link();
            }
        }
    }

    // called from the email link to reset the password
    function reset_password_action($email)
    {
        $data = array (
            'action' => site_url('login/do_reset_password'),
            'email' => $email
        );
        $this->load->view('templates/header_login');
        $this->load->view('login/reset_pw', $data);
    }

    function do_reset_password()
    {
        $this->form_validation->set_rules('password', 'wachtwoord', 'trim|required|min_length[6]|max_length[50]|matches[confirmpassword]');
        $this->form_validation->set_rules('confirmpassword', 'bevestig wachtwoord', 'trim|required|min_length[6]|max_length[50]');
        $email = $this->input->post('email');
        if ($this->form_validation->run() == FALSE) {
            $this->reset_password_action($email);
        } else {
            $pw_reset = $this->User_model->new_password();
            if ($pw_reset) {
                $this->data['success'] = 'Wachtwoord is gereset.';
                $this->load->view('templates/header_login', $this->data);
                $this->load->view('login/login', $this->data);
            } else {
                $data = array (
                    'action' => site_url('login/do_reset_password'),
                    'email' => $email,
                    'failed' => 'Nieuw wachtwoord kan niet dezelfde zijn als het oude wachtwoord.'
                );
                $this->load->view('templates/header_login');
                $this->load->view('login/reset_pw', $data);
            }
        }
    }
}