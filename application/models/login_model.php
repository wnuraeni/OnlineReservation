<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//if ( !defined('BASEPATH')) exit ('login model No direct script access.');

class login_model extends CI_Model {

   function cek_user($username,$password) {
       //
     $result = $this->db->query("SELECT * FROM user WHERE `user_name`='$username' AND `password`='".md5($password)."'");
      $data=$result->num_rows();
       if($data > 0){
           return TRUE;
       } else {
           return FALSE;
       }
       
   }
   function update_user($data=null,$id_user=null){
       $this->db->where('user_id',$id_user);
       $this->db->update('user',$data);
   }
   function update_pelanggan($data=null,$id_user=null){
       $this->db->where('user_id',$id_user);
       $this->db->update('pelanggan',$data);
   }
   function get_jabatan($username,$password){
       $result=$this->db->get_where('user',array('user_name' => $username,'password'=>md5($password)));
       return $result->row();

   }


   function login_member($username,$password){
       $this->db->select('user.user_name,user.password,user.nama,pelanggan.nama_pelanggan,pelanggan.alamat_pelanggan,pelanggan.telepon_pelanggan,pelanggan.id_member');
       $this->db->from('user');
       $this->db->join('pelanggan','user.user_id=pelanggan.user_id');
       $this->db->where('user.user_name',$username);
       $this->db->where('user.password',$password);
       $this->db->where('user.verified',1);
       $query=$this->db->get();
       $result=$query->row();
       if($query->num_rows()> 0){
           return $result;
       }else{
           return false;
       }
    }
}

?>
