<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles_categories_search_plugin extends Plugins_mdl{
	
	public function run( &$data, $params = NULL ){
		
		$return = FALSE;
		
		if ( is_object( $this->search ) ) {
			
			log_message( 'debug', '[Plugins] Articles categories search plugin initialized' );
			
			// db search params
			$dsp = array(
				
				'plugin_name' => 'articles_categories_search',
				'table_name' => 'tb_articles t1',
				'select_columns' => '
					
					t1.*,
					
					t2.title as category_title,
					
					t3.username as created_by_username,
					t3.name as created_by_name,
					
					t4.username as modified_by_username,
					t4.name as modified_by_name,
					
					t5.id as access_user_id,
					t5.username as access_username,
					t5.name as access_user_name,
					
					t6.id as user_group_id,
					t6.alias as user_group_alias,
					t6.title as user_group_title,
					
					t7.id as parent_category_id,
					t7.title as parent_category_title,
					
					t8.username as publish_username,
					t8.name as publish_user_name
					
				',
				'tables_to_join' => array(
					
					array( 'tb_articles_categories t2', 't1.category_id = t2.id', 'left' ),
					array( 'tb_users t3', 't1.created_by_id = t3.id', 'left' ),
					array( 'tb_users t4', 't1.modified_by_id = t4.id', 'left' ),
					array( 'tb_users t5', 't1.access_id = t5.id', 'left' ),
					array( 'tb_users_groups t6', 't1.access_id = t6.id', 'left' ),
					array( 'tb_articles_categories t7', 't2.parent = t7.id', 'left' ),
					array( 'tb_users t8', 't1.publish_user_id = t8.id', 'left' ),
					
				),
				'search_columns' => 't1.title, t2.title, t3.name, t4.name, t5.name, t8.name, t1.introtext, t1.fulltext',
				
			);
			
			$full_search_results = $this->search->db_search( $dsp );
			$full_search_results = $full_search_results ? $full_search_results->result_array() : $full_search_results;
			
			if ( $full_search_results ) {
				
				// apply the string highlight
				if ( $this->search->config( 'terms' ) ) {
					
					$keys = array(
						
						'title',
						'alias',
						'introtext',
						'fulltext',
						
					);
					$full_search_results = $this->search->array_highlight( $full_search_results, $keys );
					
				}
				
				$default_search_results = array();
				
				foreach ( $full_search_results as $key => $search_result ) {
					
					$line = & $default_search_results[];
					
					$line[ 'title' ] = $search_result[ 'title' ];
					$line[ 'image' ] = $search_result[ 'image' ];
					$line[ 'content' ] = $search_result[ 'fulltext' ] ? word_limiter( strip_tags( html_entity_decode( $search_result[ 'fulltext' ] ) ), 20, '...' ) : ( $search_result[ 'introtext' ] ? word_limiter( strip_tags( html_entity_decode( $search_result[ 'introtext' ] ) ), 20, '...' ) : '' );
					
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
