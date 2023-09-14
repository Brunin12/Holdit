<?php

class Session_model extends CI_Model
{
  public function set_flashdata($titulo, $data)
  {
    $this->session->set_flashdata(sha1($titulo), $data);
    return true;
  }

  public function flashdata($titulo)
  {
    return $this->session->flashdata(sha1($titulo));
  }

  public function set_userdata($titulo, $data)
  {
    $this->session->set_userdata(sha1($titulo), $data);
    return true;
  }

  public function userdata($titulo)
  {
    return $this->session->userdata(sha1($titulo));
  }

  public function get_id()
  {
    $session = $this->session_m->userdata('user');
    if (!is_null($session)) {
      return $session['id'];
    }
    return null;
  }

}
