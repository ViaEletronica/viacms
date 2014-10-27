<?php
	
	$menu_items = array_menu_to_array_tree( $menu_items, 'id', 'parent' );
	
	echo ul_menu( $menu_items );
	
?>