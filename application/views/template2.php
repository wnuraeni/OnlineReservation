<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from chimpstudio.co.uk/themeforest/ngo/ngo3/blue/ by HTTrack Website Copier/3.x [XR&CO'2010], Fri, 24 Feb 2012 01:39:34 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Penyewaan</title>
<!-- // Stylesheets // -->
<link href="<?php echo base_url();?>css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>styles/jquery-ui-1.8.21.custom.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url();?>css/ddsmoothmenu.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>css/slider.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>css/contentslider.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>css/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>css/acordin.css" rel="stylesheet" type="text/css" />
<!-- // Javascript // -->
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min14.js"></script>
<script type='text/javascript' src='<?php echo base_url();?>js/jquery-ui.min.js'></script>
<script type="text/javascript" src="<?php echo base_url();?>js/ddsmoothmenu.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/menu.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.easing.1.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.anythingslider.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/anyslider.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/contentslider.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jcarousellite_1.0.1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/scroller.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancybox-1.3.1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/datetimepicker.js"></script>

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

</script>

</head>

<body onload="displaytime(); setInterval('displaytime()',1000);">

<!-- Wrapper -->
<div id="wrapper_sec">
	<!-- Header Section -->
	<div id="masthead">
    	<div class="logo">
        	
        </div>
        <!--<div class="search">
        //	<input type="text" value="Search" id="searchBox" name="s" onblur="if(this.value == '') { this.value = 'Search'; }" onfocus="if(this.value == 'Search') { this.value = ''; }" />
          //  <a href="#" class="go">&nbsp;</a>
       </div>--!>
        <div class="clear"></div>
        <!-- Navigation Section -->
        <div class="navigation">
            <div id="smoothmenu1" class="ddsmoothmenu">
            	<ul>
                	<li><a href="<?php echo base_url();?>index">Home</a></li>
                    <li><a href="#">About Us</a>
                    	<ul>
                          <li><a href="<?php echo base_url();?>index/mision">Our Mission</a></li>
                          <li><a href="<?php echo base_url();?>index/our_fasilitas">Our Facilities</a></li>
                          <li><a href="<?php echo base_url();?>index/membership">Membership</a></li>
                      	</ul>
                    </li>
                    <li><a href="<?php echo base_url();?>reservasi_controller/index">Booking</a></li>
                    <li><a href="<?php echo base_url();?>index/news">News</a></li>
                    <li><a href="<?php echo base_url();?>index/payment">Konfirmasi Pembayaran</a></li>   
                    <li><a href="<?php echo base_url();?>index/contact_us">Contact Us</a></li>
                    <?php if($this->session->userdata('islogin')==true):?>
                    <li style="margin-right:100px"><a href="#"><?php echo 'Welcome,  '.$this->session->userdata('username');?></a>
                     <ul>
                            <li><a href="<?php echo base_url();?>index/histori_reservasi/<?php echo $this->session->userdata('id_member')?>">
                                    Histori Reservasi</a></li>
                     </ul>
                    </li>
                    <li ><a href="<?php echo base_url();?>index/logout">Logout</a></li>
                    <?php else :?>
                     <li style="margin-right:100px"><a href="<?php echo base_url();?>index/login">Login</a></li>
                     <?php endif ;?>
                    </ul>
                    <br style="clear: left" />
                    </div>
        </div>
    </div>
    <div class="clear"></div>
    <!-- Banner Section -->
   
    <!-- Content Section -->
    
    <div id="content_sec" class="noback">
    	<!-- Column1 Section -->
        <?php empty($isi_all)?'':$this->load->view($isi_all) ;?>
    </div>
    <!-- Footer Section -->
    <div id="footer">
    	<div class="topbutton">
    		<a href="#" class="top">&nbsp;</a>
          	<center><p>� 2010 all rights reserved.</p></center>
    	</div>
       
    </div>
    
     
        
        </div>

    
    
    

</body>

<!-- Mirrored from chimpstudio.co.uk/themeforest/ngo/ngo3/blue/ by HTTrack Website Copier/3.x [XR&CO'2010], Fri, 24 Feb 2012 01:40:30 GMT -->
</html>
