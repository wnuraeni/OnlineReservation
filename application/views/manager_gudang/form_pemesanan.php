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


<form action="<?php echo base_url();?>manager_gudang/pemesanan_controller/index" method="post">
    <label style="float:left ; width:100px ">Supplier</label><select name="supplier" style="margin:0;padding:0">
    <?php foreach($penyalur as $p):?>
    <option value="<?php echo $p->nama.'-'.$p->id_supplier ;?>" ><?php echo $p->nama;?></option>
    <?php endforeach ;?>
    </select>
    <a href='<?php echo base_url();?>manager_gudang/supplier_controller/tambah_supplier'>Tambah</a>
    <br><br><br>
    <label style="float:left ; width:100px ">Nama Barang :</label><input type="text" name="nama_barang"><br><br>
    <label style="float:left ; width:100px ">Merek Barang :</label><input type="text" name="merek_barang"><br><br>
    <label style="float:left ; width:100px ">Option Barang :</label><input type="text" name="option_request_barang"><br><br>
    <label style="float:left ; width:100px ">Jumlah Barang :</label><input type="text" name="jumlah_barang" ><br><br>
    <label style="float:left ; width:100px ">Harga Satuan :</label><input type="text" name="harga_satuan" ><br><br>
  <input type="submit" name="submit" value="tambah"><br><br>
</form>

<?php echo $this->session->flashdata('message') ;?>

<table>
    <th>Nama Supllier</th><th>Nama Barang</th><th>Merek barang</th><th>Option Barang</th><th>Jumlah Barang</th>
    <th>Harga Satuan</th><th>Total harga</th><th>Tanggal</th><th>Aksi</th>
    <?php foreach($this->cart->contents() as $item):?>
    <tr>
        <td><?php echo $item['options']['supplier'] ;?></td>
         <td><?php echo $item['name'] ;?></td>
         <td><?php echo $item['options']['merek_barang'] ;?></td>
         <td><?php echo $item['options']['option_request_barang'] ;?></td>
         <td><?php echo $item['qty'] ;?></td>
         <td><?php echo $item['price'] ;?></td>
         <td><?php echo $item['subtotal'] ;?></td>
         <td><?php echo date('Y-m-d') ;?></td>
        <td><a href="<?php echo base_url();?>manager_gudang/pemesanan_controller/delete_barang/<?php echo $item['rowid'];?>">Delete</a></td>
    </tr>
  <?php endforeach ;?>
  <tr><td><input type="submit" value="pesan" onclick="window.location.href='<?php echo base_url();?>manager_gudang/pemesanan_controller/pesan_barang'"></td></tr>
</table>

