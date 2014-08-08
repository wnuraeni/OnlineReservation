<?php
//if ( !defined('BASEPATH')) exit ('No direct script access.');

class promosi_model extends CI_Model{
    function __contruct(){
        parent :: __construct();
    }


function ambil_promosi($where=null){
    $this->db->select('*');
    $this->db->from('promo');
    if(!empty($where)){
        $this->db->where($where);

    }
    $query=$this->db->get();
    return $query->result();


}

function tambah($data){
    $this->db->insert('promo',$data);


}

function ubah($id_promo,$data){
    $this->db->where('id_promo',$id_promo);
    $this->db->update('promo',$data);


}

function hapus_promo($id_promo){
    $this->db->delete('promo',array('id_promo'=>$id_promo));


}



}

?>
