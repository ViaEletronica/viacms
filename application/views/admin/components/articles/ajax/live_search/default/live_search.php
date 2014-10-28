	
	<?php if ( $results ){ ?>
	
	<div class="search-results live-search-results">
		
		<?php foreach ( $results as $key => $plugin_results ) { ?>
			
			<?php $plugin_name = $key; ?>
			
			<div class="plugin-name">
				
				<?= lang( $plugin_name . '_search_result_title' ); ?>
				
			</div>
			
			<?php foreach ( $plugin_results as $key_2 => $result ) { ?>
				
				<?php if ( isset( $result[ 'id' ] ) AND $result[ 'id' ] ){ ?>
				
				<a href="<?= get_url( $this->articles->{ 'get_' . ( $plugin_name === 'articles_search' ? 'a' : 'c' ) . '_url' }( 'edit', $result[ 'id' ] ) ); ?>" class="search-result" data-resultid="<?= $result[ 'id' ]; ?>" >
					
					<span class="s1" >
						
						<?php if ( $result[ 'image' ] ){ ?>
						
						<?php
							
							$thumb_params = array(
								
								'wrapper_class' => '',
								'wrappers_el_type' => 'span',
								'src' => $result[ 'image' ],
								'title' => $result[ 'title' ],
								
							);
							
							echo vui_el_thumb( $thumb_params );
							
						?>
						
						<?php } ?>
						
						<?php if ( $result[ 'title' ] ){ ?>
						
						<span class="title search-result-title">
							
							<?= $result[ 'title' ]; ?>
							
						</span>
						
						<?php } ?>
						
						<?php if ( $result[ 'content' ] ){ ?>
						
						<span class="content search-result-content">
							
							<?= $result[ 'content' ]; ?>
							
						</span>
						
						<?php } ?>
						
					</span>
					
				</a>
				
				<?php } ?>
				
			<?php } ?>
			
		<?php } ?>
		
		</div>
		
	<script type="text/javascript">
		
		if ( typeof window.onArticleChooseFunction == 'function' ) {
			
			$( '.result-list-live-search .result-item' ).bind( 'click', function( event ) {
				
				event.preventDefault();
				
				window.selectedArticle = {
					
					id: $( this ).data( 'resultid' ),
					thumb:  $( this ).find( '.thumb-wrapper-content img' ).attr( 'src' ),
					title: $( this ).find( '.result-title-content' ).text()
					
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
