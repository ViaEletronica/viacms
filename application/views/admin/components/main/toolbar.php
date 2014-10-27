		
		<h1 class="component-name"><?= vui_el_button( array( 'url' => 'admin/' . $component_name . '/config_management/config_list', 'text' => lang( $component_name ), 'icon' => $component_name, ) ); ?></h1><?php
		
		echo vui_el_button( array( 'url' => 'admin/' . $component_name . '/config_management/global_config', 'text' => lang( 'globals_configurations' ), 'icon' => 'config', 'only_icon' => TRUE, ) );
		
		?>
		