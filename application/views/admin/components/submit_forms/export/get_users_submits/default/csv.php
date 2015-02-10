<?php

	$out = array();

	foreach ( $submit_forms as $sf_key => $submit_form ) {

		if ( count( $submit_form[ 'users_submits' ] ) > 0 ){

			$sf_out = & $out[];

			$sf_out[] = lang( 'submit_form_id' );
			$sf_out[] = lang( 'submit_form_title' );
			$sf_out[] = lang( 'user_submit_id' );
			$sf_out[] = lang( 'submit_datetime' );

			foreach ( $submit_form[ 'fields' ] as $f_key => $field ) {

				if ( ! in_array( $field[ 'field_type' ], array( 'html', 'button' ) ) ) {

					$sf_out[] = $field[ 'label' ];

				}

			}

			foreach ( $submit_form[ 'users_submits' ] as $us_key => $user_submit ) {

				$us_out = & $out[];

				$us_out[] = $user_submit[ 'submit_form_id' ];
				$us_out[] = $user_submit[ 'submit_form_title' ];
				$us_out[] = $user_submit[ 'id' ];
				$us_out[] = $user_submit[ 'submit_datetime' ];

				foreach ( $submit_form[ 'fields' ] as $f_key => $field ) {

					if ( ! in_array( $field[ 'field_type' ], array( 'html', 'button' ) ) ) {

						$value_name = url_title( $field[ 'label' ], '-', TRUE );
						$formatted_field_name = 'form[' . $value_name . ']';
						$value_value = isset( $user_submit[ 'data' ][ $value_name ] ) ? $user_submit[ 'data' ][ $value_name ] : '';

						$us_out[] = $value_value;

					}

				}

			}

			$out[] = array();

		}

	}

	$this->load->helper( 'csv' );

	if ( $download ){

		$delimiter = isset( $submit_form[ 'params' ][ 'submit_form_export_csv_delimiter' ] ) ? $submit_form[ 'params' ][ 'submit_form_export_csv_delimiter' ] : '';
		$enclosure = isset( $submit_form[ 'params' ][ 'submit_form_export_csv_enclosure' ] ) ? $submit_form[ 'params' ][ 'submit_form_export_csv_enclosure' ] : '';

		array_to_csv( array_values( $out ), $dl_filename, $delimiter, $enclosure );

	}
	else {

		echo array_to_csv( $out );

	}

	/*
	foreach ( $out as $l_key => $line ) {

		if ( gettype( $line ) === 'array' ){

			echo join( ';', $line ) . "\n";

		}
		else {

			echo $line;

		}

	}
	*/
	//print_r( $out );

















