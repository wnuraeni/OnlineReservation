<?php

//if ( !defined('BASEPATH')) exit ('No direct script access.');

class karyawan_model extends CI_Model{
    function __contruct(){
        parent :: __construct();
    }

   function ambil_karyawan($where=NULL,$like=null,$limit=6,$offset=0){
       $this->db->select('*');
       $this->db->from('karyawan');
       $this->db->join('user','user.user_id=karyawan.user_id','left');
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


   function ambil_total_karyawan($where){
       $this->db->select('*');
       $this->db->from('karyawan');
       if(!empty($where)){
           $this->db->where($where);
       }
       $query=$this->db->get();
       return $query->num_rows();
   }

   function ubah_karyawan($id_karyawan,$data){
       $this->db->where('id_karyawan',$id_karyawan);
       $this->db->update('karyawan',$data);
       if($this->db->affected_rows()> 0 ){
           return true;
       }else {
           return false;
       }
   }

   function delete_karyawan($id_karyawan){
      if($this->db->delete('karyawan',array('id_karyawan'=>$id_karyawan))){
         return true;
      } else {
         return false;
      }
    }

    function tambah_karyawan($data){
        $this->db->insert('karyawan',$data);

    }


   

}
?>
