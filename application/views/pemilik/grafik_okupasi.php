<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from 209.217.226.156/~tforrest/admin_cp_2/index.html by HTTrack Website Copier/3.x [XR&CO'2010], Sun, 22 Apr 2012 09:29:46 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pemilik</title>
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
<script type='text/javascript' src="<?php echo base_url();?>js/highcharts.js"></script>
<script>
    
// Toolbox Pulldown

$(document).ready(function() {
    $(".toolboxdrop").click( function() {
        if ($("#openCloseIdentifier").is(":hidden")) {
            $("#slider").animate({
                marginTop: "-30px"
                }, 500 );
            $("#topMenuImage").html;
            $("#openCloseIdentifier").show();
        } else {
            $("#slider").animate({
                marginTop: "0px"
                }, 500 );
            $("#topMenuImage").html;
            $("#openCloseIdentifier").hide();
        }
    }); 
});
</script>

</head>
<body>


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
                  
                    <li><a href="<?php echo base_url()?>pemilik/index/logout" title="">Log Out</a></li>
                    
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
            	<p>Welcome, <?php echo $this->session->userdata('pemilikname');?></p>
                <p><span>You are logged in as <?php echo $this->session->userdata('accesspemilik');?></span></p>
               
            </div>
<!-- Userbox/logged in end -->

<!-- Main navigation start -->
            <ul id="nav">
                 <li>
                    <a class="heading">Menu</a>
                    <ul class="navigation">
<!--                        <li <?php echo ($this->uri->segment(3)== 'pembelian')?'class="heading selected"':'';?>><a href="<?php echo base_url();?>pemilik/laporan_controller/pembelian">Laporan Pembelian</a></li>-->
                        <li <?php echo ($this->uri->segment(3)== 'keuangan')?'class="heading selected"':'';?>><a href="<?php echo base_url();?>pemilik/laporan_controller/keuangan">Laporan Keuangan</a></li>
                        <li <?php echo ($this->uri->segment(3)== 'penyewaan')?'class="heading selected"':'';?>><a href="<?php echo base_url();?>pemilik/laporan_controller/penyewaan">Laporan Penyewaan</a></li>
                        <li <?php echo ($this->uri->segment(3)== 'pendapatan')?'class="heading selected"':'';?>><a href="<?php echo base_url();?>pemilik/laporan_controller/pendapatan">Laporan Pendapatan Lapangan</a></li>
                        <li <?php echo ($this->uri->segment(3)== 'grafik_pemakaian_lapangan')?'class="heading selected"':'';?>><a href="<?php echo base_url();?>pemilik/index/grafik_pemakaian_lapangan">Grafik Pemakaian Lapangan</a></li>
                        <li <?php echo ($this->uri->segment(3)== 'grafik_okupasi_lapangan')?'class="heading selected"':'';?>><a href="<?php echo base_url();?>pemilik/index/grafik_okupasi_lapangan">Grafik Okupasi Lapangan</a></li>
                        <li <?php echo ($this->uri->segment(3)== 'grafik_pengunjung')?'class="heading selected"':'';?>><a href="<?php echo base_url();?>pemilik/index/grafik_pengunjung">Grafik Pengunjung</a></li>
                        <li <?php echo ($this->uri->segment(3)== 'grafik_pendapatan')?'class="heading selected"':'';?>><a href="<?php echo base_url();?>pemilik/index/grafik_pendapatan">Grafik Pendapatan</a></li>
<!--                        <li <?php echo ($this->uri->segment(3)== 'grafik_pembelian')?'class="heading selected"':'';?>><a href="<?php echo base_url();?>pemilik/index/grafik_pembelian">Grafik Pembelian</a></li>-->
<!--                        <li <?php echo ($this->uri->segment(3)== 'grafik_barang_rusak')?'class="heading selected"':'';?>><a href="<?php echo base_url();?>pemilik/index/grafik_barang_rusak">Grafik Barang Rusak</a></li>-->
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
            	
              
            </ul>
<!-- Top/large buttons end -->

 <!-- Main content start -->
            <div id="content">
<!-- Website stats start -->
                <div class="container" id="<?php echo empty($id)?'':$id;?>">
                    <div class="conthead">
                    <h2><?php echo empty($title)?'':($title); ?></h2>
                    </div>
                    <div class="contentbox">
                         <form action="<?php echo base_url().'pemilik/index/grafik_okupasi_lapangan';?>" method="POST">
    <?php
    $months = array(
        '1'=>'Januari',
        '2'=>'Februrari',
        '3'=>'Maret',
        '4'=>'April',
        '5'=>'Mei',
        '6'=>'Juni',
        '7'=>'Juli',
        '8'=>'Agustus',
        '9'=>'September',
        '10'=>'Oktober',
        '11'=>'November',
        '12'=>'Desember',
        );
    ?>
    <select name="bulan" id="bulan">
        <option value="">Pilih Bulan</option>
        <?php
        foreach($months as $key=>$val){
        echo '<option value="'.$key.'" '.(isset($_POST['bulan'])?($_POST['bulan']==$key?'selected':''):'').'>'.$val.'</option>';
        }
        ?>
    </select>
    <select name="tahun">
        <option value="">Pilih Tahun</option>
        <?php
        for($i=2010;$i<=date('Y');$i++){

        echo '<option value="'.$i.'" '.(isset($_POST['tahun'])?($_POST['tahun']==$i?'selected':''):'').'>'.$i.'</option>';
        }
        ?>
    </select>
    <input type="submit" value="Cari" name="cari">
</form>
<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafik Okupasi Lapangan Per Bulan <?php echo (isset($_POST['bulan'])?$months[$_POST['bulan']].' '.$_POST
                ['tahun']:$months[date('m')].' '.date('Y'))?>'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [
                    '<?php echo (isset($_POST['bulan'])?$months[$_POST['bulan']]:$months[date('m')])?>',

                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Persentase Okupasi (%)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [<?php echo $data_lapangan?>]
        });
    });


		</script>

<div style="clear: both;"></div>
<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
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
