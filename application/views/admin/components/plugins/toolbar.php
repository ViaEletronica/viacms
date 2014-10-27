		
		<h1 class="component-name"><?= vui_el_button( array( 'url' => $list_link, 'text' => lang( $component_name ), 'icon' => $component_name, ) ); ?></h1><?php
		
		echo vui_el_button( array( 'url' => $add_link, 'text' => lang( 'add_submit_form' ), 'icon' => 'add', 'only_icon' => TRUE, ) );
		
		?>
		