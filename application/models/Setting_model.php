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
