<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inicio extends CI_Controller
{

  var $data = array();
  var $page = array();

  function __construct()
  {
    parent::__construct();
    date_default_timezone_set("America/Bahia");
  }
  public function index()
  {
    $this->page['titulo'] = "Início";
    $this->page['css'] = $this->load->view("home/css", $this->data, true);
    $this->page['js'] = $this->load->view("home/js", $this->data, true);
    $this->page['content'] = $this->load->view("home/index", $this->data, true);
    $this->load->view('default/template', array('page' => $this->page));
  }

  public function sobre()
  {
    $this->page['titulo'] = "Sobre";
    $this->page['css'] = $this->load->view("sobre/css", $this->data, true);
    $this->page['js'] = $this->load->view("sobre/js", $this->data, true);
    $this->page['content'] = $this->load->view("sobre/index", $this->data, true);
    $this->load->view('default/template', array('page' => $this->page));
  }

  public function dashboard()
  {
    $this->page['titulo'] = "Dashboard";
    $this->page['css'] = $this->load->view("dashboard/css", $this->data, true);
    $this->page['js'] = $this->load->view("dashboard/js", $this->data, true);
    $this->page['content'] = $this->load->view("dashboard/index", $this->data, true);
    $this->load->view('default/template', array('page' => $this->page));
  }



  private function get_input($name)
  {
    $input = $this->input->post($name);
    $input = isset($input) ? $input : '';
    return addslashes($input);
  }

}
