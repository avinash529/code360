<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model
{
    

    public function insert_class($data)
    {
        return $this->db->insert('tblproductclass', $data);
    }

    
    public function get_subclasses_by_class($class_id)
    {
        return $this->db->where('class_id', $class_id)
                        ->get('tblproductsubclass')
                        ->result();
    }


    public function insert_product($data)
    {
        return $this->db->insert('tblproducts', $data);
    }

    public function update_class($id, $data) {
        return $this->db->where('id', $id)->update('tblproductclass', $data);
    }
    
    public function check_class_exists($name, $exclude_id = null) {
        $this->db->where('class_name', $name);
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        return $this->db->get('tblproductclass')->num_rows() > 0;
    }

    public function get_class_by_id($id)
    {
        return $this->db->get_where('tblproductclass', ['id' => $id])->row();
    }
    

    public function delete_class($id){
        return $this->db->delete('tblproductclass', ['id' => $id]);
    }

    public function insert_subclass($data) {
        return $this->db->insert('tblproductsubclass', $data);
    }
    
    public function get_all_subclasses() {
        $this->db->select('subclass.id, subclass.subclass_name, subclass.class_id, class.class_name');
        $this->db->from('tblproductsubclass as subclass');
        $this->db->join('tblproductclass as class', 'class.id = subclass.class_id', 'left');
        $query = $this->db->get();
        return $query->result();

    }
    
    public function get_all_classes() {
        return $this->db->get('tblproductclass')->result();
    }
    
    public function delete_subclass($id) {
        return $this->db->delete('tblproductsubclass', ['id' => $id]);
    }
    
    public function update_subclass($id, $data) {
        return $this->db->where('id', $id)->update('tblproductsubclass', $data);
    }

    public function get_all_products()
    {
        return $this->db->select('p.*, c.class_name, s.subclass_name')
                        ->from('tblproducts p')
                        ->join('tblproductclass c', 'c.id = p.class_id', 'left')
                        ->join('tblproductsubclass s', 's.id = p.subclass_id', 'left')
                        ->get()
                        ->result();
    }

    public function delete_product($id) {
        return $this->db->delete('tblproducts', ['id' => $id]);
    }
    
    public function update_product($data) {
        return $this->db->where('id', $data['id'])->update('tblproducts', [
            'class_id' => $data['class_id'],
            'subclass_id' => $data['subclass_id'],
            'product_name' => $data['product_name'],
            'amount' => $data['amount'],
        ]);
    }
    
    public function get_product_by_id($id) {
        return $this->db->get_where('tblproducts', ['id' => $id])->row();
    }
 

}
