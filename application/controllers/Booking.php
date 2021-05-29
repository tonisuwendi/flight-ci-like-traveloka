<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends CI_Controller
{

  public function index($id)
  {
    $data['title'] = 'Situs Pesan Tiket Pesawat';
    $data['css'] = 'style';
    $rd = isset($_GET['rd']) ? $_GET['rd'] : null;
    $flight = $this->Flight_model->getFlightById($id);
    $flight2 = $this->Flight_model->getFlightById($rd);
    if ($flight && $this->session->userdata('login')) {
      $data['from'] = $this->Airport_model->getAirportById($flight['departure_airport']);
      $data['to'] = $this->Airport_model->getAirportById($flight['arrival_airport']);
      $data['airline'] = $this->Airline_model->getAirlineById($flight['airline']);
      $data['class'] = $this->Setting_model->getSeatClassById($flight['class']);
      $data['flight'] = $flight;
      $data['rd'] = $rd;
      if ($rd) {
        $data['from2'] = $this->Airport_model->getAirportById($flight2['departure_airport']);
        $data['to2'] = $this->Airport_model->getAirportById($flight2['arrival_airport']);
        $data['airline2'] = $this->Airline_model->getAirlineById($flight2['airline']);
        $data['class2'] = $this->Setting_model->getSeatClassById($flight2['class']);
        $data['flight2'] = $flight2;
      }
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navbar');
      $this->load->view('booking', $data);
      $this->load->view('templates/footer_tmpl');
      $this->load->view('templates/footer');
    } else {
      redirect(base_url());
    }
  }

  public function insert($id)
  {
    $flight = $this->Flight_model->getFlightById($id);
    if ($flight && $this->session->userdata('login')) {
      $booking = $this->Flight_model->insertBooking($id, $flight);
      redirect(base_url() . 'booking/payment/' . $booking);
    } else {
      redirect(base_url());
    }
  }

  public function payment($id)
  {
    $booking = $this->Flight_model->getBookingById($id);
    if ($booking && $booking['status'] == 0 && $this->session->userdata('login')) {
      $data['title'] = 'Pilih Metode Pembayaran Tiket';
      $data['css'] = 'style';
      $data['booking'] = $booking;
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navbar');
      $this->load->view('payment', $data);
      $this->load->view('templates/footer');
    } else {
      redirect(base_url());
    }
  }
}
