<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles_categories_search_plugin extends Plugins_mdl{
	
	public function run( &$data, $params = NULL ){
		
		$return = FALSE;
		
		if ( is_object( $this->search ) ) {
			
			log_message( 'debug', '[Plugins] Articles categories search plugin initialized' );
			
			// -------------------------------------------------
			// Parsing vars ------------------------------------
			
			$plugin_params = $this->search->config( 'plugins_params' );
			$plugin_params = isset( $plugin_params[ 'articles_categories_search' ] ) ? $plugin_params[ 'articles_categories_search' ] : FALSE;
			
			// Parsing vars ------------------------------------
			// -------------------------------------------------
			
			// db search params
			$dsp = array(
				
				'plugin_name' => 'articles_categories_search',
				'table_name' => 'tb_articles_categories t1',
				'select_columns' => '
					
					t1.*,
					t2.title as parent_title,
					t2.alias as parent_alias
					
				',
				'tables_to_join' => array(
					
					array( 'tb_articles_categories t2', 't1.parent = t2.id', 'left' ),
					
				),
				'search_columns' => 't1.title, t1.alias, t1.description',
				
			);
			
			$full_search_results = $this->search->db_search( $dsp );
			$full_search_results = $full_search_results ? $full_search_results->result_array() : $full_search_results;
			
			if ( $full_search_results ) {
				
				$_tmp = $this->articles->get_categories_tree( array( 'array' => $full_search_results, ) );
				
				$full_search_results = check_var( $_tmp ) ? $_tmp : $full_search_results;
				
				// apply the string highlight
				if ( $this->search->config( 'terms' ) ) {
					
					$keys = array(
						
						'title',
						'alias',
						'description',
						
					);
					$full_search_results = $this->search->array_highlight( $full_search_results, $keys );
					
				}
				
				$default_search_results = array();
				
				foreach ( $full_search_results as $key => & $search_result ) {
					
					$this->articles->parse_category( $search_result );
					
					$line = & $default_search_results[];
					
					$line[ 'title' ] = isset( $search_result[ 'title' ] ) ? $search_result[ 'title' ] : '';
					$line[ 'image' ] = isset( $search_result[ 'image' ] ) ? $search_result[ 'image' ] : '';
					$line[ 'content' ] = isset( $search_result[ 'description' ] ) ? word_limiter( strip_tags( html_entity_decode( $search_result[ 'description' ] ) ), 20, '...' ) : '';
					
				}
				
				$result = array(
					
					'results' => $default_search_results,
					'full_results' => $full_search_results,
					
				);
				
				$this->search->append_results( 'articles_categories_search', $result );
				
				$return = TRUE;
				
			}
			
		}
		else {
			
			log_message( 'debug', '[Plugins] Articles categories search plugin could not be executed! Search library object not initialized!' );
			
			$return = FALSE;
			
		}
		
		parent::_set_performed( 'articles_categories_search' );
		
		return $return;
		
	}
	
	public function get_params_spec(){
		
	}
	
}
