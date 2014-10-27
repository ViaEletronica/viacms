		
		<h1 class="component-name"><?= vui_el_button( array( 'url' => 'admin/' . $component_name . '/providers_management/providers_list', 'text' => lang( $component_name ), 'icon' => $component_name, ) ); ?></h1><?php
		
		echo vui_el_button( array( 'url' => 'admin/' . $component_name . '/providers_management/add_provider', 'text' => lang( 'add_customer' ), 'icon' => 'add-provider', 'only_icon' => TRUE, ) );
		
		?>