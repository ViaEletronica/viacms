	
	<div class="params-set-wrapper">
		
		<div class="params-set">
			
			<?php if ( $header ) { ?>
			
			<h4 class="params-set-title">
				
				<?= vui_el_button( array( 'text' => lang( $header ), 'icon' => url_title( $header ),  ) ); ?>
				
			</h4>
			
			<?php } ?>
			
			<?php if ( isset( $elements ) AND $elements ) { ?>
				
			<table>
				
				<?php foreach ( $elements as $element ) { ?>
					
					<?= $element; ?>
					
				<?php } ?>
				
			</table>
			
			<?php } ?>
			
		</div>
		
	</div>
	