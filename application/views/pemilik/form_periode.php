

<div style="float:left">
 <form action="<?php echo base_url();?>pemilik/laporan_controller/keuangan" method="post">
    <input type="text" name="awal" id="awal" value="<?php echo isset($_POST['awal'])?$_POST['awal']:'';?>"><a href="javascript:NewCssCal('awal','yyyymmdd')"><img src="<?php echo base_url();?>images/cal.gif"></a>
    - <input type="text" name="akhir" id="akhir" value="<?php echo isset($_POST['akhir'])?$_POST['akhir']:'';?>"><a href="javascript:NewCssCal('akhir','yyyymmdd')"><img src="<?php echo base_url();?>images/cal.gif"></a>
    <input type="submit" name="cari" value="cari">
    <input type="submit" name="cetak" value="cetak">
</form></div>

