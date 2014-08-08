<?php
if ( !defined('BASEPATH')) exit ('chart model No direct script access.');

class chart_model extends CI_Model{
    function __construct(){
        parent :: __construct();
    }


function visitor($year=null){
    $this->db->select('Monthname(tanggal_booking) as bulan ,SUM(1) as num ');
    $this->db->from('booking');
    $this->db->where('Year(tanggal_booking)',$year);
    $this->db->group_by('Month(tanggal_booking)');
    $this->db->order_by('tanggal_booking');
    $query=$this->db->get();
    //echo $this->db->last_query();
   $result=$query->result();
   $hasil=array();
   $month=array('January','February','March','April','May','June','July','August','September','October','November','December');
   for($i=0;$i<12;$i++){
       $hasil[$month[$i]]=0;
       
   }
   foreach($result as $r ){
       $hasil[$r->bulan]=$r->num;
   }
  // print_r ($hasil);
   return $hasil;
    
}

function income($year){
    $this->db->select('Monthname(tanggal_booking) as bulan ,SUM(total_pembayaran) as num ');
    $this->db->from('booking');
    $this->db->join('pembayaran','pembayaran.id_booking=booking.id_booking');
    $this->db->where('Year(tanggal_booking)',$year);
    $this->db->group_by('Month(tanggal_booking),booking.id_booking');
    $this->db->order_by('tanggal_booking');
    $query=$this->db->get();
    //echo $this->db->last_query();
   $result=$query->result();
   $hasil=array();
    $month=array('January','February','March','April','May','June','July','August','September','October','November','December');
   for($i=0;$i<12;$i++){
       $hasil[$month[$i]]=0;

   }
   foreach($result as $r ){
       $hasil[$r->bulan]=$r->num;
   }
   //print_r ($hasil);
   return $hasil;

}


function pembelian($year){
    $this->db->select('Monthname(tanggal_pembelian) as bulan ,SUM(total_harga_pembelian) as num ');
    $this->db->from('pembelian');
    $this->db->where('Year(tanggal_pembelian)',$year);
    $this->db->group_by('Month(tanggal_pembelian)');
    $this->db->order_by('tanggal_pembelian');
    $query=$this->db->get();
    //echo $this->db->last_query();
   $result=$query->result();
   $hasil=array();
    $month=array('January','February','March','April','May','June','July','August','September','October','November','December');
   for($i=0;$i<12;$i++){
       $hasil[$month[$i]]=0;

   }
   foreach($result as $r ){
       $hasil[$r->bulan]=$r->num;
   }
   //print_r ($hasil);
   return $hasil;

}

function barang_rusak($year){
     $this->db->select('Monthname(tanggal_perbaikan) as bulan ,SUM(jumlah) as num ');
    $this->db->from('barang_rusak');
    $this->db->where('Year(tanggal_perbaikan)',$year);
    $this->db->group_by('Month(tanggal_perbaikan)');
    $this->db->order_by('tanggal_perbaikan');
    $query=$this->db->get();
    //echo $this->db->last_query();
   $result=$query->result();
   $hasil=array();
   $month=array('January','February','March','April','May','June','July','August','September','October','November','December');
   for($i=0;$i<12;$i++){
       $hasil[$month[$i]]=0;

   }
   foreach($result as $r ){
       $hasil[$r->bulan]=$r->num;
   }
  // print_r ($hasil);
   return $hasil;

}

function penyewaan($awal=null,$akhir=null){
   $this->db->select('*');
   $this->db->from('booking');
   $this->db->order_by('tanggal_booking','asc');
   $query=$this->db->get();
   return $query->result();

}

function pemakaian_lapangan($year){
// $this->db->select('Monthname(penyewaan.tanggal_penyewaan) as bulan,
//     COUNT(penyewaan.id_penyewaan) as num, lapangan.jenis_lapangan');
//    $this->db->from('penyewaan');
//    $this->db->join('penyewaan_lapangan','penyewaan_lapangan.id_penyewaan_lapangan=penyewaan.id_penyewaan_lapangan');
//    $this->db->join('lapangan','penyewaan_lapangan.id_lapangan=lapangan.id_lapangan');
//    $this->db->where('Year(penyewaan.tanggal_penyewaan)',$year);
//    $this->db->group_by('Month(penyewaan.tanggal_penyewaan)');
//    $this->db->order_by('penyewaan.tanggal_penyewaan','asc');
//    $query=$this->db->get();
//    echo $this->db->last_query();
//   $result=$query->result();
   $hasil=array();
    $month=array('January','February','March','April','May','June','July','August','September','October','November','December');
    $jenis_lapangan = array("badminton","basket","futsal","tenis","voli");
    foreach($jenis_lapangan as $lap){
        for($i=0;$i<12;$i++){
            $hasil[$lap][$month[$i]]=0;
        }
    }
    $query_lapangan = $this->db->query("SELECT * FROM lapangan");
    $res_lapangan = $query_lapangan->result();
    foreach($res_lapangan as $res){
    $querypenyewaan = $this->db->query("SELECT Monthname( booking.tanggal_booking) AS bulan, COUNT( booking.id_booking) AS num, `lapangan`.`jenis_lapangan`
FROM (`booking`)
JOIN `lapangan` ON `lapangan`.`id_lapangan` = `booking`.`id_lapangan`
WHERE Year( booking.tanggal_booking ) = '$year' AND lapangan.jenis_lapangan = '".$res->jenis_lapangan."'
GROUP BY Month( booking.tanggal_booking )
ORDER BY `booking`.`tanggal_booking` ASC");
    $result = $querypenyewaan->result();
       foreach($result as $r ){
           $hasil[$r->jenis_lapangan][$r->bulan]=$r->num;
       }
    }
   //print_r ($hasil);
   return $hasil;

}
function okupasi_lapangan($bulan=null,$tahun=null){
    //total pemakaian keseluruhan
    $query = $this->db->query("SELECT SUM(`lama_pemakaian`) as total FROM booking
        WHERE MONTH(tanggal_booking)=$bulan AND YEAR(tanggal_booking)=$tahun");
    //echo $this->db->last_query();
    $result = $query->row();
    $total = $result->total;
    //bikin array data semua lapangan
    $lapangan = array();
    $query2 = $this->db->query("SELECT nama_lapangan FROM lapangan");
    $result2 = $query2->result();
    foreach($result2 as $res){
        $lapangan[$res->nama_lapangan] = 0;
    }
    //ambil total pemakaian per lapangan
    $query3 = $this->db->query("SELECT SUM(`lama_pemakaian`) as lama_pemakaian, booking.nama_lapangan FROM `booking`
        INNER JOIN lapangan ON  lapangan.id_lapangan = booking.id_lapangan
        WHERE Month(`tanggal_booking`) = '$bulan' AND YEAR(`tanggal_booking`)='$tahun'
        GROUP BY nama_lapangan");
    $result3 = $query3->result();
    foreach($result3 as $res){
        $lapangan[$res->nama_lapangan] = ($res->lama_pemakaian/$total*100);
    }
    
    //lempar data dalam bentuk string json series
    $series = '';
    foreach($lapangan as $lap=>$val){
        $series .= '{name:"'.$lap.'",data:['.$val.']},';
    }
    $series = trim($series, ",");
    return $series;
}
}
?>
