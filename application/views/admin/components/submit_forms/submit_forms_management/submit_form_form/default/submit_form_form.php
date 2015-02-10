<?php

	$this->plugins->load( NULL, 'js_text_editor' );
	$this->plugins->load( NULL, 'js_time_picker' );

	$created_date_time = ( @$article->created_date ) ? strtotime( $article->created_date ) : gmt_to_local( time(), $this->mcm->filtered_system_params[ 'time_zone' ], TRUE );

	$created_date = $this->input->post( 'created_date' ) ? $this->input->post( 'created_date' ) : date( 'Y-m-d', gmt_to_local( now(), $this->mcm->filtered_system_params[ 'time_zone' ] ) );

	$created_time = $this->input->post( 'created_time' ) ? $this->input->post( 'created_time' ) : date( 'H:i:s', gmt_to_local( now(), $this->mcm->filtered_system_params[ 'time_zone' ] ) );

?>


<div id="global-config-form-wrapper" class="form-wrapper tabs-wrapper">

	<div class="form-wrapper-sub tabs-children">

		<?= form_open_multipart( get_url( 'admin' . $this->uri->ruri_string() ), array( 'id' => 'submit-form-form', ) ); ?>

			<div class="form-actions to-toolbar">

				<?= vui_el_button( array( 'text' => lang( 'action_save' ), 'icon' => 'save', 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit', 'id' => 'submit', 'only_icon' => TRUE, 'form' => 'submit-form-form', ) ); ?>

				<?= vui_el_button( array( 'text' => lang( 'action_apply' ), 'icon' => 'apply', 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit_apply', 'id' => 'submit-apply', 'only_icon' => TRUE, 'form' => 'submit-form-form', ) ); ?>

				<?= vui_el_button( array( 'text' => lang( 'action_cancel' ), 'icon' => 'cancel', 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit_cancel', 'id' => 'submit-cancel', 'only_icon' => TRUE, 'form' => 'submit-form-form', ) ); ?>

			</div>

			<header class="form-header tabs-header">

				<h1>

					<?php if ( $component_function_action == 'asf' ) { ?>

					<?= lang( 'new_submit_form' ); ?>

					<?php } else if ( $component_function_action == 'esf' ) { ?>

					<?= lang( 'edit_submit_form' ); ?>

					<?php } ?>

				</h1>

			</header>

			<div class="form-items tabs-items">

				<div class="form-item">

					<fieldset id="submit-form-basic-details">

						<legend>

							<?= vui_el_button( array( 'text' => lang( 'basic_details' ), 'icon' => 'basic-details',  ) ); ?>

						</legend>

						<div id="title-container" class="vui-field-wrapper-inline">

							<?= form_error( 'title', '<div class="msg-inline-error">', '</div>' ); ?>
							<?= form_label( lang( 'title' ) ); ?>
							<?= form_input( array( 'id'=>'title', 'name'=>'title' ), isset( $submit_form[ 'title' ] ) ? $submit_form[ 'title' ] : '','autofocus' ); ?>

						</div>

						<div id="alias-container" class="vui-field-wrapper-inline">

							<?= form_error( 'alias', '<div class="msg-inline-error">', '</div>' ); ?>
							<?= form_label( lang( 'alias' ) ); ?>
							<?= form_input( array( 'id'=>'alias', 'name'=>'alias' ), isset( $submit_form[ 'alias' ] ) ? $submit_form[ 'alias' ] : '' ); ?>

						</div>

						<div class="divisor-h"></div>

					</fieldset>

				</div>

				<div class="form-item">

					<fieldset id="submit-form-fields">

						<legend>

							<?= vui_el_button( array( 'text' => lang( 'fields' ), 'icon' => 'submit-forms',  ) ); ?>

						</legend>

						<?php

							$field_type_options = array(

								'input_text' => lang( 'input_text' ),
								'textarea' => lang( 'textarea' ),
								'combo_box' => lang( 'combo_box' ),
								'button' => lang( 'button' ),
								'html' => lang( 'html' ),
								'articles' => lang( 'articles' ),
								'date' => lang( 'date' ),

							);

							$field_type_default = 'input_text';

						?>

						<?php if ( isset( $submit_form[ 'fields' ] ) AND is_array( $submit_form[ 'fields' ] ) ) { ?>

						<?php

							$conditional_fields_targets = array();

							foreach( $submit_form[ 'fields' ] as $target_field_key => $target_field ) {

								// se o tipo de campo não for HTML ou button...
								// Objetivo: não queremos aplicar condições para os campos do tipo HTML nem button
								if ( ! in_array( $target_field[ 'field_type' ], array( 'html', 'button' ) ) ){

									$conditional_fields_targets[ $target_field_key ] = $target_field;

								}
								if ( ! in_array( $target_field[ 'field_type' ], array( 'html', 'button' ) ) ){

									$conditional_fields_targets[ $target_field_key ][ 'label' ] = $submit_form[ 'fields' ][ $target_field_key ][ 'label' ] = isset( $target_field[ 'label' ] ) ? $target_field[ 'label' ] : lang( 'field' ) . ' ' . $target_field_key;

								}

							}

						?>

						<div id="fields-wrapper">

						<?php foreach( $submit_form[ 'fields' ] as $key => $field ) { ?>

							<div class="field-wrapper">

								<div class="content">

									<?php $current_field = 'type'; ?>
									<div class="vui-field-wrapper-inline">

										<?= form_label( lang( 'field_type' ) ); ?>
										<?= form_dropdown( 'fields[' . $key . '][field_' . $current_field . ']', $field_type_options, isset( $field[ 'field_' . $current_field ] ) ? $field[ 'field_' . $current_field ] : $field_type_default, 'class="sf-field-' . $current_field . '" id="field-' . $current_field . '-' . $key . '"'); ?>

									</div>

									<?php $current_field = 'key'; ?>
									<?= form_error( $current_field . '_' . $key, '<div class="msg-inline-error">', '</div>' ); ?>
									<div class="vui-field-wrapper-inline field-key-wrapper">

										<?= form_label( lang( 'field_key' ) ); ?>
										<?= form_input_number( array(

											'id' => 'field-' . $current_field . '-' . $key,
											'name' => 'fields[' . $key . '][' . $current_field . ']',
											'class' => 'sf-field-' . $current_field,
											'title' => lang( 'tip_field_' . $current_field )

										), isset( $field[ $current_field ] ) ? $field[ $current_field ] : $key ); ?>

									</div>

									<?php $current_field = 'label'; ?>
									<?= form_error( $current_field . '_' . $key, '<div class="msg-inline-error">', '</div>' ); ?>
									<div class="vui-field-wrapper-inline">

										<?= form_label( lang( $current_field ) ); ?>
										<?= form_input( array(

											'id' => 'field-' . $current_field . '-' . $key,
											'name' => 'fields[' . $key . '][' . $current_field . ']',
											'class' => 'sf-field-' . $current_field,
											'title' => lang( 'tip_field_' . $current_field )

										), isset( $field[ $current_field ] ) ? $field[ $current_field ] : lang( 'field' ) . ' ' . $key ); ?>

									</div>

									<hr />

									<?php if ( $field[ 'field_type' ] === 'articles' ){

										$current_field = 'articles_category_id';
										$options = array(

											0 => lang( 'uncategorized' ),
											-1 => lang( 'all_articles' ),

										);

										if ( check_var( $articles_categories ) ){

											foreach( $articles_categories as $category ){

												$options[ $category[ 'id' ] ] = $category[ 'indented_title' ];

											};

										}

									?>

										<div class="vui-field-wrapper-inline">

											<?= form_label( lang( 'select_a_articles_category' ) ); ?>
											<?= form_error( $current_field . '_' . $key, '<div class="msg-inline-error">', '</div>' ); ?>
											<?= form_dropdown( 'fields[' . $key . '][' . $current_field . ']', $options, isset( $field[ $current_field ] ) ? $field[ $current_field ] : 0, 'id="field-' . $current_field . '-' . $key . '"' . ' class="sf-field-' . $current_field . '"' ); ?>

										</div>

									<hr />

									<?php } ?>

									<?php if ( $field[ 'field_type' ] === 'date' ){ ?>

										<?php $current_field = 'sf_date_field_day_min_value'; ?>

										<div class="vui-field-wrapper-inline">

											<?= form_label( lang( 'sf_date_field_day_min_value' ) ); ?>
											<?= form_error( $current_field . '_' . $key, '<div class="msg-inline-error">', '</div>' ); ?>
											<?= form_input_number( array(

												'id' => 'field-' . $current_field . '-' . $key,
												'name' => 'fields[' . $key . '][' . $current_field . ']',
												'min' => 1,
												'max' => 31,
												'class' => 'sf-field-date sf-field-date-day-min field-' . $current_field,
												'title' => lang( 'tip_field_' . $current_field )

											), isset( $field[ $current_field ] ) ? $field[ $current_field ] : 1 ); ?>

										</div>

										<?php $current_field = 'sf_date_field_day_max_value'; ?>

										<div class="vui-field-wrapper-inline">

											<?= form_label( lang( 'sf_date_field_day_max_value' ) ); ?>
											<?= form_error( $current_field . '_' . $key, '<div class="msg-inline-error">', '</div>' ); ?>
											<?= form_input_number( array(

												'id' => 'field-' . $current_field . '-' . $key,
												'name' => 'fields[' . $key . '][' . $current_field . ']',
												'min' => 1,
												'max' => 31,
												'class' => 'sf-field-date sf-field-date-day-max field-' . $current_field,
												'title' => lang( 'tip_field_' . $current_field )

											), isset( $field[ $current_field ] ) ? $field[ $current_field ] : 31 ); ?>

										</div>

										<?php $current_field = 'sf_date_field_month_min_value'; ?>

										<div class="vui-field-wrapper-inline">

											<?= form_label( lang( 'sf_date_field_month_min_value' ) ); ?>
											<?= form_error( $current_field . '_' . $key, '<div class="msg-inline-error">', '</div>' ); ?>
											<?= form_input_number( array(

												'id' => 'field-' . $current_field . '-' . $key,
												'name' => 'fields[' . $key . '][' . $current_field . ']',
												'min' => 1,
												'max' => 12,
												'class' => 'sf-field-date sf-field-date-month-min field-' . $current_field,
												'title' => lang( 'tip_field_' . $current_field )

											), isset( $field[ $current_field ] ) ? $field[ $current_field ] : 1 ); ?>

										</div>

										<?php $current_field = 'sf_date_field_month_max_value'; ?>

										<div class="vui-field-wrapper-inline">

											<?= form_label( lang( 'sf_date_field_month_max_value' ) ); ?>
											<?= form_error( $current_field . '_' . $key, '<div class="msg-inline-error">', '</div>' ); ?>
											<?= form_input_number( array(

												'id' => 'field-' . $current_field . '-' . $key,
												'name' => 'fields[' . $key . '][' . $current_field . ']',
												'min' => 1,
												'max' => 12,
												'class' => 'sf-field-date sf-field-date-month-max field-' . $current_field,
												'title' => lang( 'tip_field_' . $current_field )

											), isset( $field[ $current_field ] ) ? $field[ $current_field ] : 12 ); ?>

										</div>

										<?php $current_field = 'sf_date_field_year_min_value'; ?>

										<div class="vui-field-wrapper-inline">

											<?= form_label( lang( 'sf_date_field_year_min_value' ) ); ?>
											<?= form_error( $current_field . '_' . $key, '<div class="msg-inline-error">', '</div>' ); ?>
											<?= form_input_number( array(

												'id' => 'field-' . $current_field . '-' . $key,
												'name' => 'fields[' . $key . '][' . $current_field . ']',
												'min' => 1920,
												'max' => date( 'Y' ),
												'class' => 'sf-field-date sf-field-date-year-min field-' . $current_field,
												'title' => lang( 'tip_field_' . $current_field )

											), isset( $field[ $current_field ] ) ? $field[ $current_field ] : 1920 ); ?>

										</div>

										<?php $current_field = 'sf_date_field_year_max_value'; ?>

										<div class="vui-field-wrapper-inline">

											<?= form_label( lang( 'sf_date_field_year_max_value' ) ); ?>
											<?= form_error( $current_field . '_' . $key, '<div class="msg-inline-error">', '</div>' ); ?>
											<?= form_input_number( array(

												'id' => 'field-' . $current_field . '-' . $key,
												'name' => 'fields[' . $key . '][' . $current_field . ']',
												'min' => 1920,
												'max' => date( 'Y' ),
												'class' => 'sf-field-date sf-field-date-year-max field-' . $current_field,
												'title' => lang( 'tip_field_' . $current_field )

											), isset( $field[ $current_field ] ) ? $field[ $current_field ] : date( 'Y' ) ); ?>

										</div>

									<hr />

									<?php } ?>

									<?php $current_field = 'conditional_field'; ?>
									<div class="vui-field-wrapper-inline">

										<?= form_label( lang( 'conditional_field' ) ); ?>
										<?php

											$options = array(

												'1' => lang( 'yes' ),
												'0' => lang( 'no' ),

											);

										?>
										<?= form_dropdown( 'fields[' . $key . '][' . $current_field . ']', $options, isset( $field[ $current_field ] ) ? $field[ $current_field ] : 0, 'id="field-' . $current_field . '-' . $key . '"' . ' class="sf-field-' . $current_field . '"' ); ?>

									</div>

									<?php $current_field = 'conditional_field_function'; ?>
									<div class="vui-field-wrapper-inline">

										<?= form_label( lang( 'conditional_field_function' ) ); ?>
										<?php

											$options = array(

												'show' => lang( 'show' ),

											);

										?>
										<?= form_dropdown( 'fields[' . $key . '][' . $current_field . ']', $options, isset( $field[ $current_field ] ) ? $field[ $current_field ] : 0, 'id="field-' . $current_field . '-' . $key . '"' . ' class="sf-field-' . $current_field . '"' ); ?>

									</div>

									<?php $current_field = 'conditional_target_field'; ?>
									<div class="vui-field-wrapper-inline">

										<?= form_label( lang( 'conditional_target_field' ) ); ?>
										<?php

											//print_r( $field );

											$options = array();

											foreach( $conditional_fields_targets as $key_2 => $field_cond ) {

												// se o campo no loop principal for diferente do campo neste loop
												// Objetivo: não queremos o próprio na lista de campos que influenciam as condições
												// E também não queremos aplicar condições para os campos do tipo HTML nem button
												if ( $field_cond[ 'key' ] !== $field[ 'key' ] ){

													$options[ $field_cond[ 'label' ] ] = $field_cond[ 'label' ];

												}

											}

										?>
										<?= form_dropdown( 'fields[' . $key . '][' . $current_field . ']', $options, isset( $field[ $current_field ] ) ? $field[ $current_field ] : 0, 'id="field-' . $current_field . '-' . $key . '"' . ' class="sf-field-' . $current_field . '"' ); ?>

									</div>

									<?php $current_field = 'conditional_field_cond'; ?>
									<div class="vui-field-wrapper-inline">

										<?= form_label( lang( 'conditional_field_cond' ) ); ?>
										<?php

											$options = array(

												'equal' => lang( 'equal' ),
												'different' => lang( 'different_of' ),

											);

										?>
										<?= form_dropdown( 'fields[' . $key . '][' . $current_field . ']', $options, isset( $field[ $current_field ] ) ? $field[ $current_field ] : 0, 'id="field-' . $current_field . '-' . $key . '"' . ' class="sf-field-' . $current_field . '"' ); ?>

									</div>

									<?php $current_field = 'conditional_field_values'; ?>
									<div class="vui-field-wrapper-inline">

										<?= form_label( lang( $current_field ) ); ?>
										<?= form_input( array( 'id' => 'field-' . $current_field . '-' . $key, 'name' => 'fields[' . $key . '][' . $current_field . ']', 'class' => 'sf-field-' . $current_field, 'title' => lang( 'tip_field_' . $current_field ) ), isset( $field[ $current_field ] ) ? $field[ $current_field ] : '' ); ?>

									</div>

									<hr />

									<?php if ( ! in_array( $field[ 'field_type' ], array( 'button', 'html', 'date' ) ) ){ ?>

										<?php $current_field = 'field_is_required'; ?>
										<div class="vui-field-wrapper-inline">

											<?= form_label( lang( 'field_is_required' ) ); ?>
											<?php

												$options = array(

													'1' => lang( 'yes' ),
													'0' => lang( 'no' ),

												);

											?>
											<?= form_dropdown( 'fields[' . $key . '][' . $current_field . ']', $options, isset( $field[ $current_field ] ) ? $field[ $current_field ] : 0, 'id="field-' . $current_field . '-' . $key . '"' . ' class="sf-field-' . $current_field . '"' ); ?>

										</div>

										<?php $current_field = 'validation_rule'; ?>
										<div class="vui-field-wrapper-inline">

											<?= form_label( lang( 'validation_rule' ) ); ?>
											<?php

												$options = array(

													'matches' => lang( 'submit_forms_validation_rule_matches' ),
													'valid_email' => lang( 'submit_forms_validation_rule_valid_email' ),
													'valid_email_dns' => lang( 'submit_forms_validation_rule_valid_email_dns' ),
													'valid_emails' => lang( 'submit_forms_validation_rule_valid_emails' ),
													'min_length' => lang( 'submit_forms_validation_rule_min_length' ),
													'max_length' => lang( 'submit_forms_validation_rule_max_length' ),
													'exact_length' => lang( 'submit_forms_validation_rule_exact_length' ),
													'greater_than' => lang( 'submit_forms_validation_rule_greater_than' ),
													'less_than' => lang( 'submit_forms_validation_rule_less_than' ),
													'alpha' => lang( 'submit_forms_validation_rule_alpha' ),
													'alpha_numeric' => lang( 'submit_forms_validation_rule_alpha_numeric' ),
													'alpha_dash' => lang( 'submit_forms_validation_rule_alpha_dash' ),
													'numeric' => lang( 'submit_forms_validation_rule_numeric' ),
													'integer' => lang( 'submit_forms_validation_rule_integer' ),
													'decimal' => lang( 'submit_forms_validation_rule_decimal' ),
													'is_natural' => lang( 'submit_forms_validation_rule_is_natural' ),
													'is_natural_no_zero' => lang( 'submit_forms_validation_rule_is_natural_no_zero' ),
													'valid_ip' => lang( 'submit_forms_validation_rule_valid_ip' ),
													'valid_base64' => lang( 'submit_forms_validation_rule_valid_base64' ),

												);

											?>
											<?= form_multiselect( 'fields[' . $key . '][' . $current_field . '][]', $options, isset( $field[ $current_field ] ) ? $field[ $current_field ] : '', 'id="field-' . $current_field . '-' . $key . '"' . ' class="sf-field-' . $current_field . '"' . ' size="' . count( $options ) . '"' ); ?>

										</div>

									<?php } ?>

									<?php if ( isset( $field[ 'validation_rule' ] ) ){ ?>

										<?php foreach ( $field[ 'validation_rule' ] as $validation_key => $validation_rule ) { ?>

											<?php if ( in_array( $validation_rule, array( 'matches', 'min_length', 'max_length', 'exact_length', 'greater_than', 'less_than', ) ) ){ ?>

												<?php $current_field = 'validation_rule_parameter_' . $validation_rule; ?>
												<?= form_error( $current_field . '_' . $key, '<div class="msg-inline-error">', '</div>' ); ?>
												<div class="vui-field-wrapper-inline">

													<?= form_label( lang( $current_field ) ); ?>
													<?= form_input( array( 'id' => 'field-' . $current_field . '-' . $key, 'name' => 'fields[' . $key . '][' . $current_field . ']', 'class' => 'sf-field-' . $current_field, 'title' => lang( 'tip_field_' . $current_field ) ), isset( $field[ $current_field ] ) ? $field[ $current_field ] : '' ); ?>

												</div>

											<?php } ?>

										<?php } ?>

									<?php } ?>

									<?php // print_r( $field ); ?>

									<?php if ( ! in_array( $field[ 'field_type' ], array( 'html' ) ) ){ ?>

										<?php $current_field = 'description'; ?>
										<?= form_error( $current_field . '_' . $key, '<div class="msg-inline-error">', '</div>' ); ?>
										<div class="vui-field-wrapper-inline">

											<?= form_label( lang( $current_field ) ); ?>
											<?= form_input( array( 'id' => 'field-' . $current_field . '-' . $key, 'name' => 'fields[' . $key . '][' . $current_field . ']', 'class' => 'sf-field-' . $current_field, 'title' => lang( 'tip_field_' . $current_field ) ), isset( $field[ $current_field ] ) ? $field[ $current_field ] : '' ); ?>

										</div>

									<?php } ?>

									<?php if ( $field[ 'field_type' ] == 'html' ){ ?>

										<?php $current_field = 'html'; ?>
										<?= form_error( $current_field . '_' . $key, '<div class="msg-inline-error">', '</div>' ); ?>
										<div class="vui-field-wrapper-inline">

											<?= form_label( lang( $current_field ) ); ?>
											<?= form_textarea( array( 'id' => 'field-' . $current_field . '-' . $key, 'name' => 'fields[' . $key . '][' . $current_field . ']', 'class' => 'js-editor sf-field-' . $current_field, 'title' => lang( 'tip_field_' . $current_field ) ), isset( $field[ $current_field ] ) ? $field[ $current_field ] : '' ); ?>

										</div>

									<?php } else if ( $field[ 'field_type' ] == 'input_text' ){ ?>



									<?php } else if ( $field[ 'field_type' ] == 'combo_box' ){ ?>

									<?php $current_field = 'options'; ?>
									<?= form_error( $current_field . '_' . $key, '<div class="msg-inline-error">', '</div>' ); ?>
									<div class="vui-field-wrapper-inline">

										<?= form_label( lang( $current_field ) ); ?>
										<?= form_textarea( array( 'id' => 'field-' . $current_field . '-' . $key, 'name' => 'fields[' . $key . '][' . $current_field . ']', 'class' => 'sf-field-' . $current_field, 'title' => lang( 'tip_field_' . $current_field ) ), isset( $field[ $current_field ] ) ? $field[ $current_field ] : '' ); ?>

									</div>

									<?php } ?>

									<div class="vui-field-wrapper-inline submit-remove-field-wrapper">

										<?= form_label( '&nbsp;' ); ?>

										<?= vui_el_button( array( 'id' => 'submit-remove-field-' . $key, 'button_type' => 'button', 'name' => 'submit_remove_field[' . $key . ']', 'class' => 'btn btn-delete submit-remove-field', 'title' => lang( 'tip_remove_field' ), 'text' => lang( 'remove_field' ), 'icon' => 'remove',  ) ); ?>

									</div>

								</div>

							</div>

						<?php } ?>

						</div>

						<?php } ?>

						<br /><hr/><br />

						<h3><?= lang('add_field'); ?></h3>

						<div class="vui-field-wrapper-inline">

							<?= form_label( lang( 'field_type' ) ); ?>

							<?= form_dropdown( 'field_type_to_add', $field_type_options, isset( $submit_form[ 'field_type_to_add' ] ) ? $submit_form[ 'field_type_to_add' ] : $field_type_default, 'id="field-type-to-add"'); ?>

						</div>

						<div class="vui-field-wrapper-inline">

							<?= form_label( lang( 'enter_amount_fields' ) ); ?>

							<?= form_input_number(array( 'id' => 'field-fields-to-add', 'name' => 'field_fields_to_add', 'class' => 'add-num-field', 'title' => lang( 'tip_enter_amount_fields' ) ), 1 ); ?>

						</div>

						<div class="vui-field-wrapper-inline">

							<?= form_label( '&nbsp;' ); ?>

							<?= form_submit(array('id'=>'submit-add-field', 'class'=>'btn btn-add','name'=>'submit_add_field'),lang('add')); ?>

						</div>

					</fieldset>

				</div>

				<div class="form-item">

					<fieldset id="submit-form-params">

						<?php $current_field = 'type'; ?>

						<?php

						/* gerando o html dos parâmetros, ele deve ser chamado na view, não no controller,
						 * pois os erros de validação dos elementos dos parâmetros devem ser expostos
						 * após a chamada da função $this->form_validation->run()
						 */

						echo params_to_html( $params_spec, $final_params_values );

						?>

					</fieldset>

				</div>

			</div>

			<?= form_hidden( 'submit_form_id', @$submit_form[ 'id' ] ); ?>

		<?= form_close(); ?>

	</div>

</div>

<script type="text/javascript" >

$( document ).ready( function(){

	<?php if ( $this->plugins->load( 'yetii' ) ){ ?>

	/*************************************************/
	/**************** Criando as tabs ****************/

	makeTabs( $( '.tabs-wrapper' ), '#submit-form-basic-details, #submit-form-fields, .params-set-wrapper', 'legend, .params-set-title' );

	/**************** Criando as tabs ****************/
	/*************************************************/

	<?php } ?>






	/*************************************************/
	/************** Drag and drop code *************/

	$( '#fields-wrapper' ).addClass( 'sortable' );
	$( '#fields-wrapper .field-wrapper' ).addClass( 'sortable-item' );
	$( '#fields-wrapper .field-wrapper .content' ).before( '<div class="summary"/>' );
	$( '#fields-wrapper .field-wrapper .summary' ).append( '<div class="item sortable-handle"/>' );
	$( '#fields-wrapper .field-wrapper .summary' ).append( '<div class="item field-key"/>' );
	$( '#fields-wrapper .field-wrapper .summary' ).append( '<div class="item field-type"/>' );
	$( '#fields-wrapper .field-wrapper .summary' ).append( '<div class="item field-label"/>' );
	$( '#fields-wrapper .field-wrapper .summary' ).append( '<div class="item field-expand sortable-expander sortable-retracted"/>' );
	$( '#fields-wrapper .field-wrapper .summary' ).append( '<div class="item field-remove sortable-remove"/>' );

	$( '#fields-wrapper .field-wrapper .content' ).addClass( 'hidden' );
	$( '#fields-wrapper .field-wrapper .content .field-key-wrapper' ).addClass( 'hidden' );
	$( '#fields-wrapper .field-wrapper .content .submit-remove-field-wrapper' ).addClass( 'hidden' );

	$( ".sortable" ).sortable({

		//containment: "parent", // descomente para bloquear o movimento no container pai
		items: '.sortable-item',
		start: function(event, ui) {

			if ( is_tinyMCE_active ){

				tinyMCE.triggerSave();

			}

			ui.item.addClass( 'sorting' );

		},
		stop: function(event, ui) {

			ui.item.removeClass( 'sorting' );

		},
		handle: ".sortable-handle"

	});
	$( ".sortable" ).disableSelection();

	$( ".sortable" ).on( "sortout", function( event, ui ){

		updateKeys();

	});

	$( ".sortable .sortable-expander" ).bind( "click", function( event ){

		if ( $( this ).hasClass( 'sortable-expanded' ) ) {

			$( this ).removeClass( 'sortable-expanded' );
			$( this ).addClass( 'sortable-retracted' );
			$( this ).parent().parent().find( '.content' ).addClass( 'hidden' );

		}
		else {

			$( this ).addClass( 'sortable-expanded' );
			$( this ).removeClass( 'sortable-retracted' );
			$( this ).parent().parent().find( '.content' ).removeClass( 'hidden' );

		}

	});

	$( ".sortable .sortable-remove" ).bind( "click", function( event ){

		$( this ).parent().parent().remove();

		updateKeys();

	});

	// função de reordenação dos campos
	// ela deve atualizar as informações resumidas automaticamente
	// e logo após chamar a função para atualizar todos os sub-campos de cada campo
	function updateKeys(){

		$( '#fields-wrapper .field-wrapper' ).each( function( index ) {

			var newFieldKey = index + 1;
			var fieldLabel = $( this ).find( '.content .sf-field-label' ).val();
			var fieldType = $( this ).find( '.content .sf-field-type option:selected' ).text();

			$( this ).find( '.summary .field-key' ).text( newFieldKey );
			$( this ).find( '.summary .field-label' ).text( fieldLabel );
			$( this ).find( '.summary .field-type' ).text( fieldType );

		});

		updateFields();

	}

	// função de atualização dos atributos e valores dos campos
	// ela deve atualizar os atributos (id, name, etc.) automaticamente
	// baseado em suas respectivas keys (posições, com o index +1)
	function updateFields(){

		$( '#fields-wrapper .field-wrapper' ).each( function( index ) {

			var fieldKey = index + 1;
			var content = $( this ).find( '.content' );

			// type
			content.find( '.sf-field-type' ).attr( 'name', 'fields[' + fieldKey + '][field_type]' );
			content.find( '.sf-field-type' ).attr( 'id', 'field-type-' + fieldKey );

			// key
			content.find( '.sf-field-key' ).attr( 'name', 'fields[' + fieldKey + '][key]' );
			content.find( '.sf-field-key' ).attr( 'id', 'field-key-' + fieldKey );
			content.find( '.sf-field-key' ).attr( 'value', fieldKey );
			content.find( '.sf-field-key' ).val( fieldKey );

			// conditional_field
			content.find( '.sf-field-conditional_field' ).attr( 'name', 'fields[' + fieldKey + '][conditional_field]' );
			content.find( '.sf-field-conditional_field' ).attr( 'id', 'field-conditional_field-' + fieldKey );

			// options
			content.find( '.sf-field-options' ).attr( 'name', 'fields[' + fieldKey + '][options]' );
			content.find( '.sf-field-options' ).attr( 'id', 'field-options-' + fieldKey );

			// field_is_required
			content.find( '.sf-field-field_is_required' ).attr( 'name', 'fields[' + fieldKey + '][field_is_required]' );
			content.find( '.sf-field-field_is_required' ).attr( 'id', 'field-field_is_required-' + fieldKey );

			// validation_rule
			content.find( '.sf-field-validation_rule' ).attr( 'name', 'fields[' + fieldKey + '][validation_rule][]' );
			content.find( '.sf-field-validation_rule' ).attr( 'id', 'field-validation_rule-' + fieldKey );

			// validation_rule_parameter_matches
			content.find( '.sf-field-validation_rule_parameter_matches' ).attr( 'name', 'fields[' + fieldKey + '][validation_rule_parameter_matches]' );
			content.find( '.sf-field-validation_rule_parameter_matches' ).attr( 'id', 'field-validation_rule_parameter_matches-' + fieldKey );

			// validation_rule_parameter_min_length
			content.find( '.sf-field-validation_rule_parameter_min_length' ).attr( 'name', 'fields[' + fieldKey + '][validation_rule_parameter_min_length]' );
			content.find( '.sf-field-validation_rule_parameter_min_length' ).attr( 'id', 'field-validation_rule_parameter_min_length-' + fieldKey );

			// validation_rule_parameter_max_length
			content.find( '.sf-field-validation_rule_parameter_max_length' ).attr( 'name', 'fields[' + fieldKey + '][validation_rule_parameter_max_length]' );
			content.find( '.sf-field-validation_rule_parameter_max_length' ).attr( 'id', 'field-validation_rule_parameter_max_length-' + fieldKey );

			// validation_rule_parameter_exact_length
			content.find( '.sf-field-validation_rule_parameter_exact_length' ).attr( 'name', 'fields[' + fieldKey + '][validation_rule_parameter_exact_length]' );
			content.find( '.sf-field-validation_rule_parameter_exact_length' ).attr( 'id', 'field-validation_rule_parameter_exact_length-' + fieldKey );

			// validation_rule_parameter_greater_than
			content.find( '.sf-field-validation_rule_parameter_greater_than' ).attr( 'name', 'fields[' + fieldKey + '][validation_rule_parameter_greater_than]' );
			content.find( '.sf-field-validation_rule_parameter_greater_than' ).attr( 'id', 'field-validation_rule_parameter_greater_than-' + fieldKey );

			// validation_rule_parameter_less_than
			content.find( '.sf-field-validation_rule_parameter_less_than' ).attr( 'name', 'fields[' + fieldKey + '][validation_rule_parameter_less_than]' );
			content.find( '.sf-field-validation_rule_parameter_less_than' ).attr( 'id', 'field-validation_rule_parameter_less_than-' + fieldKey );

			// conditional_field_function
			content.find( '.sf-field-conditional_field_function' ).attr( 'name', 'fields[' + fieldKey + '][conditional_field_function]' );
			content.find( '.sf-field-conditional_field_function' ).attr( 'id', 'field-conditional_field_function-' + fieldKey );

			// conditional_target_field
			content.find( '.sf-field-conditional_target_field' ).attr( 'name', 'fields[' + fieldKey + '][conditional_target_field]' );
			content.find( '.sf-field-conditional_target_field' ).attr( 'id', 'field-conditional_target_field-' + fieldKey );

			// conditional_field_cond
			content.find( '.sf-field-conditional_field_cond' ).attr( 'name', 'fields[' + fieldKey + '][conditional_field_cond]' );
			content.find( '.sf-field-conditional_field_cond' ).attr( 'id', 'field-conditional_field_cond-' + fieldKey );

			// conditional_field_values
			content.find( '.sf-field-conditional_field_values' ).attr( 'name', 'fields[' + fieldKey + '][conditional_field_values]' );
			content.find( '.sf-field-conditional_field_values' ).attr( 'id', 'field-conditional_field_values-' + fieldKey );

			// label
			content.find( '.sf-field-label' ).attr( 'name', 'fields[' + fieldKey + '][label]' );
			content.find( '.sf-field-label' ).attr( 'id', 'field-label-' + fieldKey );

			// description
			content.find( '.sf-field-description' ).attr( 'name', 'fields[' + fieldKey + '][description]' );
			content.find( '.sf-field-description' ).attr( 'id', 'field-description-' + fieldKey );

			// html
			content.find( '.sf-field-html' ).attr( 'name', 'fields[' + fieldKey + '][html]' );
			content.find( '.sf-field-html' ).attr( 'id', 'field-html-' + fieldKey );

			// articles_category_id
			content.find( '.sf-field-articles_category_id' ).attr( 'name', 'fields[' + fieldKey + '][articles_category_id]' );
			content.find( '.sf-field-articles_category_id' ).attr( 'id', 'field-articles_category_id-' + fieldKey );

			// date
			content.find( '.sf-field-sf_date_field_day_min_value' ).attr( 'name', 'fields[' + fieldKey + '][sf_date_field_day_min_value]' );
			content.find( '.sf-field-sf_date_field_day_min_value' ).attr( 'id', 'field-sf_date_field_day_min_value-' + fieldKey );

			content.find( '.sf-field-sf_date_field_day_max_value' ).attr( 'name', 'fields[' + fieldKey + '][sf_date_field_day_max_value]' );
			content.find( '.sf-field-sf_date_field_day_max_value' ).attr( 'id', 'field-sf_date_field_day_max_value-' + fieldKey );

			content.find( '.sf-field-sf_date_field_month_min_value' ).attr( 'name', 'fields[' + fieldKey + '][sf_date_field_month_min_value]' );
			content.find( '.sf-field-sf_date_field_month_min_value' ).attr( 'id', 'field-sf_date_field_month_min_value-' + fieldKey );

			content.find( '.sf-field-sf_date_field_month_max_value' ).attr( 'name', 'fields[' + fieldKey + '][sf_date_field_month_max_value]' );
			content.find( '.sf-field-sf_date_field_month_max_value' ).attr( 'id', 'field-sf_date_field_month_max_value-' + fieldKey );

			content.find( '.sf-field-sf_date_field_year_min_value' ).attr( 'name', 'fields[' + fieldKey + '][sf_date_field_year_min_value]' );
			content.find( '.sf-field-sf_date_field_year_min_value' ).attr( 'id', 'field-sf_date_field_year_min_value-' + fieldKey );

			content.find( '.sf-field-sf_date_field_year_max_value' ).attr( 'name', 'fields[' + fieldKey + '][sf_date_field_year_max_value]' );
			content.find( '.sf-field-sf_date_field_year_max_value' ).attr( 'id', 'field-sf_date_field_year_max_value-' + fieldKey );



			// remove field button
			content.find( '.submit-remove-field' ).attr( 'name', 'submit_remove_field[' + fieldKey + ']' );
			content.find( '.submit-remove-field' ).attr( 'id', 'submit-remove-field-' + fieldKey );

		});

	}

	updateKeys();

	/************** Drag and drop code *************/
	/*************************************************/

});

</script>
