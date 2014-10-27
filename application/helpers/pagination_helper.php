<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// $ruri_string_tmpl é a string modelo da url sem o roteamento do codeigniter, ex.: blog/posts/%p%/%ipp%
// $page determina a página atual
// $items_per_page determina a quantidade itens por página
function get_pagination( $ruri_string_tmpl, $page = 1, $items_per_page = 10, $total_results, $layout = 'default' ){
	
	if ( $items_per_page != 0 ){
		
		$CI =& get_instance();
		
		$total_pages = ceil( $total_results / $items_per_page );
		
		$data['uri'] = $ruri_string_tmpl;
		$data['cp'] = $page;
		$data['ipp'] = $items_per_page;
		$data['tp'] = $total_pages;
		
		$hide_pagination_when_only_one_page = @$CI->main_model->params[ environment() . '_hide_pagination_when_only_one_page'] ? $CI->main_model->params[ environment() . '_hide_pagination_when_only_one_page'] : TRUE;
		
		if ( $hide_pagination_when_only_one_page ){
			
			if ( $total_pages > 1 ){
				
				if ( file_exists( THEMES_PATH . environment() . DS . $CI->config->item( environment() . '_theme' ) . DS . 'views' . DS . OTHERS_VIEWS_DIR_NAME . DS . 'pagination' . DS . $layout . 'pagination.php') ){
					
					return $CI->load->view( environment() . DS . $CI->config->item( environment() . '_theme' ) . DS . 'views' . DS . OTHERS_VIEWS_DIR_NAME . DS . 'pagination' . DS . $layout . DS . 'pagination', $data, TRUE);
					
				}
				else if ( file_exists( VIEWS_PATH . environment() . DS . OTHERS_VIEWS_DIR_NAME . DS . 'pagination' . DS . $layout . DS . 'pagination.php') ){
					
					return $CI->load->view( environment() . DS . OTHERS_VIEWS_DIR_NAME . DS . 'pagination' . DS . $layout . DS . 'pagination', $data, TRUE);
					
				}
				
			}
			else return FALSE;
			
		}
		else{
			
			if ( file_exists( THEMES_PATH . environment() . DS . $CI->config->item( environment() . '_theme' ) . DS . 'views' . DS . OTHERS_VIEWS_DIR_NAME . DS . 'pagination' . DS . $layout . 'pagination.php') ){
				
				return $CI->load->view('admin' . DS . $CI->config->item( environment() . '_theme' ) . DS . 'views' . DS . OTHERS_VIEWS_DIR_NAME . DS . 'pagination' . DS . $layout . DS . 'pagination', $data, TRUE);
				
			}
			else if ( file_exists( VIEWS_PATH . environment() . DS . OTHERS_VIEWS_DIR_NAME . DS . 'pagination' . DS . $layout . DS . 'pagination.php') ){
				
				return $CI->load->view( environment() . DS . OTHERS_VIEWS_DIR_NAME . DS . 'pagination' . DS . $layout . DS . 'pagination', $data, TRUE);
				
			}
			
		}
		
	}
	
}

/* End of file general_helper.php */
/* Location: ./application/helpers/pagination_helper.php */