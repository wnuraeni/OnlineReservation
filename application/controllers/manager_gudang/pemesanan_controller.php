<?php

 if ( !defined('BASEPATH')) exit ('No direct script access.');

 class pemesanan_controller extends CI_Controller{
    function __construct(){
        parent :: __construct();
        //$this->load->model('pemesanan_model','',TRUE);
        $this->load->model('supplier_model','',TRUE);
        $this->load->model('inventori_model','',TRUE);
         $this->load->model('pemesanan_model','',TRUE);
   }

 function index(){
  $this->session->set_userdata('idpemesanan',1);
   if($this->input->post('submit')){
       $option_request_barang=$this->input->post('option_request_barang');
       $supplier=$this->input->post('supplier');
       $supplier=explode('-',$supplier);
       $id_supplier=$supplier[1];
       $nama_supplier=$supplier[0];
       $id_karyawan=$this->session->userdata('idmanager_gudang');
       $nama_barang=$this->input->post('nama_barang');
       $tipe_barang=$this->input->post('tipe');
       $merek_barang=$this->input->post('merek_barang');
       $jumlah_barang=$this->input->post('jumlah_barang');
       $harga_satuan=$this->input->post('harga_satuan');
       $session=$this->session->userdata('idpemesanan');
       if(!empty($session)){
          $session++;
       }
       $data=array('id'=>$session,'name'=>$nama_barang,'qty'=>$jumlah_barang,'price'=>$harga_satuan
           ,'options'=>array('supplier'=>$nama_supplier,'id_supplier'=>$id_supplier,'id_karyawan'=>$id_karyawan,'merek_barang'=>$merek_barang,'option_request_barang'=>$option_request_barang));
       $this->cart->insert($data);
       redirect (base_url().'manager_gudang/pemesanan_controller');

   }
   //$data['tipe_barang']=$this->inventori_model->ambil_tipe_barang();
   $penyalur=$this->supplier_model->ambil_supplier();
   $data['penyalur']=$penyalur;
   $data['title']='Pemesanan Barang';
   $data['content']='manager_gudang/form_pemesanan';
   $this->load->view('manager_gudang/template_admin',$data);

 }

function delete_barang($id){
    $data=array('rowid'=>$id,'qty'=>0);
    $this->cart->update($data);
   redirect (base_url().'manager_gudang/pemesanan_controller');
}

function pesan_barang(){
    foreach ($this->cart->contents() as $item){
        $store2db[]=array(
                          'id_karyawan'=>$item['options']['id_karyawan'],
                          'id_supplier'=>$item['options']['id_supplier'],
                          'tanggal_pembelian'=>date('Y-m-d'),
                          'nama_barang'=>$item['name'],
                          'option_request_barang'=>$item['options']['option_request_barang'],
                         'merek_barang'=>$item['options']['merek_barang'],
                          'jumlah_barang'=>$item['qty'],
                        'harga_satuan'=>$item['price'],
                        'total_harga'=>$item['subtotal'],
                           'status'=>'request'
                           

     );
    }
   if( $this->pemesanan_model->pesan_barang($store2db)== true){
       $this->session->set_flashdata('message','Barang sudah masuk ke request');
       $this->cart->destroy();
   }else {
        $this->session->set_flashdata('message','Ada kesalahan');
   }
  
   redirect (base_url().'manager_gudang/pemesanan_controller');
}





}

?>
