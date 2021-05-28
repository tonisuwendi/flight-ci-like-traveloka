<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata('admin')) {
      redirect(base_url() . 'login/admin');
    }
    $this->load->library('form_validation');
  }

  public function index()
  {
    $data['title'] = 'Admin Panel';
    $this->load->view('templates/header_admin', $data);
    $this->load->view('admin/index', $data);
    $this->load->view('templates/footer_admin');
  }

  public function users()
  {
    $data['title'] = 'Pengguna - Admin Panel';
    $data['users'] = $this->User_model->getAllUser();
    $this->load->view('templates/header_admin', $data);
    $this->load->view('admin/users', $data);
    $this->load->view('templates/footer_admin');
  }

  public function bookings()
  {
    $data['title'] = 'Pesanan - Admin Panel';
    $data['booking'] = $this->Flight_model->getAllBooking();
    $this->load->view('templates/header_admin', $data);
    $this->load->view('admin/bookings', $data);
    $this->load->view('templates/footer_admin');
  }

  public function detail_booking($id)
  {
    $booking = $this->Flight_model->getBookingById($id, null, true);
    if ($booking) {
      $data['title'] = 'Detail Pesanan - Admin Panel';
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
      $this->load->view('templates/header_admin', $data);
      $this->load->view('admin/detail_booking', $data);
      $this->load->view('templates/footer_admin');
    } else {
      redirect(base_url() . 'admin/bookings');
    }
  }

  public function flights()
  {
    $this->form_validation->set_rules('airline', 'Maskapai', 'required', ['required' => 'Maskapai wajib diisi']);
    if ($this->form_validation->run() == false) {
      $data['title'] = 'Penerbangan - Admin Panel';
      $data['airline'] = $this->Airline_model->getAllAirline();
      $data['airport'] = $this->Airport_model->getAllAirport();
      $data['flight'] = $this->Flight_model->getAllFlight();
      $data['class'] = $this->Setting_model->seatClass();
      $this->load->view('templates/header_admin', $data);
      $this->load->view('admin/flights', $data);
      $this->load->view('templates/footer_admin');
    } else {
      $this->Flight_model->insertFlight();
      $this->session->set_flashdata('alert', "<script>
        swal({
        text: 'Berhasil menambah jadwal penerbangan',
        icon: 'success'
        });
      </script>");
      redirect(base_url() . 'admin/flights/');
    }
  }

  public function edit_flight($id)
  {
    $this->Flight_model->updateFlight($id);
    $this->session->set_flashdata('alert', "<script>
			swal({
			text: 'Jadwal penerbangan berhasil diubah',
			icon: 'success'
			});
		</script>");
    redirect(base_url() . 'admin/flights/');
  }

  public function get_flight_by_id($id)
  {
    $flight = $this->Flight_model->getFlightById($id);
    $airline = $this->Airline_model->getAllAirline();
    $airport = $this->Airport_model->getAllAirport();
    $class = $this->Setting_model->seatClass();
    $html = '<form action="' . base_url() . 'admin/edit_flight/' . $id . '" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="airline">Maskapai</label>
                <select name="airline" required id="airline" class="form-control">';
    foreach ($airline->result_array() as $data) {
      if ($data['id'] == $flight['airline']) {
        $html .= '<option selected value="' . $data['id'] . '">' . $data['name'] . '</option>';
      } else {
        $html .= '<option value="' . $data['id'] . '">' . $data['name'] . '</option>';
      }
    }
    $html .= '</select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="number">No. Penerbangan</label>
                <input type="text" required id="number" autocomplete="off" class="form-control" value="' . $flight['number'] . '" name="number">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="departure_airport">Bandara Keberangkatan</label>
                <select name="departure_airport" required id="departure_airport" class="form-control">';
    foreach ($airport->result_array() as $data) {
      if ($data['id'] == $flight['departure_airport']) {
        $html .= '<option selected value="' . $data['id'] . '">' . $data['name'] . ' - ' . $data['location'] . '</option>';
      } else {
        $html .= '<option value="' . $data['id'] . '">' . $data['name'] . ' - ' . $data['location'] . '</option>';
      }
    }
    $html .= '</select> 
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="arrival_airport">Bandara Tiba</label>
                <select name="arrival_airport" required id="arrival_airport" class="form-control">';
    foreach ($airport->result_array() as $data) {
      if ($data['id'] == $flight['arrival_airport']) {
        $html .= '<option selected value="' . $data['id'] . '">' . $data['name'] . ' - ' . $data['location'] . '</option>';
      } else {
        $html .= '<option value="' . $data['id'] . '">' . $data['name'] . ' - ' . $data['location'] . '</option>';
      }
    }
    $html .= '</select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="departure_datetime">Waktu Keberangkatan</label>
                <input type="datetime-local" name="departure_datetime" class="form-control" id="departure_datetime" placeholder="2021-04-13 14:40" value="' . $flight['departure_datetime'] . '" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="arrival_datetime">Waktu Tiba</label>
                <input type="datetime-local" name="arrival_datetime" class="form-control" placeholder="2021-04-13 18:10" id="arrival_datetime" value="' . $flight['arrival_datetime'] . '" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="seat">Jumlah Kursi</label>
                <input type="number" required id="seat" autocomplete="off" class="form-control" value="' . $flight['seat'] . '" name="seat">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="price">Harga</label>
                <input type="number" required id="price" autocomplete="off" class="form-control" name="price" value="' . $flight['price'] . '" placeholder="1000000">
              </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                  <label for="class">Kelas</label>
                  <select name="class" required id="class" class="form-control">';
    foreach ($class  as $key => $value) {
      if ($key == $flight['class']) {
        $html .= '<option selected value="' . $key . '">' . $value . '</option>';
      } else {
        $html .= '<option value="' . $key . '">' . $value . '</option>';
      }
    }
    $html .= '</select>
                </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>';
    echo $html;
  }

  public function delete_flight($id)
  {
    $this->Flight_model->deleteFlight($id);
    $this->session->set_flashdata('alert', "<script>
			swal({
			text: 'Penerbangan berhasil dihapus',
			icon: 'success'
			});
		</script>");
    redirect(base_url() . 'admin/flights/');
  }

  public function airports()
  {
    $this->form_validation->set_rules('name', 'Name', 'required', ['required' => 'Nama wajib diisi']);
    if ($this->form_validation->run() == false) {
      $data['title'] = 'Bandara - Admin Panel';
      $data['airport'] = $this->Airport_model->getAllAirport();
      $this->load->view('templates/header_admin', $data);
      $this->load->view('admin/airports', $data);
      $this->load->view('templates/footer_admin');
    } else {
      $this->Airport_model->insertAirport();
      $this->session->set_flashdata('alert', "<script>
        swal({
        text: 'Berhasil menambah bandara',
        icon: 'success'
        });
      </script>");
      redirect(base_url() . 'admin/airports/');
    }
  }

  public function edit_airport($id)
  {
    $this->Airport_model->updateAirport($id);
    $this->session->set_flashdata('alert', "<script>
			swal({
			text: 'Bandara berhasil diubah',
			icon: 'success'
			});
		</script>");
    redirect(base_url() . 'admin/airports/');
  }

  public function delete_airport($id)
  {
    $this->Airport_model->deleteAirport($id);
    $this->session->set_flashdata('alert', "<script>
			swal({
			text: 'Bandara berhasil dihapus',
			icon: 'success'
			});
		</script>");
    redirect(base_url() . 'admin/airports/');
  }

  public function airlines()
  {
    $this->form_validation->set_rules('name', 'Name', 'required', ['required' => 'Nama wajib diisi']);
    if ($this->form_validation->run() == false) {
      $data['title'] = 'Maskapai - Admin Panel';
      $data['airline'] = $this->Airline_model->getAllAirline();
      $this->load->view('templates/header_admin', $data);
      $this->load->view('admin/airlines', $data);
      $this->load->view('templates/footer_admin');
    } else {
      $upload = $this->Airline_model->uploadImg();
      if ($upload['result'] == 'success') {
        $this->Airline_model->insertAirline($upload);
        $this->session->set_flashdata('alert', "<script>
        swal({
          text: 'Berhasil menambah maskapai penerbangan',
          icon: 'success'
          });
        </script>");
        redirect(base_url() . 'admin/airlines/');
      } else {
        $this->session->set_flashdata('alert', "<script>
        swal({
          text: 'Gagal mengupload, pastikan logo berukuran maksimal 10MB dan berformat PNG, JPEG, JPG, atau ICO',
          icon: 'error'
          });
        </script>");
        redirect(base_url() . 'admin/airlines/');
      }
    }
  }

  public function edit_airline($id)
  {
    if ($_FILES['img']['name'] == "") {
      $this->Airline_model->updateAirline($id, "");
      $this->session->set_flashdata('alert', "<script>
			swal({
			text: 'Maskapai berhasil diubah',
			icon: 'success'
			});
		</script>");
      redirect(base_url() . 'admin/airlines/');
    } else {
      $upload = $this->Airline_model->uploadImg();
      if ($upload['result'] == 'success') {
        $this->Airline_model->updateAirline($id, $upload['file']['file_name']);
        $this->session->set_flashdata('alert', "<script>
          swal({
          text: 'Maskapai berhasil diubah',
          icon: 'success'
          });
        </script>");
        redirect(base_url() . 'admin/airlines/');
      } else {
        $this->session->set_flashdata('alert', "<script>
        swal({
          text: 'Gagal mengubah, pastikan logo berukuran maksimal 10MB dan berformat PNG, JPEG, JPG, atau ICO',
          icon: 'error'
          });
        </script>");
        redirect(base_url() . 'admin/airlines/');
      }
    }
  }

  public function delete_airline($id)
  {
    $this->Airline_model->deleteAirline($id);
    $this->session->set_flashdata('alert', "<script>
			swal({
			text: 'Maskapai berhasil dihapus',
			icon: 'success'
			});
		</script>");
    redirect(base_url() . 'admin/airlines/');
  }

  public function logout()
  {
    $this->session->unset_userdata('admin');
    redirect(base_url() . 'login/admin');
  }
}
