<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller
{
  function __construct()
  {
      parent::__construct();
      $this->load->model('data_model');
      if($this->session->userdata('login_form') != "bot-as1563sd1123sfasda2389asff53afhafaf670fa"){
        redirect(base_url('login'));
      }
  }
  
  function index(){ 
        $akses = $this->session->userdata('akses');
        $data = array(
            'title'         => 'Welcome To Dashboard',
            'sess_id'       => $this->session->userdata('id'),
            'sess_nama'     => $this->session->userdata('nama'),
            'sess_user'     => $this->session->userdata('username'),
            'sess_pass'     => $this->session->userdata('password'),
            'sess_akses'    => $akses,
            'showData'      => 'orderUser',
            'navg'          => 'dashboard'
        );
        $this->load->view('part/header', $data);
        $this->load->view('part/left_nav', $data);
        if($akses == "admin"){ 
            $this->load->view('beranda_view', $data); 
        } else {
            // $this->load->view('beranda_view', $data); 
            $this->load->view('pages/dash_kasir', $data); 
        }
        $this->load->view('part/main_js', $data);
  } 
  
  function today(){ 
    $akses = $this->session->userdata('akses');
    $data = array(
        'title'         => 'Welcome To Dashboard',
        'sess_id'       => $this->session->userdata('id'),
        'sess_nama'     => $this->session->userdata('nama'),
        'sess_user'     => $this->session->userdata('username'),
        'sess_pass'     => $this->session->userdata('password'),
        'sess_akses'    => $akses,
        'showData'      => 'orderUser',
        'navg'          => 'dashboard'
    );
    $this->load->view('part/header', $data);
    $this->load->view('part/left_nav', $data);
    if($akses == "admin"){ 
        $this->load->view('beranda_view', $data); 
    } else {
        // $this->load->view('beranda_view', $data); 
        $this->load->view('pages/pesanan_today', $data); 
    }
    $this->load->view('part/main_js', $data);
} 

function selesai(){ 
  $akses = $this->session->userdata('akses');
  $data = array(
      'title'         => 'Welcome To Dashboard',
      'sess_id'       => $this->session->userdata('id'),
      'sess_nama'     => $this->session->userdata('nama'),
      'sess_user'     => $this->session->userdata('username'),
      'sess_pass'     => $this->session->userdata('password'),
      'sess_akses'    => $akses,
      'status'        => 'selesai',
      'showData'      => 'orderUser',
      'navg'          => 'dashboard'
  );
  $this->load->view('part/header', $data);
  $this->load->view('part/left_nav', $data);
  if($akses == "admin"){ 
      $this->load->view('beranda_view', $data); 
  } else {
      // $this->load->view('beranda_view', $data); 
      $this->load->view('pages/pesanan_selesai', $data); 
  }
  $this->load->view('part/main_js', $data);
} //end

  
    
}
?>