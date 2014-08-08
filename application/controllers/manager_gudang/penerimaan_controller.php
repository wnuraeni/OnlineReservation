<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if ( !defined('BASEPATH')) exit ('No direct script access.');


 class penerimaan_controller extends CI_Controller{
     function __construct(){
         parent:: __construct();
         $this->load->model('pemesanan_model','',TRUE);
         $this->load->model('inventori_model','',TRUE);
     }

   function index(){
    $data['title']='Data Pemesanan&Penerimaan Barang';
    $data['pemesanan']=$this->pemesanan_model->ambil_barang();
    $data['content']='manager_gudang/penerimaan';
    $this->load->view('manager_gudang/template_admin',$data);
   }

   function terima_barang($id_request_pembelian){
   if($this->input->post()){
       $store2db=array('tanggal_terima'=>$this->input->post('tanggal_penerimaan'),'id_karyawan'=>$this->input->post('id_karyawan'),
                        'bukti_penerimaan'=>$this->input->post('bukti_penerimaan'),'keterangan'=>$this->input->post('keterangan'));
       $store2db2=array('jumlah_barang'=>'`jumlah_barang`+'.$this->input->post('jumlah_barang'),'tanggal_pembelian'=>$this->input->post('tanggal_penerimaan'));
       $id_barang_inventori=$this->input->post('id_inventori_barang');
     if($this->pemesanan_model->terima_barang($id_request_pembelian,$store2db,$id_barang_inventori,$store2db2)== true){
         $get_barang=$this->pemesanan_model->ambil_barang($id_request_pembelian);
         $store2db3=array('nama_barang'=>$get_barang[0]->nama_barang,'merek_barang'=>$get_barang[0]->merek_barang,'tanggal_pembelian'=>$get_barang[0]->tanggal_terima,
                          'jumlah_barang'=>$get_barang[0]->jumlah_barang);
         $id_barang2=$this->inventori_model->tambah($store2db3);
         $this->pemesanan_model->update_request_pembelian(array('id_barang_inventori'=>$id_barang2),$id_request_pembelian);
         if(!empty($get_barang[0]->option_request_barang)){
             $store2db4=array('id_barang_inventori'=>$id_barang2,'nilai_option'=>$get_barang[0]->option_request_barang);
         }
         if(!empty($store2db4)){
             $this->inventori_model->tambah_option2($store2db4);
         }
         $this->session->set_flashdata('message','Status barang berhasil dirubah');
         redirect(base_url().'manager_gudang/penerimaan_controller');
     } else {
          $this->session->set_flashdata('message','Ada kesalahan');
          redirect(base_url().'manager_gudang/penerimaan_controller');
     }
   }
      $data['id_request_pembelian']=$id_request_pembelian;
      $data['pemesanan']=$this->pemesanan_model->ambil_barang($id_request_pembelian);
      $data['content']='manager_gudang/penerimaan';
      $this->load->view('manager_gudang/template_admin',$data);
      
   }

   function history($offset=null){
    $where=null;
     if($this->input->post()){
         $keyword=$this->input->post('keyword');
         $categori=$this->input->post('categori');
         $like=array($categori=>$keyword);
     }else{
         $like=null;
     }
       $config['base_url']=base_url().'manager_gudang/penerimaan_controller/history/';
       $config['total_rows']=$this->pemesanan_model->ambil_total_pesanan();
       $config['per_page']=10;
       $config['uri_segment']=4;
       $config['use_page_numbers']=TRUE;
       $this->pagination->initialize($config);
       if($offset != NULL){
           $offset=($offset-1)*10;
       }else {
           $offset=$offset;
       }
    $data['title']='History Pemesanan Barang';
    $data['pemesanan']=$this->pemesanan_model->ambil_history($where,$like,10,$offset);
    $data['content']='manager_gudang/history_penerimaan';
    $this->load->view('manager_gudang/template_admin',$data);

   }
 }
?>
