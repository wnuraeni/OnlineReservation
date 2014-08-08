<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

 if ( !defined('BASEPATH')) exit ('No direct script access.');

 class pembelian_controller extends CI_Controller{
    function __construct(){
        parent :: __construct();
         $this->load->model('pemesanan_model','',TRUE);
         $this->load->model('pembelian_model','',TRUE);
   }

 function index ($id_pembelian=null,$sortby='request_pembelian.nama_barang',$sortorder='asc',$offset=NULL){
        $awal=null;
        $akhir=null;
        if($this->input->post('periode')){
            $like=array($this->input->post('kategori')=>$this->input->post('keyword'));
            $awal=$this->input->post('awal');
            $akhir=$this->input->post('akhir');
        }else {
            $like=null;
        }
       if(!empty($id_pembelian)){
           $data['details']=$this->pembelian_model->ambil_request_pembelian(array('request_pembelian.id_pembelian'=>$id_pembelian));
       }else {
          $data['pembelian']=$this->pembelian_model->ambil_pembelian($awal,$akhir);
       }
       $where=null;
       
       $config['base_url']=base_url().'manager_keuangan/pembelian_controller/index/'.$sortby.'/'.$sortorder.'/';
       $config['total_rows']=$this->pemesanan_model->ambil_total_pembelian($where,$like);
       $config['per_page']=10;
       $config['uri_segment']=6;
       $config['use_page_numbers']=TRUE;
       $this->pagination->initialize($config);
       if($offset != NULL){
           $offset=($offset-1)*10;
       }else {
           $offset=$offset;
       }
       $data['title']='Daftar Pembelian';
       $data ['content'] ='manager_keuangan/list_pembelian';
       
       $this->load->view('manager_keuangan/template_admin',$data);
     }

function request_barang(){
    $data['request']=$this->pembelian_model->ambil_request_pembelian(array('request_pembelian.status'=>'request'));
    $data['title']='Daftar Pemesanan Barang';
    $data['content']='manager_keuangan/list_request';
    $this->load->view('manager_keuangan/template_admin',$data);

}

function beli(){
    if($this->input->post('submit')){
        $id_barangs=$this->input->post('id_barang');
        $datafromdb=array();
        foreach ($id_barangs as $id){
            $datafromdb=$this->pembelian_model->ambil_request_pembelian(array('id_request_pembelian'=>$id));
            $cart=array('id'=>$datafromdb[0]->id_request_pembelian,'name'=>$datafromdb[0]->nama_barang,'qty'=>$datafromdb[0]->jumlah_barang,
                        'price'=>$datafromdb[0]->harga_satuan,'options'=>array('id_supplier'=>$datafromdb[0]->id_supplier,
                         'merek_barang'=>$datafromdb[0]->merek_barang,'nama_supplier'=>$datafromdb[0]->nama,
                         'tanggal_request'=>$datafromdb[0]->tanggal_pembelian,'status'=>'dibeli'));
            $this->cart->insert($cart);

        }
        $store2db=array('tanggal_pembelian'=>date('Y-m-d'),'total_harga_pembelian'=>$this->cart->total(),
                        'id_karyawan'=>$this->session->userdata('idmanager_keuangan'));
        $id_pembelian=$this->pembelian_model->tambah_pembelian($store2db);
        foreach($this->cart->contents()as $cart2db){
            $this->pembelian_model->update_request_pembelian($cart2db['id'],array('tanggal_pembelian'=>date('Y-m-d'),
                   'id_pembelian'=>$id_pembelian,'status'=>'dibeli'));
        }
        redirect (base_url().'manager_keuangan/pembelian_controller/konfirmasi_beli');
    }
}



  function konfirmasi_beli(){
      $data['barang']=$this->cart->contents();
      $data['title']='Daftar Pembelian Barang';
      $data['content']='manager_keuangan/konfirmasi_pembelian';
      $this->load->view('manager_keuangan/template_admin',$data);
      $this->cart->destroy();

  }







 }


?>
