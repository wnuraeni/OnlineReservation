<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 if ( !defined('BASEPATH')) exit ('No direct script access.');


 class user_controller extends CI_Controller{
     function __construct(){
         parent:: __construct();
         $this->load->model('user_model','',TRUE);
          $this->load->model('member_model','',TRUE);
     }

     function index ($offset=NULL){
        if($this->input->post('search')){
            $like=array($this->input->post('category')=>$this->input->post('keyword'));
        }else {
            $like=null;
        }
      
       $config['base_url']=base_url().'admin/user_controller/index';
       $config['total_rows']=$this->user_model->ambil_total_user($like);
       $config['per_page']=6;
       $config['uri_segment']=4;
       $config['use_page_numbers']=TRUE;
       $this->pagination->initialize($config);
       if($offset != NULL){
           $offset=($offset-1)*6;
       }else {
           $offset=$offset;
       }
       $data['title']='Data User';
       $data ['content'] ='admin/list_user';
       $data['user']=$this->user_model->ambil_user(null,$like,6,$offset);
       $this->load->view('admin/template_admin',$data);
     }

   /*function tambah_user(){
      $this->form_validation->set_rules('user_name','Username','required|xss_clean|callback_cekusername');
            $this->form_validation->set_rules('password','Password','required|xss_clean');
            $this->form_validation->set_rules('nama','nama','required|xss_clean');
            $this->form_validation->set_rules('jabatan','jabatan','required|xss_clean');

           //cek validasi
     if ($this->form_validation->run()==TRUE){
                //data valid
       $nama =$this->input->post('nama');
       $user_name=$this->input->post('user_name');
       $password= md5($this->input->post('password'));
       $jabatan=$this->input->post('jabatan');
       $store2db=array('nama'=>$nama,
       'user_name' =>$user_name,
       'password'=>$password,
       'jabatan'=>$jabatan);
      if($this->user_model->tambah($store2db)==TRUE){
          $this->session->set_flashdata('message','data berhasil ditambah');
          redirect (base_url().'admin/user_controller');
      }else {
          $this->session->set_flashdata('message','data gagal ditambah');
          redirect (base_url().'admin/user_controller');
      }
    }
       $data['title']='Tambah User';
       $data['content']='admin/form_user';
       $this->load->view('admin/template_admin',$data);
    } */


   function delete_user($id_user){
      if($this->user_model->delete_user($id_user)== TRUE){
          $this->session->set_flashdata('message','data berhasil dihapus');
          redirect (base_url().'admin/user_controller');
      }else {
       $this->session->set_flashdata('message','data gagal dihapus');
       redirect (base_url().'admin/user_controller');
   }
 }

   /*function ubah_user($id_user){
       //proses update data
       $this->form_validation->set_rules('user_name','Username','required|xss_clean|callback_cekusername');
        $this->form_validation->set_rules('jabatan','jabatan','required|xss_clean');
       if($this->input->post()){
           if($this->form_validation->run() == TRUE){
          $nama=$this->input->post('nama');
          $user_name=$this->input->post('user_name');
          $jabatan=$this->input->post('jabatan');
          $store2db=array('nama'=>$nama,'user_name'=>$user_name,'jabatan'=>$jabatan);
          if($this->user_model->ubah_user($id_user,$store2db)== true){
               $this->session->set_flashdata('message','data berhasil dirubah');
               redirect (base_url().'admin/user_controller');
          }else{
               $this->session->set_flashdata('message','data gagal dirubah');
               redirect (base_url().'admin/user_controller');

            }
          }
       }
       //ambil data lapangan berdasarkan id dari model
       $data['title']='Ubah User';
       $data['id_user']=$id_user;
       $data['user']= $this->user_model->ambil_user(array('user_id'=>$id_user));
       $data['content']='admin/form_user';
       $this->load->view('admin/template_admin',$data);
       //tampilkan di view


   }*/

   function cekusername($username){

    if($this->member_model->cekusername($username)){
        $this->form_validation->set_message('cekusername','username'.$username.'sudah ada');
        return false;
    }else {
        return true;
    }
}
 }

?>
