<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_loader_plugin extends Plugins_mdl{
	
	public function run( &$data, $params = NULL ){
		
		log_message( 'debug', '[Plugins] Article loader plugin initialized' );
		
		$regex = '/{loadarticle\s*.*?}/i';
		
		$content = $this->voutput->get_content();
		
		preg_match_all( $regex, $content, $matches );
		
		if ( count( $matches[ 0 ] ) ){
			
			$this->load->model( array( 'articles_mdl', 'articles' ) );
			
			foreach ( $matches[ 0 ] as $key => $value ) {
				
				$article_array = str_replace( '{', '', $value );
				$article_array = str_replace( '}', '', $article_array );
				$article_array = trim( $article_array );
				
				$article_array = explode( ' ', $article_array );
				
				unset( $article_array[ 0 ] );
				
				$article_array_final = array(
					
					'menu_item_id' => $this->mcm->current_menu_item[ 'id' ],
					'show_readmore_link' => 1,
					'readmore_text' => '',
					'text_to_show' => 'introtext', // introtext, fulltext, both or 0
					
				);
				
				foreach ( $article_array as $key => $attr ) {
					
					$attr = explode( '=', $attr );
					
					$article_array_final[ $attr[ 0 ] ] = $attr[ 1 ];
					
				}
				
				
				
				if ( $article_array_final[ 'menu_item_id' ] != $this->mcm->current_menu_item[ 'id' ] ){
					
					$menu_item = $this->menus_common_model->get_menu_item( $article_array_final[ 'menu_item_id' ] )->row_array();
					
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
				
				// get articles params
				$gap = array(
					
					'art_id' => $article_array_final[ 'id' ],
					'limit' => 1,
					
				);
				
				if ( $article = $this->articles->get_articles_respecting_privileges( $gap )->row_array() ){
					
					$article[ 'params' ] = filter_params( $this->mcm->article_component[ 'params' ], get_params( $article[ 'params' ] ) );
					
					if ( ( @$article_array_final[ 'text_to_show' ] == 'introtext' OR @$article_array_final[ 'text_to_show' ] == 'both' ) AND @$article[ 'introtext' ] ) {
						
						$readmore_link = '';
						
						if ( @$article_array_final[ 'show_readmore_link' ] ){
							
							$readmore_link .= '<div class="article-read-more-link-wrapper">';
							$readmore_link .= '<a class="article-read-more-link" href="' . get_url( 'articles/index/article_detail/' . $menu_item[ 'id' ] . '/' . $article[ 'id' ] ) . '">' . lang( @$article_array_final[ 'readmore_text' ] ? $article_array_final[ 'readmore_text' ] : $article[ 'params' ][ 'readmore_text' ] ) . '</a>';
							$readmore_link .= '</div>';
							
						}
						
						$content = str_replace( $value, $article[ 'introtext' ] . $readmore_link, $content );
						
					}
					else if ( @$article_array_final[ 'text_to_show' ] == 0 ) {
						
						$readmore_link = '';
						
						if ( @$article_array_final[ 'show_readmore_link' ] ){
							
							$readmore_link .= '<div class="article-read-more-link-wrapper">';
							$readmore_link .= '<a class="article-read-more-link" href="' . get_url( 'articles/index/article_detail/' . $menu_item[ 'id' ] . '/' . $article[ 'id' ] ) . '">' . lang( @$article_array_final[ 'readmore_text' ] ? $article_array_final[ 'readmore_text' ] : $article[ 'params' ][ 'readmore_text' ] ) . '</a>';
							$readmore_link .= '</div>';
							
						}
						
						$content = str_replace( $value, $readmore_link, $content );
						
					}
					else{
						
						$content = str_replace( $value, $article[ 'fulltext' ], $content );
						
					}
					
				}
				
				$content = str_replace( $value, '', $content );
				
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
			
		}
		
		return TRUE;
		
	}
	
}
