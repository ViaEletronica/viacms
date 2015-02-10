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

		$_tmp_array = array();

		foreach ( $submit_form[ 'fields' ] as $f_key => $field ) {

			if ( ! in_array( $field[ 'field_type' ], array( 'html', 'button' ) ) ) {

				$_tmp_array[ url_title( $field[ 'label' ], '-', TRUE ) ] = $field;

				$sf_out[ 'output_columns' ][ url_title( $field[ 'label' ], '-', TRUE ) ] = array(

					'key' => $field[ 'key' ],
					'alias' => url_title( $field[ 'label' ], '-', TRUE ),
					'title' => $field[ 'label' ],
					'type' => $field[ 'field_type' ],

				);

			}

		}

		foreach ( $submit_form[ 'users_submits' ] as $us_key => $user_submit ) {

			$sf_out[ 'users_submits' ][ $user_submit[ 'id' ] ][ 'id' ] = $user_submit[ 'id' ];
			$sf_out[ 'users_submits' ][ $user_submit[ 'id' ] ][ 'submit_datetime' ] = $user_submit[ 'submit_datetime' ];

			foreach ( $user_submit[ 'data' ] as $f_key => $field ) {

				$sf_out[ 'users_submits' ][ $user_submit[ 'id' ] ][ $f_key ] = array(

					'field_key' => isset( $_tmp_array[ $f_key ][ 'key' ] ) ? $_tmp_array[ $f_key ][ 'key' ] : 'null',
					'field_alias' => $f_key,
					'field_title' => isset( $_tmp_array[ $f_key ][ 'label' ] ) ? $_tmp_array[ $f_key ][ 'label' ] : $f_key,
					'value' => $field,

				);

			}

		}

		$out[] = $sf_out;

	}echo json_encode( $out );

	//print_r( $out );

















