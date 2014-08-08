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
<div style="float:right">
<form action="<?php echo base_url();?>admin/user_controller/index" method="post">
    <input type="text" name="keyword" placeholder="keyword..." >
    <select name="category" style="margin:0;margin-left:5px;width:10px;padding-button:2px">
    <option value="user_name">Username</option>
    <option value="jabatan">Jabatan</option>
    </select>
    <input type="submit" name="search" value="cari">
</form>
</div>

<?php echo $this->session->flashdata('message') ;?>
<br>


<div class="pagelink"><?php echo $this->pagination->create_links();?></div>
<table style="clear:left">
    <thead><th>Nama</th><th>User name</th><th>Jabatan</th><th>Aksi</th></thead>
    <tbody><?php foreach($user as $u):?>
    <tr>
        <td><?php echo $u->nama ;?></td>
        <td><?php echo $u->user_name ;?></td>
        <td><?php echo $u->jabatan ;?></td>
       <td><a href="#" onclick="confirm_delete(<?php echo $u->user_id ;?>)">
        <img src="<?php echo base_url();?>images/icons/icon_delete.png"></a></td>
    </tr>
    <?php endforeach ;?>

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
             window.location.href='<?php echo base_url();?>admin/user_controller/delete_user/'+$(this).data('id');
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


