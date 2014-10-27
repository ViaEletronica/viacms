
<div>
	
	<header class="component-head">
		
		<h1>
			
			<?= lang( 'articles_categories' ); ?>
			
		</h1>
		
	</header>
	
	<?php if ( isset( $categories ) AND $categories ){ ?>
	
	<div class="form-actions">
		
		<?php echo form_open( get_url( 'admin' . $this->uri->ruri_string() . assoc_array_to_qs() ), array( 'id' => 'change-ipp-form', ) ); ?>
		
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
			
		<?php echo form_close(); ?>
		
	</div>
	
	<div class="form-actions to-toolbar">
		
		<?= vui_el_button( array( 'url' => $this->articles->get_c_url( 'fix_ordering' ), 'text' => lang( 'fix_ordering' ), 'icon' => 'apply', 'class' => '', 'id' => 'fix-ordering', ) ); ?>
		
	</div>
	
	<?php if ( $pagination ){ ?>
	<div class="pagination">
		
		<?= $pagination; ?>
		
	</div>
	<?php } ?>
	
	<?= form_open( get_url( $this->articles->get_c_url( 'batch' ) ), array( 'id' => 'categories-form', ) ); ?><?= form_close(); ?>
	
	<table>
		<tr>
			
			<th class="col-checkbox">
				
				<?= vui_el_checkbox( array( 'title' => lang( 'select_all' ), 'value' => 'select_all', 'name' => 'select_all_articles', 'id' => 'select-all-items', ) ); ?>
				
			</th>
			
			<?php $current_column = 'id'; ?>
			<th class="url-<?= $current_column; ?>  order-by <?= ( $order_by == $current_column ) ? 'order-by-column ' . 'order-by-' . $order_by_direction : '' ?>">
				
				<?= anchor(get_url( $this->articles->get_c_url( 'change_order_by', $current_column ) ) , lang( $current_column ), 'class="" title="'. ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) :  ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) : lang('click_to_order_by_this_column') )  ) .'"'); ?>
				
			</th>
			
			<?php $current_column = 'image'; ?>
			<th class="url-<?= $current_column; ?>  order-by <?= ( $order_by == $current_column ) ? 'order-by-column ' . 'order-by-' . $order_by_direction : '' ?>">
				
				<?= anchor( get_url( $this->articles->get_c_url( 'change_order_by', $current_column ) ) , lang( $current_column ), 'class="" title="'. ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) :  ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) : lang('click_to_order_by_this_column') )  ) .'"'); ?>
				
			</th>
			
			<?php $current_column = 'title'; ?>
			<th class="url-<?= $current_column; ?>  order-by <?= ( $order_by == $current_column ) ? 'order-by-column ' . 'order-by-' . $order_by_direction : '' ?>">
				
				<?= anchor(get_url( $this->articles->get_c_url( 'change_order_by', $current_column ) ) , lang( $current_column ), 'class="" title="'. ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) :  ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) : lang('click_to_order_by_this_column') )  ) .'"'); ?>
				
			</th>
			
			<?php $current_column = 'ordering'; ?>
			<th class="url-<?= $current_column; ?>  order-by <?= ( $order_by == $current_column ) ? 'order-by-column ' . 'order-by-' . $order_by_direction : '' ?>">
				
				<?= anchor(get_url( $this->articles->get_c_url( 'change_order_by', $current_column ) ) , lang( $current_column ), 'class="" title="'. ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) :  ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) : lang('click_to_order_by_this_column') )  ) .'"'); ?>
				
			</th>
			
			<?php $current_column = 'status'; ?>
			<th class="url-<?= $current_column; ?>  order-by <?= ( $order_by == $current_column ) ? 'order-by-column ' . 'order-by-' . $order_by_direction : '' ?>">
				
				<?= anchor(get_url( $this->articles->get_c_url( 'change_order_by', $current_column ) ) , lang( $current_column ), 'class="" title="'. ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) :  ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) : lang('click_to_order_by_this_column') )  ) .'"'); ?>
				
			</th>
			
			<th class="op-column">
				
				<?= lang('operations'); ?>
				
			</th>
			
		</tr>
		
		<?php foreach($categories as $category) { ?>
		<tr class="<?= ( isset( $category[ 'level' ] ) AND $order_by == 'ordering' ) ? ' level-' . $category[ 'level' ] . ' tree-level-' . $category[ 'level' ] : ''; ?>">
			
			<td class="col-checkbox">
				
				<?= vui_el_checkbox( array( 'value' => $category[ 'id' ], 'name' => 'selected_categories_ids[]', 'form' => 'categories-form', 'class' => 'multi-selection-action', ) ); ?>
				
			</td>
			
			<?php $current_column = 'id'; ?>
			<td class="<?= $current_column; ?> col-<?= $current_column; ?> ta-center">
				
				<?= $category[ $current_column ]; ?>
				
			</td>
			
			<?php $current_column = 'image'; ?>
			<td class="<?= $current_column; ?> col-<?= $current_column; ?> ta-center">
				
				<?php if ( $category[ $current_column ] ){ ?>
				
				<div class="thumb-image-wrapper">
					
					<?= anchor( $category[ $current_column ], img( array( 'src' => 'thumbs/' . $category[ $current_column ], 'width' => 50 ) ),'rel="categories-images" target="_blank" class="category-' . $current_column . '-thumb" title="' . $category[ 'title' ] . '"' ); ?>
					
				</div>
				
				<?php } ?>
				
			</td>
			
			<?php $current_column = 'title'; ?>
			<td class="<?= $current_column; ?> col-<?= $current_column; ?> <?= ( isset( $category[ 'level' ] ) AND $order_by == 'ordering' ) ? ' level-' . $category[ 'level' ] . ' tree-level-' . $category[ 'level' ] : ''; ?> tree-title">
				
				<?= anchor( $this->articles->get_c_url( 'edit', $category[ 'id' ] ), $category[ $current_column ] . '<br /><small class="small">(' . $category[ 'alias' ] . ')</small>', 'class="" title="' . lang( 'click_to_edit_category' ) . '"' ); ?>
				
			</td>
			
			<?php $current_column = 'ordering'; ?>
			<td class="<?= $current_column; ?>">
				
				<?= form_open( get_url( $this->articles->get_c_url( 'change_ordering' ) ), 'class="form-change-ordering"' ); ?>
					
					<?= form_hidden( 'category_id', $category[ 'id' ] ); ?>
					
					<?= vui_el_button( array( 'url' => $this->articles->get_c_url( 'down_ordering', $category ), 'text' => lang( 'down_ordering' ), 'icon' => 'up', 'only_icon' => TRUE, ) ); ?>
					
					<?= form_input( array( 'id'=>'ordering-' . $category[ 'id' ], 'class'=>'inputbox-order', 'name' => 'ordering' ), set_value( 'ordering', $category[ 'ordering' ] ) ); ?>
					
					<?= vui_el_button( array( 'url' => $this->articles->get_c_url( 'up_ordering', $category ), 'text' => lang( 'up_ordering' ), 'icon' => 'down', 'only_icon' => TRUE, ) ); ?>
					
				<?= form_close(); ?>
				
			</td>
			
			<td class="status">
				
				<?=
					
					vui_el_button( array(
					
						'url' => ( $category[ 'status' ] != 1 ? $this->articles->get_c_url( 'set_status_publish', $category ) : $this->articles->get_c_url( 'set_status_unpublish', $category ) ),
						'text' => lang( $category[ 'status' ] == 0 ? 'unpublished' : 'published' ),
						'icon' => ( $category[ 'status' ] == 0 ? 'cancel unpublished' : 'ok published' ),
						'only_icon' => TRUE, )
						
					);
					
				?>
				
			</td>
			
			<td class="operations">
				
				<?= vui_el_button( array( 'url' => $this->articles->get_c_url( 'edit', $category ), 'text' => lang( 'action_view' ), 'target' => '_blank', 'icon' => 'view', 'only_icon' => TRUE, ) ); ?>
				
				<?= vui_el_button( array( 'url' => $this->articles->get_c_url( 'edit', $category ), 'text' => lang( 'action_edit' ), 'icon' => 'edit', 'only_icon' => TRUE, ) ); ?>
				
				<?= vui_el_button( array( 'url' => $this->articles->get_c_url( 'remove', $category ), 'text' => lang( 'action_delete' ), 'icon' => 'remove', 'only_icon' => TRUE, ) ); ?>
				
			</td>
			
		</tr>
		<?php }; ?>
		
	</table>
	
	<?php if ( $pagination ){ ?>
	<div class="pagination">
		
		<?= $pagination; ?>
		
	</div>
	<?php } ?>
	
	<?php $this->plugins->load( 'jquery_checkboxes' ); ?>
	
	<?php if ( $this->plugins->load( 'fancybox' ) ) { ?>
	<script type="text/javascript" >
		
		$( document ).on( 'ready', function( e ){
			
			<?php if ( $this->plugins->load( 'fancybox' ) ){ ?>
			
			$( ".article-image-thumb" ).fancybox();
			
			//$.fancybox.showLoading()
			
			<?php } ?>
			
		});
		
	</script>
	<?php } ?>
	
	<?php } else { ?>
		
		<?= vui_el_button( array( 'text' => lang( 'no_categories_records' ), 'icon' => 'error', ) ); ?>
		
		<?= vui_el_button( array( 'url' => $add_category_link, 'text' => lang( 'new_category' ), 'icon' => 'add-category', 'only_icon' => FALSE, ) ); ?>
		
	<?php } ?>
	
</div>