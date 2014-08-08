<?php
 if ( !defined('BASEPATH')) exit ('No direct script access.');

 class promosi_controller extends CI_Controller{
    function __construct(){
        parent :: __construct();
         $this->load->model('promosi_model','',TRUE);

   }



   function index(){
       $data['promo']=$this->promosi_model->ambil_promosi();
       $data['title']='Data Promosi';
       $data['content']='manager_keuangan/list_promo';
       $this->load->view('manager_keuangan/template_admin',$data);

   }

   function tambah_promo(){
       if($this->input->post('simpan')){
           $store2db=array('nama_promo'=>$this->input->post('nama_promo'),'deskripsi'=>$this->input->post('deskripsi'),
                            'diskon'=>$this->input->post('diskon'),'periode_awal'=>$this->input->post('periode_awal'),
                             'periode_akhir'=>$this->input->post('periode_akhir'));
           $this->promosi_model->tambah($store2db);
           redirect (base_url().'manager_keuangan/promosi_controller/index');
       }
       $data['title']='Form Promosi';
       $data['content']='manager_keuangan/form_promosi';
       $this->load->view('manager_keuangan/template_admin',$data);
   }

   function ubah_promo($id_promo=null){
       if($this->input->post('simpan')){
            $store2db=array('nama_promo'=>$this->input->post('nama_promo'),'deskripsi'=>$this->input->post('deskripsi'),
                            'diskon'=>$this->input->post('diskon'),'periode_awal'=>$this->input->post('periode_awal'),
                             'periode_akhir'=>$this->input->post('periode_akhir'));
           $this->promosi_model->ubah($id_promo,$store2db);
           redirect (base_url().'manager_keuangan/promosi_controller/index');

       }
       $data['id_promo']=$id_promo;
       $data['promo']=$this->promosi_model->ambil_promosi(array('id_promo'=>$id_promo));
       $data['title']='Form Promosi';
       $data['content']='manager_keuangan/form_promosi';
       $this->load->view('manager_keuangan/template_admin',$data);

   }

   function hapus_promo($id_promo=null){
       $this->promosi_model->hapus_promo($id_promo);
       redirect(base_url().'manager_keuangan/promosi_controller/index');

   }


 }
?>
