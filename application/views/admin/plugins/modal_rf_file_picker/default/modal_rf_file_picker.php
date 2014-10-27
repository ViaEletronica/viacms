<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script type="text/javascript">
	
	function responsive_filemanager_callback( fieldID ){
		
		var url = $( '#' + fieldID ).val();
		url = url.replace( new RegExp( '<?= site_url(); ?>', 'g' ), '' );
		$( '#' + fieldID ).val( url.replace(/^\/|\/$/g, '') );
		
		if ( typeof window.onFileChooseFunction === 'function' ) {
			
			window.onFileChooseFunction();
			
		}
		
	}
	
	if ( typeof window.onFileChooseFunction === 'undefined' ) {
		
		window.onFileChooseFunction = function(){
			
		}
		
	}
	
	if ( typeof window.runRFFilePicker === 'undefined' ) {
		
		window.runRFFilePicker = function(){
			
			$('.modal-file-picker').each( function( index ) {
				
				var jthis = $( this );
				var dir = '';
				var relUrl = '0';
				
				var fieldId = jthis.data( 'rffieldid' );
				var type = jthis.data( 'rftype' );
				
				if ( type === 'image' ){
					
					type = 1;
					dir = '<?= MEDIA_DIR_NAME; ?>'
					
				}
				else{
					
					type = 0;
					dir = ''
					
				}
				
				if ( typeof jthis.data( 'rfdir' ) != 'undefined' ){
					
					dir = jthis.data( 'rfdir' );
					
				}
				if ( typeof jthis.data( 'rf-relative-url' ) != 'undefined' ){
					
					relUrl = '1';
					
				}
				
				var akey = '<?= md5( $this->config->item( 'encryption_key' ) ); ?>';
				var lang = '<?= str_replace( '_', '-', $this->mcm->filtered_system_params[ $this->mcm->environment . '_language' ] ); ?>';
				
				var rfUrl = '<?= JS_DIR_URL . '/responsivefilemanager/filemanager/dialog.php'; ?>';
				var uGet = '?lang=' + lang + '&dir=' + dir + '&type=' + type + '&akey=' + akey + '&field_id=' + fieldId + '&relative_url=' + relUrl;
				
				jthis.attr( 'href', rfUrl + uGet );
				
				jthis.click( function( e ){
					
					e.preventDefault();
					
					if ( typeof jthis.data( 'rf-callback-function-on-click' ) != 'undefined' ){
						
						window[ jthis.data( 'rf-callback-function-on-click' ) ]();
						
					}
					
					if ( typeof jthis.data( 'rf-callback-function-on-choose' ) != 'undefined' ){
						
						window.responsive_filemanager_callback = function( fieldID ){
							
							var url = $( '#' + fieldID ).val();
							
							if ( url != '' ){
								
								url = url.replace( new RegExp( '<?= site_url(); ?>', 'g' ), '' );
								$( '#' + fieldID ).val( url.replace(/^\/|\/$/g, '') );
								
							}
							
							window[ jthis.data( 'rf-callback-function-on-choose' ) ]();
							
						}
						
					}
					
					if ( typeof jthis.data( 'rf-container' ) != 'undefined' ){
						
						$( jthis.data( 'rf-container' ) ).html( '<iframe style="min-width:850px;min-height:300px;" src="' + jthis.attr( 'href' ) + '" ></iframe>' )
						$.fancybox.update();
						
					}
					else{
						
						$.fancybox.open({
							
							href : jthis.attr( 'href' ),
							title : '<?= lang( 'choose_file' ); ?>',
							type: "iframe",
							isDom: false,
							fitToView: true,
							minWidth: 860,
							minHeight: 300,
							autoScale : true
							
						});
						
					}
					$.fancybox.reposition();
					
				});
				
			})
			
		}
		
	}
	
	$( document ).bind( 'ready', function(){
		
		runRFFilePicker();
		
	});
	
</script>
