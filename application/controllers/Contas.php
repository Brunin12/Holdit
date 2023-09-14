<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contas extends CI_Controller
{

  var $data = array();
  var $page = array();

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set("America/Bahia");
  }
  public function criar()
  {
    $this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required');
    $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
      if ($_REQUEST == "POST") {
			  $this->session_m->set_flashdata('error', 'Erro: ' .
        validation_errors());
      }
      $this->page['titulo'] = "Cadastro";
      $this->page['css'] = $this->load->view("cadastro/css", $this->data, true);
      $this->page['js'] = $this->load->view("cadastro/js", $this->data, true);
      $this->page['content'] = $this->load->view("cadastro/index", $this->data, true);
      $this->load->view('default/template', array('page' => $this->page));
		} else {
      echo "existe";
      $email = $this->get_input('email');
      $senha = sha1($this->get_input('senha'));
      $nome = $this->get_input('nome');
      $data = array(
        'email' => $email,
        'senha' => $senha,
        'nome' => $nome,
      );
      $id = $this->usuario->inserir($data);
      echo $id;
    }
  }

  public function entrar()
  {
    $email = $this->get_input('email');
    $senha = sha1($this->get_input('senha'));

    if (isset($email) && isset($senha)) {
      echo "existe";
      $usuario = $this->usuario->get_usuario(['email' => $email, 'senha' => $senha]);
      var_dump($usuario);
      die();
    } else {
      $this->page['titulo'] = "Entrar";
      $this->page['css'] = $this->load->view("entrar/css", $this->data, true);
      $this->page['js'] = $this->load->view("entrar/js", $this->data, true);
      $this->page['content'] = $this->load->view("entrar/index", $this->data, true);
      $this->load->view('default/template', array('page' => $this->page));
    }
  }



  private function get_input($name)
  {
    $input = $this->input->post($name);
    $input = isset($input) ? $input : '';
    return addslashes($input);
  }

}
