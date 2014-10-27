	
	<?php if ( $articles ){ ?>
	
	<div class="article-list-live-search live-search-result-wrapper">
		
		<?php foreach ( $articles as $key => $article ) { ?>
			
			<div class="info-wrapper live-search-result-item">
				
				<?php if ( isset( $article['id'] ) AND $article['id'] ){ ?>
				
				<a href="<?= get_url( $this->articles->get_a_url( 'edit', $article[ 'id' ] ) ); ?>" class="article-item live-search-result-item" data-articleid="<?= $article['id']; ?>" >
					
					<span class="thumb-wrapper">
						
						<span class="thumb-wrapper-content">
							<?php if ( $article[ 'image' ] ){ ?>
							
							<?= img( array( 'src' => base_url() . '/thumbs/' . $article['image'], 'width' => 24 ) ); ?>
							
							<?php } ?>
						</span>
						
					</span>
					
					<span class="article-title-wrapper">
						
						<span class="article-title-content">
							
							<?= $article[ 'title' ]; ?>
							
						</span>
						
					</span>
					
				</a>
				
				<?php } ?>
				
			</div>
			
		<?php } ?>
	</div>
	
	<script type="text/javascript">
		
		if ( typeof window.onArticleChooseFunction == 'function' ) {
			
			$( '.article-list-live-search .article-item' ).bind( 'click', function( event ) {
				
				event.preventDefault();
				
				window.selectedArticle = {
					
					id: $( this ).data( 'articleid' ),
					thumb:  $( this ).find( '.thumb-wrapper-content img' ).attr( 'src' ),
					title: $( this ).find( '.article-title-content' ).text()
					
				};
				
				window.onArticleChooseFunction();
				
			});
			
		}
		
	</script>
	
	<?php } else { ?>
	
	<div class="live-search-no-results">
		
		<?= vui_el_button( array( 'text' => lang( 'live_search_no_results' ), 'icon' => 'error', ) ); ?>
		
	</div>
	
	<?php } ?>
