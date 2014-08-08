<form action="<?php echo base_url().'index.php/kasir/sewa_controller/pembayaran';?>" method="post">
    
    <div class="inputboxes"><label>Id Lapangan</label><input class="inputbox" type="text" name="id_lapangan" value="<?php echo $sewa['id_lapangan'] ;?>"></div>
     <?php if(!empty($sewa['id_member'])) :?>
     <div class="inputboxes"><label>Id Member</label><input class="inputbox" type="text" name="id_member" value="<?php echo $sewa['id_member'];?>"></div>
     <?php endif ;?>
     <div class="inputboxes"><label>Nama</label><input class="inputbox" type="text" name="nama" value="<?php echo $sewa['nama'] ;?>"></div>
     <div class="inputboxes"><label>Tanggal</label><input class="inputbox" type="text" name="tanggal" value="<?php echo $sewa['tanggal_penyewaan'] ;?>"></div>
      <div class="inputboxes"><label>Lama Sewa </label><input class="inputbox" type="text" name="lama_sewa" value="<?php echo $sewa['lama_sewa'] ;?>"></div>
     <div class="inputboxes"><label> Jam Mulai</label><input class="inputbox" type="text" name="jam" value="<?php echo $sewa['jam'] ;?>"></div>
     <div class="inputboxes"><label> Jam Akhir</label><input class="inputbox" type="text" value="<?php echo date('H:i:s',strtotime($sewa['jam'].'+'.$sewa['lama_sewa'].' hours')) ;?>" readonly></div>
      <?php if(!empty($sewa['id_member'])) :?>
     <div class="inputboxes"><label>Harga Sewa Lapangan </label><input class="inputbox" type="text" name="harga_sewa_lapangan" value="<?php echo $sewa['harga_sewa_lapangan'] ;?>" ></div>
     <?php else :?>
      <div class="inputboxes"><label>Sewa Lapangan Sudah Dibayar</label></div>
     <?php endif ;?>
    <table>
    <?php foreach ($barang as $b){
     echo '<tr><td>'.$b['name'].'@Rp.'.$b['price'].'</td></tr><tr><td style="text-align:center">'.$b['qty'].'X '.$sewa['lama_sewa'].'jam x Rp'.$b['price'].'</td><td>Rp.'.($b['subtotal']*$sewa['lama_sewa']).'</td></tr>';} ?>
     </table>
     <div class="inputboxes"><label>Total Biaya </label><input class="inputbox" type="text" name="total_biaya" value="<?php echo $total ;?>"></div>
     <div class="inputboxes"><label>Jumlah Pembayaran </label><input class="inputbox" type="text" name="jumlah_pembayaran"></div>
    <input type="submit" name="bayar" value="cetak">

</form>