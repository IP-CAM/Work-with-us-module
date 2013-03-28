<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
     <div class="box">
    <div class="heading">
      <h1><img src="view/image/setting.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <table class="form">
            
            <tr>
              <td><?php echo $entry_file_extension_allowed_curriculum; ?></td>
              <td><textarea name="config_file_extension_allowed_curriculum" cols="40" rows="5"><?php echo $config_file_extension_allowed_curriculum; ?></textarea></td>
            </tr>
            <tr>
              <td><?php echo $entry_file_mime_allowed_curriculum; ?></td>
              <td><textarea name="config_file_mime_allowed_curriculum" cols="60" rows="5"><?php echo $config_file_mime_allowed_curriculum; ?></textarea></td>
            </tr>  
             <td><?php echo $entry_maintenance_curriculum; ?></td>
              <td><?php if ($config_maintenance_curriculum) { ?>
                <input type="radio" name="config_maintenance_curriculum" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="config_maintenance_curriculum" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="config_maintenance_curriculum" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="config_maintenance_curriculum" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?></td>
            </tr>           
           <tr>
              <td><?php echo $entry_captcha_curriculum; ?></td>
             <td>
               <?php if ($config_captcha_curriculum) { ?>
                <input type="radio" name="config_captcha_curriculum" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="config_captcha_curriculum" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="config_captcha_curriculum" value="1" />
                <?php echo $text_yes; ?>
                 <input type="radio" name="config_captcha_curriculum" value="0" checked="checked" />
                <?php echo $text_no; ?></td>
                <?php } ?></tr> 
               <tr>
</div>

<?php echo $footer; ?>
