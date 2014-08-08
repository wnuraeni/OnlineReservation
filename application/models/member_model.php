<?php

//if ( !defined('BASEPATH')) exit ('No direct script access.');

class member_model extends CI_Model{
    function __contruct(){
        parent :: __construct();
    }

   function ambil_member($where=NULL,$like=null,$limit=6,$offset=0){
       $this->db->select('*');
       $this->db->from('pelanggan');
       $this->db->join('user','user.user_id=pelanggan.user_id','left');
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

   function ambil_all_member(){
       $this->db->select('*');
       $this->db->from('pelanggan');
       $this->db->join('user','user.user_id=pelanggan.user_id');
       $query = $this->db->get();
       $result = $query->result();
       $data = "";
       foreach($result as $res){
           $data .= "'".$res->id_member."',";
       }
       $data = substr($data, 0,-1);
       return $data;
   }
   function ambil_total_member($where){
       $this->db->select('*');
       $this->db->from('pelanggan');
       if(!empty($where)){
           $this->db->where($where);
       }
       $query=$this->db->get();
       return $query->num_rows();
   }

   function ubah_member($id_member,$data){
       $this->db->where('id_member',$id_member);
       $this->db->update('pelanggan',$data);
       if($this->db->affected_rows()> 0 ){
           return true;
       }else {
           return false;
       }
   }

   function delete_member($id_member){
      $query = $this->db->query("SELECT user_id FROM pelanggan WHERE id_member = '$id_member'");
      $result = $query->row();
      if($result->user_id != 0){
          $res1 = $this->db->delete('user',array('user_id'=>$result->user_id));
      }else{
          $res1 = true;
      }
      $res2 = $this->db->delete('pelanggan',array('id_member'=>$id_member));
      if($res1 & $res2){
         return true;
      } else {
        return false;
      }
    }

    function tambah_member($data){
        if($this->db->insert('pelanggan',$data))
             return true;
        else
            return false;
    }


   function tambah_user($data){
      $this->db->insert('user',$data);
      return $this->db->insert_id();

   }

   function cekusername($username){
       $query=$this->db->get_where('user',array('user_name'=>$username));
       if($query->num_rows() > 0 ){
           return true;
       }else {
           return false;
       }


   }

   function cekemail($email){
       $query=$this->db->get_where('user',array('email'=>$email));
       if($query->num_rows() > 0 ){
           return true;
       }else {
           return false;
       }

   }

}
?>
