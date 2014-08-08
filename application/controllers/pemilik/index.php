<?php
 
if ( !defined('BASEPATH')) exit ('No direct script access.');


  class index extends CI_Controller{
     function __construct(){
         parent:: __construct();
         $this->load->model('login_model','',TRUE);
         $this->load->model('lapangan_model','',TRUE);
         $this->load->model('inventori_model','',TRUE);
         $this->load->model('content_model','',TRUE);
         $this->load->model('member_model','',TRUE);
         $this->load->model('chart_model','',TRUE);
     }


function index(){
    $this->load->view('pemilik/template_admin');

}

function grafik(){
    $data['id']='graphs';
    $data['content']='pemilik/grafik';
    $data['title']='Grafik';
    $this->load->view('pemilik/template_admin',$data);

}
function grafik_pemakaian_lapangan(){
    if($this->input->post('cari')){
        $year=$this->input->post('tahun');
    }else {
        $year=date('Y');

    }
    $data['id']='graphs';
    $data['year']=$year;
    $data['legend']='Pemakaian Lapangan';
    $data['data_lapangan']=$this->chart_model->pemakaian_lapangan($year);
    $data['content']='pemilik/grafik_2';
    $data['title']='Grafik Pemakaian Lapangan';
    $this->load->view('pemilik/template_admin',$data);
}
function grafik_okupasi_lapangan(){
    if($this->input->post('cari')){
       $bulan = $this->input->post('bulan');
       $tahun = $this->input->post('tahun');
    }else{
       $bulan = (int) date('m');
       $tahun = date('Y');
    }
    $data['bulan'] = $bulan;
    $data['tahun'] = $tahun;
    $data_lap = $this->chart_model->okupasi_lapangan($bulan,$tahun);
    $data['data_lapangan'] = $data_lap;
    //$data['content']='pemilik/grafik_okupasi';
    $data['title'] = 'Grafik Okupasi Lapangan';
    //$this->load->view('pemilik/template_admin',$data);
    $this->load->view('pemilik/grafik_okupasi',$data);
}
function grafik_pengunjung(){
    if($this->input->post('cari')){
        $year=$this->input->post('tahun');
    }else {
        $year=date('Y');

    }
    $data['id']='graphs';
    $data['year']=$year;
    $data['legend']='Pengunjung';
    $data['data_chart']=$this->chart_model->visitor($year);
    $data['content']='pemilik/grafik';
    $data['title']='Grafik Pengunjung';
    $this->load->view('pemilik/template_admin',$data);

}

function grafik_pendapatan(){
     if($this->input->post('cari')){
        $year=$this->input->post('tahun');
    }else {
        $year=date('Y');

    }
    $data['id']='graphs';
    $data['year']=$year;
    $data['legend']='Pendapatan';
    $data['data_chart']=$this->chart_model->income($year);
    $data['content']='pemilik/grafik';
    $data['title']='Grafik Pendapatan';
    $this->load->view('pemilik/template_admin',$data);


}

function grafik_pembelian(){
    if($this->input->post('cari')){
        $year=$this->input->post('tahun');
    }else {
        $year=date('Y');

    }
    $data['id']='graphs';
    $data['year']=$year;
    $data['legend']='Pembelian';
    $data['data_chart']=$this->chart_model->pembelian($year);
    $data['content']='pemilik/grafik';
    $data['title']='Grafik Pembelian';
    $this->load->view('pemilik/template_admin',$data);


}

function grafik_barang_rusak(){
    if($this->input->post('cari')){
        $year=$this->input->post('tahun');
    }else {
        $year=date('Y');

    }
    $data['id']='graphs';
    $data['year']=$year;
    $data['legend']='Barang Rusak';
    $data['data_chart']=$this->chart_model->barang_rusak($year);
    $data['content']='pemilik/grafik';
    $data['title']='Grafik Barang Rusak';
    $this->load->view('pemilik/template_admin',$data);
}

function logout(){
        $this->session->unset_userdata('ispemilik');
        $this->session->unset_userdata('pemilikname');
        $this->session->unset_userdata('idpemilik');
         $this->session->unset_userdata('accesspemilik');
        redirect(base_url().'admin');
    }

  }
?>
