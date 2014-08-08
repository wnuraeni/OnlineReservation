<style>
body{
    background-color:#eaeaea;
}

fieldset{
    width:280px;
    position:relative;
    margin:auto;
    top:100px;
    background-color:#fff;

}

fieldset label{
    float:left;
    width:100px;

    }

fieldset input {
    float:left;

}

.error{
    margin-left:100px;
    color:red;
}
</style>




<html>
<body style="background:url(<?php echo base_url();?>images/banner1.gif) no-repeat center">
<fieldset>
  <h3 style="text-align:center">LOGIN</h3>
    <?php echo $this->session->flashdata('message');?>
     <form action='<?php echo base_url();?>login_controller/proses_login' method='post'>
          <label>Username : </label><input type='text' name='username' value="<?php echo set_value('username');?>"><br>
           <?php echo form_error('username','<p class="error">','</p>');?><br><br>
          <label>Password : </label><input type='password' name='password'><br>
          <?php echo form_error('password','<p class="error">','</p>');?><br><br>
          <input type='submit' value='login'> &nbsp;
          <a href="<?php echo base_url();?>admin/main_login/register">Daftar Baru</a> &nbsp;
          <a href="<?php echo base_url();?>admin/main_login/reset_password">Reset Password</a>
    </form>
    
</fieldset>
  </body>
</html>

