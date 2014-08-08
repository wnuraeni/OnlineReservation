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
<div style="float:right"><form action="<?php echo base_url();?>manager_keuangan/inventori_controller/index" method="post">
    <input type="text" name="keyword" placeholder="keyword..">
     <select name="kategori"><option value="categori_barang.categori">Kategori Barang</option>
                             <option value="barang_inventori.nama_barang">Nama Barang</option>
     </select>
     <input type="submit" name="search" value="cari">
</form></div>
<br><br>



<div class="pagelink"><?php echo $this->pagination->create_links();?></div>
<br><br><br>
<table style="border-collapse:collapse">
    <th>Gambar Barang</th><th>Kategori Barang</th><th>Nama<a href="<?php echo base_url();?>manager_keuangan/inventori_controller/index/nama_barang/asc/"><img src="<?php echo base_url();?>images/cal_minus.gif">
    </a><a href="<?php echo base_url();?>manager_keuangan/inventori_controller/index/nama_barang/desc/"><img src="<?php echo base_url();?>images/cal_plus.gif"></a></th><th>Merek<a href="<?php echo base_url();?>manager_keuangan/inventori_controller/index/merek_barang/asc/"><img src="<?php echo base_url();?>images/cal_minus.gif"></a><a href="<?php echo base_url();?>manager_keuangan/inventori_controller/index/merek_barang/desc/"><img src="<?php echo base_url();?>images/cal_plus.gif"></a></th><th>Jumlah Barang</th><th>Harga Sewa</th><th>Option</th><th colspan="2">Aksi</th>
     <?php foreach($inventori as $u):?>
    <tr>
        <td><img src="<?php echo base_url().'images/barang/'.$u->gambar_barang ;?>" width="40" height="40"></td>
        <td><?php echo $u->categori;?></td>
        <td><?php echo $u->nama_barang ;?></td>
        <td><?php echo $u->merek_barang ;?></td>
        <td><?php echo $u->jumlah_barang ;?></td>
        <td><?php echo $u->harga_sewa ;?></td>
        <td><?php if(!empty($options[$u->id_barang_inventori])){
                 foreach($options[$u->id_barang_inventori] as $option){
                     echo $option->nama_option.' '.$option->nilai_option.'<br>';
                 }
         } ;?></td>
       
        <td><a href="<?php echo base_url();?>manager_keuangan/inventori_controller/ubah_inventori/<?php echo $u->id_barang_inventori ;?>">
        <img src="<?php echo base_url();?>images/icons/icon_edit.png"></a></td>
       <td><a href="#" onclick="confirm_delete(<?php echo $u->id_barang_inventori ;?>)">
        <img src="<?php echo base_url();?>images/icons/icon_delete.png"></a></td>
    </tr>
    <?php endforeach ;?>

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
             window.location.href='<?php echo base_url();?>manager_gudang/inventori_controller/delete_inventori/'+$(this).data('id');
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


