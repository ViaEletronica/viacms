<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script type="text/javascript">
	
	function liveSearch( cUrl, funtionOnShow ){
		
		if ( ! cUrl ){
			
			console.error( 'ViaCMS Live Search: url não especificada!' )
			
		}
		else{
			
			$( 'input[type=text].live-search' ).each( function() {
				
				var elem = $(this);
				
				elem.attr('data-contactgrabed', true);
				elem.attr('autocomplete', 'off');
				
				elem.qtip({
					prerender: false,
					overwrite: true,
					content: {
						
						text: function(event, api) {
							
							api.set('content.text', '<?= lang('msg_loading'); ?>');
							
						}
						
					},
					show: {
						event: 'keyup',
						effect: function(offset) {
							
							$(this).fadeIn( 300 ); // "this" refers to the tooltip
							
						},
						delay: 700
					},
					events: {
						show : function(event, api){
							
							// Setup the map container and append it to the tooltip
							container = $( '<div class="s1"></div>' ).appendTo( api.elements.content.empty() );
							
							$.ajax({
								type: "GET",
								data: {
									q: api.elements.target.val(),
									contact_id: api.elements.target.data('contact-id'),
									ajax: true
								},
								url: cUrl,
								success: function(data){
									
									container.html( data );
									api.set('content.text', container);
									
									if ( typeof( funtionOnShow ) == 'function' ){
										
										funtionOnShow();
										
									}
									
								},
								error: function(xhr, textStatus, errorThrown){
									
									console.log('content.text', status + ': ' + error);
									
									for(i in xhr){
										if(i!="channel")
										console.log(i + '>> ' + xhr[i]);
									};
									
								}
							});
							
						},
						hide : function(event, api){
							
						}
					},
					position: {
						target: elem,
						viewport: $(document),
						effect: false
					},
					hide: {
						event: 'keydown unfocus',
						effect: function(offset) {
							$(this).fadeOut(100); // "this" refers to the tooltip
						}
					},
					style: {
						def: false,
						classes: 'qtip-viacms-live-search live-search qtip-vecms'
					}
				});
			});
			
		}
		
	}
	
	$( document ).bind( 'ready', function(){
		
		
		
	});
	
</script>
