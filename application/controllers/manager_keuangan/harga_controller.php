<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

 if ( !defined('BASEPATH')) exit ('No direct script access.');

 class harga_controller extends CI_Controller{
    function __construct(){
        parent :: __construct();
         $this->load->model('pembelian_model','',TRUE);
         $this->load->model('inventori_model','',TRUE);
         $this->load->model('lapangan_model','',TRUE);
   }

   function index($set=null,$id_barang=null){
       if($this->input->post('set_harga')){
           $useful_life=$this->input->post('useful_life');
           $harga_beli=$this->input->post('harga_beli');
           //$salvage_value=$this->input->post('salvage_value');
           $harga_rekomendasi=$harga_beli/$useful_life;
           $id_barang_inventori=$this->input->post('id_barang_inventori');
           $store2db=array('harga_sewa'=>round($harga_rekomendasi,-2));
           $this->inventori_model->ubah_inventori($id_barang_inventori,$store2db);
          
          
       }
       if(!empty($id_barang)){
           $data['barang2']=$this->pembelian_model->ambil_harga_barang(array('request_pembelian.id_barang_inventori'=>$id_barang));

       }
       $data['barang']=$this->pembelian_model->ambil_harga_barang(array('request_pembelian.keterangan'=>'request harga'));
       $data['title']='Daftar Barang Dibeli';
       $data['content']='manager_keuangan/list_keuangan';
       $this->load->view('manager_keuangan/template_admin',$data);
   }

function salvage(){
 $data['kategori']=$this->inventori_model->ambil_kategori(null,array('parent_id !='=>0 ));
 $data['title']='Daftar Salvage Value';
 $data['content']='manager_keuangan/form_salvage';
 $this->load->view('manager_keuangan/template_admin',$data);

}

function ubah_salvage($id_categori_barang=null){
    if($this->input->post('set_salvage')){
        $id_categori_barang=$this->input->post('id_categori_barang');
        $salvage_value=$this->input->post('salvage_value');
        $this->inventori_model->set_salvage_value($id_categori_barang,array('salvage_value'=>$salvage_value));
        redirect (base_url().'manager_keuangan/harga_controller/salvage');
      }
        $data['id_categori_barang']=$id_categori_barang;
        $data['kategori']=$this->inventori_model->ambil_kategori(null,array('parent_id !='=>0));
        $data['title']='Daftar Salvage Value';
        $data['content']='manager_keuangan/form_salvage';
        $this->load->view('manager_keuangan/template_admin',$data);


}

 function lapangan($set=null,$id_lapangan=null){
    if($this->input->post('set_harga')){
           $harga_bangunan=$this->input->post('harga_bangunan');
          
           $harga_rekomendasi=($harga_bangunan-80000000)/20/12/30;
           $id_lapangan=$this->input->post('id_lapangan');
           $store2db=array('sewa_lapangan'=>round($harga_rekomendasi,-3));

           $this->lapangan_model->ubah_lapangan($id_lapangan,$store2db);


       }
       if(!empty($id_lapangan)){
           $data['id_lapangan']=$id_lapangan;

       }
    $data['lapangan']=$this->lapangan_model->ambil_lapangan();
    $data['title']='Harga Lapangan';
    $data['content']='manager_keuangan/form_lapangan';
    $this->load->view('manager_keuangan/template_admin',$data);


 }





 }

 ?>