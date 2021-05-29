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
    $data['promo'] = $this->Flight_model->getFlightDiscount();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar');
    $this->load->view('index', $data);
    $this->load->view('templates/footer_tmpl');
    $this->load->view('templates/footer');
  }

  public function maskapai()
  {
    $data['title'] = 'Maskapai - Situs Pesan Tiket Pesawat';
    $data['css'] = 'style';
    $data['airline'] = $this->Airline_model->getAllAirline();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar');
    $this->load->view('maskapai', $data);
    $this->load->view('templates/footer_tmpl');
    $this->load->view('templates/footer');
  }

  public function bandara()
  {
    $data['title'] = 'Bandara - Situs Pesan Tiket Pesawat';
    $data['css'] = 'style';
    $data['airport'] = $this->Airport_model->getAllAirport();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar');
    $this->load->view('bandara', $data);
    $this->load->view('templates/footer_tmpl');
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

  public function login_admin()
  {
    if ($this->session->userdata('admin')) {
      redirect(base_url() . 'admin');
    }
    $data['title'] = 'Login Admin';
    $data['css'] = 'style';
    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar');
    $this->load->view('admin/login');
    $this->load->view('templates/footer');
  }

  public function post_login_admin()
  {
    $this->User_model->loginAdmin();
  }

  public function ticket($id, $bookingId)
  {
    $booking = $this->Flight_model->getBookingById($id, $bookingId, true);
    if ($booking && $booking['status'] == 2) {
      $data['title'] = 'Tiket ' . $booking['booking_id'];
      $data['css'] = '';
      $data['booked'] = $booking;
      $flight = $this->Flight_model->getFlightById($booking['flight_id']);
      $data['from'] = $this->Airport_model->getAirportById($flight['departure_airport']);
      $data['to'] = $this->Airport_model->getAirportById($flight['arrival_airport']);
      $data['airline'] = $this->Airline_model->getAirlineById($flight['airline']);
      $data['class'] = $this->Setting_model->getSeatClassById($flight['class']);
      $data['flight'] = $flight;
      if (isset($_GET['return'])) {
        $data['title'] = 'Tiket Pulang ' . $booking['booking_id'];
        $flight = $this->Flight_model->getFlightById($booking['arrival_flight_id']);
        $data['from'] = $this->Airport_model->getAirportById($flight['departure_airport']);
        $data['to'] = $this->Airport_model->getAirportById($flight['arrival_airport']);
        $data['airline'] = $this->Airline_model->getAirlineById($flight['airline']);
        $data['class'] = $this->Setting_model->getSeatClassById($flight['class']);
        $data['flight'] = $flight;
      } else {
        $data['title'] = 'Tiket Pergi ' . $booking['booking_id'];
      }
      $data['booked_list'] = $this->User_model->getBookedList($id);
      $this->load->view('templates/header', $data);
      $this->load->view('admin/ticket', $data);
      $this->load->view('templates/footer');
    } else {
      if ($_GET['redirect'] == "bookings") {
        redirect(base_url() . 'admin/bookings');
      } else if ($_GET['redirect'] == "mybooking") {
        redirect(base_url() . 'user/mybooking');
      } else {
        redirect(base_url());
      }
    }
  }

  public function other_page($slug)
  {
    $page = $this->Setting_model->getPageBySlug($slug);
    if (!$page) {
      redirect(base_url());
    } else {
      $data['title'] = $page['title'];
      $data['css'] = '';
      $data['page'] = $page;
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navbar');
      $this->load->view('other_page', $page);
      $this->load->view('templates/footer_tmpl');
      $this->load->view('templates/footer');
    }
  }
}
