<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 //if ( !defined('BASEPATH')) exit ('No direct script access.');


 class lapangan_controller extends CI_Controller{
     var $time;
     function __construct(){
         parent:: __construct();
         $this->load->model('lapangan_model','',TRUE);
         $this->time=array('09:00-10:00','10:00-11:00','11:00-12:00','12:00-13:00','13:00-14:00','14:00-15:00','15:00-16:00','16:00-17:00');
     }

//function index($jenis_lapangan=null,$nama_lapangan=null){
function index($jenis_lapangan=null){
  $this->session->set_userdata('back',$this->uri->uri_string());
  if($this->input->post('cari')){
      $tanggal=date('Y-m-d',strtotime($this->input->post('tanggal')));
  }else {
   $tanggal=date('Y-m-d');
  }
  //$jadwal=$this->lapangan_model->generate_jadwal_perweek($nama_lapangan,$tanggal);
  
   $jadwal = $this->lapangan_model->generate_jadwal_perweek($jenis_lapangan,$tanggal);
   //print_r($jadwal);
   $data['jadwal']=$jadwal;
   $data['waktu']=$this->time;
    $data['title']='Lapangan '.$jenis_lapangan;
    $side_menu='<li><a href="'.base_url().'index.php/kasir/lapangan_controller/index/badminton">Badminton</a></li>
                <li><a href="'.base_url().'index.php/kasir/lapangan_controller/index/basket">Basket</a></li>
               <li><a href="'.base_url().'index.php/kasir/lapangan_controller/index/futsal">Futsal</a></li>
               <li><a href="'.base_url().'index.php/kasir/lapangan_controller/index/tenis">Tenis</a></li>
               <li><a href="'.base_url().'index.php/kasir/lapangan_controller/index/voli">Voli</a></li>';
    $data['lapangan']=$this->lapangan_model->ambil_lapangan(array('jenis_lapangan'=>$jenis_lapangan));
    $data['side_menu']=$side_menu;
    $data['jenis_lapangan']=$jenis_lapangan;
    //$data['nama_lapangan']=$nama_lapangan;
    $data['tanggal'] = $tanggal;
    $data['total_lapangan'] = $this->lapangan_model->ambil_total_lapangan(array('jenis_lapangan'=>$jenis_lapangan));
    $data['content']='kasir/list_lapangan';
    $this->load->view('kasir/template_admin',$data);

}

function get_lapangan_sewa($jenis_lapangan,$tanggal,$jam){
$waktu=array('09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00');
        $pukul = $waktu[$jam];
        $lapangan = $this->lapangan_model->ambil_lapangan(array('jenis_lapangan'=>$jenis_lapangan));
        //get id lapangan yg ada di penyewaaan trs yang ada di situ dibuat link nya ga aktif
        $lapangan_sewa = $this->lapangan_model->ambil_lapangan_sewa($jenis_lapangan,$tanggal,$pukul);
        $lap_sewa = array();
         foreach($lapangan_sewa as $lap){
            for($i=0;$i<$lap->lama_pemakaian;$i++){
                $time = date('H:i', strtotime( $lap->jam. " +".$i." hours"));
                $lap_sewa[$time] = $lap->id_lapangan;
            }
        }
        $html = "";
        $html .= "<p>Pilih Lapangan Jenis Lapangan</p>";
        $html .= "<table>
            <tr><th>Nama Lapangan</th><th>Status</th><th>Aksi</th></tr>";

        foreach($lapangan as $lap){
            if(isset($lap_sewa[$waktu[$jam]]) && $lap_sewa[$waktu[$jam]]==$lap->id_lapangan){
                $html .= "<tr><td>".$lap->nama_lapangan."</td><td>Isi</td><td></td></tr>";
            }else{
                $html .= "<tr><td>".$lap->nama_lapangan."</td><td>Kosong</td><td><a onclick=\"window.location.href='".base_url()."index.php/kasir/sewa_controller/index/".$jam."/".$tanggal."/".$lap->nama_lapangan."'\">Pilih</a></td></tr>";
            }
        }
        $html .= "</table>";
        echo json_encode(array("html"=>$html));
    }
    
     function get_lapangan_booking($jenis_lapangan,$tanggal,$jam){
       $waktu=array('09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00');
        $pukul = $waktu[$jam];
        $lapangan = $this->lapangan_model->ambil_lapangan(array('jenis_lapangan'=>$jenis_lapangan));
        //get id lapangan yg ada di penyewaaan trs yang ada di situ dibuat link nya ga aktif
        $lapangan_sewa = $this->lapangan_model->ambil_lapangan_booking($jenis_lapangan,$tanggal,$pukul);

        $html = "";
        $html .= "<p>Pilih Lapangan Jenis Lapangan</p>";
        $html .= "<table>
            <tr><th>Nama Lapangan</th><th>Status</th><th>Aksi</th></tr>";

        foreach($lapangan as $lap){
            if(isset($lapangan_sewa[$waktu[$jam]][$tanggal][$lap->nama_lapangan])){
                $html .= "<tr><td>".$lap->nama_lapangan."</td><td>Isi</td><td></td></tr>";
            }else{
                $html .= "<tr><td>".$lap->nama_lapangan."</td><td>Kosong</td><td><a onclick=\"window.location.href='".base_url()."index.php/kasir/reservasi_controller/book/".$jam."/".$tanggal."/".$lap->nama_lapangan."'\">Pilih</a></td></tr>";
            }
        }
        $html .= "</table>";
        echo json_encode(array("html"=>$html));
    }


 }
?>
