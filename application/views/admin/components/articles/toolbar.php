<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<h1 class="component-name"><?= vui_el_button( array( 'url' => $this->articles->get_a_url( 'list' ), 'text' => lang( $component_name ), 'icon' => $component_name, ) ); ?></h1><?php

echo vui_el_button( array( 'url' => $this->articles->get_a_url( 'add' ), 'text' => lang( 'new_article' ), 'icon' => 'add-article', 'only_icon' => TRUE, ) );

echo vui_el_button( array( 'url' => $this->articles->get_c_url( 'list' ), 'text' => lang( 'categories' ), 'icon' => 'categories', 'only_icon' => TRUE, ) );

echo vui_el_button( array( 'url' => $this->articles->get_c_url( 'add' ), 'text' => lang( 'new_category' ), 'icon' => 'add-category', 'only_icon' => TRUE, ) );

echo vui_el_button( array( 'url' => 'admin/' . $component_name . '/component_config/edit_config', 'text' => lang( 'globals_configurations' ), 'icon' => 'config', 'only_icon' => TRUE, ) );

echo vui_el_button( array( 'url' => $this->articles->get_ag_url( 'add' ), 'text' => lang( 'new_gallery' ), 'icon' => 'gallery', 'only_icon' => TRUE, ) );

?>
