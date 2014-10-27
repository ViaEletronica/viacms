	
	<?php if ( check_var( $categories ) ){ ?>
	
	<div class="category-list-live-search live-search-result-wrapper">
		
		<div class="live-search-result-item category-item-wrapper">
			
			<a href="#" class="category-item live-search-result-item" data-categoryid="0" >
				
				<span class="category-title-wrapper">
					
					<span class="category-title-content">
						
						<?= lang( 'uncategorized' ); ?>
						
					</span>
					
				</span>
				
			</a>
			
		</div>
		
		<div class="live-search-result-item category-item-wrapper selected-category">
			
			<a href="#" class="category-item live-search-result-item" data-categoryid="-1" >
				
				<span class="category-title-wrapper">
					
					<span class="category-title-content">
						
						<?= lang( 'all_articles' ); ?>
						
					</span>
					
				</span>
				
			</a>
			
		</div>
		
		<?php foreach ( $categories as $key => $category ) { ?>
		
		<div class="live-search-result-item category-item-wrapper <?= ( $category[ 'level' ] > 0 ) ? 'sub-item' : ''; ?> category-level-<?= $category[ 'level' ]; ?>">
			
			<?php if ( isset( $category['id'] ) AND $category['id'] ){ ?>
			
			<a href="<?= get_url('admin/categories/categories_management/edit_category/'.$category['id']); ?>" class="category-item live-search-result-item" data-categoryid="<?= $category['id']; ?>" >
				
				<span class="category-title-wrapper">
					
					<span class="category-title-content">
						
						<?= $category[ 'title' ]; ?>
						
					</span>
					
				</span>
				
			</a>
			
			<?php } ?>
			
		</div>
		
		<?php } ?>
	</div>
	
	<script type="text/javascript">
		
		$( '.category-list-live-search .category-item' ).bind( 'click', function( e ) {
			
			$( '.selected-category' ).removeClass( 'selected-category' );
			$( this ).parent().addClass( 'selected-category' );
			
			e.preventDefault();
			
			window.selectedCategory = {
				
				id: $( this ).data( 'categoryid' ),
				title: $( this ).find( '.category-title-content' ).text()
				
			};
			
			if ( typeof window.onCategoryChooseFunction == 'function' ) {
				
				window.onCategoryChooseFunction();
				
			}
			
		});
		
	</script>
	
	<?php } else { ?>
	
	<div class="live-search-no-results">
		
		<?= vui_el_button( array( 'text' => lang( 'live_search_no_results' ), 'icon' => 'error', ) ); ?>
		
	</div>
	
	<?php } ?>
