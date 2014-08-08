<table>
    <th>Tanggal Penyewaan</th>
    <th>Jenis Lapangan</th>
    <th>Nama Lapangan</th>
    <th>Lama Sewa</th>
    <th>Harga Lapangan</th>
    <th>Total</th>
    <?php  
    $total = 0;
    $total_lapangan=0;
    foreach($pendapatan as $pend):?>
    <tr>
        <td><?php echo $pend->tanggal_penyewaan ;?></td>
        <td><?php echo $pend->jenis_lapangan?></td>
        <td><?php echo $pend->nama_lapangan?></td>
        <td><?php echo $pend->lama_pemakaian.' jam';?></td>
        <td><?php echo 'Rp'.number_format($pend->sewa_lapangan,0,'','.')?></td>
        <td><?php echo 'Rp'.number_format($pend->total_pembayaran,0,'','.');?></td>
       </tr>
     <?php 
      $total_lapangan += $pend->sewa_lapangan;
      $total += $pend->total_pembayaran;
      endforeach;
     ?>
<tr>
    <td><strong>Total</strong></td>
    <td colspan="3"></td>
    <td><?php echo 'Rp'.number_format($total_lapangan,0,'','.')?></td>
    <td><?php echo 'Rp'.number_format($total,0,'','.')?></td>
</tr>
</table>

