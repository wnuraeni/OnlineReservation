<style>
input{
    float:left;
}

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


<style>
input{
    float:left;
}
select{
    margin:0;
    margin-top:1px;
    margin-left:5px;
    padding:0;
    float:left;
}
</style>



<div style="float:right"><form action="<?php echo base_url();?>manager_gudang/penerimaan_controller/history" method="post">
    <input type="text" name="keyword" placeholder="keyword..">
     <select name="categori"><option value="request_pembelian.nama_barang">Nama Barang</option>
                             <option value="request_pembelian.merek_barang">Merek Barang</option>
                              <option value="supplier.nama">Nama Supplier</option>
     </select>
     <input type="submit" name="search" value="cari">
</form></div>
<br><br><br>

<div class="pagelink"><?php echo $this->pagination->create_links();?></div>
<table>
    <th>Tanggal Terima</th>
    <th>Nama Barang</th>
    <th>Merek Barang</th>
    <th>Option Barang</th>
    <th>Nama Supplier</th>
    <th>Jumlah Barang</th>
    <th>Harga Satuan</th>
    <th>Total Harga</th>
    <th>Status</th>
 <?php if($this->uri->segment(3)!= 'history'):?> <th>Aksi</th>
 <?php endif ;?>
<?php foreach ($pemesanan as $p):?>
<tr>
     <td><?php echo $p->tanggal_terima ;?></td>
     <td><?php echo $p->nama_barang ;?></td>
     <td><?php echo $p->merek_barang ;?></td>
     <td><?php echo $p->option_request_barang ;?></td>
     <td><?php echo $p->nama ;?></td>
     <td><?php echo $p->jumlah_barang ;?></td>
     <td><?php echo $p->harga_satuan ;?></td>
     <td><?php echo $p->total_harga ;?></td>
     <td><?php echo $p->status ;?></td>
     <?php if($this->uri->segment(3)!= 'history'):?>
     <td><a href="#" onclick="confirm_receive(<?php echo $p->id_request_pembelian ;?>)"><img class="att" alt="Correct" src="<?php echo base_url();?>images/icons/icon_tick_sq.png"></a></td>
    <!--<td><a href="<?php echo base_url();?>manager_gudang/penerimaan_controller/keterangan_barang/<?php echo $p->id_request_pembelian ;?>"><img alt="Information" src="<?php echo base_url();?>images/icons/icon_info.png"></a></td> -->
     <?php endif ;?>
</tr>
<?php endforeach ;?>
</table>
 <?php if($this->uri->segment(3)== 'history'):?>
 <button onclick="window.location.href='<?php echo base_url();?>manager_gudang/penerimaan_controller'">Back</button>
 <?php endif ;?>


