        <div class="col3">
        	<!-- Gallery Section -->
        	<div class="gallerysec">
            	<h4 class="heading colr">Gallery</h4>
                <div class="categories">
                	<h5>Category</h5>
                    <ul>
                    	<li><a href="<?php echo base_url();?>index/our_fasilitas/basket">Lapangan Basket</a></li>
                        <li><a href="<?php echo base_url();?>index/our_fasilitas/tenis">Lapangan Tenis</a></li>
                        <li><a href="<?php echo base_url();?>index/our_fasilitas/badminton">Lapangan Badminton</a></li>
                        <li><a href="<?php echo base_url();?>index/our_fasilitas/futsal">Lapangan Futsal</a></li>
                        <li><a href="<?php echo base_url();?>index/our_fasilitas/voli">Lapangan Voli</a></li>
                       
                    </ul>
                </div>
                <div class="right_gallery">
                    
                    <div class="img_gallery">
                        <div id="slider2" class="sliderwrapper">
                         <?php foreach($gambar as $gbr):?>
                            <div class="contentdiv">
                                <img src="<?php echo base_url();?>images/gallery/<?php echo $gbr->nama_gambar;?>" alt="" />
                                <a rel="example_group" href="<?php echo base_url();?>images/gallery/<?php echo $gbr->nama_gambar;?>" title="" class="zoom">&nbsp;</a>
                            </div>
                            <?php endforeach ;?>
                           
                        </div>
                        <a href="javascript:void(null)" class="prevsmall"><img src="<?php echo base_url();?>images/gallery_prev.gif" alt="" /></a>
                        <div style="float:left; width:590px !important; overflow:hidden; margin-top:20px;">
                        <div class="anyClass" id="paginate-slider2">
                            <ul>
                              <?php foreach($gambar as $gbr):?>
                                <li><a href="#" class="toc"><img src="<?php echo base_url();?>images/gallery/<?php echo $gbr->nama_gambar;?>" alt="" /></a></li>
                               <?php endforeach;?>
                            </ul>
                        </div>
                        </div>
                        <a href="javascript:void(null)" class="nextsmall"><img src="<?php echo base_url();?>images/gallery_next.gif" alt="" /></a>
                       
                    </div>
                </div>
                
            </div>
        </div>




  <script>

      featuredcontentslider.init({
          id:"slider2",
          contentsource:["inline",""],
          toc:"markup",
          nextprev:["Previous","Next"],
          revealtype:"click",
          enablefade:[true,0.2],
          autorotate:[true,3000],
          onChange:function(previndex,curindex){}

      })






  </script>