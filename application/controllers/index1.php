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
         $this->load->model('user_model','',TRUE);
     }

    function index (){
        $data['promo']=$this->content_model->ambil_promo();
       $data['text']=$this->content_model->get_home();
      $data['isi_all']='home';
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
                 redirect(base_url().$this->session->userdata('backlink'));
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
    $this->form_validation->set_rules('password','password','required');
    $this->form_validation->set_rules('nama','nama','required');
    $this->form_validation->set_rules('alamat','alamat','required');
    $this->form_validation->set_rules('email','email','required|callback_cekemail');
    $this->form_validation->set_rules('telepon','telepon','required');
    if($this->form_validation->run()== true){
        $data1=array('user_name'=>$this->input->post('username'),'password'=>md5($this->input->post('password')),
                      'nama'=>$this->input->post('nama'),'email'=>$this->input->post('email'),'jabatan'=>'user');
       $id_user=$this->member_model->tambah_user($data1);
       $id_member=substr($this->input->post('nama'),0,1).$id_user;
        $data2=array('user_id'=>$id_user,'nama_pelanggan'=>$this->input->post('nama'),
                        'id_member'=>$id_member,
                       'alamat_pelanggan'=>$this->input->post('alamat'),
                       'telepon_pelanggan'=>$this->input->post('telepon'));
        $this->member_model->tambah_member($data2);
        redirect (base_url().'index/konfirmasi_register');
    }
    $data['isi_all']='form_registrasi';
    $this->load->view('template2',$data);
}

function konfirmasi_register(){
      $data['promo']=$this->content_model->ambil_promo();
      $data['isi_all']='welcome';
      $this->load->view('template2',$data);


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

function cekemail2($email){
    if($this->member_model->cekemail($email)){

        return true;
    }else {
        $this->form_validation->set_message('cekemail2','email'.$email.'tidak terdaftar');
        return false;
    }
}

  }
?>