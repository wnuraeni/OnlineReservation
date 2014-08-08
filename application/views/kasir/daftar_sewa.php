<style>

input{
    float:left;
}

select{
    margin:0;
    margin-top:1px;
    padding:0;
    float:left;
    margin-left:21px;
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


  <div style="float:right"><form action="<?php echo base_url();?>index.php/kasir/sewa_controller/daftar_sewa_sekarang" method="post">
    <input type="text" name="keyword" placeholder="keyword..">
     <select name="kategori"><option value="pelanggan.nama_pelanggan">Nama</option>
                             <option value="penyewaan.tanggal_penyewaan">Tanggal Masuk</option>
     </select>
     <input type="submit" name="search" value="cari">
</form></div>
<br><br>

</form>
<div class="pagelink"><?php echo $this->pagination->create_links();?></div>
<br><br><br>



<table>
    <th>Nomer</th><th>Nama Pelanggan</th><th>Nama Lapangan</th><th>Lama Pemakaian</th><th>Tanggal Sewa</th><th>Aksi</th>
    <?php $i=1; foreach($sewa as $s) :?>
    <tr><td><?php echo $i ;?></td><td><?php echo $s->nama_pelanggan ;?></td>
     <td><?php echo $s->nama_lapangan ;?></td>
     <td><?php echo $s->lama_pemakaian." jam" ;?></td>
     <td><?php echo $s->tanggal_penyewaan ;?></td>
     <td><a href="<?php echo base_url();?>index.php/kasir/sewa_controller/keluar/<?php echo $s->id_penyewaan ;?>">Keluar</a></td>
     <td><a href="<?php echo base_url();?>index.php/kasir/sewa_controller/batal/<?php echo $s->id_penyewaan ;?>">Batal</a></td>

     </tr>
     <?php $i++; endforeach ;?>



</table>