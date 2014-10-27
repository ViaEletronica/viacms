<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script type="text/javascript">
	
	if ( typeof window.onCategoryChooseFunction === 'undefined' ) {
		
		// quando se clica em uma categoria, essa função é procurada
		window.onCategoryChooseFunction = function(){
			
			updateArticlesList();
			
		}
		
	}
	
	if ( typeof window.selectedCategory === 'undefined' ) {
		
		window.selectedCategory = {
			
			'id': -1
			
		};
		
	}
	
	updateArticlesList = function(){
		
		$.ajax({
			type: "GET",
			data: {
				q: window.articlesLiveSearchTerms,
				c: window.selectedCategory.id,
				ajax: true
			},
			url: '<?= get_url( 'admin/articles/ajax/articles_live_search' ); ?>',
			success: function(data){
				
				$( '#modal-articles-list' ).html( data );
				
			},
			error: function(xhr, textStatus, errorThrown){
				
				console.log('content.text', status + ': ' + error);
				
				for(i in xhr){
					if(i!="channel")
					console.log(i + '>> ' + xhr[i]);
				};
				
			}
		});
		
	}
	
	updateModalArticlesPickerContentTop = function(){
		
		$( '.modal-content' ).each( function( index ) {
			
			var jthis = $( this );
			
			jthis.css( 'top', jthis.parent().find( '.modal-controls' ).outerHeight() );
			
		});
		
	}
	
	applyModalArticlesPicker = function(){
		
		$( ".modal-articles-picker" ).fancybox({
			
			fitToView	: true,
			autoSize	: false,
			closeClick	: false,
			openEffect	: 'elastic',
			closeEffect	: 'none',
			openMethod: 'zoomIn',
			openEasing: 'swing',
			type: 'ajax',
			href: 'admin/articles/ajax/articles_live_search',
			wrapCSS: 'vui-modal',
			helpers:  {
				
				overlay : {
					
					showEarly  : false,
					
				},
				title: null
				
			},
			
			afterLoad: function(){
				
				/**************************************************************/
				/************ montando a estrutura do diálogo modal ***********/
				
				this.inner.append( '<div class="modal-controls"></div>' );
				this.content = '<div class="modal-content"><div id="modal-articles-categories"></div><div id="modal-articles-list">' + this.content + '</div></div>';
				
				var modalControls = $( '.modal-controls' );
				
				/************ montando a estrutura do diálogo modal ***********/
				/**************************************************************/
				
				
				
				/**************************************************************/
				/****************** carregando as categorias ******************/
				
				$.ajax({
					
					type: "GET",
					data: {
						ajax: true,
					},
					url: '<?= get_url( 'admin/articles/ajax/categories_live_search' ); ?>',
					success: function(data){
						
						$( '#modal-articles-categories' ).html( data );
						updateModalArticlesPickerContentTop();
						
					},
					error: function(xhr, textStatus, errorThrown){
						
						console.log('content.text', status + ': ' + error);
						
						for(i in xhr){
							if(i!="channel")
							console.log(i + '>> ' + xhr[i]);
						};
						
					}
					
				});
				
				/****************** carregando as categorias ******************/
				/**************************************************************/
				
				modalControls.append( '<input placeholder="<?= lang( 'search_articles' ); ?>" type="text" name="modal_article_id_live_search_terms" value="" id="modal_article_id_live_search_terms" class="live-search">' );
				//this.content = '<h1>2. My custom title</h1>' + this.content;
				
				var termsControl = $( '#modal_article_id_live_search_terms' );
				
				var delay = (function(){
					var timer = 0;
					return function(callback, ms){
						clearTimeout (timer);
						timer = setTimeout(callback, ms);
					};
				})();
				
				$( '#modal_article_id_live_search_terms' ).keyup(function() {
					
					var termsControl = $( this );
					window.articlesLiveSearchTerms = termsControl.val();
					
					delay(function(){
						
						updateArticlesList();
						
					}, 1 );
					
				});
				
			}
			
		});
		
	}
	
	$( document ).bind( 'ready', function(){
		
		applyModalArticlesPicker();
		
	});
	
</script>
