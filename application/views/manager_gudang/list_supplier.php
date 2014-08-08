<style>
input{
    float:left;
}

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

<style>
input{
    float:left;
}
select{
    margin:0;
    margin-top:1px;
    margin-left:5px;
    padding:0;
    float:left;
}
</style>

<?php echo $this->session->flashdata('message') ;?>
<div style="float:right"><form action="<?php echo base_url();?>manager_gudang/supplier_controller/index" method="post">
    <input type="text" name="keyword" placeholder="keyword..">
     <select name="categori"><option value="nama">Nama Supplier</option>
                             <option value="kota">Kota</option>
                             <option value="cp_nama">Contact Person</option>
     </select>
     <input type="submit" name="search" value="cari">
</form></div>
<br><br>

<a href="<?php echo base_url();?>manager_gudang/supplier_controller/tambah_supplier" class="btn" style="float:left">Tambah Supplier</a>

<div class="pagelink"><?php echo $this->pagination->create_links();?></div>
<table style="clear:left">
    <thead><th>Nama Supplier</th><th>Alamat Supplier</th><th>Kota</th><th>Telepon</th><th>Contact Person</th><th>Aksi</th></thead>
    <tbody><?php foreach($supplier as $u):?>
    <tr>
        <td><?php echo $u->nama ;?></td>
        <td><?php echo $u->alamat ;?></td>
        <td><?php echo $u->kota ;?></td>
        <td><?php echo $u->telepon ;?></td>
        <td><?php echo $u->cp_nama ;?></td>
       
        <td><a href="<?php echo base_url();?>manager_gudang/supplier_controller/ubah_supplier/<?php echo $u->id_supplier ;?>">
        <img src="<?php echo base_url();?>images/icons/icon_edit.png"></a></td>
       <td><a href="#" onclick="confirm_delete(<?php echo $u->id_supplier ;?>)">
        <img src="<?php echo base_url();?>images/icons/icon_delete.png"></a></td>
    </tr>
    <?php endforeach ;?>

    </tbody>
</table>

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
             window.location.href='<?php echo base_url();?>manager_gudang/supplier_controller/delete_supplier/'+$(this).data('id');
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


