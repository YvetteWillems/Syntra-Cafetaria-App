<?php
require_once(APPPATH . 'controllers/Auth.php');

class User extends Auth {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    // function user_details()
    // {
    //     $data['user_details'] = $this->User_model->get_user_details();
    //     $data['action'] = site_url('user/update_user');
    //     $this->load->view('templates/header_user');
    //     $this->load->view('usermenu/profile', $data);
    // }

    function update_user()
    {
        $this->form_validation->set_rules('firstname', 'voornaam', 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('lastname', 'achternaam', 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('email', 'e-mail adres', 'trim|required|min_length[5]|max_length[50]|valid_email');
        $this->form_validation->set_rules('phone', 'telefoon nr', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->information();
        } else {
            $result = $this->User_model->update_user();

            if ($result) {
                // terug naar login pagina -> met gegens geupdated, log opnieuw in
                $data['success'] = 'Geupdate.';
                $data['user_details'] = $this->User_model->get_user_details();
                $data['action'] = site_url('user/update_user');
                $this->load->view('templates/header_user');
                $this->load->view('usermenu/profile', $data);
            } else {
                $this->session->set_flashdata('message', $result);
                redirect('user/information');
            }
        }
    }

    public function information(){
        $data['user_details'] = $this->User_model->get_user_details();
        $data['action'] = site_url('user/update_user');

        $this->load->view('templates/header_user');
        $this->load->view('usermenu/profile', $data);
        $this->load->view('templates/footer_yvette');
    }

    function history(){
        $user_id = $this->session->userdata('user')['user_id'];

        $this->db->select('*, orders_sandwiches.id AS ors_id, statussen.staDescription AS status_name, orders.id AS ord_id');
        $this->db->from('orders');
        $this->db->join('orders_sandwiches', 'orders.id = orders_sandwiches.order_id'); 
        $this->db->join('statussen', 'orders.status_id = statussen.id');
        $this->db->where('orders.user_id', $user_id);
        $this->db->order_by('orders.ordDateDelivery', 'DESC');
        $this->db->group_by('orders.id', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();

        $data['orders'] = $result;

        $this->load->view('templates/header_user');
        $this->load->view('usermenu/bestellingen', $data);
        $this->load->view('templates/footer_yvette');
    }

    function contact(){
        $this->load->view('templates/header_user');
        $this->load->view('usermenu/contact');
        $this->load->view('templates/footer_yvette');
    }
}