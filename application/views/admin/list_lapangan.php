
<?php echo $this->session->flashdata('message') ;?>
<table border="1">
   <thead><th><span style="float:left">Basket</span><span id="icons" style="float:left"><a class="ui-corner-all" href="<?php echo base_url() ;?>admin/lapangan/tambah/basket"><span style="margin-left:48px" class="ui-icon ui-icon-circle-plus"></span></a></span></th>
   <th><span style="float:left">Tenis</span><span id="icons" style="float:left"><a class="ui-corner-all" href="<?php echo base_url() ;?>admin/lapangan/tambah/tenis"><span style="margin-left:48px" class="ui-icon ui-icon-circle-plus"></span></a></span></th>
   <th><span style="float:left">Voli</span><span id="icons" style="float:left"><a class="ui-corner-all" href="<?php echo base_url() ;?>admin/lapangan/tambah/voli"><span style="margin-left:48px" class="ui-icon ui-icon-circle-plus"></span></a></span></th>
   <th><span style="float:left">Badminton</span><span id="icons" style="float:left"><a class="ui-corner-all" href="<?php echo base_url() ;?>admin/lapangan/tambah/badminton"><span style="margin-left:48px" class="ui-icon ui-icon-circle-plus"></span></a></span></th>
   <th><span style="float:left">Futsal</span><span id="icons" style="float:left"><a class="ui-corner-all" href="<?php echo base_url() ;?>admin/lapangan/tambah/futsal"><span style="margin-left:48px" class="ui-icon ui-icon-circle-plus"></span></a></span></th>
   </thead>
<tbody>
      <tr>
       <td><?php foreach($basket as $b): ?>
         <p><?php echo $b->nama_lapangan ;?> <span style="margin-left:15px"><a href="<?php echo base_url();?>admin/lapangan/edit_lapangan/<?php echo $b->id_lapangan;?>" title="edit"><img src="<?php echo base_url();?>images/icons/icon_edit.png"></a></span>
        <span style="margin-left:15px"><a href="#" onclick="confirm_delete(<?php echo $b->id_lapangan;?>)"><img src="<?php echo base_url();?>images/icons/icon_delete.png"></a></span>
            
         </p> <?php endforeach ;?>
       </td>

        <td><?php foreach($tenis as $tn): ?>
         <p><?php echo $tn->nama_lapangan ;?> <span style="margin-left:15px"><a href="<?php echo base_url();?>admin/lapangan/edit_lapangan/<?php echo $tn->id_lapangan;?>" title="edit"><img src="<?php echo base_url();?>images/icons/icon_edit.png"></a></span>
            <span style="margin-left:15px"><a href="#" onclick="confirm_delete(<?php echo $tn->id_lapangan;?>)"><img src="<?php echo base_url();?>images/icons/icon_delete.png"></a></span>
            
         </p> <?php endforeach ;?>
       </td>

         <td><?php foreach($voli as $vo): ?>
         <p><?php echo $vo->nama_lapangan ;?> <span style="margin-left:15px"><a href="<?php echo base_url();?>admin/lapangan/edit_lapangan/<?php echo $vo->id_lapangan;?>" title="edit"><img src="<?php echo base_url();?>images/icons/icon_edit.png"></a></span>
            <span style="margin-left:15px"><a href="#" onclick="confirm_delete(<?php echo $vo->id_lapangan;?>)"><img src="<?php echo base_url();?>images/icons/icon_delete.png"></a></span>

         </p> <?php endforeach ;?>
       </td>

        <td><?php foreach($badminton as $bd): ?>
         <p><?php echo $bd->nama_lapangan ;?> <span style="margin-left:15px"><a href="<?php echo base_url();?>admin/lapangan/edit_lapangan/<?php echo $bd->id_lapangan;?>" title="edit"><img src="<?php echo base_url();?>images/icons/icon_edit.png"></a></span>
            <span style="margin-left:15px"><a href="#" onclick="confirm_delete(<?php echo $bd->id_lapangan;?>)"><img src="<?php echo base_url();?>images/icons/icon_delete.png"></a></span>
           
         </p> <?php endforeach ;?>
       </td>

        <td><?php foreach($futsal as $f): ?>
         <p><?php echo $f->nama_lapangan ;?> <span style="margin-left:15px"><a href="<?php echo base_url();?>admin/lapangan/edit_lapangan/<?php echo $f->id_lapangan;?>" title="edit"><img src="<?php echo base_url();?>images/icons/icon_edit.png"></a></span>
            <span style="margin-left:15px"><a href="#" onclick="confirm_delete(<?php echo $f->id_lapangan;?>)"><img src="<?php echo base_url();?>images/icons/icon_delete.png"></a></span>
            
         </p> <?php endforeach ;?>
       </td>

      </tr>
    
  

        <!--<tr>
          <td><a href="<?php echo base_url() ;?>admin/lapangan/tambah/basket">Tambah Lapangan</a></td>
          <td><button class="btnalt" onclick="window.location.href='<?php echo base_url() ;?>admin/lapangan/tambah/tenis'">Tambah Lapangan</button></td>
          <td><button class="btnalt" onclick="window.location.href='<?php echo base_url() ;?>admin/lapangan/tambah/badminton'">Tambah Lapangan</button></td>
          <td><button class="btnalt" onclick="window.location.href='<?php echo base_url() ;?>admin/lapangan/tambah/futsal'">Tambah Lapangan</button></td>
          
          </tr>-->
   </tbody>
</table>


<div id="dialog" title="confirmasi"><p>Anda yakin akan menghapus data ini ?</p></div>
<script>//$(document).ready(function(){
  $("#dialog").dialog({
      resizable:true,
      autoOpen:false,
      modal:true,
      width:400,
      height:200,
      buttons:{
         'Ya': function(){
             //$(this).dialog('close');
             //proses
             window.location.href='<?php echo base_url();?>admin/lapangan/delete_lapangan/'+$(this).data('id');
         },
         'Batal': function(){
             $(this).dialog('close');
         }

      }
  });
 // return false;

//}); </script>


<script>
    function confirm_delete(id){
 $('#dialog')
 .data('id',id)
 .dialog('open');
 }
</script>


