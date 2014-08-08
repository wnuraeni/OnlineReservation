<style>
td:hover{
    background-color:#eee;
    cursor:pointer;

}
.reserved{
    background-color:#0eb4c8;

}
.reserved:hover{
    background-color:#0eb4c8;
}


</style>




<form action="<?php echo base_url();?>index.php/kasir/lapangan_controller/index/<?php echo $jenis_lapangan ;?>" method="post">
  <input type="text" name="tanggal" id="tanggal" value="<?php echo isset($_POST['tanggal'])? $_POST['tanggal']:date('Y-m-d');?>"><a href="javascript:NewCssCal('tanggal','yyyymmmdd')"><img src="<?php echo base_url();?>images/cal.gif"></a>
  <input type="submit" name="cari" value="cari">

</form>
<table border="1">
<th></th>
<?php if(!empty($lapangan)){

foreach($lapangan as $lap){
    echo '<th>'.$lap->nama_lapangan.'</th>';
 }
}
?>

<?php $t=0;foreach ($waktu as $w) :?>
    <tr><td><?php echo $w ;?></td>
    <?php for($i=0;$i < count($lapangan);$i++ ) : ?>
    <td <?php echo (($jadwal[$lapangan[$i]->nama_lapangan][$t]=='0')? 'onclick="sewa(\''.$t.'\',\''.$lapangan[$i]->id_lapangan.'\',\''.$lapangan[$i]->nama_lapangan.'\')"':'class="reserved"');?>>
    <?php echo $jadwal[$lapangan[$i]->nama_lapangan][$t];?></td><?php endfor ;?>
    </tr>
    <?php $t++; endforeach ;?>
</table>


<script>

   function sewa(jam,id_lapangan,nama_lapangan){
       window.location.href="<?php echo base_url();?>index.php/kasir/sewa_controller/index/"+jam+"/"+id_lapangan+"/"+nama_lapangan;

   }



 </script>








