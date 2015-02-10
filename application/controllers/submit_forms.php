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
		/******************* Submit form ******************/

		if ( $action === 'sf' AND ( $submit_form_id AND is_numeric( $submit_form_id ) AND is_int( $submit_form_id + 0 ) ) ){

			// get submit form params
			$gsfp = array(

				'where_condition' => 't1.id = ' . $submit_form_id,
				'limit' => 1,

			 );

			if ( $this->input->post() ){

				$data[ 'post' ] = $this->input->post();

				// Quando os campos condicionais entram em ação, os campos ocultados, por exemplo
				// ainda seriam validados, corrigimos isso com esta variável.
				// Quando um campo condicional é ocultado no formulário, lá mesmo adicionamos
				// via javascript o conjunto de elementos que devem ter suas validações ignoradas
				// e recebemos aqui via POST
				$no_validation_fields = isset( $data[ 'post' ][ 'no_validation_fields' ] ) ? $data[ 'post' ][ 'no_validation_fields' ] : array();

			}

			if ( $data[ 'submit_form' ] = $this->sfcm->get_submit_forms( $gsfp )->row_array() ){

				$url = get_url( $this->uri->ruri_string() );
				set_last_url( $url );

				$data[ 'submit_form' ][ 'fields' ] = get_params( $data[ 'submit_form' ][ 'fields' ] );

				$data[ 'params' ] = $data[ 'submit_form' ][ 'params' ] = get_params( $data[ 'submit_form' ][ 'params' ] );
				$data[ 'submit_form' ][ 'url' ] = $url;

				foreach ( $data[ 'submit_form' ][ 'fields' ] as $key => $field ) {

					$field_name = url_title( $field[ 'label' ], '-', TRUE );
					$formatted_field_name = 'form[' . $field_name . ']';

					$rules = array( 'trim' );

					if ( ! check_var( $no_validation_fields[ $field_name ] ) ) {

						if ( isset( $field[ 'field_is_required' ] ) AND $field[ 'field_is_required' ] === '1' ){

							$rules[] = 'required';

						}

						if ( isset( $field[ 'validation_rule' ] ) AND is_array( $field[ 'validation_rule' ] ) ){

							foreach ( $field[ 'validation_rule' ] as $key => $rule ) {

								$comp = '';

								switch ( $rule ) {

									case 'matches':

										$comp .= '[form[' . url_title( $field[  'validation_rule_parameter_matches'], '-', TRUE ) . ']]';
										break;

									case 'DESC':

										$order_by_direction = 'ASC';
										break;

								}


								$rules[] = $rule . $comp;

							}

						}

					}

					// xss fieltering
					if ( check_var( $data[ 'params' ][ 'submit_form_param_send_email_to' ] ) ) {

						$rules[] = 'xss';

					}

					$rules = join( '|', $rules );

					$this->form_validation->set_rules( $formatted_field_name, lang( $field[ 'label' ] ), $rules );



					// articles
					if ( $field[ 'field_type' ] === 'articles' AND isset( $field[ 'articles_category_id' ] ) ) {

						$search_config = array(

							'plugins' => 'articles_search',
							'allow_empty_terms' => TRUE,
							'plugins_params' => array(

								'articles_search' => array(

									'category_id' => $field[ 'articles_category_id' ],
									'recursive_categories' => TRUE,

								),

							),

						);

						$this->load->library( 'search' );
						$this->search->config( $search_config );

						$articles = $this->search->get_full_results( 'articles_search', TRUE );

						$data[ 'submit_form' ][ 'fields' ][ $key ][ 'articles' ] = check_var( $articles ) ? $articles : array();

					}

					// articles
					if ( $field[ 'field_type' ] === 'date' ) {

						$data[ 'submit_form' ][ 'fields' ][ $key ][ 'd' ] = '08';

					}

				}

				if ( $this->form_validation->run() AND $this->input->post() ){

					// Definindo variável de limpeza de tags html
					// atualmente efetiva na views
					// @TODO: fazer a limpeza dos valores recebidos aqui, no controller, não nas views
					$data[ 'submit_forms_allow_html_tags' ] = check_var( $data[ 'params' ][ 'submit_forms_allow_html_tags' ] );

					/**************************************************************************************************/
					/************* Criando o array de emails para os quais as mensagens serão enviadas ****************/
					$emails_to = array();

					// Se os emails forem os do contato
					if ( check_var( $data[ 'params' ][ 'submit_form_param_send_email_to' ] ) AND $data[ 'params' ][ 'submit_form_param_send_email_to' ] == 'contact_emails' AND check_var( $data[ 'params' ][ 'submit_form_param_send_email_to_contact' ] ) ){

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
					else if ( check_var( $data[ 'params' ][ 'submit_form_param_send_email_to' ] ) AND $data[ 'params' ][ 'submit_form_param_send_email_to' ] == 'custom_emails' AND check_var( $data[ 'params' ][ 'submit_form_param_send_email_to_custom_emails' ] ) ){

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

					// Se o layout for da lista
					if ( check_var( $data[ 'params' ][ 'submit_form_sending_email_layout_source' ] ) AND $data[ 'params' ][ 'submit_form_sending_email_layout_source' ] === 'layouts_list' AND check_var( $data[ 'params' ][ 'submit_form_sending_email_layout_view' ] ) ){

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
					// Caso contrário, se for do layout personalizado
					else if ( check_var( $data[ 'params' ][ 'submit_form_sending_email_layout_source' ] ) AND $data[ 'params' ][ 'submit_form_sending_email_layout_source' ] === 'custom_layout' AND check_var( $data[ 'params' ][ 'submit_form_sending_email_layout_custom' ] ) ){

						$layout_source = $data[ 'params' ][ 'submit_form_sending_email_layout_source' ];

						$email_body = $data[ 'params' ][ 'submit_form_sending_email_layout_custom' ];

					}

					// Mensagem para o usuário (submitter)
					$send_email_to_submitter = ( check_var( $data[ 'params' ][ 'sfsmr_send_copy_to_submitter' ] ) AND check_var( $data[ 'params' ][ 'sfsmr_email_field' ] ) ) ? TRUE : FALSE;
					if ( $send_email_to_submitter ) {

						$submitter_layout_source = NULL;

						$submitter_email_body = '';

						// Se o layout for da lista
						if ( check_var( $data[ 'params' ][ 'sfsmr_layout_source' ] ) AND $data[ 'params' ][ 'sfsmr_layout_source' ] === 'layouts_list' AND check_var( $data[ 'params' ][ 'sfsmr_layout_view' ] ) ){

							$submitter_layout_source = $data[ 'params' ][ 'sfsmr_layout_source' ];

							$submitter_layout = $data[ 'params' ][ 'sfsmr_layout_view' ];

							// verificando se o tema atual possui a view
							if ( file_exists( THEMES_PATH . call_user_func( $this->mcm->environment . '_theme_components_views_path' ) . $this->component_view_folder . DS . __FUNCTION__ . DS . 'sending_email_submitter' . DS . $layout . DS . 'sending_email_submitter.php') ){

								$submitter_email_body = $this->load->view( call_user_func( $this->mcm->environment . '_theme_components_views_path' ) . $this->component_view_folder . DS . __FUNCTION__ . DS . 'sending_email_submitter' . DS . $layout . DS . 'sending_email_submitter', $data, TRUE );

							}
							// verificando se a view existe no diretório de views padrão
							else if ( file_exists( VIEWS_PATH . get_constant_name( $this->mcm->environment . '_COMPONENTS_VIEWS_PATH' ) . DS . $this->component_view_folder . DS . __FUNCTION__ . DS . 'sending_email_submitter' . DS . $layout . DS . 'sending_email_submitter.php') ){

								$submitter_email_body = $this->load->view( get_constant_name( $this->mcm->environment . '_COMPONENTS_VIEWS_PATH' ) . $this->component_view_folder . DS . __FUNCTION__ . DS . 'sending_email_submitter' . DS . $layout . DS . 'sending_email_submitter', $data, TRUE );

							}
							else{

								$submitter_email_body = lang( 'load_view_fail' ) . ': <b>' . VIEWS_PATH . get_constant_name( $this->mcm->environment . '_COMPONENTS_VIEWS_PATH' ) . $this->component_view_folder . DS . __FUNCTION__ . DS . 'submit_form' . DS . $layout . DS . 'sending_email.php</b>';

							}

						}
						// Caso contrário, se for do layout personalizado
						else if ( check_var( $data[ 'params' ][ 'sfsmr_layout_source' ] ) AND $data[ 'params' ][ 'sfsmr_layout_source' ] === 'custom_layout' AND check_var( $data[ 'params' ][ 'sfsmr_layout_custom' ] ) ){

							$submitter_layout_source = $data[ 'params' ][ 'sfsmr_layout_source' ];

							$submitter_email_body = $data[ 'params' ][ 'sfsmr_layout_custom' ];

						}

					}

					// inicializando variáveis de substituição dos campos
					$find = array();
					$replace = array();


					/**********************************************/
					/******** Inserting user submit into DB *******/

					$db_data = elements( array(

						'submit_form_id',
						'submit_datetime',
						'mod_datetime',

					), $data[ 'post' ] );

					$submit_datetime = gmt_to_local( now(), $this->mcm->filtered_system_params[ 'time_zone' ] );
					$submit_datetime = strftime( '%Y-%m-%d %T', $submit_datetime );

					$db_data[ 'submit_form_id' ] = $submit_form_id;
					$db_data[ 'submit_datetime' ] = $submit_datetime;
					$db_data[ 'mod_datetime' ] = $submit_datetime;

					if ( $user_submit_id = $this->submit_forms_common_model->insert_user_submit( $db_data ) ){

						if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_save_into_db_success_title' ] ) ) {

							msg( lang( $data[ 'params' ][ 'sfpsm_user_submit_save_into_db_success_title' ] ), 'title' );

						}

						if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_save_into_db_success' ] ) ) {

							msg( lang( $data[ 'params' ][ 'sfpsm_user_submit_save_into_db_success' ] ), 'success' );

						}

						$find[] = '{user_submit_id}';
						$replace[] = $user_submit_id;

					}
					else{

						if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_save_into_db_error_title' ] ) ) {

							msg( lang( $data[ 'params' ][ 'sfpsm_user_submit_save_into_db_error_title' ] ), 'title' );

						}

						if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_save_into_db_error' ] ) ) {

							msg( lang( $data[ 'params' ][ 'sfpsm_user_submit_save_into_db_error' ] ), 'error' );

						}

						redirect_last_url();

					}

					/******** Inserting user submit into DB *******/
					/**********************************************/

					/**********************************************/
					/********** Subistituição dos campos **********/

					foreach ( $data[ 'submit_form' ][ 'fields' ] as $key => $field ) {

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

					// Relativo a mensagem para o usuário (submitter)
					if ( $send_email_to_submitter ) {

						foreach ( $data[ 'submit_form' ][ 'fields' ] as $key => $field ) {

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

						$submitter_email_body = str_replace( $find, $replace, $submitter_email_body );

					}

					/********** Subistituição dos campos **********/
					/**********************************************/



					/**********************************************/
					/******* Subistituição dos outros campos ******/

					$email_from = str_replace( $find, $replace, $data[ 'params' ][ 'submit_form_param_send_email_to_from' ] );
					$email_from_name = str_replace( $find, $replace, $data[ 'params' ][ 'submit_form_param_send_email_to_from_name' ] );
					$email_reply_to = str_replace( $find, $replace, $data[ 'params' ][ 'submit_form_param_send_email_to_reply_to' ] );
					$emails_to = $emails_to;
					$emails_cc = str_replace( $find, $replace, $data[ 'params' ][ 'submit_form_param_send_email_to_cc' ] );
					$emails_bcc = str_replace( $find, $replace, $data[ 'params' ][ 'submit_form_param_send_email_to_bcc' ] );
					$email_subject = str_replace( $find, $replace, $data[ 'params' ][ 'submit_form_param_send_email_to_subject' ] );

					// Relativo a mensagem para o usuário (submitter)
					if ( $send_email_to_submitter ) {

						$submitter_email_from = str_replace( $find, $replace, $data[ 'params' ][ 'sfsmr_from' ] );
						$submitter_email_from_name = str_replace( $find, $replace, $data[ 'params' ][ 'sfsmr_from_name' ] );
						$submitter_email_reply_to = str_replace( $find, $replace, $data[ 'params' ][ 'sfsmr_reply_to' ] );
						$submitter_email_to = str_replace( $find, $replace, $data[ 'params' ][ 'sfsmr_email_field' ] );
						$submitter_email_subject = str_replace( $find, $replace, $data[ 'params' ][ 'sfsmr_subject' ] );

					}

					/******* Subistituição dos outros campos ******/
					/**********************************************/



					/**********************************************/
					/*** Subistituição dos campos nas mensagens ***/

					if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_success_title' ] ) ) {

						$data[ 'params' ][ 'sfpsm_user_submit_email_sent_success_title' ] = str_replace( $find, $replace, $data[ 'params' ][ 'sfpsm_user_submit_email_sent_success_title' ] );

					}

					if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_success' ] ) ) {

						$data[ 'params' ][ 'sfpsm_user_submit_email_sent_success' ] = str_replace( $find, $replace, $data[ 'params' ][ 'sfpsm_user_submit_email_sent_success' ] );

					}

					if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_validation_error_title' ] ) ) {

						$data[ 'params' ][ 'sfpsm_user_submit_email_sent_validation_error_title' ] = str_replace( $find, $replace, $data[ 'params' ][ 'sfpsm_user_submit_email_sent_validation_error_title' ] );

					}

					if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_validation_error' ] ) ) {

						$data[ 'params' ][ 'sfpsm_user_submit_email_sent_validation_error' ] = str_replace( $find, $replace, $data[ 'params' ][ 'sfpsm_user_submit_email_sent_validation_error' ] );

					}

					if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_internal_error_title' ] ) ) {

						$data[ 'params' ][ 'sfpsm_user_submit_email_sent_internal_error_title' ] = str_replace( $find, $replace, $data[ 'params' ][ 'sfpsm_user_submit_email_sent_internal_error_title' ] );

					}

					if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_internal_error' ] ) ) {

						$data[ 'params' ][ 'sfpsm_user_submit_email_sent_internal_error' ] = str_replace( $find, $replace, $data[ 'params' ][ 'sfpsm_user_submit_email_sent_internal_error' ] );

					}

					if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_to_submitter_success_title' ] ) ) {

						$data[ 'params' ][ 'sfpsm_user_submit_email_sent_to_submitter_success_title' ] = str_replace( $find, $replace, $data[ 'params' ][ 'sfpsm_user_submit_email_sent_to_submitter_success_title' ] );

					}

					if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_to_submitter_success' ] ) ) {

						$data[ 'params' ][ 'sfpsm_user_submit_email_sent_to_submitter_success' ] = str_replace( $find, $replace, $data[ 'params' ][ 'sfpsm_user_submit_email_sent_to_submitter_success' ] );

					}

					if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_to_submitter_internal_error_title' ] ) ) {

						$data[ 'params' ][ 'sfpsm_user_submit_email_sent_to_submitter_internal_error_title' ] = str_replace( $find, $replace, $data[ 'params' ][ 'sfpsm_user_submit_email_sent_to_submitter_internal_error_title' ] );

					}

					if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_to_submitter_internal_error' ] ) ) {

						$data[ 'params' ][ 'sfpsm_user_submit_email_sent_to_submitter_internal_error' ] = str_replace( $find, $replace, $data[ 'params' ][ 'sfpsm_user_submit_email_sent_to_submitter_internal_error' ] );

					}

					/*** Subistituição dos campos nas mensagens ***/
					/**********************************************/



					/**********************************************/
					/********* Updating user submit on DB *********/

					$db_update_data = elements( array(

						'output',
						'output_submitter',
						'data',

					), $data[ 'post' ] );

					$db_data[ 'output' ] = $email_body;
					$db_data[ 'output_submitter' ] = $submitter_email_body;
					$db_data[ 'data' ] = json_encode( $data[ 'post' ][ 'form' ] );

					if ( $this->submit_forms_common_model->update_user_submit( $db_data, array( 'id' => $user_submit_id ) ) ){

						log_message( 'debug', '[Submit forms] User submit (' . $user_submit_id . ') updated successfully' );

					}

					/********* Updating user submit on DB *********/
					/**********************************************/



					/**********************************************/
					/*************** Sending e-mails **************/

					if ( check_var( $this->mcm->system_params[ 'email_config_enabled' ] ) ) {

						$newline_search = array(

							'\r',
							'\n'

						);
						$newline_replace = array(

							"\r",
							"\n"

						);
						$newline = str_replace( $newline_search, $newline_replace, $this->mcm->system_params[ 'email_config_newline' ] );
						$mail_useragent = check_var( $this->mcm->system_params[ 'email_config_useragent' ] ) ? $this->mcm->system_params[ 'email_config_useragent' ] : NULL;

						$config = Array(

							'protocol' => $this->mcm->system_params[ 'email_config_protocol' ],
							'smtp_host' => $this->mcm->system_params[ 'email_config_smtp_host' ],
							'smtp_port' => $this->mcm->system_params[ 'email_config_smtp_port' ],
							'smtp_user' => $this->mcm->system_params[ 'email_config_smtp_user' ],
							'smtp_pass' => $this->mcm->system_params[ 'email_config_smtp_pass' ],
							'mailtype' => $this->mcm->system_params[ 'email_config_mailtype' ],
							'charset' => $this->mcm->system_params[ 'email_config_charset' ],
							'wordwrap' => $this->mcm->system_params[ 'email_config_wordwrap' ],
							'smtp_crypto' => $this->mcm->system_params[ 'email_config_smtp_crypto' ],
							'newline' => $newline,
							'useragent' => $mail_useragent,

						 );

						$this->load->library( 'email', $config );

						$this->email->from( $email_from, $email_from_name );
						$this->email->reply_to( $email_reply_to );
						$this->email->to( $emails_to );
						$this->email->cc( $emails_cc);
						$this->email->bcc( $emails_bcc);
						$this->email->subject( $email_subject );
						$this->email->message( $email_body );

						$errors_messages = NULL;
						$success_messages = NULL;
						$info_messages = NULL;

						if ( $this->email->send() ){

							if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_success_title' ] ) ) {

								msg( lang( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_success_title' ] ), 'title' );

							}

							if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_success' ] ) ) {

								msg( lang( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_success' ] ), 'success' );

							}

						}
						else{

							if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_internal_error_title' ] ) ) {

								msg( lang( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_internal_error_title' ] ), 'title' );

							}

							if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_internal_error' ] ) ) {

								msg( lang( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_internal_error' ] ), 'error' );

							}

							log_message( 'error', '[Submit forms] An internal error occurred while trying to send a message!' );

						}

						// Sending to submitter
						if ( $send_email_to_submitter ) {

							$this->email->clear();

							$this->email->from( $submitter_email_from, $submitter_email_from_name );
							$this->email->reply_to( $submitter_email_reply_to );
							$this->email->to( $submitter_email_to );
							$this->email->subject( $submitter_email_subject );
							$this->email->message( $submitter_email_body );

							if ( $this->email->send() ){

								if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_to_submitter_success_title' ] ) ) {

									msg( lang( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_to_submitter_success_title' ] ), 'title' );

								}

								if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_to_submitter_success' ] ) ) {

									msg( lang( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_to_submitter_success' ] ), 'success' );

								}

							}
							else{

								if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_to_submitter_internal_error_title' ] ) ) {

									msg( lang( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_to_submitter_internal_error_title' ] ), 'title' );

								}

								if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_to_submitter_internal_error' ] ) ) {

									msg( lang( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_to_submitter_internal_error' ] ), 'error' );

								}

							}

						}

					}

					/*************** Sending e-mails **************/
					/**********************************************/


					//redirect_last_url();

				}
				else if ( ! $this->form_validation->run() AND validation_errors() != '' ){

					$data[ 'post' ] = $this->input->post();

					if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_validation_error_title' ] ) ) {

						msg( lang( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_validation_error_title' ] ), 'title' );

					}

					if ( check_var( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_validation_error' ] ) ) {

						msg( lang( $data[ 'params' ][ 'sfpsm_user_submit_email_sent_validation_error' ] ), 'error' );

					}

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

		/******************* Submit form ******************/
		/**************************************************/

	}

	/******************************* Component index ******************************/
	/******************************************************************************/
	/******************************************************************************/

}
