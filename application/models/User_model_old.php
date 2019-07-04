<?php

if (!defined('BASEPATH')) 
    exit('No direct script access allowed');

class User_model extends CI_Model {    

    private $email_code;

    function insert_user()
    {
        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $phonenumber = $this->input->post('phonenumber');
        $email = $this->input->post('email');
        $password = sha1($this->config->item('salt') . $this->input->post('password'));
        $organisation = $this->input->post('organisation');
        $occupation = $this->input->post('occupation');

        $sql = "INSERT INTO users (usrLastName, usrFirstName, usrPhone, usrEmail, usrPassword, occupation_id)
                VALUES(" . $this->db->escape($firstname) . ",
                        " . $this->db->escape($lastname) . ",
                        " . $this->db->escape($phonenumber) . ",
                        '" . $email . "',
                        '" . $password . "',
                        '" . $occupation . "')";
        
        $result = $this->db->query($sql);
        
        if ($this->db->affected_rows() === 1) {
            $this->set_session($firstname, $lastname, $email);
            // $this->send_validation_email();
            return $firstname;
        } else {
            $this->load->library('email');
        }
    }

    private function send_validation_email()
    {
        $this->load->library('email');
        $email = $this->session->userdata('email');
        $email_code = $this->email_code;

        $this->email->set_mailtype('html');
        $this->email->from($this->config->item('bot_email'), 'Syntra Catering');
        $this->email->to('mauritsseelen@gmail.com');
        $this->email->subject('TEST');
        $message = '<!DOCTYPE html><html><body>';
        $message .= 'This is a test.';
        $message .= '<p>Thanks for registrering. Please <strong><a href="' . base_url() . 'register/validate_email' . $email .
                '/' . $email_code . '">click here</a></strong> to activate your account. After you have activated your account you will be able to login.';
        $message .= '</body></html>';
        $this->email->message($message);
        $this->email->send();
    }

    private function activate_account($email_address)
    {
        $sql = "UPDATE users SET usrEmailConfirmed = 1 WHERE usrEmail = '" . $email_address . "' LIMIT 1";
        $this->db->query($sql);
        if ($this->db->affected_rows() === 1) {
            return true;
        } else {
            echo 'Error when activating your account in the database.';
            return false;
        }
    }

    private function validate_email($email_address, $email_code)
    {
        $sql = "SELECT usrEmail, usrTimestampRegistration, usrFirstName FROM users WHERE usrEmail = '{$email_address}' LIMIT 1";
        $result = $this->db->query($sql);
        $row = $result->row();

        if ($result->num_rows() == 1 && $row->usrFirstName) {
            if (md5((string) $row->usrTimestampRegistration) === $email_code) {
                $result = $this->activate_account($email_address);
                if ($result == true) {
                    return true;
                } else {
                    echo 'There was an error when activating your account';
                    return false;
                }
            }
        } else {
            echo 'There was an error validating your email';
            return false;
        }
    }

    private function set_session($firstname, $lastname, $email)
    {
        $sql = "SELECT id, usrTimestampRegistration FROM users WHERE usrEmail = '" . $email . "' LIMIT 1";
        $result = $this->db->query($sql);
        $row = $result->row();

        $sess_data = array (
            'user_id' => $row->id,
            'firstname' => $firstname,
            'lastname' => $lastname, 
            'email' => $email,
            'logged_in' => 0
        );
        $this->email_code = md5((string)$row->usrTimestampRegistration);
        $this->session->set_userdata($sess_data);
    }
}