<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Airline_model extends CI_Model
{

  public function getAllAirline($order = 'desc')
  {
    $this->db->order_by('id', $order);
    return $this->db->get('airline');
  }

  public function getAirlineById($id)
  {
    return $this->db->get_where('airline', ['id' => $id])->row_array();
  }

  public function getRandomAirline()
  {
    $this->db->order_by('id', 'RANDOM');
    return $this->db->get('airline');
  }

  public function insertAirline()
  {
    $name = $this->input->post('name');
    $logo = $this->input->post('logo');
    $data = [
      'name' => $name,
      'logo' => $logo
    ];
    $this->db->insert('airline', $data);
  }

  public function updateAirline($id)
  {
    $name = $this->input->post('name');
    $logo = $this->input->post('logo');
    $data = [
      'name' => $name,
      'logo' => $logo
    ];
    $this->db->where('id', $id);
    $this->db->update('airline', $data);
  }

  public function deleteAirline($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('airline');
  }
}
