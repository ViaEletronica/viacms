<?php
	
	$out = array();
	
	foreach ( $submit_forms as $sf_key => $submit_form ) {
		
		$sf_out = array();
		
		$sf_out[ 'id' ] = $submit_form[ 'id' ];
		$sf_out[ 'alias' ] = $submit_form[ 'alias' ];
		$sf_out[ 'title' ] = $submit_form[ 'title' ];
		$sf_out[ 'users_submits_count_results' ] = count( $submit_form[ 'users_submits' ] );
		$sf_out[ 'output_columns' ] = array();
		$sf_out[ 'users_submits' ] = array();
		
		foreach ( $submit_form[ 'fields' ] as $f_key => $field ) {
			
			if ( ! in_array( $field[ 'field_type' ], array( 'html', 'button' ) ) ) {
				
				$sf_out[ 'output_columns' ][ url_title( $field[ 'label' ], TRUE ) ] = array(
					
					'key' => $field[ 'key' ],
					'alias' => url_title( $field[ 'label' ], TRUE ),
					'title' => $field[ 'label' ],
					'type' => $field[ 'field_type' ],
					
				);
				
			}
			
		}
		
		foreach ( $submit_form[ 'users_submits' ] as $us_key => $user_submit ) {
			
			$sf_out[ 'users_submits' ][ $user_submit[ 'id' ] ][ 'id' ] = $user_submit[ 'id' ];
			$sf_out[ 'users_submits' ][ $user_submit[ 'id' ] ][ 'submit_datetime' ] = $user_submit[ 'submit_datetime' ];
			
			foreach ( $submit_form[ 'fields' ] as $f_key => $field ) {
				
				if ( ! in_array( $field[ 'field_type' ], array( 'html', 'button' ) ) ) {
					
					$value_name = url_title( $field[ 'label' ], TRUE );
					$formatted_field_name = 'form[' . $value_name . ']';
					$value_value = $user_submit[ 'data' ][ $value_name ];
					
					$sf_out[ 'users_submits' ][ $user_submit[ 'id' ] ][ $value_name ] = array(
						
						'field_key' => $field[ 'key' ],
						'field_alias' => $value_name,
						'field_title' => $field[ 'label' ],
						'value' => $value_value,
						
					);
					
				}
				
			}
			
		}
		
		$out[] = $sf_out;
		
	}echo json_encode( $out );
	
	//print_r( $out );
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	