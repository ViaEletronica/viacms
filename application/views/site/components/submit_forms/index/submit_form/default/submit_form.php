<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' ); ?>

<section class="submit-form <?= @$params['page_class']; ?>">

	<?php if ( @$params['show_page_content_title'] ) { ?>
	<header class="component-heading">

		<h1>

			<?= $this->mcm->html_data['content']['title']; ?>

		</h1>

	</header>
	<?php } ?>

	<div id="component-content" class="submit-form-wrapper">


		<?php

		$post = $this->input->post();

		?>

		<?= form_open_multipart( get_url( $this->uri->ruri_string() ), array( 'id' => 'contact-form', ) ); ?>

			<?php foreach ( $submit_form[ 'fields' ] as $key => $field ) {

				$field_name = url_title( $field[ 'label' ], '-', TRUE );
				$formatted_field_name = 'form[' . $field_name . ']';
				$field_value = ( isset( $post[ 'form' ][ $field_name ] ) ) ? $post[ 'form' ][ $field_name ] : '';
				$error = form_error( $formatted_field_name, '<span class="msg-inline-error error">', '</span>' );

				if ( $field[ 'field_type' ] == 'html' ) {

				?><div id="container-<?= $field_name; ?>" class="submit-form-field-wrapper submit-form-field-wrapper-<?= $field_name; ?> submit-form-field-wrapper-<?= $field[ 'field_type' ]; ?> <?= ( $error ) ? 'form-error error' : ''; ?>">

					<div class="submit-form-field-control">

						<?= $field[ 'html' ]; ?>

					</div>

				</div><?php

				} else if ( $field[ 'field_type' ] == 'input_text' ) {

					 ?><div id="container-<?= $field_name; ?>" class="submit-form-field-wrapper submit-form-field-wrapper-<?= $field_name; ?> submit-form-field-wrapper-<?= $field[ 'field_type' ]; ?> <?= ( $error ) ? 'form-error error' : ''; ?>">

						<?= form_label( lang( $field[ 'label' ] ) . ( $field[ 'field_is_required' ] ? ' <span class="submit-form-required">*</span> ' . $error : '' ) ); ?>

						<div class="submit-form-field-control">

							<?= form_input( array( 'id' => 'submit-form-' . $field_name, 'name' => $formatted_field_name, 'class' => 'form-element submit-form submit-form-' . $field_name ), $field_value ); ?>

							<?php if ( check_var( $field[ 'description' ] ) ) { ?>
						   <div class="submit-form-field-description">

							   <?= $field[ 'description' ]; ?>

						   </div>
							<?php } ?>

						</div>

					</div><?php

				} else if ( $field[ 'field_type' ] == 'combo_box' ) {

					 ?><div id="container-<?= $field_name; ?>" class="submit-form-field-wrapper submit-form-field-wrapper-<?= $field_name; ?> submit-form-field-wrapper-<?= $field[ 'field_type' ]; ?> <?= ( $error ) ? 'form-error error' : ''; ?>">

						<?= form_label( lang( $field[ 'label' ] ) . ( $field[ 'field_is_required' ] ? ' <span class="submit-form-required">*</span> ' . $error : '' ) ); ?>

						<?php

							$options = array(

								'' => lang( 'combobox_select' ),

							);

							$options_temp = explode( "\n" , $field[ 'options' ] );

							foreach( $options_temp as $option ) {

								$options[ $option ] = $option;

							};

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

				} else if ( $field[ 'field_type' ] == 'date' ) {

					 ?><div id="container-<?= $field_name; ?>" class="submit-form-field-wrapper submit-form-field-wrapper-<?= $field_name; ?> submit-form-field-wrapper-<?= $field[ 'field_type' ]; ?> <?= ( $error ) ? 'form-error error' : ''; ?>">

						<?= form_label( lang( $field[ 'label' ] ) . ( $field[ 'field_is_required' ] ? ' <span class="submit-form-required">*</span> ' . $error : '' ) ); ?>

						<?php

							$options_d = array(

								'' => lang( 'combobox_select' ),

							);

							for ( $i = 1; $i <= 31; $i++ ){

								$options_d[ str_pad( $i, 2, "0", STR_PAD_LEFT ) ] = str_pad( $i, 2, "0", STR_PAD_LEFT );

							}

							$options_m = array(

								'' => lang( 'combobox_select' ),

							);

							for ( $i = 1; $i <= 12; $i++ ){

								$options_m[ str_pad( $i, 2, "0", STR_PAD_LEFT ) ] = str_pad( $i, 2, "0", STR_PAD_LEFT );

							}

							$options_y = array(

								'' => lang( 'combobox_select' ),

							);

							for ( $i = ( date( 'Y' ) - 90 ); $i <= ( date( 'Y' ) - 18 ); $i++ ){

								$options_y[ str_pad( $i, 2, "0", STR_PAD_LEFT ) ] = str_pad( $i, 2, "0", STR_PAD_LEFT );

							}

							print_r( $field );
							$field_name = url_title( $field[ 'label' ], '-', TRUE );
							$formatted_field_name = 'form[' . $field_name . ']';
							$field_value_d = isset( $post[ 'form' ][ $field_name ][ 'd' ] ) ? $post[ 'form' ][ $field_name ][ 'd' ] : ( isset( $field[ 'd' ] ) ? $field[ 'd' ] : '' );
							$field_value_m = ( isset( $post[ 'form' ][ $field_name ][ 'm' ] ) ) ? $post[ 'form' ][ $field_name ][ 'm' ] : '';
							$error = form_error( $formatted_field_name, '<span class="msg-inline-error error">', '</span>' );

						?>

						<div class="submit-form-field-control">

							<?= form_dropdown( $formatted_field_name . '[d]', $options_d, $field_value_d, 'id="submit-form-' . $field_name . '-d"' . ' class="form-element submit-form submit-form-' . $field_name . '-d"' ); ?>

							<?= form_dropdown( $formatted_field_name . '[m]', $options_m, $field_value_m, 'id="submit-form-' . $field_name . '-m"' . ' class="form-element submit-form submit-form-' . $field_name . '-m"' ); ?>

							<?= form_dropdown( $formatted_field_name . '[y]', $options_y, $field_value, 'id="submit-form-' . $field_name . '-y"' . ' class="form-element submit-form submit-form-' . $field_name . '-y"' ); ?>

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

					$target_field_name = url_title( $field[ 'conditional_target_field' ], '-', TRUE );
					$target_formatted_field_name = 'form[' . $target_field_name . ']';
					$target_field_id = 'container-' . $field_name;
					$show_function_name = 'show_field_' . url_title( $field[ 'key' ], '_', TRUE );

					$field_name_js = '$targetFieldName_' . url_title( $field[ 'key' ], '_', TRUE );

					if ( check_var( $field[ 'conditional_field_function' ] ) AND $field[ 'conditional_field_function' ] === 'show' ) {

					?><script type="text/javascript">

						function <?= $show_function_name; ?>(){

							<?php if ( $field[ 'conditional_field_cond' ] === 'equal' ) { ?>

							if ( $( '[name="<?= $target_formatted_field_name; ?>"]' ).val() === '<?= $field[ 'conditional_field_values' ]; ?>' ) {

							<?php } else if ( $field[ 'conditional_field_cond' ] === 'different' AND $field[ 'conditional_field_values' ] === '' ) { ?>

							if ( $.trim( $( '[name="<?= $target_formatted_field_name; ?>"]' ).val() ).length > 0 ) {

							<?php } else if ( $field[ 'conditional_field_cond' ] === 'different' ) { ?>

							if ( $( '[name="<?= $target_formatted_field_name; ?>"]' ).val() !== '<?= $field[ 'conditional_field_values' ]; ?>' ) {

							<?php } ?>

								$( '#<?= $target_field_id; ?>' ).show();
								$( '#<?= $target_field_id; ?>' ).find( '[name="no_validation_fields[<?= $field_name; ?>]"]' ).remove();

							}
							else {

								$( '#<?= $target_field_id; ?>' ).hide();

								if ( ! $( '[name="fields_ignore_validation[<?= $field_name; ?>]"]' ).length ) {

									$( '#<?= $target_field_id; ?>' ).append( '<input type="hidden" name="no_validation_fields[<?= $field_name; ?>]" value="<?= $field_name; ?>" />' );

								}

							}

						};

						$( document ).bind( 'ready', function(){

							$( '[name="<?= $target_formatted_field_name; ?>"]' ).bind( 'change keyup', function(){

								<?= $show_function_name; ?>();

							});

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
