<?php

class Empresa_model extends CI_Model
{

  public function get_empresa($id)
  {
    return $this->db->get_where('empresa', array('id' => $id))->row();
  }
}
