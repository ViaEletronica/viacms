<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles_module extends CI_Model{
	
	public function run( $module_data = NULL ){
		
		
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Loading models and helpers
		 */
		
		$this->load->model( 'articles_mdl', 'articles' );
		$this->load->helper(
			
			array(
				
				'html',
				
			)
			
		);
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Views
		 */
		
		// definimos a ordenação
		$order_by = check_var( $module_data[ 'params' ][ 'articles_list_order' ] ) ? $module_data[ 'params' ][ 'articles_list_order' ] : NULL;
		$random = NULL;
		if ( $order_by ){
			
			if ( $order_by == 'global' AND ! $this->mcm->components[ 'articles' ][ 'params' ][ 'articles_list_order' ] == 'random' ){
				
				$order_by = $this->mcm->components[ 'articles' ][ 'params' ][ 'articles_list_order' ];
				
			}
			else if ( $order_by == 'random' OR ( $order_by == 'global' AND $this->mcm->components[ 'articles' ][ 'params' ][ 'articles_list_order' ] == 'random' ) ){
				
				$order_by = NULL;
				$random = TRUE;
				
			}
			
		}
		
		if ( check_var( $module_data[ 'params' ][ 'word_limiter' ] ) ){
			
			if ( $module_data[ 'params' ][ 'word_limiter' ] == 'global' AND check_var( $this->mcm->components[ 'articles' ][ 'params' ][ 'word_limiter' ] ) ){
				
				$module_data[ 'params' ][ 'word_limiter' ] = $this->mcm->components[ 'articles' ][ 'params' ][ 'word_limiter' ];
				
			}
			else if ( $order_by == 'random' OR ( $order_by == 'global' AND $this->mcm->components[ 'articles' ][ 'params' ][ 'articles_list_order' ] == 'random' ) ){
				
				$order_by = NULL;
				$random = TRUE;
				
			}
			
		}
		
		// get articles params
		$gap = array(
			
			'limit' => check_var( $module_data[ 'params' ][ 'quantity_of_articles_to_show' ] ) ? $module_data[ 'params' ][ 'quantity_of_articles_to_show' ] : NULL,
			'cat_id' => $module_data[ 'params' ][ 'root_category_id' ],
			'order_by' => $order_by,
			'random' => $random,
			
		);
		
		// definindo os dados a serem enviados às views
		$data[ 'params' ] = $module_data[ 'params' ];
		$data[ 'articles' ] = $this->articles->get_articles_respecting_privileges( $gap )->result_array();
		
		//print_r($data[ 'articles' ]);
		
		$grouped_articles = array();
		
		foreach ( $data[ 'articles' ] as $key => &$article ) {
			
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
			
			$grouped_articles[ $article[ 'category_alias' ] ][ 'title' ] = $article[ 'category_title' ];
			$grouped_articles[ $article[ 'category_alias' ] ][ 'articles' ][] = $article;
			
		}
		
		$data[ 'articles' ] = $grouped_articles;
		
		// carregando as views
		// verificando se o tema do site possui a view
		if ( file_exists( THEMES_PATH . site_theme_modules_views_path() . 'articles' . DS . $module_data[ 'params' ][ 'layout' ] . DS . $module_data[ 'params' ][ 'layout' ] . '.php' ) ){
			
			return $this->load->view( site_theme_modules_views_path() . 'articles' . DS . $module_data[ 'params' ][ 'layout' ] . DS . $module_data[ 'params' ][ 'layout' ], $data, TRUE );
			
		}
		// verificando se a view existe no diretório de views de módulos padrão
		else if ( file_exists( VIEWS_PATH . SITE_MODULES_VIEWS_PATH . 'articles' . DS . $module_data[ 'params' ][ 'layout' ] . DS . $module_data[ 'params' ][ 'layout' ] . '.php' ) ){
			
			return $this->load->view( SITE_MODULES_VIEWS_PATH . 'articles' . DS . $module_data[ 'params' ][ 'layout' ] . DS . $module_data[ 'params' ][ 'layout' ], $data, TRUE );
			
		}
		else {
			
			return lang( 'load_view_fail' ) . ':<br />' . THEMES_PATH . site_theme_modules_views_path() . 'articles' . DS . $module_data[ 'params' ][ 'layout' ] . DS . $module_data[ 'params' ][ 'layout' ] . '.php' . '<br />' . VIEWS_PATH . SITE_MODULES_VIEWS_PATH . 'menu' . DS . $module_data[ 'params' ][ 'layout' ] . DS . $module_data[ 'params' ][ 'layout' ] . '.php';
			
		}
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
	}
	
	public function get_module_params(){
		
		$params = get_params_spec_from_xml( MODULES_PATH . 'articles/params.xml' );
		
		$this->load->model( 'admin/articles_model' );
		$categories = $this->articles_model->get_categories_tree(0,0,'list');
		
		//$menus_types_options = array();
		
		foreach ( $categories as $key => $category ) {
			
			$categories_options[ $category[ 'id' ] ] = $category[ 'title' ];
			
		}
		
		// carregando os layouts do tema atual
		$articles_module_layouts = dir_list_to_array( THEMES_PATH . site_theme_modules_views_path() . 'articles' );
		// carregando os layouts do diretório de views padrão
		$articles_module_layouts = array_merge( $articles_module_layouts, dir_list_to_array( VIEWS_PATH . SITE_MODULES_VIEWS_PATH . 'articles' ) );
		
		foreach ( $params['params_spec']['articles_module_config'] as $key => $element ) {
			
			if ( $element['name'] == 'layout' ){
				
				$spec_options = array();
				
				if ( isset($params['params_spec']['articles_module_config'][$key]['options']) )
					$spec_options = $params['params_spec']['articles_module_config'][$key]['options'];
				
				$params['params_spec']['articles_module_config'][$key]['options'] = is_array( $spec_options ) ? $spec_options + $articles_module_layouts : $articles_module_layouts;
				
			}
			
			if ( $element['name'] == 'root_category_id' ){
				
				$spec_options = array();
				
				if ( isset($params['params_spec']['articles_module_config'][$key]['options']) )
					$spec_options = $params['params_spec']['articles_module_config'][$key]['options'];
				
				$params['params_spec']['articles_module_config'][$key]['options'] = is_array( $spec_options ) ? $spec_options + $categories_options : $categories_options;
				
			}
			
		}
		
		return $params;
	}
	
}
