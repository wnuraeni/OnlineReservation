<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//if ( !defined('BASEPATH')) exit ('No direct script access.');


 class jadwal_controller extends CI_Controller{
     function __construct(){
         parent:: __construct();
         $this->load->model('penyewaan_model','',TRUE);
         $this->load->model('lapangan_model','',TRUE);
     }

  function index($year=null,$month=null){
      $data['title']='Jadwal Kalender';
      $data['kalender']=$this->penyewaan_model->generate_kalender($year,$month);
      $data['content']='kasir/kalender';
      $this->load->view('kasir/template_admin',$data);
  }

 }
?>
