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
       $config['base_url']=base_url().'manager_gudang/inventori_controller/index/'.$sortby.'/'.$sortorder.'/';
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
       $data ['content'] ='manager_gudang/list_inventori';
       $data['inventori']=$this->inventori_model->ambil_inventori($where,$like,$sortby,$sortorder,6,$offset);
       $this->load->view('manager_gudang/template_admin',$data);
     }

   function tambah_inventori(){
    $this->session->set_userdata('previous',$this->uri->uri_string());
    if($this->input->post()){
       $config['upload_path']='./images/barang/';
       $config['allowed_types']='gif|jpg|jpeg|png|GIF|JPEG|PNG';
       $config['overwrite']=false;
       $this->load->library('upload',$config);
       //echo $this->upload->display_errors();
      
       $id_categori_barang=$this->input->post('categori_id');
       $nama_barang =$this->input->post('nama_barang');
       ($this->upload->do_upload());
           $gambar_barang=$_FILES['userfile']['name'];
      
      // echo $this->upload->display_errors();
       $harga_sewa=$this->input->post('harga_sewa');
       $merek_barang=$this->input->post('merek_barang');
       $option=$this->input->post('option');
       $option_value=$this->input->post('option_val');
       //$tipe_barang=$this->input->post('tipe_barang');
       $jumlah_barang=$this->input->post('jumlah_barang');
       $harga_sewa=$this->input->post('harga_sewa');
       //$keterangan=$this->input->post('keterangan');
       $store2db=array('id_categori_barang'=>$id_categori_barang,'nama_barang'=>$nama_barang,'merek_barang'=>$merek_barang,'gambar_barang'=>$gambar_barang
                       ,'jumlah_barang'=>$jumlah_barang,'harga_sewa'=>$harga_sewa);
       $store2db2=array();
       if($id_barang_inventori=$this->inventori_model->tambah($store2db)){
           if(count ($option) > 0){
               $i=0;
             if(!empty($option))  {
               foreach($option as $o){

                   $store2db2[$i]['nama_option']=$o;
                   $store2db2[$i]['nilai_option']=$option_value[$i];
                   $store2db2[$i]['id_barang_inventori']=$id_barang_inventori;
                   $i++;
               }
               
               $this->inventori_model->tambah_option($store2db2);
           }
         }
          $this->session->set_flashdata('message','data berhasil ditambah');
          redirect (base_url().'manager_gudang/inventori_controller');
       }
       else {
          $this->session->set_flashdata('message','data gagal ditambah');
          redirect (base_url().'manager_gudang/inventori_controller');

       }
      /*if($this->inventori_model->tambah("insert into barang_inventori values(
        '".$this->input->post('jumlah_barang')."',
        '".$this->input->post('harga_sewa')."')")==TRUE){
          $this->session->set_flashdata('message','data berhasil ditambah');
          redirect (base_url().'manager_gudang/inventori_controller');
      }else {
          $this->session->set_flashdata('message','data gagal ditambah');
          redirect (base_url().'manager_gudang/inventori_controller');
      }*/
    }
     //$data['tipe_barang']=$this->inventori_model->ambil_tipe_barang();
       $data['categori']=$this->inventori_model->ambil_nama_categori();
       $data['title']='Tambah Barang Inventori';
       $data['content']='manager_gudang/form_inventori';
       $this->load->view('manager_gudang/template_admin',$data);
    }


   function delete_inventori($id_inventori){
      if($this->inventori_model->delete_inventori($id_inventori)== TRUE){
          $this->session->set_flashdata('message','data berhasil dihapus');
          redirect (base_url().'manager_gudang/inventori_controller');
      }else {
       $this->session->set_flashdata('message','data gagal dihapus');
       redirect (base_url().'manager_gudang/inventori_controller');
   }
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
              redirect (base_url().'manager_gudang/inventori_controller');
          }else{
               $this->session->set_flashdata('message','data gagal dirubah');
              redirect (base_url().'manager_gudang/inventori_controller');

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
       $data['content']='manager_gudang/form_inventori';
       $this->load->view('manager_gudang/template_admin',$data);
       //tampilkan di view


   }

   function tambah_kategori(){
       if($this->input->post()){
           $this->form_validation->set_rules('parent_categori','parent_categori','required');
           $this->form_validation->set_rules('nama_categori','nama_categori','required||callback_cek_nama_kategori');
           if($this->form_validation->run()==true){
               $parent_categori=$this->input->post('parent_categori');
               $nama_categori=$this->input->post('nama_categori');
               $store2db=array('parent_id'=>$parent_categori,'categori'=>$nama_categori);
            if($this->inventori_model->tambah_kategori($store2db)== true){
               $this->session->set_flashdata('message','<div class="Status success"><span>Sukses</span>Data berhasil ditambah</div>');
               $previous=$this->session->userdata('previous');
               if(!empty($previous)){
                   redirect(base_url().$previous);
               }else{
                   redirect(base_url().'manager_gudang/inventori_controller/kategori');
               }
            }else{
               $this->session->set_flashdata('message','<div class="Status error"><span>Error</span>Data tidak berhasil ditambah</div>');
               redirect(base_url().'manager_gudang/inventori_controller/kategori');
           }
         }else{
            $data['parents']=$this->inventori_model->ambil_kategori(null,array('parent_id'=>0));
            $data['kategori']=$this->inventori_model->ambil_kategori();
            $data['title']='Tambah Kategori Barang';
            $data['content']='manager_gudang/form_kategori';
            $this->load->view('manager_gudang/template_admin',$data);
         }
           
       }
       $data['parents']=$this->inventori_model->ambil_kategori(null,array('parent_id'=>0));
       $data['kategori']=$this->inventori_model->ambil_kategori();
       $data['title']='Tambah Tipe dan Nama Barang';
       $data['content']='manager_gudang/form_kategori';
       $this->load->view('manager_gudang/template_admin',$data);
   }

  function ambil_nama_barang(){
      $tipe_barang=$this->input->post('tipe');
      $nama_barang=$this->inventori_model->ambil_nama_barang($tipe_barang);
      $option='';
      foreach($nama_barang as $nama){
          $option.='<option value="'.$nama->nama_barang.'">'.$nama->nama_barang.'</option>';
      }
      echo json_encode(array('html'=>$option));
  }

  function cek_nama_barang($nama_barang){
      if($this->inventori_model->cek_nama_barang($nama_barang,$this->input->post('tipe'))){
          $this->form_validation->set_message('cek_nama_barang','nama barang tersebut sudah ada');
          return false;
      }else{
          return true;
    }

  }
  
  function cek_nama_kategori($nama_categori){
      if($this->inventori_model->cek_nama_kategori($nama_categori)){
          $this->form_validation->set_message('cek_nama_kategori','kategori tersebut sudah ada');
          return false;
      }else{
          return true;
    }
 
      
  }



  function cek_kode_barang($kode_barang){
      if($this->inventori_model->cek_kode_barang($kode_barang)){
          $this->form_validation->set_message('cek_kode_barang','kode barang tersebut sudah ada');
          return false;
      }else{
          return true;
    }

  }

  function kategori(){
       $data['parents']=$this->inventori_model->ambil_nama_categori();
       $data['kategori']=$this->inventori_model->ambil_kategori();
       $data['title']='Daftar Kategori Barang';
       $data['content']='manager_gudang/form_kategori';
       $this->load->view('manager_gudang/template_admin',$data);

  }

  function ubah_kategori($id_categori_barang){
       if($this->input->post()){
           $this->form_validation->set_rules('parent_categori','parent_categori','required');
           $this->form_validation->set_rules('nama_categori','nama_categori','required');
         if($this->form_validation->run()==true){
           $store2db=array('categori'=>$this->input->post('nama_categori'));
           if($this->inventori_model->ubah_kategori($id_categori_barang,$store2db)){
               $this->session->set_flashdata('message','<div class="Status success"><span>Sukses</span>Data berhasil ditambah</div>');
               redirect(base_url().'manager_gudang/inventori_controller/tambah_kategori');
           }else{
               $this->session->set_flashdata('message','<div class="Status error"><span>Error</span>Data tidak berhasil ditambah</div>');
               redirect(base_url().'manager_gudang/inventori_controller/tambah_kategori');
           }
        }
     }
       $data['id_categori_barang']=$id_categori_barang;
       $data['data_edit']=$this->inventori_model->ambil_kategori($id_categori_barang);
       $data['parents']=$this->inventori_model->ambil_kategori();
       $data['kategori']=$this->inventori_model->ambil_kategori();
       $data['title']='Ubah Kategori Barang';
       $data['content']='manager_gudang/form_kategori';
       $this->load->view('manager_gudang/template_admin',$data);
  }

  function delete_kategori($id_categori_barang){
      if($this->inventori_model->delete_kategori($id_categori_barang)== true){
           $this->session->set_flashdata('message','<div class="Status success"><span>Sukses</span>Data berhasil ditambah</div>');
           redirect(base_url().'manager_gudang/inventori_controller/kategori');
      }else{
          $this->session->set_flashdata('message','<div class="Status error"><span>Error</span>Data tidak berhasil ditambah</div>');
          redirect(base_url().'manager_gudang/inventori_controller/kategori');
      }

  }

  function ambil_kode_barang(){
      $nama_barang=$this->input->post('nama');
      $merek_barang=$this->input->post('merek');
      $kode_barang=$this->inventori_model->ambil_kode_barang($nama_barang,$merek_barang);
      $kode=$kode_barang->kode_barang;
      $id=$kode_barang->id_barang_inventori;
      echo json_encode(array('kode'=>$kode,'id'=>$id));

  }

  function ambil_merek_barang(){
      $nama_barang=$this->input->post('nama');
      $merek_barang=$this->inventori_model->ambil_merek_barang($nama_barang);
      $option='';
      foreach($merek_barang as $merek){
          $option.='<option value="'.$merek->merek_barang.'">'.$merek->merek_barang.'</option>';
      }
      echo json_encode(array('html'=>$option));

  }


 function barang_rusak($sortby='barang_inventori.nama_barang',$sortorder='asc',$offset=0){
     if($this->input->post('search')){
            $like=array($this->input->post('kategori')=>$this->input->post('keyword'));
        }else {
            $like=null;
        }
       $where=null;
       $config['base_url']=base_url().'manager_gudang/inventori_controller/barang_rusak/'.$sortby.'/'.$sortorder.'/';
       $config['total_rows']=$this->inventori_model->ambil_total_barang_rusak();
       $config['per_page']=6;
       $config['uri_segment']=6;
       $config['use_page_numbers']=TRUE;
       $this->pagination->initialize($config);
       if($offset != NULL){
           $offset=($offset-1)*6;
       }else {
           $offset=$offset;
       }
      $data['barang_rusak']=$this->inventori_model->ambil_barang_rusak($like,$sortby,$sortorder,6,$offset);
      $data['title']="Barang Rusak";
      $data['content']='manager_gudang/barang_rusak';
      $this->load->view('manager_gudang/template_admin',$data);

  }

function barang_rusak_kembali($id_barang_rusak){
   if($this->inventori_model->barang_rusak_kembali($id_barang_rusak)== true){
        $this->session->set_flashdata('message','<div class="Status success"><span>Sukses</span>Data berhasil ditambah</div>');
        redirect(base_url().'manager_gudang/inventori_controller/');
   }else {
       $this->session->set_flashdata('message','<div class="Status error"><span>Error</span>Data tidak berhasil ditambah</div>');
        redirect(base_url().'manager_gudang/inventori_controller/');
   }
}



function tambah_barang_rusak($id_barang_inventori){
    $this->form_validation->set_rules('jumlah_barang_rusak','jumlah_barang','callback_cek_jumlah');
    if($this->input->post()){
        if($this->form_validation->run()== true){
        $jumlah_barang_rusak=$this->input->post('jumlah_barang_rusak');
        $tanggal_perbaikan=$this->input->post('tanggal_perbaikan');
        $harga_perbaikan=$this->input->post('harga_perbaikan');
        $store2db=array('jumlah'=>$jumlah_barang_rusak,'tanggal_perbaikan'=>$tanggal_perbaikan,
                        'harga_perbaikan'=>$harga_perbaikan,'id_barang_inventori'=>$id_barang_inventori,'status'=>'dalam perbaikan');
        if($this->inventori_model->tambah_barang_rusak($store2db)== true){
           $this->session->set_flashdata('message','<div class="Status success"><span>Sukses</span>Data berhasil ditambah</div>');
           redirect(base_url().'manager_gudang/inventori_controller/');
        }else {
             $this->session->set_flashdata('message','<div class="Status error"><span>Error</span>Data tidak berhasil ditambah</div>');
             redirect(base_url().'manager_gudang/inventori_controller/');
        }
       }else {
            $data['id_barang_inventori']=$id_barang_inventori;
            $data['inventori']=$this->inventori_model->ambil_inventori(array('id_barang_inventori'=>$id_barang_inventori));
            $data['title']='Form Barang Rusak';
            $data['content']='manager_gudang/form_barang_rusak';
            $this->load->view('manager_gudang/template_admin',$data);
       }

    }
    $data['id_barang_inventori']=$id_barang_inventori;
    $data['inventori']=$this->inventori_model->ambil_inventori(array('id_barang_inventori'=>$id_barang_inventori));
    $data['title']='Form Barang Rusak';
    $data['content']='manager_gudang/form_barang_rusak';
    $this->load->view('manager_gudang/template_admin',$data);
}

function cek_jumlah($jumlah_barang_rusak){
    if($this->inventori_model->cek_jumlah_barang($jumlah_barang_rusak,$this->input->post('id_barang_inventori'))){
        $this->form_validation->set_message('cek_jumlah','Maaf jumlah barang yang diinput melebihi stock');
        return false;
    }else {
        return true;
    }
}

 }

?>
