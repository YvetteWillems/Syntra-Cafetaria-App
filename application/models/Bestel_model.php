<?php
    class Bestel_model extends CI_Model {
        public function __construct() {
            $this->load->database();
        }

        public function getBreads($id = ''){
            $this->db->select('*');
            $this->db->from('breads');
            $this->db->where('brdActive', '1');
            if($id){
                $this->db->where('id', $id);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $query = $this->db->get();
                $result = $query->result_array();
            }
            
            return !empty($result)?$result:false;
        }

        public function getToppings($id = ''){
            $this->db->select('*');
            $this->db->from('toppings');
            $this->db->where('topActive', '1');
            if($id){
                $this->db->where('id', $id);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $query = $this->db->get();
                $result = $query->result_array();
            }
            
            return !empty($result)?$result:false;
        }

        public function getExtras($id = ''){
            $this->db->select('*');
            $this->db->from('extras');
            $this->db->where('xtrActive', '1');
            if($id){
                $this->db->where('id', $id);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $query = $this->db->get();
                $result = $query->result_array();
            }
            
            return !empty($result)?$result:false;
        }

        // Favourite Sandwich:
        function getFavouriteBread($user_id){
            $sql = "SELECT bread_id FROM users WHERE id=$user_id"; 
            $query = $this->db->query($sql); 
            $row = $query->row(); 
            return $row->bread_id; 
        }

        function getFavouriteTopping($user_id){
            $sql = "SELECT topping_id FROM users WHERE id=$user_id"; 
            $query = $this->db->query($sql); 
            $row = $query->row(); 
            return $row->topping_id; 
        }

        public function deleteFavouriteSandwich($user_id){
            $sql = "UPDATE users SET bread_id = '', topping_id = '' WHERE id=$user_id"; 
            $result = $this->db->query($sql);
            return $result;
        }

        function updateFavouriteSandwich($user_id, $bread_id, $topping_id){
            $sql = "UPDATE users SET bread_id=$bread_id, topping_id=$topping_id WHERE id=$user_id"; 
            $result = $this->db->query($sql); 
            return $result;
        }
    }