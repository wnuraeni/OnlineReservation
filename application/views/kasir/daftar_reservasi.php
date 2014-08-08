<script>
$(document).ready(function(){
    $("#dialog").dialog({
            resizable: true,
            autoOpen:false,
            modal: true,
            width:700,
            height:700
            });//end dialog
    $("#dialog2").dialog({
        resizable: true,
        autoOpen:false,
        modal: true,
        width:600,
        height:600
    });//end dialog
            return false;
 });
</script>
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
<div style="float:left">
   <button onclick="window.location.href='<?php echo base_url('index.php/kasir/reservasi_controller/cek_reservasi')?>'">Cek Belum Bayar</button>
   <button onclick="window.location.href='<?php echo base_url('index.php/kasir/reservasi_controller/cek_dp')?>'">Cek DP</button>
   <button onclick="window.location.href='<?php echo base_url('index.php/kasir/reservasi_controller/cek_batal')?>'">Cek Batal</button>
   <button onclick="window.location.href='<?php echo base_url('index.php/kasir/reservasi_controller/cek_now')?>'">Daftar Sewa hari ini</button>
   <button onclick="window.location.href='<?php echo base_url('index.php/kasir/reservasi_controller/all')?>'">Lihat Semua</button>
</div>


  <div style="float:right">
      <form action="<?php echo base_url();?>index.php/kasir/reservasi_controller/index" method="post">
    <input type="text" name="keyword" placeholder="keyword..">
     <select name="kategori"><option value="booking.id_booking">Id Booking</option>
                             <option value="pelanggan.nama_pelanggan">Nama</option>
     </select>
     <input type="submit" name="search" value="cari">
</form></div>
<br><br>

<div class="pagelink"><?php echo $this->pagination->create_links();?></div>
<br><br><br>

<form action="<?php echo base_url().'index.php/kasir/reservasi_controller/pembatalan'?>" method="POST">
<table>
    <th>Nomer</th><th>No Booking</th><th>Nama Pelanggan</th><th>Nama Lapangan</th><th>Jam Mulai</th><th>Lama Pemakaian</th><th>Tanggal Booking</th><th>Status</th><th>Status Pembayaran</th><th>Aksi</th>
    <?php $i=1; foreach($sewa as $s) :?>
    <tr
        <?php
         $sisa_hari = (strtotime($s->tanggal_booking)-strtotime(date('Y-m-d')))/(24*60*60);
        if($s->status_booking == "batal"){
            echo 'style="background-color:red"';
        }
//        if((strtotime($s->tanggal_booking) < strtotime(date('Y-m-d')))
//                && (empty($s->status_pembayaran))
//                &&($s->status_booking=="booking")){
        if((strtotime($s->tanggal_booking) < strtotime(date('Y-m-d')))&&($s->status_booking=="booking")){
            if($s->status_pembayaran == "pembayaran dp1" || $s->status_pembayaran=="belum dibayar"){
            //klo tanggal lebih kecil dr hari ini
                echo 'style="background-color:yellow"';
            }
            if($sisa_hari > 0 && $sisa_hari < 7){
               echo 'style="background-color:yellow"';
            }
        }
        //klo tgl booking - sekarang = 7 hari munculin jd kuning juga
       
        
        ?>
        >
     <td><?php echo $i ;?></td>
     <td><?php echo $s->id_booking ;?></td>
     <td><?php echo $s->nama_pelanggan ;?></td>
     <td><?php echo $s->nama_lapangan ;?></td>
     <td><?php echo $s->jam ;?></td>
     <td><?php echo $s->lama_pemakaian." jam" ;?></td>
     <td><?php echo $s->tanggal_booking ;?></td>
     <td><?php echo $s->status_booking;?></td>
     <td><?php echo $s->status_pembayaran;?></td>
     <td>
          <a href="#" onclick="detail(<?php echo $s->id_booking?>)">Detail</a><br>
             <?php if($s->status_booking=='booking'):?>
          <a href="<?php echo base_url();?>index.php/kasir/reservasi_controller/checkin/<?php echo $s->id_booking ;?>">Masuk</a><br>
          <a href="<?php echo base_url();?>index.php/kasir/reservasi_controller/batal/<?php echo $s->id_booking ;?>">Batal</a>
          <?php endif ;?>
    <br>
          <?php if($s->status_booking=='checkin'):?>
              <a href="<?php echo base_url();?>index.php/kasir/reservasi_controller/keluar/<?php echo $s->id_booking ;?>">Selesai/Pulang</a>
          <?php endif ;?>
     </td>
     </tr>
     <input type="hidden" name="id[]" value="<?php echo $s->id_booking?>">
     <?php $i++; endforeach ;?>
     <?php 
     if($this->uri->segment(3)=="cek_reservasi" || $this->uri->segment(3)=="cek_dp"){?>
<tr><td colspan="6"><input type="submit" name="batalkan" value="Batalkan Semua"></td></tr>
<?php } ?>
</table>
</form>
<div id="dialog" title="Detail Reservasi"></div>
<div id="dialog2" title="Tambah Pembayaran ">

   
</div>
<?php echo $this->session->flashdata('script');
?>

<script>
    function detail(id_reservasi){
        $.ajax({
                url: 'http://localhost/ta/index.php/kasir/reservasi_controller/detail_reservasi/'+id_reservasi,
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
    function pembayaran(id_reservasi){
//            $('#dialog').dialog('close');
//            $('#dialog').hide();
$('#dialog2').dialog('open');
             $.ajax({
                url: 'http://localhost/ta/index.php/kasir/reservasi_controller/pembayaran2/'+id_reservasi,
                //type: 'post',
                dataType : 'json',
              //  data : {id_barang:id_barang},
                success: function(data){
                    $("#dialog2").html(data.html);
                }
            });

        
    }

    


</script>
<script>
'<img src="../../image/'+url+'">'
</script>