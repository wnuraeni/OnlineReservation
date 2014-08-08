<?php
if ( !defined('BASEPATH')) exit ('No direct script access.');


 class main_login extends CI_Controller {

         function __construct (){
             parent :: __construct();
             $this->load->model('login_model','',TRUE);
             $this->load->model('user_model','',TRUE);
             $this->load->model('member_model','',TRUE);
             $this->load->model('karyawan_model','',TRUE);

         }

        function index (){
            //kl sudah login ke view admin kl blm ke view login
            
           $this->load->view('admin/login_view');
        }

   function register(){
       $this->form_validation->set_rules('user_name','Username','required|xss_clean|callback_cekusername');
            $this->form_validation->set_rules('password','Password','required|xss_clean');
            $this->form_validation->set_rules('nama','nama','required|xss_clean');
            $this->form_validation->set_rules('alamat','alamat','required|xss_clean');
            $this->form_validation->set_rules('telepon','telepon','required|xss_clean');
            $this->form_validation->set_rules('email','email','required|xss_clean|callback_cekemail');
            $this->form_validation->set_rules('jabatan','jabatan','required|xss_clean');

           //cek validasi
     if ($this->form_validation->run()==TRUE){
                //data valid
       $nama =$this->input->post('nama');
       $user_name=$this->input->post('user_name');
       $password= md5($this->input->post('password'));
       $alamat=$this->input->post('alamat');
       $kota=$this->input->post('kota');
       $telepon=$this->input->post('telepon');
       $email=$this->input->post('email');
       $jabatan=$this->input->post('jabatan');
       $store2db=array('nama'=>$nama,
       'user_name' =>$user_name,
       'password'=>$password,
       'email'=>$email,
       'jabatan'=>$jabatan);

      if($user_id=$this->user_model->tambah($store2db)){
          $store2db2=array('user_id'=>$user_id,'nama_karyawan'=>$nama,'alamat_karyawan'=>$alamat,
                         'kota'=>$kota,'jabatan_karyawan'=>$jabatan,'telepon'=>$telepon);
          $this->karyawan_model->tambah_karyawan($store2db2);
          $this->session->set_flashdata('message','data berhasil ditambah');
          redirect (base_url().'admin/main_login');
      }else {
          $this->session->set_flashdata('message','data gagal ditambah');
          redirect (base_url().'admin/main_login');
      }
    }
       $this->load->view('admin/register');

   }


  function cekusername($username){

    if($this->member_model->cekusername($username)){
        $this->form_validation->set_message('cekusername','username'.$username.'sudah ada');
        return false;
    }else {
        return true;
    }
}

function cekemail($email){
    if($this->member_model->cekemail($email)){
        $this->form_validation->set_message('cekemail','email'.$email.'sudah ada');
        return false;
    }else {
        return true;
    }
}

function reset_password(){
     $this->form_validation->set_rules('email','email','required|xss_clean|cekemail2');
            $this->form_validation->set_rules('password','Password','required|xss_clean');

           //cek validasi
            if ($this->form_validation->run()==TRUE){
                //data valid
              $email=$this->input->post('email');
              $password=$this->input->post('password');
                //cek database apakah password dan username nya ada apa enga
                if($this->user_model->reset_password($email,$password) == TRUE){
                    $this->session->set_flashdata('message','<span class="success"> password berhasil diubah </span>');
                     redirect(base_url().'admin/main_login');
                }else {
                //data tidak ada
                    $this->session->set_flashdata('message','<span class="error"> password gagal diubah </span>');
                    redirect(base_url().'admin');
                }
           }else {
               //data tidak valid
              $this->load->view('admin/form_reset_password');

           }


}

function cekemail2($email){
    if($this->member_model->cekemail($email)){

        return true;
    }else {
        $this->form_validation->set_message('cekemail2','email'.$email.'tidak terdaftar');
        return false;
    }
}
 }

?>
