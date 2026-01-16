<?php
class User_model extends CI_Model {

    public function check_login($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('tbluserregistration');
        return $query->row();
    }

    public function get_all_users() {
        return $this->db->get('tbluserregistration')->result();
    }
    
    public function delete_user($id) {
        return $this->db->delete('tbluserregistration', ['id' => $id]);
    }

    public function get_user_by_username($username) {
        return $this->db->get_where('tbluserregistration', ['username' => $username])->row();
    }
}
