<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 if ( !defined('BASEPATH')) exit ('No direct script access.');


 class lapangan extends CI_Controller{
     function __construct(){
         parent:: __construct();
         $this->load->model('lapangan_model','',TRUE);
     }

     function index (){
       $data['title']='Lapangan';
       $data ['content'] ='admin/list_lapangan';
       $data['basket']=$this->lapangan_model->ambil_lapangan(array('jenis_lapangan'=>'basket'));
       $data['tenis']=$this->lapangan_model->ambil_lapangan(array('jenis_lapangan'=>'tenis'));
       $data['voli']=$this->lapangan_model->ambil_lapangan(array('jenis_lapangan'=>'voli'));
       $data['badminton']=$this->lapangan_model->ambil_lapangan(array('jenis_lapangan'=>'badminton'));
       $data['futsal']=$this->lapangan_model->ambil_lapangan(array('jenis_lapangan'=>'futsal'));
       $this->load->view('admin/template_admin',$data);
     }

   function tambah($jenis_lapangan=null){
       $this->form_validation->set_rules('nama_lapangan','nama_lapangan','required|xss_clean|callback_ceklapangan');
       if($this->form_validation->run()== TRUE){
       $jenis =$this->input->post('jenis_lapangan');
       $nama_lapangan=$this->input->post('nama_lapangan');
       $harga_sewa=$this->input->post('harga_sewa');
       //$keterangan=$this->input->post('keterangan');
       $store2db=array('nama_lapangan'=>$nama_lapangan,
       'sewa_lapangan' =>$harga_sewa,
       'jenis_lapangan'=>$jenis );
            if($this->lapangan_model->tambah($store2db)==TRUE){
                $this->session->set_flashdata('message','data berhasil ditambah');
                redirect (base_url().'admin/lapangan');
            }else {
                $this->session->set_flashdata('message','data gagal ditambah');
                redirect (base_url().'admin/lapangan');  
            }
       }
       $data['title']='Tambah Lapangan';
       $data['jenis']= $jenis_lapangan;
       $data['content']='admin/form_lapangan';
       $this->load->view('admin/template_admin',$data);
    }

   function proses_tambah(){
       $this->form_validation->set_rules('nama_lapangan','nama_lapangan','required|xss_clean|callback_ceklapangan');
      if($this->form_validation->run()== TRUE){
       $jenis =$this->input->post('jenis_lapangan');
       $nama_lapangan=$this->input->post('nama_lapangan');
       $harga_sewa=$this->input->post('harga_sewa');
       //$keterangan=$this->input->post('keterangan');
       $store2db=array('nama_lapangan'=>$nama_lapangan,
       'sewa_lapangan' =>$harga_sewa,
       'jenis_lapangan'=>$jenis );
      if($this->lapangan_model->tambah($store2db)==TRUE){
          $this->session->set_flashdata('message','data berhasil ditambah');
          redirect (base_url().'admin/lapangan');
      }else {
          $this->session->set_flashdata('message','data gagal ditambah');
          redirect (base_url().'admin/lapangan');  
      }
      }else {
          $data['title']='Tambah Lapangan';
          $data['jenis']= $jenis_lapangan;
          $data['content']='admin/form_lapangan';
          $this->load->view('admin/template_admin',$data);
      }
   }

   function delete_lapangan($id_lapangan){
      if($this->lapangan_model->delete_lapangan($id_lapangan)== TRUE){
          $this->session->set_flashdata('message','data berhasil dihapus');
          redirect (base_url().'admin/lapangan');
      }else {
       $this->session->set_flashdata('message','data gagal dihapus');
       redirect (base_url().'admin/lapangan');
   }
 }

   function edit_lapangan($id_lapangan){
       //proses update data
    $this->form_validation->set_rules('nama_lapangan','nama_lapangan','required|xss_clean|callback_ceklapangan');
      if($this->form_validation->run()== TRUE){
       if($this->input->post()){
          $nama_lapangan=$this->input->post('nama_lapangan');
          $harga_sewa=$this->input->post('harga_sewa');
          //$keterangan=$this->input->post('keterangan');
          $jenis_lapangan=$this->input->post('jenis_lapangan');
          $store2db=array('nama_lapangan'=>$nama_lapangan,'sewa_lapangan'=>$harga_sewa,'jenis_lapangan'=>$jenis_lapangan);
          if($this->lapangan_model->ubah_lapangan($id_lapangan,$store2db)== true){
               $this->session->set_flashdata('message','data berhasil dirubah');
               redirect (base_url().'admin/lapangan');
          }else{
               $this->session->set_flashdata('message','data gagal dirubah');
               redirect (base_url().'admin/lapangan');

          }
       }
     }
       //ambil data lapangan berdasarkan id dari model
        $lapangan=$this->lapangan_model->ambil_lapangan(array('id_lapangan'=>$id_lapangan));
        $data['title']='Ubah Lapangan';
       $data['id_lapangan']=$id_lapangan;
       $data['lapangan']= $lapangan;
       $data['jenis']=$lapangan[0]->jenis_lapangan;
       $data['content']='admin/form_lapangan';
       $this->load->view('admin/template_admin',$data);
       //tampilkan di view


   }

   function ceklapangan($lapangan){
         if($this->lapangan_model->ceklapangan($lapangan)){
           $this->form_validation->set_message('ceklapangan','nama_lapangan'.$lapangan.'sudah ada');
        return false;
    }else {
        return true;
    }

   }
 }

?>
