<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//if ( !defined('BASEPATH')) exit ('No direct script access.');

class pembayaran_model extends CI_Model{
    function __construct(){
        parent :: __construct();
    }

function detail_pembayaran($data){
    $this->db->insert('penyewaan',$data);
    return $this->db->insert_id();
    
}

function ambil_detail_pembayaran($id_penyewaan=null){
    $this->db->select('*');
    $this->db->from('penyewaan');
    $this->db->join('penyewaan_barang','penyewaan_barang.id_penyewaan_lapangan = penyewaan.id_penyewaan_lapangan','left');
    $this->db->join('penyewaan_lapangan','penyewaan_lapangan.id_penyewaan_lapangan=penyewaan.id_penyewaan_lapangan','left');   
    $this->db->join('karyawan','karyawan.user_id=penyewaan.id_karyawan','left');
    $this->db->join('lapangan','lapangan.id_lapangan=penyewaan_lapangan.id_lapangan','left');
    $this->db->join('pelanggan','pelanggan.id_member=penyewaan.id_member');
    $this->db->join('barang_inventori','barang_inventori.id_barang_inventori=penyewaan_barang.id_barang_inventori','left');
    if(!empty($id_penyewaan)){
        $this->db->where('penyewaan.id_penyewaan',$id_penyewaan);

        }
     $query=$this->db->get();
     $this->db->last_query();
     return $query->result();
    }

function ambil_pendapatan($awal,$akhir){
    $this->db->select('booking.tanggal_booking,booking.id_booking, SUM(pembayaran.total_pembayaran) as total_pembayaran');
    $this->db->from('pembayaran');
    $this->db->join('booking','booking.id_booking=pembayaran.id_booking');
    if(!empty($awal) && !empty($akhir)){
        $this->db->where("tanggal_booking between '$awal' and '$akhir'");

    }else {
        $this->db->where('Year(tanggal_booking)',date('Y'));
    }
    $this->db->group_by('pembayaran.id_booking');
    $query=$this->db->get();
    return $query->result();
}
function save_konfirmasi_pembayaran($store2db){
        $query = $this->db->insert('pembayaran',$data);
        $id = $this->db->insert_id();
	$this->db->where('id_booking',$data['id_booking']);
	$query2 = $this->db->update('booking',array('status_pembayaran'=>$data['keterangan_pbyr'],'tanggal_pembayaran'=>$data['tanggal_pbyr']));
	if($query && $query2){
		return $id;
	}
	else{
		return FALSE;
	}
}

}

?>
