<?php

//if ( !defined('BASEPATH')) exit ('No direct script access.');

class inventori_model extends CI_Model{
    function __construct(){
        parent :: __construct();
    }

   function tambah($data){
       if($this->db->insert('barang_inventori',$data)){
           $id=$this->db->insert_id();
           if(isset($data['id_categori_barang'])){
           $this->db->query("update categori_barang set `jumlah_total` = `jumlah_total`+".$data['jumlah_barang'].
                            " where id_categori_barang = '".$data['id_categori_barang']."'");
           }
           return $id;
       }else {
           return FALSE;
       }

   }

function ubah_option($data){
    $this->db->update_batch('option_barang',$data,'id_option_barang');
    
}


function ambil_option_barang(){
   $query=$this->db->get('option_barang');
   return $query->result();
}

 function tambah_option($data){
    if($this->db->insert_batch('option_barang',$data)) {
        return true;
    }else {
        return false;
    }
 }

 function tambah_option2($data){
     if($this->db->insert('option_barang',$data)) {
        return true;
    }else {
        return false;
    }
 }

function ambil_inventori($where=null,$like=null,$sortby='id_barang_inventori',$sortorder='desc',$limit=30,$offset=0){
       //$query=$this->db->get_where('barang_inventori',$data);
       $this->db->select('*');
       $this->db->from('barang_inventori');
       if($like != null){
           $this->db->like($like);
       }
       if($where != null){
           $this->db->where($where);
       }
       $this->db->join('categori_barang','barang_inventori.id_categori_barang=categori_barang.id_categori_barang','left');
       $this->db->order_by($sortby,$sortorder);
       //if($limit!=null && $offset!= null){
           $this->db->limit($limit,$offset);
      // }
       $query=$this->db->get();
       return $query->result();

   }

 function ambil_total_inventori($where){
     $this->db->select('*');
     $this->db->from('barang_inventori');
     $this->db->join('categori_barang','barang_inventori.id_categori_barang=categori_barang.id_categori_barang');
     if(!empty($where)){
         $this->db->where($where);
     }
    $query=$this->db->get();
     return $query->num_rows();
 }

   function delete_inventori($id_inventori){
      if($this->db->delete('barang_inventori',array('id_barang_inventori'=>$id_inventori))){
          return true;
      } else {
          return false;
      }

   }

   function ubah_inventori($id_inventori,$store2db){
       // $query=$this->db->get_where('lapangan',array('jenis_lapangan'=>$jenis_lapangan));
      // return $query->result();
      $this->db->where('id_barang_inventori',$id_inventori);
      $query=$this->db->update('barang_inventori',$store2db);
      if($query){
          return true;
      }else{
          return false;
      }

   }

   function tambah_kategori($data){
       if($this->db->insert('categori_barang',$data)){
           return true;

       }else{
           return false;
       }
   }

  /* function ambil_tipe_barang(){
       $this->db->select('tipe_barang');
       $this->db->from('barang_inventori');
       $this->db->group_by('tipe_barang');
       $query=$this->db->get();
       return $query->result();
   }

  function ambil_nama_barang($tipe_barang){
      $this->db->select('nama_barang');
      $this->db->from('barang_inventori');
      $this->db->where('tipe_barang',$tipe_barang);
      $query=$this->db->get();
      return $query->result();
  }

  function cek_nama_barang($nama_barang,$tipe_barang){
     $query=$this->db->get_where('barang_inventori',array('nama_barang'=>$nama_barang,'tipe_barang'=>$tipe_barang));
     if($query->num_rows()> 0){
         return true;
     }else{
         return false;
     }
  }*/

  function cek_kode_barang($kode_barang){
     $query=$this->db->get_where('barang_inventori',array('kode_barang'=>$kode_barang));
     if($query->num_rows()> 0){
         return true;
     }else{
         return false;
     }
  }

function cek_nama_kategori($categori){
     $query=$this->db->get_where('categori_barang',array('categori'=>$categori));
     if($query->num_rows()> 0){
         return true;
     }else{
         return false;
     }

}

  function ambil_kode_barang($nama_barang,$merek_barang){
      $this->db->select('kode_barang,id_barang_inventori');
      $this->db->from('barang_inventori');
      $this->db->where('nama_barang',$nama_barang);
      $this->db->where('merek_barang',$merek_barang);
      $query=$this->db->get();
      return $query->row();

  }

  function ambil_merek_barang($nama_barang){
      $this->db->select('merek_barang');
      $this->db->from('barang_inventori');
      $this->db->where('nama_barang',$nama_barang);
      $query=$this->db->get();
      return $query->result();
  }

function ambil_kategori($where = NULL,$where2=null){
   $this->db->select('*');
   $this->db->from('categori_barang');
   if(!empty ($where)){
        $this->db->where('id_categori_barang',$where);

   }
   if(!empty($where2)){
       $this->db->where($where2);

   }
    $this->db->order_by('id_categori_barang','asc');
    $query=$this->db->get();
    return $query->result();
}

function ambil_nama_categori(){
   $this->db->select('*');
   $this->db->from('categori_barang');
    $this->db->where('parent_id != ','0');
    $query=$this->db->get();
    return $query->result();

}

function ubah_kategori($id_categori_barang,$data){
    $this->db->where('id_categori_barang',$id_categori_barang);
    if($this->db->update('categori_barang',$data)){
        return true;
    }else {
        return false;
    }
}

function delete_kategori($id_categori_barang){
    if($this->db->delete('categori_barang',array('id_categori_barang'=>$id_categori_barang))){
        return true;
    }else {
        return false;
    }

}

function tambah_barang_rusak($data){
    $this->db->query("update barang_inventori SET `jumlah_barang`=`jumlah_barang`-".$data['jumlah']." WHERE `id_barang_inventori`='".$data['id_barang_inventori']."'");
 
    if($this->db->insert('barang_rusak',$data)){
        $id_barang_rusak=$this->db->insert_id();
        $this->db->query("update barang_rusak SET `jumlah_perbaikan`=`jumlah_perbaikan`+1 WHERE `id_barang_rusak`='".$id_barang_rusak."'");
        return true;
    }else {
        return false;
    }
}

function ambil_barang_rusak($like=null,$sortby='barang_inventori.nama_barang',$sortorder='asc',$limit=10,$offset=0){
    $this->db->select('*');
    $this->db->from('barang_rusak');
    $this->db->join('barang_inventori','barang_rusak.id_barang_inventori=barang_inventori.id_barang_inventori');
    if(!empty($like)){
        $this->db->like($like);
    }
    $this->db->order_by($sortby,$sortorder);
    $this->db->limit($limit,$offset);
    $query=$this->db->get();
    return $query->result();
}

function barang_rusak_kembali($id_barang_rusak){
    $this->db->where('id_barang_rusak',$id_barang_rusak);
    if($this->db->update('barang_rusak',array('status'=>'selesai diperbaiki'))){
      $barang_rusak=$this->db->get_where('barang_rusak',array('id_barang_rusak'=>$id_barang_rusak));
      $result=$barang_rusak->row();
      $this->db->query("update barang_inventori SET `jumlah_barang`=`jumlah_barang`+".$result->jumlah." WHERE `id_barang_inventori`='".$result->id_barang_inventori."'");
      return true;
    }else{
        return false;
    }
}

function cek_jumlah_barang($jumlah_barang_rusak,$id_barang_inventori){
    $query=$this->db->get_where('barang_inventori',array('id_barang_inventori'=>$id_barang_inventori));
    $result=$query->row();
    $stock=$result->jumlah_barang;
    $sisa=$stock-$jumlah_barang_rusak;
    if($sisa < 0){
        return true;
    }else {
        return false;
    }
}

function ambil_total_barang_rusak(){
    $query=$this->db->get('barang_rusak');
    return $query->num_rows();
}

function sewa_barang($id_barang,$data){
    $this->db->set('jumlah_barang','jumlah_barang-'.$data['jumlah_barang'],false);
    $this->db->where('id_barang_inventori',$id_barang);
    $this->db->update('barang_inventori');
    
}

function detail_sewa_barang($data){
    $this->db->insert_batch('penyewaan_barang',$data);
    return $this->db->insert_id();

}

function generate_image_inventori(){
    $parent_query=$this->db->get_where('categori_barang',array('parent_id'=>'0'));
    $parent_result=$parent_query->result();
    $parent=array();
    foreach($parent_result as $result){
        $parent[$result->id_categori_barang]=$result->categori;

    }
    $this->db->select('*');
    $this->db->from('barang_inventori');
    $this->db->join('categori_barang','barang_inventori.id_categori_barang=categori_barang.id_categori_barang','left');
    $this->db->where('barang_inventori.jumlah_barang !=','0');
    $query=$this->db->get();
    $result=$query->result();
   
    $i=0;
    $barang=array();
    foreach($result as $r){
        if(!empty($r->parent_id)){
            $barang[$parent[$r->parent_id]][]=$r;
        }
        
    }
  //print_r($barang);
      return $barang;
    }
    
function set_salvage_value($id_categori,$data){
    $this->db->where('id_categori_barang',$id_categori);
    $this->db->update('categori_barang',$data);
    

}

}
?>
