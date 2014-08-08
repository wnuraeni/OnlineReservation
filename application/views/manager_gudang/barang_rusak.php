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
<div style="float:right"><form action="<?php echo base_url();?>manager_gudang/inventori_controller/barang_rusak" method="post">
    <input type="text" name="keyword" placeholder="keyword..">
     <select name="kategori"><option value="barang_inventori.nama_barang">Nama Barang</option>
                             <option value="barang_rusak.status">Keterangan</option>
     </select>
     <input type="submit" name="search" value="cari">
</form></div>
<br><br><br><br><br><br>

<div class="pagelink"><?php echo $this->pagination->create_links();?></div>
<table style="clear:left">
    <thead><th>Nomer</th><th>Gambar Barang</th><th>Nama Barang</th><th>Jumlah</th><th>Harga Perbaikan</th><th>Jumlah Perbaikan</th><th>Tanggal Perbaikan</th><th>Keterangan</th><th>Aksi</th></thead>
    <tbody><?php $i=1;foreach($barang_rusak as $u):?>
    <tr>
        <td><?php echo $i ;?></td>
        <td><?php echo '<img src="'.base_url().'images/barang/'.$u->gambar_barang.'" width="35px" height="35px">' ;?></td>
        <td><?php echo $u->nama_barang ;?></td>
        <td><?php echo $u->jumlah ;?></td>
        <td><?php echo $u->harga_perbaikan ;?></td>
        <td><?php echo $u->jumlah_perbaikan ;?></td>
        <td><?php echo $u->tanggal_perbaikan ;?></td>
        <td><?php echo $u->status ;?></td>
        <?php if($u->status == 'dalam perbaikan'):?>
        <td><a href="<?php echo base_url();?>manager_gudang/inventori_controller/barang_rusak_kembali/<?php echo $u->id_barang_rusak ;?>">
        <img class="att" alt="Correct" src="<?php echo base_url();?>images/icons/icon_tick_sq.png"></a></td>
        <?php endif ;?>
    </tr>
    <?php $i++; endforeach ;?>

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


