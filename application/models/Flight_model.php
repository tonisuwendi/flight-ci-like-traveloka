<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Flight_model extends CI_Model
{

  public function getAllFlight($sort = "desc")
  {
    $this->db->select("*, flight.id AS flightId, airport.name AS airportName, airport.location AS airportLocation");
    $this->db->from("flight");
    $this->db->join("airport", "flight.departure_airport=airport.id");
    $this->db->join("airline", "flight.airline=airline.id");
    $this->db->order_by('flight.id', $sort);
    return $this->db->get();
  }

  public function getFlightById($id)
  {
    return $this->db->get_where('flight', ['id' => $id])->row_array();
  }

  public function getAllBooking($sort = "desc")
  {
    $this->db->select("*, booked.id AS bookedId");
    $this->db->from("booked");
    $this->db->join("flight", "booked.flight_id=flight.id");
    $this->db->order_by('booked.id', $sort);
    return $this->db->get();
  }

  public function getBookingById($id, $bookingId = null, $free = false)
  {
    if (!$free) {
      $this->db->where('user_id', $this->session->userdata('id'));
    }
    if ($bookingId) {
      $this->db->where('booking_id', $bookingId);
    }
    return $this->db->get_where('booked', ['id' => $id])->row_array();
  }

  public function searchFlight($from, $to, $dd, $rd, $sc, $departure)
  {
    $this->db->select("*, flight.id AS flightId");
    $this->db->from("flight");
    $this->db->join("airport", "flight.departure_airport=airport.id");
    $this->db->join("airline", "flight.airline=airline.id");
    $this->db->where('flight.departure_airport', $from);
    $this->db->where('flight.arrival_airport', $to);
    $this->db->where('flight.class', $sc);
    if ($departure) {
      $this->db->where('date(flight.arrival_datetime)', $rd);
    } else {
      $this->db->where('date(flight.departure_datetime)', $dd);
    }
    $this->db->order_by('flight.id', 'desc');
    return $this->db->get();
  }

  public function insertFlight()
  {
    $airline = $this->input->post('airline');
    $number = $this->input->post('number');
    $departure_airport = $this->input->post('departure_airport');
    $arrival_airport = $this->input->post('arrival_airport');
    $departure_datetime = $this->input->post('departure_datetime');
    $arrival_datetime = $this->input->post('arrival_datetime');
    $seat = $this->input->post('seat');
    $price = $this->input->post('price');
    $class = $this->input->post('class');
    $data = [
      'airline' => $airline,
      'number' => $number,
      'departure_airport' => $departure_airport,
      'arrival_airport' => $arrival_airport,
      'departure_datetime' => $departure_datetime,
      'arrival_datetime' => $arrival_datetime,
      'seat' => $seat,
      'price' => $price,
      'class' => $class,
    ];
    $this->db->insert('flight', $data);
  }

  public function updateFlight($id)
  {
    $airline = $this->input->post('airline');
    $number = $this->input->post('number');
    $departure_airport = $this->input->post('departure_airport');
    $arrival_airport = $this->input->post('arrival_airport');
    $departure_datetime = $this->input->post('departure_datetime');
    $arrival_datetime = $this->input->post('arrival_datetime');
    $seat = $this->input->post('seat');
    $price = $this->input->post('price');
    $class = $this->input->post('class');
    $data = [
      'airline' => $airline,
      'number' => $number,
      'departure_airport' => $departure_airport,
      'arrival_airport' => $arrival_airport,
      'departure_datetime' => $departure_datetime,
      'arrival_datetime' => $arrival_datetime,
      'seat' => $seat,
      'price' => $price,
      'class' => $class,
    ];
    $this->db->where('id', $id);
    $this->db->update('flight', $data);
  }

  public function deleteFlight($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('flight');
  }

  public function insertBooking($id, $flight)
  {
    $ps = isset($_GET['ps']) ? $_GET['ps'] : 1;
    $rd = isset($_GET['rd']) ? $_GET['rd'] : 0;
    if ($rd != 0) {
      $flight2 = $this->Flight_model->getFlightById($rd);
    }
    $data = [
      'booking_id' => substr(time(), 0, 3) . rand(),
      'arrival_booking_id' => $rd == 0 ? "" : substr(time(), 1, 4) . rand(),
      'flight_id' => $id,
      'arrival_flight_id' => $rd,
      'user_id' => $this->session->userdata('id'),
      'name' => $this->input->post('name'),
      'telp' => $this->input->post('telp'),
      'email' => $this->input->post('email'),
      'passanger' => $ps,
      'date_booked' => date('Y-m-d H:i:s'),
      'price' => $flight['price'],
      'arrival_price' => $rd == 0 ? 0 : $flight2['price'],
    ];
    $this->db->insert('booked', $data);
    $idBooked = $this->db->insert_id();

    $this->db->set('booked', $ps);
    $this->db->where('id', $id);
    if ($rd != 0) {
      $this->db->where('id', $rd);
    }
    $this->db->update('flight');

    $travelerName = $this->input->post('traveler_name');
    $travelerTitle = $this->input->post('traveler_title');
    foreach ($travelerName as $key => $value) {
      $data = [
        'id_booked' => $idBooked,
        'title' => $travelerTitle[$key],
        'name' => $travelerName[$key],
        'number' => substr(rand(), 0, 4) . time(),
        'arrival_number' => $rd == 0 ? 0 : substr(rand(), 1, 5) . time()
      ];
      $this->db->insert('booked_list', $data);
    }
    return $idBooked;
  }
}
