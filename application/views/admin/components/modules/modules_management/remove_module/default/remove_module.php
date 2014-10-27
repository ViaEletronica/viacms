
		<header>
			<h1><?= lang('confirm_delete'); ?></h1>
		</header>
		
		<div>
			
			<?= form_open(get_url('admin'.$this->uri->ruri_string())); ?>
			
			<p>
				<?= sprintf( lang( 'module_confirm_delete' ), '<b>' . $module[ 'title' ] . '</b>' ); ?>
			</p>
			
			<?= form_submit( array('id'=>'submit','name'=>'submit'),lang('action_yes'),'autofocus'); ?>
			<?= form_submit( array('id'=>'submit-cancel','name'=>'submit_cancel'),lang('action_cancel')); ?>
			
			<?= form_close(); ?>
			
		</div>

