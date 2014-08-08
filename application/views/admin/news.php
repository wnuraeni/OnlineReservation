<style>

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


<div class="clearfix"></div>

<a href="<?php echo base_url();?>admin/news_controller/tambah" class="btn">Tambah</a>
<div class="pagelink"><?php echo $this->pagination->create_links();?></div>
<table>
  <th>Gambar</th><th>Judul</th><th>Berita</th><th>Kelola</th>
    <?php foreach($news as $n):?>
   <tr><td><img src="<?php echo base_url();?>images/news/<?php echo $n->gambar_news;?>" width="70" height="50"></td>
       <td><p><?php echo $n->judul;?></p><p><?php echo $n->tanggal_dibuat;?></p></td>
       <td><?php echo substr($n->news,0,400);?></td>
       <td><a href="<?php echo base_url();?>admin/news_controller/ubah/<?php echo $n->id_news;?>">Edit</a></td>
       <td><a href="<?php echo base_url();?>admin/news_controller/hapus/<?php echo $n->id_news;?>">Delete</a></td>

   </tr>
    <?php endforeach ;?>


</table>