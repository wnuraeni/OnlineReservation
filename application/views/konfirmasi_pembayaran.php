<br><br>
<div style="margin:auto; text-align: center; font-size: 12px">
<h3>Terima Kasih Telah Melakukan Pembayaran</h3>
<p>Berikut Detail Pembayaran Anda : </p>
</div>
<br><br><br>
<?php
$total_sewa = $pembayaran->harga_lapangan * $pembayaran->lama_pemakaian;
$dibayar = $pembayaran->total_pembayaran;
$sisa = $total_sewa - $dibayar;
?>
<table width="30%" style="margin:auto; text-align: left; font-size: 12px">
<tr><td>Id Reservasi Anda</td><td>:</td><td><?php echo $pembayaran->id_booking;?></td></tr>
<tr><td>Jumlah harus dibayar</td><td>:</td><td>Rp. <?php echo number_format($total_sewa,0,'','.');?></td></tr>
<?php if($pembayaran->keterangan_pbyr == 'pembayaran dp1'){ ?>
<tr><td>DP yang dibayar</td><td>:</td><td>Rp. <?php echo number_format($pembayaran->lama_pemakaian * 50000,0,'','.');?></td></tr>
<?php }else{ ?>
<tr><td>Total telah dibayar</td><td>:</td><td>Rp. <?php echo  number_format($dibayar,0,'','.');?></td></tr>
<?php } ?>
<tr><td>Sisa harus dibayar</td><td>:</td><td>Rp. <?php echo  number_format($sisa,0,'','.');?></td></tr>


</table>

<button href="#" onclick="window.print()">Cetak</button>