
<div id="global-config-form-wrapper" class="form-wrapper tabs-wrapper">
	
	<div class="form-wrapper-sub tabs-children">
		
		<?= form_open( get_url( 'admin'.$this->uri->ruri_string() ), array( 'id' => 'menu-item-form', 'class' => ( ( $component_function_action == 'emi' ) ? 'ajax' : '' ) ) ); ?>
			
			<div class="form-actions to-toolbar">
				
				<?= vui_el_button( array( 'text' => lang( 'action_save' ), 'icon' => 'save', 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit', 'id' => 'submit', 'only_icon' => TRUE, 'form' => 'menu-item-form', ) ); ?>
				
				<?= vui_el_button( array( 'text' => lang( 'action_apply' ), 'icon' => 'apply', 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit_apply', 'id' => 'submit-apply', 'only_icon' => TRUE, 'form' => 'menu-item-form', ) ); ?>
				
				<?= vui_el_button( array( 'text' => lang( 'action_cancel' ), 'icon' => 'cancel', 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit_cancel', 'id' => 'submit-cancel', 'only_icon' => TRUE, 'form' => 'menu-item-form', ) ); ?>
				
			</div>
			
			<header class="form-header tabs-header">
				
				<h1>
					
					<?php if ( $component_function_action == 'ami' ) { ?>
						
					<?= lang('new_menu_item'); ?>
					
					<?php } else if ( $component_function_action == 'emi' ) { ?>
						
					<?= lang('edit_menu_item'); ?>
					
					<?php } ?> - <?= lang( $type ); ?>
					
				</h1>
				
			</header>
			
			<div class="form-items tabs-items">
				
				<div class="form-item">
					
					<fieldset>
						
						<legend>
							
							<?= vui_el_button( array( 'text' => lang( 'basic_details' ), 'icon' => 'basic-details',  ) ); ?>
							
						</legend>
						
						<div id="title" class="vui-field-wrapper-inline">
							
							<?= form_error('title', '<div class="msg-inline-error">', '</div>'); ?>
							<?= form_label(lang('title')); ?>
							<?= form_input( array( 'id'=>'title', 'name'=>'title' ), set_value( 'title', @$menu_item[ 'title' ] ),'autofocus' ); ?>
							
						</div>
						
						<div id="alias" class="vui-field-wrapper-inline">
							
							<?= form_error('alias', '<div class="msg-inline-error">', '</div>'); ?>
							<?= form_label(lang('alias')); ?>
							<?= form_input( array( 'id'=>'alias', 'name'=>'alias' ), set_value('alias', @$menu_item[ 'alias' ] ) ); ?>
							
						</div>
						
						<div id="status" class="vui-field-wrapper-inline">
							
							<?= form_error('status', '<div class="msg-inline-error">', '</div>'); ?>
							<?= form_label(lang('status')); ?>
							<?php
								$options = array(
									
									0 => lang('unpublished'),
									1 => lang('published'),
									
								);
							?>
							<?= form_dropdown('status', $options, set_value('status', @$menu_item[ 'status' ] ),'id="status"'); ?>
							
						</div>
						
						<div id="parent" class="vui-field-wrapper-inline">
							
							<?= form_error('parent', '<div class="msg-inline-error">', '</div>'); ?>
							<?= form_label(lang('parent_menu_item')); ?>
							<?php
								$options = array(
									0=>lang('root'),
								);
								foreach($menu_items as $row):
									if ($row['id'] != @$menu_item[ 'id' ]){
										$options[$row['id']] = $row['indented_title'];
									}
								endforeach;
							?>
							<?= form_dropdown('parent', $options, set_value('parent', @$menu_item[ 'parent' ]),'id="parent-menu-item"'); ?>
							
						</div>
						
						<div id="link" class="vui-field-wrapper-inline">
							
							<?= form_error('link', '<div class="msg-inline-error">', '</div>'); ?>
							<?= form_label( lang( 'link' ) ); ?>
							
							<?php if ( $menu_item_link_disabled ) { ?>
							<?= form_input( array( 'id'=>'link', 'name'=>'link', 'disabled'=>'disabled' ), set_value( 'link', @$menu_item[ 'link' ] ) ); ?>
							<?php } else { ?>
							<?= form_input( array( 'id'=>'link', 'name'=>'link' ), set_value( 'link', @$menu_item[ 'link' ] ) ); ?>
							<?php } ?>
							
						</div>
						
						<div class="divisor-h"></div>
						
						<div id="description" class="field-wrapper">
							
							<?php if ( @$target_component ) echo form_hidden( 'component_id', $target_component[ 'id' ] ); ?>
							<?= form_hidden( 'menu_type_id', $menu_type_id ); ?>
							
							<?= form_error( 'description', '<div class="msg-inline-error">', '</div>' ); ?>
							<?= form_label(lang('description')); ?>
							<?= form_textarea(array('id'=>'description', 'name'=>'description', 'class'=>'js-editor'),set_value('description', @$menu_item[ 'description' ])); ?>
							
						</div>
							
					</fieldset>
					
				</div>
				
				<div class="form-item">
					
					<fieldset>
						
						<legend>
							
							<?= vui_el_button( array( 'text' => lang( 'access' ), 'icon' => 'security','title' => lang( 'tip_articles_management_access_level' ),  ) ); ?>
							
						</legend>
						
						<div class="field-wrapper">
							
							<label>
								
								<?php if ( $component_function_action == 'emi' ) { ?>
								
								<input type="radio" name="access_type" value="public" class="" <?= ( $this->input->post('access_type') == 'public') ? 'checked': ( ( ! $this->input->post( 'access_type' ) AND $menu_item[ 'access_type' ] == 'public' ) ? 'checked' : '' ); ?> />
								
								<?php } else { ?>
								
								<input type="radio" name="access_type" value="public" class="" <?= ( $this->input->post('access_type') == 'public') ? 'checked': ( ( ! $this->input->post( 'access_type' ) ) ? 'checked' : '' ); ?> />
								
								<?php } ?>
								
								<?= lang('public'); ?>
								
							</label>
							
						</div>
						
						<div class="field-wrapper">
							
							<?php
								
								$access_type_users_field_name = 'access_user_id[]';
								$access_type_users_field_error = form_error( $access_type_users_field_name, '<div class="msg-inline-error">', '</div>' );
								$access_type_users_label_attr = 'class="' . ( $access_type_users_field_error ? 'field-error' : '' ) . '"' . ( $access_type_users_field_error ? element_title( $access_type_users_field_error ) : '' );
								
							?>
							
							<label <?= $access_type_users_label_attr; ?>>
								
								<span class="fake-label">
									
									<?php if ( $component_function_action == 'emi' ) { ?>
									
									<input type="radio" name="access_type" value="users" class="" <?= ( $this->input->post('access_type') == 'users') ? 'checked': ( ( ! $this->input->post( 'access_type' ) AND $menu_item[ 'access_type' ] == 'users' ) ? 'checked' : '' ); ?> />
									
									<?php } else { ?>
									
									<input type="radio" name="access_type" value="users" class="" <?= ( $this->input->post('access_type') == 'users') ? 'checked': ''; ?> />
									
									<?php } ?>
									
									<?= lang('specific_users'); ?>
									
								</span>
								
								<?php
								
								if ( $this->input->post( 'access_user_id' ) ) {
									
									$post_access_user_id = $this->input->post('access_user_id');
									
								}
								else {
									
									$post_access_user_id = FALSE;
									
								}
								
								?>
								
								<?php foreach( $users as $user ){ ?>
									
									<label class="checkbox-sub-item" for="user-<?= $user['id']; ?>">
										
										<?php if ( $component_function_action == 'emi' ) { ?>
										
										<input id="user-<?= $user['id']; ?>" name="<?= $access_type_users_field_name; ?>" type="checkbox" value="><?= $user['id']; ?><" <?= ( $this->input->post( 'access_type' ) === 'users' AND $post_access_user_id AND in_array( html_escape( '>' . $user['id'] . '<' ), $post_access_user_id ) ) ? 'checked' : ( ( ! $this->input->post('access_type') AND $menu_item[ 'access_type' ] == 'users' AND in_array( '>'.$user['id'].'<', $menu_item[ 'access_user_id' ] ) ) ? 'checked' : '' ); ?> />
										
										<?php } else { ?>
										
										<input id="user-<?= $user['id']; ?>" name="<?= $access_type_users_field_name; ?>" type="checkbox" value="><?= $user['id']; ?><" <?= ( $this->input->post( 'access_type' ) === 'users' AND $post_access_user_id AND in_array( html_escape( '>' . $user['id'] . '<' ), $post_access_user_id ) ) ? 'checked' : ''; ?> />
										
										<?php } ?>
										
										<?= $user['name'].' ('.$user['username'].')'; ?>
										
									</label>
									
								<?php };
								
								?>
								
							</label>
							
						</div>
						
						<div class="field-wrapper">
							
							<label>
								
								<?php
									
									$access_type_users_groups_field_name = 'access_user_group_id[]';
									$access_type_users_groups_field_error = form_error( $access_type_users_groups_field_name, '<div class="msg-inline-error">', '</div>' );
									$access_type_users_groups_label_attr = 'class="' . ( $access_type_users_groups_field_error ? 'field-error' : '' ) . '"' . ( $access_type_users_groups_field_error ? element_title( $access_type_users_groups_field_error ) : '' );
									
								?>
								
								<label <?= $access_type_users_groups_label_attr; ?>>
									
									<span class="fake-label">
										
										<?php if ( $component_function_action == 'emi' ) { ?>
										
										<input type="radio" name="access_type" value="users_groups" class="" <?= ( $this->input->post('access_type') == 'users_groups') ? 'checked': ( ( ! $this->input->post( 'access_type' ) AND $menu_item[ 'access_type' ] == 'users_groups' ) ? 'checked' : '' ); ?> />
										
										<?php } else { ?>
										
										<input type="radio" name="access_type" value="users_groups" class="" <?= ( $this->input->post('access_type') == 'users_groups') ? 'checked': ''; ?> />
										
										<?php } ?>
										
										<?= lang('specific_users_groups'); ?>
										
									</span>
									
									<?php
									
									if ( $this->input->post( 'access_user_group_id' ) ) {
										
										$post_access_user_group_id = $this->input->post('access_user_group_id');
										
									}
									else {
										
										$post_access_user_group_id = FALSE;
										
									}
									
									?>
									
									<?php foreach($users_groups as $user_group) { ?>
										
										<label class="checkbox-sub-item" for="user-group-<?= $user_group['id']; ?>">
											
											<?php if ( $component_function_action == 'emi' ) { ?>
											
											<input id="user-group-<?= $user_group['id']; ?>" name="<?= $access_type_users_groups_field_name; ?>" type="checkbox" value="><?= $user_group['id']; ?><" <?= ( $this->input->post( 'access_type' ) === 'users_groups' AND $post_access_user_group_id AND in_array( html_escape( '>' . $user_group['id'] . '<' ), $post_access_user_group_id ) ) ? 'checked' : ( ( ! $this->input->post('access_type') AND $menu_item[ 'access_type' ] == 'users_groups' AND in_array( '>'.$user_group['id'].'<', $menu_item[ 'access_user_group_id' ] ) ) ? 'checked' : '' ); ?> />
											
											<?php } else { ?>
											
											<input id="user-group-<?= $user_group['id']; ?>" name="<?= $access_type_users_groups_field_name; ?>" type="checkbox" value="><?= $user_group['id']; ?><" <?= ( $this->input->post( 'access_type' ) === 'users_groups' AND $post_access_user_group_id AND in_array( html_escape( '>' . $user_group['id'] . '<' ), $post_access_user_group_id ) ) ? 'checked' : ''; ?> />
											
											<?php } ?>
											
											<?= $user_group['indented_title']; ?>
											
										</label>
										
									<?php }; ?>
									
								</label>
								
						</div>
						
					</fieldset>
					
				</div>
				
				<?php if ( $type == 'component' ) { ?>
				
				<div class="form-item">
					
					<fieldset>
						
						<legend>
							
							<?= vui_el_button( array( 'text' => lang( $component_item ), 'icon' => $component_item,  ) ); ?>
							
						</legend>
						
						<?php //echo parse_params($params, get_params($menu_item[ 'params)); ?>
						
						<?php
						
						/* gerando o html dos parâmetros, ele deve ser chamado na view, não no controller,
						 * pois os erros de validação dos elementos dos parâmetros devem ser expostos
						 * após a chamada da função $this->form_validation->run()
						 */
						
						echo params_to_html( $component_params_spec, $component_final_params_values );
						
						?>
						
					</fieldset>
					
				</div>
				
				<?php } ?>
				
				<?php if ( $type == 'html_content' ) { ?>
				
				<div class="form-item">
					
					<fieldset>
						
						<legend>
							
							<?= vui_el_button( array( 'text' => lang( 'html_content' ), 'icon' => 'html-content',  ) ); ?>
							
						</legend>
						
						<div id="description" class="field-wrapper">
							
							<?= form_error( 'html_content', '<div class="msg-inline-error">', '</div>' ); ?>
							<?= form_label( lang( 'html_content' ) ); ?>
							<?= form_textarea( array( 'id' => 'html_content', 'name' => 'html_content', 'class' => 'js-editor' ), set_value( 'html_content', @$menu_item[ 'html_content' ] ) ); ?>
							
						</div>
							
					</fieldset>
					
				</div>
				
				<?php } ?>
				
				<div class="form-item">
					
					<fieldset>
						
						<legend>
							
							<?= vui_el_button( array( 'text' => lang( 'menu_item' ), 'icon' => 'menu-items',  ) ); ?>
							
						</legend>
						
						<?php //echo parse_params($menu_item_params, get_params($menu_item[ 'params)); ?>
						
						<?php
						
						/* gerando o html dos parâmetros, ele deve ser chamado na view, não no controller,
						 * pois os erros de validação dos elementos dos parâmetros devem ser expostos
						 * após a chamada da função $this->form_validation->run()
						 */
						
						echo params_to_html( $menu_item_params_spec, $menu_item_final_params_values );
						
						?>
						
					</fieldset>
					
				</div>
				
			</div>
			
			<?= form_hidden( 'menu_item_id', @$menu_item[ 'id' ] ); ?>
			
		<?= form_close(); ?>
		
	</div>
	
</div>

<?php
	
	if ( $this->plugins->load( 'yetii' ) ){ ?>

<script type="text/javascript" >
	
	$( document ).ready(function(){
		
		/*************************************************/
		/**************** Criando as tabs ****************/
		
		makeTabs( $( '.tabs-wrapper' ), '.form-item', 'legend' );
		
		/**************** Criando as tabs ****************/
		/*************************************************/
		
	});

</script>

<?php } ?>

