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
     <form action="<?php echo base_url();?>index/payment" method="post" enctype="multipart/form-data">

		<label>No Booking : </label>
                <input type='text' name='id_booking' id="no_booking" value="<?php echo empty($id_booking)?'':$id_booking ?>"><br>
		<?php echo form_error('id_booking','<br><p class="error">','</p>');?><br><br>    

		<label>Tanggal Pembayaran</label>
		<input type="text" id="tgl_pmbyrn" name="tgl_pmbyrn" value="<?php echo set_value('tgl_pmbyrn')?>" readonly><a href="javascript: NewCssCal('tgl_pmbyrn','yyyymmdd')"><img src="<?php echo base_url('images/cal.gif')?>"></a><br>
		<?php echo form_error('tgl_pmbyrn','<br><p class="error">','</p>');?><br><br>
                
                <label>Total</label>
		<input type="text" value="" id="jml_hrs_dbyr" readonly><br><br>
                <br>
                <label>DP yang harus dibayar</label>
                <input type="text" id="dp_harus_dibayar"><br>
                <br><br>
                <div id="sisa">
                </div>
                
                <div id="bayar">
                    <hr>
                <br>
                <strong>*Note:Perhitungan jumlah DP = total sewa lapangan * Rp. 50.000</strong>
                <br><br>
		 <label>Jenis Pembayaran</label>
		<span id="dp1" style="float:left"><input type="radio" name="jenis_pmbyrn" value="pembayaran dp1">Pembayaran DP1</span>
                <span id="lunas" style="float:left"><input type="radio" name="jenis_pmbyrn" id="lunas" value="lunas">Pembayaran Lunas</span>
		<?php echo form_error('jenis_pmbyrn','<br><p class="error">','</p>');?><br><br>
         
                <label>Jumlah Pembayaran</label>
		<input type="text" name="jml_pmbyrn" id="jml_pmbyrn" value="<?php echo set_value('jml_pmbyrn')?>"><br>
		<?php echo form_error('jml_pmbyrn','<br><p class="error">','</p>');?><br><br>

               
		<label>Bukti Pembayaran</label>
		<input type="file" name="bukti_pmbyrn"><br>
		<?php echo form_error('bukti_pmbyrn','<br><p class="error">','</p>');?><br><br>
                
		<input type='submit' value='submit'> &nbsp;
		<a style="color:black"href="<?php echo base_url();?>index">Back</a>
                </div>
    </form>

</fieldset>
 
<script>
    $('input:radio[name="jenis_pmbyrn"]').change(function(){
        var jenis_pmbyrn = $('input:radio[name="jenis_pmbyrn"]:checked').val();
        var keterangan = $("#keterangan").val();
        if(jenis_pmbyrn == "pembayaran dp1" && keterangan == "pembayaran dp1"){
            $(this).attr('checked', false);
            alert('Anda sudah membayar DP, silakan lakukan pelunasan pembayaran!');
        }
    });
    $('#jml_pmbyrn').blur(
        function(){
            var jenis_pmbyrn = $('input:radio[name="jenis_pmbyrn"]:checked').val();
            var total_sewa = $("#total_lama_pakai").val(); 
            var jml_pmbyrn = $("#jml_pmbyrn").val();
            var sisa_hrs_dbyr = $("#sisa_hrs_dbyr").val();
            if((jenis_pmbyrn == "pembayaran dp1")&&(total_sewa * 50000 > jml_pmbyrn)){
                $("#jml_pmbyrn").val('');
                alert("Jumlah DP tidak sesuai peraturan. Anda harus membayar sebesar: Rp."+total_sewa*50000);
            }
            else if(jenis_pmbyrn == "lunas" && jml_pmbyrn != sisa_hrs_dbyr){
                $("#jml_pmbyrn").val('');
                alert("Anda harus membayar sebesar: Rp."+sisa_hrs_dbyr);
            }
        }
    )
    $("#no_booking").blur(function(){
       var id_booking = $("#no_booking").val();
       $.ajax({
           url:'http://localhost/ta/index/get_totalprice_json/'+id_booking,
           dataType:'json',
           success:function(data){
               $("#jml_hrs_dbyr").val(data.total);
               $("#dp_harus_dibayar").val(data.total_lama_pemakaian * 50000);
               if(data.keterangan == "lunas"){
                   $("#bayar").hide();
               }
               else if (data.status == "tunggu konfirmasi"){
                   $("#bayar").hide();
               }
               else{
                   $("#bayar").show();
               }
               $("#tgl_pmbyrn").val(data.tanggal_bayar);
               var  html = '<label>Total sewa lapangan</label>'+
		'<input type="text" id="total_lama_pakai" value="'+data.total_lama_pemakaian+'" readonly>jam<br>'+
                '<br><br>'+
                '<label>Total Telah dibayar</label>'+
		'<input type="text" value="'+data.total_dibayar+'" readonly><br>'+
                '<br><br>'+
                '<label>Sisa harus dibayar</label>'+
		'<input type="text" value="'+data.sisa_bayar+'" id="sisa_hrs_dbyr" readonly><br>'+
                '<br><br>'+
                '<label>Keterangan</label>'+
		'<input type="text" value="'+data.keterangan+'" id="keterangan" readonly><br>'+
                '<br><br>'+
                '<label>Status pembayaran</label>'+
		'<input type="text" value="'+data.status+'" readonly><br>'+
                '<br><br>';
               $("#sisa").html(html);
           }
       });
    });
    
    var id_booking = $("#no_booking").val();
    if(id_booking != ''){
    $.ajax({
           url:'http://localhost/ta/index/get_totalprice_json/'+id_booking,
           dataType:'json',
           success:function(data){
               $("#jml_hrs_dbyr").val(data.total);
               $("#dp_harus_dibayar").val(data.total_lama_pemakaian * 50000);
               if(data.keterangan == "lunas"){
                   $("#bayar").hide();
               }
               else if (data.status == "tunggu konfirmasi"){
                   $("#bayar").hide();
               }
               else{
                   $("#bayar").show();
               }
               $("#tgl_pmbyrn").val(data.tanggal_bayar);
               var  html = '<label>Total sewa lapangan</label>'+
		'<input type="text" id="total_lama_pakai" value="'+data.total_lama_pemakaian+'" readonly>jam<br>'+
                '<br><br>'+
                '<label>Total Telah dibayar</label>'+
		'<input type="text" value="'+data.total_dibayar+'" readonly><br>'+
                '<br><br>'+
                '<label>Sisa harus dibayar</label>'+
		'<input type="text" value="'+data.sisa_bayar+'" id="sisa_hrs_dbyr" readonly><br>'+
                '<br><br>'+
                '<label>Keterangan</label>'+
		'<input type="text" value="'+data.keterangan+'" id="keterangan" readonly><br>'+
                '<br><br>'+
                '<label>Status pembayaran</label>'+
		'<input type="text" value="'+data.status+'" readonly><br>'+
                '<br><br>';
               $("#sisa").html(html);
           }
       });
    }
</script>

