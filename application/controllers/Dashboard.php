<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('User_model');
    }

    public function index() {
        $this->load->view('dash/header');
        $this->load->view('dash/dashboard');
        //$this->load->view('dash/footer');
    }
    

    public function fetch_users(){
        $users = $this->User_model->get_all_users();
        $data = [];

        foreach ($users as $user) {
            $data[] = [
                'image' => $user->image ? '<img src="' . base_url('uploads/' . $user->image) . '" width="50">' : '',
                'name' => $user->name,
                'email' => $user->email,
                'username' => $user->username,
                'phone' => $user->phone,
                'actions' => '
                    <a href="javascript:void(0);" class="text-primary editUserBtn" data-toggle="modal"
                        data-target="#editUserModal" data-id="' . $user->id . '" title="Edit"><i class="fas fa-edit"></i></a>
                    &nbsp;
                    <a href="' . site_url('dashboard/delete/' . $user->id) . '" class="text-danger"
                        title="Delete" onclick="return confirm(\'Are you sure?\')"><i class="fas fa-trash-alt"></i></a>
                '
            ];
        }
        echo json_encode(['data' => $data]);
    }


    public function get_user_data($id) {
        $user = $this->db->get_where('tbluserregistration', ['id' => $id])->row();
        echo json_encode($user);
    }

    public function update_user(){

        $id = $this->input->post('id');

        $data = [
            'name'     => $this->input->post('name'),
            'email'    => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'phone'    => $this->input->post('phone'),
        ];

        if (!empty($_FILES['image']['name'])) {
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = 2048;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $upload_data = $this->upload->data();
                $data['image'] = $upload_data['file_name'];
            }
        }

        $this->db->where('id', $id);
        $this->db->update('tbluserregistration', $data);

        $response = array_merge(['success' => true, 'id' => $id], $data);
        echo json_encode($response);
    }

    public function delete($id) {
        $this->User_model->delete_user($id);
        $this->session->set_flashdata('success', 'User deleted.');
        redirect('dashboard');
    }
}