<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 if ( !defined('BASEPATH')) exit ('No direct script access.');


 class member_controller extends CI_Controller{
     function __construct(){
         parent:: __construct();
         $this->load->model('member_model','',TRUE);
     }

     function index ($offset=NULL){
        if($this->input->post('search')){
            $like=array($this->input->post('category')=>$this->input->post('keyword'));
        }else {
            $like=null;
        }

       $config['base_url']=base_url().'admin/member_controller/index';
       $config['total_rows']=$this->member_model->ambil_total_member($like);
       $config['per_page']=6;
       $config['uri_segment']=4;
       $config['use_page_numbers']=TRUE;
       $this->pagination->initialize($config);
       if($offset != NULL){
           $offset=($offset-1)*6;
       }else {
           $offset=$offset;
       }
       $data['title']='Data Member';
       $data ['content'] ='admin/list_member';
       $data['member']=$this->member_model->ambil_member(null,$like,6,$offset);
       $this->load->view('admin/template_admin',$data);
     }


   function delete_member($id_user){
      if($this->member_model->delete_member($id_user)== TRUE){
          $this->session->set_flashdata('message','data berhasil dihapus');
          redirect (base_url().'admin/member_controller');
      }else {
       $this->session->set_flashdata('message','data gagal dihapus');
       redirect (base_url().'admin/member_controller');
   }
 }

   function ubah_member($id_member){
       //proses update data
       if($this->input->post()){
          $nama_pelanggan=$this->input->post('nama_pelanggan');
          $alamat_pelanggan=$this->input->post('alamat_pelanggan');
          $telp_pelanggan=$this->input->post('telp_pelanggan');
          $store2db=array('nama_pelanggan'=>$nama_pelanggan,'alamat_pelanggan'=>$alamat_pelanggan,'telepon_pelanggan'=>$telp_pelanggan);
          if($this->member_model->ubah_member($id_member,$store2db)== true){
               $this->session->set_flashdata('message','data berhasil dirubah');
               redirect (base_url().'admin/member_controller');
          }else{
               $this->session->set_flashdata('message','data gagal dirubah');
               redirect (base_url().'admin/member_controller');

          }
       }
       //ambil data lapangan berdasarkan id dari model
       $data['title']='Ubah Member';
       $data['id_member']=$id_member;
       $data['member']= $this->member_model->ambil_member(array('id_member'=>$id_member));
       $data['content']='admin/form_member';
       $this->load->view('admin/template_admin',$data);
       //tampilkan di view
   }
 }

?>
