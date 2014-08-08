<br><br>
<div style="margin:auto; text-align: center; font-size: 12px">
<h3>Terima Kasih Telah Melakukan Pesanan</h3>
<p>Silakan Datang 30 menit Sebelum Waktu yang telah Anda pesan</p>
<p>Simpan Bukti dibawah untuk Bukti Konfirmasi Pesanan</p>
</div>
<br><br><br>

<table width="30%" style="margin:auto; text-align: left; font-size: 12px">
<tr><td>Id Reservasi Anda</td><td>:</td><td><?php echo $reservasi[0]->id_booking;?></td></tr>
<tr><td colspan="3"><hr></td></tr>
<tr><td>Nama</td><td>:</td><td><?php echo $reservasi[0]->nama_pelanggan;?></td></tr>
<tr><td>Alamat</td><td>:</td><td><?php echo $reservasi[0]->alamat_pelanggan;?></td></tr>
<tr><td>Telepon</td><td>:</td><td><?php echo $reservasi[0]->telepon_pelanggan;?></td></tr>
<tr><td colspan="3"><hr></td></tr>
<tr><td>Nama Lapangan</td><td>:</td><td><?php echo $reservasi[0]->nama_lapangan;?></td></tr>
<tr><td>Tanggal Sewa</td><td>:</td><td><?php echo $reservasi[0]->tanggal_booking;?></td></tr>
<tr><td>Jam Sewa</td><td>:</td><td><?php echo $reservasi[0]->jam;?></td></tr>
<tr><td>Lama Pemakaian</td><td>:</td><td><?php echo $reservasi[0]->lama_pemakaian;?></td></tr>
<tr><td>DP yang harus dibayar</td><td>:</td><td>Rp. <?php echo number_format($reservasi[0]->lama_pemakaian * 50000,0,'','.')?></td></tr>
<tr><td colspan="3"><hr></td></tr>
<tr><td>Total Harga Sewa</td><td>:</td><td>Rp. <?php echo number_format($reservasi[0]->lama_pemakaian * $reservasi[0]->harga_lapangan,0,'','.');?></td></tr>


</table>

<button href="#" onclick="window.print()">Cetak</button>