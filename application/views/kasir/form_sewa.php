<fieldset style="float:left;width:400px;">
<form action="<?php echo base_url();?>index.php/kasir/sewa_controller/sewa" method="post">
  <div class="inputboxes"><label>Id Lapangan </label><input class="inputbox" type="text" name="id_lapangan" value="<?php echo empty($id_lapangan)?$reservasi[0]->id_lapangan:$id_lapangan ;?>"></div>
    <div class="inputboxes"><label> Nama Lapangan </label> <input class="inputbox" type="text" name="nama_lapangan" value="<?php echo empty($nama_lapangan)?$reservasi[0]->nama_lapangan:$nama_lapangan ;?>"></div>
     <div class="inputboxes"><label>Id Member</label><input class="inputbox" type="text" name="id_member"  value="<?php echo empty($reservasi[0]->id_member)?'':$reservasi[0]->id_member ;?>"></div>
     <div class="inputboxes"><label>Nama </label><input class="inputbox" type="text" name="nama" value="<?php echo empty($reservasi[0]->nama)?'':$reservasi[0]->nama ;?>"></div>
    <div class="inputboxes"><label> Alamat</label><input class="inputbox" type="text" name="alamat" value="<?php echo empty($reservasi[0]->alamat)?'':$reservasi[0]->alamat ;?>"></div>
     <div class="inputboxes"><label>Telepon </label> <input class="inputbox" type="text" name="telepon" value="<?php echo empty($reservasi[0]->telepon)?'':$reservasi[0]->telepon ;?>"></div>
     <div class="inputboxes"><label>Tanggal </label> <input class="inputbox" type="text" name="tanggal" value="<?php echo empty($tanggal)?$reservasi[0]->tanggal_booking:$tanggal ;?>"></div>
     <div class="inputboxes"><label>Jam </label> <input class="inputbox" type="text" name="jam" value="<?php echo empty($jam)?$reservasi[0]->jam:$jam ;?>"></div>
     <div class="inputboxes"><label>Harga Sewa Lapangan</label><input class="inputbox" type="text" id="harga_sewa" name="harga_sewa_lapangan" value="<?php echo empty($harga_sewa_lapangan)?$reservasi[0]->harga_lapangan:$harga_sewa_lapangan ;?>" > </div>
     <div class="inputboxes"><label>Lama Sewa </label>
        <select name="lama_sewa">
        <option>-Pilih lama sewa-</option>
        <?php
        for($i=1;$i<=$lama_sewa;$i++){
            echo '<option value="'.$i.'">'.$i.' jam</option>';
        }
        ?>
    </select>

     </div>
  
    <input type="submit" name="sewa" value="sewa">
    <input type="button" name="back" value="back" onclick="window.location.href='<?php echo base_url();?>index.php/kasir/index'">
</form>
</fieldset>
<fieldset style="width:450px;height:700px;border:none">
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
<!------------------------------------- List Barang ----------------------------------------->
<!--    <fieldset style="width:450px">
    <form action="<?php echo base_url().'index.php/kasir/sewa_controller/update_cart';?>" method="post">
        <table>
           <h4>Cart</h4>
           <?php foreach($this->cart->contents()as $cart):?>
           <tr>
              <input type="hidden" name="id_item[]" value="<?php echo $cart['rowid'];?>">
              <td><img width="50" height="50" src="<?php echo base_url().'images/barang/'.$cart['options']['picture'];?>"></td>
              <td><?php echo $cart['name'];?></td>
              <td><input type="text" name="qty[]" value="<?php echo $cart['qty'];?>" size="2">Item</td>
              <td><?php echo 'Rp.'.number_format($cart['subtotal'],0,'','.');?></td>
              <td><a href="<?php echo base_url().'index.php/kasir/sewa_controller/delete_item/'.$cart['rowid'];?>">Hapus</a></td>

           </tr>
           <?php endforeach ;?>
        </table>
        
     <br>
     <input type="submit" name="update_cart" value="update">
    </form>
    </fieldset>

  <fieldset style="width:450px">
  <table border="1">
    <th>Peralatan</th>
   <?php $max=0;
    echo '<tr>';
      foreach($barang[$reservasi[0]->jenis_lapangan] as $b):
      //if($max < count($b))$max=count($b);
     // endforeach ;
      //echo $max;
     
     //for($i=0;$i<$max;$i++):
      ?>

    <td><a href="<?php echo empty($b->id_barang_inventori)?'':(base_url().'index.php/kasir/sewa_controller/inserttocart/'.$b->id_barang_inventori);?>">
            <img src="<?php echo base_url().'images/barang/'.(empty($b->gambar_barang)?'':$b->gambar_barang);?>" width="50" height="50"><br>
           <strong><?php echo empty($b->nama_barang)?'':$b->nama_barang ;?></strong></a><br>
            <?php echo empty($b->jumlah_barang)?'':'jumlah stock : '.$b->jumlah_barang ;?><br>
             <?php echo empty($b->harga_sewa)?'':'Rp'.$b->harga_sewa ;?><br>
        </td>
         
    

    <?php endforeach ;?></tr>
     </table>
     </fieldset>-->



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



</style>