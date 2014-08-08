<?php if($this->uri->segment(3)== 'edit_lapangan'):?>
<form action="<?php echo base_url();?>admin/lapangan/edit_lapangan/<?php echo $id_lapangan;?>" method="POST">
<?php else : ?>
<form action="<?php echo base_url();?>admin/lapangan/tambah/<?php echo $jenis?>" method="POST">
<?php endif ;?>
    <table>
    <tr><td>Jenis Lapangan : <?php echo $jenis;?></td></tr>
    <tr><td>Nama Lapangan :</td><td><input type="text" name="nama_lapangan" value='<?php echo empty($lapangan)?'':$lapangan[0]->nama_lapangan;?>'></td>
        <td><?php echo form_error('nama_lapangan')?></td>
    </tr>
    <tr><td>Sewa per Jam :</td><td><input type="text" name="harga_sewa" value='<?php echo empty($lapangan)?'':$lapangan[0]->sewa_lapangan;?>' <?php echo($this->uri->segment(3)== 'edit_lapangan')?'readonly':'';?> ></td></tr>
    
    <input type="hidden" name="jenis_lapangan" value="<?php echo empty ($lapangan)?$jenis :$lapangan[0]->jenis_lapangan;?>">
    <tr><td>
    <?php if($this->uri->segment(3)== 'edit_lapangan'):?>
    <input class='btnalt'type="submit" value="simpan">
    <?php else : ?>
    <input class='btnalt' type="submit" value="tambah">
    <?php endif ;?>
    <a class='btnalt' href='<?php echo base_url();?>admin/lapangan'>Batal</a>
    </td></tr>
    </table>
    
</form>