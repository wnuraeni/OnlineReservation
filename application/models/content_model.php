<?php

//if ( !defined('BASEPATH')) exit ('No direct script access.');

class content_model extends CI_Model{
    function __construct(){
        parent :: __construct();

    }

function save_home($data){
    $query=$this->db->get_where('webcontent',array('kategori'=>'home'));
    if($query->num_rows==0){
        $this->db->insert('webcontent',$data);

    }else {
        $this->db->where('kategori','home');
        $this->db->update('webcontent',$data);
    }
}

function get_home(){
   $query=$this->db->get_where('webcontent',array('kategori'=>'home'));
   return $query->row();

}

function get_mission(){
    $query=$this->db->get_where('webcontent',array('kategori'=>'mission'));
   return $query->row();

}


function save_mission($data){
     $query=$this->db->get_where('webcontent',array('kategori'=>'mission'));
    if($query->num_rows==0){
        $this->db->insert('webcontent',$data);

    }else {
        $this->db->where('kategori','mission');
        $this->db->update('webcontent',$data);
    }
}


function get_contact_us(){
     $query=$this->db->get_where('webcontent',array('kategori'=>'contact_us'));
   return $query->row();
}

function save_contact_us($data){
    $query=$this->db->get_where('webcontent',array('kategori'=>'contact_us'));
    if($query->num_rows==0){
        $this->db->insert('webcontent',$data);

    }else {
        $this->db->where('kategori','contact_us');
        $this->db->update('webcontent',$data);
    }
}

function get_membership(){
     $query=$this->db->get_where('webcontent',array('kategori'=>'membership'));
   return $query->row();
}

function save_membership($data){
    $query=$this->db->get_where('webcontent',array('kategori'=>'membership'));
    if($query->num_rows==0){
        $this->db->insert('webcontent',$data);

    }else {
        $this->db->where('kategori','membership');
        $this->db->update('webcontent',$data);
    }
}

function tambah_news($data){
    $this->db->insert('news',$data);


}

function ubah_news($id_news,$data){
   $this->db->where('id_news',$id_news);
   $this->db->update('news',$data);

}

function hapus_news($id_news){
     $this->db->where('id_news',$id_news);
     $this->db->delete('news');
}

function ambil_news($where=null,$limit=5,$offset=0){
    $this->db->select('*');
    $this->db->from('news');
    if(!empty($where)){
        $this->db->where($where);

    }
    $this->db->order_by('tanggal_dibuat','desc');
    $this->db->limit($limit,$offset);
    $query=$this->db->get();
    return $query->result();

}

function ambil_total_news(){
    $query=$this->db->get('news');
    return $query->num_rows();

}

function ambil_gambar($where=null,$limit=6,$offset=0){
    $this->db->select('*');
    $this->db->from('gambar');
    if(!empty($where)){
        $this->db->where($where);
    }
      $this->db->limit($limit,$offset);
        $query=$this->db->get();
        return $query->result();
}

function ambil_total_gambar(){
 $query=$this->db->get('gambar');
 return $query->num_rows();
}

function simpan_gambar($data){
    $this->db->insert('gambar',$data);

}

function ubah_gambar($where=null,$data=null){
    $this->db->where($where);
    $this->db->update('gambar',$data);

}

function hapus_gambar($id_gambar=null){
    $this->db->delete('gambar',array('id_gambar'=>$id_gambar));

}

function ambil_promo(){
    $this->db->select('*');
    $this->db->from('promo');
    $this->db->where(array('periode_awal <= '=>date('Y-m-d'),'periode_akhir >= '=>date('Y-m-d')));
    $query=$this->db->get();
    return $query->result();


}
function save_konfirmasi_pembayaran($data){
	$query = $this->db->insert('pembayaran',$data);
	$this->db->where('id_booking',$data['id_booking']);
        $konfirmasi = '';
        if($data['keterangan_pbyr'] == 'pembayaran dp1'){
            $konfirmasi = 'pembayaran dp1 tunggu konfirmasi';
        }else{
            $konfirmasi = 'tunggu konfirmasi';
        }
        $query2 = $this->db->update('booking',array(
            'status_pembayaran'=>$konfirmasi,
            'tanggal_pembayaran'=>$data['tanggal_pbyr']));
	if($query && $query2){
		return TRUE;
	}
	else{
		return FALSE;
	}
	}

}
?>
