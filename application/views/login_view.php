<?php 
echo $this->session->flashdata('message');?>

<form action="<?php echo base_url();?>index/proses_login" method="post">
   <ul class="forms"><li class="txt">Username</li>
                    <li class="inputfield"><input type="text" name="username" value="<?php echo set_value('username');?>"></li>
                    <li><?php echo form_error('username');?></li>
   </ul>
   <div class="clear"></div>
    <ul class="forms"><li class="txt">Password</li>
                    <li class="inputfield"><input type="password" name="password" value="<?php echo set_value('password');?>"></li>
                    <li><?php echo form_error('password');?></li>
   </ul>
 <div class="clear"></div>
  <ul class="forms"><li class="txt"></li>
                    <li><input type="submit" name="login" value="login"><input type="button" onclick="window.location.href='<?php echo base_url();?>index'" value="back"></li></li>
      <a style="color:black" href="<?php echo base_url();?>index/reset_password">Reset Password</a>
   </ul>

</form>







