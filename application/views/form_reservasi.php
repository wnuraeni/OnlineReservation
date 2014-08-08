<script>
$(document).ready(function(){
   $("#dialog").dialog({
      resizable: true,
      autoOpen:false,
      modal:true,
      width:400,
      height:200
   }); 
   <?php 
   if(!empty($script_dialog_open)) 
       echo $script_dialog_open;
   ?>
});
</script>
  <div class="gallerysec">
        <h4 class="heading colr">Gallery</h4>
  <div class="categories">

                	<h5>Category</h5>
                    <ul>
                    	<li><a href="<?php echo base_url();?>reservasi_controller/index/basket">Lapangan Basket</a></li>
                        <li><a href="<?php echo base_url();?>reservasi_controller/index/tenis">Lapangan Tenis</a></li>
                        <li><a href="<?php echo base_url();?>reservasi_controller/index/badminton">Lapangan Badminton</a></li>
                        <li><a href="<?php echo base_url();?>reservasi_controller/index/futsal">Lapangan Futsal</a></li>
                        <li><a href="<?php echo base_url();?>reservasi_controller/index/voli">Lapangan Voli</a></li>

                    </ul>
  </div>

 <div class="right_gallery">
<div class="sortby" >

<h6 class="left"></h6>
 <div style="margin-top:10px" class="timer"></div>

</div>

    



<fieldset style="width:350px; float:left">
<?php if($this->session->userdata('islogin')!= true):?>
  <p>Sudah terdaftar?<a href="<?php echo base_url();?>index/register">Belum</a></p>
  <p>Silahkan <a href="<?php echo base_url();?>index/login">Login</a> untuk mendapatkan harga promosi</p>
<?php endif ;?>

<form action="<?php echo base_url();?>reservasi_controller/pesan/<?php echo $index_jam.'/'.$tanggal.'/'.$nama_lapangan?>" method="post">
   <ul class="forms">
    <li class="txt">Id Lapangan </li>
        <li class="inputfield"><input type="text" name="id_lapangan" value="<?php echo empty($id_lapangan)? set_value('id_lapangan'):$id_lapangan ;?>"></li>
    <li class="txt">Nama Lapangan </li>
        <li class="inputfield"><input type="text" name="nama_lapangan" value="<?php echo (empty($nama_lapangan)?set_value('nama_lapangan'):$nama_lapangan);?>"></li>
    <?php if($this->session->userdata('islogin')== true):?>
    <li class="txt">Id Member</li>
        <li class="inputfield"><input type="text" name="id_member" value="<?php echo $this->session->userdata('id_member');?>"></li>
    <?php endif ;?>
    <li class="txt">Nama</li>
    <?php $nama_pelanggan=$this->session->userdata('nama_pelanggan');?>
        <li class="inputfield"><input type="text" name="nama" value="<?php echo empty($nama_pelanggan)? set_value('nama'):$nama_pelanggan;?>"></li>
       <?php echo form_error('nama','<li class="txt" style="color:red">','</li>');?>
    <li class="txt">Alamat</li>
    <?php $alamat_pelanggan=$this->session->userdata('alamat_pelanggan');?>
        <li class="inputfield"><input type="text" name="alamat" value="<?php echo empty($alamat_pelanggan)? set_value('alamat'):$alamat_pelanggan;?>"></li>
         <?php echo form_error('alamat','<li class="txt" style="color:red">','</li>');?>
    <li class="txt">Telepon </li>
          <?php $telepon_pelanggan=$this->session->userdata('telepon_pelanggan');?>
         <li class="inputfield"><input type="text" name="telepon" value="<?php echo empty($telepon_pelanggan)? set_value('telepon'):$telepon_pelanggan;?>"></li>
        <?php echo form_error('telepon','<li class="txt" style="color:red">','</li>');?>
    <li class="txt">Tanggal </li>
         <li class="inputfield"><input type="text" name="tanggal" value="<?php echo empty($tanggal)?set_value('tanggal'):$tanggal;?>"></li>
    <li class="txt">Jam </li>
         <li class="inputfield"> <input type="text" name="jam" value="<?php echo empty($jam)?set_value('jam'):$jam ;?>"></li>
    <li class="txt">Harga Sewa Lapangan </li>
        <li class="inputfield">  <input type="text" name="harga_sewa_lapangan" value="<?php echo empty($harga_sewa_lapangan)?set_value('harga_sewa_lapangan'):$harga_sewa_lapangan ;?>" >
    <li class="txt">Lama Sewa</li>
         <li class="inputfield">
<!--             <input type="text" name="lama_sewa" value="<?php echo set_value('lama_sewa');?>">dalam jam-->
              <select name="lama_sewa">
        <option value="">-Pilih lama sewa-</option>
        <?php
        for($i=1;$i<=$lama_sewa;$i++){
            echo '<option value="'.$i.'" '.  set_select('lama_sewa', $i).'>'.$i.' jam</option>';
        }
        ?>
    </select>
         </li>
   
         <?php echo form_error('lama_sewa','<li class="txt" style="color:red">','</li><li></li>')?>

        <li class="txt"> <input type="submit" name="sewa" value="reservasi"><input type="button" onclick="window.location.href='<?php echo base_url();?>reservasi_controller/index'" value="back"></li>

    </ul>
</form>
     
</fieldset>
<!--<fieldset style="width:300px; float:left">
<table>
    <th>Nama Promosi</th><th>Diskon</th><th>Tanggal Mulai</th><th>Tanggal Berakhir</th>
    <?php foreach($promosi as $promo):?>
    <tr><td><?php echo $promo->nama_promo;?></td>
        <td><?php echo $promo->diskon;?></td>
         <td><?php echo $promo->periode_awal;?></td>
         <td><?php echo $promo->periode_akhir;?></td>
       
    </tr>
    <?php endforeach ;?>
</table>
</fieldset>-->
</div>
</div>
<div id="dialog" title="Pesan">
    <p>Maaf, total pemesanan Anda hari ini sudah lebih dari 16 jam</p>
</div>




