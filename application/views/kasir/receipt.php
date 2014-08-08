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
<?php
echo '<div style="text-align:center">
<h3>Bukti Pembayaran Reservasi</h3>
<hr>
</div>
    <table style="margin:auto" width="50%">
            <tr><td><strong>No Booking</strong></td><td>:</td><td>'.$reservasi[0]->id_booking.'</td></tr>
            <tr><td><strong>Nama</strong></td><td>:</td><td>'.$reservasi[0]->nama_pelanggan.'</td></tr>
            <tr><td><strong>Alamat</strong></td><td>:</td><td>'.$reservasi[0]->alamat_pelanggan.'</td></tr>
            <tr><td><strong>Telepon</strong></td><td>:</td><td>'.$reservasi[0]->telepon_pelanggan.'</td></tr>
            <tr><td><strong>Tanggal booking</strong></td><td>:</td><td>'.$reservasi[0]->tanggal_booking.'</td></tr>
            <tr><td><strong>Jam mulai</strong></td><td>:</td><td>'.$reservasi[0]->jam.'</td></tr>
            <tr><td><strong>Nama Lapangan</strong></td><td>:</td><td>'.$reservasi[0]->nama_lapangan.'</td></tr>
            <tr><td><strong>Lama Pemakaian</strong></td><td>:</td><td>'.$reservasi[0]->lama_pemakaian.' jam</td></tr>
            <tr><td><strong>Biaya sewa perjam</strong></td><td>:</td><td>Rp. '.number_format($reservasi[0]->harga_lapangan, 0,'','.').'</td></tr>
            <tr><td><strong>Status Pembayaran</strong></td><td>:</td><td>'.$reservasi[0]->status_pembayaran.'</td></tr>
                <tr><td colspan="3"><hr></td></tr>
            <tr><td><strong>Total harus dibayar</strong></td><td>:</td><td>
            Rp. '.number_format($reservasi[0]->harga_lapangan * $reservasi[0]->lama_pemakaian, 0,'','.').'</td></tr>
                <tr><td colspan="3"><hr></td></tr>
            </table>
           <table style="margin:auto" width="50%">
          
           <tr ><th colspan="3" style="text-align:center">Catatan Pembayaran</th></tr>
            <tr><td colspan="3"><hr></td></tr>
            <tr>
            <th>Tanggal Pembayaran</th>
            <th>Jumlah Bayar</th>
            <th>Keterangan</th>
            </tr>';
            $total = 0;
    foreach($pembayaran as $data){
            echo '<tr>
                <td>'.$data->tanggal_pbyr.'</td>
                <td>Rp. '.number_format($data->total_pembayaran, 0,'','.').'</td>
                <td>'.$data->keterangan_pbyr.'</td>
                <td>';
                echo '</td>
                </tr>';
                $total += $data->total_pembayaran;
    }
    $harus_dibayar = $reservasi[0]->harga_lapangan * $reservasi[0]->lama_pemakaian;
    echo '<tr><td colspan="3"><hr></td></tr>';
    echo '<tr><td><strong>Total telah dibayar </strong></td><td>:</td><td>Rp. '.number_format($total, 0,'','.').'</td></tr>';
    echo '<tr><td><strong>Sisa yang harus dibayar </strong></td><td>:</td><td>Rp. '.number_format(($harus_dibayar - $total), 0,'','.').'</td></tr>';

    ?>
</table>
<button onclick="window.print()">Cetak</button>
<button onclick="via_email()">Kirim via Email</button>
<div id="dialog" title="Kirim konfirmasi via Email">
    <form action="<?php echo base_url()?>index.php/kasir/reservasi_controller/receipt_via_email" method="POST">
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
                dataType : 'json',
                success: function(data){
                    $("#dialog").html(data.html);
                }
            });

        $('#dialog')
        .dialog('open');
}
</script>