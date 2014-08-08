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
    <?php foreach($pembelian as $beli):?>
    <tr><td><?php echo $beli->tanggal_pembelian ;?></td>
        
        <td><?php echo 'Rp'.number_format($beli->total_harga_pembelian,0,'','.');?></td>
        <td><a href="<?php echo base_url();?>pemilik/laporan_controller/pembelian/<?php echo $beli->id_pembelian;?>">Detail</a></td>
     </tr>
     <?php endforeach;?>
     
</table>

<?php else :?>
<a href="<?php echo base_url();?>pemilik/laporan_controller/cetak_detail_pemb/<?php echo $id_pembelian;?>">Cetak</a>
<h4>Table Detail Pembelian</h4>
<table>
    <th>Tanggal Pembelian</th><th>Nama Supplier</th><th>Nama Barang</th><th>Option Request Barang</th><th>Merek Barang</th>
    <th>Jumlah Barang</th><th>Harga Satuan</th><th>Total Harga</th>
   <?php foreach($details as $detail):?>
   <tr><td><?php echo $detail->tanggal_pembelian;?></td>
       <td><?php echo $detail->nama;?></td>
       <td><?php echo $detail->nama_barang;?></td>
       <td><?php echo $detail->option_request_barang;?></td>
       <td><?php echo $detail->merek_barang;?></td>
       <td><?php echo $detail->jumlah_barang;?></td>
       <td><?php echo $detail->harga_satuan;?></td>
       <td><?php echo $detail->total_harga;?></td>
   </tr>
   <?php endforeach;?>
  
</table>

<?php endif;?>











