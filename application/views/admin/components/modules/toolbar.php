		
		<h1 class="component-name"><?= vui_el_button( array( 'url' => 'admin/' . $component_name . '/mm/a/ml', 'text' => lang( $component_name ), 'icon' => $component_name, ) ); ?></h1><?php
		
		echo vui_el_button( array( 'url' => $add_link, 'text' => lang( 'add_module' ), 'icon' => 'add', 'only_icon' => TRUE, ) );
		
		echo vui_el_button( array( 'url' => 'admin/' . $component_name . '/component_config/edit_config', 'text' => lang( 'globals_configurations' ), 'icon' => 'config', 'only_icon' => TRUE, ) );
		
		?>
		