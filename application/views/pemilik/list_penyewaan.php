<style>


select{
    margin:0;
    margin-top:4px;
    padding:0;
    float:left;
    margin-left:20px;
}

.pagelink {
  float:right;
  margin-left:550px;
  margin-top:12px;

}
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
<form action="<?php echo base_url();?>pemilik/laporan_controller/penyewaan" method="post">
    Lihat Periode 
    <input type="text" name="awal" id="awal" value="<?php echo isset($_POST['awal'])?$_POST['awal']:''?>">
    <a href="javascript:NewCssCal('awal','yyyymmdd')"><img src="<?php echo base_url();?>images/cal.gif"></a>
    -<input type="text" name="akhir" id="akhir" value="<?php echo isset($_POST['akhir'])?$_POST['akhir']:''?>">
    <a href="javascript:NewCssCal('akhir','yyyymmdd')"><img src="<?php echo base_url();?>images/cal.gif"></a>
    <input type="submit" name="periode" value="Lihat">
    <input type="submit" name="cetak" value="Cetak">
</form>

<h4>Table Detail Penyewaan</h4>
<table>
    <th>Tanggal Sewa</th><th>Nama Lapangan</th><th>Nama Pelanggan</th><th>Waktu Mulai</th><th>Lama Pemakaian</th><th>Status Pembayaran</th>
    <th>Total Pembayaran</th>
       <?php foreach($details as $det):?>
       <tr>
       <td><?php echo $det->tanggal_booking;?></td>
       <td><?php echo $det->nama_lapangan;?></td>
       <td><?php echo $det->nama_pelanggan;?></td>
       <td><?php echo $det->jam;?></td>
       <td><?php echo $det->lama_pemakaian;?></td>
       <td><?php echo $det->status_pembayaran;?></td>
       <td><?php echo 'Rp.'.number_format($det->total_pembayaran, 0, '', '.');?></td>
       </tr>
       <?php endforeach; ?>
   
  
</table>











