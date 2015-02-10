
		<h1 class="component-name"><?= vui_el_button( array( 'url' => $c_urls[ 'sf_list_link' ], 'text' => lang( $component_name ), 'icon' => $component_name, ) ); ?></h1><?php

		echo vui_el_button( array( 'url' => $c_urls[ 'sf_add_link' ], 'text' => lang( 'add_submit_form' ), 'icon' => 'add', 'only_icon' => TRUE, ) );

		if ( check_var( $submit_form_id ) ){

			echo vui_el_button( array( 'url' => $c_urls[ 'us_list_link' ] . '/sfid/' . $submit_form_id, 'text' => lang( 'users_submits' ), 'icon' => 'users_submits', 'only_icon' => TRUE, ) );

		}
		else {

			//echo vui_el_button( array( 'url' => $c_urls[ 'us_list_link' ], 'text' => lang( 'users_submits' ), 'icon' => 'users_submits', 'only_icon' => TRUE, ) );

		}
		if ( check_var( $c_urls[ 'back_link' ] ) ){

			//echo vui_el_button( array( 'url' => $c_urls[ 'back_link' ], 'text' => lang( 'back' ), 'icon' => 'back', 'only_icon' => TRUE, 'check_current_url' => FALSE, ) );

		}

		?>
