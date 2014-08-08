<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from 209.217.226.156/~tforrest/admin_cp_2/index.html by HTTrack Website Copier/3.x [XR&CO'2010], Sun, 22 Apr 2012 09:29:46 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Template</title>
<!-- Calendar Styles -->
<link href="<?php echo base_url();?> styles/fullcalendar.css" rel="stylesheet" type="text/css" />
<!-- Fancybox/Lightbox Effect -->
<link href="<?php echo base_url();?>styles/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />
<!-- WYSIWYG Editor -->
<link href="<?php echo base_url();?>styles/wysiwyg.css" rel="stylesheet" type="text/css" />
<!-- Main Controlling Styles -->
<link href="<?php echo base_url();?>styles/main.css" rel="stylesheet" type="text/css" />
<!-- Blue Theme Styles -->
<link href="<?php echo base_url();?>themes/blue/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>

<!-- Top header/black bar start -->
	<div id="header">
    	<img src="<?php echo base_url();?>images/logo.png" alt="AdminCP" class="logo" />
        <div id="searchbox"> <form action="<?php echo base_url() ;?> admin/index/proses_login " method="POST">
         <input type="text" name='username' placeholder='username'/>
            <input type="password" name='password' placeholder='password'/>
            <input type='submit' name='login' value='login'/>
        </form>
        	
    	</div>
    </div>
 <!-- Top header/black bar end -->   
    
<!-- Left side bar start -->
        <div id="left">
<!-- Left side bar start -->

<!-- Toolbox dropdown start -->
        	
<!-- Toolbox dropdown end -->   
    	
<!-- Userbox/logged in start -->
            <div id="userbox">
            	
                <ul>
                    <li><a href="#" title="Logout"><img src="<?php echo base_url();?>images/icons/icon_unlock.png" alt="Logout" /></a></li>
                </ul>
            </div>
<!-- Userbox/logged in end -->  

<!-- Main navigation start -->         
            <ul id="nav">
                <li> <a>Menu</a>
                    <ul class="navigation">
                        <li <?php  echo($this->uri->segment(3)=='penyewaan')?'class="selected"':'';?> ><a href="<?php echo base_url()?>index.php/kasir/index_kasir/penyewaan" title="penyewaan">Penyewaan</a></li>
                        <li <?php  echo($this->uri->segment(3)=='laporan')?'class="selected"':'';?>><a href="<?php echo base_url()?>index.php/kasir/index_kasir/laporan" title="">Laporan Penyewaan</a></li>
                                             
                    </ul>
                </li>
                               
            </ul>
        </div>      
<!-- Main navigation end --> 

<!-- Left side bar start end -->   

<!-- Right side start -->     
        <div id="right">

<!-- Breadcrumb start -->  
            <div id="breadcrumb">
                <ul>	
        			<li><img src="<?php echo base_url();?>images/icon_breadcrumb.png" alt="Location" /></li>
                    <li><a href="#" title="">Sub Section</a></li>
                    <li>/</li>
                    <li class="current">Control Panel</li>
                </ul>
            </div>
<!-- Breadcrumb end -->  

<!-- Top/large buttons start -->  
            <ul id="topbtns">
            	<li class="desc"><strong>Quick Links</strong><br />Popular shortcuts</li>
                <li>
                	<a href="#"><img src="<?php echo base_url();?>images/icons/icon_lrg_calendar.png" alt="Calendar" /><br />Calendar</a>
                </li>
                <li>
                	<a href="#"><img src="<?php echo base_url();?>images/icons/icon_lrg_create.png" alt="Create" /><br />Create</a>
                </li>
                <li>
                	<a href="#"><img src="<?php echo base_url();?>images/icons/icon_lrg_user.png" alt="Users" /><br />Users</a>
                </li>
                <li>
                	<a href="#"><img src="<?php echo base_url();?>images/icons/icon_lrg_media.png" alt="Media" /><br />Media</a>
                </li>
                <li>
                	<a href="#"><img src="<?php echo base_url();?>images/icons/icon_lrg_comment.png" alt="Comment" /><br />Comment</a>
                </li>
                <li>
                	<a href="#"><img src="<?php echo base_url();?>images/icons/icon_lrg_support.png" alt="Support" /><br />Support</a>
                </li>
            </ul>
<!-- Top/large buttons end -->  

 <!-- Main content start -->      
  <div id="content">
               
<!-- Website stats start -->
   <div class="container">
           <div class="conthead">
                <h2>Website Stats</h2>
           </div>
                 <div class="contentbox">
                <!--- <ul class="summarystats">--->
               <?php
                     if(empty($content)){
                         echo"";
                     }else {
                       $this->load->view($content);

                     }
               ?>
                   </div>
         </div>
    </div>
<!-- 

<!--   
     
        </div>
<!-- Right side end --> 

		<script type="text/javascript" src="<?php echo base_url();?>js/enhance.js"></script>
   		<script type='text/javascript' src='<?php echo base_url();?>js/excanvas.js'></script>
        <script type='text/javascript' src='<?php echo base_url();?>js/jquery.min.js'></script>
        <script type='text/javascript' src='<?php echo base_url();?>js/jquery-ui.min.js'></script>
        <script type='text/javascript' src='<?php echo base_url();?>js/jquery.fancybox-1.3.4.pack.js'></script>
        <script type='text/javascript' src='<?php echo base_url();?>js/fullcalendar.min.js'></script>
        <script type='text/javascript' src='<?php echo base_url();?>js/jquery.wysiwyg.js'></script>
        <script type='text/javascript' src='<?php echo base_url();?>js/visualize.jQuery.js'></script>
        <script type='text/javascript' src='<?php echo base_url();?>js/functions.js'></script>
</body>

<!-- Mirrored from 209.217.226.156/~tforrest/admin_cp_2/index.html by HTTrack Website Copier/3.x [XR&CO'2010], Sun, 22 Apr 2012 09:30:55 GMT -->
</html>
