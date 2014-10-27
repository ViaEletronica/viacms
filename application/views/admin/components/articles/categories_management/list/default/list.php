
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
				<?= anchor( $this->articles->get_c_url( 'edit', $category[ 'id' ] ), $category[ 'title' ], 'class="" title="' . lang( 'click_to_edit_category' ) . '"' ); ?>
			</td>
			
			<td class="ordering">
				
				<?= form_open( get_url( $this->articles->get_c_url( 'change_ordering' ) ), 'class="form-change-ordering"' ); ?>
				
					<?= vui_el_button( array( 'url' => $this->articles->get_c_url( 'down_ordering', $category ), 'text' => lang( 'down_ordering' ), 'icon' => 'up', 'only_icon' => TRUE, ) ); ?>
					
					<?= form_input( array( 'id'=>'ordering-' . $category[ 'id' ], 'class'=>'inputbox-order', 'name' => 'ordering' ), set_value( 'ordering', $category[ 'ordering' ] ) ); ?>
					
					<?= vui_el_button( array( 'url' => $this->articles->get_c_url( 'up_ordering', $category ), 'text' => lang( 'up_ordering' ), 'icon' => 'down', 'only_icon' => TRUE, ) ); ?>
					
				<?= form_close(); ?>
				
			</td>
			
			<td class="operations">
				
				<?= vui_el_button( array( 'url' => $this->articles->get_c_url( 'edit', $category ), 'text' => lang( 'action_view' ), 'target' => '_blank', 'icon' => 'view', 'only_icon' => TRUE, ) ); ?>
				
				<?= vui_el_button( array( 'url' => $this->articles->get_c_url( 'edit', $category ), 'text' => lang( 'action_edit' ), 'icon' => 'edit', 'only_icon' => TRUE, ) ); ?>
				
				<?= vui_el_button( array( 'url' => $this->articles->get_c_url( 'remove', $category ), 'text' => lang( 'action_delete' ), 'icon' => 'remove', 'only_icon' => TRUE, ) ); ?>
				
			</td>
		</tr>
		<?php }; ?>
	</table>
	
	<?php } else { ?>
		
		<?= vui_el_button( array( 'text' => lang( 'no_categories_records' ), 'icon' => 'error', ) ); ?>
		
		<?= vui_el_button( array( 'url' => $add_category_link, 'text' => lang( 'new_category' ), 'icon' => 'add-category', 'only_icon' => FALSE, ) ); ?>
		
	<?php } ?>
	
</div>