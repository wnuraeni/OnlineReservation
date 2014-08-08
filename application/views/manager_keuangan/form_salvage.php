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

<?php if($this->uri->segment(3)=='ubah_salvage'):?>
<form action="<?php echo base_url();?>manager_keuangan/harga_controller/ubah_salvage" method="post">

<input type="hidden" name="id_categori_barang" value="<?php echo empty ($id_categori_barang)?'':$id_categori_barang ;?>">
     <label style="float:left ; width:100px ">Salvage Value</label>
     <input type="text" name="salvage_value" value="<?php echo empty($kategori[0]->salvage_value)?'':$kategori[0]->salvage_value;?> ">
     
     <input type="submit" value="tambah" class="btn" name="set_salvage">
</form>
<?php endif ;?>

<h3>Daftar kategori</h3>
<table>
    <thead><th>Id Kategori</th><th>Nama Kategori</th><th>Parent Kategori</th><th>Total Barang</th><th>Salvage Value</th><th>Kelola</th></thead>
    <tbody><?php foreach($kategori as $k):?>
     <tr>
        <td><?php echo $k->id_categori_barang ;?></td>
        <td><?php echo $k->categori ;?></td>
        <td><?php echo $k->parent_id ;?></td>
        <td><?php echo $k->jumlah_total ;?></td>
       <!--<td><?php echo $k->salvage_value ;?></td>-->
        <td><a href="<?php echo base_url();?>manager_keuangan/harga_controller/ubah_salvage/<?php echo $k->id_categori_barang ;?>">Edit</a></td>
        
     </tr>
     <?php endforeach ;?>
    </tbody>
</table>



