
        <div class="col1">
        	<!-- Blog Section -->
        	<div class="blog">

            	<h4 class="heading colr">News</h4>
                <ul>
                	<li>
                    	<h2><?php echo $news[0]->judul;?></h2>
                        <div class="clear"></div>
                        <div class="desc">
                            <p class="txt">
                            	<a href="#" class="thumb left"><img src="<?php echo base_url();?>images/news/<?php echo $news[0]->gambar_news;?>" width="70" height="60" alt="" /></a>
                              <?php echo $news[0]->news;?>
                            	
                            </p>
                        </div>
                       
                    </li>

                </ul>
             <input type="button" onclick="window.location.href='<?php echo base_url();?>index/news'" value="back">
            </div>
        </div>
