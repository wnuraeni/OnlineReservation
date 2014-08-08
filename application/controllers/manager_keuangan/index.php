<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if ( !defined('BASEPATH')) exit ('No direct script access.');


 class index extends CI_Controller {

         function __construct (){
             parent :: __construct();
             $this->load->model('login_model','',TRUE);

         }

        function index (){
            //kl sudah login ke view admin kl blm ke view login
          if($this->session->userdata('ismanager_keuangan')== TRUE){
                 $this->load->view('manager_keuangan/template_admin');
           }else {
               $this->load->view('admin/login_view');
           }
        }


   function logout(){
        $this->session->unset_userdata('ismanagerkeuangan');
        $this->session->unset_userdata('managerkeuanganname');
        $this->session->unset_userdata('idmanagerkeuangan');
         $this->session->unset_userdata('accessmanagerkeuangan');
        redirect(base_url().'admin');
    }

 }
?>
