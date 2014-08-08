<?php echo $this->session->flashdata('message');?>

<?php if($this->uri->segment(3)== 'ubah_inventori'):?>
<form action="<?php echo base_url();?>manager_keuangan/inventori_controller/ubah_inventori/<?php echo $id_barang_inventori?>" method="post" enctype="multipart/form-data">


<?php endif ;?>
    <table>
    <tr><td>Kategori Barang :</td><td><select name="categori_id">
    <?php foreach($categori as $c):?>
    <option value="<?php echo $c->id_categori_barang ;?>" <?php echo empty($inventori) ?'' :($inventori[0]->id_categori_barang == $c->id_categori_barang ?'selected':'')?>><?php echo $c->categori ;?></option>
    <?php endforeach ;?>
  
    <tr><td>Gambar Barang</td>
    <td><input type="file" name="userfile"><?php echo empty($inventori) ? '':$inventori[0]->gambar_barang ;?>
    <input type="hidden" name="gambar_barang" value="<?php echo empty($inventori) ? '':$inventori[0]->gambar_barang ;?>">
    </td></tr>
    <tr><td>Nama barang:</td><td><input type="text" name="nama_barang" value="<?php echo empty($inventori) ?'':$inventori[0]->nama_barang ;?>"></td></tr>
    <tr><td>Merek barang:</td><td><input type="text" name="merek_barang" value="<?php echo empty($inventori) ?'':$inventori[0]->merek_barang ;?>"></td></tr>
    <tr><td>Option</td><td id="option"><?php if(!empty($inventori) && !empty($options[$inventori[0]->id_barang_inventori])) {
          foreach ($options[$inventori[0]->id_barang_inventori] as $i){
              echo '<input type="hidden" name="id_option[]" value="'.$i->id_option_barang.'">';
              echo '<input type="text" name="option[]" value="'.$i->nama_option.'">';
              echo '<input type="text" name="option_value[]" value="'.$i->nilai_option.'">';
          }
     } ?></td>
    <?php if($this->uri->segment(3)!= 'ubah_inventori') :?>
    <td><a href="#" onclick="tambah_option('option')">Tambah</a></td>
    <?php endif ;?>
    </tr>
    <tr><td>Jumlah barang:</td><td><input type="text" name="jumlah_barang" value="<?php echo empty($inventori)?'':$inventori[0]->jumlah_barang ;?>"></td></tr>
    <tr><td>Harga sewa:</td><td><input type="text" name="harga_sewa" value="<?php echo empty($inventori) ?'':$inventori[0]->harga_sewa ;?>"></td></tr>
    
    <?php if($this->uri->segment(3)=='ubah_inventori'):?>
    <tr><td><input type="submit" name="simpan" value="simpan" class="btn"></td><td><a href="<?php echo base_url();?>manager_keuangan/inventori_controller" class="btnalt">Back</a></td></tr>
    <?php else :?>
    <tr><td><input type="submit" name="tambah" value="tambah" class="btn"></td><td><a href="<?php echo base_url();?>manager_keuangan/inventori_controller" class="btnalt">Back</a></td></tr>
    <?php endif ;?>
    </table>
</form>

<script>
   /* $('#tipe_barang').change(function(){
        $.ajax({
            url:'<?php echo base_url();?>manager_gudang/inventori_controller/ambil_nama_barang',
            type:'post',
            dataType:'json',
            data:{'tipe':$('#tipe_barang').val()},
            success :function(data){
                $('#nama_barang').html("<option>-Pilih-</option>"+data.html);
            }
        });
    });
    
   $('#nama_barang').change(function(){
        $.ajax({
            url:'<?php echo base_url();?>manager_gudang/inventori_controller/ambil_merek_barang',
            type:'post',
            dataType:'json',
            data:{'nama':$('#nama_barang').val()},
            success :function(data){
                $('#merek_barang').html("<option>-Pilih-</option>"+data.html);
            }
        });
    });*/

   function tambah_option(element_id){
       var element_id = element_id;
       var html = '<input type="text" name="option[]" placeholder="option.." ><input type="text" name="option_val[]" placeholder="nilai.."><br>';
       $('#'+ element_id).append(html);
   }



</script>