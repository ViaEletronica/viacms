
<div id="view-user-submit" class="view-user-submit">
	
	<div class="view-user-submit-inner info-items">
		
		<table>
			
			<?php foreach ( $submit_form[ 'fields' ] as $key => $field ) { ?>
				
				<?php
					
					$value_name = url_title( $field[ 'label' ], TRUE );
					$formatted_field_name = 'form[' . $value_name . ']';
					$value_value = ( isset( $post[ 'form' ][ $value_name ] ) ) ? $post[ 'form' ][ $value_name ] : ( ( isset( $user_submit[ 'data' ][ $value_name ] ) ) ? $user_submit[ 'data' ][ $value_name ] : '' );
					$error = form_error( $formatted_field_name, '<span class="msg-inline-error error">', '</span>' );
					
				?>
				
				<?php if ( ! in_array( $field[ 'field_type' ], array( 'html', 'button' ) ) ) { ?>
					
					<tr class="item-inner user-submit-info-item-inner">
						
						<td class="title user-submit-info-item-title info-item-title">
							
							<?= lang( $field[ 'label' ] ); ?>
							
						</td>
						
						<td class="value user-submit-info-item-value info-item-content">
							
							<?= $value_value; ?>
							
						</td>
						
					</tr>
					
				<?php } ?>
					
			<?php } ?>
			
		</table>
		
	</div>
	
</div>
