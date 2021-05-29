<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

  public function getAllUser()
  {
    return $this->db->get('user');
  }

  public function getUserBySession()
  {
    return $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
  }

  public function getBooked($status = "")
  {
    $this->db->select("*, booked.id AS bookedId, booked.price AS bookedPrice");
    $this->db->from("booked");
    $this->db->join("flight", "booked.flight_id=flight.id");
    if ($status != "") {
      $this->db->where('status', $status);
    }
    $this->db->where('booked.user_id', $this->session->userdata('id'));
    $this->db->order_by('booked.id', 'desc');
    return $this->db->get();
  }

  public function getBookedList($id)
  {
    return $this->db->get_where('booked_list', ['id_booked' => $id]);
  }

  public function register()
  {
    $email = $this->input->post('email');
    $checkEmail = $this->db->get_where('user', ['email' => $email])->row_array();
    if ($checkEmail) {
      $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">Email yang dimasukkan sudah terdaftar, mohon gunakan email yang lain.</div>');
      redirect(base_url() .  isset($_GET['redirect']) ? 'register?' . $_SERVER['QUERY_STRING'] : 'register');
    } else {
      $name = $this->input->post('name');
      $password = $this->input->post('password');
      $username = $this->Setting_model->nameToUsername($name);
      $checkUsername = $this->db->get_where('user', ['username' => $username])->row_array();
      if ($checkUsername) {
        $username = $username . substr(rand(), 0, 3);
      }
      $data = [
        'name' => $name,
        'username' => $username,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'date_register' => date('Y-m-d H:i:s')
      ];
      $this->db->insert('user', $data);
      return $username;
    }
  }

  public function login()
  {
    $redirect = base_url() .  isset($_GET['redirect']) ? 'login?' . $_SERVER['QUERY_STRING'] : 'login';
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $user = $this->db->get_where('user', ['username' => $username])->row_array();
    if ($user) {
      if (password_verify($password, $user['password'])) {
        $data = [
          'id' => $user['id'],
          'login' => true
        ];
        $this->session->set_userdata($data);
        redirect(base_url() . isset($_GET['redirect']) ? str_replace("redirect=", "", $_SERVER['QUERY_STRING']) : null);
      } else {
        $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">Username atau password salah</div>');
        redirect($redirect);
      }
    } else {
      $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">Username atau password salah</div>');
      redirect($redirect);
    }
  }

  public function loginAdmin()
  {
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $admin = $this->db->get_where('admin', ['username' => $username])->row_array();
    if ($admin) {
      if (password_verify($password, $admin['password'])) {
        $this->session->set_userdata('admin', true);
        redirect(base_url() . 'admin');
      } else {
        $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">Username atau password salah</div>');
        redirect(base_url() . 'login/admin');
      }
    } else {
      $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">Username atau password salah</div>');
      redirect(base_url() . 'login/admin');
    }
  }

  public function updateProfile()
  {
    $name = $this->input->post('name');
    $username = $this->input->post('username');
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    if ($this->checkToDB('username', $username)) {
      $this->alertDangerUpdateProfile('username');
    }
    if ($this->checkToDB('email', $email)) {
      $this->alertDangerUpdateProfile('email');
    }
    $data = [
      'name' => $name,
      'username' => $username,
      'email' => $email
    ];
    if ($password != "") {
      $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    }
    $this->db->where('id', $this->session->userdata('id'));
    $this->db->update('user', $data);
    $this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">Profil berhasil diupdate.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button></div>');
    redirect(base_url() . 'user');
  }

  function checkToDB($field, $value)
  {
    return $this->db->get_where('user', [$field => $value, 'id !=' => $this->session->userdata('id')])->row_array();
  }

  function alertDangerUpdateProfile($field)
  {
    $this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">' . ucfirst($field) . ' sudah terdaftar, mohon gunakan ' . $field . ' lain atau tidak perlu diubah.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button></div>');
    redirect(base_url() . 'user');
  }
}
