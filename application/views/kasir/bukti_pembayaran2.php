
<table>
    <tr><td style="text-align:center" colspan="2"><p>Gedung Penyewaan PT Abadi Jakarta Selatan</p><p><?php echo date('d-M-Y H:i:s');?></p>
    <p style="text-align:center">Nama Kasir :<?php echo $bukti[0]->nama_karyawan ;?></p></td></tr>
    
    <tr><td>Nama Pelanggan </td><td><?php echo $bukti[0]->nama_pelanggan ;?></td></tr>
    <tr><td>Jam Masuk </td><td><?php echo $bukti[0]->jam ;?></td></tr>
    <tr><td>Nama Lapangan </td><td><?php echo $bukti[0]->nama_lapangan ;?></td></tr>
    <tr><td>Lama Sewa </td><td><?php echo $bukti[0]->lama_pemakaian ;?> jam</td></tr>
    <tr><td>Total Harga Sewa Lapangan </td><td>Rp <?php echo number_format($bukti[0]->harga_total_lapangan,0,'','.') ;?></td></tr>
     <?php
     
//     foreach($bukti as $b){
//             echo '<tr><td>'.$b->nama.'@Rp'.$b->harga_sewa.'</td></tr>';
//             echo '<tr><td style="text-align:center">'.$b->jumlah.'xRp'.$b->harga_sewa.'</td>';
//             echo '<td>Rp'.$b->harga_total.'</td></tr>';
//     }
     ?>
    <tr><td>Total Pembayaran </td><td>Rp <?php echo number_format($bukti[0]->total_pembayaran,0,'','.') ;?></td></tr>
    <tr><td>Jumlah yang dibayar </td><td>Rp <?php echo number_format($bukti[0]->jumlah_dibayar,0,'','.') ;?></td></tr>
    <tr><td>Kembali</td><td>Rp<?php echo $kembali ;?></td></tr>
    <tr><td><button onclick="window.print()">Cetak</button></td></tr>
    
   

</table>