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

<a href="<?php echo base_url();?>manager_keuangan/promosi_controller/tambah_promo">Tambah</a>
<table>
    <th>Nama Promo</th><th>Deskripsi</th><th>Diskon</th><th>Periode Awal</th><th>Periode Akhir</th>
    <th>Kelola</th>
    <?php foreach ($promo as $pro):?>
    <tr><td><?php echo $pro->nama_promo;?></td>
        <td><?php echo $pro->deskripsi;?></td>
        <td><?php echo $pro->diskon;?></td>
        <td><?php echo $pro->periode_awal;?></td>
        <td><?php echo $pro->periode_akhir;?></td>
        <td><a href="<?php echo base_url();?>manager_keuangan/promosi_controller/ubah_promo/<?php echo $pro->id_promo;?>">Edit</a><br>
             <a href="<?php echo base_url();?>manager_keuangan/promosi_controller/hapus_promo/<?php echo $pro->id_promo;?>">Delete</a>
        </td>
    </tr>
   <?php endforeach ;?>
</table>