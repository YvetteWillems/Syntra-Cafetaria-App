<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller { 

    function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    function send_bulk_mail()
    {
        $this->Admin_model->send_bulk_mail();
        redirect('user');
    }

    function get_todays_orders()
    {
        $orders = $this->Admin_model->get_todays_orders();
        $statussen = $this->Admin_model->get_statussen();
        $data = array(
            'statussen' => $statussen,
            'orders' => $orders,
            'action' => site_url('admin/update_order')
        );

        $this->load->view('templates/header_admin');
        $this->load->view('admin/admin_order_update', $data);
        $this->load->view('templates/footer_yvette');
    }

    function update_order() 
    {
        $result = $this->Admin_model->update_order();
        if ($result) {
            redirect('admin/get_todays_orders');
        } else {
            echo 'Something went wrong';
        }
    }
}