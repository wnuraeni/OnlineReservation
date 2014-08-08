<style>
body{
    background-color:#eaeaea;
}

fieldset{
    width:320px;
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



<form action="<?php echo base_url();?>admin/main_login/register" method="POST">

    <table>

    <tr><td>Nama :</td><td><input type="text" name="nama"><?php echo form_error('nama');?></td></tr>
    <tr><td>Alamat : </td><td><input type="text" name="alamat"><?php echo form_error('alamat_karyawan');?></td></tr>
    <tr><td>Kota : </td><td><input type="text" name="kota"><?php echo form_error('kota');?></td></tr>
    <tr><td>Telepon : </td><td><input type="text" name="telepon"><?php echo form_error('telepon');?></td></tr>
    <tr><td>User Name:</td><td><input type="text" name="user_name"><?php echo form_error('user_name');?></td></tr>
    <tr><td>Password : </td><td><input type="password" name="password"><?php echo form_error('password');?></td></tr>
    <tr><td>Email : </td><td><input type="text" name="email"><?php echo form_error('email');?></td></tr>

    <tr><td>Jabatan : </td><td><input type="radio" name="jabatan" value="admin">Admin <br>
                               <input type="radio" name="jabatan" value="kasir">Kasir <br>
                               <input type="radio" name="jabatan" value="manager_keuangan">Manager Keuangan <br>
                               <input type="radio" name="jabatan" value="manager_gudang">Manager Gudang <br>
    <?php echo form_error('jabatan');?></td></tr>

    <tr><td>
    <input class='btnalt' type="submit" value="tambah">
   
    <a class='btnalt' href='<?php echo base_url();?>admin/main_login'>Batal</a>
    </td></tr>
    </table>

</form>

</fieldset>
</body>
</html>