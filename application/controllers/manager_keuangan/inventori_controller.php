<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 if ( !defined('BASEPATH')) exit ('No direct script access.');


 class inventori_controller extends CI_Controller{
     function __construct(){
         parent:: __construct();
         $this->load->model('inventori_model','',TRUE);
     }

     function index ($sortby='id_barang_inventori',$sortorder='desc',$offset=NULL){
        if($this->input->post('search')){
            $like=array($this->input->post('kategori')=>$this->input->post('keyword'));
        }else {
            $like=null;
        }
       $where=null;
       $config['base_url']=base_url().'manager_keuangan/inventori_controller/index/'.$sortby.'/'.$sortorder.'/';
       $config['total_rows']=$this->inventori_model->ambil_total_inventori($like);
       $config['per_page']=6;
       $config['uri_segment']=6;
       $config['use_page_numbers']=TRUE;
       $this->pagination->initialize($config);
       if($offset != NULL){
           $offset=($offset-1)*6;
       }else {
           $offset=$offset;
       }
       $option_db=$this->inventori_model->ambil_option_barang();
       foreach($option_db as $option){
           $options[$option->id_barang_inventori][]= $option;
       }
       $data['options']=$options;
       $data['title']='Daftar Barang Inventori';
       $data ['content'] ='manager_keuangan/list_inventori';
       $data['inventori']=$this->inventori_model->ambil_inventori($where,$like,$sortby,$sortorder,6,$offset);
       $this->load->view('manager_keuangan/template_admin',$data);
     }

   
   function ubah_inventori($id_inventori){

       //proses update data
    if($this->input->post()){
       $config['upload_path']='./images/barang/';
       $config['allowed_types']='gif|jpg|jpeg|png|GIF|JPEG|PNG';
       
       $config['overwrite']=false;
       $this->load->library('upload',$config);
       $this->upload->do_upload();
       $id_categori_barang=$this->input->post('categori_id');
       $nama_barang =$this->input->post('nama_barang');
       if(!empty($_FILES['userfile']['name'])){
           $gambar_barang=$_FILES['userfile']['name'];
       }else {
           $gambar_barang=$this->input->post('gambar_barang');
       }
          //echo $this->upload->display_errors();
          
          $nama_barang=$this->input->post('nama_barang');
          $id_categori=$this->input->post('categori_id');
          $merek_barang=$this->input->post('merek_barang');
          $jumlah_barang=$this->input->post('jumlah_barang');
          $harga_sewa=$this->input->post('harga_sewa');
         //$keterangan=$this->input->post('keterangan');
          $option=$this->input->post('option');
          $option_value=$this->input->post('option_value');
          $id_option=$this->input->post('id_option');
          $i=0;
          if(!empty($option)){
          foreach($option as $o){

             $store2db2[$i]['nama_option']=$o;
             $store2db2[$i]['nilai_option']=$option_value[$i];
             $store2db2[$i]['id_option_barang']=$id_option[$i];
             $i++;
            }
                $this->inventori_model->ubah_option($store2db2);
          }
          $store2db=array('gambar_barang'=>$gambar_barang,'nama_barang'=>$nama_barang,
                          'merek_barang'=>$merek_barang, 'jumlah_barang'=>$jumlah_barang,
                          'id_categori_barang'=>$id_categori,
                          'harga_sewa'=>$harga_sewa);
          if($this->inventori_model->ubah_inventori($id_inventori,$store2db)== true){
               $this->session->set_flashdata('message','data berhasil dirubah');
              redirect (base_url().'manager_keuangan/inventori_controller');
          }else{
               $this->session->set_flashdata('message','data gagal dirubah');
              redirect (base_url().'manager_keuangan/inventori_controller');

          }
       }
       $option_db=$this->inventori_model->ambil_option_barang();
       foreach($option_db as $option){
           $options[$option->id_barang_inventori][]= $option;
       }
       $data['categori']=$this->inventori_model->ambil_kategori();
       $data['options']=$options;
       //ambil data lapangan berdasarkan id dari model
       //$data['tipe_barang']=$this->inventori_model->ambil_tipe_barang();
       $data['id_barang_inventori']=$id_inventori;
       $data['inventori']= $this->inventori_model->ambil_inventori(array('id_barang_inventori'=>$id_inventori));
        $data['title']='Ubah Barang Inventori';
       $data['content']='manager_keuangan/form_inventori';
       $this->load->view('manager_keuangan/template_admin',$data);
       //tampilkan di view


   }

 }

?>
