<?php

 if ( !defined('BASEPATH')) exit ('No direct script access.');


 class content_controller extends CI_Controller{
     function __construct(){
         parent:: __construct();
         $this->load->model('content_model','',TRUE);
     }


 function index(){
  $data['content']='admin/webcontent';
  $this->load->view('admin/template_admin',$data);

 }

function home(){
    if($this->input->post('simpan')){
        $savetodb=array('kategori'=>$this->input->post('kategori'),'content'=>$this->input->post('textfield'));
        $this->content_model->save_home($savetodb);
        redirect (base_url().'admin/content_controller/index');

    }
    $data['value']=$this->content_model->get_home();
    $data['content']='admin/webcontent';
    $data['subcontent']='admin/home';
    $this->load->view('admin/template_admin',$data);

}

function mission(){
    if($this->input->post('simpan')){
        $savetodb=array('kategori'=>$this->input->post('kategori'),'content'=>$this->input->post('textfield'));
        $this->content_model->save_mission($savetodb);
        redirect (base_url().'admin/content_controller/index');

    }
    $data['value']=$this->content_model->get_mission();
    $data['content']='admin/webcontent';
    $data['subcontent']='admin/mission';
    $this->load->view('admin/template_admin',$data);
}

function contact_us(){
    if($this->input->post('simpan')){
        $savetodb=array('kategori'=>$this->input->post('kategori'),'content'=>$this->input->post('textfield'));
        $this->content_model->save_contact_us($savetodb);
        redirect (base_url().'admin/content_controller/index');

    }
    $data['value']=$this->content_model->get_contact_us();
    $data['content']='admin/webcontent';
    $data['subcontent']='admin/contact_us';
    $this->load->view('admin/template_admin',$data);

}


function membership(){
     if($this->input->post('simpan')){
        $savetodb=array('kategori'=>$this->input->post('kategori'),'content'=>$this->input->post('textfield'));
        $this->content_model->save_membership($savetodb);
        redirect (base_url().'admin/content_controller/index');

    }
    $data['value']=$this->content_model->get_membership();
    $data['content']='admin/webcontent';
    $data['subcontent']='admin/membership';
    $this->load->view('admin/template_admin',$data);

}

function fasilitas($offset=null){
       $config['base_url']=base_url().'admin/content_controller/fasilitas';
       $config['total_rows']=$this->content_model->ambil_total_gambar();
       $config['per_page']=6;
       $config['uri_segment']=4;
       $config['use_page_numbers']=TRUE;
       $this->pagination->initialize($config);
       if($offset != NULL){
           $offset=($offset-1)*6;
       }else {
           $offset=$offset;
           //$offset=0;
       }
    $limit=6;
    $data['picture']=$this->content_model->ambil_gambar(null,$limit,$offset);
    $data['content']='admin/webcontent';
    $data['subcontent']='admin/list_fasilitas';
    $this->load->view('admin/template_admin',$data);
}

function tambah_gambar(){
    if($this->input->post('simpan')){
        $config['upload_path']='./images/gallery/';
        $config['allowed_types']='gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
        $config['overwrite']=true;
        $this->load->library('upload',$config);
        $this->upload->do_upload();
        $nama_gambar=$_FILES['userfile']['name'];
        $kategori_gambar=$this->input->post('jenis_lapangan');
        $date_add=date('Y-m-d');
        $store2db=array('nama_gambar'=>$nama_gambar,'kategori_gambar'=>$kategori_gambar,'date_add'=>$date_add);
        $this->content_model->simpan_gambar($store2db);
        redirect(base_url().'admin/content_controller/fasilitas');

    }
    $data['picture']=$this->content_model->ambil_gambar();
    $data['content']='admin/webcontent';
    $data['subcontent']='admin/list_fasilitas';
    $this->load->view('admin/template_admin',$data);
}

function ubah_gambar($id_gambar=null){
     if($this->input->post('simpan')){
        $config['upload_path']='./images/gallery/';
        $config['allowed_types']='gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
        $config['overwrite']=true;
        $this->load->library('upload',$config);
        $this->upload->do_upload();
        if(!empty($_FILES['userfile']['name'])){
            $nama_gambar=$_FILES['userfile']['name'];
        }
        else {
            $nama_gambar=$this->input->post('gambar');
        }
        $kategori_gambar=$this->input->post('jenis_lapangan');
        $date_add=date('Y-m-d');
        $store2db=array('nama_gambar'=>$nama_gambar,'kategori_gambar'=>$kategori_gambar,'date_add'=>$date_add);
        $this->content_model->ubah_gambar(array('id_gambar'=>$id_gambar),$store2db);
        redirect(base_url().'admin/content_controller/fasilitas');

    }
    $data['gambar']=$this->content_model->ambil_gambar(array('id_gambar'=>$id_gambar));
    $data['id_gambar']=$id_gambar;
    $data['picture']=$this->content_model->ambil_gambar();
    $data['content']='admin/webcontent';
    $data['subcontent']='admin/list_fasilitas';
    $this->load->view('admin/template_admin',$data);

}

function hapus_gambar($id_gambar=null){
    $this->content_model->hapus_gambar($id_gambar);
    redirect(base_url().'admin/content_controller/fasilitas');
}
 }

?>
