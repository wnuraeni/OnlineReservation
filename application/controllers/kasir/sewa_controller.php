<?php
if ( !defined('BASEPATH')) exit ('No direct script access.');

 class sewa_controller extends CI_Controller{
     var $time;
     function __construct(){
         parent:: __construct();
         $this->load->model('lapangan_model','',TRUE);
         //$this->time=array('09:00-10:00','10:00-11:00','11:00-12:00','12:00-13:00','13:00-14:00','14:00-15:00','15:00-16:00','16:00-17:00');
         $this->time=array('09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00');
         $this->load->model('inventori_model','',TRUE);
         $this->load->model('pembayaran_model','',TRUE);
         $this->load->model('penyewaan_model','',TRUE);
         $this->load->model('reservasi_model','',TRUE);
         $this->load->model('promosi_model','',TRUE);

     }


     function index($jam=null,$tanggal=null,$nama_lapangan=null){
         $this->session->set_flashdata('backlink',$this->uri->uri_string());
         //$this->session->userdata('backlink');
         $id_lapangan=$this->lapangan_model->ambil_id_lapangan(array('nama_lapangan'=>$nama_lapangan));
         $id_lap=$id_lapangan[0]->id_lapangan;
         $data_lapangan = $this->lapangan_model->ambil_lapangan(array('nama_lapangan'=>$nama_lapangan));
         $jenis_lapangan = $data_lapangan[0]->jenis_lapangan;
         $lapangan =  $this->lapangan_model->ambil_lapangan_booking($jenis_lapangan,$tanggal,$jam);
         $lama = 0;
         $waktu=array('09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00');
         for($i=$jam;$i<8;$i++){
            if(isset($lapangan[$waktu[$i]][$tanggal][$nama_lapangan])){
                break;
            }else{
                $lama++;
            }
         }
         
         $data['lama_sewa'] = $lama;
         $data['nama_lapangan']=$nama_lapangan;
         $data['tanggal']=$tanggal;
         $data['title']='Sewa';
         $data['jam']=$this->time[$jam];
         $data['barang_inventori']=$this->inventori_model->ambil_inventori();
         $data['id_lapangan']=$id_lap;
         $data['index_jam']=$jam;
         $harga_lapangan=$this->lapangan_model->ambil_lapangan(array('id_lapangan'=>$id_lap));
         $data['harga_sewa_lapangan']=$harga_lapangan[0]->sewa_lapangan;
         $data['content']='kasir/form_sewa';
         $data['promosi']=$this->promosi_model->ambil_promosi(array('periode_awal <= '=>date('Y-m-d'),'periode_akhir >= '=>date('Y-m-d')));
         $data['barang']=$this->inventori_model->generate_image_inventori();
         $this->load->view('kasir/template_admin',$data);

     }

     function sewa(){
         $harga_total=$this->input->post('harga_sewa_lapangan')*$this->input->post('lama_sewa');
         $data_sewa=array('id_lapangan'=>$this->input->post('id_lapangan'),'id_member'=>$this->input->post('id_member'),
                          'nama'=>$this->input->post('nama'),'tanggal_penyewaan'=>$this->input->post('tanggal'),
                          'jam'=>$this->input->post('jam'),'lama_sewa'=>$this->input->post('lama_sewa'),
                           'harga_sewa_lapangan'=>$this->input->post('harga_sewa_lapangan'));
         
//        print_r($data_sewa);
//        $harga_total_barang=0;
//        $isi_cart=$this->cart->contents();
//        //print_r($isi_cart);
//         if(!empty($isi_cart)){
//         foreach ($this->cart->contents() as $cart){
//              $harga_total_barang+=$cart['subtotal']*$this->input->post('lama_pemakaian');
//            }
//
//         }
//         $total_pembayaran=$harga_total+$harga_total_barang;
        
         //$merge=array_merge($data_sewa);
         $merge=$data_sewa;
         $this->pembayaran($merge);
     }



     function barang_sewa(){
      //print_r($this->session);
      $this->form_validation->set_rules('jumlah_barang','jumlah_barang','callback_cek_barang');
      if($this->form_validation->run()== true){
      $id_lapangan=$this->input->post('id_lapangan');
      $index_jam=$this->input->post('index_jam');
      $nama_lapangan=$this->input->post('nama_lapangan');
      $tanggal=$this->input->post('tanggal');
      $id_barang=$this->input->post('id_barang_inventori');
      $jumlah_barang=$this->input->post('jumlah_barang');
      $nama_barang=$this->input->post('nama_barang');
      $harga_sewa=$this->input->post('harga_sewa');
      $cart=array('id'=>$id_barang,'name'=>$nama_barang,'price'=>$harga_sewa,'qty'=>$jumlah_barang);
      $this->cart->insert($cart);
      $this->inventori_model->sewa_barang($id_barang,array('jumlah_barang'=>$jumlah_barang));
      $backlink=$this->session->userdata('backlink');
      redirect (base_url().'index.php/kasir/sewa_controller/index/'.$index_jam.'/'.$tanggal.'/'.$nama_lapangan);
      }else {
         $data['title']='Sewa';
         $data['jam']=$this->time[$index_jam];
         $data['barang_inventori']=$this->inventori_model->ambil_inventori();
         $data['id_lapangan']=$id_lapangan;
         $data['index_jam']=$index_jam;
         $data['content']='kasir/form_sewa';
         $this->load->view('kasir/template_admin',$data);
      }
     }

    function cek_barang($jumlah_barang){
        $id_barang_inventori=$this->input->post('id_barang_inventori');
        if($this->inventori_model->cek_jumlah_barang($jumlah_barang,$id_barang_inventori)== true){
           return false;
        }else {
            return true;
        }
        $this->form_validation->set_message('cek_barang','Stok sudah habis');

    }

    function pembayaran($data_sewa=null,$total_harga=null){
        if($this->input->post('bayar')){
         $id_booking=$this->session->userdata('id_booking');
         if(!empty($id_booking)){
             $this->reservasi_model->checkin($id_booking);
         }

          //echo $this->input->post('harga_sewa_lapangan');
           //echo $this->input->post('lama_sewa');
         $harga_total=$this->input->post('total_biaya');
         $store2db=array('id_lapangan'=>$this->input->post('id_lapangan'),'harga_total_lapangan'=>$this->input->post('total_biaya'));
         
         $id_sewa_lapangan=$this->lapangan_model->sewa_lapangan($store2db);

          $i=0;
          $harga_total_barang=0;
          $isi_cart=$this->cart->contents();
          $id_sewa_barang=null;
         if(!empty($isi_cart)){
         foreach ($this->cart->contents() as $cart){
             $store2db2[$i]['id_barang_inventori']=$cart['id'];
             $store2db2[$i]['id_penyewaan_lapangan']=$id_sewa_lapangan;
             $store2db2[$i]['nama']=$cart['name'];
             $store2db2[$i]['jumlah']=$cart['qty'];
             $store2db2[$i]['harga_total']=$cart['subtotal'];

              $i++;
            $harga_total_barang+=$cart['subtotal']*$this->input->post('lama_sewa');
          }
         
         $id_sewa_barang=$this->inventori_model->detail_sewa_barang($store2db2);
         $this->cart->destroy();

       }
         $total_pembayaran=$harga_total+$harga_total_barang;
         $kembalian=$this->input->post('jumlah_pembayaran')-$total_pembayaran;
         $data_sewa=array('id_penyewaan_lapangan'=>$id_sewa_lapangan,'id_pelanggan'=>$this->input->post('id_member'),
                          'nama_pelanggan'=>$this->input->post('nama'),'tanggal_penyewaan'=>$this->input->post('tanggal'),
                          'jam'=>$this->input->post('jam'),'lama_pemakaian'=>$this->input->post('lama_sewa'),
                          'total_pembayaran'=>$total_pembayaran,'jumlah_dibayar'=>$this->input->post('jumlah_pembayaran'),
                           'id_karyawan'=>$this->session->userdata('idkasir'));

        //echo $this->input->post('jam');
        $id_penyewaan=$this->pembayaran_model->detail_pembayaran($data_sewa);

        redirect(base_url().'index.php/kasir/sewa_controller/bukti_pembayaran/'.$id_penyewaan.'/'.$kembalian);
       }
        // $harga_total=$data_sewa['harga_sewa_lapangan']*$data_sewa['lama_sewa'];
          // $harga_total_barang=0;
          // $isi_cart=$this->cart->contents();
          // if(!empty($isi_cart)){
         // foreach ($this->cart->contents() as $cart){
            // $harga_total_barang+=$cart['subtotal']*$data_sewa['lama_sewa'];
        // }
       // }
        echo $harga_total=$this->input->post('total_biaya');
        echo $total_pembayaran=$harga_total;
        //$total_pembayaran=$harga_total;
        $data['sewa']=$data_sewa;
        $data['total']=$total_pembayaran;
       $data['barang']=$this->cart->contents();
       $data['title']='Form Pembayaran';
       $data['content']='kasir/form_pembayaran';
       $this->load->view('kasir/template_admin',$data);
    }

 function bukti_pembayaran($id_penyewaan,$kembalian){
    $data_db=$this->pembayaran_model->ambil_detail_pembayaran($id_penyewaan);
    $data['title']='Bukti Pembayaran';
    $data['bukti']=$data_db;
    $data['kembali']=$kembalian;
    $data['content']='kasir/bukti_pembayaran';
    $this->load->view('kasir/template_admin',$data);
 }

function daftar_sewa_sekarang($offset=0){
     if($this->input->post('search')){
            $like=array($this->input->post('kategori')=>$this->input->post('keyword'));
        }else {
            $like=null;
        }
       $where=null;
       $config['base_url']=base_url().'index.php/kasir/sewa_controller/daftar_sewa_sekarang/';
       $config['total_rows']=$this->penyewaan_model->ambil_total_penyewaan(null,$like);
       $config['per_page']=10;
       $config['uri_segment']=4;
       $config['use_page_numbers']=TRUE;
       $this->pagination->initialize($config);
       if($offset != NULL){
           $offset=($offset-1)*10;
       }else {
           $offset=$offset;
       }
    $data_db=$this->penyewaan_model->ambil_data_penyewaan(null,$like,10,$offset);
    $data['sewa']=$data_db;
    $data['title']='Daftar Peminjaman Hari Ini';
    $data['content']='kasir/daftar_sewa';
    $this->load->view('kasir/template_admin',$data);
}


function keluar($id_penyewaan){
    $this->penyewaan_model->sewa_selesai($id_penyewaan);
    redirect (base_url().'index.php/kasir/sewa_controller/daftar_sewa_sekarang');
}

function batal($id_penyewaan){
    $this->penyewaan_model->sewa_batal($id_penyewaan);
    redirect (base_url().'index.php/kasir/sewa_controller/daftar_sewa_sekarang');

}


function inserttocart($id_barang_inventori){
    $barang=$this->inventori_model->ambil_inventori(array('id_barang_inventori'=>$id_barang_inventori));
    $cart=array('id'=>$barang[0]->id_barang_inventori,
                'qty'=>1,
               'price'=>$barang[0]->harga_sewa,
               'name'=>$barang[0]->nama_barang,
              'options'=>array('picture'=>$barang[0]->gambar_barang));
    $this->cart->insert($cart);
    redirect(base_url().$this->session->flashdata('checkin'));
}

function update_cart(){
    if($this->input->post('update_cart')){
        $rowid=$this->input->post('id_item');
        $qty=$this->input->post('qty');
        $data=array();
        $i=0;
        foreach($rowid as $id){
            $data[]=array('rowid'=>$id,'qty'=>$qty[$i]);
            $i++;
        }
       $this->cart->update($data);
       redirect(base_url().$this->session->flashdata('backlink'));
    }
}

function delete_item($rowid){
    $data=array('rowid'=>$rowid,'qty'=>0);
    $this->cart->update($data);
    redirect(base_url().$this->session->flashdata('backlink'));
}

 }
?>
