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



<?php $segment=$this->uri->segment(4);
if(empty($segment)):?>

<form action="<?php echo base_url();?>pemilik/laporan_controller/pembelian" method="post">
    Lihat Periode <input type="text" name="awal" id="awal">
    <a href="javascript:NewCssCal('awal','yyyymmdd')"><img src="<?php echo base_url();?>images/cal.gif"></a>
    -<input type="text" name="akhir" id="akhir">
    <a href="javascript:NewCssCal('akhir','yyyymmdd')"><img src="<?php echo base_url();?>images/cal.gif"></a>
    <input type="submit" name="periode" value="lihat">
</form>

<table>
    <th>Tanggal Pembelian</th><th>Total Harga</th><th>Detail</th>
    <?php foreach($penyewaan as $b):?>
    <tr><td><?php echo $b->tanggal_penyewaan ;?></td>
       
        <td><?php echo 'Rp'.number_format($b->total_pembayaran,0,'','.');?></td>
        <td><a href="<?php echo base_url();?>pemilik/laporan_controller/penyewaan/<?php echo $b->id_penyewaan;?>">Detail</a></td>
     </tr>
     <?php endforeach;?>
     
</table>

<?php else :?>

<h4>Table Detail Penyewaan</h4>
 <a href="<?php echo base_url();?>pemilik/laporan_controller/cetak_penyewaan/<?php echo $id_penyewaan;?>">Cetak</a>
<table>
    <th>Tanggal Sewa</th><th>Nama Lapangan</th><th>Nama Pelanggan</th><th>Waktu Mulai</th><th>Lama Pemakaian</th><th>Total Pembayaran</th>
    <!--<?php //print_r($details);?>-->
   <tr><td><?php echo $details->tanggal_penyewaan;?></td>
       <td><?php echo $details->nama_lapangan;?></td>
       <td><?php echo $details->nama_pelanggan;?></td>
       <td><?php echo $details->jam;?></td>
       <td><?php echo $details->lama_pemakaian;?></td>
       <td><?php echo $details->total_pembayaran;?></td>
       
   </tr>
  
</table>

<?php if(!empty($barang)):?>
<!--<br><br><br>
<h4>Detail Sewa Barang</h4>
<table>
    <th>Nama Barang</th><th>Jumlah Barang</th><th>Total Harga</th>
   
    <?php foreach($barang as $b):?>
    <tr><td><?php echo $b->nama;?></td>
        <td><?php echo $b->jumlah;?></td>
        <td><?php echo $b->harga_total;?></td>

    </tr>
    <?php endforeach ;?>
</table>-->
   <?php endif;?>
<?php endif;?>











