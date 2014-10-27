		
		<h1 class="component-name"><?= vui_el_button( array( 'url' => 'admin/' . $component_name . '/customers_management/customers_list', 'text' => lang( $component_name ), 'icon' => $component_name, ) ); ?></h1><?php
		
		echo vui_el_button( array( 'url' => 'admin/' . $component_name . '/customers_management/add_customer', 'text' => lang( 'add_customer' ), 'icon' => 'add-customer', 'only_icon' => TRUE, ) );
		
		echo vui_el_button( array( 'url' => 'admin/' . $component_name . '/categories_management/categories_list', 'text' => lang( 'categories' ), 'icon' => 'categories', 'only_icon' => TRUE, ) );
		
		echo vui_el_button( array( 'url' => 'admin/' . $component_name . '/categories_management/add_category', 'text' => lang( 'add_category' ), 'icon' => 'add-category', 'only_icon' => TRUE, ) );
		
		?>
		