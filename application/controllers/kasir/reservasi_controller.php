<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//if ( !defined('BASEPATH')) exit ('No direct script access.');

 class reservasi_controller extends CI_Controller{
     var $time;
     var $times;
     function __construct(){
         parent:: __construct();
         $this->load->model('lapangan_model','',TRUE);
         $this->times=array('09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00');
         $this->time=array('09:00-10:00','10:00-11:00','11:00-12:00','12:00-13:00','13:00-14:00','14:00-15:00','15:00-16:00','16:00-17:00');
         $this->load->model('reservasi_model','',TRUE);
          $this->load->model('inventori_model','',TRUE);
          $this->load->model('promosi_model','',TRUE);
          $this->load->model('pembayaran_model','',TRUE);
          $this->load->model('user_model','',TRUE);
          $this->load->model('member_model','',TRUE);
     }

 function index($offset=null){

    if($this->input->post('search')){
            $like=array($this->input->post('kategori')=>$this->input->post('keyword'));
        }else {
            $like=null;
        }
       $where=null;
       $config['base_url']=base_url().'index.php/kasir/reservasi_controller/index/';
       $config['total_rows']=$this->reservasi_model->ambil_total_reservasi($like);
       $config['per_page']=10;
       $config['uri_segment']=4;
       $config['use_page_numbers']=TRUE;
       $this->pagination->initialize($config);
       if($offset != NULL){
           $offset=($offset-1)*10;
       }else {
           $offset=$offset;
       }

    $data_db=$this->reservasi_model->ambil_reservasi(array('status_booking'=>'booking'),$like,10,$offset);
    $data['sewa']=$data_db;
    $data['title']='Daftar Reservasi';
    $data['content']='kasir/daftar_reservasi';
    $this->load->view('kasir/template_admin',$data);
 }


 function book($jam=null,$tanggal=null,$nama_lapangan=null){
         $script = null;
         $this->session->set_userdata('backlink',$this->uri->uri_string());
         $this->session->userdata('backlink');
         $this->form_validation->set_rules('nama_pelanggan','nama pelanggan','required|xss_clean');
         $this->form_validation->set_rules('alamat_pelanggan','alamat pelanggan','required|xss_clean');
         $this->form_validation->set_rules('telepon_pelanggan','telepon pelanggan','required|xss_clean');
         $this->form_validation->set_rules('lama_sewa','lama_sewa','required|callback_totaljampemesanan');
         $this->form_validation->set_rules('username','Username','callback_cekusername');
         if($this->input->post('reservasinregister')){
              $this->form_validation->set_rules('username','Username','required|callback_cekusername');
              $this->form_validation->set_rules('email','Email','required|callback_cekemail|valid_email');
         }
         $id_kasir = $this->session->userdata('idkasir');
         if($this->form_validation->run() == true){

            if($this->input->post('reservasi')){
                $id_member = uniqid("NM");
                $id_user = 0;
            }
            if($this->input->post('reservasinregister')){
                $id_member = uniqid("M");
                $data_user = array('user_name'=>$this->input->post('username'),
                 'password'=> md5('123456'),
                 'nama'=>$this->input->post('nama_pelanggan'),
                 'email'=>$this->input->post('email'),
                 'jabatan'=>'user');
                $id_user = $this->user_model->tambah($data_user);
                $this->sendMail($id_user,$this->input->post('nama_pelanggan'),$this->input->post('email'));
            }
            $data_pelanggan = array(
                    'id_member'=>$id_member,
                    'user_id'=>$id_user,
                    'nama_pelanggan'=>$this->input->post('nama_pelanggan'),
                    'alamat_pelanggan'=>$this->input->post('alamat_pelanggan'), 
                    'telepon_pelanggan'=>$this->input->post('telepon_pelanggan'),
                   );
             $add_member = $this->member_model->tambah_member($data_pelanggan);
             $data_booking = array(
                 'id_kasir'=>$id_kasir,
                 'id_member'=>$id_member,
                 'id_lapangan'=>$this->input->post('id_lapangan'),
                 'tanggal_booking'=>$this->input->post('tanggal'), 
                 'jam'=>$this->input->post('jam'), 
                 'nama_lapangan'=>$this->input->post('nama_lapangan'),
                 'harga_lapangan'=>$this->input->post('harga_sewa_lapangan'),
                 'lama_pemakaian'=>$this->input->post('lama_sewa'),
                 'status_booking'=>'booking');
             $id_reservasi=$this->reservasi_model->pesan($data_booking);
            if($id_reservasi && $add_member){
                redirect(base_url().'index.php/kasir/reservasi_controller/konfirmasi/'.$id_reservasi);

            }else {
                echo ' ';
            }
         }
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
         $data['script_dialog_open'] = $script;
         $data['promosi']=$this->promosi_model->ambil_promosi(array('periode_awal <= '=>date('Y-m-d'),'periode_akhir >= '=>date('Y-m-d')));
         $data['nama_lapangan']=$nama_lapangan;
         $data['tanggal']=$tanggal;
         $data['title']='Reservasi Non Member';
         $data['jam']=$this->times[$jam];
         $data['id_lapangan']=$id_lap;
         $data['index_jam']=$jam;
         $data['lama_sewa'] = $lama;
         $harga_lapangan=$this->lapangan_model->ambil_lapangan(array('id_lapangan'=>$id_lap));
         $data['harga_sewa_lapangan']=$harga_lapangan[0]->sewa_lapangan;
         $data['content']='kasir/form_reservasi';
         $this->load->view('kasir/template_admin',$data);

     }
    function cekemail($email){
        if($this->member_model->cekemail($email)){
            $this->form_validation->set_message('cekemail','Email ini sudah terdaftar');
            return false;
        }else {
            return true;
        }
    }
    function sendMail($id_user=null,$nama=null,$email=null)
    {
        $mail = 'wulantika@gmail.com';
        //$mail = $email;
        $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'wulantika@gmail.com', // change it to yours
        'smtp_pass' => 'uletbulu84', // change it to yours
        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'wordwrap' => TRUE
        );

            $message = ' Halo '.$nama.',<br>
                Terimakasih sudah mendaftar. <br>
                Silahkan klik link dibawah untuk melakukan verifikasi pendaftaran. <br>
                '.base_url().'index/verify_registration/'.$id_user.'<br>
                Akun Anda akan aktif dan Anda bisa login setelah melakukan verfikasi ini!
                <br><br>
                Terimakasih';
            $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('wulantika@gmail.com'); // change it to yours
        $this->email->to($mail);// change it to yours
        $this->email->subject('Verifikasi Pendaftaran');
        $this->email->message($message);
        if($this->email->send())
        {
        //echo 'Email sent.';
        }
        else
        {
        show_error($this->email->print_debugger());
        }

    }
    
     function bookmember($jam=null,$tanggal=null,$nama_lapangan=null){
         $script = null;
         $id_kasir = $this->session->userdata('idkasir');
         $this->session->set_userdata('backlink',$this->uri->uri_string());
         $this->session->userdata('backlink');
         $this->form_validation->set_rules('nama_pelanggan','nama pelanggan','required|xss_clean');
         $this->form_validation->set_rules('alamat_pelanggan','alamat pelanggan','required|xss_clean');
         $this->form_validation->set_rules('telepon_pelanggan','telepon pelanggan','required|xss_clean');
         $this->form_validation->set_rules('lama_sewa','lama_sewa','required|callback_totaljampemesanan');
         if($this->form_validation->run() == true){
                $data_reservasi=array('id_kasir'=>$id_kasir,
                    'id_lapangan'=>$this->input->post('id_lapangan'),'nama_lapangan'=>$this->input->post('nama_lapangan'),
                                    'id_member'=>$this->input->post('id_member'), 'nama'=>$this->input->post('nama_pelanggan'),
                                        'alamat'=>$this->input->post('alamat_pelanggan'), 'telepon'=>$this->input->post('telepon_pelanggan'),
                                        'jam'=>$this->input->post('jam'), 'tanggal_booking'=>$this->input->post('tanggal'), 'lama_pemakaian'=>$this->input->post('lama_sewa'),
                                        'harga_lapangan'=>$this->input->post('harga_sewa_lapangan'), 'status_booking'=>'booking');
                if($id_reservasi=$this->reservasi_model->pesan($data_reservasi)){
                    redirect(base_url().'index.php/kasir/reservasi_controller/konfirmasi/'.$id_reservasi);

                }else {
                    echo ' ';
                }
            }
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
         $data['script_dialog_open'] = $script;
         $data['promosi']=$this->promosi_model->ambil_promosi(array('periode_awal <= '=>date('Y-m-d'),'periode_akhir >= '=>date('Y-m-d')));
         $data['nama_lapangan']=$nama_lapangan;
         $data['tanggal']=$tanggal;
         $data['title']='Reservasi Member';
         $data['jam']=$this->times[$jam];
         $data['id_lapangan']=$id_lap;
         $data['index_jam']=$jam;
         $data['lama_sewa'] = $lama;
         $data['id_member']=$this->member_model->ambil_all_member();
         $harga_lapangan=$this->lapangan_model->ambil_lapangan(array('id_lapangan'=>$id_lap));
         $data['harga_sewa_lapangan']=$harga_lapangan[0]->sewa_lapangan;
         $data['content']='kasir/form_reservasimember';
         $this->load->view('kasir/template_admin',$data);

     }
     function get_member(){
         $id_member = $_POST['id_member'];
         $member = $this->member_model->ambil_member(array("id_member"=>$id_member));
         echo json_encode(
                 array("id_member"=>$member[0]->id_member,
                     "nama"=>$member[0]->nama_pelanggan,
                     "alamat"=>$member[0]->alamat_pelanggan,
                     "telepon"=>$member[0]->telepon_pelanggan,
                     ));
         
     }
     function validasi_tanggalpemesanan($jam=null,$tanggal=null,$nama_lapangan=null){
        $current = date('Y-m-d');
        $selisih = abs(strtotime($current)-  strtotime($tanggal))/3600/24;
        if($selisih < 14 || $selisih > 90){
            return false;
        }
        else{
            return true;
        }
     }
     function totaljampemesanan($lamapakai=null){
        //get total lama pemakaian
        $nama=$this->input->post('nama_pelanggan');
        $alamat=$this->input->post('alamat_pelanggan');
        $telepon=$this->input->post('telepon_pelanggan');
        $tanggal=$this->input->post('tanggal');
        
        $where = array('nama_pelanggan'=>$nama,'alamat_pelanggan'=>$alamat,'telepon_pelanggan'=>$telepon,'tanggal_booking'=>$tanggal);
        $totaldb = $this->reservasi_model->ambil_total_lama_pemakaian($where);
        $total = $totaldb->lama_pemakaian + $lamapakai;
        if($total >= 16){
            $this->form_validation->set_message('totaljampemesanan','Jatah waktu pemesanan Anda hari ini telah habis. Perhari maks 16 jam.');
            return false;
        }
        else
            return true;
     }

     function konfirmasi($id_reservasi){
         $data['reservasi']=$this->reservasi_model->ambil_reservasi(array('id_booking'=>$id_reservasi));
         $data['title']='konfirmasi reservasi';
         $data['id_reservasi']=$id_reservasi;
         $data['content']='kasir/konfirmasi_reservasi';
         $this->load->view('kasir/template_admin',$data);
     }
     function konfirmasi_via_email(){
         $id_reservasi = $this->input->post('id_booking');
         $email = $this->input->post('email');
         $html = $this->reservasi_model->template_konfirmasi($id_reservasi);
         $this->load->library('email');
         $this->email->from('admin@localhost','Administrator');
         $this->email->to($email);
         $this->email->subject('Konfirmasi Reservasi Lapangan');
         $this->email->message($html);
         if($this->email->send()){
                 echo '<script>alert("Email telah dikirim");
                     window.location.href="'.base_url().'index.php/kasir/reservasi_controller/konfirmasi/'.$id_reservasi.'"</script>';
         }
         else{
              echo '<script>alert("Email gagal dikirim")</script>';
         }

     }

  function receipt($id_reservasi){
     $data['title']='konfirmasi reservasi';
     $data['reservasi']=$this->reservasi_model->ambil_reservasi(array('id_booking'=>$id_reservasi));
     $data['pembayaran']=  $this->reservasi_model->ambil_detail_pembayaran(array('id_booking'=>$id_reservasi));
     $data['id_reservasi']=$id_reservasi;
     $data['content']='kasir/receipt';
     $this->load->view('kasir/template_admin',$data);
  }
  function receipt_via_email(){
         $id_reservasi = $this->input->post('id_booking');
         $email = $this->input->post('email');
         $html = $this->reservasi_model->template_receipt($id_reservasi);
         $this->load->library('email');
         $this->email->from('admin@localhost','Administrator');
         $this->email->to($email);
         $this->email->subject('Konfirmasi Reservasi Lapangan');
         $this->email->message($html);
         if($this->email->send()){
                 echo '<script>alert("Email telah dikirim");
                     window.location.href="'.base_url().'index.php/kasir/reservasi_controller/index"</script>';
         }
         else{
              echo '<script>alert("Email gagal dikirim")</script>';
         }
  }
 function checkin($id_booking=null){
     $data_booking = $this->reservasi_model->ambil_reservasi(array('id_booking'=>$id_booking));
     $status_pmbyrn = $data_booking[0]->status_pembayaran;
     if($status_pmbyrn != 'lunas'){
         echo '<script>alert("Pembayaran Belum Lunas!");
             window.location.href="'.base_url().'index.php/kasir/reservasi_controller/index"</script>';
     }else{
        $this->session->set_flashdata('checkin',$this->uri->uri_string());
        $this->reservasi_model->checkin($id_booking);
        $this->session->set_userdata('id_booking',$id_booking);
        $data_db=$this->reservasi_model->ambil_detail_pembayaran_checkin(array('booking.id_booking'=>$id_booking));
        $harga_total_lapangan = $data_db[0]->lama_pemakaian * $data_db[0]->harga_lapangan;
        $data['title']='Bukti Pembayaran';
        $data['harga_total_lapangan'] = $harga_total_lapangan;
        $data['bukti']=$data_db;
        $data['kembali']=0;
        $data['content']='kasir/bukti_pembayaran';
        $this->load->view('kasir/template_admin',$data);
     }
 }
//pembatalan satu booking
 function batal($id_booking){

     $this->reservasi_model->batal($id_booking,array('status_booking'=>'batal'));
     redirect(base_url().'index.php/kasir/reservasi_controller/index');
 }
 //pembatalan beberapa booking otomatis
 function pembatalan(){
    $ids = $this->input->post('id');
    $this->reservasi_model->pembatalan($ids);
    redirect(base_url('index.php/kasir/reservasi_controller/index'));
 }
 function keluar($id_booking=null){
     $this->reservasi_model->sewa_selesai($id_booking);
     redirect(base_url('index.php/kasir/reservasi_controller/index'));
 }
function all(){
    $data_db=$this->reservasi_model->ambil_reservasi(null,null,10,0);
    $data['sewa']=$data_db;
    $data['title']='Daftar Reservasi';
    $data['content']='kasir/daftar_reservasi';
    $this->load->view('kasir/template_admin',$data);
}
function cek_reservasi(){
    //$this->reservasi_model->cek_reservasi(date('Y-m-d'),date('H:i:s'));
    //ambil data reservasi yang belum pada bayar
    $data_db=$this->reservasi_model->cek_reservasi();
    $data['sewa']=$data_db;
    $data['title']='Daftar Reservasi';
    $data['content']='kasir/daftar_reservasi';
    $this->load->view('kasir/template_admin',$data);
}
function cek_dp(){
    $data_db=$this->reservasi_model->cek_dp();
    $data['sewa']=$data_db;
    $data['title']='Daftar Reservasi';
    $data['content']='kasir/daftar_reservasi';
    $this->load->view('kasir/template_admin',$data);
}
function cek_now(){
    $data_db=$this->reservasi_model->cek_now();
    $data['sewa']=$data_db;
    $data['title']='Daftar Reservasi';
    $data['content']='kasir/daftar_reservasi';
    $this->load->view('kasir/template_admin',$data);
}
function cek_batal(){
    $data_db=$this->reservasi_model->ambil_reservasi(array('status_booking'=>'batal'),null,10,0);
    $data['sewa']=$data_db;
    $data['title']='Daftar Reservasi';
    $data['content']='kasir/daftar_reservasi';
    $this->load->view('kasir/template_admin',$data);
}
  function pembayaran($id_reservasi){
    $this->form_validation->set_rules('id_booking','No Booking','required');
    $this->form_validation->set_rules('tgl_pmbyrn','Tanggal Pembayaran','required');
    $this->form_validation->set_rules('jml_pmbyrn','Jumlah Pembayaran', 'required|numeric|is_natural|callback_cek_pembayaran['.$this->input->post('jenis_pmbyrn').','.$this->input->post('total').']');
    $this->form_validation->set_rules('jenis_pmbyrn','Jenis pembayaran','required');

    if($this->form_validation->run()== true){
        if($this->input->post('jenis_pmbyrn') == 'pembayaran dp1'){
            $status = 'dp1';
           }
           else{
            $status = 'lunas';
           }
        $store2db = array(
            'id_booking'=>$this->input->post('id_booking'),
            'status_pbyr'=>$status,
            'tanggal_pbyr'=>$this->input->post('tgl_pmbyrn'),
            'bukti_pbyr'=>'',
            'keterangan_pbyr'=>$this->input->post('jenis_pmbyrn'),
            'total_pembayaran'=>$this->input->post('jml_pmbyrn'));

        $total_diterima = $this->input->post('total_diterima');
        $utk_pembayaran = $this->input->post('jml_pmbyrn');
       
        if($this->reservasi_model->pembayaran($store2db)){

            $this->session->set_flashdata('message','terimakasih sudah melakukan pembayaran');
            redirect(base_url().'index.php/kasir/reservasi_controller/receipt/'.$id_reservasi);
        }else{
            $this->session->set_flashdata('message','maaf ada kesalahan');
            redirect(base_url().'index.php/kasir/reservasi_controller/index');
        }
      }
      $data['reservasi'] = $this->reservasi_model->ambil_reservasi(array('id_booking'=>$id_reservasi));
      $data['id_reservasi']=$id_reservasi;
      $data['content']='kasir/form_pembayaran_reservasi';
      $this->load->view('kasir/template_admin',$data);
  }

  function pembayaran2($id_reservasi,$errors=null){
      $booking = $this->reservasi_model->ambil_reservasi(array('booking.id_booking'=>$id_reservasi));
      $total = $booking[0]->harga_lapangan*$booking[0]->lama_pemakaian;
      $lama_pemakaian =$booking[0]->lama_pemakaian;
      $pembayaran = $this->reservasi_model->ambil_pembayaran(array('id_booking'=>$id_reservasi));
      $dibayar = isset($pembayaran[0])?$pembayaran[0]->total_pembayaran:0;
      $keterangan = isset($pembayaran[0])?$pembayaran[0]->keterangan_pbyr:'';
      $total_telah_dibayar = 0;
      $ket_bayar = "";
      $html = '';
      //$html .='';
      $data['id_reservasi'] = $id_reservasi;
      $data['errors'] = $errors;
      $data['booking'] = $booking;
      $data['total'] = $total;
      $data['lama_pemakaian'] = $lama_pemakaian;
      $data['pembayaran'] = $pembayaran;
      $data['dibayar'] = $dibayar;
      $data['keterangan'] = $keterangan;
      $html .=  '<form action="'. base_url().'index.php/kasir/reservasi_controller/tambah_pembayaran/'.$id_reservasi .'" method="post" enctype="multipart/form-data">
<table>
<tr><td><label>No Booking : </label></td>
<td><input type="text" name="id_booking" value="'. $id_reservasi .'" readonly></td>
</tr>
<tr><td><label>Lama Pemakaian</label></td>
<td><input type="text" name="lama_pemakaian" id="lama_pemakaian" value="'. $lama_pemakaian .'" readonly> jam</td>
</tr>
<tr><td><label>Tanggal Pembayaran</label></td>
<td><input type="text" id="tgl_pmbyrn" name="tgl_pmbyrn" value="'. date('Y-m-d') .'" readonly>
<a href="javascript: NewCssCal(\'tgl_pmbyrn\',\'yyyymmdd\')"><img src="'. base_url('images/cal.gif') .'"></a></td>
</tr>
<tr><td><label>Total Harus dibayar</label></td>
<td><input type="text" name="total" readonly value="'. ($total) .'" >
    </td>
</tr>
<tr><td><label>Jumlah Telah dibayar</label></td>
<td><input type="text" readonly value="'. ($dibayar) .'"></td>
</tr>
<tr><td><label>Sisa harus dibayar</label></td>
<td><input type="text" name="sisa_hrs_dbyr" id="sisa_hrs_dbyr" value="'. ($total - $dibayar) .'" ></td>
</tr>
<tr><td><label>Keterangan</label></td>
<td><input type="text" readonly value="'. $keterangan .'" id="keterangan"></td>
</tr>
<tr><td><label>Jenis Pembayaran</label></td>
<td><input type="radio" name="jenis_pmbyrn" value="pembayaran dp1">Pembayaran DP1<br><br>
    <input type="radio" name="jenis_pmbyrn" value="lunas">Pembayaran Lunas<br><br>
    '. (isset($_GET['error2'])?$_GET['error2']:'') .'
</td></tr>
<tr><td><label>Jumlah Pembayaran</label></td>
<td><input type="text" name="jml_pmbyrn" id="jml_pmbyrn" value="">
'. (isset($_GET['error'])?$_GET['error']:'') .'</td>
</tr>
<tr><td ><input type="submit" value="submit" style="font-weight:bold; color: black"></td></tr>
</form>
<script>
     $(\'input:radio[name="jenis_pmbyrn"]\').change(function(){
        var jenis_pmbyrn = $(\'input:radio[name="jenis_pmbyrn"]:checked\').val();
        var keterangan = $("#keterangan").val();
        if(jenis_pmbyrn == "pembayaran dp1" && keterangan == "pembayaran dp1"){
            $(this).attr(\'checked\', false);
            alert(\'Anda sudah membayar DP, silakan lakukan pelunasan pembayaran!\');
        }
    });
$(\'#jml_pmbyrn\').focusout(function(){
var jenis_pmbyrn = $(\'input:radio[name="jenis_pmbyrn"]:checked\').val();
            var total_sewa = $("#lama_pemakaian").val(); 
            var jml_pmbyrn = $("#jml_pmbyrn").val();
            var sisa_hrs_dbyr = $("#sisa_hrs_dbyr").val();
            if((jenis_pmbyrn == "pembayaran dp1")&&(total_sewa * 50000 != jml_pmbyrn)){
                $("#jml_pmbyrn").val(\'\');
                alert("Jumlah DP tidak sesuai peraturan. Anda harus membayar sebesar: Rp."+total_sewa*50000);
            }
            else if(jenis_pmbyrn == "lunas" && jml_pmbyrn != sisa_hrs_dbyr){
                $("#jml_pmbyrn").val(\'\');
                alert("Anda harus membayar sebesar: "+sisa_hrs_dbyr);
            }
});
</script>';
      echo json_encode(array('html'=>$html));
  }
  function tambah_pembayaran($id_reservasi){
      $this->form_validation->set_rules('jml_pmbyrn','jumlah pembayaran','required|is_natural|callback_cek_pembayaran['.$this->input->post('jenis_pmbyrn').','.$this->input->post('total').']');
      $this->form_validation->set_rules('jenis_pmbyrn','jenis pembayaran','required');
      if($this->form_validation->run()==TRUE){
           if($this->input->post('jenis_pmbyrn') == 'pembayaran dp1'){
            $status = 'dp1';
           }
           else{
            $status = 'lunas';
           }
           $store2db = array(
                'id_booking'=>$this->input->post('id_booking'),
                'status_pbyr'=>$status,
                'tanggal_pbyr'=>$this->input->post('tgl_pmbyrn'),
                'bukti_pbyr'=>'',
                'keterangan_pbyr'=>$this->input->post('jenis_pmbyrn'),
                'total_pembayaran'=>$this->input->post('jml_pmbyrn'));
           $this->reservasi_model->pembayaran($store2db);
           $this->session->set_flashdata('script',"<script>$(document).ready(function(){
               $.ajax({
                url: 'http://localhost/ta/index.php/kasir/reservasi_controller/detail_reservasi/".$id_reservasi."',
                dataType : 'json',
                success: function(data){
                    $(\"#dialog\").html(data.html);
                }
            });
        $('#dialog').dialog('open');
               }); </script>");
           redirect(base_url('index.php/kasir/reservasi_controller/index'));
      }else{
          $error = form_error('jml_pmbyrn');
          $error2 = form_error('jenis_pmbyrn');
          $this->session->set_flashdata('script',"<script>$(document).ready(function(){
              var error = ".(!empty($error)?$error:'\'<p></p>\'').";
              var error2 = ".(!empty($error2)?$error2:'\'<p><p>\'').";
               $.ajax({
                url: 'http://localhost/ta/index.php/kasir/reservasi_controller/pembayaran2/".$id_reservasi."',
                data: {error: error,error2:error2},
                dataType : 'json',
                success: function(data){
                   
                    $(\"#dialog2\").html(data.html);
                }
            });
           
        $('#dialog2').dialog('open');
               }); </script>");
           redirect(base_url('index.php/kasir/reservasi_controller/index'));
      }
  }
  function cek_pembayaran($inputtotal,$param){
      $tmp = explode(",", $param);
       $jenis = $tmp[0];
       $total = (int) str_replace('.', '', substr($tmp[1],3));
       $inputtotal;
      if($jenis == 'lunas'){
          if($inputtotal < $total){
              echo 'lebih kecil';
              $this->form_validation->set_message('cek_pembayaran', 'Jumlah yang dibayar tidak boleh kurang dari '.$total);
              return FALSE;
          }
//          else{
//              return TRUE;
//          }
      }
      else{
          return TRUE;
      }
  }
  function konfirmasi_pembayaran($id_reservasi,$id_pembayaran){
       $this->reservasi_model->konfirmasi_pembayaran($id_pembayaran);
       $this->session->set_flashdata('script',"<script>$(document).ready(function(){
               $.ajax({
                url: 'http://localhost/ta/index.php/kasir/reservasi_controller/detail_reservasi/'+".$id_reservasi.",
                dataType : 'json',
                success: function(data){
                    $(\"#dialog\").html(data.html);
                }
            });
            $('#dialog').dialog('open');
               }); </script>");
        redirect(base_url('index.php/kasir/reservasi_controller/index'));
  }
  function detail_reservasi($id_reservasi=null){

      $html = $this->reservasi_model->get_detail_reservasi($id_reservasi);
      echo json_encode(array('html'=>$html));
  }
  function claim_refund($id_reservasi=null){
        if($this->reservasi_model->claim_refund($id_reservasi) == TRUE){
            $this->session->set_flashdata('script',"<script>$(document).ready(function(){
               $.ajax({
                url: 'http://localhost/ta/index.php/kasir/reservasi_controller/detail_reservasi/'+".$id_reservasi.",
                dataType : 'json',
                success: function(data){
                    $(\"#dialog\").html(data.html);
                }
            });
            $('#dialog').dialog('open');
               }); </script>");
         redirect(base_url('index.php/kasir/reservasi_controller/index'));
        }
       
  }

 function cekusername($username){
    if($this->member_model->cekusername($username)){
        $this->form_validation->set_message('cekusername','username sudah ada');
        return false;
    }else {
        return true;
    }
 }
}

?>
