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
						
			<p>
				<?php echo lang('you_are_already_logged'); ?>
			</p>
			
			<div class="form-actions">
				
				<?php echo form_submit(array('id'=>'submit-logout','name'=>'submit_logout','class'=>'button button-logout'),lang('users_logout')); ?>
				
			</div>
			
		<?php echo form_close(); ?>
		
	</div>
	
</section>
