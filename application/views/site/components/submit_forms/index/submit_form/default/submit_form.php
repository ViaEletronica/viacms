<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' ); ?>

<section class="submit-form <?= @$params['page_class']; ?>">
	
	<?php if ( @$params['show_page_content_title'] ) { ?>
	<header class="component-heading">
		
		<h1>
			
			<?php if ( @$params['show_title_as_link_on_detail_view'] AND $contact['name'] == @$this->mcm->html_data['content']['title'] ) { ?>
			<a href="<?= $contact[ 'url' ]; ?>"><?= @$this->mcm->html_data['content']['title']; ?></a>
			<?php } else { ?>
			<?= @$this->mcm->html_data['content']['title']; ?>
			<?php } ?>
			
		</h1>
		
	</header>
	<?php } ?>
	
	<div id="component-content" class="submit-form-wrapper">
		
		
		<?php
		
		$post = $this->input->post();
		
		?>
		
		<?= form_open_multipart( get_url( $this->uri->ruri_string() ), array( 'id' => 'contact-form', ) ); ?>
			
			<?php foreach ( $submit_form[ 'fields' ] as $key => $field ) {
					
					$field_name = url_title( $field[ 'label' ], TRUE );
					$formatted_field_name = 'form[' . $field_name . ']';
					$field_value = ( isset( $post[ 'form' ][ $field_name ] ) ) ? $post[ 'form' ][ $field_name ] : '';
					$error = form_error( $formatted_field_name, '<span class="msg-inline-error error">', '</span>' );
					
					if ( $field[ 'field_type' ] == 'html' ) {
					
					?><div class="submit-form-field-wrapper submit-form-field-wrapper-<?= $field_name; ?> submit-form-field-wrapper-<?= $field[ 'field_type' ]; ?> <?= ( $error ) ? 'form-error error' : ''; ?>">
						
						<div class="submit-form-field-control">
							
							<?= $field[ 'html' ]; ?>
							
						</div>
						
					</div><?php
					
				} else if ( $field[ 'field_type' ] == 'input_text' ) {
					
					 ?><div class="submit-form-field-wrapper submit-form-field-wrapper-<?= $field_name; ?> submit-form-field-wrapper-<?= $field[ 'field_type' ]; ?> <?= ( $error ) ? 'form-error error' : ''; ?>">
						
						<?= form_label( lang( $field[ 'label' ] ) . ( $field[ 'field_is_required' ] ? ' <span class="submit-form-required">*</span> ' . $error : '' ) ); ?>
						
						<div class="submit-form-field-control">
							
							<?= form_input( array( 'id' => 'submit-form-' . $field_name, 'name' => $formatted_field_name, 'class' => 'form-element submit-form submit-form-' . $field_name ), $field_value ); ?>
							
						</div>
						
					</div><?php 
					
				} else if ( $field[ 'field_type' ] == 'combo_box' ) {
					
					 ?><div class="submit-form-field-wrapper submit-form-field-wrapper-<?= $field_name; ?> submit-form-field-wrapper-<?= $field[ 'field_type' ]; ?> <?= ( $error ) ? 'form-error error' : ''; ?>">
						
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
						
					</div><?php 
					
				} else if ( $field[ 'field_type' ] == 'textarea' ) {
					
					 ?><div class="submit-form-field-wrapper submit-form-field-wrapper-<?= $field_name; ?> submit-form-field-wrapper-<?= $field[ 'field_type' ]; ?> <?= ( $error ) ? 'form-error error' : ''; ?>">
						
						<?= form_label( lang( $field[ 'label' ] ) . ( $field[ 'field_is_required' ] ? ' <span class="submit-form-required">*</span> ' . $error : '' ) ); ?>
						
						<div class="submit-form-field-control">
							
							<?= form_textarea( array( 'id' => 'submit-form-' . $field_name, 'name' => $formatted_field_name, 'class' => 'form-element submit-form submit-form-' . $field_name ), $field_value ); ?>
							
						</div>
						
					</div><?php 
					
				} else if ( $field[ 'field_type' ] == 'button' ) {
					
					 ?><div class="submit-form-field-wrapper submit-form-field-wrapper-<?= $field_name; ?> submit-form-field-wrapper-<?= $field[ 'field_type' ]; ?>">
						
						<div class="submit-form-field-control">
							
							<?= form_submit( array( 'id' => 'submit-form-' . $field_name, 'class' => 'button form-element submit-form submit-form-' . $field_name, 'name' => $formatted_field_name ), lang( $field[ 'label' ] ) ); ?>
							
						</div>
						
					</div><?php 
					
				}
				
			} ?>
			
		<?= form_close(); ?>
		
		<div class="clear">&nbsp;</div>
		
	</div>
	
</section>
