<style>

select{
    margin:0;
    margin-top:4px;
    padding:0;
    float:left;
    margin-left:20px;
}

.pagelink {
  float:right;
  margin-left:550px;
  margin-top:12px;

}
table thead,table tr{
    border:1px solid #ccc;
}
table{
    clear:left;
    margin-top:10px;
    text-align:center;
    width:100%;
}

</style>


<?php if($this->uri->segment(3)=='ubah_kategori' ||($this->uri->segment(3)=='tambah_kategori')):?>
<?php if($this->uri->segment(3)=='ubah_kategori'):?>
<form action="<?php echo base_url();?>manager_gudang/inventori_controller/ubah_kategori/<?php echo $id_categori_barang ;?>" method="post">
<?php else :?>
<form action="<?php echo base_url();?>manager_gudang/inventori_controller/tambah_kategori" method="post">
<?php endif ;?>
     <label style="float:left ; width:100px ">Parent Categori :</label><select type="text" name="parent_categori" id="parent_categori" style="margin:0;padding:0">
     <option value="0" <?php echo (!empty($data_edit)&& ($data_edit[0]->parent_id == 0) ?'selected' :'');?>>No Parent</option>
     <?php foreach ($parents as $parent) :?>
     <option value="<?php echo $parent->id_categori_barang ;?>" <?php echo (!empty($data_edit)&& ($data_edit[0]->parent_id == $parent->id_categori_barang) ?'selected' :'');?>><?php echo $parent->categori ;?></option>
     <?php endforeach ;?>
     </select><br><br>
     <?php echo form_error('parent_categori','<p class="input-error">','</p>');?>
     <label style="float:left ; width:100px ">Categori : </label><input type="text" name="nama_categori" value="<?php echo empty($data_edit)?'':$data_edit[0]->categori ;?>"><br>
     <?php echo form_error('nama_categori','<p class="input-error">','</p>');?>
     <?php if ($this->uri->segment(3)== 'ubah_kategori'): ;?>
     <input type="submit" value="simpan" class="btn">
     <?php else :?>
     <input type="submit" value="tambah" class="btn">
     <?php endif ;?>
     <?php if($previous=$this->session->userdata('previous')):?>
     <a class="btnalt" onclick="window.location.href='<?php echo base_url().$previous;?>'">Back</a>
     <?php else :?>
     <a class="btnalt" onclick="window.location.href='<?php echo base_url();?>manager_gudang/inventori_controller/kategori'">Back</a>
     <?php endif ;?>
</form>

<?php else :?>

<h3>Daftar kategori</h3>
<button onclick="window.location.href='<?php echo base_url();?>manager_gudang/inventori_controller/tambah_kategori'">Tambah</button>
<table>
    <thead><th>Id Kategori</th><th>Nama Kategori</th><th>Parent Kategori</th><th>Total Barang</th><th colspan="2">Kelola</th></thead>
    <tbody><?php foreach($kategori as $k):?>
     <tr>
        <td><?php echo $k->id_categori_barang ;?></td>
        <td><?php echo $k->categori ;?></td>
        <td><?php echo $k->parent_id ;?></td>
        <td><?php echo $k->jumlah_total ;?></td>
        <td><a href="<?php echo base_url();?>manager_gudang/inventori_controller/ubah_kategori/<?php echo $k->id_categori_barang ;?>">Edit</a></td>
        <td><a href="#" onclick="confirm_delete(<?php echo $k->id_categori_barang ;?>)">Delete</a></td>
     </tr>
     <?php endforeach ;?>
    </tbody>
</table>
<?php endif ;?>


<div id="dialog" title="confirmasi"><p>Anda yakin akan menghapus data ini ?</p></div>
<script>//$(document).ready(function(){
  $("#dialog").dialog({
      resizable:true,
      autoOpen:false,
      modal:true,
      width:400,
      height:200,
      buttons:{
         'Ya': function(){
             //$(this).dialog('close');
             //proses
             window.location.href='<?php echo base_url();?>manager_gudang/inventori_controller/delete_kategori/'+$(this).data('id');
         },
         'Batal': function(){
             $(this).dialog('close');
         }

      }
  });
 // return false;

//}); </script>


<script>
    function confirm_delete(id){
 $('#dialog')
 .data('id',id)
 .dialog('open');
 }
</script>



