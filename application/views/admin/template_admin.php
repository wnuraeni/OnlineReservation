<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from 209.217.226.156/~tforrest/admin_cp_2/index.html by HTTrack Website Copier/3.x [XR&CO'2010], Sun, 22 Apr 2012 09:29:46 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin</title>
<!-- Calendar Styles -->
<link href="<?php echo base_url();?>styles/jquery-ui-1.8.21.custom.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>styles/fullcalendar.css" rel="stylesheet" type="text/css" />
<!-- Fancybox/Lightbox Effect -->
<link href="<?php echo base_url();?>styles/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />
<!-- WYSIWYG Editor -->
<link href="<?php echo base_url();?>styles/wysiwyg.css" rel="stylesheet" type="text/css" />
<!-- Main Controlling Styles -->
<link href="<?php echo base_url();?>styles/main.css" rel="stylesheet" type="text/css" />
<!-- Blue Theme Styles -->
<link href="<?php echo base_url();?>styles/styles.css" rel="stylesheet" type="text/css" />
<script type='text/javascript' src="<?php echo base_url();?>js/jquery-1.7.1.min.js"></script>
<script type='text/javascript' src='<?php echo base_url();?>js/jquery-ui.min.js'></script>
<script type="text/javascript" src="<?php echo base_url();?>js/enhance.js"></script>
<script type='text/javascript' src="<?php echo base_url();?>js/excanvas.js"></script>
<!--<script type='text/javascript' src="<?php echo base_url();?>js/jquery.min.js"></script>-->

<script type='text/javascript' src='<?php echo base_url();?>js/jquery.fancybox-1.3.4.pack.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>js/fullcalendar.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>js/jquery.wysiwyg.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>js/visualize.jQuery.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>js/functions.js'></script>
</head>
<body>

<!-- Top header/black bar start -->
	<div id="header">
    	<img src="images/logo.png" alt="AdminCP" class="logo" />
        
    </div>
 <!-- Top header/black bar end -->   
    
<!-- Left side bar start -->
        <div id="left">
<!-- Left side bar start -->

<!-- Toolbox dropdown start -->
        	<div id="openCloseIdentifier"></div>
            <div id="slider">
                <ul id="sliderContent">
                  
                    <li><a href="<?php echo base_url()?>admin/index/logout" title="">Log Out</a></li>
                   
                   
                </ul>
                <div id="openCloseWrap">
                    <div id="toolbox">
            			<a href="#" title="Toolbox Dropdown" class="toolboxdrop">Toolbox <img src="<?php echo base_url();?>images/icon_expand_grey.png" alt="Expand" /></a>
            		</div>
                </div>
            </div>
<!-- Toolbox dropdown end -->   
    	
<!-- Userbox/logged in start -->
            <div id="userbox">
            	<p>Welcome, <?php echo $this->session->userdata('adminname');?></p>
                <p><span>You are logged in as <?php echo $this->session->userdata('accessadmin');?></span></p>
                
            </div>
<!-- Userbox/logged in end -->  

<!-- Main navigation start -->         
            <ul id="nav"> 
                <li>
                    <a class="heading">Menu</a>
                    <ul class="navigation">
                        <li <?php echo ($this->uri->segment(2)== 'lapangan')?'class="heading selected"':'';?>><a href="<?php echo base_url();?>admin/lapangan/index">Lapangan</a></li>
                        <li <?php echo ($this->uri->segment(2)== 'member_controller')?'class="heading selected"':'';?>><a href="<?php echo base_url();?>admin/member_controller">Kelola Member</a></li>
                        <li <?php echo ($this->uri->segment(2)== 'karyawean_controller')?'class="heading selected"':'';?>><a href="<?php echo base_url();?>admin/karyawan_controller">Kelola Karyawan</a></li>
                    </ul>
                </li>   
            </ul>
        </div>      
<!-- Main navigation end --> 

<!-- Left side bar start end -->   

<!-- Right side start -->     
        <div id="right">

<!-- Breadcrumb start -->  
          
<!-- Breadcrumb end -->  

<!-- Top/large buttons start -->  
            <ul id="topbtns">
            	
                <li>
                	<a href="<?php echo base_url();?>admin/content_controller/index"><img src="<?php echo base_url();?>images/icons/icon_lrg_media.png" alt="Media" /><br />Web Content</a>
                </li>
              
            </ul>
<!-- Top/large buttons end -->  

 <!-- Main content start -->      
            <div id="content">                
<!-- Website stats start -->               
                <div class="container">
                    <div class="conthead">
                    <h2><?php echo empty($title)?'':$title;?></h2>
                    </div>
                    <div class="contentbox">
                         <?php empty($content)?'':$this->load->view($content); ?>
                    </div>
                </div>
<!-- Website stats end -->  
               
                <!-- Clear finsih for all floated content boxes --> <div style="clear: both"></div>
                

<!-- Form elements end -->  
   
        	</div>
            
<!-- Footer start --> 
            <p id="footer">&copy; yourwebsitecompany.com</p>
<!-- Footer end -->      
     
        </div>
<!-- Right side end --> 

		
</body>

<!-- Mirrored from 209.217.226.156/~tforrest/admin_cp_2/index.html by HTTrack Website Copier/3.x [XR&CO'2010], Sun, 22 Apr 2012 09:30:55 GMT -->
</html>
