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

  public function getBookingById($id)
  {
    return $this->db->get_where('booked', ['id' => $id, 'user_id' => $this->session->userdata('id')])->row_array();
  }

  public function searchFlight($from, $to, $dd, $rd, $sc)
  {
    $this->db->select("*, flight.id AS flightId");
    $this->db->from("flight");
    $this->db->join("airport", "flight.departure_airport=airport.id");
    $this->db->join("airline", "flight.airline=airline.id");
    $this->db->where('flight.departure_airport', $from);
    $this->db->where('flight.arrival_airport', $to);
    $this->db->where('flight.class', $sc);
    $this->db->where('date(flight.departure_datetime)', $dd);
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
    $data = [
      'flight_id' => $id,
      'user_id' => $this->session->userdata('id'),
      'name' => $this->input->post('name'),
      'telp' => $this->input->post('telp'),
      'email' => $this->input->post('email'),
      'passanger' => $ps,
      'date_booked' => date('Y-m-d H:i:s'),
      'price' => $flight['price']
    ];
    $this->db->insert('booked', $data);
    $idBooked = $this->db->insert_id();

    $this->db->set('booked', $ps);
    $this->db->where('id', $id);
    $this->db->update('flight');

    $travelerName = $this->input->post('traveler_name');
    foreach ($travelerName as $key => $value) {
      $data = [
        'id_booked' => $idBooked,
        'name' => $travelerName[$key]
      ];
      $this->db->insert('booked_list', $data);
    }
    return $idBooked;
  }
}
