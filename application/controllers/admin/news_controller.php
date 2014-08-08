<?php
if ( !defined('BASEPATH')) exit ('No direct script access.');


 class news_controller extends CI_Controller{
     function __construct(){
         parent:: __construct();
         $this->load->model('content_model','',TRUE);
     }


 function index($offset=null){
      $limit=5;
      $config['base_url']=base_url().'admin/news_controller/index';
       $config['total_rows']=$this->content_model->ambil_total_news();
       $config['per_page']=6;
       $config['uri_segment']=4;
       $config['use_page_numbers']=TRUE;
       $this->pagination->initialize($config);
       if($offset != NULL){
           $offset=($offset-1)*$limit;
       }else {
           $offset=$offset;
       }

     $data['news']=$this->content_model->ambil_news(null,$limit,$offset);
     $data['content']='admin/webcontent';
     $data['subcontent']='admin/news';
     $this->load->view('admin/template_admin',$data);
 }


function tambah(){
    if($this->input->post('simpan')){
       $config['upload_path']='./images/news/';
       $config['allowed_types']='gif|jpg|jpeg|png|GIF|JPEG|PNG';
       //$config['max_size']='100';
       //$config['max_width']='1024';
       //$config['max_height']='768';
       $config['overwrite']=false;
       $this->load->library('upload',$config);
       if($this->upload->do_upload()){
           $gambar=$_FILES['userfile']['name'];
       }else {
           $gambar='';
       }
        $store2db=array('judul'=>$this->input->post('judul'),'gambar_news'=>$gambar,
                        'tanggal_dibuat'=>$this->input->post('tanggal'),'news'=>$this->input->post('news'));
     $this->content_model->tambah_news($store2db);
     redirect (base_url().'admin/news_controller/index');

    }
    $data['content']='admin/webcontent';
    $data['subcontent']='admin/form_news';
    $this->load->view('admin/template_admin',$data);

}

function hapus($id_news){
    $this->content_model->hapus_news($id_news);
    redirect(base_url().'admin/news_controller/index');

}

function ubah($id_news){
    if($this->input->post('simpan')){
       $config['upload_path']='./images/news/';
       $config['allowed_types']='gif|jpg|jpeg|png|GIF|JPEG|PNG';
       //$config['max_size']='100';
       //$config['max_width']='1024';
       //$config['max_height']='768';
       $config['overwrite']=false;
       $this->load->library('upload',$config);
       if(!empty($_FILES['userfile']['name'])){
           $this->upload->do_upload();
           $gambar=$_FILES['userfile']['name'];
       }else {
           $gambar=$this->input->post('gambar');
       }
       $store2db=array('judul'=>$this->input->post('judul'),'gambar_news'=>$gambar,
                        'tanggal_dibuat'=>$this->input->post('tanggal'),'news'=>$this->input->post('news'));
       $this->content_model->ubah_news($id_news,$store2db);
       redirect (base_url().'admin/news_controller/index');
    }
     $data['news']=$this->content_model->ambil_news(array('id_news'=>$id_news));
     $data['content']='admin/webcontent';
      $data['subcontent']='admin/form_news';
     $this->load->view('admin/template_admin',$data);


}


 }
?>
