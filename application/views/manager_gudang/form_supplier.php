<?php echo $this->session->flashdata('message');?>

<?php if($this->uri->segment(3)== 'ubah_supplier'):?>
<form action="<?php echo base_url();?>manager_gudang/supplier_controller/ubah_supplier/<?php echo $id_supplier?>" method="POST">
<?php else : ?>
<form action="<?php echo base_url();?>manager_gudang/supplier_controller/tambah_supplier" method="post">
<?php endif ;?>
    <table>
    <tr><td>Nama Supplier</td><td>
    <input type="text" name="nama" value="<?php echo empty($supplier)?'':$supplier[0]->nama;?>">
    <?php echo form_error('nama');?>
    </td></tr>
    <tr><td>Alamat Supplier</td>
    <td><input type="text" name="alamat" value="<?php echo empty($supplier)?'':$supplier[0]->alamat;?>">
    <?php echo form_error('alamat');?>
    </td></tr>
    <tr><td>Kota</td><td><input type="text" name="kota" value="<?php echo empty($supplier) ?'':$supplier[0]->kota ;?>">
   <?php echo form_error('kota');?></td></tr>
   <tr><td>Telepon</td><td><input type="text" name="telepon" value="<?php echo empty($supplier) ?'':$supplier[0]->telepon ;?>">
    <?php echo form_error('telepon');?></td></tr>
    <tr><td>Contact Person</td><td><input type="text" name="cp_nama" value="<?php echo empty($supplier) ?'':$supplier[0]->cp_nama ;?>">
    <?php echo form_error('cp_nama');?></td></tr>

    <?php if($this->uri->segment(3)=='ubah_supplier'):?>
    <tr><td><input type="submit" name="simpan" value="simpan" class="btn"></td><td><a href="<?php echo base_url();?>manager_gudang/supplier_controller" class="btnalt">Back</a></td></tr>
    <?php else :?>
    <tr><td><input type="submit" name="tambah" value="tambah" class="btn"></td><td><a href="<?php echo base_url();?>manager_gudang/supplier_controller" class="btnalt">Back</a></td></tr>
    <?php endif ;?>
    </table>
</form>
</form>
