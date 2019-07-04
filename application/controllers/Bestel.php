<?php
require_once(APPPATH . 'controllers/Auth.php');

    class Bestel extends Auth {
        public function __construct()
        {
                parent::__construct();
                $this->load->model('bestel_model');
                $this->load->helper('url_helper');                
        }

        public function index($page = 'home') {
            if ( ! file_exists(APPPATH.'views/user/'.$page.'.php')) {
                    show_404();
            }
            $data['firstname'] = $this->session->userdata('user')['firstname'];
            $data['lastname'] = $this->session->userdata('user')['lastname'];

            $data['breads'] = $this->bestel_model->getBreads(); 
            $data['toppings'] = $this->bestel_model->getToppings(); 
            $data['extras'] = $this->bestel_model->getExtras();

            $this->form_validation->set_rules('bread', 'Bread Type', 'required'); 
            $this->form_validation->set_rules('topping', 'Topping', 'required'); 
            $this->form_validation->set_rules('amount', 'Amount', 'required|is_natural_no_zero'); 

			// Check if form is submitted AND passed validation:
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header_user', $data);
                $this->load->view('user/'.$page, $data);
                $this->load->view('templates/footer_yvette', $data);
			} else {
                // Fetch specific product by ID
                $bread = $this->bestel_model->getBreads($this->input->post('bread'));
                $topping = $this->bestel_model->getToppings($this->input->post('topping'));
                $extra_total_price = 0;

                $extras = $this->bestel_model->getExtras();
                $aantal_extras = count($extras);

                // For each extra:
                for($i = 1; $i <= $aantal_extras; $i++){
                    $extra_id = $this->input->post('extra'.$i);
                    // If checked:
                    if($extra_id != NULL){ 
                        $extra_array = $this->bestel_model->getExtras($extra_id); 
                        $extra_names[] = $extra_array['xtrName']; 
                        $extra_total_price += $extra_array['xtrPrice']; 
                    }
                }
            
                // Add product to the cart
                $price = $bread['brdPrice'] + $topping['topPrice'] + $extra_total_price;
                $name = $bread['brdName']. " ". $topping['topName']; 
                $note[] = $this->input->post('note'); 

                $data = array(
                    'id'    => uniqid(),
                    'bread_id' => $this->input->post('bread'),
                    'topping_id' => $this->input->post('topping'),
                    'qty'    => $this->input->post('amount'),
                    'price'    => $price,
                    'name'    => trim($name),
                    'options' => array('opmerking' => $note, 'extra' => $extra_names)
                );

                $this->cart->insert($data);

                // If total items in cart > 10, delete last inserted item:
                if($this->cart->total_items() > 10){
                    // Get rowid of last inserted item:
                    $last_item = array_slice($this->cart->contents(TRUE), 0, 1);        
                    foreach($last_item as $last_rowid=>$value){
                        // Delete item:
                        $remove = $this->cart->remove($last_rowid);
                    }  
                    // Send message:
                    $this->session->set_flashdata('message', "Je kunt maximaal 10 broodjes bestellen. Pas je bestelling aan.");
                }
 
				redirect('bestel/cart');
			}
        }

        function updateItemQty(){
            $update = 0;
            
            // Get cart item info
            $rowid = $this->input->get('rowid');
            $qty = $this->input->get('qty');
            
            // Update item in the cart
            if(!empty($rowid) && !empty($qty)){
                $data = array(
                    'rowid' => $rowid,
                    'qty'   => $qty
                );
                $update = $this->cart->update($data);
            }
            
            // Return response
            echo $update?'ok':'err';
        }

        function removeItem($rowid){
            // Remove item from cart
            $remove = $this->cart->remove($rowid);
            redirect('bestel/cart');
        }    

        public function cart(){
            // Get users favourite bread and topping:
            $user_id = $this->session->userdata('user')['user_id'];

            $data['favourite_bread'] = $this->bestel_model->getFavouriteBread($user_id);
            $data['favourite_topping'] = $this->bestel_model->getFavouriteTopping($user_id); 

            $this->load->view('templates/header_user');
            $this->load->view('user/cart', $data);
            $this->load->view('templates/footer_yvette');
        }

        function deleteFavourite(){
            $user_id = intval($this->session->userdata('user')['user_id']);

            $delete = $this->bestel_model->deleteFavouriteSandwich($user_id); 
            echo $delete?'ok':'err';
        }

        function updateFavourite(){
            $user_id = intval($this->session->userdata('user')['user_id']);
            $bread_id = intval($this->input->get('bread_id'));
            $topping_id = intval($this->input->get('topping_id'));

            $update = $this->bestel_model->updateFavouriteSandwich($user_id, $bread_id, $topping_id); 
            echo $update?'ok':'err';
        }

        public function favourite(){
            // Get users favourite bread and topping:
            $user_id = $this->session->userdata('user')['user_id'];

            $favourite_bread_id = $this->bestel_model->getFavouriteBread($user_id);
            $favourite_topping_id = $this->bestel_model->getFavouriteTopping($user_id); 

            $data['favourite_bread'] = NULL; 
            $data['favourite_topping'] = NULL;

            if($favourite_bread_id != 0){
                $favourite_bread = $this->bestel_model->getBreads($favourite_bread_id);
                $data['favourite_bread_id'] = $favourite_bread_id;
                $data['favourite_bread'] = $favourite_bread['brdName'];
            }
            if($favourite_topping_id != 0){
                $favourite_topping = $this->bestel_model->getToppings($favourite_topping_id); 
                $data['favourite_topping_id'] = $favourite_topping_id;            
                $data['favourite_topping'] = $favourite_topping['topName']; 
            }

            $data['extras'] = $this->bestel_model->getExtras();

            $this->load->view('templates/header_user');
            $this->load->view('user/favourite', $data);
            $this->load->view('templates/footer_yvette');
        }
    }



    
