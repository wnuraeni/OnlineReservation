<style>
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



<div style="clear:both"></div>
<br><br>
<?php if(empty($awal) && empty($akhir)){
    echo '<h2 style="text-align:center">Laporan Keuangan Tahun '.date('Y').'</h2>';

}else{
    echo '<h2 style="text-align:center">Laporan Keuangan </h2><h2 style="text-align:center"> Periode '.date('d M Y',strtotime($awal)).' - '.date('d M Y',strtotime($akhir)).'</h2>';
};?>

<div style="float:left;width:45%">
<br><br>
  <h2>Pemasukan</h2>
  <table style="width:100%">
     <th>Tanggal</th><th>Keterangan</th><th>Harga</th>
     <?php $total=0;foreach($pemasukan as $pem):?>
     <tr><td><?php echo $pem->tanggal_booking;?></td>
         <td><?php echo 'penyewaan';?></td>
         <td><?php echo 'Rp.'.number_format($pem->total_pembayaran,0,'','.');?></td>
     </tr>
     <?php $total+=$pem->total_pembayaran;
     endforeach;?>
     <tr><td><strong>Total</strong></td><td colspan="2" style="text-align:right"><?php echo 'Rp'.number_format($total,0,'','.');?></td></tr>
  </table>
</div>

<div style="float:left;width:45%;margin-left:10px">
 <br><br>
<!-- <h2>Pengeluaran </h2>
  <table style="width:100%">
     <th>Tanggal</th><th>Keterangan</th><th>Total</th>
     <?php $total2=0;foreach($pengeluaran as $peng):
      $subtotal=0;
      foreach($peng as $p):?>
    <tr><td><?php echo $p['tanggal'];?></td>
       <td><?php echo $p['nama'];?></td>
       <td><?php echo 'Rp.'.number_format($p['harga'],0,'','.');?></td>

    </tr>
    <?php $subtotal+=$p['harga'];
    
    endforeach ;?>

    <?php $total2+=$subtotal; endforeach;?>

      <tr><td><strong>Total</strong></td>
        <td colspan="2" style="text-align:right"><?php echo 'Rp.'.number_format($total2,0,'','.');?></td>

    </tr>
  </table>-->
</div>



<style>
.contentbox{
    height:1000px;
}


</style>

