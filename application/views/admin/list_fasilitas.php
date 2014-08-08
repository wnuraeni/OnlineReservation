<style>

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

<?php
 if($this->uri->segment(3)=='tambah_gambar' || $this->uri->segment(3)=='ubah_gambar'):
 if($this->uri->segment(3)=='tambah_gambar'):

?>
<h3>Tambah Gambar</h3>
<form action="<?php echo base_url();?>admin/content_controller/tambah_gambar" method="post" enctype="multipart/form-data">
  <?php else:?>

<h3>Ubah Gambar</h3>
<form action="<?php echo base_url();?>admin/content_controller/ubah_gambar/<?php echo $id_gambar;?>" method="post" enctype="multipart/form-data">
 <?php endif ;?>
 <div class="inputboxes">
  <label>Kategori</label>
  <select name="jenis_lapangan">
  <option value="">Pilih</option>
  <option value="badminton" <?php echo empty($gambar[0]->kategori_gambar)?'':($gambar[0]->kategori_gambar=='badminton'?"selected":'');?>>Lapangan Badminton</option>
  <option value="basket" <?php echo empty($gambar[0]->kategori_gambar)?'':($gambar[0]->kategori_gambar=='basket'?"selected":'');?>>Lapangan Basket</option>
  <option value="futsal" <?php echo empty($gambar[0]->kategori_gambar)?'':($gambar[0]->kategori_gambar=='futsal'?"selected":'');?>>Lapangan Futsal</option>
  <option value="tenis" <?php echo empty($gambar[0]->kategori_gambar)?'':($gambar[0]->kategori_gambar=='tenis'?"selected":'');?>>Lapangan Tenis</option>
  <option value="voli" <?php echo empty($gambar[0]->kategori_gambar)?'':($gambar[0]->kategori_gambar=='voli'?"selected":'');?>>Lapangan Voli</option>
 </select>
</div>
<div class="inputboxes"><label>Gambar</label>
 <img src="<?php echo empty($gambar[0]->nama_gambar)?'':base_url().'images/gallery/'.$gambar[0]->nama_gambar;?>" width="70" height="60">
<input type="hidden" name="gambar" value="<?php echo empty($gambar[0]->nama_gambar)?'':$gambar[0]->nama_gambar;?>">
<input type="file" name="userfile" >
 </div>
<input type="submit" name="simpan" value="simpan">
<input type="button" name="back" value="back" onclick="window.location.href='<?php echo base_url();?>admin/content_controller/fasilitas'">
    </form>
    <?php endif ;?>
<br><br>
 <?php if($this->uri->segment(3)!='ubah_gambar'):?>
<a href="<?php echo base_url().'admin/content_controller/tambah_gambar';?>">Tambah Gambar</a>
<?php endif ;?>
<div style="float:right">
    <?php echo $this->pagination->create_links();?>

</div>


<table>
    <th>Gambar</th><th>Kategori</th><th>Date Add</th><th colspan="2">Kelola</th>
    <?php foreach($picture as $pic):?>
    <tr><td><img src="<?php echo base_url().'images/gallery/'.$pic->nama_gambar;?>" width="70" height="60"></td>
        <td><?php echo $pic->kategori_gambar;?></td>
        <td><?php echo $pic->date_add;?></td>
        <td><a href="<?php echo base_url().'admin/content_controller/ubah_gambar/'.$pic->id_gambar;?>">Edit</a></td>
        <td><a href="<?php echo base_url().'admin/content_controller/hapus_gambar/'.$pic->id_gambar;?>">Hapus</a></td>
    </tr>
    <?php endforeach ;?>

</table>










