<?php
//if ( !defined('BASEPATH')) exit ('kasir index No direct script allowed');



 class index extends CI_Controller {

     function __construct (){
             parent :: __construct();
             $this->load->model('login_model','',TRUE);

     }

     /*function index(){
         $data['content']='kasir/home';
         $this->load->view('kasir/template_admin',$data);
         
     }*/
	function index(){
            //kl sudah login ke view admin kl blm ke view login
          if($this->session->userdata('iskasir')== TRUE){
                 $this->load->view('kasir/template_admin');
           }else {
               $this->load->view('admin/login_view');
           }
        }

     function penyewaan(){
         $data['content']='kasir/penyewaan';
         $this->load->view('kasir/template_admin',$data);

     }

     function logout(){
        $this->session->unset_userdata('iskasir');
        $this->session->unset_userdata('kasirname');
        $this->session->unset_userdata('idkasir');
        $this->session->unset_userdata('accesskasir');
        redirect(base_url().'admin');
    }

     
 }
?>
