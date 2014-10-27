		
		<h1 class="component-name"><?= vui_el_button( array( 'url' => 'admin/' . $component_name . '/menu_types_management/menu_types_list', 'text' => lang( $component_name ), 'icon' => $component_name, ) ); ?></h1><?php
		
		echo vui_el_button( array( 'url' => 'admin/' . $component_name . '/menu_types_management/add_menu_type', 'text' => lang( 'new_menu_type' ), 'icon' => 'add-menu', 'only_icon' => TRUE, ) );
		
		?>