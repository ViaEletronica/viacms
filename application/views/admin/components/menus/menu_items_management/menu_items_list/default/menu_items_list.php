		
		<div>
			
			<header class="component-head">
				
				<h1>
					
					<?= lang( 'menu_items' ); ?>
					
				</h1>
				
			</header>
			
			
			
			<?php if($menu_items) { ?>
			<table>
				<tr>
					<th>
						<?= lang('id'); ?>
					</th>
					<th>
						<?= lang('title'); ?>
					</th>
					<th>
						<?= lang('link'); ?>
					</th>
					<th>
						<?= lang('type'); ?>
					</th>
					<th>
						<?= lang('ordering'); ?>
					</th>
					
					<th>
						<?= lang('status'); ?>
					</th>
					
					<th>
						<?= lang('home_page'); ?>
					</th>
					
					<th class="op-column">
						<?= lang('operations'); ?>
					</th>
				</tr>
				
				<?php foreach( $menu_items as $menu_item) { ?>
				<tr class="menu-level-<?= $menu_item[ 'level' ]; ?> tree-level-<?= $menu_item[ 'level' ]; ?>">
					<td class="menu-id ta-center">
						<?= $menu_item[ 'id' ]; ?>
					</td>
					<td class="menu-title tree-title">
						<?php if ( $menu_item[ 'level' ] > 0 ){ ?>
						<?= vui_el_button( array( 'icon' => 'sub-item', 'only_icon' => TRUE, ) ); ?>
						<?php } ?>
						<?= anchor( $this->menus->get_mi_edit_url( $menu_item ) , $menu_item[ 'title' ], 'class="" title="' . lang('action_view') . '"' ); ?>
					</td>
					<td class="menu-link ta-center">
						<?= anchor( get_url( $menu_item[ 'link' ] ), $menu_item[ 'link' ], 'target="_blank" class="" title="' . lang( 'action_view' ) . '"' ); ?>
					</td>
					<td class="menu-item-type ta-center">
						<?= lang( $menu_item[ 'type' ] ); ?>
					</td>
					<td class="order">
						
						<?= form_open( get_url( $this->menus->get_mi_change_ordering_url() ), 'class="form-change-ordering"' ); ?>
						
							<?= vui_el_button( array( 'url' => $this->menus->get_mi_down_ordering_url( $menu_item ), 'text' => lang( 'down_ordering' ), 'icon' => 'up', 'only_icon' => TRUE, ) ); ?>
							
							<?= form_input( array( 'id'=>'ordering-' . $menu_item[ 'id' ], 'class'=>'inputbox-order', 'name' => 'ordering' ), set_value( 'ordering', $menu_item[ 'ordering' ] ) ); ?>
							
							<?= vui_el_button( array( 'url' => $this->menus->get_mi_up_ordering_url( $menu_item ), 'text' => lang( 'up_ordering' ), 'icon' => 'down', 'only_icon' => TRUE, ) ); ?>
							
						<?= form_close(); ?>
						
					</td>
					
					<td class="status">
						
						<?=
							
							vui_el_button( array(
							
								'url' => $menu_item[ 'status' ] == 0 ? $this->menus->get_mi_change_status_publish_url( $menu_item ) : $this->menus->get_mi_change_status_unpublish_url( $menu_item ),
								'text' => lang( $menu_item[ 'status' ] == 0 ? 'unpublished' : 'published' ),
								'icon' => ( $menu_item[ 'status' ] == 0 ? 'cancel unpublished' : 'ok published' ),
								'only_icon' => TRUE, )
								
							);
							
						?>
						
					</td>
					
					<td class="home-page">
						
						<?php
							
							if ( $menu_item[ 'home' ] == 0 ){
								
								echo vui_el_button( array(
									
									'url' => $this->menus->get_mi_set_home_page_url( $menu_item ),
									'text' => lang( 'is_not_home_page' ),
									'icon' => ( 'cancel' ),
									'only_icon' => TRUE, )
									
								);
								
							} else {
								
								echo vui_el_button( array(
									
									'text' => lang( 'is_home_page' ),
									'icon' => ( 'ok' ),
									'only_icon' => TRUE, )
									
								);
								
							}
							
						?>
						
					</td>
					
					<td class="operations">
						
						<?= vui_el_button( array( 'url' => $menu_item[ 'link' ], 'text' => lang( 'action_view' ), 'target' => '_blank', 'icon' => 'view', 'only_icon' => TRUE, ) ); ?>
						
						<?= vui_el_button( array( 'url' => $this->menus->get_mi_edit_url( $menu_item ), 'text' => lang( 'action_edit' ), 'icon' => 'edit', 'only_icon' => TRUE, ) ); ?>
						
						<?php if ( $menu_item[ 'home' ] != '1' ){ ?>
						
						<?= vui_el_button( array( 'url' => $this->menus->get_mi_remove_url( $menu_item ), 'text' => lang( 'action_delete' ), 'icon' => 'remove', 'only_icon' => TRUE, ) ); ?>
						
						<?php } else { ?>
						
						<?= vui_el_button( array( 'text' => lang( 'you_cant_delete_home_page' ), 'icon' => 'remove disabled', 'only_icon' => TRUE, ) ); ?>
						
						<?php } ?>
						
					</td>
				</tr>
				<?php }; ?>
			</table>
			<?php } else { ?>
			
			<p>
				<?= lang('menu_no_items_message'); ?>
				<?= anchor('admin/'.$component_name.'/' . $component_function . '/add/'.$layout . '/' . $menu_type_id,lang('new_menu_item'),'class="" title="'.lang('action_add').'"'); ?>
			</p>
			
			<?php } ?>
			
		</div>