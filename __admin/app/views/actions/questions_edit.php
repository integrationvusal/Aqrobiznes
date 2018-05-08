<?php

use jewish\backend\CMS;
use jewish\backend\helpers\utils;
use jewish\backend\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}


view::appendJS(SITE_DIR.CMS_DIR.JS_DIR.'ckeditor/ckeditor.js');

?>

<script>
    $(function(){
       $('.datepicker').datepicker({dateFormat:'dd.mm.yy'}); 
    });
</script>

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?=CMS::t('menu_item_questions_edit');?>
			<!-- <small>Subtitile</small> -->
		</h1>

		<!-- <ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol> -->
	</section>

	<!-- Content Header (Page header) -->
	<section class="contextual-navigation">
		<nav>
			<a href="<?=utils::safeEcho($link_back, 1);?>" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> <?=CMS::t('back');?></a>
		</nav>
	</section>


	<!-- Main content -->
	<section class="content">
		<?php
			if (!empty($op)) {
				if ($op['success']) {
					print view::notice($op['message'], 'success');
				} else {
					print view::notice(empty($op['errors'])? $op['message']: $op['errors']);
				}
			}
		?>

		<!-- Info boxes -->
		
		<div class="box">

			<form action="" method="post" enctype="multipart/form-data" class="form-std" role="form">
				<input type="hidden" name="CSRF_token" value="<?=$CSRF_token;?>" />

				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label><?=CMS::t('questions_question');?> *</label>
								
									<textarea name="question" rows="4" cols="32" class="form-input-std" id="question"><?=isset($_POST['question'])?utils::safeEcho($_POST['question'], 1):$data['question'];?></textarea>
										<script type="text/javascript">
// <![CDATA[
CKEDITOR.replace('question', {
	uiColor: '#f9f9f9',
	language: 'az',
	filebrowserBrowseUrl: '<?=SITE.CMS_DIR.JS_DIR?>ckeditor/ckfinder/ckfinder.html?hash=<?=CMS::$sess_hash?>',
	filebrowserUploadUrl: '<?=SITE.CMS_DIR.JS_DIR?>ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	height:200
});
// ]]>
										</script>
							</div>
						    <div class="form-group">
								<label><?=CMS::t('questions_answer');?> *</label>
									<textarea name="answer" rows="4" cols="32" class="form-input-std" id="answer"><?=isset($_POST['answer'])?utils::safeEcho($_POST['answer'], 1):$data['answer'];?></textarea>
										<script type="text/javascript">
// <![CDATA[
CKEDITOR.replace('answer', {
	uiColor: '#f9f9f9',
	language: 'az',
	filebrowserBrowseUrl: '<?=SITE.CMS_DIR.JS_DIR?>ckeditor/ckfinder/ckfinder.html?hash=<?=CMS::$sess_hash?>',
	filebrowserUploadUrl: '<?=SITE.CMS_DIR.JS_DIR?>ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	height:200
});
// ]]>
										</script>
							</div>
						</div>
					</div>
				</div>
				<!-- /.box-body -->

				<div class="box-footer">
					<button type="submit" name="edit" value="1" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?=CMS::t('edit');?></button>
					<a href="<?=utils::safeEcho($link_back, 1);?>"><button type="button" name="reset" value="1" class="btn btn-default"><i class="fa fa-refresh" aria-hidden="true"></i> <?=CMS::t('reset');?></button></a>
				</div>
			</form>
		</div>
		<!-- /.box -->

		<!-- /.info boxes -->
	</section>
	<!-- /.content -->