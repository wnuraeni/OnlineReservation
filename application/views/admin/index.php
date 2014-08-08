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
        	<div id="openCloseIdentifier"></div>
            <div id="slider">
                <ul id="sliderContent">
                    <li><a href="#" title="">Change Username</a></li>
                    <li class="alt"><a href="#" title="">Change Password</a></li>
                    <li><a href="#" title="">Change Address</a></li>
                    <li class="alt"><a href="#" title="">Payment Details</a></li>
                    <li><a href="#" title="">Log Out</a></li>
                </ul>
                <div id="openCloseWrap">
                    <div id="toolbox">
            			<a href="#" title="Toolbox Dropdown" class="toolboxdrop">Toolbox <img src="images/icon_expand_grey.png" alt="Expand" /></a>
            		</div>
                </div>
            </div>
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
            	<li>
                    <a class="collapsed heading">Section Heading</a>
                     <ul class="navigation">
                        <li><a href="#" title="">Section link here</a></li>
                        <li><a href="#" title="">Section link here</a></li>
                        <li><a href="#" title="">Section link here</a></li>
                    </ul>
                </li>   
                <li>
                    <ul class="navigation">
                        <li class="heading selected">Current Section</li>
                        <li><a href="#" title="">Section link here</a></li>
                        <li><a href="#" title="">Section link here</a></li>
                        <li><a href="#" title="">Section link here</a></li>
                    </ul>
                </li>
                <li>
                    <a class="collapsed heading">Section Heading</a>
                     <ul class="navigation">
                        <li><a href="#" title="">Section link here</a></li>
                        <li><a href="#" title="">Section link here</a></li>
                        <li><a href="#" title="">Section link here</a></li>
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
                <div class="container sml right">
                	<div class="conthead">
                		<h2>Website Stats</h2>
                    </div>
                	<div class="contentbox">
                    	<ul class="summarystats">
                        	<li>
                            	<p class="statcount">30</p> <p>Registrations</p>  <p class="statview"><a href="#" title="view">view</a></p>
                            </li>
                            <li>
                            	<p class="statcount">17</p> <p>New Sales</p>  <p class="statview"><a href="#" title="view">view</a></p>
                            </li>
                            <li>
                            	<p class="statcount">05</p> <p>Pending sales</p>  <p class="statview"><a href="#" title="view">view</a></p>
                            </li>
                            <li>
                            	<p class="statcount">10</p> <p>Support requests</p>  <p class="statview"><a href="#" title="view">view</a></p>
                            </li>
                        </ul>
                        
                        <p><strong>Usage bar examples</strong></p>
                        
                        <table>
                            <tr>
                                <td width="150"><strong><span class="usagetxt redtxt">Red</span></strong></td>
                                <td width="500">
                                    <div class="usagebox">
                                        <div class="highbar" style="width: 85%;"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><span class="usagetxt orangetxt">Orange</span></strong></td>
                                <td>
                                    <div class="usagebox">
                                        <div class="midbar" style="width: 50%;"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><span class="usagetxt greentxt">Green</span></strong></td>
                                <td>
                                    <div class="usagebox">
                                        <div class="lowbar" style="width: 25%;"></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
<!-- Website stats end -->  
               
                <!-- Clear finsih for all floated content boxes --> <div style="clear: both"></div>
                
<!-- Form elements start -->                 
        		<div class="container half left">
                	<div class="conthead">
                    	<h2>Form Styles</h2>
                    </div>
                	<div class="contentbox">
                    	<div class="inputboxes">
                        	<label for="regular">Regular: </label>
                            <input type="text" id="regular" class="inputbox"/>
                        </div>
                        <div class="inputboxes">
                        	<label for="small">Small: </label>
                            <input type="text" id="small" class="inputbox smaller"/>
                        </div>
                        <div class="inputboxes">
                        	<label for="correct" class="correcttxt">Correct: </label>
                            <input type="text" id="correct" class="inputbox correctbox"/>
                            <img src="<?php echo base_url();?>images/icons/icon_tick_sq.png" class="att" alt="Correct" />
                        </div>
                        <div class="inputboxes">
                        	<label for="error" class="errortxt">Error:</label>
                            <input type="text" id="error" class="inputbox errorbox"/>
                            <img src="<?php echo base_url();?>images/icons/icon_close_sq.png" class="att" alt="Error" />
                        </div>
                        <div class="inputboxes">
                        	<label for="dropdown">Dropdown: </label>
                           	<select name="Dropdown" id="dropdown">
                            	<option>Dropdown Example</option>
                            </select>
                        </div>
                        <div class="inputboxes">
                        	<label>Upload: </label>
                            <input name="" type="file" /> <img src="<?php echo base_url();?>images/loading.gif" alt="Loading" />
                        </div>
                        
                        <div class="inputboxes">
                        	<label for="chkbox1">Checkbox: </label>
                           	<input name="" type="checkbox" value="" id="chkbox1" />
                        </div>
                        
                        <div class="inputboxes">
                        	<label for="radio1">Radio one: </label>
                           	<input name="groupr" type="radio" value="" id="radio1" />
                        </div>
                        <div class="inputboxes">
                        	<label for="radio2">Radio two: </label>
                           	<input name="groupr" type="radio" value="" id="radio2" />
                        </div>
                        
                        <p style="padding-top: 25px"><strong><em>WYSIWYG</em> Editor</strong></p>
                        
                        <textarea class="text-input textarea" id="wysiwyg" name="textfield" rows="10" cols="75"></textarea>
                        
                <p><br /><br />Buttons styles</p>
                <input type="submit" value="Submit" class="btn" /> <input type="submit" value="Submit (Alternative)" class="btnalt" />
                    </div>
                </div>
                
<!-- Form elements end -->  
 
<!-- Gallery start -->   
                <div class="container half right">
                	<div class="conthead">
                		<h2>Gallery</h2>
                    </div>
                	<div class="contentbox">
                    	<ul class="gallerybox">
                        	<li>
                            	<a href="<?php echo base_url();?>images/examples/example1_lrg.jpg" class="galleryimg"><img src="images/examples/example1_sml.jpg" alt="Gallery Example" /></a>
                                <p>Title of Image</p>
                            </li>
                            <li>
                            	<a href="<?php echo base_url();?>images/examples/example2_lrg.jpg" class="galleryimg"><img src="images/examples/example2_sml.jpg" alt="Gallery Example" /></a>
                                <p>Title of Image</p>
                            </li>
                            <li>
                            	<a href="<?php echo base_url();?>images/examples/example3_lrg.jpg" class="galleryimg"><img src="images/examples/example3_sml.jpg" alt="Gallery Example" /></a>
                                <p>Title of Image</p>
                            </li>
                            <li>
                            	<a href="<?php echo base_url();?>images/examples/example4_lrg.jpg" class="galleryimg"><img src="images/examples/example4_sml.jpg" alt="Gallery Example" /></a>
                                <p>Title of Image</p>
                            </li>
                            <li>
                            	<a href="<?php echo base_url();?>images/examples/example5_lrg.jpg" class="galleryimg"><img src="images/examples/example5_sml.jpg" alt="Gallery Example" /></a>
                                <p>Title of Image</p>
                            </li>
                        </ul>
                    </div>
                </div>
 <!-- Gallery end -->
 
<!-- Generic style tabbing start -->                 
                <div class="container half right" id="tabs">
                	<div class="conthead">
                        <h2 class="left">Generic Styles</h2>
                        <ul class="tabhead">
                            <li><a href="#tabs-1">Lists</a></li>
                            <li><a href="#tabs-2">Headings</a></li>
                            <li><a href="#tabs-3">Misc</a></li>
                        </ul>
                    </div>
                	<div class="contentbox">
                        <div id="tabs-1">
                        	<h3>Various list styles</h3>
							<ul class="standard">
                            	<li>Lorem ipsum dolor sit amet, consectetuer</li>
                                <li>Duis autem vel eum iriure dolor in hendrerit</li>
                                <li><strong>Lorem ipsum dolor</strong> <a href="#">sit amet, consectetuer</a></li>
                                <li>Lorem ipsum dolor sit amet.</li>
                            </ul>
                            
                            <ul class="features">
                            	<li>Lorem ipsum dolor sit amet, consectetuer</li>
                                <li class="alt">Duis autem vel eum iriure dolor in hendrerit</li>
                                <li><strong>Lorem ipsum dolor</strong> <a href="#">sit amet, consectetuer</a></li>
                                <li>Lorem ipsum dolor sit amet.</li>
                            </ul>
                        </div>
                        <div id="tabs-2">
                        	<h3>Various heading styles</h3>
							<h1>Heading 1</h1>
                            <h2>Heading 2</h2>
                            <h3>Heading 3</h3>
                            <h4>Heading 4</h4>
                        </div>
                        <div id="tabs-3">
                        	<h3>Various text styles</h3>
							<p>Lorem ipsum dolor sit amet, consectetuer <span class="highlight">highlighted text</span> , sed diam nonummy nibh euismod</p>
                            
                            <p><span class="dropcap">D</span>rop cap example to make your text stand out more. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</p>
                    	</div>
                    </div>
                </div>
<!-- Generic style tabbing start -->  
                
                <!-- Clear finsih for all floated content boxes --><div style="clear: both"></div>
                

    
<!-- Table styles start -->           
                <div class="container">
                	<div class="conthead">
                		<h2>Table Example</h2>
                    </div>
                	<div class="contentbox">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th>Heading</th>
                                    <th>Another Heading</th>
                                    <th>Actions</th>
                                    <th><input name="" type="checkbox" value="" id="checkboxall" /></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Content Here</td>
                                    <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam.</td>
                                    <td>
                                        <a href="#" title=""><img src="<?php echo base_url();?>images/icons/icon_edit.png" alt="Edit" /></a>
                                        <a href="#" title=""><img src="<?php echo base_url();?>images/icons/icon_approve.png" alt="Approve" /></a>
                                        <a href="#" title=""><img src="<?php echo base_url();?>images/icons/icon_unapprove.png" alt="Unapprove" /></a>
                                        <a href="#" title=""><img src="<?php echo base_url();?>images/icons/icon_delete.png" alt="Delete" /></a>
                                    </td>
                                    <td><input type="checkbox" value="" name="checkall" /></td>
                                </tr>
                                <tr class="alt">
                                    <td>Content Here</td>
                                    <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam.</td>
                                    <td>
                                        <a href="#" title=""><img src="<?php echo base_url();?>images/icons/icon_edit.png" alt="Edit" /></a>
                                        <a href="#" title=""><img src="<?php echo base_url();?>images/icons/icon_approve.png" alt="Approve" /></a>
                                        <a href="#" title=""><img src="<?php echo base_url();?>images/icons/icon_unapprove.png" alt="Unapprove" /></a>
                                        <a href="#" title=""><img src="<?php echo base_url();?>images/icons/icon_delete.png" alt="Delete" /></a>
                                    </td>
                                    <td><input type="checkbox" value="" name="checkall" /></td>
                                </tr>
                                <tr>
                                    <td>Content Here</td>
                                    <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam.</td>
                                    <td>
                                        <a href="#" title=""><img src="<?php echo base_url();?>images/icons/icon_edit.png" alt="Edit" /></a>
                                        <a href="#" title=""><img src="<?php echo base_url();?>images/icons/icon_approve.png" alt="Approve" /></a>
                                        <a href="#" title=""><img src="<?php echo base_url();?>images/icons/icon_unapprove.png" alt="Unapprove" /></a>
                                        <a href="#" title=""><img src="<?php echo base_url();?>images/icons/icon_delete.png" alt="Delete" /></a>
                                    </td>
                                    <td><input type="checkbox" value="" name="checkall" /></td>
                                </tr>
                                 <tr class="alt">
                                    <td>Content Here</td>
                                    <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam.</td>
                                    <td>
                                        <a href="#" title=""><img src="<?php echo base_url();?>images/icons/icon_edit.png" alt="Edit" /></a>
                                        <a href="#" title=""><img src="<?php echo base_url();?>images/icons/icon_approve.png" alt="Approve" /></a>
                                        <a href="#" title=""><img src="<?php echo base_url();?>images/icons/icon_unapprove.png" alt="Unapprove" /></a>
                                        <a href="#" title=""><img src="<?php echo base_url();?>images/icons/icon_delete.png" alt="Delete" /></a>
                                    </td>
                                    <td><input type="checkbox" value="" name="checkall" /></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="extrabottom">
                        	<ul class="pagination">
                                <li class="text">Previous</li>
                                <li class="page"><a href="#" title="">1</a></li>
                                <li><a href="#" title="">2</a></li>
                                <li><a href="#" title="">3</a></li>
                                <li><a href="#" title="">4</a></li>
                                <li class="text"><a href="#" title="">Next</a></li>
                            </ul>
                            <div class="bulkactions">
                                <select>
                                    <option>Select bulk action...</option>
                                </select>
                                <input type="submit" value="Apply" class="btn" />
                            </div>
                        </div>
                    </div>
                </div>
<!-- Table styles end -->  
                
                <!-- Status Bar Start -->
                <div class="status warning">
                    <p class="closestatus"><a href="#" title="Close">x</a></p>
                    <p><img src="<?php echo base_url();?>images/icons/icon_warning.png" alt="Warning" /><span>Attention!</span> Lorem ipsum dolor sit amet, consectetuer, sed diam nonummy nibh.</p>
                </div>
                <!-- Status Bar End -->
                
                 <!-- Red Status Bar Start -->
                <div class="status success">
                    <p class="closestatus"><a href="#" title="Close">x</a></p>
                    <p><img src="<?php echo base_url();?>images/icons/icon_success.png" alt="Success" /><span>Success!</span> Lorem ipsum dolor sit amet, consectetuer adipiscing, sed diam nonummy nibh.</p>
                </div>
                <!-- Red Status Bar End -->
                
                <!-- Green Status Bar Start -->
                <div class="status error">
                    <p class="closestatus"><a href="#" title="Close">x</a></p>
                    <p><img src="<?php echo base_url();?>images/icons/icon_error.png" alt="Error" /><span>Error!</span> Lorem ipsum dolor sit amet, consectetuer adipiscing, sed diam nonummy nibh.</p>
                </div>
                <!-- Green Status Bar End -->
                
                <!-- Blue Status Bar Start -->
                <div class="status info">
                    <p class="closestatus"><a href="#" title="Close">x</a></p>
                    <p><img src="<?php echo base_url();?>images/icons/icon_info.png" alt="Information" /><span>Information:</span> Lorem ipsum dolor sit amet, consectetuer adipiscing, sed diam nonummy nibh.</p>
                </div>
                <!-- Blue Status Bar End -->   
        	</div>
            
<!-- Footer start --> 
            <p id="footer">&copy; yourwebsitecompany.com</p>
<!-- Footer end -->      
     
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
