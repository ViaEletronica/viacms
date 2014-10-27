<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Submit_forms_model extends CI_Model{
	
	public function get_component_url_admin(){
		
		return RELATIVE_BASE_URL . '/' . ADMIN_ALIAS . '/contacts';
		
	}
	
	public function menu_item_submit_form(){
		
		if ( isset( $this->mcm->system_params[ 'email_config_enabled' ] ) AND $this->mcm->system_params[ 'email_config_enabled' ] ){
			
			$this->load->model(
			
				array(
					
					'common/submit_forms_common_model',
					
				)
				
			);
			
			$params = get_params_spec_from_xml( APPPATH . 'controllers/admin/com_submit_forms/menu_item_submit_form.xml' );
			
			// obtendo a lista de layouts
			
			// carregando os layouts do tema atual
			$layouts_options = dir_list_to_array( THEMES_PATH . site_theme_components_views_path() . get_class_name( get_class() ) . DS . 'index' . DS . 'submit_form' );
			// carregando os layouts do diretório de views padrão
			$layouts_options = array_merge( $layouts_options, dir_list_to_array( VIEWS_PATH . SITE_COMPONENTS_VIEWS_PATH . get_class_name( get_class() ) . DS . 'index' . DS . 'submit_form' ) );
			
			
			$submit_forms = $this->submit_forms_common_model->get_submit_forms()->result_array();
			$submit_forms_options = array();
			
			foreach ( $submit_forms as $submit_form ){
				
				$submit_forms_options[ $submit_form[ 'id' ] ] = $submit_form[ 'title' ];
				
			}
			
			$current_section = 'submit_form';
			foreach ( $params[ 'params_spec' ][ $current_section ] as $key => $element ) {
				
				if ( $element[ 'name' ] == 'submit_form_id' ){
					
					$spec_options = array();
					
					if ( isset( $params[ 'params_spec' ][ $current_section ][ $key ][ 'options' ] ) )
						$spec_options = $params[ 'params_spec' ][ $current_section ][ $key ][ 'options' ];
					
					$params[ 'params_spec' ][ $current_section ][ $key ][ 'options' ] = is_array( $spec_options ) ? $spec_options + $submit_forms_options : $submit_forms_options;
					
				}
				else if ( $element[ 'name' ] == 'submit_form_layout' ){
					
					$spec_options = array();
					
					if ( isset( $params[ 'params_spec' ][ $current_section ][ $key ][ 'options' ] ) )
						$spec_options = $params[ 'params_spec' ][ $current_section ][ $key ][ 'options' ];
					
					$params[ 'params_spec' ][ $current_section ][ $key ][ 'options' ] = is_array( $spec_options ) ? $spec_options + $layouts_options : $layouts_options;
					
				}
				
			}
			
			//print_r($params);
			
			return $params;
			
		}
		else {
			
			msg( ('email_config_not_enabled' ), 'title' );
			msg( validation_errors( '<div class="error">', '</div>' ), 'error' );
			
			redirect( get_last_url() );
			
		}
		
	}
	
	public function site_submit_form_base_url(){
		
		return 'submit_forms/index/a/sf';
		
	}
	
	public function menu_item_get_link_submit_form( $menu_item_id = NULL, $params = NULL ){
		
		return $this->site_submit_form_base_url() . '/miid/' . $menu_item_id . '/sfid/' . $params[ 'submit_form_id' ];
		
	}
	
}
