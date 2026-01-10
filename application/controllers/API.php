<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller {

    public function products() {
        $this->load->model('Product_model');
        $products = $this->Product_model->get_all();
        echo json_encode($products);
    }
}

