<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Airport_model extends CI_Model
{

  public function getAllAirport($order = 'desc')
  {
    $this->db->order_by('id', $order);
    return $this->db->get('airport');
  }

  public function getAirportById($id)
  {
    return $this->db->get_where('airport', ['id' => $id])->row_array();
  }

  public function getRandomAirport()
  {
    $this->db->order_by('id', 'RANDOM');
    return $this->db->get('airport');
  }

  public function insertAirport()
  {
    $name = $this->input->post('name');
    $location = $this->input->post('location');
    $data = [
      'name' => $name,
      'location' => $location
    ];
    $this->db->insert('airport', $data);
  }

  public function updateAirport($id)
  {
    $name = $this->input->post('name');
    $location = $this->input->post('location');
    $data = [
      'name' => $name,
      'location' => $location
    ];
    $this->db->where('id', $id);
    $this->db->update('airport', $data);
  }

  public function deleteAirport($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('airport');
  }
}
