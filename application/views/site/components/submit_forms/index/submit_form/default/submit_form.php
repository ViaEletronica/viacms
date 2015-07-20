<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
	
	$fields = array();
	
	foreach ( $submit_form[ 'fields' ] as $key => $field ) {
		
		$fields[ $field[ 'alias' ] ] = $field;
		
	}
	
?>

<section class="submit-form <?= @$params['page_class']; ?>">
	
	<div id="component-content" class="submit-form-wrapper">
		
		<?php if ( $submit_form[ 'title' ] OR @$this->mcm->html_data[ 'content' ][ 'title' ] ) { ?>
		<header class="component-heading">
				
				<?php if ( @$params['show_page_content_title'] AND @$this->mcm->html_data[ 'content' ][ 'title' ] AND $submit_form[ 'title' ] != @$this->mcm->html_data[ 'content' ][ 'title' ] ) { ?>
					
					<h1>
						
						<?= $this->mcm->html_data[ 'content' ][ 'title' ]; ?>
						
					</h1>
					
					<h2>
					
						<?= $submit_form[ 'title' ]; ?>
						
					</h2>
					
				<?php } else if ( @$params['show_page_content_title'] AND @$this->mcm->html_data[ 'content' ][ 'title' ] AND $submit_form[ 'title' ] == @$this->mcm->html_data[ 'content' ][ 'title' ] ) { ?>
					
					<h1>
						
						<?= $submit_form[ 'title' ]; ?>
						
					</h1>
					
				<?php } else { ?>
					
					<h1>
						
						<?= $submit_form[ 'title' ]; ?>
						
					</h1>
					
				<?php } ?>
				
			</h1>
			
		</header>
		<?php } ?>
		
		<?php
		
		$post = $this->input->post();
		
		?>
		
		<?= form_open_multipart( get_url( $this->uri->ruri_string() ), array( 'id' => 'user-submit-form', ) ); ?>
			
			<?php foreach ( $fields as $key => $field ) {
				
				$field_name = $field[ 'alias' ];
				$formatted_field_name = 'form[' . $field_name . ']';
				$field_value = ( isset( $post[ 'form' ][ $field_name ] ) ) ? $post[ 'form' ][ $field_name ] : ( ( isset( $user_submit[ 'data' ][ $field_name ] ) ) ? $user_submit[ 'data' ][ $field_name ] : '' );
				$error = form_error( $formatted_field_name, '<span class="msg-inline-error error">', '</span>' );
				
				if ( $field[ 'field_type' ] == 'html' ) {
				
				?><div id="container-<?= $field_name; ?>" class="submit-form-field-wrapper submit-form-field-wrapper-<?= $field_name; ?> submit-form-field-wrapper-<?= $field[ 'field_type' ]; ?> <?= ( $error ) ? 'form-error error' : ''; ?>">
					
					<div class="submit-form-field-control">
						
						<?= $field[ 'html' ]; ?>
						
					</div>
					
				</div><?php
				
				} else if ( $field[ 'field_type' ] == 'input_text' ) {
					
					 ?><div id="container-<?= $field_name; ?>" class="submit-form-field-wrapper submit-form-field-wrapper-<?= $field_name; ?> submit-form-field-wrapper-<?= $field[ 'field_type' ]; ?> <?= ( $error ) ? 'form-error error' : ''; ?>">
						
						<?= form_label( lang( $field[ 'label' ] ) . ( $field[ 'field_is_required' ] ? ' <span class="submit-form-required">*</span> ' . $error : ' ' . $error ) ); ?>
						
						<div class="submit-form-field-control">
							
							<?= form_input( array( 'id' => 'submit-form-' . $field_name, 'name' => $formatted_field_name, 'class' => 'form-element submit-form submit-form-' . $field_name ), $field_value ); ?>
							
							<?php if ( check_var( $field[ 'description' ] ) ) { ?>
							<div class="submit-form-field-description">
								
								<?= $field[ 'description' ]; ?>
								
							</div>
							<?php } ?>
							
						</div>
						
					</div><?php
					
				} else if ( in_array( $field[ 'field_type' ], array( 'combo_box', 'checkbox' ) ) ) {
					
					 ?><div id="container-<?= $field_name; ?>" class="submit-form-field-wrapper submit-form-field-wrapper-<?= $field_name; ?> submit-form-field-wrapper-<?= $field[ 'field_type' ]; ?> <?= ( $error ) ? 'form-error error' : ''; ?>">
						
						<?php
							
							echo form_label( lang( $field[ 'label' ] ) . ( $field[ 'field_is_required' ] ? ' <span class="submit-form-required">*</span> ' . $error : '' ) );
							
							$options = array();
							
							if ( $field[ 'field_type' ] == 'combo_box' ) {
								
								$options[ '' ] = lang( 'combobox_select' );
								
							}
							
							if ( check_var( $field[ 'options_from_users_submits' ] ) AND ( check_var( $field[ 'options_title_field' ] ) OR check_var( $field[ 'options_title_field_custom' ] ) ) ) {
								
								$filters = NULL;
								
								if ( check_var( $field[ 'options_filter' ] ) ) {
									
									$filters = $field[ 'options_filter' ];
									
								}
								
								$search_config = array(
									
									'plugins' => 'sf_us_search',
									'allow_empty_terms' => TRUE,
									'ipp' => 0,
									'cp' => NULL,
									'plugins_params' => array(
										
										'sf_us_search' => array(
											
											'sf_id' => $field[ 'options_from_users_submits' ],
											'filters' => json_decode( $filters, TRUE ),
											'order_by' => ( isset( $field[ 'options_filter_order_by' ] ) ? $field[ 'options_filter_order_by' ] : $field[ 'options_title_field' ] ),
											'order_by_direction' => ( isset( $field[ 'options_filter_order_by_direction' ] ) ? $field[ 'options_filter_order_by_direction' ] : 'ASC' ),
											
										),
										
									),
									
								);
								
								$CI =& get_instance();
								$CI->load->library( 'search' );
								$CI->search->config( $search_config );
								
								$users_submits = $CI->search->get_full_results( 'sf_us_search', TRUE );
								
								foreach( $users_submits as & $_user_submit ) {
									
									$_user_submit[ 'data' ] = get_params( $_user_submit[ 'data' ] );
									
									if ( $field[ 'options_title_field' ] ) {
										
										foreach( $_user_submit[ 'data' ] as $_dk => $_data ) {
											
											if ( $_dk == $field[ 'options_title_field' ] )
											
											$options[ $_user_submit[ 'id' ] ] = $_data;
											
										};
										
									}
									
								};
								
							}
							else {
								
								$options_temp = explode( "\n" , $field[ 'options' ] );
								
								foreach( $options_temp as $option ) {
									
									$options[ $option ] = $option;
									
								};
								
							}
							
						?>
						
						<div class="submit-form-field-control">
							
							<?php
								
								if ( $field[ 'field_type' ] == 'combo_box' ) {
									
									echo form_dropdown( $formatted_field_name, $options, $field_value, 'id="submit-form-' . $field_name . '"' . ' class="form-element submit-form submit-form-' . $field_name . '"' );
									
								}
								else if ( $field[ 'field_type' ] == 'checkbox' ) {
									
									$formatted_field_name .= '[]';
									
									//print_r( $field_value );
									
									//print_r( $options );
									
									foreach( $options as $k => $option ) {
										
										$attr_options = array(
											
											'wrapper-class' => 'checkbox-sub-item',
											'class' => 'form-element submit-form submit-form-' . $field_name,
											'name' => $formatted_field_name,
											'id' => 'submit-form-' . $field_name,
											'value' => $k,
											'checked' => ( $field_value AND in_array( $k, $field_value ) ) ? 'checked' : '',
											'text' => $option,
											
										);
										
										echo vui_el_checkbox( $attr_options );
										
									};
									
								}
								
							?>
							
							<?php if ( check_var( $field[ 'description' ] ) ) { ?>
							<div class="submit-form-field-description">
								
								<?= $field[ 'description' ]; ?>
								
							</div>
							<?php } ?>
							
						</div>
						
					</div><?php
					
				} else if ( $field[ 'field_type' ] == 'date' ) {
					
					$this->plugins->load( array( 'types' => array( 'js_time_picker', ) ) );
					
					?><div id="container-<?= $field_name; ?>" class="submit-form-field-wrapper submit-form-field-wrapper-<?= $field_name; ?> submit-form-field-wrapper-<?= $field[ 'field_type' ]; ?> <?= ( $error ) ? 'form-error error' : ''; ?>">
						
						<?php
							
							$error = form_error( $formatted_field_name . '[d]', '<span class="msg-inline-error error">', '</span>' );
							$error .= form_error( $formatted_field_name . '[m]', '<span class="msg-inline-error error">', '</span>' );
							$error .= form_error( $formatted_field_name . '[y]', '<span class="msg-inline-error error">', '</span>' );
							
						?>
						
						<?= form_label( lang( $field[ 'label' ] ) . $error ); ?>
						<!--
						<?= form_input( array( 'id' => 'submit-form-' . $field_name, 'name' => $formatted_field_name, 'class' => 'date form-element submit-form submit-form-' . $field_name ), $field_value ); ?>
						-->
						<?php
							
							$options_d = array(
								
								'' => lang( 'combobox_select_day' ) . ( $field[ 'sf_date_field_day_is_req' ] ? ' *' : '' ),
								
							);
							
							for ( $i = $field[ 'sf_date_field_day_min_value' ]; $i <= $field[ 'sf_date_field_day_max_value' ]; $i++ ){
								
								$options_d[ str_pad( $i, 2, "0", STR_PAD_LEFT ) ] = str_pad( $i, 2, "0", STR_PAD_LEFT );
								
							}
							
							$options_m = array(
								
								'' => lang( 'combobox_select_month' ) . ( $field[ 'sf_date_field_month_is_req' ] ? ' *' : '' ),
								
							);
							
							for ( $i = $field[ 'sf_date_field_month_min_value' ]; $i <= $field[ 'sf_date_field_month_max_value' ]; $i++ ){
								
								$options_m[ str_pad( $i, 2, "0", STR_PAD_LEFT ) ] = str_pad( $i, 2, "0", STR_PAD_LEFT );
								
							}
							
							$options_y = array(
								
								'' => lang( 'combobox_select_year' ) . ( $field[ 'sf_date_field_year_is_req' ] ? ' *' : '' ),
								
							);
							
							for ( $i = $field[ 'sf_date_field_year_min_value' ]; $i <= $field[ 'sf_date_field_year_max_value' ]; $i++ ){
								
								$options_y[ str_pad( $i, 2, "0", STR_PAD_LEFT ) ] = str_pad( $i, 2, "0", STR_PAD_LEFT );
								
							}
							
							$field_name = isset( $field[ 'alias' ] ) ? $field[ 'alias' ] : $this->sfcm->make_field_name( $field[ 'label' ] );
							$formatted_field_name = 'form[' . $field_name . ']';
							
							if ( isset( $post[ 'form' ][ $field_name ] ) ) {
								
								$field_value_d = ( isset( $post[ 'form' ][ $field_name ][ 'd' ] ) ) ? $post[ 'form' ][ $field_name ][ 'd' ] : ( isset( $field[ 'sf_date_field_day_def_value' ] ) ? $field[ 'sf_date_field_day_def_value' ] : '' );
								$field_value_m = ( isset( $post[ 'form' ][ $field_name ][ 'm' ] ) ) ? $post[ 'form' ][ $field_name ][ 'm' ] : ( isset( $field[ 'sf_date_field_month_def_value' ] ) ? $field[ 'sf_date_field_month_def_value' ] : '' );
								$field_value_y = ( isset( $post[ 'form' ][ $field_name ][ 'y' ] ) ) ? $post[ 'form' ][ $field_name ][ 'y' ] : ( isset( $field[ 'sf_date_field_year_def_value' ] ) ? $field[ 'sf_date_field_year_def_value' ] : '' );
								
							}
							else if ( $field_value ) {
								
								$date = DateTime::createFromFormat( 'Y-m-d', $field_value );
								$field_value_y = $date->format( 'Y' );
								$field_value_m = $date->format( 'm' );
								$field_value_d = $date->format( 'd' );
								unset( $date );
								
							}
							else {
								
								$field_value_d = ( isset( $field[ 'sf_date_field_day_def_value' ] ) ? $field[ 'sf_date_field_day_def_value' ] : '' );
								$field_value_m = ( isset( $field[ 'sf_date_field_month_def_value' ] ) ? $field[ 'sf_date_field_month_def_value' ] : '' );
								$field_value_y = ( isset( $field[ 'sf_date_field_year_def_value' ] ) ? $field[ 'sf_date_field_year_def_value' ] : '' );
								
							}
							
							$use_day = check_var( $field[ 'sf_date_field_use_day' ] );
							$use_month = check_var( $field[ 'sf_date_field_use_month' ] );
							$use_year = check_var( $field[ 'sf_date_field_use_year' ] );
							
						?>
						
						<div class="submit-form-field-control submit-form-field-control-date submit-form-field-control-date-<?php if ( $use_day ) echo 'd'; ?><?php if ( $use_month ) echo 'm'; ?><?php if ( $use_year ) echo 'y'; ?>">
							
							<?php
								
								if ( $use_day ) echo form_dropdown( $formatted_field_name . '[d]', $options_d, $field_value_d, 'id="submit-form-' . $field_name . '-d"' . ' class="form-element submit-form submit-form-' . $field_name . '-d"' );
								
								if ( $use_month ) echo form_dropdown( $formatted_field_name . '[m]', $options_m, $field_value_m, 'id="submit-form-' . $field_name . '-m"' . ' class="form-element submit-form submit-form-' . $field_name . '-m"' );
								
								if ( $use_year ) echo form_dropdown( $formatted_field_name . '[y]', $options_y, $field_value_y, 'id="submit-form-' . $field_name . '-y"' . ' class="form-element submit-form submit-form-' . $field_name . '-y"' );
								
							?>
							
							<?php if ( check_var( $field[ 'description' ] ) ) { ?>
							<div class="submit-form-field-description">
								
								<?= $field[ 'description' ]; ?>
								
							</div>
							<?php } ?>
							
						</div>
						
					</div><?php
					
				} else if ( $field[ 'field_type' ] == 'articles' ) {
					
					?><div id="container-<?= $field_name; ?>" class="submit-form-field-wrapper submit-form-field-wrapper-<?= $field_name; ?> submit-form-field-wrapper-<?= $field[ 'field_type' ]; ?> <?= ( $error ) ? 'form-error error' : ''; ?>">
						
						<?= form_label( lang( $field[ 'label' ] ) . ( $field[ 'field_is_required' ] ? ' <span class="submit-form-required">*</span> ' . $error : '' ) ); ?>
						
						<?php
							
							$options = array(
								
								'' => lang( 'combobox_select' ),
								
							);
							
							foreach ( $field[ 'articles' ] as $article_key => $article ) {
								
								$options[ $article[ 'category_title' ] ][ $article[ 'title' ] ] = $article[ 'title' ];
								
							}
							
						?>
						
						<div class="submit-form-field-control">
							
							<?= form_dropdown( $formatted_field_name, $options, $field_value, 'id="submit-form-' . $field_name . '"' . ' class="form-element submit-form submit-form-' . $field_name . '"' ); ?>
							
							<?php if ( check_var( $field[ 'description' ] ) ) { ?>
							<div class="submit-form-field-description">
								
								<?= $field[ 'description' ]; ?>
								
							</div>
							<?php } ?>
							
						</div>
						
					</div><?php
					
				} else if ( $field[ 'field_type' ] == 'textarea' ) {
					
					 ?><div id="container-<?= $field_name; ?>" class="submit-form-field-wrapper submit-form-field-wrapper-<?= $field_name; ?> submit-form-field-wrapper-<?= $field[ 'field_type' ]; ?> <?= ( $error ) ? 'form-error error' : ''; ?>">
						
						<?= form_label( lang( $field[ 'label' ] ) . ( $field[ 'field_is_required' ] ? ' <span class="submit-form-required">*</span> ' . $error : '' ) ); ?>
						
						<div class="submit-form-field-control">
							
							<?= form_textarea( array( 'id' => 'submit-form-' . $field_name, 'name' => $formatted_field_name, 'class' => 'form-element submit-form submit-form-' . $field_name ), $field_value ); ?>
							
							<?php if ( check_var( $field[ 'description' ] ) ) { ?>
							<div class="submit-form-field-description">
								
								<?= $field[ 'description' ]; ?>
								
							</div>
							<?php } ?>
							
						</div>
						
					</div><?php
					
				} else if ( $field[ 'field_type' ] == 'button' ) {
					
						?><div id="container-<?= $field_name; ?>" class="submit-form-field-wrapper submit-form-field-wrapper-<?= $field_name; ?> submit-form-field-wrapper-<?= $field[ 'field_type' ]; ?>">
						
						<div class="submit-form-field-control">
							
							<?= form_submit( array( 'id' => 'submit-form-' . $field_name, 'class' => 'button form-element submit-form submit-form-' . $field_name, 'name' => $formatted_field_name ), lang( $field[ 'label' ] ) ); ?>
							
							<?php if ( check_var( $field[ 'description' ] ) ) { ?>
								
								<div class="submit-form-field-description">
									
									<?= $field[ 'description' ]; ?>
									
								</div>
								
							<?php } ?>
							
						</div>
						
					</div><?php
					
				}
				
				if ( check_var( $field[ 'conditional_field' ] ) ) {
					
					$target_field_name = $this->sfcm->make_field_name( $field[ 'conditional_target_field' ], '-', TRUE );
					$target_formatted_field_name = 'form[' . $target_field_name . ']';
					$target_field_id = 'container-' . $field_name;
					$show_function_name = 'show_field_' . url_title( $field[ 'key' ], '_', TRUE );
					
					$field_name_js = '$targetFieldName_' . url_title( $field[ 'key' ], '_', TRUE );
					
					if ( check_var( $field[ 'conditional_field_function' ] ) AND $field[ 'conditional_field_function' ] === 'show' ) {
					
					?><script type="text/javascript">
						
						function <?= $show_function_name; ?>(){
							
							<?php if ( $field[ 'conditional_field_cond' ] === 'equal' ) { ?>
								
								<?php if ( $fields[ $field[ 'conditional_target_field' ] ][ 'field_type' ] == 'checkbox' ) { ?>
									
									if ( $( '[name="<?= $target_formatted_field_name; ?>[]"][value="<?= $field[ 'conditional_field_values' ]; ?>"]:checked').length ) {
									
								<?php } else { ?>
									
									if ( $( '[name="<?= $target_formatted_field_name; ?>"]' ).val() === '<?= $field[ 'conditional_field_values' ]; ?>' ) {
									
								<?php } ?>
								
							<?php } else if ( $field[ 'conditional_field_cond' ] === 'different' AND $field[ 'conditional_field_values' ] === '' ) { ?>
								
								<?php if ( $fields[ $field[ 'conditional_target_field' ] ][ 'field_type' ] == 'checkbox' ) { ?>
									
									if ( $( '[name="<?= $target_formatted_field_name; ?>[]"]:checked').length ) {
									
								<?php } else { ?>
									
									if ( $.trim( $( '[name="<?= $target_formatted_field_name; ?>"]' ).val() ).length > 0 ) {
									
								<?php } ?>
								
							<?php } else if ( $field[ 'conditional_field_cond' ] === 'different' ) { ?>
								
								<?php if ( $fields[ $field[ 'conditional_target_field' ] ][ 'field_type' ] == 'checkbox' ) { ?>
									
									if ( $( '[name="<?= $target_formatted_field_name; ?>[]"][value="<?= $field[ 'conditional_field_values' ]; ?>"]:checked').length == 0 ) {
									
								<?php } else { ?>
									
									if ( $( '[name="<?= $target_formatted_field_name; ?>"]' ).val() !== '<?= $field[ 'conditional_field_values' ]; ?>' ) {
									
								<?php } ?>
								
							<?php } ?>
								
								$( '#<?= $target_field_id; ?>' ).show();
								$( '#<?= $target_field_id; ?>' ).find( '[name="no_validation_fields[<?= $field_name; ?>]"]' ).remove();
								
							}
							else {
								
								$( '#<?= $target_field_id; ?>' ).hide();
								
								<?php if ( $fields[ $field[ 'conditional_target_field' ] ][ 'field_type' ] == 'checkbox' ) { ?>
									
									$( '#<?= $target_field_id; ?> .form-element' ).attr( 'checked', '' );
									
								<?php } else if ( $fields[ $field[ 'conditional_target_field' ] ][ 'field_type' ] != 'button' ) { ?>
									
									$( '#<?= $target_field_id; ?> .form-element' ).val( '' );
									
								<?php } ?>
								
								$( '#<?= $target_field_id; ?> .form-element' ).change();
								
								if ( ! $( '[name="fields_ignore_validation[<?= $field_name; ?>]"]' ).length ) {
									
									$( '#<?= $target_field_id; ?>' ).append( '<input type="hidden" name="no_validation_fields[<?= $field_name; ?>]" value="<?= $field_name; ?>" />' );
									
								}
								
							}
							
						};
						
						$( document ).bind( 'ready', function(){
							
							<?php if ( $fields[ $field[ 'conditional_target_field' ] ][ 'field_type' ] == 'checkbox' ) { ?>
								
								$( '[name="<?= $target_formatted_field_name; ?>[]"]' ).bind( 'change keyup', function(){
									
									<?= $show_function_name; ?>();
									
								});
								
							<?php } else { ?>
								
								$( '[name="<?= $target_formatted_field_name; ?>"]' ).bind( 'change keyup', function(){
									
									<?= $show_function_name; ?>();
									
								});
								
							<?php } ?>
							
							<?= $show_function_name; ?>();
							
						});
						
					</script><?php
					
					}
					
				}
				
			} ?>
			
		<?= form_close(); ?>
		
		<div class="clear">&nbsp;</div>
		
	</div>
	
</section>
