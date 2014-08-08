<style>

fieldset{
    width:280px;
    position:relative;
    margin:auto;
   
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


<fieldset>
  <h3 style="text-align:center">Reset Password</h3>
    <?php echo $this->session->flashdata('message');?>
     <form action='<?php echo base_url();?>index/reset_password' method='post'>
          <label>Email : </label><input type='text' name='email' value="<?php echo set_value('email');?>"><br>
           <?php echo form_error('email','<p class="error">','</p>');?><br><br>
          <label>Password Baru : </label><input type='password' name='password'><br>
          <?php echo form_error('password','<p class="error">','</p>');?><br><br>
          <input type='submit' value='submit'> &nbsp;
          <a style="color:black"href="<?php echo base_url();?>index">Back</a>
    </form>

</fieldset>
 


