<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $params = ['server_key' => $this->config->item('server_api_midtrans'), 'production' => $this->config->item('midtrans_production')];
    $this->load->library('midtrans');
    $this->midtrans->config($params);
  }

  public function token($id)
  {
    $booking = $this->Flight_model->getBookingById($id);
    $flight = $this->Flight_model->getFlightById($booking['flight_id']);
    $airline = $this->Airline_model->getAirlineById($flight['airline']);
    $from = $this->Airport_model->getAirportById($flight['departure_airport']);
    $to = $this->Airport_model->getAirportById($flight['arrival_airport']);
    $transaction_details = [
      'order_id' => intval($id),
      'gross_amount' => intval($booking['price'] * $booking['passanger'])
    ];
    $items = [
      'id' => intval($booking['id']),
      'price' => intval($booking['price']),
      'quantity' => intval($booking['passanger']),
      'name' => 'Tiket Pesawat ' . $airline['name']
    ];
    $customer_details = [
      'first_name'    => $booking['name'],
      'email'         => $booking['email'],
      'phone'         => "0" . $booking['telp']
    ];

    $credit_card['secure'] = true;

    $time = time();
    $custom_expiry = [
      'start_time' => date("Y-m-d H:i:s O", $time),
      'unit' => 'day',
      'duration'  => 1
    ];
    $payload = [
      'transaction_details' => $transaction_details,
      'item_details'        => $items,
      'customer_details'    => $customer_details,
      'credit_card'         => $credit_card,
      'expiry'              => $custom_expiry
    ];
    error_log(json_encode($payload));
    $snapToken = $this->midtrans->getSnapToken($payload);
    error_log($snapToken);
    echo $snapToken;
  }

  public function finish($id)
  {
    if (!$id) {
      redirect(base_url());
    }
    $result = json_decode($this->input->post('result_data'));
    $this->db->set('link_pay', $result->pdf_url);
    $this->db->set('status', 1);
    $this->db->where('id', $id);
    $this->db->update('booked');
    redirect(base_url() . 'user/mybooking/' . $id);
  }
}
