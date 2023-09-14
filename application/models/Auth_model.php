<?php

class Auth_model extends CI_Model
{

  public function se_autenticado()
  {
    $user = $this->session_m->userdata('user');
    if (!isset($user)) {
      redirect(base_url('acessos'));
    }
    $user_db =
      $this->user->get_w('user', ['email' => $user['email']])->row();

    if ($user_db->flag != 'ATIVO') {
      $this->session->unset_userdata(sha1('user'));
      $this->session->sess_destroy();
      unset($_SESSION['user']);
    }
    return 0;
  }


  public function acesso_id($id)
  {
    $uid = $this->session_m->get_id();
    if ($uid == $id) {
      return true;
    } else {
      return false;
    }
  }



  public function permitidos($lista, $url_redirect = null, $alert = true)
  {
    if (!$this->permitido($lista)) {
      if ($alert) {
        $this->session_m->set_flashdata('erro', 'Você não tem permissão para acessar esta categoria!');
      }
      if (!isset($url_redirect)) {
        redirect(base_url('Erros'));
      } else {
        redirect($url_redirect);
      }
    }
  }



  public function permitido($lista, $return = false)
  {
    $id = $this->session_m->get_id();
    $cargo = $this->db->get_where('usuario', array('id_usuario' => $id))->row()->perfil;
    if ($return)
      return $cargo;

    if (!in_array($cargo, $lista))
      return false;

    return true;
  }

  public function is_logado() {
    $userdata = is_null($this->session_m->userdata('user'));
    if ($userdata) {
      return false;
    }
    return true;
  }


  public function sair()
  {
    $this->session->unset_userdata(sha1('user'));
    $this->session->sess_destroy();
    unset($_SESSION['user']);
    if (isset($_SESSION[sha1('user')])) {
      $this->session_m->set_flashdata('erro', 'Um erro aconteceu, Usuario não fez o logoff. Tente novamente mais tarde.');
      redirect(base_url());
    }
    $this->se_autenticado();
  }
}
