<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<section class="article-detail <?= @$params['page_class']; ?>">

	<?php if ( @$params['show_page_content_title'] ) { ?>
	<header class="component-heading">
		<h1>
			<?= @$html_data['content']['title']; ?>
		</h1>
		<div class="divisor-h"></div>
	</header>
	<?php } ?>
	
	<div id="component-content" class="login-form-wrapper">
		
		<?php echo form_open($url); ?>
						
			<?php echo form_error('username', '<div class="msg-inline-error">', '</div>'); ?>
			<?php echo form_label(lang('username')); ?>
			<?php echo form_input(array('id'=>'username','name'=>'username'),set_value('username'),'autofocus'); ?>
			
			<?php echo form_error('password', '<div class="msg-inline-error">', '</div>'); ?>
			<?php echo form_label(lang('password')); ?>
			<?php echo form_password(array('id'=>'password','name'=>'password'),set_value('password')); ?>
			
			<div class="form-actions">
				
				<?php echo form_submit(array('id'=>'submit','name'=>'submit','class'=>'button button-save'),lang('users_login')); ?>
				
			</div>
			
		<?php echo form_close(); ?>
		
	</div>
	
</section>
