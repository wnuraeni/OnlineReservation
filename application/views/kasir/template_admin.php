<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from 209.217.226.156/~tforrest/admin_cp_2/index.html by HTTrack Website Copier/3.x [XR&CO'2010], Sun, 22 Apr 2012 09:29:46 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kasir</title>
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
<script type='text/javascript' src='<?php echo base_url();?>js/datetimepicker.js'></script>

<script type="text/javascript">

    function displaytime(){
    var time =new Date();
    var tanggal=time.getDate();
    var bulan=time.getMonth();
    var tahun=time.getFullYear();
    var hour=time.getHours();
    var minute=time.getMinutes();
    var second= time.getSeconds();
    var ampm;

    if(minute < 10){
        minute='0'+minute;
    }
    if(hour > 11 ){
        ampm='PM';
    }else {
        ampm='AM';
    }

        $('.timer').html(tanggal+'-'+bulan+'-'+tahun+' '+hour+':'+minute+':'+second+' '+ampm);
    }
function cekBooking(){
	$.ajax({
	 url: "http://localhost/ta/index.php/kasir/reservasi_controller/cek_reservasi"
	});
}

</script>

</head>

 <!--<body onload="displaytime(); setInterval('displaytime()',1000);setInterval('cekBooking()',10000)">-->
<body onload="displaytime(); setInterval('displaytime()',1000)">

<!-- Top header/black bar start -->
	<div id="header">
    	
       
    </div>
 <!-- Top header/black bar end -->   
    
<!-- Left side bar start -->
        <div id="left">
<!-- Left side bar start -->

<!-- Toolbox dropdown start -->
        	<div id="openCloseIdentifier"></div>
            <div id="slider">
                <ul id="sliderContent">
                   
                    <li><a href="<?php echo base_url()?>index.php/kasir/index/logout" title="">Log Out</a></li>
                   
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
            	<p>Welcome, <?php echo $this->session->userdata('kasirname');?></p>
                <p><span>You are logged in as <?php echo $this->session->userdata('accesskasir');?></span></p>
                
            </div>
<!-- Userbox/logged in end -->  

<!-- Main navigation start -->         
            <ul id="nav"> 
                <li>
                    <a class="heading">Menu</a>
                    <ul class="navigation">
                      <?php echo (empty($side_menu) ?'':$side_menu);?>
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
            	
                <!--<li>
                	<a href="<?php echo base_url();?>index.php/kasir/jadwal_controller/index"><img src="<?php echo base_url();?>images/icons/icon_lrg_calendar.png" alt="Calendar" /><br />Jadwal</a>
                </li>
                <li>
                	<a href="<?php echo base_url();?>index.php/kasir/sewa_controller/daftar_sewa_sekarang"><img src="<?php echo base_url();?>images/icons/icon_lrg_user.png" alt="Users" /><br />Pelanggan</a>
                </li>-->
                <li>
                	<a href="<?php echo base_url();?>index.php/kasir/lapangan_controller/index"><img src="<?php echo base_url();?>images/icons/icon_lrg_create.png" alt="Media" /><br />Lapangan</a>
                </li>
                <li>
                	<a href="<?php echo base_url();?>index.php/kasir/reservasi_controller/index"><img src="<?php echo base_url();?>images/icons/icon_lrg_comment.png" alt="Comment" /><br />Reservasi</a>
                </li>
            </ul>
<!-- Top/large buttons end -->  

 <!-- Main content start -->      
            <div id="content">                
<!-- Website stats start -->               
                <div class="container">
                    <div class="conthead">
                    <h2><?php echo empty($title)?'':($title); ?></h2>
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
