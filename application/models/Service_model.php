<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends CI_Model
{
    private $_table = "services";

    public $service_id;
    public $name;
    public $price;
    public $image = "default.jpg";
    public $description;

    public function rules()
    {
        return [
            ['field' => 'name',
            'label' => 'Name',
            'rules' => 'required'],

            ['field' => 'price',
            'label' => 'Price',
            'rules' => 'numeric'],
            
            ['field' => 'description',
            'label' => 'Description',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["service_id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->service_id = uniqid();
        $this->name = $post["name"];
        $this->price = $post["price"];
        $this->description = $post["description"];
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->service_id = $post["id"];
        $this->name = $post["name"];
        $this->price = $post["price"];
        $this->description = $post["description"];
        return $this->db->update($this->_table, $this, array('service_id' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("service_id" => $id));
    }
}