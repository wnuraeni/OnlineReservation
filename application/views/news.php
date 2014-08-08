
    	    <!-- News Section -->
        	<div class="news">
            	<h4 class="heading colr">News</h4>
                <ul>
                <?php foreach($news as $n):?>
                	<li>
                    	<div class="thumb">
                        	<a href="<?php echo base_url();?>index/view_news/<?php echo $n->id_news;?>"><img src="<?php echo base_url();?>images/news/<?php echo $n->gambar_news;?>" width="70" height="60" alt="" /></a>
                        </div>
                        <div class="desc">
                        	<h6><a href="#" class="colr"><?php echo $n->judul ;?></a></h6>
                            <p class="date"><?php echo $n->tanggal_dibuat ;?></p>
                            <p class="txt">
                            	<?php echo $n->news ;?>
                            </p>
                            <a href="<?php echo base_url();?>index/view_news/<?php echo $n->id_news;?>" class="continue">CONTNUE READING</a>
                        </div>
                    </li>
                   <?php endforeach ;?>
                </ul>
            </div>
            <div class="paging">
            	<ul>
                	
                    <li class="prev"><a href="#">&nbsp;</a></li>
                     <?php echo $this->pagination->create_links();?>
                    <li class="next"><a href="#">&nbsp;</a></li>
                   
                </ul>
            </div>
        
 