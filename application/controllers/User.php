<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata('login')) {
      redirect(base_url() . 'login?redirect=user');
    }
  }

  public function index()
  {
    $data['title'] = 'Akun Saya';
    $data['css'] = 'user';
    $data['user'] = $this->User_model->getUserBySession();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar');
    $this->load->view('user/index', $data);
    $this->load->view('templates/footer_tmpl');
    $this->load->view('templates/footer');
  }

  public function edit_user()
  {
    $this->User_model->updateProfile();
  }

  public function mybooking()
  {
    $data['title'] = 'Pesanan Saya';
    $data['css'] = 'user';
    $data['booked'] = $this->User_model->getBooked();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar');
    $this->load->view('user/mybooking', $data);
    $this->load->view('templates/footer_tmpl');
    $this->load->view('templates/footer');
  }

  public function detail_booking($id)
  {
    $booking = $this->Flight_model->getBookingById($id);
    if ($booking) {
      $data['title'] = 'Pesanan Saya';
      $data['css'] = 'user';
      $data['booked'] = $booking;
      $flight = $this->Flight_model->getFlightById($booking['flight_id']);
      $data['from'] = $this->Airport_model->getAirportById($flight['departure_airport']);
      $data['to'] = $this->Airport_model->getAirportById($flight['arrival_airport']);
      $data['airline'] = $this->Airline_model->getAirlineById($flight['airline']);
      $data['class'] = $this->Setting_model->getSeatClassById($flight['class']);
      $data['flight'] = $flight;
      if ($booking['arrival_flight_id'] != 0) {
        $flight2 = $this->Flight_model->getFlightById($booking['arrival_flight_id']);
        $data['from2'] = $this->Airport_model->getAirportById($flight2['departure_airport']);
        $data['to2'] = $this->Airport_model->getAirportById($flight2['arrival_airport']);
        $data['airline2'] = $this->Airline_model->getAirlineById($flight2['airline']);
        $data['class2'] = $this->Setting_model->getSeatClassById($flight2['class']);
        $data['flight2'] = $flight2;
      }
      $data['booked_list'] = $this->User_model->getBookedList($id);
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navbar');
      $this->load->view('user/detail_booking', $data);
      $this->load->view('templates/footer_tmpl');
      $this->load->view('templates/footer');
    } else {
      redirect(base_url() . 'user/mybooking');
    }
  }

  public function logout()
  {
    $this->session->unset_userdata(['login', 'id']);
    redirect(base_url() . 'login');
  }
}
