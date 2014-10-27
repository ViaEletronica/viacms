<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_module extends CI_Model{
	
	public $module_name = 'contact';
	
	public function run( $module_data = NULL ){
		
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Loading models, languages and helpers
		 */
		
		$this->load->model(
		
			array(
				
				'common/contacts_common_model',
				'admin/contacts_model',
				
			)
			
		);
		
		$ccm = &$this->contacts_common_model;
		
		$this->load->language(
		
			array(
				
				'contacts',
				'admin/modules/contact',
				
			)
			
		);
		
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
		 * Declarando as folhas de estilos
		 */
		
		$this->voutput->append_head_stylesheet( $this->module_name . '-module', STYLES_DIR_URL . '/' . MODULES_ALIAS . '/' . $this->module_name . '/contact-module.css' );
		$this->voutput->append_head_stylesheet( $this->module_name . '-theme-' . $module_data[ 'params' ][ 'contact_module_theme' ], STYLES_DIR_URL . '/' . MODULES_ALIAS . '/' . $this->module_name . '/themes/' . $module_data[ 'params' ][ 'contact_module_theme' ] . '/' . $module_data[ 'params' ][ 'contact_module_theme' ] . '.css' );
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Views
		 */
		
		// get contact params
		$gcp = array(
			
			'where_condition' => 't1.id = ' . $module_data[ 'params' ][ 'contact_module_contact_id' ],
			'limit' => 1,
			
		 );
		
		// definindo os dados a serem enviados às views
		$data[ 'params' ] = $module_data[ 'params' ];
		$data[ 'contact' ] = $ccm->get_contacts( $gcp )->row_array() ;
		
		$data[ 'contact' ];
		
		$data[ 'contact' ][ 'emails' ] = json_decode( $data[ 'contact' ][ 'emails' ], TRUE );
		$data[ 'contact' ][ 'addresses' ] = json_decode( $data[ 'contact' ][ 'addresses' ], TRUE );
		$data[ 'contact' ][ 'phones' ] = json_decode( $data[ 'contact' ][ 'phones' ], TRUE );
		$data[ 'contact' ][ 'websites' ] = json_decode( $data[ 'contact' ][ 'websites' ], TRUE );
		
		//print_r( $data[ 'contact' ] );
		
		// carregando as views
		// verificando se o tema do site possui a view
		if ( file_exists( THEMES_PATH . site_theme_modules_views_path() . $this->module_name . DS . $module_data[ 'params' ][ 'contact_module_layout' ] . DS . $module_data[ 'params' ][ 'contact_module_layout' ] . '.php' ) ){
			
			return $this->load->view( site_theme_modules_views_path() . $this->module_name . DS . $module_data[ 'params' ][ 'contact_module_layout' ] . DS . $module_data[ 'params' ][ 'contact_module_layout' ], $data, TRUE );
			
		}
		// verificando se a view existe no diretório de views de módulos padrão
		else if ( file_exists( VIEWS_PATH . SITE_MODULES_VIEWS_PATH . $this->module_name . DS . $module_data[ 'params' ][ 'contact_module_layout' ] . DS . $module_data[ 'params' ][ 'contact_module_layout' ] . '.php' ) ){
			
			return $this->load->view( SITE_MODULES_VIEWS_PATH . $this->module_name . DS . $module_data[ 'params' ][ 'contact_module_layout' ] . DS . $module_data[ 'params' ][ 'contact_module_layout' ], $data, TRUE );
			
		}
		else {
			
			return lang( 'load_view_fail' ) . ':<br />' . THEMES_PATH . site_theme_modules_views_path() . $this->module_name . DS . $module_data[ 'params' ][ 'contact_module_layout' ] . DS . $module_data[ 'params' ][ 'contact_module_layout' ] . '.php' . '<br />' . VIEWS_PATH . SITE_MODULES_VIEWS_PATH . 'menu' . DS . $module_data[ 'params' ][ 'contact_module_layout' ] . DS . $module_data[ 'params' ][ 'contact_module_layout' ] . '.php';
			
		}
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
	}
	
	public function get_module_params(){
		
		$params = get_params_spec_from_xml( MODULES_PATH . $this->module_name . '/params.xml' );
		
		$this->load->model( 'admin/articles_model' );
		$this->load->model(
		
			array(
				
				'common/contacts_common_model',
				'admin/contacts_model',
				
			)
			
		);
		
		$contacts = $this->contacts_model->get_contacts()->result_array();
		
		foreach ( $contacts as $key => $contact ) {
			
			$contact_options[ $contact[ 'id' ] ] = $contact[ 'name' ];
			
		}
		
		// carregando os layouts do tema atual
		$articles_module_layouts = dir_list_to_array( THEMES_PATH . site_theme_modules_views_path() . $this->module_name );
		// carregando os layouts do diretório de views padrão
		$articles_module_layouts = array_merge( $articles_module_layouts, dir_list_to_array( VIEWS_PATH . SITE_MODULES_VIEWS_PATH . $this->module_name ) );
		
		// carregando os temas
		$themes_options = dir_list_to_array( STYLES_PATH . MODULES_DIR_NAME . DS . $this->module_name . DS . 'themes' );
		
		$params_section_name = 'contact_module_config_contact';
		
		foreach ( $params['params_spec'][ $params_section_name ] as $key => $element ) {
			
			if ( $element['name'] == 'contact_module_contact_id' ){
				
				$spec_options = array();
				
				if ( isset($params['params_spec'][ $params_section_name ][$key]['options']) )
					$spec_options = $params['params_spec'][ $params_section_name ][$key]['options'];
				
				$params['params_spec'][ $params_section_name ][$key]['options'] = is_array( $spec_options ) ? $spec_options + $contact_options : $contact_options;
				
			}
			
		}
		
		$params_section_name = 'contact_module_config_look_and_feel';
		
		foreach ( $params['params_spec'][ $params_section_name ] as $key => $element ) {
			
			if ( $element['name'] == 'contact_module_layout' ){
				
				$spec_options = array();
				
				if ( isset($params['params_spec'][ $params_section_name ][$key]['options']) )
					$spec_options = $params['params_spec'][ $params_section_name ][$key]['options'];
				
				$params['params_spec'][ $params_section_name ][$key]['options'] = is_array( $spec_options ) ? $spec_options + $articles_module_layouts : $articles_module_layouts;
				
			}
			
			if ( $element['name'] == 'contact_module_theme' ){
				
				$spec_options = array();
				
				if ( isset( $params[ 'params_spec' ][ $params_section_name ][ $key ][ 'options' ] ) )
					$spec_options = $params[ 'params_spec' ][ $params_section_name ][ $key ][ 'options' ];
				
				$params[ 'params_spec' ][ $params_section_name ][ $key ][ 'options' ] = is_array( $spec_options ) ? $spec_options + $themes_options : $themes_options;
				
			}
			
		}
		
		return $params;
	}
	
}
