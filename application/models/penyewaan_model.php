<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//if ( !defined('BASEPATH')) exit ('No direct script access.');

 class penyewaan_model extends CI_Model{
    function __construct(){
        parent :: __construct();
   }

 function ambil_data_penyewaan($id_penyewaan=null,$where=null,$limit=10,$offset=0){
   $this->db->select('*');
   $this->db->from('penyewaan');
   $this->db->join('penyewaan_lapangan','penyewaan.id_penyewaan_lapangan=penyewaan_lapangan.id_penyewaan_lapangan','left');
   $this->db->join('lapangan','lapangan.id_lapangan=penyewaan_lapangan.id_lapangan','left');
   $this->db->join('penyewaan_barang','penyewaan_lapangan.id_penyewaan_lapangan=penyewaan_barang.id_penyewaan_lapangan','left');
   $this->db->join('pelanggan','pelanggan.id_member=penyewaan.id_member');
   $this->db->where('penyewaan.keterangan !=','selesai');
   if(!empty($id_penyewaan)){
       $this->db->where('penyewaan.id_penyewaan',$id_penyewaan);
   }
   if(!empty($where)){
       $this->db->like($where);

   }
   $this->db->order_by('penyewaan.tanggal_penyewaan','desc');
   $this->db->limit($limit,$offset);
   $query=$this->db->get();
   //echo $this->db->last_query();
   return $query->result();
 }

 function sewa_selesai($id_penyewaan){
   $this->db->select('*');
   $this->db->from('penyewaan');
   $this->db->join('penyewaan_lapangan','penyewaan.id_penyewaan_lapangan=penyewaan_lapangan.id_penyewaan_lapangan');
   $this->db->join('lapangan','lapangan.id_lapangan=penyewaan_lapangan.id_lapangan');
   $this->db->join('penyewaan_barang','penyewaan_lapangan.id_penyewaan_lapangan=penyewaan_barang.id_penyewaan_lapangan');
   $this->db->where('penyewaan.id_penyewaan',$id_penyewaan);
   $sewa_barang=$this->db->get();
   $result=$sewa_barang->result();
   foreach ($result as $r){
       $this->db->set('jumlah_Barang','jumlah_barang+'.$r->jumlah,false);
       $this->db->where('id_barang_inventori',$r->id_barang_inventori);
       $this->db->update('barang_inventori');

   }
 $query=$this->db->get_where('penyewaan',array('id_penyewaan'=>$id_penyewaan));
 $sewa=$query->result();
 $tgl_sewa = $sewa[0]->tanggal_penyewaan;
 $jam=$sewa[0]->jam;
 $lama_pemakaian=strtotime(date('Y-m-d H:i:s'))-strtotime($tgl_sewa.' '.$jam);
 
 $lama_pakai=floor($lama_pemakaian/3600);
 $this->db->where('penyewaan.id_penyewaan',$id_penyewaan);
 $this->db->update('penyewaan',array('keterangan'=>'selesai','lama_pemakaian'=>$lama_pakai));
 
 }
 function sewa_batal($id_penyewaan){
     $this->db->select('*');
     $this->db->from('penyewaan');
     $this->db->join('penyewaan_lapangan','penyewaan_lapangan.id_penyewaan_lapangan=penyewaan.id_penyewaan_lapangan');
     $this->db->join('lapangan','penyewaan_lapangan.id_lapangan=lapangan.id_lapangan');
     $this->db->where('id_penyewaan',$id_penyewaan);
     $query=$this->db->get();
     $result=$query->row();
     $this->db->delete('penyewaan',array('id_penyewaan'=>$id_penyewaan));
     $this->db->where('tanggal_booking',$result->tanggal_penyewaan);
     $this->db->where('id_member',$result->id_member);
     $this->db->where('nama_lapangan',$result->nama_lapangan);
     $this->db->update('booking',array('status_booking'=>'batal'));

 }

function generate_kalender($year=null,$month=null){
    if(empty($year)){
        $year=date('Y');
    }
    if(empty($month)){
        $month=date('m');
    }
    $prev=array('show_next_prev'=>true,'next_prev_url'=>base_url().'kasir/jadwal_controller/index');
    $group_tgl=$this->db->query("select tanggal_penyewaan from penyewaan where Year(tanggal_penyewaan)='$year' and Month(tanggal_penyewaan)='$month' group by tanggal_penyewaan");
    $tanggal=$group_tgl->result();
    $lapangan=array();
    foreach($tanggal as $tgl){
        $group_lapangan=$this->db->query("select lapangan.jenis_lapangan,penyewaan.tanggal_penyewaan ,count(penyewaan.nama_pelanggan) as pelanggan from penyewaan_lapangan inner join lapangan
                                          on penyewaan_lapangan.id_lapangan=lapangan.id_lapangan 
                                          inner join penyewaan on penyewaan.id_penyewaan_lapangan=penyewaan_lapangan.id_penyewaan_lapangan
                                          where penyewaan.tanggal_penyewaan='$tgl->tanggal_penyewaan' and penyewaan.keterangan != 'selesai' group by lapangan.jenis_lapangan");
         $result=$group_lapangan->result();
         $isi='';
         foreach($result as $r){
             $isi.=$r->jenis_lapangan.':'.$r->pelanggan.'<br>';
         }
         if(!empty($result)){
         $lapangan[(int)date('d',strtotime($result[0]->tanggal_penyewaan))]=$isi;
        }
    }

    $group_tgl2=$this->db->query("select tanggal_booking from booking where Year(tanggal_booking)='$year' and Month(tanggal_booking)='$month' group by tanggal_booking");
    $tanggal2=$group_tgl2->result();
    $lapangan2=array();
    foreach($tanggal2 as $tgl2){
        $group_lapangan2=$this->db->query("select lapangan.jenis_lapangan,booking.tanggal_booking ,count(booking.nama) as pelanggan from booking inner join lapangan
                                          on booking.id_lapangan=lapangan.id_lapangan

                                          where booking.tanggal_booking='$tgl2->tanggal_booking' and booking.status_booking != 'batal' group by lapangan.jenis_lapangan");
         $result2=$group_lapangan2->result();
         $isi2='';
         foreach($result2 as $r2){
             $isi2.=$r2->jenis_lapangan.':'.$r2->pelanggan.'<br>';
         }
         $lapangan2[(int)date('d',strtotime($result2[0]->tanggal_booking))]=$isi2;
    }
    $merge=$lapangan2+$lapangan;

    //print_r($lapangan);
    $event=array();
    $this->load->library('calendar',$prev);
    return $this->calendar->generate($year,$month,$merge);

  }

  function penyewaan($awal=null,$akhir=null){
   $this->db->select('*');
   $this->db->from('penyewaan');
   $this->db->order_by('tanggal_penyewaan','asc');
   $query=$this->db->get();
   return $query->result();

}

function ambil_detail_sewa($where){
    $this->db->select('*');
    $this->db->from('penyewaan');
    $this->db->join('penyewaan_lapangan','penyewaan.id_penyewaan_lapangan=penyewaan_lapangan.id_penyewaan_lapangan');
    $this->db->join('lapangan','penyewaan_lapangan.id_lapangan=lapangan.id_lapangan');
    $this->db->where($where);
    $query=$this->db->get();
    return $query->row();



}


function ambil_total_penyewaan($where=null,$like=null){
    $this->db->select('*');
    $this->db->from('penyewaan');
    $this->db->join('pelanggan','pelanggan.id_member=penyewaan.id_member');
    if(!empty ($like)){
        $this->db->like($like);
    }
    if(!empty ($where)){
        $this->db->where($where);
    }
   $query=$this->db->get();
   return $query->num_rows();


}

function ambil_detail_sewa_barang($where){
    $this->db->select('*');
    $this->db->from('penyewaan');
    $this->db->join('penyewaan_lapangan','penyewaan.id_penyewaan_lapangan=penyewaan_lapangan.id_penyewaan_lapangan');
    $this->db->where($where);
    $query=$this->db->get();
    $detail=$query->row();
    $id_sewa_lapangan=$detail->id_penyewaan_lapangan;
    $this->db->select('*');
    $this->db->from('penyewaan_barang');
    $this->db->where('id_penyewaan_lapangan',$id_sewa_lapangan);
    //$this->db->join('penyewaan_barang','penyewaan_barang.id_penyewaan_lapangan=penyewaan_lapangan.id_penyewaan_lapangan','left');
    //$this->db->where($where);
    $query2=$this->db->get();
    return $query2->result();

}
function ambil_pendapatan_lapangan($where=null, $limit=10, $offset=0){
    //ambil penyewaan berdasarkan
    $this->db->select('*');
    $this->db->from('penyewaan');
    $this->db->join('penyewaan_lapangan','penyewaan.id_penyewaan_lapangan=penyewaan_lapangan.id_penyewaan_lapangan');
    $this->db->join('lapangan','penyewaan_lapangan.id_lapangan=lapangan.id_lapangan');
    if(!empty($where)){
        $this->db->where($where);
    }
    $query = $this->db->get();
    return $query->result();
 }
 function ambil_total_lapangan($where){
     $this->db->select('*');
    $this->db->from('penyewaan');
    $this->db->join('penyewaan_lapangan','penyewaan.id_penyewaan_lapangan=penyewaan_lapangan.id_penyewaan_lapangan');
    $this->db->join('lapangan','penyewaan_lapangan.id_lapangan=lapangan.id_lapangan');
    if(!empty($where)){
        $this->db->where($where);
    }
    $query = $this->db->get();
    return $query->result();
 }
 }

?>
