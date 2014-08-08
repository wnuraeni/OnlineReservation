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

<div class="pagelink"><?php echo $this->pagination->create_links();?></div>
<br><br><br>

<form action="<?php echo base_url().'index.php/kasir/reservasi_controller/pembatalan'?>" method="POST">
<table><th>No Booking</th><th>Nama Lapangan</th><th>Jam Mulai</th><th>Lama Pemakaian</th><th>Tanggal Booking</th><th>Status Booking</th><th>Status Pembayaran</th><th>Aksi</th>
    <?php $i=1; foreach($sewa as $s) :?>
    <tr
        <?php
        if($s->status_booking == "batal"){
            echo 'style="background-color:red"';
        }
        if((strtotime($s->tanggal_booking) < strtotime(date('Y-m-d')))
                && (empty($s->status_pembayaran))
                &&($s->status_booking=="booking")){
                
            //klo tanggal lebih kecil dr hari ini
            echo 'style="background-color:yellow"';
        }
        ?>
        >
     <td><?php echo $s->id_booking ;?></td>
     <td><?php echo $s->nama_lapangan ;?></td>
     <td><?php echo $s->jam ;?></td>
     <td><?php echo $s->lama_pemakaian." jam" ;?></td>
     <td><?php echo $s->tanggal_booking ;?></td>
     <td><?php echo $s->status_booking;?></td>
     <td><?php echo $s->status_pembayaran;?></td>
     <td>
         <?php if($s->status_booking == 'booking' && $s->status_pembayaran != 'lunas'):?>
          <a href="<?php echo base_url()?>index/payment/<?php echo $s->id_booking?>">Bayar</a><br>
         <?php endif; ?>   
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
