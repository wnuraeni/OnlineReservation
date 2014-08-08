<?php

//if ( !defined('BASEPATH')) exit ('No direct script access.');

class user_model extends CI_Model{
    function __contruct(){
        parent :: __construct();
    }

   function tambah($data){
       if($this->db->insert('user',$data)){
           return $this->db->insert_id();
       }ELSE {
           return FALSE;
       }

   }

   function ambil_user($where=NULL,$like=null,$limit=6,$offset=0){
       $this->db->select('*');
       $this->db->from('user');
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

   function ambil_total_user($where){
       $this->db->select('*');
       $this->db->from('user');
       if(!empty($where)){
           $this->db->where($where);
       }
       $query=$this->db->get();
       return $query->num_rows();
   }

   function tambah_user($data){
     if($this->db->insert('user',$data)){
        return true;
     }else{
         return false;
     }
   }

   function ubah_user($id_user,$data){
       $this->db->where('user_id',$id_user);
       $this->db->update('user',$data);
       if($this->db->affected_rows()> 0 ){
           return true;
       }else {
           return false;
       }
   }

   function delete_user($id_user){
      if($this->db->delete('user',array('user_id'=>$id_user))){
         return true;
      } else {
         return false;
      }
    }

function reset_password($email,$password){
    $data=array('password'=>md5($password));
    $this->db->where('email',$email);
    $this->db->update('user',$data);
     if($this->db->affected_rows()> 0 ){
           return true;
       }else {
           return false;
       }
}
}
?>
