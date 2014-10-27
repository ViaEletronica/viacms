<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

require( APPPATH . 'controllers/main.php' );

class Submit_forms extends Main {
	
	public function __construct(){
		
		parent::__construct();
		
		$this->load->model( array( 'common/submit_forms_common_model' ) );
		$this->load->language( array( 'contacts' ) );
		
		set_current_component();
		
		$this->sfcm = &$this->submit_forms_common_model;
		
	}
	
	/******************************************************************************/
	/******************************************************************************/
	/******************************* Component index ******************************/
	
	public function index(){
		
		// -------------------------------------------------
		// Parsing vars ------------------------------------
		
		$f_params = $this->uri->ruri_to_assoc();
		
		$action =								@isset( $f_params['a'] ) ? $f_params['a'] : 'ul'; // action
		$sub_action =							@isset( $f_params['sa'] ) ? $f_params['sa'] : NULL; // sub action
		$submit_form_id =						@isset( $f_params['sfid'] ) ? $f_params['sfid'] : NULL; // submit form id
		$cp =									@isset( $f_params[ 'cp' ] ) ? $f_params[ 'cp' ] : NULL; // current page
		$ipp =									@isset( $f_params[ 'ipp' ] ) ? $f_params[ 'ipp' ] : NULL; // items per page
		$ob =									@isset( $f_params[ 'ob' ] ) ? $f_params[ 'ob' ] : NULL; // order by
		
		// Parsing vars ------------------------------------
		// -------------------------------------------------
		
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
		/***************** Contact details ****************/
		
		if ( $action === 'sf' AND ( $submit_form_id AND is_numeric( $submit_form_id ) AND is_int( $submit_form_id + 0 ) ) ){
			
			// get submit form params
			$gsfp = array(
				
				'where_condition' => 't1.id = ' . $submit_form_id,
				'limit' => 1,
				
			 );
			
			if ( $submit_form = $this->sfcm->get_submit_forms( $gsfp )->row_array() ){
				
				$url = get_url( $this->uri->ruri_string() );
				set_last_url( $url );
				
				$submit_form[ 'fields' ] = get_params( $submit_form[ 'fields' ] );
				
				$data[ 'params' ] = $submit_form[ 'params' ] = filter_params( $data[ 'params' ], get_params( $submit_form[ 'params' ] ) );
				$data[ 'submit_form' ] = $submit_form;
				$data[ 'submit_form' ][ 'url' ] = $url;
				
				foreach ( $submit_form[ 'fields' ] as $key => $field ) {
					
					$field_name = url_title( $field[ 'label' ], TRUE );
					$formatted_field_name = 'form[' . $field_name . ']';
					
					$rules = array( 'trim' );
					
					if ( isset( $field[ 'field_is_required' ] ) AND $field[ 'field_is_required' ] === '1' ){
						
						$rules[] = 'required';
						
					}
					
					if ( isset( $field[ 'validation_rule' ] ) AND is_array( $field[ 'validation_rule' ] ) ){
						
						foreach ( $field[ 'validation_rule' ] as $key => $rule ) {
							
							$comp = '';
							
							switch ( $rule ) {
								
								case 'matches':
									
									$comp .= '[form[' . url_title( $field[  'validation_rule_parameter_matches'], TRUE ) . ']]';
									break;
									
								case 'DESC':
								
									$order_by_direction = 'ASC';
									break;
									
							}
							
							
							$rules[] = $rule . $comp;
							
						}
						
						
						
					}
					
					$rules[] = 'xss';
					
					$rules = join( '|', $rules );
					
					$this->form_validation->set_rules( $formatted_field_name, lang( $field[ 'label' ] ), $rules );
					
				}
				
				if ( ( isset( $this->mcm->system_params[ 'email_config_enabled' ] ) AND $this->mcm->system_params[ 'email_config_enabled' ] ) AND ( $this->form_validation->run() AND $this->input->post() ) ){
					
					$data[ 'post' ] = $this->input->post();
					
					/**************************************************************************************************/
					/************* Criando o array de emails para os quais as mensagens serão enviadas ****************/
					$emails_to = array();
					
					// Se os emails forem os do contato
					if ( ( isset( $data[ 'params' ][ 'submit_form_param_send_email_to' ] ) AND $data[ 'params' ][ 'submit_form_param_send_email_to' ] == 'contact_emails' ) AND
						( isset( $data[ 'params' ][ 'submit_form_param_send_email_to_contact' ] ) AND $data[ 'params' ][ 'submit_form_param_send_email_to_contact' ] ) ){
						
						$this->load->model( array( 'common/contacts_common_model' ) );
						
						// get contact params
						$gcp = array(
							
							'where_condition' => 't1.id = ' . $data[ 'params' ][ 'submit_form_param_send_email_to_contact' ],
							'limit' => 1,
							
						 );
						
						$contact = $this->contacts_common_model->get_contacts( $gcp )->row_array();
						
						$contact[ 'emails' ] = get_params( $contact[ 'emails' ] );
						
						foreach ( $contact[ 'emails' ] as $key => $email ) {
							
							if ( isset( $email[ 'site_msg' ] ) AND $email[ 'site_msg' ] )
								$emails_to[] = $email[ 'email' ];
							
						}
						
					}
					// Caso contrário, se os emails são personalizados
					else if ( ( isset( $data[ 'params' ][ 'submit_form_param_send_email_to' ] ) AND $data[ 'params' ][ 'submit_form_param_send_email_to' ] == 'custom_emails' ) AND ( isset( $data[ 'params' ][ 'submit_form_param_send_email_to_custom_emails' ] ) AND $data[ 'params' ][ 'submit_form_param_send_email_to_custom_emails' ] ) ){
						
						$custom_emails = explode( "\n", $data[ 'params' ][ 'submit_form_param_send_email_to_custom_emails' ] );
						
						foreach ( $custom_emails as $key => $email ) {
							
							$emails_to[] = $email;
							
						}
						
					}
					
					/************* Criando o array de emails para os quais as mensagens serão enviadas ****************/
					/**************************************************************************************************/
					
					/**************************************************************************************************/
					/*************************** Definindo o tipo de layout a ser usado *******************************/
					$layout_source = NULL;
					
					$email_body = '';
					
					// Se os emails forem os do contato
					if ( ( isset( $data[ 'params' ][ 'submit_form_sending_email_layout_source' ] ) AND $data[ 'params' ][ 'submit_form_sending_email_layout_source' ] == 'layouts_list' ) AND
						( isset( $data[ 'params' ][ 'submit_form_sending_email_layout_view' ] ) AND $data[ 'params' ][ 'submit_form_sending_email_layout_view' ] ) ){
						
						$layout_source = $data[ 'params' ][ 'submit_form_sending_email_layout_source' ];
						
						$layout = $data[ 'params' ][ 'submit_form_sending_email_layout_view' ];
						
						// verificando se o tema atual possui a view
						if ( file_exists( THEMES_PATH . call_user_func( $this->mcm->environment . '_theme_components_views_path' ) . $this->component_view_folder . DS . __FUNCTION__ . DS . 'sending_email' . DS . $layout . DS . 'sending_email.php') ){
							
							$email_body = $this->load->view( call_user_func( $this->mcm->environment . '_theme_components_views_path' ) . $this->component_view_folder . DS . __FUNCTION__ . DS . 'sending_email' . DS . $layout . DS . 'sending_email', $data, TRUE );
							
						}
						// verificando se a view existe no diretório de views padrão
						else if ( file_exists( VIEWS_PATH . get_constant_name( $this->mcm->environment . '_COMPONENTS_VIEWS_PATH' ) . DS . $this->component_view_folder . DS . __FUNCTION__ . DS . 'sending_email' . DS . $layout . DS . 'sending_email.php') ){
							
							$email_body = $this->load->view( get_constant_name( $this->mcm->environment . '_COMPONENTS_VIEWS_PATH' ) . $this->component_view_folder . DS . __FUNCTION__ . DS . 'sending_email' . DS . $layout . DS . 'sending_email', $data, TRUE );
							
						}
						else{
							
							$email_body = lang( 'load_view_fail' ) . ': <b>' . VIEWS_PATH . get_constant_name( $this->mcm->environment . '_COMPONENTS_VIEWS_PATH' ) . $this->component_view_folder . DS . __FUNCTION__ . DS . 'submit_form' . DS . $layout . DS . 'sending_email.php</b>';
							
						}
						
					}
					// Caso contrário, se os emails são personalizados
					if ( ( isset( $data[ 'params' ][ 'submit_form_sending_email_layout_source' ] ) AND $data[ 'params' ][ 'submit_form_sending_email_layout_source' ] == 'custom_layout' ) AND
						( isset( $data[ 'params' ][ 'submit_form_sending_email_layout_custom' ] ) AND $data[ 'params' ][ 'submit_form_sending_email_layout_custom' ] ) ){
							
						$layout_source = $data[ 'params' ][ 'submit_form_sending_email_layout_source' ];
						
						$email_body = $data[ 'params' ][ 'submit_form_sending_email_layout_custom' ];
						
					}
					
					/**********************************************/
					/********** Subistituição dos campos **********/
					
					$find = array();
					$replace = array();
					
					foreach ( $submit_form[ 'fields' ] as $key => $field ) {
						
						if ( ! in_array( $field[ 'field_type' ], array( 'html' ) ) ){
							
							$field_label = $field[ 'label' ];
							$field_name = url_title( $field[ 'label' ], '-', TRUE );
							$formatted_field_name = 'form[' . $field_name . ']';
							$field_value = $data[ 'post' ][ 'form' ][ $field_name ];
							
							$find[] = '{' . $field_label . ':' . 'label}';
							$find[] = '{' . $field_label . ':' . 'value}';
							
							$replace[] = $field_label;
							$replace[] = $field_value;
							
						}
						
					}
					
					$email_body = str_replace( $find, $replace, $email_body );
					
					/********** Subistituição dos campos **********/
					/**********************************************/
					
					//print_r($emails_to);
					
					//print_r($data[ 'params' ]);
					
					/*************************** Definindo o tipo de layout a ser usado *******************************/
					/**************************************************************************************************/
					
					
					
					/**********************************************/
					/******* Subistituição dos outros campos ******/
					
					$email_from = str_replace( $find, $replace, $data[ 'params' ][ 'submit_form_param_send_email_to_from' ] );
					$email_from_name = str_replace( $find, $replace, $data[ 'params' ][ 'submit_form_param_send_email_to_from_name' ] );
					$email_reply_to = str_replace( $find, $replace, $data[ 'params' ][ 'submit_form_param_send_email_to_reply_to' ] );
					$emails_to = $emails_to;
					$emails_cc = str_replace( $find, $replace, $data[ 'params' ][ 'submit_form_param_send_email_to_cc' ] );
					$emails_bcc = str_replace( $find, $replace, $data[ 'params' ][ 'submit_form_param_send_email_to_bcc' ] );
					$email_subject = str_replace( $find, $replace, $data[ 'params' ][ 'submit_form_param_send_email_to_subject' ] );
					
					/******* Subistituição dos outros campos ******/
					/**********************************************/
					
					
					
					// limpando tags html, caso seja exigido pela respectiva opção
					if ( isset( $data[ 'params' ][ 'contact_form_allow_html_tags' ] ) AND ! $data[ 'params' ][ 'contact_form_allow_html_tags' ] ){
						
						foreach ( $data[ 'post' ] as $key => &$value ) {
							
							$value = strip_tags( $value );
							
						}
						
					}
					
					$newline_search = array(
						
						'\r',
						'\n'
						
					);
					$newline_replace = array(
						
						"\r",
						"\n"
						
					);
					$newline = str_replace( $newline_search, $newline_replace, $this->mcm->system_params[ 'email_config_newline' ] );
					
					$config = Array(
					
						'protocol' => $this->mcm->system_params[ 'email_config_protocol' ],
						'smtp_host' => $this->mcm->system_params[ 'email_config_smtp_host' ],
						'smtp_port' => $this->mcm->system_params[ 'email_config_smtp_port' ],
						'smtp_user' => $this->mcm->system_params[ 'email_config_smtp_user' ],
						'smtp_pass' => $this->mcm->system_params[ 'email_config_smtp_pass' ],
						'mailtype' => $this->mcm->system_params[ 'email_config_mailtype' ],
						'charset' => $this->mcm->system_params[ 'email_config_charset' ],
						'wordwrap' => $this->mcm->system_params[ 'email_config_wordwrap' ],
						'newline' => $newline,
						
					 );
					
					
					$this->load->library( 'email', $config );
					
					//$this->email->cc( array( 'Produção' => 'fabiano@viaeletronica.com.br' ) ); 
					//$this->email->bcc( array( 'Suporte' => 'suporte@viaeletronica.com.br' ) ); 
					
					$this->email->from( $email_from, $email_from_name );
					$this->email->reply_to( $email_reply_to );
					$this->email->to( $emails_to );
					$this->email->cc( $emails_cc);
					$this->email->bcc( $emails_bcc);
					$this->email->subject( $email_subject );
					$this->email->message( $email_body );
					
					
					//echo $email_body;
					
					if ( ! $this->email->send() ){
						
						msg( ( 'submit_form_sending_email_fail' ), 'title' );
						msg( $this->email->print_debugger(), 'error' );
						
						
					}
					else{
						
						msg( ( 'thank_you_for_your_message' ), 'title' );
						msg( ( 'sending_email_email_sent' ), 'success' );
						
					}
					
					
					
					/**********************************************/
					/********* Ok, hora de inserir no banco *******/
					
					$db_data = elements( array(
						
						'submit_form_id',
						'submit_datetime',
						'mod_datetime',
						'output',
						'data',
						
					), $data[ 'post' ] );
					
					$submit_datetime = gmt_to_local( now(), $this->mcm->filtered_system_params[ 'time_zone' ] );
					$submit_datetime = strftime( '%Y-%m-%d %T', $submit_datetime );
					
					$db_data[ 'submit_form_id' ] = $submit_form_id;
					$db_data[ 'submit_datetime' ] = $submit_datetime;
					$db_data[ 'mod_datetime' ] = $submit_datetime;
					$db_data[ 'output' ] = $email_body;
					$db_data[ 'data' ] = json_encode( $data[ 'post' ][ 'form' ] );
					
					$this->submit_forms_common_model->insert_user_submit( $db_data );
					
					/********* Ok, hora de inserir no banco *******/
					/**********************************************/
					
					
					
					//echo $this->email->print_debugger();
					
					redirect_last_url();
					
				}
				else if ( ! $this->mcm->system_params[ 'email_config_enabled' ] ){
					
					$data[ 'post' ] = $this->input->post();
					
					msg( ( 'submit_form_sending_email_fail' ), 'title' );
					msg( lang( 'sending_email_is_disabled' ), 'error' );
				}
				else if ( ! $this->form_validation->run() AND validation_errors() != '' ){
					
					$data[ 'post' ] = $this->input->post();
					
					msg( ( 'sending_email_fail' ), 'title' );
					msg( validation_errors( '<div class="error">', '</div>' ), 'error' );
				}
				
				$this->_page(
					
					array(
						
						'component_view_folder' => $this->component_view_folder,
						'function' => __FUNCTION__,
						'action' => 'submit_form',
						'layout' => ( ( isset( $data[ 'params' ][ 'submit_form_layout' ] ) AND $data[ 'params' ][ 'submit_form_layout' ] ) ? $data[ 'params' ][ 'submit_form_layout' ] : 'default' ),
						'view' => 'submit_form',
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
		
		/***************** Contact details ****************/
		/**************************************************/
		
	}
	
	/******************************* Component index ******************************/
	/******************************************************************************/
	/******************************************************************************/
	
}
