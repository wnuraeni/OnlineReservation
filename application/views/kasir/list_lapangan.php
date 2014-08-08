<script type="text/javascript">
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
<script>
    function sewa(jenis_lapangan,tanggal,jam){
        $.ajax({
                url: 'http://localhost/ta/index.php/kasir/lapangan_controller/get_lapangan_sewa/'+jenis_lapangan+'/'+tanggal+'/'+jam,
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
    function booking(jenis_lapangan,tanggal,jam){
        $.ajax({
                url: 'http://localhost/ta/index.php/kasir/lapangan_controller/get_lapangan_booking/'+jenis_lapangan+'/'+tanggal+'/'+jam,
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
    
<style>
.no-book{
    background-color:red;
    
}
.no-book:hover{
    background-color:red;
    cursor:auto;
}
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
.ui-tabs-nav li a{
    float:left;
    background:no-repeat scroll 0 0 #dbdbdb;
    border-radius: 8px 8px 8px 8px;
    color:#666;
    display:block;
    font-size: 12px;
    margin-right:10px;
    padding:5px 10px;
    text-decoration:none;
    text-shadow: 1px 1px 1px #fff;

}
.ui-tabs-nav li .active a{
    background:none repeat scroll 0 0 #848484;
    color:#fff;
    text-shadow:none;
    
}

</style>

<div class="timer"></div>

<!--<ul class="ui-tabs-nav">
    <?php foreach($lapangan as $lap) :?>
    <li <?php echo ($this->uri->segment(5)== $lap->nama_lapangan ? ' class="active"':'');?>>
        <a href="<?php echo base_url().'index.php/kasir/lapangan_controller/index/'.$jenis_lapangan.'/'.$lap->nama_lapangan ;?>">
        <?php echo $lap->nama_lapangan ;?>
    </a></li><?php endforeach;?>
</ul>-->
<br><br>
<?php if(!empty($jenis_lapangan)):?>
<form action="<?php echo base_url().'index.php/kasir/lapangan_controller/index/'.$jenis_lapangan ;?>" method="post">
  <input type="text" name="tanggal" value="<?php echo (isset($_POST['tanggal'])?$_POST['tanggal']:date('d-M-Y'));?>" id="tanggal">
  <a href="javascript:NewCssCal('tanggal','yyyymmdd')"><img src="<?php echo base_url();?>images/cal.gif"></a>
  <input type="submit" name="cari" value="cari">
</form><br><br><br>

<table border="1">
   <th></th>
<?php

   foreach($jadwal['09:00-10:00'] as $tanggal=>$j){
       echo'<th>'.date('l',strtotime($tanggal)).'<br>'.date('d-M-Y',strtotime($tanggal)).'</th>';
   }
   $t=0;

    $curent=date('H').':00';
    $curentplus1=date('H:i',strtotime($curent.'+1 hours'));
   $pembatas=$curent.'-'.$curentplus1;
   
   foreach($jadwal as $jam=>$j){
       
       echo '<tr><td>'.$jam.'</td>';
       foreach($j as $key=>$value){
           
           echo '<td';
            if(($key < date('Y-m-d'))){
                 if(!empty($value) && count($value) >= $total_lapangan){
                    echo ' class="no-book">'.(!empty($value)?implode(",", $value):'').'</td>';
                 }else{                 
                     echo  ' onclick="booking(\''.$jenis_lapangan.'\',\''.$key.'\',\''.$t.'\')">'.(!empty($value)?implode(",", $value):'').'</td>';
                 }
            }
            else if(($key == date('Y-m-d')) && ($jam < $pembatas)){
                if(!empty($value) && count($value) >= $total_lapangan){
                    echo ' class="no-book">'.(!empty($value)?implode(",", $value):'').'</td>';
                 }else{
                    echo  ' onclick="booking(\''.$jenis_lapangan.'\',\''.$key.'\',\''.$t.'\')">'.(!empty($value)?implode(",", $value):'').'</td>';
                 }
            }
            else if(($key == date('Y-m-d')) && ($jam == $pembatas)){
                if(!empty($value) && count($value) >= $total_lapangan){
                     echo ' class="no-book">'.(!empty($value)?implode(",", $value):'').'</td>';
			
                }else{
                   echo  ' onclick="sewa(\''.$jenis_lapangan.'\',\''.$key.'\',\''.$t.'\')">'.(!empty($value)?implode(",", $value):'').' </td>';
                   
                }
            }
            else{
                 if(!empty($value) && count($value) >= $total_lapangan){
                  
                    echo ' class="no-book">'.(!empty($value)?implode(",", $value):'').'</td>';
             
                }else{
                     echo  ' onclick="booking(\''.$jenis_lapangan.'\',\''.$key.'\',\''.$t.'\')">'.(!empty($value)?implode(",", $value):'').'</td>';
                }
            }
          
       }
       echo '</tr>';
       $t++;
   }
?>
 </table>

<?php endif ;?>
    <div id="dialog" title="Lapangan">
</div>
