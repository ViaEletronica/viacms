<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<h1 class="component-name"><?= vui_el_button( array( 'url' => $this->articles->get_a_url( 'list' ), 'text' => lang( $component_name ), 'icon' => $component_name, ) ); ?></h1><?php

echo vui_el_button( array( 'url' => $this->articles->get_a_url( 'add' ), 'text' => lang( 'new_article' ), 'icon' => 'add-article', 'only_icon' => TRUE, ) );

echo vui_el_button( array( 'url' => $this->articles->get_c_url( 'list' ), 'text' => lang( 'categories' ), 'icon' => 'categories', 'only_icon' => TRUE, ) );

echo vui_el_button( array( 'url' => $this->articles->get_c_url( 'add' ), 'text' => lang( 'new_category' ), 'icon' => 'add-category', 'only_icon' => TRUE, ) );

echo vui_el_button( array( 'url' => 'admin/' . $component_name . '/component_config/edit_config', 'text' => lang( 'globals_configurations' ), 'icon' => 'config', 'only_icon' => TRUE, ) );

?>

<div class="search-toolbar-wrapper fr">
	
	<?php
		
		$search_box_params = array(
			
			'url' => $this->articles->get_a_url( 'search' ),
			'terms' => isset( $search[ 'terms' ] ) ? $search[ 'terms' ] : '',
			'wrapper_class' => 'search-toolbar-wrapper fr',
			'name' => 'terms',
			'cancel_url' => $this->articles->get_a_url( 'cancel_search' ),
			'live_search_url' => $this->articles->get_ajax_url( 'search' ),
			
		);
		
		echo vui_el_search( $search_box_params );
		
	?>
	
	<div class="clear"></div>
	
</div>
