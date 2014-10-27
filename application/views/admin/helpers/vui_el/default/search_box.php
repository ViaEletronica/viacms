


<div class="vui-search-box <?= $wrapper_class; ?>">
	
	<?= form_open( ( check_var( $get_url ) ? get_url( $url ) : $url ) ); ?>
	
	<div class="vui-field-wrapper-inline">
		
		<?php
			
			$search_input_params = array(
				
				'placeholder' => $text,
				'name' => $name,
				'class' => 'search-terms' . $class,
				'title' => lang( 'tip_terms' ),
				
			);
			
			$search_input_params = check_var( $attr ) ? array_merge( $search_input_params, $attr ) : $search_input_params;
			
		?>
		
		<?= form_input( $search_input_params, $terms ); ?>
		
	</div>
	
	<div class="vui-field-wrapper-inline">
		
		<?= vui_el_button( array( 'text' => lang( 'search' ), 'icon' => 'search', 'only_icon' => TRUE, 'button_type' => 'button', 'type' => 'submit', 'name' => 'submit_search', 'class' => 'submit-search', ) ); ?>
		
		<?php if ( check_var( $terms ) ){ ?>
		
		<?= vui_el_button( array( 'url' => $cancel_url, 'text' => lang( 'cancel_search' ), 'icon' => 'cancel', 'only_icon' => TRUE, 'type' => 'submit', 'class' => 'submit-cancel-search', ) ); ?>
		
		<?php } ?>
		
	</div>
	
	<?= form_close(); ?>
	
	<div class="clear"></div>
	
</div>


<script type="text/javascript">
	
	<?php if ( $live_search_url AND $this->plugins->load( 'viacms_live_search' ) ) { ?>
	
	$( document ).bind( 'ready', function(){
		
		liveSearch( '<?= $live_search_url; ?>' );
		
	});
	
	<?php } ?>
	
</script>
