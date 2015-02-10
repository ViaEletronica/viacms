<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' ); ?>

<?php foreach ( $submit_form[ 'fields' ] as $key => $field ) { ?>

	<?php

		$field_name = url_title( $field[ 'label' ], '-', TRUE );
		$formatted_field_name = 'form[' . $field_name . ']';
		$field_value = ( isset( $post[ 'form' ][ $field_name ] ) ) ? $post[ 'form' ][ $field_name ] : '';

	?>

	<?php if ( ! in_array( $field[ 'field_type' ], array( 'button', 'html' ) ) ) { ?>

		<?php if ( trim( $field_value ) !== '' ) { ?>

			<p>

				<?= $field[ 'label' ]; ?>: <?= $field_value; ?>

			</p>

		<?php } else if ( trim( $field_value ) === '' AND check_var( $submit_form[ 'params' ][ 'submit_form_sending_email_show_empty_fields' ] ) ) { ?>

			<p>

				<?= $field[ 'label' ]; ?>: <?= $field_value; ?>

			</p>

		<?php } ?>

	<?php } ?>

<?php } ?>

<hr />
