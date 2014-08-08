<style>
.ui-tabs-nav li a{
    float:right;
    background:no-repeat scroll 0 0 #dbdbdb;
    border-radius: 8px 8px 8px 8px;
    color:#666;
    display:block;
    font-size: 12px;
    margin-right:10px;
    padding:5px 10px;
    text-decoration:none;
    text-shadow: 1px 1px 1px #fff;

}
.ui-tabs-nav li .active a{
    background:none repeat scroll 0 0 #848484;
    color:#fff;
    text-shadow:none;

}

</style>



<ul class="ui-tabs-nav">

    <li <?php echo ($this->uri->segment(3)== 'home'? ' class="active"':'');?>>
        <a href="<?php echo base_url().'admin/content_controller/home/';?>">
         Home
    </a></li>
    <li <?php echo ($this->uri->segment(3)== 'contact_us'? ' class="active"':'');?>>
        <a href="<?php echo base_url().'admin/content_controller/contact_us/';?>">
         Contact Us
    </a></li>
    <li <?php echo ($this->uri->segment(3)== 'mission'? ' class="active"':'');?>>
        <a href="<?php echo base_url().'admin/content_controller/mission/';?>">
        Mission
    </a></li>
    <li <?php echo ($this->uri->segment(3)== 'fasilitas'? ' class="active"':'');?>>
        <a href="<?php echo base_url().'admin/content_controller/fasilitas/';?>">
        Fasilitas
    </a></li>
    <li <?php echo ($this->uri->segment(3)== 'membership'? ' class="active"':'');?>>
        <a href="<?php echo base_url().'admin/content_controller/membership/';?>">
        MemberShip
    </a></li>
    <li <?php echo ($this->uri->segment(3)== 'news'? ' class="active"':'');?>>
        <a href="<?php echo base_url().'admin/news_controller/index/';?>">
         News
    </a></li>
</ul>

<?php empty($subcontent)?'':$this->load->view($subcontent);?>







