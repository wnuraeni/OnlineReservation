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
          if($this->session->userdata('ismanager_gudang')== TRUE){
                 $this->load->view('manager_gudang/template_admin');
           }else {
               $this->load->view('admin/login_view');
           }
        }

        function proses_login () {
            //set rules untuk validasi
            $this->form_validation->set_rules('username','Username','required|xss_clean');
            $this->form_validation->set_rules('password','Password','required|xss_clean');

           //cek validasi
            if ($this->form_validation->run()==TRUE){
                //data valid
              $username=$this->input->post('username');
              $password=$this->input->post('password');
                //cek database apakah password dan username nya ada apa enga
                if($this->login_model->cek_user($username,$password) == TRUE){
                     $value=$this->login_model->get_jabatan($username,$password);
                     $access=$value->jabatan;
                     $this->session->set_userdata('is'.$access,true);
                     $this->session->set_userdata($access.'name',$username);
                     redirect(base_url().$access);
                }else {
                //data tidak ada
                    $this->session->set_flashdata('message','<span class="error"> username tidak terdaftar </span>');
                    redirect(base_url().'manager_gudang/index');
                }
           }else {
               //data tidak valid
               $this->load->view('admin/login_view');

           }
    }

     function logout(){
        $this->session->unset_userdata('ismanagergudang');
        $this->session->unset_userdata('managergudangname');
        $this->session->unset_userdata('idmanagergudang');
        $this->session->unset_userdata('accessmanagergudang');
        redirect(base_url().'admin');
    }

 }
?>
