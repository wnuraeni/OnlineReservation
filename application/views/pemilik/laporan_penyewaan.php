
<table border="1" style="width:100%">
    <tr><th>Tanggal Sewa</th><th>Nama Lapangan</th><th>Nama Pelanggan</th><th>Waktu Mulai</th><th>Lama Pemakaian</th><th>Total Pembayaran</th></tr>
    <!--<?php //print_r($details);?>-->
   <tr><td><?php echo $details->tanggal_penyewaan;?></td>
       <td><?php echo $details->nama_lapangan;?></td>
       <td><?php echo $details->nama_pelanggan;?></td>
       <td><?php echo $details->jam;?></td>
       <td><?php echo $details->lama_pemakaian;?></td>
       <td><?php echo $details->total_pembayaran;?></td>

   </tr>

</table>
<br><br>

<?php if(!empty($barang)):?>
<h4>Detail Sewa Barang</h4>
<table border="1" style="width:100%">
    <tr><th>Nama Barang</th><th>Jumlah Barang</th><th>Total Harga</th></tr>

    <?php foreach($barang as $b):?>
    <tr><td><?php echo $b->nama;?></td>
        <td><?php echo $b->jumlah;?></td>
        <td><?php echo $b->harga_total;?></td>

    </tr>
    <?php endforeach ;?>
</table>
  
<?php endif;?>
