<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * View to show both the async and standard uploads
 * @todo make the asyncFields controlled by controller, specifiying start page etc.
 * @todo add pages already uploaded
 * @todo add progress bar
 */
$this->load->helper('url');
$this->load->helper('language');
$this->load->helper('progressor');
$this->load->helper('form');
$this->lang->load('upload');
?>
<h2>Submit essay</h2>
<?= eb_progress_bar($progressSteps,'upload') ?>
<h3>Upload an electronic answer</h3>
<p>Upload a document</p>
<form action="<?=base_url();?>index.php/user/upload/documents" method="POST" target="upload_target1" enctype="multipart/form-data" id="uploader">
    <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
    <div class="field">
        <label for="page">Select document:</label>
        <input type="file" name="exambuff" class="upload" />
        <?php eb_hidden('token',$token) ?>
    </div>
</form>
<h4><i>or</i></h4>
<h3>Upload images of your essay</h3>
<p>You will need to upload image files in jpeg format, with each file below 10 megabytes in size. <a class="inline" href="<?=app_base();?>info/upload"/>Find out</a> how to make sure your files are acceptable.
<?php $this->load->view('chunks/messages_ajax',array('errors'=>@$errors));?>
<div id="uploadForm">
	<form action="<?=base_url();?>index.php/user/upload/async" method="POST" target="upload_target1" enctype="multipart/form-data" id="uploader">
		<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
		<div class="field">
			<label for="page"><?=lang('uploadInputLabel');?>:</label>
			<input type="file" name="exambuff" class="upload" />
			<?php eb_hidden('token',$token) ?>
		</div>
	</form>
</div>
<div id="controls">
	<span id="up" ><a href="Move Page Up" >Up</a></span>
	<span id="down"><a href="Move Page Down">Down</a></span>
	<span id="delete"><a href="Delete Page" >Delete</a></span>
</div>
<h3>Uploaded files</h3>
<ol id="pagesPresent">
<?php
if(@is_array($pagesPresent)) :
	$i= 0;
	foreach($pagesPresent as $page) :
		if($page) {
		?>
	<li><span class="pageNum"><?=++$i?></span><?=stripslashes($page)?></li>
<?php
		}
endforeach; ?>
<?php endif; ?>
</ol>
<noscript>
	<div id="stdUpload">
		<form action="<?=base_url();?>index.php/user/scriptupload/stdupload"  method="post" enctype="multipart/form-data" id="noscriptUploader">
			<?php for($i = 1;$i < $stdFields;$i++) { ?>
				<span class="field fileField">
					<label for="page1"><?=lang('uploadInputLabel');?> <?= $i; ?>:</label>
					<input type="file"  name="page<?= $i; ?>" id="page<?= $i; ?>" class="upload" />
				</span>
			<?php } ?>
			<?php //eb_hidden('token',$token) ?>
			<div class="rightButtons"><input type="submit" value="<?=lang('submit');?>" /></div>
		</form>
	</div>
</noscript>
<div id="iframes">
</div>