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

<form action="<?php echo base_url();?>pemilik/laporan_controller/pendapatan" method="post">
    <select name="jenis_lapangan">
        <option value="all">-Jenis Lapangan-</option>
        <option value="all">Semua Lapangan</option>
        <option value="badminton">Badminton</option>
        <option value="basket">Basket</option>
        <option value="futsal">Futsal</option>
        <option value="tenis">Tenis</option>
        <option value="voli">Voli</option>
    </select>
    Lihat Periode 
    <input type="text" name="awal" id="awal" value="<?php echo isset($_POST['awal'])?$_POST['awal']:''?>">
    <a href="javascript:NewCssCal('awal','yyyymmdd')"><img src="<?php echo base_url();?>images/cal.gif"></a>
    -<input type="text" name="akhir" id="akhir" value="<?php echo isset($_POST['akhir'])?$_POST['akhir']:''?>">
    <a href="javascript:NewCssCal('akhir','yyyymmdd')"><img src="<?php echo base_url();?>images/cal.gif"></a>
    <input type="submit" name="periode" value="lihat">

</form>
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
        <td><?php echo $pend->tanggal_booking ;?></td>
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

