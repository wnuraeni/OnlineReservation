
<form action="<?php echo base_url();?>admin/member_controller/ubah_member/<?php echo $id_member;?>" method="POST">

    <table>
    <tr><td>Nama :</td><td><input type="text" name="nama_pelanggan" value='<?php echo empty($member)?'':$member[0]->nama_pelanggan;?>' readonly></td></tr>
    <tr><td>Alamat:</td><td><input type="text" name="alamat_pelanggan" value='<?php echo empty($member)?'':$member[0]->alamat_pelanggan;?>'></td></tr>
    <tr><td>Telepon : </td><td><input type="text" name="telp_pelanggan" value='<?php echo empty($member)?'':$member[0]->telepon_pelanggan;?>'></td></tr>
    
    <tr><td>
    <input class='btnalt'type="submit" value="simpan">
    <a class='btnalt' href='<?php echo base_url();?>admin/member_controller'>Batal</a>
    </td></tr>
    </table>

</form>