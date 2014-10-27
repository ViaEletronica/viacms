	
	
	<div id="category">
	
		<header>
			
			<?php if ( $f_action == 'add_category' ) { ?>
			
			<h1><?= lang('new_category'); ?></h1>
			
			<?php } else if ( $f_action == 'edit_category' ) { ?>
			
			<h1><?= lang('edit_category'); ?></h1>
			
			<?php } ?>
			
		</header>
		
		<div id="category-form">
			
			<?= form_open( get_url( 'admin'.$this->uri->ruri_string() ), array( 'id' => 'article-form', 'class' => ( ( $f_action == 'edit_article' ) ? 'ajax' : '' ) ) ); ?>
				
				<div class="form-actions to-toolbar">
					
					<?= vui_el_button( array( 'text' => lang( 'action_save' ), 'icon' => 'save', 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit', 'id' => 'submit', 'only_icon' => TRUE, 'form' => 'article-form', ) ); ?>
					
					<?= vui_el_button( array( 'text' => lang( 'action_apply' ), 'icon' => 'apply', 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit_apply', 'id' => 'submit-apply', 'only_icon' => TRUE, 'form' => 'article-form', ) ); ?>
					
					<?= vui_el_button( array( 'text' => lang( 'action_cancel' ), 'icon' => 'cancel', 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit_cancel', 'id' => 'submit-cancel', 'only_icon' => TRUE, 'form' => 'article-form', ) ); ?>
					
				</div>
				
				<table class="table-form">
					
					<tr class="table-form-row">
						
						<td class="table-form-content">
							
							<fieldset>
								
								<legend><?= lang('details'); ?></legend>
								
								<div id="title" class="vui-field-wrapper-inline">
									
									<?php
										
										$field_name = 'title';
										$field_error = form_error( $field_name, '<div class="msg-inline-error">', '</div>' );
										$field_attr = 'autofocus id="' . $field_name . '" name="' . $field_name . '" class="' . $field_name . ' ' . ( $field_error ? 'field-error' : '' ) . '"' . ( $field_error ? element_title( $field_error ) : '' );
										
									?>
									
									<?= form_label( lang( $field_name ) ); ?>
									<?= form_input( $field_name, set_value( $field_name, @$category->{ $field_name } ), $field_attr ); ?>
									
									<?php
										
										unset( $field_error );
										unset( $field_attr );
										
									?>
									
								</div>
								
								<div id="alias" class="vui-field-wrapper-inline">
									
									<?php
										
										$field_name = 'alias';
										$field_error = form_error( $field_name, '<div class="msg-inline-error">', '</div>' );
										$field_attr = ( $field_error ? 'autofocus' : '' ) . ' id="' . $field_name . '" name="' . $field_name . '" class="' . $field_name . ' ' . ( $field_error ? 'field-error' : '' ) . '"' . ( $field_error ? element_title( $field_error ) : '' );
										
									?>
									
									<?= form_label( lang( $field_name ) ); ?>
									<?= form_input( $field_name, set_value( $field_name, @$category->{ $field_name } ), $field_attr ); ?>
									
									<?php
										
										unset( $field_error );
										unset( $field_attr );
										
									?>
									
								</div>
								
								<div id="category" class="vui-field-wrapper-inline">
									
									<?php
										$field_name = 'parent';
										$field_error = form_error( $field_name, '<div class="msg-inline-error">', '</div>' );
										$field_attr = ( $field_error ? 'autofocus' : '' ) . ' id="' . $field_name . '" name="' . $field_name . '" class="' . $field_name . ' ' . ( $field_error ? 'field-error' : '' ) . '"' . ( $field_error ? element_title( $field_error ) : '' );
										
										$field_options = array(
											
											0 => lang( 'root' ),
											
										);
										
										if ( $categories ){
											
											foreach( $categories as $cat_row ):
												
												$field_options[ $cat_row[ 'id' ] ] = $cat_row[ 'indented_title' ];
												
											endforeach;
											
										}
										
									?>
									
									<?= form_label( lang( 'parent_category' ) ); ?>
									<?= form_dropdown( $field_name, $field_options, set_value( $field_name, @$category->{ $field_name } ), $field_attr ); ?>
									
									<?php
										
										unset( $field_error );
										unset( $field_attr );
										unset( $field_options );
										
									?>
									
								</div>
								
								<div id="status" class="vui-field-wrapper-inline">
									
									<?php
										
										$field_name = 'status';
										$field_error = form_error( $field_name, '<div class="msg-inline-error">', '</div>' );
										$field_attr = ( $field_error ? 'autofocus' : '' ) . ' id="' . $field_name . '" name="' . $field_name . '" class="' . $field_name . ' ' . ( $field_error ? 'field-error' : '' ) . '"' . ( $field_error ? element_title( $field_error ) : '' );
										
										$field_options = array(
											
											1 => lang('published'),
											0 => lang('unpublished'),
											
										);
										
									?>
									
									<?= form_label( lang( $field_name ) ); ?>
									<?= form_dropdown( $field_name, $field_options, set_value( $field_name, @$category->{ $field_name } ), $field_attr ); ?>
									
									<?php
										
										unset( $field_error );
										unset( $field_attr );
										unset( $field_options );
										
									?>
									
								</div>
								
								<?php if ( $f_action == 'ec' ) { ?>
								
								<?= form_hidden( 'category_id', $category->id ); ?>
								
								<?php } ?>
								
							</fieldset>
							
							<fieldset>
								
								<legend><?= lang( 'description' ); ?></legend>
								
								<?php
									
									$field_name = 'description';
									$field_error = form_error( $field_name, '<div class="msg-inline-error">', '</div>' );
									$field_attr = ( $field_error ? 'autofocus' : '' ) . ' id="' . $field_name . '" name="' . $field_name . '" class="js-editor ' . $field_name . ' ' . ( $field_error ? 'field-error' : '' ) . '"' . ( $field_error ? element_title( $field_error ) : '' );
									
								?>
								
								<?= form_textarea( $field_name, set_value( $field_name, @$article->{ $field_name } ), $field_attr ); ?>
								
								<?php
									
									unset( $field_error );
									unset( $field_attr );
									
								?>
								
							</fieldset>
							
						</td>
						
					</tr>
					
				</table>
				
				<div class="clear"></div>
				
			<?= form_close(); ?>
			
		</div>
	
	</div>
