<?php

//if ( !defined('BASEPATH')) exit ('No direct script access.');

class pembelian_model extends CI_Model{
    function __construct(){
        parent :: __construct();
    }


function ambil_pembelian($awal=null,$akhir=null,$where=null,$like=null,$sortby='id_pembelian',$sortorder='asc',$limit=30,$offset=0){
       //$query=$this->db->get_where('barang_inventori',$data);
       $this->db->select('*');
       $this->db->from('pembelian');
       $this->db->join('karyawan','pembelian.id_karyawan=karyawan.id_karyawan','left');
       if($like != null){
           $this->db->like($like);
       }
       if($where != null){
           $this->db->where($where);
       }
       //$this->db->join('request_pembelian','request_pembelian.id_pembelian=pembelian.id_pembelian');
       $this->db->order_by($sortby,$sortorder);
       //if($limit!=null && $offset!= null){
           $this->db->limit($limit,$offset);
      // }
       $query=$this->db->get();
       return $query->result();

   }

 function ambil_total_pembelian(){
    $query=$this->db->get('pembelian');
     return $query->num_rows();
 }

 function ambil_request_pembelian($where=null){
     $this->db->select('*');
     $this->db->from('request_pembelian');
     $this->db->join('supplier','request_pembelian.id_supplier=supplier.id_supplier');
     if(!empty($where)){
         $this->db->where($where);
     }else {
         $this->db->where('request_pembelian.status','request');

     }
     $query=$this->db->get();
     return $query->result();

 }

 function update_request_pembelian($id_request_pembelian=null,$data=null){
     $this->db->where('id_request_pembelian',$id_request_pembelian);
     $this->db->update('request_pembelian',$data);
     
 }

 function tambah_pembelian($data){
     $this->db->insert('pembelian',$data);
     return $this->db->insert_id();
     
 }

function ambil_harga_barang($where=null){
    $this->db->select('request_pembelian.tanggal_pembelian,request_pembelian.nama_barang,request_pembelian.id_barang_inventori,request_pembelian.merek_barang,
                         request_pembelian.jumlah_barang,request_pembelian.harga_satuan,request_pembelian.total_harga,barang_inventori.harga_sewa');
    $this->db->from('request_pembelian');
    $this->db->join('barang_inventori','request_pembelian.id_barang_inventori=barang_inventori.id_barang_inventori','left');
    $this->db->join('categori_barang','barang_inventori.id_categori_barang=categori_barang.id_categori_barang','left');
    if(!empty($where)){
        $this->db->where($where);
    }
    $query=$this->db->get();
   
    return $query->result();

}

function ubah_harga_sewa($id_barang_inventori,$data){
    $this->db->where('id_barang_inventori',$id_barang_inventori);
    $this->db->update('request_pembelian',$data);
    

}

function ambil_pengeluaran($awal=null,$akhir=null){
    $this->db->select('tanggal_pembelian as tanggal,nama_barang as nama,jumlah_barang as jumlah,total_harga as harga');
    $this->db->from('request_pembelian');
    $this->db->where('status','dibeli');
    if(!empty($awal) && !empty($akhir)){
        $this->db->where("tanggal_pembelian between '$awal' and '$akhir' ");

    }else {
        $this->db->where('Year(tanggal_pembelian)',date('Y'));

    }
    $this->db->group_by('Month(tanggal_pembelian)');
    $this->db->order_by('tanggal_pembelian','asc');
    $query=$this->db->get();
    $pembelian=$query->result();
    $new_pembelian=array();
    $i=0;
   // print_r($pembelian);
    foreach($pembelian as $pem){
        $new_pembelian[$i]['tanggal']=$pem->tanggal;
        $new_pembelian[$i]['nama']='pembelian '.$pem->nama;
        $new_pembelian[$i]['jumlah']=$pem->jumlah;
        $new_pembelian[$i]['harga']=$pem->harga;
        $i++;
    }
    //print_r($new_pembelian);
//*-------------------------------------------------------------------------*//
    $this->db->select('barang_rusak.tanggal_perbaikan as tanggal,barang_inventori.nama_barang as nama,
                       barang_rusak.jumlah as jumlah,barang_rusak.harga_perbaikan as harga');
    $this->db->from('barang_rusak');
     $this->db->join('barang_inventori','barang_rusak.id_barang_inventori=barang_inventori.id_barang_inventori');
    if(!empty($awal) && !empty($akhir)){
        $this->db->where("tanggal_perbaikan between '$awal' and '$akhir' ");

    }else {
        $this->db->where('Year(tanggal_perbaikan)',date('Y'));

    }

    $this->db->order_by('tanggal_perbaikan','asc');
    $query2=$this->db->get();
    $perbaikan=$query2->result();
    $new_array=array();
    $i=0;
    foreach($perbaikan as $per){
         $new_array[$i]['tanggal']=$per->tanggal;
         $new_array[$i]['nama']='pembelian '.$per->nama;
         $new_array[$i]['jumlah']=$per->jumlah;
         $new_array[$i]['harga']=$per->harga;
         $i++;
    }
    $pengeluaran=array_merge($new_pembelian,$new_array);
    usort($pengeluaran,array($this,'custom_sort'));
    $permonth=array();
    $i=0;
    foreach($pengeluaran as $p){
        $permonth[date('m',strtotime($p['tanggal']))][]=$pengeluaran[$i];
        $i++;
    }
   return $permonth;

}

function custom_sort($a,$b){
    if($a['tanggal'] > $b['tanggal']){
        return 1;
    }else if($a['tanggal'] == $b['tanggal']){
        return 0;

    }else {
        return -1;

    }

}


}


?>
