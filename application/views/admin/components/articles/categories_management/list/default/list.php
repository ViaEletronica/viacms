
<div>
	
	<header class="component-head">
		
		<h1>
			
			<?= lang( 'articles_categories' ); ?>
			
		</h1>
		
	</header>
	
	<?php if ( isset( $categories ) AND $categories ){ ?>
	
	<table>
		<tr>
			
			<th>
				<?= lang('id'); ?>
			</th>
			
			<th>
				<?= lang('title'); ?>
			</th>
			
			<th>
				<?= lang('ordering'); ?>
			</th>
			
			<th class="op-column">
				<?= lang('operations'); ?>
			</th>
			
		</tr>
		
		<?php foreach($categories as $category) { ?>
		<tr class="category-level-<?= $category[ 'level' ]; ?> tree-level-<?= $category[ 'level' ]; ?>">
			<td class="menu-id ta-center">
				<?= $category['id']; ?>
			</td>
			<td class="menu-title tree-title">
				<?php if ( $category[ 'level' ] > 0 ){ ?>
				<?= vui_el_button( array( 'icon' => 'sub-item', 'only_icon' => TRUE, ) ); ?>
				<?php } ?>
				<?= anchor( $category[ 'edit_link' ], $category[ 'title' ], 'class="" title="' . lang( 'click_to_edit_category' ) . '"' ); ?>
			</td>
			
			<td class="ordering">
				
				<?= form_open( $category[ 'down_order_link' ], 'class="form-change-order"' ); ?>
				
				<?= form_hidden( 'category_id', $category[ 'id' ] ); ?>
				<?= form_hidden( 'ordering', $category[ 'ordering' ] ); ?>
				
				<?= vui_el_button( array( 'text' => lang( 'down_order' ), 'icon' => 'up', 'only_icon' => TRUE, 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit_down_order', 'id' => 'submit-down-order', ) ); ?>
				
				<?= form_close(); ?>
				
				<?= form_open( $category[ 'change_order_link' ], 'class="form-change-order"' ); ?>
				<?= form_input( array( 'id'=>'ordering-' . $category[ 'id' ], 'class'=>'inputbox-ordering','name'=>'ordering'), set_value( 'ordering', $category[ 'ordering' ] ) ); ?>
				<?= form_hidden( 'category_id', $category[ 'id' ] ); ?>
				<?= form_close(); ?>
				
				<?= form_open( $category[ 'up_order_link' ], 'class="form-change-order"' ); ?>
				
				<?= form_hidden( 'category_id', $category[ 'id' ] ); ?>
				<?= form_hidden( 'ordering', $category[ 'ordering' ] ); ?>
				
				<?= vui_el_button( array( 'text' => lang( 'up_order' ), 'icon' => 'down', 'only_icon' => TRUE, 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit_up_order', 'id' => 'submit-up-order', ) ); ?>
				
				<?= form_close(); ?>
				
			</td>
			
			<td class="operations">
				
				<?= vui_el_button( array( 'url' => $category[ 'view_link' ], 'text' => lang( 'action_view' ), 'target' => '_blank', 'icon' => 'view', 'only_icon' => TRUE, ) ); ?>
				
				<?= vui_el_button( array( 'url' => $category[ 'edit_link' ], 'text' => lang( 'action_edit' ), 'icon' => 'edit', 'only_icon' => TRUE, ) ); ?>
				
				<?= vui_el_button( array( 'url' => $category[ 'remove_link' ], 'text' => lang( 'action_delete' ), 'icon' => 'remove', 'only_icon' => TRUE, ) ); ?>
				
			</td>
		</tr>
		<?php }; ?>
	</table>
	
	<?php } else { ?>
		
		<?= vui_el_button( array( 'text' => lang( 'no_categories_records' ), 'icon' => 'error', ) ); ?>
		
		<?= vui_el_button( array( 'url' => $add_category_link, 'text' => lang( 'new_category' ), 'icon' => 'add-category', 'only_icon' => FALSE, ) ); ?>
		
	<?php } ?>
	
</div>