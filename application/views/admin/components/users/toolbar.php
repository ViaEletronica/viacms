		
		<h1 class="component-name"><?= vui_el_button( array( 'url' => 'admin/' . $component_name . '/users_management/users_list', 'text' => lang( $component_name ), 'icon' => $component_name, ) ); ?></h1><?php
		
		echo vui_el_button( array( 'url' => 'admin/' . $component_name . '/users_management/add_user', 'text' => lang( 'new_user' ), 'icon' => 'add-user', 'only_icon' => TRUE, ) );
		
		echo vui_el_button( array( 'url' => 'admin/' . $component_name . '/users_groups_management/users_groups_list', 'text' => lang( 'users_groups' ), 'icon' => 'categories', 'only_icon' => TRUE, ) );
		
		echo vui_el_button( array( 'url' => 'admin/' . $component_name . '/users_groups_management/add_users_group', 'text' => lang( 'new_users_group' ), 'icon' => 'add-category', 'only_icon' => TRUE, ) );
		
		?>
		
		<?php //echo anchor('admin/'.$component_name.'/preferences/edit/'.$layout,lang('preferences'),'class="tb-btn tb-btn-preferences" title="'.lang('preferences').'"'); ?>