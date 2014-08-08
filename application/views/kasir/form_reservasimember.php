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
   var tag = [<?php echo $id_member?>];
   $("#id_member").autocomplete({
       source:tag,
       select: function(event, ui){
           var id_member = $("#id_member").val();
            $.ajax({
                type:'post',
                url: 'http://localhost/ta/index.php/kasir/reservasi_controller/get_member',
                dataType : 'json',
                data : {id_member:id_member},
                success: function(data){
                    $("#nama_pelanggan").val(data.nama);
                    $("#alamat").val(data.alamat);
                    $("#telepon").val(data.telepon);
                }
            });
       }
   });
});
</script>
<button onclick="window.location.href='<?php echo base_url();?>index.php/kasir/reservasi_controller/book/<?php echo $index_jam.'/'.$tanggal.'/'.$nama_lapangan?>'">Go To Reservasi Non Member</button>
<div class="reservasi">
<fieldset style="width:400px; float:left">
<form action="<?php echo base_url();?>index.php/kasir/reservasi_controller/bookmember/<?php echo $index_jam.'/'.$tanggal.'/'.$nama_lapangan?>" method="post">
    <div class="inputboxes"><label>Id Member</label>
        <input type="text" name="id_member" id="id_member" class="inputbox">(Enter untuk pilih)</div>
    <div > <label style="float:left;width:80px">Nama Pelanggan </label>
        <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="inputbox" value="<?php echo set_value('nama_pelanggan')?>"></div> <br>
    <?php echo form_error('nama_pelanggan','<div class="inputboxes" style="margin-left:80px; color:red">','</div>') ?>     
    <br><br><div class="inputboxes"><label>Alamat Pelanggan </label>
        <input type="text" name="alamat_pelanggan" class="inputbox" id="alamat" value="<?php echo set_value('alamat_pelanggan')?>"></div>
    <?php echo form_error('alamat_pelanggan','<div class="inputboxes" style="margin-left:80px; color:red">','</div>') ?>     
    <div class="inputboxes"> <label>Telepon Pelanggan </label>
        <input type="text" name="telepon_pelanggan" class="inputbox" id="telepon" value="<?php echo set_value('telepon_pelanggan')?>"></div>
    <?php echo form_error('telepon_pelanggan','<div class="inputboxes" style="margin-left:80px; color:red">','</div>') ?>     
    <input type="hidden" name="id_lapangan" value="<?php echo $id_lapangan;?>" >
    <div class="inputboxes"><label>Nama Lapangan </label><input type="text" name="nama_lapangan" value="<?php echo $nama_lapangan;?>" class="inputbox"></div>
    <div class="inputboxes"> <label>Tanggal </label><input type="text" name="tanggal" value="<?php echo $tanggal;?>" class="inputbox"></div>
    <div class="inputboxes"><label>Jam  </label><input type="text" name="jam" value="<?php echo $jam;?>" class="inputbox"></div>
    <div class="inputboxes"> <label>Harga Sewa Lapangan  </label><input type="text" name="harga_sewa_lapangan" class="inputbox" value="<?php echo $harga_sewa_lapangan;?>"></div>
    <div class="inputboxes"><label>Lama Sewa Tersedia</label>
<!--         <input type="text" name="lama_sewa" class="inputbox">dalam jam-->
          <select name="lama_sewa">
        <option value="">-Pilih lama sewa-</option>
        <?php
        for($i=1;$i<=$lama_sewa;$i++){
            echo '<option value="'.$i.'" '.  set_select('lama_sewa', $i).'>'.$i.' jam</option>';
        }
        ?>
    </select><br><br><br>
        <?php echo form_error('lama_sewa','<div class="inputboxes" style="margin-left:80px; color:red">','</div>') ?>
     </div>
    
    <input type="submit" name="reservasi" value="reservasi">
     <input type="button" name="back" value="back" onclick="window.location.href='<?php echo base_url().$this->session->userdata('back');?>'">

</form>
</fieldset>

<fieldset style="width:300px; float:left">
<table>
    <th>Nama Promosi</th><th>Diskon</th><th></th>
    <?php foreach($promosi as $promo):?>
    <tr><td><?php echo $promo->nama_promo;?></td>
        <td><?php echo $promo->diskon;?></td>
       <td><a href="#" onclick="apply_diskon('<?php echo $promo->diskon;?>')">Apply</a></td>
    </tr>
    <?php endforeach ;?>
</table>
</fieldset>

</div>


<script>
    function apply_diskon(diskon){
        var diskon=Number(diskon);
        var harga_awal=$('#harga_sewa').val();
        var harga_diskon=harga_awal*diskon;
        $('#harga_sewa').val(harga_awal-harga_diskon);
        $('a[onclick]').remove();
    }




   </script>

<style>
a {
    text-decoration:none;
}
.reservasi {
    height:600px;
}

</style>
<div id="dialog" title="Pesan">
    <p>Maaf, total pemesanan Anda hari ini sudah lebih dari 16 jam</p>
</div>