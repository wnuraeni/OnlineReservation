
<form action="<?php echo base_url();?>admin/karyawan_controller/ubah_karyawan/<?php echo $id_karyawan;?>" method="POST">

    <table>
    <tr><td>Nama :</td><td><input type="text" name="nama_karyawan" value='<?php echo empty($karyawan)?'':$karyawan[0]->nama_karyawan;?>' readonly></td></tr>
    <tr><td>Alamat:</td><td><input type="text" name="alamat_karyawan" value='<?php echo empty($karyawan)?'':$karyawan[0]->alamat_karyawan;?>'></td></tr>
    <tr><td>Kota : </td><td><input type="text" name="kota" value='<?php echo empty($karyawan)?'':$karyawan[0]->kota;?>'></td></tr>
    <tr><td>Telepon : </td><td><input type="text" name="telepon" value='<?php echo empty($karyawan)?'':$karyawan[0]->telepon;?>'></td></tr>
    <tr><td>
    <input class='btnalt'type="submit" value="simpan">
    <a class='btnalt' href='<?php echo base_url();?>admin/karyawan_controller'>Batal</a>
    </td></tr>
    </table>

</form>