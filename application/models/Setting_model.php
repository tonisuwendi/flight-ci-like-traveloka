<?php
defined('BASEPATH') or exit('No direct script access allowed');

$seatClass = [
  1 => 'Ekonomi',
  2 => 'Premium Ekonomi',
  3 => 'Bisnis',
  4 => 'First Class'
];

class Setting_model extends CI_Model
{

  public function classArray()
  {
    return [
      1 => 'Ekonomi',
      2 => 'Premium Ekonomi',
      3 => 'Bisnis',
      4 => 'First Class'
    ];
  }

  public function seatClass()
  {
    return $this->classArray();
  }

  public function getSeatClassById($id)
  {
    foreach ($this->classArray() as $key => $value) {
      if ($key == $id) {
        return $value;
      }
    }
  }

  public function getPages($sort = "desc")
  {
    $this->db->order_by('id', $sort);
    return $this->db->get('pages');
  }

  public function getPageById($id)
  {
    return $this->db->get_where('pages', ['id' => $id])->row_array();
  }

  public function getPageBySlug($slug)
  {
    return $this->db->get_where('pages', ['slug' => $slug])->row_array();
  }

  public function insertPage()
  {
    $title = $this->input->post('title');
    $content = $this->input->post('description');
    $slug = $this->input->post('slug');
    $data = [
      'title' => $title,
      'content' => $content,
      'slug' => $slug
    ];
    $this->db->insert('pages', $data);
  }

  public function updatePage($id)
  {
    $title = $this->input->post('title');
    $content = $this->input->post('description');
    $slug = $this->input->post('slug');
    $data = [
      'title' => $title,
      'content' => $content,
      'slug' => $slug
    ];
    $this->db->where('id', $id);
    $this->db->update('pages', $data);
  }

  public function editProfil()
  {
    $name = $this->input->post('name');
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $data = [
      'name' => $name,
      'username' => $username,
    ];
    if ($password != "") {
      $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    }
    $this->db->update('admin', $data);
  }

  public function nameToUsername($text = '')
  {
    $text = trim($text);
    if (empty($text)) return '';
    $text = preg_replace("/[^a-zA-Z0-9\-\s]+/", "", $text);
    $text = strtolower(trim($text));
    $text = str_replace(' ', '', $text);
    $text = preg_replace('/\-{2,}/', '', $text);
    return $text;
  }
}
