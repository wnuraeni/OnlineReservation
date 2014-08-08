<?php
if ( !defined('BASEPATH')) exit ('index No direct script access.');

class index extends CI_Controller{
function __construct(){
    parent:: __construct();
    $this->load->model('login_model','',TRUE);
    $this->load->model('lapangan_model','',TRUE);
    $this->load->model('inventori_model','',TRUE);
    $this->load->model('content_model','',TRUE);
    $this->load->model('member_model','',TRUE);
    $this->load->model('user_model','',TRUE);
    $this->load->model('reservasi_model','',TRUE);
}

function index (){
    $data['promo']=$this->content_model->ambil_promo();
    $data['text']=$this->content_model->get_home();
    $data['isi_all']='home';
    $this->load->view('template',$data);
}

function payment($id_booking = null){
    $this->form_validation->set_rules('id_booking','No Booking','required');
    $this->form_validation->set_rules('tgl_pmbyrn','Tanggal Pembayaran','required');
    $this->form_validation->set_rules('jml_pmbyrn','Jumlah Pembayaran', 'required|numeric|is_natural');
    $this->form_validation->set_rules('bukti_pmbyrn','Bukti pembayaran','callback_file_upload');	
    $this->form_validation->set_rules('jenis_pmbyrn','Jenis pembayaran','required');

    if($this->form_validation->run()== true){
    $store2db = array(
            'id_booking'=>$this->input->post('id_booking'),
            'status_pbyr'=>'tunggu konfirmasi',
			'tanggal_pbyr'=>$this->input->post('tgl_pmbyrn'),
            'keterangan_pbyr'=>$this->input->post('jenis_pmbyrn'),
            'total_pembayaran'=>$this->input->post('jml_pmbyrn'),
            'bukti_pbyr'=>'bukti_pembayaran/'.$_FILES['bukti_pmbyrn']['name']);


       if($id_pembayaran = $this->content_model->save_konfirmasi_pembayaran($store2db)){

   //$this->session->set_flashdata('message','terimakasih sudah melakukan pembayaran');
                 redirect(base_url().'index/receipt/'.$this->input->post('id_booking'));
        }else{

            $this->session->set_flashdata('message','maaf ada kesalahan');
            redirect(base_url().'index/payment');
        }
      }
      if(!empty($id_booking)){
          $data['id_booking'] = $id_booking;
      }
      $data['promo']=$this->content_model->ambil_promo();
      $data['isi_all']='form_konfirmpembayaran';
      $this->load->view('template',$data);

}
function receipt($id_booking){
     $pembayaran=$this->reservasi_model-> ambil_konfirmasi_pembayaran($id_booking);
     $data['pembayaran']=$pembayaran;
     $data['isi_all']='konfirmasi_pembayaran';
     $this->load->view('template2',$data);
}
function get_totalprice_json($id_booking){
    $booking = $this->reservasi_model-> ambil_konfirmasi_pembayaran($id_booking);
    $total_lama_pemakaian = $booking->lama_pemakaian;
    $total_sewa = $booking->harga_lapangan * $booking->lama_pemakaian;
    $jml_dibayar = $booking->total_pembayaran;
    $status = $booking->status_pbyr;
    $ket_pembayaran = $booking->keterangan_pbyr;
    $tgl_bayar = $booking->tanggal_pbyr;
    $sisa_bayar = $total_sewa - $jml_dibayar;
    //ambil total yang harus dibaya, sisa yang harus dibayar, status pembayaran
    echo json_encode(
            array(
                "total_lama_pemakaian"=>$total_lama_pemakaian,
                "total"=>$total_sewa,
                "tanggal_bayar"=>$tgl_bayar,
                "total_dibayar"=>$jml_dibayar,
                "status"=>$status,
                "keterangan"=>$ket_pembayaran,
                "sisa_bayar"=>$sisa_bayar
                ));
}
//callback function untuk pengecekan gagal tidak upload bukti pembayaran
function file_upload($str){
$errors = validation_errors();

	if(empty($errors)){
		if(!empty($_FILES['bukti_pmbyrn']['name']) ){
			$config['upload_path'] = './images/bukti_pembayaran';
			$config['allowed_types']='gif|jpg|png|jpeg|GIF|JPG|JPEG|PNG';
			$config['overwrite'] = 'TRUE';
	
			$this->load->library('upload',$config);
			if($this->upload->do_upload('bukti_pmbyrn')){
				return TRUE;
			}
			else{
				$this->form_validation->set_message('file_upload','File gagal di upload'.$this->upload->display_errors());
				return FALSE;
			}
		}
		else{
		$this->form_validation->set_message('file_upload','File tidak boleh kosong');
		return FALSE;
		}
	} if(empty($_FILES['bukti_pmbyrn']['name'])){
$this->form_validation->set_message('file_upload','File tidak boleh kosong');
		return FALSE;
}

	
}
function histori_reservasi($id_member=null)
{
    $data['promo']=$this->content_model->ambil_promo();
    $where = array('booking.id_member'=>$id_member);
    $data_db=$this->reservasi_model->ambil_reservasi($where,null,100,0);
    $data['sewa']=$data_db;
    $data['isi_all'] = 'histori_reservasi';
    $this->load->view('template',$data);
}
function mision(){
    $data['promo']=$this->content_model->ambil_promo();
    $data['text']=$this->content_model->get_mission();
    $data['isi_all']='mision';
    $this->load->view('template',$data);

}

function our_fasilitas($kategori=null){
    $data['promo']=$this->content_model->ambil_promo();
    $where=null;
    if(!empty($kategori)){
        $where=array('kategori_gambar'=>$kategori);
    }
    $data['gambar']=$this->content_model->ambil_gambar($where);
    $data['isi_all']='fasilitas';
    $this->load->view('template',$data);
}

function contact_us(){
    $data['promo']=$this->content_model->ambil_promo();
    $data['text']=$this->content_model->get_contact_us();
    $data['isi_all']='contact';
    $this->load->view('template',$data);
}

function membership(){
    $data['promo']=$this->content_model->ambil_promo();
    $data['text']=$this->content_model->get_membership();
    $data['isi_all']='membership';
    $this->load->view('template',$data);
}

function news($offset=null){
       $data['promo']=$this->content_model->ambil_promo();
       $config['base_url']=base_url().'index/news/';
       $config['total_rows']=$this->content_model->ambil_total_news();
       $config['per_page']=5;
       $config['uri_segment']=3;
       $config['use_page_numbers']=TRUE;
       $this->pagination->initialize($config);
       if($offset != NULL){
           $offset=($offset-1)*5;
       }else {
           $offset=$offset;
       }
     $data['news']=$this->content_model->ambil_news(null,5,$offset);
     $data['isi_all']='news';
     $this->load->view('template',$data);
}


function proses_login(){

    $this->form_validation->set_rules('username','username','required');
    $this->form_validation->set_rules('password','password','required');
    if($this->form_validation->run()== true){
        $username=$this->input->post('username');
        $password=md5($this->input->post('password'));
        if($userdata=$this->login_model->login_member($username,$password)){
            $this->session->set_userdata('nama_pelanggan',$userdata->nama_pelanggan);
            $this->session->set_userdata('alamat_pelanggan',$userdata->alamat_pelanggan);
            $this->session->set_userdata('telepon_pelanggan',$userdata->telepon_pelanggan);
            $this->session->set_userdata('id_member',$userdata->id_member);
            $this->session->set_userdata('username',$userdata->user_name);
            $this->session->set_userdata('islogin',true);
            redirect(base_url().$this->session->userdata('user_backlink'));
        }else{
            $this->session->set_flashdata('message','username tidak terdaftar');
            redirect(base_url().'index/login');
        }
    }else {
        $data['isi_all']='login_view';
        $this->load->view('template',$data);
    }
}

function login(){
    $data['promo']=$this->content_model->ambil_promo();
    $data['isi_all']='login_view';
    $this->load->view('template',$data);
}

function logout(){
    $this->session->sess_destroy();
    redirect(base_url().'index');
}


function view_news($id_news){
     $data['promo']=$this->content_model->ambil_promo();
     $data['news']=$this->content_model->ambil_news(array('id_news'=>$id_news));
     $data['isi_all']='news_detail';
     $this->load->view('template',$data);

}

function register(){
    $data['promo']=$this->content_model->ambil_promo();
    $this->form_validation->set_rules('username','username','required|callback_cekusername');
    $this->form_validation->set_rules('password','password','required|xss_clean');
    $this->form_validation->set_rules('nama','nama','required|xss_clean');
    $this->form_validation->set_rules('alamat','alamat','required|xss_clean');
    $this->form_validation->set_rules('email','email','required|callback_cekemail|valid_email');
    $this->form_validation->set_rules('telepon','telepon','required|xss_clean|numeric');
    
    if($this->form_validation->run()== true){
        $data1=array('user_name'=>$this->input->post('username'),'password'=>md5($this->input->post('password')),
                        'nama'=>$this->input->post('nama'),'email'=>$this->input->post('email'),'jabatan'=>'user', 'verified'=>0);
        $id_user=$this->member_model->tambah_user($data1);
        $id_member=uniqid('M');
        $data2=array('user_id'=>$id_user,'nama_pelanggan'=>$this->input->post('nama'),
                        'id_member'=>$id_member,
                        'alamat_pelanggan'=>$this->input->post('alamat'),
                        'telepon_pelanggan'=>$this->input->post('telepon')
                       );
        $this->member_model->tambah_member($data2);
        redirect (base_url().'index/konfirmasi_register/'.$id_user);
    }
    $data['isi_all']='form_registrasi';
    $this->load->view('template2',$data);
}

function konfirmasi_register($id_user=null){
      $data['promo']=$this->content_model->ambil_promo();
      $res = $this->member_model->ambil_member(array("user.user_id"=>$id_user));
      $this->sendMail($id_user,$res[0]->nama,$res[0]->email);
      $data['id_member'] = $res[0]->id_member;
      $data['isi_all']='welcome';
      $this->load->view('template2',$data);
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
function verify_registration($id_user=null){
    $data = array('verified'=>1);
    $this->login_model->update_user($data,$id_user);
    redirect(base_url().'index/login');
}
function cekusername($username){
    if($this->member_model->cekusername($username)){
        $this->form_validation->set_message('cekusername','username sudah ada');
        return false;
    }else {
        return true;
    }
}

function reset_password(){
    $this->form_validation->set_rules('email','email','required|xss_clean|cekemail2');
    $this->form_validation->set_rules('password','Password','required|xss_clean');

    //cek validasi
    if ($this->form_validation->run()==TRUE){
        //data valid
        $email=$this->input->post('email');
        $password=$this->input->post('password');
        //cek database apakah password dan username nya ada apa enga
        if($this->user_model->reset_password($email,$password) == TRUE){
            $this->session->set_flashdata('message','<span class="success"> password berhasil diubah </span>');
                redirect(base_url().'index/reset_password');
        }else {
        //data tidak ada
            $this->session->set_flashdata('message','<span class="error"> password gagal diubah </span>');
            redirect(base_url().'index/reset_password');
        }
    }
    $data['promo']=$this->content_model->ambil_promo();
    $data['isi_all']='form_reset_password';
    $this->load->view('template',$data);
}

function cekemail($email){
    if($this->member_model->cekemail($email)){
        $this->form_validation->set_message('cekemail','Email ini sudah terdaftar');
        return false;
    }else {
        return true;
    }
}
}
?>
