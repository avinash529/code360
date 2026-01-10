<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaction_model'); // you already have it
        $this->output->set_content_type('application/json; charset=utf-8');
    }

    private function json_input()
    {
        $raw = $this->input->raw_input_stream;
        $data = json_decode($raw, true);
        if (json_last_error() === JSON_ERROR_NONE) return $data;
        // fallback for form-encoded
        parse_str($raw, $arr); return $arr ?: [];
    }

    public function index() // GET /api/products
    {
        $products = $this->Transaction_model->get_all_products(); // join with class/subclass
        echo json_encode(['data' => $products]);
    }

    public function show($id) // GET /api/products/{id}
    {
        $p = $this->Transaction_model->get_product_by_id($id);
        if (!$p) { $this->output->set_status_header(404); echo json_encode(['error'=>'Not found']); return; }
        echo json_encode($p);
    }

    public function create() // POST /api/products
    {
        $data = $this->json_input();
        if (empty($data['class_id']) || empty($data['subclass_id']) || empty($data['product_name']) || empty($data['amount'])) {
            $this->output->set_status_header(422);
            echo json_encode(['error'=>'Missing fields']); return;
        }
        $ok = $this->Transaction_model->insert_product([
            'class_id'     => (int)$data['class_id'],
            'subclass_id'  => (int)$data['subclass_id'],
            'product_name' => trim($data['product_name']),
            'amount'       => (float)$data['amount']
        ]);
        echo json_encode(['success' => (bool)$ok]);
    }

    public function update($id) // PUT/PATCH /api/products/{id}
    {
        $data = $this->json_input();
        $ok = $this->Transaction_model->update_product($id, [
            'class_id'     => isset($data['class_id']) ? (int)$data['class_id'] : null,
            'subclass_id'  => isset($data['subclass_id']) ? (int)$data['subclass_id'] : null,
            'product_name' => isset($data['product_name']) ? trim($data['product_name']) : null,
            'amount'       => isset($data['amount']) ? (float)$data['amount'] : null
        ]);
        echo json_encode(['success' => (bool)$ok]);
    }

    public function destroy($id) // DELETE /api/products/{id}
    {
        $ok = $this->Transaction_model->delete_product($id);
        echo json_encode(['success' => (bool)$ok]);
    }

    public function classes() // GET /api/classes
    {
        echo json_encode($this->Transaction_model->get_all_classes());
    }

    public function subclasses() // GET /api/subclasses
    {
        echo json_encode($this->Transaction_model->get_all_subclasses());
    }
}
