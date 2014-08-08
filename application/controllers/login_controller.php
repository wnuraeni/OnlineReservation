<?php

if ( !defined('BASEPATH')) exit ('No direct script access.');


 class login_controller extends CI_Controller {

         function __construct (){
             parent :: __construct();
             $this->load->model('login_model','',TRUE);

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
                    //pengecekan reservasi, klo udah lewat tanggal belum dibayar langsung dibatalin

                     //set session data
                     $value=$this->login_model->get_jabatan($username,$password);
                     $access=$value->jabatan;
                     $this->session->set_userdata('is'.$access,true);
                     $this->session->set_userdata($access.'name',$username);
                     $this->session->set_userdata('id'.$access,$value->user_id);
                     $this->session->set_userdata('access'.$access,$access);
                     redirect(base_url().'index.php/'.$access.'/index');
                }else {
                //data tidak ada
                    $this->session->set_flashdata('message','<span class="error"> username tidak terdaftar </span>');
                    redirect(base_url().'admin');
                }
           }else {
               //data tidak valid
               $this->load->view('admin/login_view');

           }
    }

    function logout(){
        $this->session->unset('is'.$access,true);
        $this->session->unset($access.'name',$username);
        $this->session->unset('id'.$access,$value->user_id);
        $this->session->unset('access',$access);
        redirect(base_url().'admin/index');
    }


    
 }
?>
