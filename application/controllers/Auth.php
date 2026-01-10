<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(['session']);
        $this->load->helper(['form', 'url']);
        $this->load->model('User_model'); 
    }
    
    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        $this->load->view('auth/login');
    }

   
    public function login_action() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
    
        $user = $this->User_model->get_user_by_username($username);
    
        if ($user && password_verify($password, $user->password)) {
            $this->session->set_userdata([
                'username' => $user->username,
                'user_id'  => $user->id,
                'logged_in' => true
            ]);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password');
            redirect('auth');
        }
    }
    
    
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }

    public function register() {
        $this->load->view('auth/register');
    }
    
    public function register_action() {
        $this->load->library('upload');
    
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048;
    
        $this->upload->initialize($config);
    
        $image = '';
        if (!empty($_FILES['image']['name'])) {
            if ($this->upload->do_upload('image')) {
                $upload_data = $this->upload->data();
                $image = $upload_data['file_name'];
            } else {
                $error = $this->upload->display_errors();
                echo '<pre>Upload Error: ' . print_r($error, true) . '</pre>';
                exit;
            }
        }
    
        $encrypted_password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
    
        $data = [
            'name'     => $this->input->post('name'),
            'username' => $this->input->post('username'),
            'email'    => $this->input->post('email'),
            'password' => $encrypted_password, // Hashed password
            'phone'    => $this->input->post('phone'),
            'image'    => $image
        ];
    
        $inserted = $this->db->insert('tbluserregistration', $data);
        if ($inserted) {
            $this->session->set_flashdata('success', 'Registration successful. Please login.');
            redirect('auth');
        } else {
            $this->session->set_flashdata('error', 'Registration failed. Please try again.');
            redirect('auth/register');
        }
    }
    
    
    
    
}