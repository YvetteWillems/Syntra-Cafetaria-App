<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Orders_sandwiches extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Orders_sandwiches_model');
        // load extra models:
        $this->load->model('Breads_model');
        $this->load->model('Orders_model');
        $this->load->model('Statussen_model');
        $this->load->model('Toppings_model');
        $this->load->model('Orders_sandwiches_extra_model');
        $this->load->model('Extras_model');
        $this->load->model('Users_model');

        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'orders_sandwiches/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'orders_sandwiches/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'orders_sandwiches/index.html';
            $config['first_url'] = base_url() . 'orders_sandwiches/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Orders_sandwiches_model->total_rows($q);
        $orders_sandwiches = $this->Orders_sandwiches_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'orders_sandwiches_data' => $orders_sandwiches,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('orders_sandwiches/orders_sandwiches_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Orders_sandwiches_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'order_id' => $row->order_id,
		'orsAmount' => $row->orsAmount,
		'bread_id' => $row->bread_id,
		'topping_id' => $row->topping_id,
	    );
            $this->load->view('orders_sandwiches/orders_sandwiches_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('orders_sandwiches'));
        }
    }

    public function adminOrdersSandwiches()                              // HELEMAAL NIEUW
//    public function adminOrdersSandwiches($dateDelivery = date('Y-m-d H:i:s', time())) // deze regel krijg ik niet aan het werken (vullen met vandaag als initiele waarde)
    {
        if (empty($this->input->post('datedelivery'))) {
            $yearNow = date("Y", time());
            $monthNow = date("m", time());
            $dayNow = date("d", time());
            /* if ($monthNow < 10){
                $monthNow = "0".$monthNow;
            } */
            if ($dayNow < 10){
                $dayNow = "0".$dayNow;
            }
            $dateDelivery = $yearNow."-".$monthNow."-".$dayNow;
        } else {
            list($yearDelivery,$monthDelivery,$dayDelivery) = explode ('-',$this->input->post('datedelivery'));
            $dateDelivery = $yearDelivery."-".$monthDelivery."-".$dayDelivery;
//            echo "Doorgegeven leveringsdatum uit controll".$dateDelivery;
        }

        $this->db->select('*, orders_sandwiches.id AS juisteId, extras.id AS xtrId');
        $this->db->from('orders_sandwiches');
        $this->db->join('orders', 'orders_sandwiches.order_id = orders.id');
        $this->db->join('users', 'users.id = orders.user_id');
        $this->db->join('breads', 'orders_sandwiches.bread_id = breads.id');
        $this->db->join('statussen', 'orders.status_id = statussen.id');
        $this->db->join('toppings', 'orders_sandwiches.topping_id = toppings.id');
        $this->db->join('orders_sandwiches_extra', 'orders_sandwiches_extra.orders_sandwich_id = orders_sandwiches.id', "LEFT");
        $this->db->join('extras', 'orders_sandwiches_extra.extra_id = extras.id', "LEFT");
        $this->db->where('ordDateDelivery', $dateDelivery);
        $searchName = "";
        if (!empty($this->input->post('zoeknaam'))) {
            $searchName = $this->input->post('zoeknaam');
            $this->db->like('usrLastName', $searchName);
        }
        $searchMail = "";
        if (!empty($this->input->post('zoekmail'))) {
            $searchMail = $this->input->post('zoekmail');
            $this->db->like('usrEmail', $searchMail);
        }
        $this->db->order_by('orders.id', 'ASC');
        $this->db->order_by('juisteId', 'ASC');

        $query = $this->db->get()->result();

        // Extra meegeven: geselecteerde $dateDelivery en event. ingevulde zoeknaam
        $data = array(
            'adminbestellingen_data' => $query,
            'dateDelivery' => $dateDelivery,
            'searchName' => $searchName,
            'searchMail' => $searchMail
        );

        $this->load->view('templates/header_admin', $data);
        //$this->load->view('orders_sandwiches/admin_orders', $data);
        $this->load->view('admin/admin_orders', $data);
        $this->load->view('templates/footer_yvette', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('orders_sandwiches/create_action'),
	    'id' => set_value('id'),
	    'order_id' => set_value('order_id'),
	    'orsAmount' => set_value('orsAmount'),
	    'bread_id' => set_value('bread_id'),
	    'topping_id' => set_value('topping_id'),
	);
        $this->load->view('orders_sandwiches/orders_sandwiches_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'order_id' => $this->input->post('order_id',TRUE),
		'orsAmount' => $this->input->post('orsAmount',TRUE),
		'bread_id' => $this->input->post('bread_id',TRUE),
		'topping_id' => $this->input->post('topping_id',TRUE),
	    );

            $this->Orders_sandwiches_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('orders_sandwiches'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Orders_sandwiches_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('orders_sandwiches/update_action'),
		'id' => set_value('id', $row->id),
		'order_id' => set_value('order_id', $row->order_id),
		'orsAmount' => set_value('orsAmount', $row->orsAmount),
		'bread_id' => set_value('bread_id', $row->bread_id),
		'topping_id' => set_value('topping_id', $row->topping_id),
	    );
            $this->load->view('orders_sandwiches/orders_sandwiches_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('orders_sandwiches'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'order_id' => $this->input->post('order_id',TRUE),
		'orsAmount' => $this->input->post('orsAmount',TRUE),
		'bread_id' => $this->input->post('bread_id',TRUE),
		'topping_id' => $this->input->post('topping_id',TRUE),
	    );

            $this->Orders_sandwiches_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('orders_sandwiches'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Orders_sandwiches_model->get_by_id($id);

        if ($row) {
            $this->Orders_sandwiches_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('orders_sandwiches'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('orders_sandwiches'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('order_id', 'order id', 'trim|required');
	$this->form_validation->set_rules('orsAmount', 'orsamount', 'trim|required');
	$this->form_validation->set_rules('bread_id', 'bread id', 'trim|required');
	$this->form_validation->set_rules('topping_id', 'topping id', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Orders_sandwiches.php */
/* Location: ./application/controllers/Orders_sandwiches.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-02-12 22:24:38 */
/* http://harviacode.com */