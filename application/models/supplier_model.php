<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//if ( !defined('BASEPATH')) exit ('No direct script access.');

 class supplier_model extends CI_Model{
    function __construct(){
        parent :: __construct();
   }


 function ambil_supplier($where=NULL,$like=null,$limit=6,$offset=0){
       $this->db->select('*');
       $this->db->from('supplier');
      
       if(!empty($where)){
           $this->db->where($where);
       }
       if(!empty($like)){
           $this->db->like($like);
       }
       $this->db->limit($limit,$offset);
       $query=$this->db->get();
       
       return $query->result();
   }

/*function ambil_supplier($where=null,$like=null,$limit=null,$offset=null){
       $this->db->select('*');
       $this->db->from('supplier');
       if($like != null){
           $this->db->like($like);
       }
       if($where != null){
           $this->db->where($where);
       }
       //if($limit!=null && $offset!= null){
           $this->db->limit($limit,$offset);
      // }
       $query=$this->db->get();
      
       return $query->result();

}*/

function ambil_total_supplier($like=null){
    $this->db->select('*');
    $this->db->from('supplier');
    if(!empty ($like)){
        $this->db->like($like);
    }
    $query=$this->db->get();
    return $query->num_rows();
}


function tambah_supplier($data){
       if($this->db->insert('supplier',$data)){
           return $this->db->insert_id();
       }ELSE {
           return FALSE;
       }

   }

function delete_supplier($id_supplier){
      if($this->db->delete('supplier',array('id_supplier'=>$id_supplier))){
          return true;
      } else {
          return false;
      }

   }

   function ubah_supplier($id_supplier,$store2db){
       // $query=$this->db->get_where('lapangan',array('jenis_lapangan'=>$jenis_lapangan));
      // return $query->result();
      $this->db->where('id_supplier',$id_supplier);
      $query=$this->db->update('supplier',$store2db);
      if($query){
          return true;
      }else{
          return false;
      }

   }

   function checknama($nama){
       $query=$this->db->get_where('supplier',array('nama'=>$nama));
       $result=$query->num_rows();
       if($result > 0 ){
           return true;
       }else {
           return false;
       }
   }

 }

?>
