<?php

if ( !defined('BASEPATH')) exit ('No direct script access.');

class lapangan_model extends CI_Model{
    function __contruct(){
        parent :: __construct();
    }

   function tambah($data){
       if($this->db->insert('lapangan',$data)){
           return TRUE;
       }ELSE {
           return FALSE;
       }

   }

   function ambil_lapangan($data=null){
       if(!empty($data)){
           $query=$this->db->get_where('lapangan',$data);
       }else {
           $this->db->select('*');
           $this->db->from('lapangan');
           $query=$this->db->get();
       }
      
       return $query->result();

   }

   function ambil_lapangan_sewa($jenis_lapangan=null,$tanggal=null,$jam=null){
       $lapangan = array();
        $group_lapangan = $this->db->query(
                "SELECT lapangan.jenis_lapangan,booking.tanggal_booking,lapangan.id_lapangan,
                booking.jam, booking.lama_pemakaian,pelanggan.nama_pelanggan as nama, lapangan.nama_lapangan
                FROM booking
                INNER JOIN lapangan ON booking.id_lapangan = lapangan.id_lapangan
                INNER JOIN pelanggan ON booking.id_member = pelanggan.id_member
                WHERE lapangan.jenis_lapangan = '$jenis_lapangan' and booking.status_booking = 'booking'
                AND booking.tanggal_booking = '$tanggal'");

        $result = $group_lapangan->result();

        foreach($result as $res){
            for($i=0;$i<$res->lama_pemakaian; $i++){
                $jam = date('H:i', strtotime( $res->jam. " +".$i." hours"));
                $lapangan[$jam][$res->tanggal_penyewaan][$res->nama_lapangan] = $res->id_lapangan;
            }

        }
        return $lapangan;
    }
  function ambil_lapangan_booking($jenis_lapangan=null,$tanggal=null,$jam=null){

        //ambil total penyewaan untuk jenis lapangan, tanggal dan jam tersebut
        $lapangan = array();
        $group_lapangan = $this->db->query(
                "SELECT lapangan.jenis_lapangan,booking.tanggal_booking,lapangan.id_lapangan,
                booking.jam, booking.lama_pemakaian,pelanggan.nama_pelanggan as nama, lapangan.nama_lapangan
                FROM booking
                INNER JOIN lapangan ON booking.id_lapangan = lapangan.id_lapangan
                INNER JOIN pelanggan ON booking.id_member = pelanggan.id_member
                WHERE lapangan.jenis_lapangan = '$jenis_lapangan' and booking.status_booking = 'booking'
                AND booking.tanggal_booking = '$tanggal' ");

        $result = $group_lapangan->result();
 
        foreach($result as $res){
            for($i=0;$i<$res->lama_pemakaian; $i++){
                $jam = date('H:i', strtotime( $res->jam. " +".$i." hours"));
                $lapangan[$jam][$res->tanggal_booking][$res->nama_lapangan] = $res->id_lapangan;
            }

        }
        return $lapangan;
    }

   function ambil_total_lapangan($where=null){
        $this->db->select('*');
        $this->db->from('lapangan');
        if(!empty($where)){
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->num_rows();

    }

   function delete_lapangan($id_lapangan){
      if($this->db->delete('lapangan',array('id_lapangan'=>$id_lapangan))){
          return true;
      } else {
          return false;
      }

   }

   function ubah_lapangan($id_lapangan,$store2db){
      $this->db->where('id_lapangan',$id_lapangan);
      $query=$this->db->update('lapangan',$store2db);
      if($query){
          return true;
      }else{
          return false;
      }

   }

  function sewa_lapangan($data){
      $this->db->insert('penyewaan_lapangan',$data);
      return $this->db->insert_id();
  }

function generate_jadwal_perhari($jenis_lapangan=null,$where=null){
    $time=array('09:00-10:00','10:00-11:00','11:00-12:00','12:00-13:00','13:00-14:00','14:00-15:00','15:00-16:00','16:00-17:00');
    $this->db->select('*');
    $this->db->from('penyewaan');
    $this->db->join('penyewaan_lapangan','penyewaan_lapangan.id_penyewaan_lapangan=penyewaan.id_penyewaan_lapangan');
    $this->db->join('lapangan','lapangan.id_lapangan=penyewaan_lapangan.id_lapangan');
    if(!empty($jenis_lapangan)){
        $this->db->where('lapangan.jenis_lapangan',$jenis_lapangan);
     }
     if(!empty($where)){
         $this->db->where($where);
     }
    $query=$this->db->get();
    $result=$query->result();
    $query2=$this->db->get_where('lapangan',array('jenis_lapangan'=>$jenis_lapangan));
    $result_lapangan=$query2->result();
    $matrix=array();
    $ts=0;
    foreach($time as $t){
        foreach($result_lapangan as $rl){
        $matrix[$rl->nama_lapangan][$ts]=0;
        }
        $ts++;
    }
    foreach($result as $r){
        for($i=0;$i<$r->lama_pemakaian;$i++){
            $jam_plus1=date('H:i',strtotime($r->jam.'+1 hours'));
            $slot=date('H:i',strtotime($r->jam)).'-'.$jam_plus1;
            $index=array_search($slot,$time);
            $waktu=$index+$i;
            $matrix[$r->nama_lapangan][$waktu]=$r->nama_pelanggan;
        }
    }
    return $matrix;

}
function generate_jadwal_perweek($jenis_lapangan=null,$tanggal=null){
    $tglplus7 = date('Y-m-d', strtotime($tanggal."+6 day" ));
    $time_slot = array('09:00-10:00','10:00-11:00','11:00-12:00','12:00-13:00',
                       '13:00-14:00','14:00-15:00','15:00-16:00','16:00-17:00');
        //ambil total lapangan per jenis lapangan yang dipilih
    $query1 = $this->db->get_where('lapangan',array('jenis_lapangan'=>$jenis_lapangan));
    $total_perjenis_lapangan = $query1->num_rows();

        //ambil total penyewaan untuk jenis lapangan, tanggal dan jam tersebut
    $lapangan = array();
    $group_lapangan = $this->db->query(
                "SELECT lapangan.jenis_lapangan,booking.tanggal_booking as tanggal,
                booking.jam, booking.lama_pemakaian, pelanggan.nama_pelanggan as nama
                FROM booking
                INNER JOIN lapangan ON booking.id_lapangan = lapangan.id_lapangan
                INNER JOIN pelanggan ON booking.id_member = pelanggan.id_member
                WHERE lapangan.jenis_lapangan = '$jenis_lapangan' AND
                booking.status_booking = 'booking' AND
                booking.tanggal_booking BETWEEN '$tanggal' AND '$tglplus7'");
    $result = $group_lapangan->result();
    $nama = array();
    foreach($time_slot as $time){
        for($i=0;$i<7;$i++){
            $tgl = date('Y-m-d', strtotime($tanggal."+".$i." day" ));
            $lapangan[$time][$tgl]='';
            //$nama[$tgl]=array();
        }
    }

    foreach($result as $res){
       //$nama[$res->tanggal_penyewaan][$res->jam][] = $res->nama_pelanggan;
        for($i=0;$i<$res->lama_pemakaian; $i++){
            $jam = date('H:i', strtotime( $res->jam. " +".$i." hours"));
            $jamplus1 = date('H:i', strtotime( $jam. " +1 hours"));
            $slot = date('H:i',strtotime($jam)).'-'.$jamplus1;
            if(isset($lapangan[$slot][$res->tanggal])){
                $lapangan[$slot][$res->tanggal][] = $res->nama;


            }
        }

    }
    return $lapangan;  
}

function generate_jadwal_perweek_front($nama_lapangan=null,$tanggal=null){
    $tanggalplus7=date('Y-m-d',strtotime($tanggal.'+6 day'));
    $time=array('09:00-10:00','10:00-11:00','11:00-12:00','12:00-13:00','13:00-14:00','14:00-15:00','15:00-16:00','16:00-17:00');
    
    $this->db->select('*');
    $this->db->from('booking');
    $this->db->join('pelanggan','pelanggan.id_member = booking.id_member');
    if(!empty($nama_lapangan)){
        $this->db->where('booking.nama_lapangan',$nama_lapangan);
     }
     if(!empty($tanggal)){
         $this->db->where("booking.tanggal_booking between '$tanggal' and '$tanggalplus7' ");
     }
    $this->db->where('booking.status_booking','booking');
    $query2=$this->db->get();
    $result2=$query2->result();
    $matrix=array();
    $ts=0;
    $nama = array();
    foreach($time as $t){
        for($j=0;$j<7;$j++){
          $tgl=date('Y-m-d',strtotime($tanggal.' + '.$j.' day'));
           $matrix[$t][$tgl]='';
           $nama[$tgl]=array();
        }
        $ts++;
    }
    foreach($result2 as $r2){
        $nama[$r2->tanggal_booking][] = $r2->nama_pelanggan;
        for($i=0;$i<$r2->lama_pemakaian;$i++){
            $jam=date('H:i',strtotime($r2->jam.'+'.$i.' hours'));
            $jam_plus1=date('H:i',strtotime($jam.'+1 hours'));
            $slot=date('H:i',strtotime($jam)).'-'.$jam_plus1;
            $matrix[$slot][$r2->tanggal_booking]=$r2->id_booking;
        }
    }
    return $matrix;

}

function ambil_id_lapangan($where){
    $query=$this->db->get_where('lapangan',$where);
    $result=$query->result();
    return $result;
}

function ceklapangan($lapangan){
      $query=$this->db->get_where('lapangan',array('nama_lapangan'=>$lapangan));
      if($query->num_rows() > 0){
          return true;
      }else {
          return false;
      }

}


}



?>
