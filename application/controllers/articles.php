<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require( APPPATH . 'controllers/main.php' );

class Articles extends Main {
	
	public function __construct(){
		
		parent::__construct();
		
		$this->load->model( 'articles_mdl', 'articles' );
		$this->load->language( array( 'articles' ) );
		
		set_current_component();
		
	}
	
	/******************************************************************************/
	/******************************************************************************/
	/******************************* Component index ******************************/
	
	public function index( $action = NULL, $current_menu_item_id = 0, $var1 = NULL, $var2 = NULL, $var3 = NULL, $var4 = NULL ){
		
		$this->component_function = __FUNCTION__;
		$this->component_function_action = $action;
		
		// obtendo os parâmetros globais do componente
		$component_params = $this->current_component[ 'params' ];
		
		// obtendo os parâmetros do item de menu
		if ( $this->mcm->current_menu_item ){
			
			$menu_item_params = get_params( $this->mcm->current_menu_item[ 'params' ] );
			$data[ 'params' ] = filter_params( $component_params, $menu_item_params );
			
		}
		else{
			
			$data[ 'params' ] = $component_params;
			
		}
		
		/**************************************************/
		/****************** Articles list *****************/
		
		if ( $action === 'articles_list' ){
			
			$this->load->helper( array( 'pagination' ) );
			
			// $cp = página atual
			// $ipp = itens por página
			
			$cp = $var3;
			$ipp = $var4 !== NULL ? $var4 : $this->mcm->filtered_system_params[ $this->mcm->environment . '_items_per_page' ];
			
			if ( $cp < 1 OR ! gettype( $cp ) == 'int' ) $cp = 1;
			if ( $ipp < 0 OR ! gettype( $ipp ) == 'int' ) $ipp = $this->mcm->filtered_system_params[ $this->mcm->environment . '_items_per_page' ];
			$offset = ( $cp - 1 ) * $ipp;
			
			$cat_id = $var1;
			$user_id = $var2;
			
			$url = get_url( $this->uri->ruri_string() );
			
			$data[ 'url' ] = $url;
			
			// get articles params
			$gap = array(
				
				'limit' => $ipp,
				'offset' => $offset,
				'cat_id' => $cat_id,
				'user_id' => $user_id,
				'order_by' => $data[ 'params' ][ 'articles_list_order' ] . ' ' . $data[ 'params' ][ 'articles_list_order_mode' ],
				
			);
			
			if ( check_var( $this->mcm->filtered_system_params[ 'article_has_image_first' ] ) ){
				
				$gap[ 'has_image_first' ] = TRUE;
				
			}
			
			// get articles params for pagination
			$pag_gap = array(
				
				'cat_id' => $cat_id,
				'user_id' => $user_id,
				'return_type' => 'count_all_results',
				
			);
			
			$articles = $this->articles->get_articles_respecting_privileges( $gap )->result_array();
			
			//echo 'chamando article list do articles.php <br />';
			$data[ 'pagination' ] = get_pagination(
				
				$this->articles->get_link_articles_list( current_menu_id(), $cat_id, $user_id, TRUE ),
				$cp,
				$ipp,
				$this->articles->get_articles_respecting_privileges( $pag_gap )
				
			);
			
			$data[ 'articles' ] = $articles;
			
			foreach( $data[ 'articles' ] as &$article ){
				
				$article[ 'params' ] = filter_params( $data[ 'params' ], get_params( $article[ 'params' ] ) );
				$article[ 'url' ] = $this->articles->get_link_article_detail( current_menu_id(), $article[ 'id' ], $article[ 'category_id' ] );
				/*
				$query = $this->db->query( 'SELECT * FROM tb_urls WHERE target RLIKE \'^articles/index/article_detail/([^-,][0-9]+)/' . $article[ 'id' ] . '\' LIMIT 1' );
				
				$url = $query->row_array();
				
				if ( empty( $url ) ){
					
					$tb_urls_data = array(
						
						'sef_url' => $article[ 'alias' ],
						'target' => $article[ 'url' ]
						
					);
					
					if ( ! $this->db->insert( 'tb_urls', $tb_urls_data ) ){
						
						msg( ( 'error_trying_insert_url' ), 'title' );
						
					}
					
				}
				*/
				$article[ 'url' ] = get_url( $article[ 'url' ] );
				$article[ 'category_url' ] = $article[ 'category_id' ] ? get_url( $this->articles->get_link_articles_list( current_menu_id(), $article[ 'category_id' ] ) ) : FALSE;
				
			}
			
			$data[ 'categories_array' ] = isset( $this->articles->categories_array ) ? $this->articles->categories_array : NULL;
			
			// obtendo o título do conteúdo da página
			// NÃO SEI PRA QUE DIABOS EU FIZ ESSA LINHA A SEGUIR
			$data[ 'params' ][ 'show_page_content_title' ] = @$data[ 'params' ][ 'show_page_content_title' ];
			
			if ( get_url( $this->mcm->current_menu_item[ 'link' ] ) == $url ){
				
				if ( @$data[ 'params' ][ 'custom_page_title' ] ){
					
					$this->mcm->html_data[ 'content' ][ 'title' ] = $data[ 'params' ][ 'custom_page_title' ];
					
				}
				else{
					
					$this->mcm->html_data[ 'content' ][ 'title' ] = $this->mcm->current_menu_item[ 'title' ];
					
				}
				
			}
			else if ( get_url( $this->mcm->current_menu_item[ 'link' ] ) != $url ){
				
				if ( $cat_id != '-1' AND $cat_id != '0' ){
					
					$this->mcm->html_data[ 'content' ][ 'title' ] = $this->articles->get_category( $cat_id )->row()->title;
					
				}
				else{
					
					$this->mcm->html_data[ 'content' ][ 'title' ] = lang('articles');
					
				}
				
			}
			
			
			if ( ! $this->mcm->current_menu_item ){
				
				if ( $cat_id > 0 ){
					
					$this->mcm->html_data[ 'content' ][ 'title' ] = $this->articles->get_category($cat_id)->row()->title;
					
				}
				else{
					
					$this->mcm->html_data[ 'content' ][ 'title' ] = lang('articles');
					
				}
				
				$this->voutput->set_head_title( $this->mcm->html_data[ 'content' ][ 'title' ] );
				
			}
			
			set_last_url($url);
			
			$this->_page(
				
				array(
					
					'component_view_folder' => $this->component_view_folder,
					'function' => __FUNCTION__,
					'action' => 'list',
					'layout' => $data[ 'params' ][ 'layout_articles_list' ],
					'view' => 'list',
					'data' => $data,
					
				)
				
			);
			
		}
		
		/****************** Articles list *****************/
		/**************************************************/
		
		/**************************************************/
		/***************** Article detail *****************/
		
		else if ( $action === 'article_detail' ){
			
			$article_id = $var1;
			
			$this->articles->increment_hit( $article_id );
			
			// get articles params
			$gap = array(
				
				'art_id' => $article_id,
				'limit' => 1,
				
			);
			
			if ( $article = $this->articles->get_articles_respecting_privileges( $gap )->row_array() ){
				
				$url = get_url( $this->uri->ruri_string() );
				set_last_url( $url );
				
				// obtendo o título do conteúdo da página,
				$data[ 'params' ][ 'show_page_content_title' ] = @$data[ 'params' ][ 'show_page_content_title' ];
				
				if ( get_url( $this->mcm->current_menu_item[ 'link' ] ) != $url ){
					
					$this->mcm->html_data[ 'content' ][ 'title' ] = $article[ 'title' ];
					
				}
				else if ( get_url( $this->mcm->current_menu_item[ 'link' ] ) == $url ){
					
					if ( @$data[ 'params' ][ 'custom_page_content_title' ] ){
						
						$this->mcm->html_data[ 'content' ][ 'title' ] = $data[ 'params' ][ 'custom_page_content_title' ];
						
					}
					else{
						
						$this->mcm->html_data[ 'content' ][ 'title' ] = $this->mcm->current_menu_item[ 'title' ];
						
					}
					
				}
				else{
					
					$this->mcm->html_data[ 'content' ][ 'title' ] = lang( 'articles' );
					
				}
				
				
				
				//$this->mcm->html_data[ 'head' ][ 'title' ] = $this->mcm->html_data[ 'content' ][ 'title' ];
				
				$article[ 'category_url' ] = $article[ 'category_id' ] ? get_url( $this->articles->get_link_articles_list( current_menu_id(), $article[ 'category_id' ] ) ) : FALSE;
				
				$article[ 'params' ] = get_params( $article[ 'params' ] );
				
				$data[ 'params' ] = $article[ 'params' ] = filter_params( $data[ 'params' ], $article[ 'params' ] );
				
				$this->mcm->filtered_system_params = filter_params( $this->mcm->filtered_system_params, $data[ 'params' ] );
				
				$data[ 'article' ] = $article;
				$data[ 'article' ][ 'url' ] = $url;
				
				if ( ! @$data[ 'params' ][ 'custom_page_title' ] ){
					
					if ( @$data[ 'params' ][ 'page_title_on_detail_view' ] ){
						
						if ( $data[ 'params' ][ 'page_title_on_detail_view' ] == 'only_article_title' ){
							
							$this->voutput->set_head_title( $article[ 'title' ] );
							
						}
						else if ( $data[ 'params' ][ 'page_title_on_detail_view' ] == 'article_title_menu_item_title_as_prefix' ){
							
							$this->voutput->set_head_title( $this->mcm->current_menu_item[ 'title' ] . @$this->mcm->filtered_system_params[ 'seo_title_separator' ] . $article[ 'title' ] );
							
						}
						else if ( $data[ 'params' ][ 'page_title_on_detail_view' ] == 'article_title_menu_item_title_as_sufix' ){
							
							$this->voutput->set_head_title( $article[ 'title' ] . @$this->mcm->filtered_system_params[ 'seo_title_separator' ] . $this->mcm->current_menu_item[ 'title' ] );
							
						}
						
					}
					else{
						
						$this->voutput->set_head_title( $article[ 'title' ] );
						
					}
					
				}
				
				
				$head_title_org = '';
				$head_title_org .=											$this->voutput->get_head_title() ? '<meta property="og:title" content="' . $this->voutput->get_head_title() . '" >' : '';
				$head_title_org .=											$data[ 'article' ][ 'url' ] ? '<meta property="og:url" content="' . $data[ 'article' ][ 'url' ] . '" >' : '';
				$head_title_org .=											$data[ 'article' ][ 'image' ] ? '<meta property="og:image" content="' . base_url() . $data[ 'article' ][ 'image' ] . '" >' : '';
				
				$this->voutput->append_head_meta( 'org', $head_title_org, NULL, NULL );
				
				$this->_page(
					
					array(
						
						'component_view_folder' => $this->component_view_folder,
						'function' => __FUNCTION__,
						'action' => 'detail',
						'layout' => $data[ 'params' ][ 'layout_article_detail' ],
						'view' => 'detail',
						'data' => $data,
						
					)
					
				);
				
			}
			else{
				
				show_404();
			}
			
		}
		else{
			
			show_404();
			
		}
		
		/***************** Article detail *****************/
		/**************************************************/
		
	}
	
	/******************************* Component index ******************************/
	/******************************************************************************/
	/******************************************************************************/
	
}
