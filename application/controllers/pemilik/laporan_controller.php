<?php
if ( !defined('BASEPATH')) exit ('No direct script access.');

 class laporan_controller extends CI_Controller{
    function __construct(){
        parent :: __construct();
        $this->load->model('pemesanan_model','',TRUE);
        $this->load->model('pembelian_model','',TRUE);
        $this->load->model('chart_model','',TRUE);
        $this->load->model('reservasi_model','',TRUE);
        $this->load->model('pembayaran_model','',TRUE);
   }
   
   
     
 function pembelian($id_pembelian=null,$sortby='request_pembelian.nama_barang',$sortorder='asc',$offset=NULL){
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
           $data['id_pembelian']=$id_pembelian;
           $data['details']=$this->pembelian_model->ambil_request_pembelian(array('request_pembelian.id_pembelian'=>$id_pembelian));
       }else {
          $data['pembelian']=$this->pembelian_model->ambil_pembelian($awal,$akhir);
       }
       $where=null;

       if($this->input->post('cetak')) {
      $awal=$this->input->post('awal');
      $akhir=$this->input->post('akhir');
      $this->load->library(array('mpdf'));
      $data['pembelian']=$this->pembelian_model->ambil_pembelian($awal,$akhir);

     $html='<h2 style="text-align:center">Laporan Pembelian</h2>
            <p style="text-align:center">Dicetak Tanggal '.date('Y-m-d').'</p>';
     $html.=$this->load->view('pemilik/laporan_pembelian',$data,true);
     $this->mpdf->WriteHTML($html);
     $this->mpdf->Output();
  }

       $config['base_url']=base_url().'pemilik/laporan_controller/pembelian/'.$sortby.'/'.$sortorder.'/';
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
       $data ['content'] ='pemilik/list_pembelian';

       $this->load->view('pemilik/template_admin',$data);
     }

function keuangan(){
  $awal=null;
  $akhir=null;
  if($this->input->post('cari')){

      $awal=$this->input->post('awal');
      $akhir=$this->input->post('akhir');
      $data['awal']=$awal;
       $data['akhir']=$akhir;

  }
  if($this->input->post('cetak')) {
      $awal=$this->input->post('awal');
      $akhir=$this->input->post('akhir');
      $this->load->library(array('mpdf'));
       $data['awal']=$awal;
       $data['akhir']=$akhir;
     $data['pemasukan']=$this->pembayaran_model->ambil_pendapatan($awal,$akhir);
//     $data['pengeluaran']=$this->pembelian_model->ambil_pengeluaran($awal,$akhir);
     $html='<h2 style="text-align:center">Laporan Keuangan</h2>
            <p style="text-align:center">Dicetak Tanggal '.date('Y-m-d').'</p>';
     $html.=$this->load->view('pemilik/keuangan',$data,true);
     $this->mpdf->WriteHTML($html);
     $this->mpdf->Output();
  }
  $data['pemasukan']=$this->pembayaran_model->ambil_pendapatan($awal,$akhir);
//  $data['pengeluaran']=$this->pembelian_model->ambil_pengeluaran($awal,$akhir);
  $data['title']='Laporan Keuangan';
  $data['search']='pemilik/form_periode';
  $data['isi']='pemilik/keuangan';
  $data['content']='pemilik/laporan_keuangan';
  $this->load->view('pemilik/template_admin',$data);

}

function penyewaan($id_booking=null,$sortby='penyewaan.tanggal_penyewaan',$sortorder='asc',$offset=NULL){
        $awal=null;
        $akhir=null;
        $where = null;
        if($this->input->post('periode')){
           // $like=array($this->input->post('kategori')=>$this->input->post('keyword'));
            $awal=$this->input->post('awal');
            $akhir=$this->input->post('akhir');
            $where = array(
                'booking.tanggal_booking >= '=>$awal,
                'booking.tanggal_booking <= '=>$akhir,
                );
        }
       
       else {
           $like=null;
       }
       if($this->input->post('cetak')){
           $awal=$this->input->post('awal');
            $akhir=$this->input->post('akhir');
            $where = array(
                'booking.tanggal_booking >= '=>$awal,
                'booking.tanggal_booking <= '=>$akhir,
                );
            $data['details']=$this->reservasi_model->ambil_reservasi_between($where);
            $this->load->library(array('mpdf'));
            $html='<h2 style="text-align:center">Laporan Penyewaan</h2>
            <p style="text-align:center">Dicetak Tanggal '.date('Y-m-d').'</p>';
            $html.=$this->load->view('pemilik/laporan_penyewaan',$data,true);
            $this->mpdf->WriteHTML($html);
            $this->mpdf->Output();
        }
       $data['details']=$this->reservasi_model->ambil_reservasi_between($where);
      
       $where=null;
       
       $config['base_url']=base_url().'pemilik/laporan_controller/penyewaan/';
       $config['total_rows']=$this->reservasi_model->ambil_total_reservasi($where);
       $config['per_page']=10;
       $config['uri_segment']=6;
       $config['use_page_numbers']=TRUE;
       $this->pagination->initialize($config);
       if($offset != NULL){
           $offset=($offset-1)*10;
       }else {
           $offset=$offset;
       }
       $data['id_booking'] = $id_booking;
       $data['title']='Daftar Penyewaan';
       $data ['content'] ='pemilik/list_penyewaan';

       $this->load->view('pemilik/template_admin',$data);
     }
   
 function cetak_detail_pemb($id_pembelian){
      $data['id_pembelian']=$id_pembelian;
      $data['details']=$this->reservasi_model->ambil_reservasi_between($where);
      $this->load->library(array('mpdf'));
      $data['pembelian']=$this->pembelian_model->ambil_pembelian($awal,$akhir);

      $html='<h2 style="text-align:center">Laporan Pembelian</h2>
            <p style="text-align:center">Dicetak Tanggal '.date('Y-m-d').'</p>';
     $html.=$this->load->view('pemilik/laporan_pembelian',$data,true);
     $this->mpdf->WriteHTML($html);
     $this->mpdf->Output();
 }

function pendapatan($offset=0){
        $awal=null;
        $akhir=null;
        $limit = 10;
        if($this->input->post('periode')){ 
            $awal=$this->input->post('awal');
            $akhir=$this->input->post('akhir');
            
            if($this->input->post('jenis_lapangan')=="all"){
                $where = array(
                'booking.tanggal_booking >= '=>$awal,
                'booking.tanggal_booking <= '=>$akhir,
                );
            }
            else{
                $jenis_lapangan = $this->input->post('jenis_lapangan');
                $where = array('lapangan.jenis_lapangan'=>$jenis_lapangan,
                'booking.tanggal_booking >= '=>$awal,
                'booking.tanggal_booking <= '=>$akhir,
                );
            }
            
        }else {
            $where=null;
        }
       
      if($this->input->post('cetak')) {
          $awal=$this->input->post('awal');
          $akhir=$this->input->post('akhir');
          $this->load->library(array('mpdf'));
          $data['pendapatan']=$this->reservasi_model->ambil_reservasi_between($where);
          $html='<h2 style="text-align:center">Laporan Pendapatan Lapangan</h2>
                <p style="text-align:center">Dicetak Tanggal '.date('Y-m-d').'</p>';
          $html.=$this->load->view('pemilik/laporan_pendapatan',$data,true);
          $this->mpdf->WriteHTML($html);
          $this->mpdf->Output();
      }

       $config['base_url']=base_url().'pemilik/laporan_controller/pendapatan/';
       $config['total_rows']=$this->reservasi_model->ambil_total_reservasi(null,$where);
       $config['per_page']=10;
       $config['uri_segment']=4;
       $config['use_page_numbers']=TRUE;
       $this->pagination->initialize($config);
       if($offset != NULL){
           $offset=($offset-1)*$limit;
       }else {
           $offset=$offset;
       }
       $data['pendapatan']=$this->reservasi_model->ambil_reservasi_between($where);
       $data['title']='Laporan Pendapatan';
       $data ['content'] ='pemilik/list_pendapatan';

       $this->load->view('pemilik/template_admin',$data);
}
   
 } 
?>
