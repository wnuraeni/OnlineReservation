<?php if($this->uri->segment(3)=='tambah'):?>

<form action="<?php echo base_url();?>admin/news_controller/tambah" method="post" enctype="multipart/form-data">
    <?php else :?>
    <form action="<?php echo base_url();?>admin/news_controller/ubah/<?php echo empty($news)?'':$news[0]->id_news;?>" method="post" enctype="multipart/form-data">

    <?php endif;?>
    <div class="inputboxes">
      <label>Judul</label><input type="text" name="judul" class="inputbox" value="<?php echo empty($news)?'':$news[0]->judul ;?>">
     </div>
     <div class="inputboxes">
      <label>Tanggal</label><input type="text" name="tanggal" class="inputbox" value="<?php echo empty($news)?date('Y-m-d'):$news[0]->tanggal_dibuat;?>">
     </div>
     <div class="inputboxes">
      <label>Gambar</label><input type="file" name="userfile">
      <img src="<?php echo base_url();?>images/news/<?php echo empty($news)?'':$news[0]->gambar_news;?>">
      <input type="hidden" name="gambar" value="<?php echo empty($news)?'':$news[0]->gambar_news;?>">
     </div>
     <textarea class="text-input textarea" id="wysiwyg" name="news" rows="10" cols="75"><?php echo empty($news)?'':$news[0]->news;?></textarea>
     <input type="submit" name="simpan" value="simpan">
</form>