<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if ( !defined('BASEPATH')) exit ('No direct script access.');


 class reservasi_controller extends CI_Controller{
     var $time;
     function __construct(){
         parent:: __construct();
         $this->load->model('lapangan_model','',TRUE);
         $this->time=array('09:00-10:00','10:00-11:00','11:00-12:00','12:00-13:00','13:00-14:00','14:00-15:00','15:00-16:00','16:00-17:00');
         $this->load->model('reservasi_model','',TRUE);
         $this->load->model('content_model','',TRUE);

     }

 function index($jenis_lapangan=null,$nama_lapangan=null,$jam=null,$tanggal=null){
     $script = null;
    if(!empty($tanggal)){
        //if booking date not valid
        if($this->validasi_tanggalpemesanan($jam,$tanggal,$nama_lapangan) == false){   
           $script = "$('#dialog1').dialog('open');";
        }
        else{
            //redirect to booking form 
            redirect(base_url().'reservasi_controller/pesan/'.$jam.'/'.$tanggal.'/'.$nama_lapangan);
        }
    }
    $data['promo']=$this->content_model->ambil_promo();
    if($this->input->post('cari')){
        $tanggal=date('Y-m-d',strtotime($this->input->post('tanggal')));
    }else {
    $tanggal=date('Y-m-d');
    }
    $jadwal=$this->lapangan_model->generate_jadwal_perweek_front($nama_lapangan,$tanggal);
    $data['jadwal']=$jadwal;
    $data['waktu']=$this->time;
    $data['title']='Lapangan';
    $side_menu='<li><a href="'.base_url().'kasir/lapangan_controller/index/badminton">Badminton</a></li>
                <li><a href="'.base_url().'kasir/lapangan_controller/index/basket">Basket</a></li>
                <li><a href="'.base_url().'kasir/lapangan_controller/index/futsal">Futsal</a></li>
                <li><a href="'.base_url().'kasir/lapangan_controller/index/tenis">Tenis</a></li>
                <li><a href="'.base_url().'kasir/lapangan_controller/index/voli">Voli</a></li>';
    $data['script_dialog_open'] = $script;
    $data['lapangan']=$this->lapangan_model->ambil_lapangan(array('jenis_lapangan'=>$jenis_lapangan));
    $data['side_menu']=$side_menu;
    $data['jenis_lapangan']=$jenis_lapangan;
    $data['nama_lapangan']=$nama_lapangan;
    $data['isi_all']='list_lapangan';
    $this->load->view('template2',$data);
}


function pesan($jam=null,$tanggal=null,$nama_lapangan=null){
        $script = null;
    //if($this->validasi_totaljampemesanan($jam,$tanggal,$nama_lapangan) == true){
        $data['promosi']=$this->content_model->ambil_promo();
        $current_url='reservasi_controller/pesan/'.$jam.'/'.$tanggal.'/'.$nama_lapangan;
        $current_url = urldecode(trim($current_url));
        $this->session->set_userdata('user_backlink',$current_url);
        $this->session->userdata('user_backlink');
        $this->form_validation->set_rules('id_lapangan','id_lapangan','required');

        $this->form_validation->set_rules('tanggal','tanggal','required');
        $this->form_validation->set_rules('nama_lapangan','nama_lapangan','required');
        $this->form_validation->set_rules('harga_sewa_lapangan','harga_sewa_lapangan','required');
        $this->form_validation->set_rules('jam','jam','required');
        $this->form_validation->set_rules('nama','nama','required');
        $this->form_validation->set_rules('alamat','alamat','required');
        $this->form_validation->set_rules('telepon','telepon','required');
        $this->form_validation->set_rules('lama_sewa','lama_sewa','required|callback_totaljampemesanan');

        if($this->form_validation->run()== true){
                $data_reservasi=array(
                    'id_kasir'=>null,
                    'id_lapangan'=>$this->input->post('id_lapangan'),
                    'id_member'=>$this->input->post('id_member'),
                                    'nama'=>$this->input->post('nama'),'alamat'=>$this->input->post('alamat'),
                                    'telepon'=>$this->input->post('telepon'),'jam'=>$this->input->post('jam'),
                                    'tanggal_booking'=>$this->input->post('tanggal'),'lama_pemakaian'=>$this->input->post('lama_sewa'),
                                    'nama_lapangan'=>$this->input->post('nama_lapangan'),'harga_lapangan'=>$this->input->post('harga_sewa_lapangan'),
                                        'status_booking'=>'booking');
                if($id_reservasi=$this->reservasi_model->pesan($data_reservasi)){
                    $this->session->unset_userdata('user_backlink');
                    redirect(base_url().'reservasi_controller/konfirmasi/'.$id_reservasi);
                    // echo 'Silakan datang 30 menit sebelum....';
                }else {
                    $this->session->set_flashdata('message','Ada kesalahan, Silakan ulagi lagi');
                    redirect(base_url().'reservasi_controller/pesan');
                }
           }
        //}
       // }else {
        $data['script_dialog_open'] = $script;
        $id_lapangan=set_value('id_lapangan');
        $id_lapangan=$this->lapangan_model->ambil_id_lapangan(array('nama_lapangan'=>$nama_lapangan));
        $id_lap=$id_lapangan[0]->id_lapangan;
        $data['id_lapangan']=$id_lap;
        $harga_lapangan=$this->lapangan_model->ambil_lapangan(array('id_lapangan'=>$id_lap));
        $data['harga_sewa_lapangan']=$harga_lapangan[0]->sewa_lapangan;
        $data['nama_lapangan']=$nama_lapangan;

        $data['tanggal']=$tanggal;
        $data['title']='Sewa';
        $data['jam']=$this->time[$jam];

        $data['index_jam']=$jam;
        //}
        $data_lapangan = $this->lapangan_model->ambil_lapangan(array('nama_lapangan'=>$nama_lapangan));
        $jenis_lapangan = $data_lapangan[0]->jenis_lapangan;
        $lapangan =  $this->lapangan_model->ambil_lapangan_booking($jenis_lapangan,$tanggal,$jam);

        $lama = 0;
        $waktu=array('09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00');
        for($i=$jam;$i<8;$i++){
            if(isset($lapangan[$waktu[$i]][$tanggal][$nama_lapangan])){
                break;
            }
            $lama++;
        }

        $data['lama_sewa'] = $lama;
        $data['isi_all']='form_reservasi';
        $this->load->view('template2',$data);
    //}
   
}
function validasi_tanggalpemesanan($jam=null,$tanggal=null,$nama_lapangan=null){
    $current = date('Y-m-d');
    $selisih = abs(strtotime($current)-  strtotime($tanggal))/3600/24;
    //if($selisih < 14 || $selisih > 90){
    if($selisih > 6){
        return false;
    }
    else{
        return true;
    }
}
function totaljampemesanan($lama_sewa){
    //get total lama pemakaian
    $id_member=$this->input->post('id_member');
    $tanggal=$this->input->post('tanggal');
    $where = array('booking.id_member'=>$id_member,'tanggal_booking'=>$tanggal);
    $totaldb = $this->reservasi_model->ambil_total_lama_pemakaian($where);
    $total = $totaldb->lama_pemakaian + $lama_sewa;
    if($total >= 16){
        $this->form_validation->set_message('totaljampemesanan','Jatah waktu pemesanan Anda hari ini telah habis. Perhari maks 16 jam.');
        return false;
    }
    else
        return true;
}
 function konfirmasi($id_reservasi){
     $data['promo']=$this->content_model->ambil_promo();
     $reservasi=$this->reservasi_model->ambil_reservasi(array('id_booking'=>$id_reservasi));
     $data['reservasi']=$reservasi;
     $data['isi_all']='konfirmasi_booking';
     $this->load->view('template2',$data);

 }


 }
?>
