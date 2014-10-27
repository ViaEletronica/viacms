<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' ); ?>



<?php foreach ( $submit_form[ 'fields' ] as $key => $field ) { ?>
	
	<?php
		
		$field_name = url_title( $field[ 'label' ], TRUE );
		$formatted_field_name = 'form[' . $field_name . ']';
		$field_value = ( isset( $post[ 'form' ][ $field_name ] ) ) ? $post[ 'form' ][ $field_name ] : '';
		$error = form_error( $formatted_field_name, '<div class="msg-inline-error">', '</div>' );
		
	?>
	
	<?php if ( $field[ 'field_type' ] != 'button' AND $field[ 'field_type' ] != 'html' ) { ?>
		
		<p>
			
			<?= $field[ 'label' ]; ?>: <?= $field_value; ?>
			
		</p>
		
	<?php } ?>
	
<?php } ?>

<hr />
