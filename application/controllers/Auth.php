<?php

class Auth extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user')['logged_in'] == 1) {
            redirect('login');
        }
    }
}