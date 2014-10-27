			
			<header>
				<h1><?php echo lang('login'); ?></h1>
			</header>
			
			<div>
				
				<?php echo form_open(get_url('admin'.$this->uri->ruri_string())); ?>
					
					<div id="username" class="field-wrapper">
						
						<?php echo form_error('username', '<div class="msg-inline-error">', '</div>'); ?>
						<?php echo form_input(array('id'=>'username','name'=>'username', 'placeholder' => lang( 'username' ),),set_value('username'),'autofocus'); ?>
						
					</div>
						
					<div id="password" class="field-wrapper">
						
						<?php echo form_error('password', '<div class="msg-inline-error">', '</div>'); ?>
						<?php echo form_password(array('id'=>'password','name'=>'password', 'placeholder' => lang( 'password' ), ),set_value('password')); ?>
						
					</div>
					
					<div class="keep-me-logged-in-container">
						
						<?php
							
							$options = array(
								
								'wrapper-class' => 'checkbox-sub-item',
								'name' => 'keep_me_logged_in',
								'id' => 'keep-me-logged-in',
								'checked' => ( ! $this->input->post() ? TRUE : ( $this->input->post( 'keep_me_logged_in' ) ? TRUE : FALSE ) ),
								'text' => lang( 'keep_me_logged_in' ),
								'class' => 'keep-me-logged-in',
								
							);
							
							echo vui_el_checkbox( $options );
							
						?>
						
					</div>
					
					<div class="button-login-container vui-field-wrapper-inline">
						
						<?php echo form_submit( array('id'=>'submit','name'=>'submit','class'=>'button button-save'),lang('action_login')); ?>
						
						<?= vui_el_button( array( 'url' => 'admin/main/index/google_login', 'text' => lang( 'google_login' ), 'icon' => 'google', 'only_icon' => TRUE, ) ); ?>
						
						<?= vui_el_button( array( 'url' => 'admin/main/index/facebook_login', 'text' => lang( 'facebook_login' ), 'icon' => 'facebook', 'only_icon' => TRUE, ) ); ?>
						
					</div>
					
				<?php echo form_close(); ?>
				
				<div>
						
				</div>
				
				<div>
					
					<div id="status">
					</div>
					
				</div>
				
			</div>
			
			