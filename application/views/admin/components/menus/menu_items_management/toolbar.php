		
		<?php require( dirname(__FILE__) . DS . '..' . DS . 'toolbar.php'); ?><?php
			
			echo vui_el_button( array( 'url' => $this->menus->get_mi_list_url(), 'text' => lang( 'menu_items' ), 'icon' => 'menu-items', 'only_icon' => TRUE, ) );
			
			echo vui_el_button( array( 'url' => $this->menus->get_mi_add_url(), 'text' => lang( 'new_menu_item' ), 'icon' => 'add-menu-item', 'only_icon' => TRUE, ) );
			
		?>