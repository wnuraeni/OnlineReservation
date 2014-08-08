<script>
$(document).ready(function(){
    $("#dialog").dialog({
            resizable: true,
            autoOpen:false,
            modal: true,
            width:400,
            height:200
            });//end dialog
            return false;
 });
</script>
<div style="text-align:center">
<h3>Terima Kasih Telah Melakukan Pesanan</h3>
<p>Silakan Datang 30 menit Sebelum Waktu yang telah Anda pesan</p>
<p>Simpan Bukti dibawah untuk Bukti Konfirmasi Pesanan</p>
<hr>
</div>
<br>
<table style="margin:auto" width="30%">
<tr><td><strong>No Booking</strong></td><td>:</td><td><?php echo $reservasi[0]->id_booking;?></td></tr>
<tr><td><strong>ID Member</strong></td><td>:</td><td><?php echo $reservasi[0]->id_member;?></td></tr>
<tr><td><strong>Nama</strong></td><td>:</td><td><?php echo $reservasi[0]->nama_pelanggan;?></td></tr>
<tr><td><strong>Alamat</strong></td><td>:</td><td><?php echo $reservasi[0]->alamat_pelanggan;?></td></tr>
<tr><td><strong>Telepon</strong></td><td>:</td><td><?php echo $reservasi[0]->telepon_pelanggan;?></td></tr>
<tr><td colspan="3"><hr></td></tr>
<tr><td><strong>Nama Lapangan</strong></td><td>:</td><td><?php echo $reservasi[0]->nama_lapangan;?></td></tr>
<tr><td><strong>Tanggal Sewa</strong></td><td>:</td><td><?php echo $reservasi[0]->tanggal_booking;?></td></tr>
<tr><td><strong>Jam Sewa</strong></td><td>:</td><td><?php echo $reservasi[0]->jam;?></td></tr>
<tr><td><strong>Lama Pemakaian</strong></td><td>:</td><td><?php echo $reservasi[0]->lama_pemakaian;?> jam</td></tr>
<tr><td><strong>Sewa per Jam</strong></td><td>:</td><td><?php echo 'Rp.'. number_format($reservasi[0]->harga_lapangan,0,'','.');?></td></tr>

<tr><td colspan="3"><hr></td></tr>
<tr><td><strong>Total yang harus dibayar</strong></td><td>:</td><td><?php echo 'Rp. '. number_format($reservasi[0]->harga_lapangan*$reservasi[0]->lama_pemakaian, 0,'','.')?></td></tr>

</table>

<button onclick="window.print()">Cetak</button>
<button onclick="window.location.href='<?php echo base_url();?>index.php/kasir/reservasi_controller/pembayaran/<?php echo $id_reservasi;?>'">Pembayaran</button>
<button onclick="via_email()">Kirim via Email</button>
<div id="dialog" title="Kirim konfirmasi via Email">
    <form action="<?php echo base_url()?>index.php/kasir/reservasi_controller/konfirmasi_via_email" method="POST">
        <table>
        <tr><td>No booking : </td><td><input type="text" name="id_booking" readonly value="<?php echo $reservasi[0]->id_booking;?>"></td></tr>
        <tr><td>Email : </td><td><input type="text" name="email"></td></tr>
        <tr><td><input type="submit" name="submit" value="Submit"></td></tr>
        </table>
    </form>

</div>

<script>
function via_email(){
    $.ajax({
               // url: 'http://localhost/ta/index.php/kasir/reservasi_controller/detail_reservasi/'+id_reservasi,
                //type: 'post',
                dataType : 'json',
              //  data : {id_barang:id_barang},
                success: function(data){
                    $("#dialog").html(data.html);
                }
            });

        $('#dialog')
        .dialog('open');
}
</script>