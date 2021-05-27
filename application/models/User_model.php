<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

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
}
