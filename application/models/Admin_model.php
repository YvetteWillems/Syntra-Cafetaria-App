<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function send_bulk_mail()
    {               
        $today = date("Y/m/d");
        $this->db->select('*, orders.id, orders.ordDateDelivery');
        $this->db->from('orders');
        $this->db->where('orders.ordDateDelivery', $today);
        $this->db->join('users', 'users.id = orders.user_id');
        $result = $this->db->get()->result();

        // store only the users email in a new array, then keep only the unique values
        $users = array();
        foreach ($result as $res) {
            $users[] = $res->usrEmail; 
        }
        $unique_emails = array_unique($users);

        foreach ($unique_emails as $email) {
            $this->send_ready_email($email);
        }
    }

    private function send_ready_email($email)
    {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'mauritsseelen@gmail.com',
            'smtp_pass' => 'upbtdwqttfpgngql',
            'mailtype'  => 'html',
            'newline'   => "\r\n"
        );
        $this->load->library('email', $config);

        $this->email->from($this->config->item('bot_email'), 'Syntra Catering');
        $this->email->to($email);
        $this->email->subject('Bestelling broodje(s)');
        $message = '<!DOCTYPE html><html><body>';
        $message .= '<p>' . 'Uw broodje(s) zijn klaar om opgehaald te worden! Eet smakelijk.'.'</body></html>';
        $this->email->message($message);
        if ($this->email->send()) {
            return true;
        } else {
            show_error($this->email->print_debugger());
        }
    }

    function get_todays_orders()
    {          
        $today = date("Y/m/d");
        $this->db->select('*, orders.id, orders.ordDateDelivery');
        $this->db->from('orders');
        $this->db->where('orders.ordDateDelivery', $today);
        $this->db->join('users', 'users.id = orders.user_id');
        $this->db->join('statussen', 'statussen.id = orders.status_id');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function get_statussen()
    {
        $this->db->select('*');
        $this->db->from('statussen');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function update_order()
    {
        $statusid = $this->input->post('statusId');
        $orderid = $this->input->post('orderId');

        echo $statusid . '<br>';
        // echo $orderid;
        $sql = "UPDATE orders SET status_id = '" . $statusid . "' WHERE id = '" . $orderid . "' LIMIT 1";
        $this->db->query($sql);
            if ($this->db->affected_rows() === 1) {
                return true;
            } else {
                return false;
            }
    }
}