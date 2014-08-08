<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 if ( !defined('BASEPATH')) exit ('No direct script access.');


 class karyawan_controller extends CI_Controller{
     function __construct(){
         parent:: __construct();
         $this->load->model('karyawan_model','',TRUE);
     }

     function index ($offset=NULL){
        if($this->input->post('search')){
            $like=array($this->input->post('category')=>$this->input->post('keyword'));
        }else {
            $like=null;
        }

       $config['base_url']=base_url().'admin/karyawan_controller/index';
       $config['total_rows']=$this->karyawan_model->ambil_total_karyawan($like);
       $config['per_page']=6;
       $config['uri_segment']=4;
       $config['use_page_numbers']=TRUE;
       $this->pagination->initialize($config);
       if($offset != NULL){
           $offset=($offset-1)*6;
       }else {
           $offset=$offset;
       }
       $data['title']='Data Karyawan';
       $data ['content'] ='admin/list_karyawan';
       $data['karyawan']=$this->karyawan_model->ambil_karyawan(null,$like,6,$offset);
       $this->load->view('admin/template_admin',$data);
     }


   function delete_karyawan($id_karyawan){
      if($this->karyawan_model->delete_karyawan($id_karyawan)== TRUE){
          $this->session->set_flashdata('message','data berhasil dihapus');
          redirect (base_url().'admin/karyawan_controller');
      }else {
       $this->session->set_flashdata('message','data gagal dihapus');
       redirect (base_url().'admin/karyawan_controller');
   }
 }

   function ubah_karyawan($id_karyawan){
       //proses update data
       if($this->input->post()){
          $nama_karyawan=$this->input->post('nama_karyawan');
          $alamat_karyawan=$this->input->post('alamat_karyawan');
          $kota=$this->input->post('kota');
          $telepon=$this->input->post('telepon');
          $jabatan_karyawan=$this->input->post('jabatan_karyawan');
          $store2db=array('nama_karyawan'=>$nama_karyawan,'alamat_karyawan'=>$alamat_karyawan,'kota'=>$kota,'telepon'=>$telepon);
          if($this->karyawan_model->ubah_karyawan($id_karyawan,$store2db)== true){
               $this->session->set_flashdata('message','data berhasil dirubah');
               redirect (base_url().'admin/karyawan_controller');
          }else{
               $this->session->set_flashdata('message','data gagal dirubah');
               redirect (base_url().'admin/karyawan_controller');

          }
       }
       //ambil data lapangan berdasarkan id dari model
       $data['title']='Ubah Karyawan';
       $data['id_karyawan']=$id_karyawan;
       $data['karyawan']= $this->karyawan_model->ambil_karyawan(array('id_karyawan'=>$id_karyawan));
       $data['content']='admin/form_karyawan';
       $this->load->view('admin/template_admin',$data);
       //tampilkan di view
   }
 }

?>
