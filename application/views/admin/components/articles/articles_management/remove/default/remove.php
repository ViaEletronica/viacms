
		<header>
			<h1><?php echo lang('confirm_delete'); ?></h1>
		</header>
		
		<div>
			
			<?php echo form_open(get_url('admin'.$this->uri->ruri_string())); ?>
			
			<p>
				
				<?php echo lang( 'article_confirm_delete', NULL,  $article[ 'title' ] ); ?>
				
			</p>
				
			<?php echo form_submit( array( 'id'=>'submit','name' => 'submit' ), lang( 'action_yes' ), 'autofocus' ); ?>
			<?php echo form_submit( array( 'id' => 'submit-cancel', 'name' => 'submit_cancel' ), lang( 'action_cancel' ) ); ?>
				
			<?php echo form_hidden('article_id',$article[ 'id' ]); ?>
				
			<?php echo form_close(); ?>
			
		</div>

