<form action="<?php echo base_url();?>manager_gudang/inventori_controller/tambah_barang_rusak/<?php echo $id_barang_inventori ;?>" method="post">
    <table>
      <input type="hidden" name="id_barang_inventori" value="<?php echo $id_barang_inventori;?>">
      <tr><td>Nama Barang</td><td><input type="text" value="<?php echo $inventori[0]->nama_barang ;?>" readonly></td></tr>
      <tr><td>Jumlah Barang Rusak</td><td><input type="text" name="jumlah_barang_rusak"><?php echo form_error('jumlah_barang_rusak');?></td></tr>

      <tr><td>Tanggal Perbaikan</td><td><input type="text" name="tanggal_perbaikan" id="tanggal_perbaikan"><a href="javascript:NewCssCal('tanggal_perbaikan','yyyymmdd')"><img src="<?php echo base_url();?>images/cal.gif"></a></td></tr>
      <tr><td>Harga Perbaikan</td><td><input type="text" name="harga_perbaikan" ></td></tr>
      <tr><td><input type="submit" name="submit" value="tambah" class="btn"></td><td><a href="<?php echo base_url();?>manager_gudang/inventori_controller" class="btnalt">Back</a></td></tr>
    </table>



</form>