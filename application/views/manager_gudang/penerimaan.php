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


<?php if($this->uri->segment(3)== 'terima_barang'):?>
<form action="<?php echo base_url();?>manager_gudang/penerimaan_controller/terima_barang/<?php echo $id_request_pembelian ;?>" method="post">
    <div class="inputboxes"><label>Tanggal</label><input  type="text" name="tanggal_penerimaan" id="tanggal_penerimaan" value="<?php echo date('Y-m-d');?>"> <a href="javascript:NewCssCal('tanggal_penerimaan','yyyymmdd')"><img src="<?php echo base_url();?>images/cal.gif"></a></div>
    <div class="inputboxes"><label>Id Karyawan</label><input type="text" name="id_karyawan" value="<?php echo $this->session->userdata('idmanager_gudang');?>" readonly></div>
    <div class="inputboxes"><label>Bukti Penerimaan</label><input type="text" name="bukti_penerimaan" value=""></div>
    <div class="inputboxes"><label>Keterangan</label><input type="text" name="keterangan" value="request harga" readonly></div>
    <input type="hidden" name="id_inventori_barang" value="<?php echo $pemesanan[0]->id_barang_inventori ;?>">
    <input type="hidden" name="jumlah_barang" value="<?php echo $pemesanan[0]->jumlah_barang ;?>">
    <input type="submit" name="terima" value="simpan">
    <br><br>
</form>
<?php endif ;?>
<button onclick="window.location.href='<?php echo base_url();?>manager_gudang/penerimaan_controller/history'">History Pemesanan</button>

<table>
    <th>Nama Barang</th>
    <th>Merek Barang</th>
    <th>Option Barang</th>
    <th>Jumlah Barang</th>
    <th>Harga Satuan</th>
    <th>Total Harga</th>
    <th>Status</th>
 <?php if($this->uri->segment(3)!= 'history'):?> <th>Aksi</th>
 <?php endif ;?>
<?php foreach ($pemesanan as $p):?>
<tr>
     <td><?php echo $p->nama_barang ;?></td>
     <td><?php echo $p->merek_barang ;?></td>
     <td><?php echo $p->option_request_barang ;?></td>
     <td><?php echo $p->jumlah_barang ;?></td>
     <td><?php echo $p->harga_satuan ;?></td>
     <td><?php echo $p->total_harga ;?></td>
     <td><?php echo $p->status ;?></td>
     <?php if($this->uri->segment(3)!= 'history' && $p->status == 'dibeli'):?>
     <td><a href="#" onclick="confirm_receive(<?php echo $p->id_request_pembelian ;?>)"><img class="att" alt="Correct" src="<?php echo base_url();?>images/icons/icon_tick_sq.png"></a></td>
    <!--<td><a href="<?php echo base_url();?>manager_gudang/penerimaan_controller/keterangan_barang/<?php echo $p->id_request_pembelian ;?>"><img alt="Information" src="<?php echo base_url();?>images/icons/icon_info.png"></a></td> -->
     <?php endif ;?>
</tr>
<?php endforeach ;?>
</table>
 <?php if($this->uri->segment(3)== 'history'):?>
 <button onclick="window.location.href='<?php echo base_url();?>manager_gudang/penerimaan_controller'">Back</button>
 <?php endif ;?>


<div id="dialog" title="confirmasi"><p>Barang Sudah diterima?</p></div>
<script>//$(document).ready(function(){
  $("#dialog").dialog({
      resizable:true,
      autoOpen:false,
      modal:true,
      width:400,
      height:200,
      buttons:{
         'Ya': function(){
             //$(this).dialog('close');
             //proses
             window.location.href='<?php echo base_url();?>manager_gudang/penerimaan_controller/terima_barang/'+$(this).data('id');
         },
         'Belum': function(){
             $(this).dialog('close');
         }

      }
  });
 // return false;

//}); </script>


<script>
    function confirm_receive(id){
 $('#dialog')
 .data('id',id)
 .dialog('open');
 }
</script>






