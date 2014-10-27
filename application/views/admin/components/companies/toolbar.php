		
		<h1 class="component-name"><?= vui_el_button( array( 'url' => 'admin/' . $component_name . '/companies_management/companies_list', 'text' => lang( $component_name ), 'icon' => $component_name, ) ); ?></h1><?php
		
		echo vui_el_button( array( 'url' => 'admin/' . $component_name . '/companies_management/add_company', 'text' => lang( 'add_company' ), 'icon' => 'add-company', 'only_icon' => TRUE, ) );
		
		?>
		