
<table border="1" style="width:100%">
    <tr><th>Tanggal Pembelian</th><th>Nama Supplier</th><th>Nama Barang</th><th>Option Request Barang</th><th>Merek Barang</th>
    <th>Jumlah Barang</th><th>Harga Satuan</th><th>Total Harga</th></tr>
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