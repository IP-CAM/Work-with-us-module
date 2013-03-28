<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>    	

  
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/contact.png" alt="" /><?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('form').submit();" class="button"><?php echo $button_delete; ?></a><a href="<?php echo $setting; ?>" class="button"><?php echo $button_setting; ?></a></div>
    </div>
  
  <div class="content">
    <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
      <table class="list">
        <thead>
          <tr>
            <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
           
            <td class="left"><?php if ($sort == 'name') { ?>
              <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
              <?php } else { ?>
              <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
              <?php } ?>
              </td>
              <td class="center"><?php echo $column_date_added; ?></td>
              <td class="left"><?php echo $column_mask; ?></td>
	     <td class="left"><?php echo $column_action; ?> </td>
          </tr>
        </thead>
        <tbody>
          <?php if ($curriculums) { ?>
          <?php foreach ($curriculums as $curriculum) { ?>
          <tr>
            <td style="text-align: center;"><?php if ($curriculum['selected']) { ?>
              <input type="checkbox" name="selected[]" value="<?php echo $curriculum['curriculum_id']; ?>" checked="checked" />
              <?php } else { ?>
              <input type="checkbox" name="selected[]" value="<?php echo $curriculum['curriculum_id']; ?>" />
              <?php } ?></td>
               <td class="left"><?php echo $curriculum['name']; ?></td>
              <td class="center"><?php echo $curriculum['date_added']; ?></td>
	      <td class="left"><a href="<?php echo $curriculum['href']; ?>" target="_blank"><?php echo $curriculum['mask']; ?></a></td>
		<td class="right"><?php foreach ($curriculum['action'] as $action) { ?>
                [ <a href="<?php echo $action['href']; ?>" id="view"><?php echo $action['text']; ?></a> ]
                <?php } ?></td>
                      
          </tr>
          <?php } ?>
          <?php } else { ?>
          <tr>
            <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </form>
    <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
  </div>
  <div id="pop-up" style="display:none;"></div>

<style type="text/css">
ui-widget-overlay {
   background: #AAA url(images/ui-bg_flat_0_aaaaaa_40x100.png) 50% 50% repeat-x;
   opacity: .30;
   filter: Alpha(Opacity=30);
}
</style>
<script type="text/javascript">
$('#view').click(function() {
		var element = $(this);
		var href = element.attr("href");
		var ID = element.attr("id");
		var $dialog = $('<div id="dialog' +ID +'"'+'></div>');
		$dialog
		.load(href)
		.dialog({
		        title: '<?php echo $heading_title; ?>',
			autoOpen: false,
			bgiframe: false,
   		        width: 800,
		        height: 500,
		        resizable: false,
                        modal: true,
                        show: 'fade',
                        hide: 'fade'

	});	
 $dialog.dialog('open');
	return false;
});
</script>
<?php echo $footer; ?>
