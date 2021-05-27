<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

  public function index()
  {
    $data['title'] = 'Situs Pesan Tiket Pesawat';
    $data['css'] = 'style';
    $data['airport'] = $this->Airport_model->getAllAirport();
    $data['airport2'] = $this->Airport_model->getRandomAirport();
    $data['class'] = $this->Setting_model->seatClass();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar');
    $this->load->view('index', $data);
    $this->load->view('templates/footer');
  }

  public function login()
  {
    $data['title'] = 'Login Akun';
    $data['css'] = 'style';
    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar');
    $this->load->view('auth/login', $data);
    $this->load->view('templates/footer');
  }

  public function post_login()
  {
    $this->User_model->login();
  }

  public function register()
  {
    $data['title'] = 'Daftar Akun';
    $data['css'] = 'style';
    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar');
    $this->load->view('auth/register', $data);
    $this->load->view('templates/footer');
  }

  public function post_register()
  {
    $username = $this->User_model->register();
    $this->session->set_flashdata('alert', "<div class='alert alert-success'>Pendaftaran berhasil dilakukan. <br/>Username kamu adalah <strong>$username</strong>. Yuk login menggunakan username serta password yang telah kamu buat.</div>");
    $this->session->set_flashdata('username', $username);
    redirect(base_url() .  isset($_GET['redirect']) ? 'login?' . $_SERVER['QUERY_STRING'] : 'login');
  }
}
