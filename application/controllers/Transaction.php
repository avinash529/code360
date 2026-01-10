<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('Transaction_model');
    }

    public function index() {
        $this->load->view('transactions');
    }

    public function add_class()
    {
        $data['classes'] = $this->db->get('tblproductclass')->result();
        $this->load->view('dash/header');
        $this->load->view('dash/add_class', $data);
        
    }

    public function save_class(){

        $this->form_validation->set_rules('class_name', 'Class Name', 'required|trim|callback_check_class_exists');

        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Class name already exists. Please choose a different name.');    
            redirect('transaction/add_class');
        } else {
           
            $data = [
                'class_name' => $this->input->post('class_name')
            ];

            
            $inserted = $this->Transaction_model->insert_class($data);

            if ($inserted) {
                
                $this->session->set_flashdata('success', 'Class added successfully!');
                redirect('transaction/add_class');  
            } else {
                
                $this->session->set_flashdata('error', 'Failed to add class. Please try again.');
                redirect('transaction/add_class');
            }
        }
    }

    public function update_class() {
        $class_id = $this->input->post('class_id');
        $class_name = trim($this->input->post('class_name'));
    
        $this->form_validation->set_rules('class_name', 'Class Name', 'required|trim');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('transaction/add_class');
        }
    
        $exists = $this->Transaction_model->check_class_exists($class_name, $class_id);
        if ($exists) {
            $this->session->set_flashdata('error', 'This class name already exists.');
            redirect('transaction/add_class');
        }
    
        $data = ['class_name' => $class_name];
        $this->Transaction_model->update_class($class_id, $data);
    
        $this->session->set_flashdata('success', 'Class updated successfully!');
        redirect('transaction/add_class');
    }
    

    
    public function check_class_exists($class_name) {

            $this->load->model('Transaction_model');
            $result = $this->Transaction_model->check_class_exists($class_name);

            if ($result) {
                $this->form_validation->set_message('check_class_exists', 'This class name already exists.');
                return FALSE;
            }

            return TRUE;

        }

    public function delete_class($id){

        $class = $this->Transaction_model->get_class_by_id($id);

        if (!$class) {
            $this->session->set_flashdata('error', 'Class not found.');
            redirect('transaction/add_class');
        }

        $deleted = $this->Transaction_model->delete_class($id);

        if ($deleted) {
            $this->session->set_flashdata('success', 'Class deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete class.');
        }

        redirect('transaction/add_class');
    }


    public function add_subclass() {
        $data['classes'] = $this->Transaction_model->get_all_classes();
        $data['subclasses'] = $this->Transaction_model->get_all_subclasses();
        $this->load->view('dash/header');
        $this->load->view('dash/add_subclass', $data);
    }
    
    public function save_subclass() {
        $data = [
            'subclass_name' => $this->input->post('subclass_name'),
            'class_id' => $this->input->post('class_id'),
        ];
    
        if ($this->Transaction_model->insert_subclass($data)) {
            $this->session->set_flashdata('success', 'Subclass added successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to add subclass.');
        }
        redirect('transaction/add_subclass');
    }

    public function update_subclass() {
        $id = $this->input->post('subclass_id');
        $data = [
            'class_id' => $this->input->post('class_id'),
            'subclass_name' => $this->input->post('subclass_name')
        ];
    
        $updated = $this->Transaction_model->update_subclass($id, $data);
    
        if ($updated) {
            $this->session->set_flashdata('success', 'Subclass updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update subclass.');
        }
        redirect('transaction/add_subclass');
    }
    
    public function delete_subclass($id) {
        $this->Transaction_model->delete_subclass($id);
        $this->session->set_flashdata('success', 'Subclass deleted successfully.');
        redirect('transaction/add_subclass');
    }

    public function add_product(){

        $this->load->model('Transaction_model');

        $data['classes'] = $this->Transaction_model->get_all_classes();
        $data['subclasses'] = $this->Transaction_model->get_all_subclasses();

        $data['products'] = $this->Transaction_model->get_all_products();

        $this->load->view('dash/header');
        $this->load->view('dash/add_product', $data);
    }

    public function save_product(){
        $this->form_validation->set_rules('product_name', 'Product Name', 'required|trim');
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
        $this->form_validation->set_rules('class_id', 'Class', 'required|numeric');
        $this->form_validation->set_rules('subclass_id', 'Subclass', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('transaction/add_product');
        } else {
            $data = [
                'product_name' => $this->input->post('product_name'),
                'amount' => $this->input->post('amount'),
                'class_id' => $this->input->post('class_id'),
                'subclass_id' => $this->input->post('subclass_id')
            ];

            $inserted = $this->Transaction_model->insert_product($data);

            if ($inserted) {
                $this->session->set_flashdata('success', 'Product added successfully!');
                redirect('transaction/add_product');
            } else {
                $this->session->set_flashdata('error', 'Failed to add product. Please try again.');
                redirect('transaction/add_product');
            }
        }
    }


    public function get_product_by_id($id) {
        $product = $this->Transaction_model->get_product_by_id($id);
        $classes = $this->Transaction_model->get_all_classes();
        $subclasses = $this->Transaction_model->get_all_subclasses();
    
        echo json_encode([
            'id' => $product->id,
            'product_name' => $product->product_name,
            'amount' => $product->amount,
            'class_id' => $product->class_id,
            'subclass_id' => $product->subclass_id,
            'classes' => $classes,
            'subclasses' => $subclasses,
        ]);
    }
    
    public function update_product() {
        $data = $this->input->post();
        $this->Transaction_model->update_product($data);
        echo "success";
    }
    
    public function delete_product_ajax($id) {
        $this->Transaction_model->delete_product($id);
        echo "deleted";
    }
    
    
}