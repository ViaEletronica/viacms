<?php foreach ( $submit_forms as $key => $submit_form ) { ?>

------------------------------------------------------------------
------------------------------------------------------------------
<?= sprintf( lang( 'submit_form_title_sprintf' ), $submit_form[ 'title' ] ); ?> 
<?= sprintf( lang( 'submit_form_id_sprintf' ), $submit_form[ 'id' ] ); ?> 
------------------------------------------------------------------ 
	<?php foreach ( $submit_form[ 'users_submits' ] as $key => $user_submit ) { ?> 
	---------------------------
	<?= sprintf( lang( 'submit_form_user_submit_id_sprintf' ), $user_submit[ 'id' ] ); ?> 
	<?= sprintf( lang( 'submit_form_user_submit_datetime_sprintf' ), $user_submit[ 'submit_datetime' ] ); ?> 
	---------------------------
		
		<?php foreach ( $submit_form[ 'fields' ] as $key => $field ) {
			
			$value_name = url_title( $field[ 'label' ], TRUE );
			$formatted_field_name = 'form[' . $value_name . ']';
			$value_value = isset( $user_submit[ 'data' ][ $value_name ] ) ? $user_submit[ 'data' ][ $value_name ] : '';
			
			if ( ! in_array( $field[ 'field_type' ], array( 'html', 'button' ) ) ) {
				
				 echo $field[ 'label' ]; ?>: <?= $value_value; ?>
				
		<?php }
			
		} ?>
	<?php } ?>
	
<?php } ?>
