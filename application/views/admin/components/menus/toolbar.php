<h1 class="component-name"><?= vui_el_button( array( 'url' => 'admin/' . $component_name . '/menu_types_management/menu_types_list', 'text' => lang( $component_name ), 'icon' => $component_name, ) ); ?></h1><?php

echo vui_el_button( array( 'url' => 'admin/' . $component_name . '/menu_types_management/add_menu_type', 'text' => lang( 'new_menu_type' ), 'icon' => 'add-menu', 'only_icon' => TRUE, ) );

echo vui_el_button( array( 'url' => $this->menus->get_mi_url( 'list', array( 'menu_type_id' => isset( $menu_type_id ) ? $menu_type_id : NULL ) ), 'text' => lang( 'menu_items' ), 'icon' => 'menu-items', 'only_icon' => TRUE, ) );

echo vui_el_button( array( 'url' => $this->menus->get_mi_url( 'select_menu_item_type', array( 'menu_type_id' => isset( $menu_type_id ) ? $menu_type_id : NULL ) ), 'text' => lang( 'new_menu_item' ), 'icon' => 'add-menu-item', 'only_icon' => TRUE, ) );

?>