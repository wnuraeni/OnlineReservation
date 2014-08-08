<script type="text/javascript">
    $(document).ready(function(){
        $("#dialog1").dialog({
           resizable: true,
           autoOpen:false,
           modal:true,
           width:400,
           height:200
        });
        $("#dialog2").dialog({
           resizable: true,
           autoOpen: false,
           modal: true,
           width: 400,
           height: 200
        });
        return false;
    });
</script>

<script type="text/javascript">
     $(document).ready(function(){
        <?php 
        if (!empty($script_dialog_open))
            echo $script_dialog_open;
        ?>
     });
</script>
<style>
h6{
    font-color:#ccc;

}
table td,th{
    padding:2px;
    border:1px solid #ccc;
    
}
td:hover{
    background-color:#eee;
    cursor:pointer;
}
.reserved{
    background-color:#ccc;
}
.reserved:hover {
    cursor:auto;
    background-color:#ccc;
}
.no-book{
    background-color:red;
}
</style>


  <div class="gallerysec">
        <h4 class="heading colr">Gallery</h4>
  <div class="categories">
                	<h5>Category</h5>
                    <ul>
                    	<li><a href="<?php echo base_url();?>reservasi_controller/index/basket">Lapangan Basket</a></li>
                        <li><a href="<?php echo base_url();?>reservasi_controller/index/tenis">Lapangan Tenis</a></li>
                        <li><a href="<?php echo base_url();?>reservasi_controller/index/badminton">Lapangan Badminton</a></li>
                        <li><a href="<?php echo base_url();?>reservasi_controller/index/futsal">Lapangan Futsal</a></li>
                        <li><a href="<?php echo base_url();?>reservasi_controller/index/voli">Lapangan Voli</a></li>

                    </ul>
  </div>

 <div class="right_gallery">
<div class="sortby" >
<h6 class="left">
    

</h6>
  <ul><li><form action="<?php echo base_url();?>reservasi_controller/index/<?php echo $jenis_lapangan.'/'.$nama_lapangan;?>" method="post">
          <input type="text" name="tanggal" value="<?php echo isset($_POST['tanggal'])?$_POST['tanggal']: date('Y-m-d');?>" id="tanggal">
          <a href="javascript:NewCssCal('tanggal','yyyymmdd')"><img src="<?php echo base_url();?>images/cal.gif"></a>
          <input type="submit" name="cari" value="cari">
           </form></li></ul>
    </div>

     <?php foreach($lapangan as $lap) :?>
        <a style="color:black;font-weight:bold;font-size:15px; <?php echo ($this->uri->segment(4)== $lap->nama_lapangan ? ' background-color:#ccc':'');?>"  href="<?php echo base_url().'reservasi_controller/index/'.$jenis_lapangan.'/'.$lap->nama_lapangan ;?>">
        <?php echo $lap->nama_lapangan ;?>
     </a><?php endforeach;?>
     <br><br>
         
            
<?php if(!empty($nama_lapangan)):?>
<?php $sekarang=date('H').':00' ;
     $sekarangplus1=date('H:i',strtotime($sekarang.'+1 hours'));
     $pembatas=$sekarang.'-'.$sekarangplus1 ;?>

<div class="timer"></div>

<table>
   <th></th>
<?php

  //print_r($jadwal);
   foreach($jadwal['09:00-10:00'] as $tanggal=>$j){
       echo'<th>'.date('l',strtotime($tanggal)).'<br>'.date('d-M-Y',strtotime($tanggal)).'</th>';
   }
   $t=0;
   //print_r($jadwal);
   foreach($jadwal as $jam=>$j){
       echo '<tr><td>'.$jam.'</td>';
       foreach($j as $key=>$value){
           echo '<td ';
           if($key < date('Y-m-d')){
               echo 'class="no-book">'.(!empty($value)?'no:'.$value:'').'</td>';

           }else if ($key == date('Y-m-d')&& ($jam < $pembatas)){
                echo 'class="no-book">'.(!empty($value)?'no:'.$value:'').'</td>';
           }
           else{
                if($this->session->userdata('islogin')){
                    echo ' '.(empty($value)?'onclick="window.location.href=\''.base_url().'reservasi_controller/index/'.$jenis_lapangan.'/'.$nama_lapangan.'/'.$t.'/'.$key.'\'"':'class="reserved"').'>'
                .(!empty($value)?'no:'.$value:'').'</td>';
                }else{
                   echo ' '.(empty($value)?'onclick="alert(\'Anda harus Login! Bila belum jadi member silakan mendaftar!\')"':'class="reserved"').'>'.(!empty($value)?'no:'.$value:'').'</td>'; 
                }
           }
       }
       echo '</tr>';
       $t++;
   }
?>
 </table>

<?php endif ;?>

 </div>
   </div>
<div id="dialog1" title="Pesan">
    <p>Maaf, batas waktu pemesanan terhitung 1 minggu dari tanggal sekarang</p>
</div>
<div id="dialog2" title="Pesan">
    <p>Maaf, pemesanan maksimal 16 jam, Anda telah membooking lebih dari 16 jam</p>
</div>

