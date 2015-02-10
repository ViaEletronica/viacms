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

					<fieldset id="submit-form-user_submit">

						<legend>

							<?= vui_el_button( array( 'text' => lang( 'user_submit' ), 'icon' => 'user_submit',  ) ); ?>

						</legend>

						<?php foreach ( $submit_form[ 'fields' ] as $key => $field ) { ?>

							<?php

								$field_name = url_title( $field[ 'label' ], '-', TRUE );
								$formatted_field_name = 'form[' . $field_name . ']';
								$field_value = ( isset( $post[ 'form' ][ $field_name ] ) ) ? $post[ 'form' ][ $field_name ] : ( ( isset( $user_submit[ 'data' ][ $field_name ] ) ) ? $user_submit[ 'data' ][ $field_name ] : '' );
								$error = form_error( $formatted_field_name, '<span class="msg-inline-error error">', '</span>' );

							?>

							<?php if ( $field[ 'field_type' ] == 'input_text' ) { ?>

								<div id="alias-container" class="vui-field-wrapper-inline">

									<?= form_label( lang( $field[ 'label' ] ) . ( $field[ 'field_is_required' ] ? ' <span class="submit-form-required">*</span> ' . $error : '' ) ); ?>

									<div class="submit-form-field-control">

										<?= form_input( array( 'id' => 'submit-form-' . $field_name, 'name' => $formatted_field_name, 'class' => 'form-element submit-form submit-form-' . $field_name ), $field_value ); ?>

									</div>

								</div>

							<?php } else if ( $field[ 'field_type' ] == 'combo_box' ) { ?>

								<div id="alias-container" class="vui-field-wrapper-inline">

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

									</div>

								</div>

							<?php } else if ( $field[ 'field_type' ] == 'textarea' ) { ?>

								<div id="alias-container" class="field-wrapper">

									<?= form_label( lang( $field[ 'label' ] ) . ( $field[ 'field_is_required' ] ? ' <span class="submit-form-required">*</span> ' . $error : '' ) ); ?>

									<div class="submit-form-field-control">

										<?= form_textarea( array( 'id' => 'submit-form-' . $field_name, 'name' => $formatted_field_name, 'class' => 'form-element submit-form submit-form-' . $field_name ), $field_value ); ?>

									</div>

								</div>

							<?php } ?>

						<?php } ?>

					</fieldset>

				</div>

			</div>

			<?= form_hidden( 'submit_form_id', @$submit_form[ 'id' ] ); ?>

		<?= form_close(); ?>

	</div>

</div>

<script type="text/javascript" >

$( document ).ready(function(){

	<?php if ( $this->plugins->load( 'yetii' ) ){ ?>

	/*************************************************/
	/**************** Criando as tabs ****************/

	makeTabs( $( '.tabs-wrapper' ), 'fieldset', 'legend' );

	/**************** Criando as tabs ****************/
	/*************************************************/

	<?php } ?>

});

</script>
