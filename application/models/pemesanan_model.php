<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//if ( !defined('BASEPATH')) exit ('No direct script access.');

 class pemesanan_model extends CI_Model{
    function __construct(){
        parent :: __construct();
   }

 function pesan_barang($data){
   if ($this->db->insert_batch('request_pembelian',$data)){
       return true;
   } else{
       return false;
   } 
 }

function ambil_barang($id_request_pembelian = null){
   $this->db->select('*');
   $this->db->from('request_pembelian');
   $this->db->join('penerimaan','request_pembelian.id_penerimaan = penerimaan.id_penerimaan','left');
   $this->db->join('pembelian','request_pembelian.id_pembelian = pembelian.id_pembelian','left');
   //$this->db->where('request_pembelian.status','request');
   $this->db->or_where('request_pembelian.status','dibeli');
   if(!empty($id_request_pembelian)){
        $this->db->or_where('id_request_pembelian',$id_request_pembelian);
   }
   $query= $this->db->get();
   return $query->result();
}
 function terima_barang($id_request_pembelian,$data,$id_barang_inventori,$data2){
     $this->db->insert('penerimaan',$data);
     $id_penerimaan=$this->db->insert_id();
     $this->db->where('id_request_pembelian',$id_request_pembelian);
     if($this->db->update('request_pembelian',array('status'=>'telah diterima','keterangan'=>$data['keterangan'],
                          'id_penerimaan'=>$id_penerimaan))){
        //$this->db->where('id_barang_inventori',$id_barang_inventori);
        //$this->db->update('barang_inventori',$data2);
        //$this->db->query("update barang_inventori set jumlah_barang = jumlah_barang + ".$data2['jumlah_barang'].",
                        // `tanggal_pembelian`='".$data2['tanggal_pembelian']."' where `id_barang_inventori`= '".$id_barang_inventori."'");

        //$this->db->insert('barang_inventori',$data);
        return true;
     }else {
         return false;
     }
     
 }

 function ambil_history($where=null,$like=null,$limit=null,$offset=null){
     $this->db->select('*');
     $this->db->from('request_pembelian');
     $this->db->join('penerimaan','request_pembelian.id_penerimaan = penerimaan.id_penerimaan','left');
     $this->db->join('pembelian','request_pembelian.id_pembelian = pembelian.id_pembelian','left');
     $this->db->join('supplier','request_pembelian.id_supplier = supplier.id_supplier','left');
     
    if($like != null){
           $this->db->like($like);
       }
       if($where != null){
           $this->db->where($where);
       }
       if($limit!=null && $offset!= null){
           $this->db->limit($limit,$offset);
       }
       $this->db->order_by('penerimaan.id_penerimaan','asc');
     $query=$this->db->get();
     return $query->result();

 }

function ambil_total_pesanan($like=null){
   $this->db->select('*');
    $this->db->from('request_pembelian');
     $this->db->join('penerimaan','request_pembelian.id_penerimaan = penerimaan.id_penerimaan','left');
     $this->db->join('pembelian','request_pembelian.id_pembelian = pembelian.id_pembelian','left');
    if(!empty ($like)){
        $this->db->like($like);
    }
    $query=$this->db->get();
    return $query->num_rows();

}


function update_request_pembelian($data,$id){
    $this->db->where('id_request_pembelian',$id);
    $this->db->update('request_pembelian',$data);
}

function ambil_total_pembelian($where=null,$like=null){
    $this->db->select('*');
    $this->db->from('pembelian');
    if(!empty($where)){
        $this->db->where($where);
    }
    if(!empty($like)){
        $this->db->like($like);
    }
    $query=$this->db->get();
    return $query->num_rows();

}

function ambil_pembelian($awal=null,$akhir=null,$where=null){
    $this->db->select('*');
    $this->db->from('pembelian');
    if(!empty($awal)&& !empty($akhir)){
        $this->db->where("tanggal_pembelian between $awal and $akhir");

    }
    if(!empty($where)){
        $this->db->where($where);
    }
    $query=$this->db->get();
    return $query->result();
}

 }





?>
