<style>

select{
    margin:0;
    margin-top:4px;
    padding:0;
    float:left;
    margin-left:20px;
}

.pagelink {
  float:right;
  margin-left:550px;
  margin-top:12px;

}
table thead,table tr{
    border:1px solid #ccc;
}
table{
    clear:left;
    margin-top:10px;
    text-align:center;
    width:100%;
}

</style>

<?php if($this->uri->segment(3)=='tambah_promo') :?>
 <form action="<?php echo base_url();?>manager_keuangan/promosi_controller/tambah_promo" method="post">
 <?php else :?>
    <form action="<?php echo base_url();?>manager_keuangan/promosi_controller/ubah_promo/<?php echo $id_promo;?>" method="post">
    <?php endif ;?>
    <div class="inputboxes">
      <label>Nama Promosi</label>
      <input type="text" class="inputbox" name="nama_promo" value="<?php echo empty($promo[0]->nama_promo)?'':$promo[0]->nama_promo;?>">
    </div>
     <div class="inputboxes">
      <label>Deskripsi</label>
      <input type="text" class="inputbox" name="deskripsi" value="<?php echo empty($promo[0]->deskripsi)?'':$promo[0]->deskripsi;?>">
    </div>
     <div class="inputboxes">
      <label>Diskon</label>
      <input type="text" class="inputbox" name="diskon" value="<?php echo empty($promo[0]->diskon)?'':$promo[0]->diskon;?>">
       Nilai Dalam Desimal
    </div>
     <div class="inputboxes">
      <label>Periode Awal</label>
      <input type="text" class="inputbox" id="periode_awal" name="periode_awal" value="<?php echo empty($promo[0]->periode_awal)?'':$promo[0]->periode_awal;?>">
      <a href="javascript:NewCssCal('periode_awal','yyyymmdd')"><img src="<?php echo base_url();?>images/icons/icon_lrg_calendar.png"></a>
    </div>
     <div class="inputboxes">
      <label>Periode Akhir</label>
      <input type="text" class="inputbox" id="periode_akhir" name="periode_akhir" value="<?php echo empty($promo[0]->periode_akhir)?'':$promo[0]->periode_akhir;?>">
       <a href="javascript:NewCssCal('periode_akhir','yyyymmdd')"><img src="<?php echo base_url();?>images/icons/icon_lrg_calendar.png"></a>
    </div>
    <div><input type="submit" name="simpan" value="simpan" class="btn">
     <a href="<?php echo base_url();?>manager_keuangan/promosi_controller/index">Back</a>
    </div>
    
   </form>


</form>