		
		<div>
			
			<header class="component-head">
				
				<h1>
					
					<?= lang( 'menu_items' ); ?>
					
				</h1>
				
			</header>
			
			<div class="form-actions to-toolbar">
				
				<?= form_open( get_url( 'admin' . $this->uri->ruri_string() . assoc_array_to_qs() ), array( 'id' => 'menus-filter-by-menu-type', ) ); ?>
				
					<div class="filter-fields-wrapper fields-wrapper-inline">
						
						<?php
							
							$field_name = 'menus_filter_by_menu_type';
							$field_error = form_error( $field_name, '<div class="msg-inline-error">', '</div>' );
							$field_attr = ( $field_error ? 'autofocus' : '' ) . ' ' .
								'id="' . $field_name . '" ' .
								'name="' . $field_name . '" ' .
								'form="menus-filter-by-menu-type" title="' . lang( 'filter_by_menu_type' ) . '" ' .
								'class="' . $field_name . ' ' . ( $field_error ? 'field-error' : '' ) . '"' . ( $field_error ? element_title( $field_error ) : '' );
							
							$field_options = array(
								
								-1 => lang( 'all_menu_items' ),
								
							);
							
							if ( check_var( $menu_types ) ){
								
								foreach( $menu_types as $menu_type ){
									
									$field_options[ $menu_type[ 'id' ] ] = $menu_type[ 'title' ];
									
								};
								
								
							}
							
						?>
						
						<?= form_dropdown( $field_name, $field_options, $filter_by_menu_type, $field_attr ); ?>
						
						<?= vui_el_button( array( 'text' => lang( 'action_apply_menu_types_filter' ), 'icon' => 'apply', 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit_filter_by_menu_type', 'id' => 'submit-filter-by-menu-type', 'only_icon' => TRUE, 'form' => 'menus-filter-by-menu-type', ) ); ?>
						
					</div>
					
				<?= form_close(); ?>
				
			</div>
			
			<div class="form-actions">
				
				<?= form_open( get_url( 'admin' . $this->uri->ruri_string() . assoc_array_to_qs() ), array( 'id' => 'change-ipp-form', ) ); ?>
				
					<div class="filter-fields-wrapper fields-wrapper-inline">
						
						<?php
							
							$field_name = 'ipp';
							$field_error = form_error( $field_name, '<div class="msg-inline-error">', '</div>' );
							$field_attr = ( $field_error ? 'autofocus' : '' ) . ' ' .
								'id="' . $field_name . '" ' .
								'name="' . $field_name . '" ' .
								'min="-1" ' .
								'form="change-ipp-form" ' .
								'title="' . lang( 'tip_change_items_per_page' ) . '" ' .
								'class="' . $field_name . ' ' . ( $field_error ? 'field-error' : '' ) . '"' . ( $field_error ? element_title( $field_error ) : '' );
							
						?>
						
						<?= form_input_number( $field_name, $ipp, $field_attr ); ?>
						
						<?= vui_el_button( array( 'text' => lang( 'action_change_ipp' ), 'icon' => 'apply', 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit_change_ipp', 'id' => 'submit-change-ipp', 'only_icon' => TRUE, 'form' => 'change-ipp-form', ) ); ?>
						
					</div>
					
				<?= form_close(); ?>
				
			</div>
			
			<?php if ( $pagination ){ ?>
			<div class="pagination">
				
				<?= $pagination; ?>
				
			</div>
			<?php } ?>
			
			
			<?php if($menu_items) { ?>
			<table>
				<tr>
					
					<th class="col-checkbox">
						
						<?= vui_el_checkbox( array( 'title' => lang( 'select_all' ), 'value' => 'select_all', 'name' => 'select_all_menu_items', 'id' => 'select-all-items', ) ); ?>
						
					</th>
					
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
					
					<?php $current_column = 'ordering'; ?>
					<th class="url-<?= $current_column; ?>  order-by <?= ( $order_by == $current_column ) ? 'order-by-column ' . 'order-by-' . $order_by_direction : '' ?>">
						
						<?= anchor(get_url( $this->menus->get_mi_url( 'change_order_by', $current_column ) ) , lang( $current_column ), 'class="" title="'. ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) :  ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) : lang('click_to_order_by_this_column') )  ) .'"'); ?>
						
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
				<tr class="<?= ( $menu_item[ 'status' ] == 0 ? 'disabled' : '' ); ?> <?= ( isset( $menu_item[ 'level' ] ) AND $order_by == 'ordering' ) ? ' level-' . $menu_item[ 'level' ] . ' tree-level-' . $menu_item[ 'level' ] : ''; ?>">
					
					<td class="col-checkbox">
						
						<?= vui_el_checkbox( array( 'value' => $menu_item[ 'id' ], 'name' => 'selected_menu_items_ids[]', 'form' => 'menu-items-form', 'class' => 'multi-selection-action', ) ); ?>
						
					</td>
					
					<td class="menu-id ta-center">
						<?= $menu_item[ 'id' ]; ?>
					</td>
					
					<?php $current_column = 'title'; ?>
					<td class="<?= $current_column; ?> col-<?= $current_column; ?> <?= ( isset( $menu_item[ 'level' ] ) AND $order_by == 'ordering' ) ? ' level-' . $menu_item[ 'level' ] . ' tree-level-' . $menu_item[ 'level' ] : ''; ?> tree-title">
						
						<?= anchor( $this->menus->get_mi_url( 'edit', $menu_item ), $menu_item[ $current_column ] . '<br /><small class="small">(' . $menu_item[ 'alias' ] . ')</small>', 'class="" title="' . lang( 'click_to_edit_menu_item' ) . '"' ); ?>
						
					</td>
					
					<td class="menu-link ta-center">
						<?= anchor( get_url( $menu_item[ 'link' ] ), $menu_item[ 'link' ], 'target="_blank" class="" title="' . lang( 'action_view' ) . '"' ); ?>
					</td>
					<td class="menu-item-type ta-center">
						<?= lang( $menu_item[ 'type' ] ); ?>
					</td>
					
					<?php $current_column = 'ordering'; ?>
					<td class="<?= $current_column; ?> col-<?= $current_column; ?>">
						
						<?= form_open( get_url( $this->menus->get_mi_url( 'change_ordering' ) ), 'class="form-change-ordering"' ); ?>
							
							<?= form_hidden( 'menu_item_id', $menu_item[ 'id' ] ); ?>
							
							<?= vui_el_button( array( 'url' => $this->menus->get_mi_url( 'down_ordering', $menu_item ), 'text' => lang( 'down_ordering' ), 'icon' => 'up', 'only_icon' => TRUE, ) ); ?>
							
							<?= form_input( array( 'id'=>'ordering-' . $menu_item[ 'id' ], 'class'=>'inputbox-order', 'name' => 'ordering' ), set_value( 'ordering', $menu_item[ 'ordering' ] ) ); ?>
							
							<?= vui_el_button( array( 'url' => $this->menus->get_mi_url( 'up_ordering', $menu_item ), 'text' => lang( 'up_ordering' ), 'icon' => 'down', 'only_icon' => TRUE, ) ); ?>
							
						<?= form_close(); ?>
						
					</td>
					
					<td class="status">
						
						<?=
							
							vui_el_button( array(
							
								'url' => $menu_item[ 'status' ] == 0 ? $this->menus->get_mi_url( 'set_status_publish', $menu_item ) : $this->menus->get_mi_url( 'set_status_unpublish', $menu_item ),
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
									
									'url' => $this->menus->get_mi_url( 'set_home_page', $menu_item ),
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
						
						<?= vui_el_button( array( 'url' => $this->menus->get_mi_url( 'edit', $menu_item ), 'text' => lang( 'action_edit' ), 'icon' => 'edit', 'only_icon' => TRUE, ) ); ?>
						
						<?php if ( $menu_item[ 'home' ] != '1' ){ ?>
						
						<?= vui_el_button( array( 'url' => $this->menus->get_mi_url( 'remove', $menu_item ), 'text' => lang( 'action_delete' ), 'icon' => 'remove', 'only_icon' => TRUE, ) ); ?>
						
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