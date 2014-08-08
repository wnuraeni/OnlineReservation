<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if ( !defined('BASEPATH')) exit ('No direct script access.');


 class supplier_controller extends CI_Controller{
     function __construct(){
         parent:: __construct();
         $this->load->model('supplier_model','',TRUE);
     }


 function index($offset = NULL){
     $where=null;
     if($this->input->post()){
         $keyword=$this->input->post('keyword');
         $categori=$this->input->post('categori');
         $like=array($categori=>$keyword);
     }else{
         $like=null;    
     }
       $config['base_url']=base_url().'manager_gudang/supplier_controller/index';
       $config['total_rows']=$this->supplier_model->ambil_total_supplier($like);
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
    
     $data['title']='Daftar Supplier';
     $data['content']='manager_gudang/list_supplier';
     $data['supplier']=$this->supplier_model->ambil_supplier(null,$like,6,$offset);
     //$data['supplier']=$this->supplier_model->ambil_supplier($where,$like,6,$offset);
     $this->load->view('manager_gudang/template_admin',$data);


 }

 function tambah_supplier(){
  $this->form_validation->set_rules('nama','nama','required|callback_checknama');
  $this->form_validation->set_rules('alamat','nama','required');
  $this->form_validation->set_rules('kota','kota','required');
  $this->form_validation->set_rules('telepon','telepon','required');
  $this->form_validation->set_rules('cp_nama','cp_nama','required');
  if($this->form_validation->run()==true){
         $store2db=array('nama'=>$this->input->post('nama'),
                         'alamat'=>$this->input->post('alamat'),
                          'kota'=>$this->input->post('kota'),
                          'telepon'=>$this->input->post('telepon'),
                          'cp_nama'=>$this->input->post('cp_nama'));

         if($this->supplier_model->tambah_supplier($store2db)== true){
              $this->session->set_flashdata('message','data berhasil ditambah');
             redirect (base_url().'manager_gudang/supplier_controller');
         }
         else{
             $this->session->set_flashdata('message','data gagal ditambah');
             redirect (base_url().'manager_gudang/supplier_controller');
         }
     }
     $data['title']='Tambah Supplier';
     $data['content']='manager_gudang/form_supplier';
     $this->load->view('manager_gudang/template_admin',$data);

 }

function ubah_supplier($id_supplier){
  if($this->input->post()){
         $nama=$this->input->post('nama');
         $alamat=$this->input->post('alamat');
         $kota=$this->input->post('kota');
         $telepon=$this->input->post('telepon');
         $cp_nama=$this->input->post('cp_nama');

         $store2db=array('nama'=>$nama,'alamat'=>$alamat,'kota'=>$kota,
                         'telepon'=>$telepon,'cp_nama'=>$cp_nama);

        /* $store2db=array('nama'=>$this->input->post('nama'),
                         'alamat'=>$this->input->post('alamat'),
                          'kota'=>$this->input->post('kota'),
                          'telepon'=>$this->input->post('telepon'),
                          'cp_nama'=>$this->input->post('cp_nama'));*/

         if($this->supplier_model->ubah_supplier($id_supplier,$store2db)== TRUE){
              $this->session->set_flashdata('message','data berhasil ditambah');
             redirect (base_url().'manager_gudang/supplier_controller');
         }
         else{
             $this->session->set_flashdata('message','data gagal ditambah');
             redirect (base_url().'manager_gudang/supplier_controller');
         }
     }
     $data['id_supplier']=$id_supplier;
     $data['supplier']=$this->supplier_model->ambil_supplier(array('id_supplier'=>$id_supplier));
     $data['title']='Ubah Supplier';
     $data['content']='manager_gudang/form_supplier';
     $this->load->view('manager_gudang/template_admin',$data);

}


function delete_supplier($id_supplier){
 if($this->supplier_model->delete_supplier($id_supplier)== true){
              $this->session->set_flashdata('message','data berhasil ditambah');
             redirect (base_url().'manager_gudang/supplier_controller');
         }
         else{
             $this->session->set_flashdata('message','data gagal ditambah');
             redirect (base_url().'manager_gudang/supplier_controller');
         }
}

function checknama($nama){
    if($this->supplier_model->checknama($nama)){
        $this->form_validation->set_message('checknama','maaf nama supplier sudah ada');
        return false;
    }else {
        return true;
    }

}


 }


?>
