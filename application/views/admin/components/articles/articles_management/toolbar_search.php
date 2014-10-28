
<div class="search-toolbar-wrapper fr">
	
	<?php
		
		$search_box_params = array(
			
			'url' => $this->articles->get_a_url( 'search' ),
			'terms' => isset( $search[ 'terms' ] ) ? $search[ 'terms' ] : '',
			'wrapper_class' => 'search-toolbar-wrapper fr',
			'name' => 'terms',
			'cancel_url' => $this->articles->get_a_url( 'cancel_search' ),
			'live_search_url' => $this->articles->get_ajax_url( 'search' ),
			
		);
		
		echo vui_el_search( $search_box_params );
		
	?>
	
	<div class="clear"></div>
	
</div>
