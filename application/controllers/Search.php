<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search extends CI_Controller
{

  public function index()
  {
    $from = isset($_GET['from']) ? $_GET['from'] : NULL;
    $to = isset($_GET['to']) ? $_GET['to'] : NULL;
    $dd = isset($_GET['dd']) ? $_GET['dd'] : NULL;
    $rd = isset($_GET['rd']) ? $_GET['rd'] : NULL;
    $ps = isset($_GET['ps']) ? $_GET['ps'] : NULL;
    $sc = isset($_GET['sc']) ? $_GET['sc'] : NULL;
    $data['title'] = 'Situs Pesan Tiket Pesawat';
    $data['css'] = 'style';
    $data['from'] = $this->Airport_model->getAirportById($from);
    $data['to'] = $this->Airport_model->getAirportById($to);
    $data['class'] = $this->Setting_model->getSeatClassById($sc);
    $data['flights'] = $this->Flight_model->searchFlight($from, $to, $dd, $rd, $sc);
    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar');
    $this->load->view('search', $data);
    $this->load->view('templates/footer');
  }
}
