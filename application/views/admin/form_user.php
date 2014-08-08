<?php if($this->uri->segment(3)== 'ubah_user'):?>
<form action="<?php echo base_url();?>admin/user_controller/ubah_user/<?php echo $id_user;?>" method="POST">
<?php else : ?>
<form action="<?php echo base_url();?>admin/user_controller/tambah_user" method="POST">
<?php endif ;?>
    <table>

    <tr><td>Nama :</td><td><input type="text" name="nama" value='<?php echo empty($user)?'':$user[0]->nama;?><?php ($this->uri->segment(3)== 'ubah_user')? 'readonly':''?>'><?php echo form_error('nama');?></td></tr>
    <tr><td>User Name:</td><td><input type="text" name="user_name" value='<?php echo empty($user)?'':$user[0]->user_name;?>'><?php echo form_error('user_name');?></td></tr>
    <?php if($this->uri->segment(3)!= 'ubah_user'):?>
    <tr><td>Password : </td><td><input type="password" name="password" value='<?php echo empty($user)?'':$user[0]->password;?>'><?php echo form_error('password');?></td></tr>
    <?php endif ;?>
    <tr><td>Jabatan : </td><td><input type="text" name="jabatan" value='<?php echo empty($user)?'':$user[0]->jabatan;?>'><?php echo form_error('jabatan');?></td></tr>
    
    <tr><td>
    <?php if($this->uri->segment(3)== 'ubah_user'):?>
    <input class='btnalt'type="submit" value="simpan">
    <?php else : ?>
    <input class='btnalt' type="submit" value="tambah">
    <?php endif ;?>
    <a class='btnalt' href='<?php echo base_url();?>admin/user_controller'>Batal</a>
    </td></tr>
    </table>

</form>