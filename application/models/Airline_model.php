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

  public function uploadImg()
  {
    $config['upload_path'] = './assets/img/maskapai/';
    $config['allowed_types'] = 'jpg|png|jpeg|ico|image/png|image/jpg|image/jpeg|image/ico';
    $config['max_size'] = '10000';
    $config['file_name'] = round(microtime(true) * 1000);

    $this->load->library('upload', $config);
    if ($this->upload->do_upload('img')) {
      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
      return $return;
    } else {
      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
      return $return;
    }
  }

  public function insertAirline($upload)
  {
    $name = $this->input->post('name');
    $logo = $upload['file']['file_name'];
    $data = [
      'name' => $name,
      'logo' => $logo
    ];
    $this->db->insert('airline', $data);
  }

  public function updateAirline($id, $file)
  {
    $name = $this->input->post('name');
    $data = [
      'name' => $name,
    ];
    if ($file != "") {
      $data['logo'] = $file;
    }
    $this->db->where('id', $id);
    $this->db->update('airline', $data);
  }

  public function deleteAirline($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('airline');
  }
}
