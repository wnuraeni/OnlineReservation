<?php echo $this->session->flashdata('message');?>

<form action="<?php echo base_url();?>index/register" method="post">
   <ul class="forms"><li class="txt">Username</li>
                    <li class="inputfield"><input type="text" name="username" value="<?php echo set_value('username');?>"></li>
                    <li><?php echo form_error('username');?></li>
   </ul>
   <div class="clear"></div>
    <ul class="forms"><li class="txt">Password</li>
                    <li class="inputfield"><input type="password" name="password" ></li>
                    <li><?php echo form_error('password');?></li>
   </ul>
   <div class="clear"></div>
    <ul class="forms"><li class="txt">Nama</li>
                    <li class="inputfield"><input type="text" name="nama" value="<?php echo set_value('nama');?>"></li>
                    <li><?php echo form_error('nama');?></li>
   </ul>
   <div class="clear"></div>
    <ul class="forms"><li class="txt">Alamat</li>
                    <li class="inputfield"><input type="text" name="alamat" value="<?php echo set_value('alamat');?>"></li>
                    <li><?php echo form_error('alamat');?></li>
   </ul>
   <div class="clear"></div>
    <ul class="forms"><li class="txt">Telepon</li>
                    <li class="inputfield"><input type="text" name="telepon" value="<?php echo set_value('telepon');?>"></li>
                    <li><?php echo form_error('telepon');?></li>
   </ul>
   <div class="clear"></div>
    <ul class="forms"><li class="txt">Email</li>
                    <li class="inputfield"><input type="text" name="email" value="<?php echo set_value('email');?>"></li>
                    <li><?php echo form_error('email');?></li>
   </ul>
 <div class="clear"></div>
  <ul class="forms"><li class="txt"></li>
                    <li><input type="submit" name="simpan" value="daftar"><input type="button" onclick="window.location.href='<?php echo base_url();?>index'" value="back"></li>

   </ul>

</form>


