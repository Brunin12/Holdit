<?php

class Usuario_model extends CI_Model
{

  public function get_usuario($data)
  {
    return $this->db->get_where('usuario', $data)->row();
  }

  public function get_usuario_id($id)
  {
    return $this->db->get_where('usuario', array('id' => $id))->row();
  }

  public function inserir($data) {
    $this->db->insert($data);
    return $this->db->insert_id();
  }
}
