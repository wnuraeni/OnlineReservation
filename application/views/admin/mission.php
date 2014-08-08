<form action="<?php echo base_url();?>admin/content_controller/mission" method="post">
    <div class="inputboxes">
      <input type="text" name="kategori" value="mission" class="inputbox" readonly>
    </div>
    <textarea class="text-input textarea" id="wysiwyg" name="textfield" rows="10" cols="75">
    <?php echo empty($value)?'':$value->content;?>
    </textarea><br><br>
    <input type="submit" class="btn" name="simpan" value="simpan">

</form>