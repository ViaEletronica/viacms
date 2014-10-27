		
		<div>
			
			<header class="component-head">
				
				<h1>
					
					<?= lang( 'articles' ); ?>
					
				</h1>
				
			</header>
			
			<div class="form-actions to-toolbar">
				
				<?php echo form_open( get_url( 'admin' . $this->uri->ruri_string() . assoc_array_to_qs() ), array( 'id' => 'articles-filter-by-category-form', ) ); ?>
				
					<div class="filter-fields-wrapper fields-wrapper-inline">
						
						<?php
							
							$field_name = 'articles_filter_by_category';
							$field_error = form_error( $field_name, '<div class="msg-inline-error">', '</div>' );
							$field_attr = ( $field_error ? 'autofocus' : '' ) . ' ' .
								'id="' . $field_name . '" ' .
								'name="' . $field_name . '" ' .
								'form="articles-filter-by-category-form" title="' . lang( 'filter_by_category' ) . '" ' .
								'class="' . $field_name . ' ' . ( $field_error ? 'field-error' : '' ) . '"' . ( $field_error ? element_title( $field_error ) : '' );
							
							$field_options = array(
								
								0 => lang( 'uncategorized' ),
								-1 => lang( 'all_articles' ),
								
							);
							
							if ( check_var( $categories ) ){
								
								foreach( $categories as $category ){
									
									$field_options[ $category[ 'id' ] ] = $category[ 'indented_title' ];
									
								};
								
								
							}
							
						?>
						
						<?= form_dropdown( $field_name, $field_options, $filter_by_category, $field_attr ); ?>
						
						<?= vui_el_button( array( 'text' => lang( 'action_apply_articles_category_filter' ), 'icon' => 'apply', 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit_filter_by_category', 'id' => 'submit-filter-by-category', 'only_icon' => TRUE, 'form' => 'articles-filter-by-category-form', ) ); ?>
						
					</div>
					
				<?php echo form_close(); ?>
				
			</div>
			
			<?php if ( isset( $articles ) AND $articles ){ ?>
			
			<div class="form-actions to-toolbar">
				
				<?= vui_el_button( array( 'text' => lang( 'copy' ), 'icon' => 'copy', 'class' => 'multi-selection-action-input', 'button_type' => 'button', 'type' => 'submit', 'value' => 'copy', 'name' => 'submit_copy', 'id' => 'submit-copy', 'form' => 'articles-form', ) ); ?>
				
				<?= vui_el_button( array( 'text' => lang( 'remove' ), 'icon' => 'remove', 'class' => 'multi-selection-action-input', 'button_type' => 'button', 'type' => 'submit', 'value' => 'remove', 'name' => 'submit_remove', 'id' => 'submit-remove', 'form' => 'articles-form', ) ); ?>
				
				<?= vui_el_button( array( 'url' => $this->articles->get_a_url( 'fix_ordering' ), 'title' => lang( 'tip_fix_ordering' ), 'text' => lang( 'fix_ordering' ), 'icon' => 'apply', 'class' => '', 'id' => 'fix-ordering', ) ); ?>
				
			</div>
			
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
			
			<?php if ( $pagination ){ ?>
			<div class="pagination">
				
				<?= $pagination; ?>
				
			</div>
			<?php } ?>
			
			<?= form_open( get_url( $this->articles->get_a_url( 'batch' ) ), array( 'id' => 'articles-form', ) ); ?><?= form_close(); ?>
			
			<table class="data-list responsive multi-selection-table">
				<tr>
					
					<th class="col-checkbox">
						
						<?= vui_el_checkbox( array( 'title' => lang( 'select_all' ), 'value' => 'select_all', 'name' => 'select_all_articles', 'id' => 'select-all-items', ) ); ?>
						
					</th>
					
					<?php $current_column = 'id'; ?>
					<th class="url-<?= $current_column; ?>  order-by <?= ( $order_by == $current_column ) ? 'order-by-column ' . 'order-by-' . $order_by_direction : '' ?>">
						
						<?= anchor(get_url( $this->articles->get_a_url( 'change_order_by', $current_column ) ) , lang( $current_column ), 'class="" title="'. ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) :  ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) : lang('click_to_order_by_this_column') )  ) .'"'); ?>
						
					</th>
					
					<?php $current_column = 'image'; ?>
					<th class="url-<?= $current_column; ?>  order-by <?= ( $order_by == $current_column ) ? 'order-by-column ' . 'order-by-' . $order_by_direction : '' ?>">
						
						<?= anchor( get_url( $this->articles->get_a_url( 'change_order_by', $current_column ) ) , lang( $current_column ), 'class="" title="'. ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) :  ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) : lang('click_to_order_by_this_column') )  ) .'"'); ?>
						
					</th>
					
					<?php $current_column = 'title'; ?>
					<th class="url-<?= $current_column; ?>  order-by <?= ( $order_by == $current_column ) ? 'order-by-column ' . 'order-by-' . $order_by_direction : '' ?>">
						
						<?= anchor(get_url( $this->articles->get_a_url( 'change_order_by', $current_column ) ) , lang( $current_column ), 'class="" title="'. ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) :  ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) : lang('click_to_order_by_this_column') )  ) .'"'); ?>
						
					</th>
					
					<?php $current_column = 'created_by_name'; ?>
					<th class="url-<?= $current_column; ?>  order-by <?= ( $order_by == $current_column ) ? 'order-by-column ' . 'order-by-' . $order_by_direction : '' ?>">
						
						<?= anchor(get_url( $this->articles->get_a_url( 'change_order_by', $current_column ) ) , lang( $current_column ), 'class="" title="'. ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) :  ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) : lang('click_to_order_by_this_column') )  ) .'"'); ?>
						
					</th>
					
					<?php $current_column = 'category_title'; ?>
					<th class="url-<?= $current_column; ?>  order-by <?= ( $order_by == $current_column ) ? 'order-by-column ' . 'order-by-' . $order_by_direction : '' ?>">
						
						<?= anchor(get_url( $this->articles->get_a_url( 'change_order_by', $current_column ) ) , lang( $current_column ), 'class="" title="'. ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) :  ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) : lang('click_to_order_by_this_column') )  ) .'"'); ?>
						
					</th>
					
					<?php $current_column = 'access_type'; ?>
					<th class="url-<?= $current_column; ?>  order-by <?= ( $order_by == $current_column ) ? 'order-by-column ' . 'order-by-' . $order_by_direction : '' ?>">
						
						<?= anchor(get_url( $this->articles->get_a_url( 'change_order_by', $current_column ) ) , lang( $current_column ), 'class="" title="'. ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) :  ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) : lang('click_to_order_by_this_column') )  ) .'"'); ?>
						
					</th>
					
					<?php $current_column = 'ordering'; ?>
					<th class="url-<?= $current_column; ?>  order-by <?= ( $order_by == $current_column ) ? 'order-by-column ' . 'order-by-' . $order_by_direction : '' ?>">
						
						<?= anchor(get_url( $this->articles->get_a_url( 'change_order_by', $current_column ) ) , lang( $current_column ), 'class="" title="'. ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) :  ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) : lang('click_to_order_by_this_column') )  ) .'"'); ?>
						
					</th>
					
					<?php $current_column = 'status'; ?>
					<th class="url-<?= $current_column; ?>  order-by <?= ( $order_by == $current_column ) ? 'order-by-column ' . 'order-by-' . $order_by_direction : '' ?>">
						
						<?= anchor(get_url( $this->articles->get_a_url( 'change_order_by', $current_column ) ) , lang( $current_column ), 'class="" title="'. ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) :  ( ( $order_by == $current_column ) ? lang('ordering_by_this_column_' . $order_by_direction . '_click_to_' . ( $order_by_direction == 'ASC' ? 'DESC' : 'ASC' ) ) : lang('click_to_order_by_this_column') )  ) .'"'); ?>
						
					</th>
					
					<th class="op-column">
						
						<?= lang('operations'); ?>
						
					</th>
					
				</tr>
				
				<?php foreach( $articles as $article ): ?>
				<tr>
					
					<td class="col-checkbox">
						
						<?= vui_el_checkbox( array( 'value' => $article[ 'id' ], 'name' => 'selected_articles_ids[]', 'form' => 'articles-form', 'class' => 'multi-selection-action', ) ); ?>
						
					</td>
					
					<td class="id">
						
						<?= $article[ 'id' ]; ?>
						
					</td>
					
					<td class="article-thumb ta-center">
						
						<?php if ( $article[ 'image' ] ){ ?>
						
						<div class="thumb-image-wrapper">
							
							<?= anchor( $article[ 'image' ], img( array( 'src' => 'thumbs/' . $article[ 'image' ], 'width' => 50 ) ),'rel="articles-images" target="_blank" class="article-image-thumb" title="' . $article[ 'title' ] . '"' ); ?>
							
						</div>
						
						<?php } ?>
						
					</td>
					
					<td class="title">
						
						<?= anchor( $this->articles->get_a_url( 'edit', $article ), strip_tags( $article[ 'title' ] ), 'class="" title="' . lang( 'action_view' ) . '"' ); ?><br />
						<small class="small">(<?= $article[ 'alias' ]; ?>)</small>
						
					</td>
					
					<td class="article-created-by">
						
						<?= anchor( 'admin/users/users_management/edit_user/' . base64_encode( base64_encode( base64_encode( base64_encode( $article[ 'created_by_id' ] ) ) ) ), $article[ 'created_by_name' ], 'class="" title="' . $article[ 'created_by_name' ] . '"' ); ?>
						
					</td>
					
					<td class="article-category">
						
						<?php if ( $article[ 'category_id' ] > 0 ){ ?>
							
						<?= $this->articles->get_category_path( $article[ 'category_id' ], NULL, NULL, TRUE ); ?>
						
						<?php } else { ?>
						<?php echo lang('uncategorized'); ?>
						<?php } ?>
						
					</td>
					
					<td class="access">
						
						<?php if ($article[ 'access_type' ] == 'users') { ?>
						<span class="access-level access-level-users"><?php echo lang('specific_users'); ?></span>
						<?php } else if ($article[ 'access_type' ] == 'users_groups') { ?></span>
						<span class="access-level access-level-users-groups"><?php echo lang('specific_users_groups'); ?>
						<?php } else { ?>
						<span class="access-level access-level-public"><?php echo lang('public'); ?></span>
						<?php } ?>
						
					</td>
					
					<td class="ordering">
						
						<?= form_open( get_url( $this->articles->get_a_url( 'change_ordering' ) ), 'class="form-change-ordering"' ); ?>
							
							<?= form_hidden( 'article_id', $article[ 'id' ] ); ?>
							
							<?= vui_el_button( array( 'url' => $this->articles->get_a_url( 'down_ordering', $article ), 'text' => lang( 'down_ordering' ), 'icon' => 'up', 'only_icon' => TRUE, ) ); ?>
							
							<?= form_input( array( 'id'=>'ordering-' . $article[ 'id' ], 'class'=>'inputbox-order', 'name' => 'ordering' ), set_value( 'ordering', $article[ 'ordering' ] ) ); ?>
							
							<?= vui_el_button( array( 'url' => $this->articles->get_a_url( 'up_ordering', $article ), 'text' => lang( 'up_ordering' ), 'icon' => 'down', 'only_icon' => TRUE, ) ); ?>
							
						<?= form_close(); ?>
						
					</td>
					
					<td class="status">
						
						<?=
							
							vui_el_button( array(
							
								'url' => ( $article[ 'status' ] != 1 ? $this->articles->get_a_url( 'set_status_publish', $article ) : $this->articles->get_a_url( 'set_status_unpublish', $article ) ),
								'text' => lang( $article[ 'status' ] == -1 ? 'archived' : ( $article[ 'status' ] == 0 ? 'unpublished' : 'published' ) ),
								'icon' => ( $article[ 'status' ] == -1 ? 'archived' : ( $article[ 'status' ] == 0 ? 'cancel unpublished' : 'ok published' ) ),
								'only_icon' => TRUE, )
								
							);
							
						?>
						
					</td>
					
					<td class="operations">
						
						<?= vui_el_button( array( 'url' => $this->articles_model->get_link_article_detail( 0, $article[ 'id' ] ), 'text' => lang( 'action_view' ), 'target' => '_blank', 'icon' => 'view', 'only_icon' => TRUE, ) ); ?>
						
						<?= vui_el_button( array( 'url' => $this->articles->get_a_url( 'edit', $article ), 'text' => lang( 'action_edit' ), 'icon' => 'edit', 'only_icon' => TRUE, ) ); ?>
						
						<?= vui_el_button( array( 'url' => $this->articles->get_a_url( 'copy', $article ), 'text' => lang( 'action_copy' ), 'icon' => 'copy', 'only_icon' => TRUE, ) ); ?>
						
						<?= vui_el_button( array( 'url' => $this->articles->get_a_url( 'remove', $article ), 'text' => lang( 'action_delete' ), 'icon' => 'remove', 'only_icon' => TRUE, ) ); ?>
						
					</td>
				</tr>
				<?php endforeach; ?>
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
				
				<?= vui_el_button( array( 'text' => lang( 'no_articles_records' ), 'icon' => 'error', ) ); ?>
				
				<?= vui_el_button( array( 'url' => 'admin/' . $component_name . '/articles_management/add_article', 'text' => lang( 'new_article' ), 'icon' => 'add-article', 'only_icon' => FALSE, ) ); ?>
				
			<?php } ?>
			
		</div>
		
		<script type="text/javascript" >
			
			$( document ).on( 'ready', function( e ){
				
				$( '#submit-filter-by-category' ).hide();
				
			});
			
			$( document ).on( 'change', '#articles_filter_by_category', function( e ){
				
				$( '#submit-filter-by-category' ).click();
				
			});
			
		</script>
		