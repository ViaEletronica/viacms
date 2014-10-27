
		<header>
			<h1><?= lang('new_category'); ?></h1>
		</header>
		
		<div>
			
			<?= form_open(get_url('admin'.$this->uri->ruri_string())); ?>
				
				<div class="form-actions to-toolbar">
					
					<?= vui_el_button( array( 'text' => lang( 'action_save' ), 'icon' => 'save', 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit', 'id' => 'submit', 'only_icon' => TRUE, 'form' => 'article-form', ) ); ?>
					
					<?= vui_el_button( array( 'text' => lang( 'action_apply' ), 'icon' => 'apply', 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit_apply', 'id' => 'submit-apply', 'only_icon' => TRUE, 'form' => 'article-form', ) ); ?>
					
					<?= vui_el_button( array( 'text' => lang( 'action_cancel' ), 'icon' => 'cancel', 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit_cancel', 'id' => 'submit-cancel', 'only_icon' => TRUE, 'form' => 'article-form', ) ); ?>
					
				</div>
				
				<fieldset>
					
					<legend><?= lang('details'); ?></legend>
					
					<?= form_error('status', '<div class="msg-inline-error">', '</div>'); ?>
					<?= form_label(lang('status')); ?>
					<?php
						$options = array(
							0=>lang('unpublished'),
							1=>lang('published'),
						);
					?>
					<?= form_dropdown('status', $options, set_value('status', 1),'id="status"'); ?>
					
					<?= form_error('title', '<div class="msg-inline-error">', '</div>'); ?>
					<?= form_label(lang('title')); ?>
					<?= form_input(array('id'=>'title','name'=>'title'),set_value('title'),'autofocus'); ?>
					
					<?= form_error('alias', '<div class="msg-inline-error">', '</div>'); ?>
					<?= form_label(lang('alias')); ?>
					<?= form_input(array('id'=>'alias','name'=>'alias'),set_value('alias')); ?>
					
					<?= form_error('parent', '<div class="msg-inline-error">', '</div>'); ?>
					<?= form_label(lang('parent_category')); ?>
					<?php
						$options = array(
							0 => lang( 'root' ),
						);
						
						if ( $categories ){
							
							foreach( $categories as $row ):
								$options[$row['id']] = $row['indented_title'];
							endforeach;
							
						}
						
					?>
					<?= form_dropdown('parent', $options, set_value('parent', 0),'id="parent-menu-item"'); ?>
					
					<?= form_error('ordering', '<div class="msg-inline-error">', '</div>'); ?>
					<?= form_label(lang('ordering')); ?>
					<?= form_input(array('id'=>'ordering','name'=>'ordering'),set_value('ordering')); ?>
					
					<?= form_error('description', '<div class="msg-inline-error">', '</div>'); ?>
					<?= form_label(lang('description')); ?>
					<?= form_textarea(array('id'=>'description','name'=>'description'),set_value('description')); ?>
					
				</fieldset>
				
			<?= form_close(); ?>
			
		</div>

