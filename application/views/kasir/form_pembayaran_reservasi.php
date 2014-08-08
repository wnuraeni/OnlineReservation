<style>

fieldset{
    width:380px;
    position:relative;
    margin:auto;
    margin-top: 30px;
margin-bottom: 30px;
    background-color:#fff;

}

fieldset label{
    float:left;
    width:120px;

    }

fieldset input {
    float:left;

}

.error{
    margin-left:100px;
    color:red;
}
</style>


<fieldset>
  <h3 style="text-align:center">Konfirmasi Pembayaran</h3>
    <?php echo $this->session->flashdata('message');?>
     <form action="<?php echo base_url();?>index.php/kasir/reservasi_controller/pembayaran/<?php echo $id_reservasi;?>" method="post" enctype="multipart/form-data">

		<label>No Booking : </label><input type='text' name='id_booking' value="<?php echo $id_reservasi;?>"><br>
		<?php echo form_error('id_booking','<br><p class="error">','</p>');?><br><br>
                <label>Nama Penyewa : </label><input type='text' value="<?php echo $reservasi[0]->nama_pelanggan;?>" readonly><br>
                <br><br>
		<label>Nama Lapangan Disewa : </label><input type='text' value="<?php echo $reservasi[0]->nama_lapangan;?>" readonly><br>
                <br><br>
		<label>Lama Pemakaian : </label><input type='text' id="lama_pemakaian" value="<?php echo $reservasi[0]->lama_pemakaian;?>" readonly> jam<br>
                <br><br>
		<label>Total Biaya : </label><input type='text' name="total" id="total" value="<?php echo ($reservasi[0]->harga_lapangan*$reservasi[0]->lama_pemakaian);?>" readonly><br>
                <br><br>

                <hr>
                <strong>*Note: Jumlah DP = total lama pemakaian * Rp. 50.000</strong><br><br>
		<label>Tanggal Pembayaran</label>
		<input type="text" id="tgl_pmbyrn" name="tgl_pmbyrn" value="<?php echo date('Y-m-d')?>"><a href="javascript: NewCssCal('tgl_pmbyrn','yyyymmdd')"><img src="<?php echo base_url('images/cal.gif')?>"></a><br>
		<?php echo form_error('tgl_pmbyrn','<br><p class="error">','</p>');?><br><br>
                <label>Jenis Pembayaran</label><br><br>
                <input type="radio" name="jenis_pmbyrn" value="pembayaran dp1">Pembayaran DP1<br><br>
                <input type="radio" name="jenis_pmbyrn" value="lunas">Pembayaran Lunas<br><br>
                <?php echo form_error('jenis_pmbyrn','<br><p class="error">','</p>');?><br><br>
		<label>Jumlah Pembayaran</label>
		<input type="text" name="jml_pmbyrn" id="jml_pmbyrn" value="<?php echo set_value('jml_pmbyrn')?>"><br>
		<?php echo form_error('jml_pmbyrn','<br><p class="error">','</p>');?><br><br>

		<input type='submit' value='submit'> &nbsp;
		<a style="color:black"href="<?php echo base_url();?>index.php/kasir/reservasi_controller/konfirmasi/<?php echo $id_reservasi;?>">Back</a>
    </form>

</fieldset>
<script>
$('#jml_pmbyrn').focusout(function(){
    //alert('blur');
var jenis_pmbyrn = $('input:radio[name="jenis_pmbyrn"]:checked').val();
            var total_sewa = $("#lama_pemakaian").val(); 
            var jml_pmbyrn = $("#jml_pmbyrn").val();
            var total_biaya = $("#total").val();
            if((jenis_pmbyrn == "pembayaran dp1")&&(total_sewa * 50000 != jml_pmbyrn)){
                $("#jml_pmbyrn").val('');
                alert("Jumlah DP tidak sesuai peraturan. Anda harus membayar sebesar: Rp."+total_sewa*50000);
            }
            else if(jenis_pmbyrn == "full" && jml_pmbyrn != total_biaya){
                $("#jml_pmbyrn").val('');
                alert("Anda harus membayar sebesar: "+total_biaya);
            }
});
   
</script>



