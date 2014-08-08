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
    width:120px;

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
  <h3 style="text-align:center">Reset Password</h3>
    <?php echo $this->session->flashdata('message');?>
     <form action='<?php echo base_url();?>admin/main_login/reset_password' method='post'>
          <label>Email : </label><input type='text' name='email' value="<?php echo set_value('email');?>"><br>
           <?php echo form_error('email','<p class="error">','</p>');?><br><br>
          <label>Password Baru : </label><input type='password' name='password'><br>
          <?php echo form_error('password','<p class="error">','</p>');?><br><br>
          <input type='submit' value='submit'> &nbsp;
          <a href="<?php echo base_url();?>admin/main_login">Back</a>
    </form>
    
</fieldset>
  </body>
</html>


