<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_loader_plugin extends Plugins_mdl{
	
	public function run( &$data, $params = NULL ){
		
		log_message( 'debug', '[Plugins] Article loader plugin initialized' );
		
		$regex = '/{load_article \s*.*?}/i';
		
		$content = $this->voutput->get_content();
		
		preg_match_all( $regex, $content, $matches );
		
		if ( count( $matches[ 0 ] ) ){
			
			if ( ! $this->load->is_model_loaded( 'articles' ) ) {
				
				$this->load->model( 'articles_mdl', 'articles' );
				
			}
			
			foreach ( $matches[ 0 ] as $key => $match ) {
				
				$article_array = str_replace( '{', '', $match );
				$article_array = str_replace( '}', '', $article_array );
				$article_array = trim( $article_array );
				
				$article_array = explode( ' ', $article_array );
				
				unset( $article_array[ 0 ] );
				
				$plugin_params = array(
					
					'menu_item_id' => $this->mcm->current_menu_item[ 'id' ],
					
					/*
					 * If you want to load more than one category (using the plugin several times),
					 * and would keep them side by side, specify here the number of categories in the same line.
					 * This configuration depends on the layout and template used.
					 */
					'inline_col' => 1,
					'wrapper_class' => '',
					'url' => FALSE, // string or FALSE | overwrite article url
					'show_image' => TRUE,
					'image_as_link' => TRUE,
					'link_mode' => 'article', // image, article
					'show_title' => TRUE,
					'title_as_link' => TRUE,
					'created_date' => FALSE,
					'created_by' => FALSE,
					'category_title' => FALSE,
					'category_title_as_link' => TRUE,
					'show_readmore' => TRUE,
					'show_content' => TRUE,
					'content_word_limit' => 20,
					'readmore_text' => lang( 'readmore' ),
					
				);
				
				foreach ( $article_array as $key => $attr ) {
					
					$attr = explode( '=', $attr );
					
					$_config = $attr[ 0 ];
					$_value = $attr[ 1 ];
					
					$plugin_params[ $attr[ 0 ] ] = $attr[ 1 ];
					
					if ( in_array( $_config , array(
					
						'show_image',
						'image_as_link',
						'show_title',
						'title_as_link',
						'created_date',
						'created_by',
						'category_title',
						'category_title_as_link',
						'show_readmore',
						'show_content',
						
					) ) ) {
						
						$plugin_params[ $_config ] = ( bool ) $_value;
						
					}
					else if ( $_config === 'url' ) {
						
						if ( is_string( $_value ) AND strlen( $_value ) > 0 ) {
							
							$plugin_params[ $_config ] = $_value;
							
						}
						
					}
					else if ( $_config === 'content_word_limit' ) {
						
						if ( is_numeric( $_value ) AND $_value > 0 ) {
							
							$plugin_params[ $_config ] = $_value;
							
						}
						else if ( is_numeric( $_value ) AND $_value == 0 ) {
							
							$plugin_params[ $_config ] = FALSE;
							
						}
						
					}
					else if ( $_config === 'inline_col' ) {
						
						if ( is_numeric( $_value ) AND $_value > 0 ) {
							
							$plugin_params[ $_config ] = ( int ) $_value;
							
						}
						
					}
					else {
						
						$plugin_params[ $_config ] = $_value;
						
					}
					
				}
				
				
				
				if ( $plugin_params[ 'menu_item_id' ] != $this->mcm->current_menu_item[ 'id' ] ){
					
					$menu_item = $this->menus->get_menu_item( $plugin_params[ 'menu_item_id' ] );
					
				}
				else{
					
					$menu_item = $this->mcm->current_menu_item;
					
				}
				
				if ( ! isset( $this->mcm->article_component ) ){
					
					// obtendo o componente articles
					$this->mcm->article_component = $this->mcm->components[ 'articles' ];
					
				}
				
				// obtendo os parâmetros do item de menu
				if ( $menu_item ){
					
					$menu_item_params = get_params( $menu_item[ 'params' ] );
					$articles_component[ 'params' ] = filter_params( $this->mcm->article_component[ 'params' ], $menu_item_params );
					
				}
				
				// getting the article
				$search_config = array(
					
					'plugins' => 'articles_search',
					'ipp' => 1,
					'random' => FALSE,
					'allow_empty_terms' => TRUE,
					'plugins_params' => array(
						
						'articles_search' => array(
							
							'article_id' => $plugin_params[ 'id' ],
							'filter_params' => TRUE,
							
						),
						
					),
					
				);
				
				$this->load->library( 'search' );
				$this->search->config( $search_config );
				
				$article = $this->search->get_full_results( 'articles_search', TRUE );
				
				if ( $article ){
					
					$article = $article[ 0 ];
					
					$article[ 'url' ] = $plugin_params[ 'url' ] ? $plugin_params[ 'url' ] : $article[ 'url' ];
					
				}
				else {
					
					return FALSE;
					
				}
				
				$data[ 'params' ] = $plugin_params;
				$data[ 'article' ] = $article;
				
				$view = $this->load->view( 'plugins/article_loader/default/article_loader', $data, TRUE );
				
				$content = str_replace( $match, minify_html( $view ), $content );
				
			}
			
			$this->voutput->set_content( $content );
			
			/* 
			 * -------------------------------------------------------------------------------------------------
			 * Executa novamente os plugins de conteúdo
			 */
			
			// carrega os plugins de conteúdo
			parent::load( NULL, 'content' );
			
			//parent::_set_performed( 'article_loader' );
			
			/* 
			 * -------------------------------------------------------------------------------------------------
			 */
			
		}
		
		return TRUE;
		
	}
	
}
