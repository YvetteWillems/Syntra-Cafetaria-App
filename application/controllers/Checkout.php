<?php
require_once(APPPATH . 'controllers/Auth.php');

    class Checkout extends Auth {
        public function __construct()
        {
                parent::__construct();
                $this->load->model('checkout_model');
                $this->load->helper('url_helper');                
        }
        
        public function index(){
            $this->load->view('templates/header_user');
            $this->load->view('user/checkout');
            $this->load->view('templates/footer_yvette');
        }

        public function mollie(){
            $ordDateDelivery = $this->input->post('ordDateDelivery');
            // Get Delivery Date timestamp, Current Date timestamp, weekday:
            $deliveryDate = strtotime($ordDateDelivery); 
            $currentDate = strtotime(date('Y-m-d')); 
            $day = date("w", $deliveryDate); 

            // Check if $ordDateDelivery is not in past:
            if($this->cart->format_number($this->cart->total()) > 0){

                if($deliveryDate < $currentDate){
                    $this->session->set_flashdata('message', 'Kies een geldige datum.');
                    redirect('checkout/index'); 
                // Check if order time is/is after 11:
                } elseif($deliveryDate === $currentDate && date('H') >= 11){
                    $this->session->set_flashdata('message', 'Het is 11 uur geweest...<br>Helaas! Voor vandaag kun je geen broodjes meer bestellen.');
                    redirect('checkout/index'); 
                } else {
                    // Check if $ordDateDelivery is a weekday:
                    if($day >= 1 && $day <= 5){
                        $result = $this->checkout_model->setOrders(); 

                        // Check if order is inserted: 
                        if($result){
                            $order_id_last = $this->db->insert_id();            
                            $this->checkout_model->setOrdersSandwiches($order_id_last); 

                            // Check if sandwiches are inserted: 
                            if($result){
                                    // Empty Shopping Cart:
                                    $this->cart->destroy(); 

                                    $data['orderId'] = $order_id_last;

                                    $this->load->view('templates/header_user');
                                    $this->load->view('user/success', $data);
                                    $this->load->view('templates/footer_yvette');
                            } else {
                                $this->session->set_flashdata('message', 'Er is iets fout gegaan, uw bestelling is niet geplaatst.<br>Probeer alstublieft overnieuw.');
                                redirect('checkout/index'); 
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Er is iets fout gegaan, uw bestelling is niet geplaatst.<br>Probeer alstublieft overnieuw.');
                            redirect('checkout/index'); 
                        }
                    } else {
                        $this->session->set_flashdata('message', 'In het weekend zijn wij niet geopend!<br>Kies alstublieft een andere datum.');
                        redirect('checkout/index'); 
                    }
                }
            } else {
                $this->session->set_flashdata('message', 'Je hebt geen broodjes in je broodmanje...<br>Om door te gaan naar betalen, kies een broodje.');
                redirect('checkout/index'); 
            }
        }

        public function paymentcorrect(){
            $this->load->view('templates/header_user');
            $this->load->view('user/paymentcorrect');
            $this->load->view('templates/footer_yvette');
        }




    }


