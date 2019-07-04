<?php
    class Menus extends CI_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->model('menus_model');
            $this->load->helper('url_helper');
        }

        public function favorites() {
            $data['title'] = "Favorieten"; 

            $this->load->view('templates/header_user', $data);
            $this->load->view('user/favorites', $data);
            $this->load->view('templates/footer_yvette', $data);
        }

        public function personal() {
            $data['title'] = "Mijn profiel"; 

            $this->load->view('templates/header_user', $data);
            $this->load->view('user/personal', $data);
            $this->load->view('templates/footer_yvette', $data);
        }

}