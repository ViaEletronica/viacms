<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Html_module extends CI_Model{
	
	public function run( $module_data = NULL ){
		
		$params = $module_data[ 'params' ];
		
		return ( ( isset( $params[ 'html_module_content' ] ) AND $params[ 'html_module_content' ] ) ? $params[ 'html_module_content' ] : '' );
		
	}
	
	public function get_module_params(){
		
		$params = get_params_spec_from_xml( MODULES_PATH . 'html/params.xml' );
		
		return $params;
	}
	
}
