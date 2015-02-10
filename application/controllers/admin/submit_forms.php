<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'controllers/admin/main.php');

class Submit_forms extends Main {

	var $c_urls;

	public function __construct(){

		parent::__construct();

		$this->load->model(array('common/submit_forms_common_model'));
		$this->load->language(array('admin/submit_forms'));

		set_current_component();

		// verifica se o usuário atual possui privilégios para gerenciar menus
		if ( ! $this->users_common_model->check_privileges('submit_forms_management_submit_forms_management') ){
			msg(('access_denied'),'title');
			msg(('access_denied_submit_forms_management_submit_forms_management'),'error');
			redirect_last_url();
		};

		// -------------------------------------------------
		// Component urls ----------------------------------

		$this->c_urls = array();
		$c_urls = & $this->c_urls;


		$base_link_prefix = $this->mcm->environment . '/' . $this->component_name . '/';

		$c_urls[ 'base_c_url' ] = $base_link_prefix;

		$base_link_array = array();

		$sf_add_link_array = $base_link_array + array(

			'a' => 'asf',

		);
		$sf_edit_link_array = $base_link_array + array(

			'a' => 'esf',

		);
		$sf_list_link_array = $base_link_array + array(

			'a' => 'sfl',

		);
		$sf_search_link_array = $base_link_array + array(

			'a' => 's',

		);
		$sf_remove_link_array = $base_link_array + array(

			'a' => 'r',

		);
		$sf_remove_all_link_array = $base_link_array + array(

			'a' => 'ra',

		);
		$sf_change_order_link_array = $base_link_array + array(

			'a' => 'co',

		);
		$sf_up_order_link_array = $base_link_array + array(

			'a' => 'uo',

		);
		$sf_down_order_link_array = $base_link_array + array(

			'a' => 'do',

		);

		$submit_forms_management_alias = 'sfm/';
		$c_urls[ 'sf_management_link' ] = $base_link_prefix . $submit_forms_management_alias;
		$c_urls[ 'sf_add_link' ] = $c_urls[ 'sf_management_link' ] . $this->uri->assoc_to_uri( $sf_add_link_array );
		$c_urls[ 'sf_edit_link' ] = $c_urls[ 'sf_management_link' ] . $this->uri->assoc_to_uri( $sf_edit_link_array );
		$c_urls[ 'sf_list_link' ] = $c_urls[ 'sf_management_link' ] . $this->uri->assoc_to_uri( $sf_list_link_array );
		$c_urls[ 'sf_search_link' ] = $c_urls[ 'sf_management_link' ] . $this->uri->assoc_to_uri( $sf_search_link_array );
		$c_urls[ 'sf_remove_link' ] = $c_urls[ 'sf_management_link' ] . $this->uri->assoc_to_uri( $sf_remove_link_array );
		$c_urls[ 'sf_remove_all_link' ] = $c_urls[ 'sf_management_link' ] . $this->uri->assoc_to_uri( $sf_remove_all_link_array );
		$c_urls[ 'sf_change_order_link' ] = $c_urls[ 'sf_management_link' ] . $this->uri->assoc_to_uri( $sf_change_order_link_array );
		$c_urls[ 'sf_up_order_link' ] = $c_urls[ 'sf_management_link' ] . $this->uri->assoc_to_uri( $sf_up_order_link_array );
		$c_urls[ 'sf_down_order_link' ] = $c_urls[ 'sf_management_link' ] . $this->uri->assoc_to_uri( $sf_down_order_link_array );

		$us_add_link_array = $base_link_array + array(

			'a' => 'aus',

		);
		$us_edit_link_array = $base_link_array + array(

			'a' => 'eus',

		);
		$us_view_link_array = $base_link_array + array(

			'a' => 'vus',

		);
		$us_list_link_array = $base_link_array + array(

			'a' => 'usl',

		);
		$us_search_link_array = $base_link_array + array(

			'a' => 's',

		);
		$us_remove_link_array = $base_link_array + array(

			'a' => 'r',

		);
		$us_remove_all_link_array = $base_link_array + array(

			'a' => 'ra',

		);
		$us_change_order_link_array = $base_link_array + array(

			'a' => 'co',

		);
		$us_up_order_link_array = $base_link_array + array(

			'a' => 'uo',

		);
		$us_down_order_link_array = $base_link_array + array(

			'a' => 'do',

		);
		$us_batch_link_array = $base_link_array + array(

			'a' => 'b',

		);

		$user_submit_management_alias = 'usm/';
		$c_urls[ 'us_management_link' ] = $base_link_prefix . $user_submit_management_alias;
		$c_urls[ 'us_add_link' ] = $c_urls[ 'us_management_link' ] . $this->uri->assoc_to_uri( $us_add_link_array );
		$c_urls[ 'us_edit_link' ] = $c_urls[ 'us_management_link' ] . $this->uri->assoc_to_uri( $us_edit_link_array );
		$c_urls[ 'us_view_link' ] = $c_urls[ 'us_management_link' ] . $this->uri->assoc_to_uri( $us_view_link_array );
		$c_urls[ 'us_list_link' ] = $c_urls[ 'us_management_link' ] . $this->uri->assoc_to_uri( $us_list_link_array );
		$c_urls[ 'us_search_link' ] = $c_urls[ 'us_management_link' ] . $this->uri->assoc_to_uri( $us_search_link_array );
		$c_urls[ 'us_remove_link' ] = $c_urls[ 'us_management_link' ] . $this->uri->assoc_to_uri( $us_remove_link_array );
		$c_urls[ 'us_remove_all_link' ] = $c_urls[ 'us_management_link' ] . $this->uri->assoc_to_uri( $us_remove_all_link_array );
		$c_urls[ 'us_change_order_link' ] = $c_urls[ 'us_management_link' ] . $this->uri->assoc_to_uri( $us_change_order_link_array );
		$c_urls[ 'us_up_order_link' ] = $c_urls[ 'us_management_link' ] . $this->uri->assoc_to_uri( $us_up_order_link_array );
		$c_urls[ 'us_down_order_link' ] = $c_urls[ 'us_management_link' ] . $this->uri->assoc_to_uri( $us_down_order_link_array );
		$c_urls[ 'us_batch_link' ] = $c_urls[ 'us_management_link' ] . $this->uri->assoc_to_uri( $us_batch_link_array );

		$us_ajax_add_link_array = $base_link_array + array(

			'a' => 'aus',

		);
		$us_ajax_edit_link_array = $base_link_array + array(

			'a' => 'eus',

		);
		$us_ajax_view_link_array = $base_link_array + array(

			'a' => 'gus',

		);
		$us_ajax_list_link_array = $base_link_array + array(

			'a' => 'usl',

		);
		$us_ajax_search_link_array = $base_link_array + array(

			'a' => 's',

		);
		$us_ajax_remove_link_array = $base_link_array + array(

			'a' => 'r',

		);
		$us_ajax_remove_all_link_array = $base_link_array + array(

			'a' => 'ra',

		);
		$us_ajax_change_order_link_array = $base_link_array + array(

			'a' => 'co',

		);
		$us_ajax_up_order_link_array = $base_link_array + array(

			'a' => 'uo',

		);
		$us_ajax_down_order_link_array = $base_link_array + array(

			'a' => 'do',

		);

		$us_ajax_management_link_alias = 'us_ajax/';
		$c_urls[ 'us_ajax_management_link' ] = $base_link_prefix . $us_ajax_management_link_alias;
		$c_urls[ 'us_ajax_add_link' ] = $c_urls[ 'us_ajax_management_link' ] . $this->uri->assoc_to_uri( $us_ajax_add_link_array );
		$c_urls[ 'us_ajax_edit_link' ] = $c_urls[ 'us_ajax_management_link' ] . $this->uri->assoc_to_uri( $us_ajax_edit_link_array );
		$c_urls[ 'us_ajax_view_link' ] = $c_urls[ 'us_ajax_management_link' ] . $this->uri->assoc_to_uri( $us_ajax_view_link_array );
		$c_urls[ 'us_ajax_list_link' ] = $c_urls[ 'us_ajax_management_link' ] . $this->uri->assoc_to_uri( $us_ajax_list_link_array );
		$c_urls[ 'us_ajax_search_link' ] = $c_urls[ 'us_ajax_management_link' ] . $this->uri->assoc_to_uri( $us_ajax_search_link_array );
		$c_urls[ 'us_ajax_remove_link' ] = $c_urls[ 'us_ajax_management_link' ] . $this->uri->assoc_to_uri( $us_ajax_remove_link_array );
		$c_urls[ 'us_ajax_remove_all_link' ] = $c_urls[ 'us_ajax_management_link' ] . $this->uri->assoc_to_uri( $us_ajax_remove_all_link_array );
		$c_urls[ 'us_ajax_change_order_link' ] = $c_urls[ 'us_ajax_management_link' ] . $this->uri->assoc_to_uri( $us_ajax_change_order_link_array );
		$c_urls[ 'us_ajax_up_order_link' ] = $c_urls[ 'us_ajax_management_link' ] . $this->uri->assoc_to_uri( $us_ajax_up_order_link_array );
		$c_urls[ 'us_ajax_down_order_link' ] = $c_urls[ 'us_ajax_management_link' ] . $this->uri->assoc_to_uri( $us_ajax_down_order_link_array );



		$us_export_list_link_array = $base_link_array + array(

			'a' => 'usl',

		);
		$us_export_view_csv_link_array = $us_export_list_link_array + array(

			'ct' => 'csv',

		);
		$us_export_download_csv_link_array = $us_export_list_link_array + array(

			'ct' => 'csv',
			'sa' => 'dl',

		);
		$us_export_view_json_link_array = $us_export_list_link_array + array(

			'ct' => 'json',

		);
		$us_export_download_json_link_array = $us_export_list_link_array + array(

			'ct' => 'json',
			'sa' => 'dl',

		);
		$us_export_view_xls_link_array = $us_export_list_link_array + array(

			'ct' => 'xls',

		);
		$us_export_download_xls_link_array = $us_export_list_link_array + array(

			'ct' => 'xls',
			'sa' => 'dl',

		);
		$us_export_view_html_link_array = $us_export_list_link_array + array(

			'ct' => 'html',

		);
		$us_export_download_html_link_array = $us_export_list_link_array + array(

			'ct' => 'html',
			'sa' => 'dl',

		);
		$us_export_view_txt_link_array = $us_export_list_link_array + array(

			'ct' => 'txt',

		);
		$us_export_download_txt_link_array = $us_export_list_link_array + array(

			'ct' => 'txt',
			'sa' => 'dl',

		);
		$us_export_view_pdf_link_array = $us_export_list_link_array + array(

			'ct' => 'pdf',

		);
		$us_export_download_pdf_link_array = $us_export_list_link_array + array(

			'ct' => 'pdf',
			'sa' => 'dl',

		);

		$us_export_management_link_alias = 'export/';
		$c_urls[ 'us_export_management_link' ] = $base_link_prefix . $us_export_management_link_alias;
		$c_urls[ 'us_export_view_csv_link' ] = $c_urls[ 'us_export_management_link' ] . $this->uri->assoc_to_uri( $us_export_view_csv_link_array );
		$c_urls[ 'us_export_download_csv_link' ] = $c_urls[ 'us_export_management_link' ] . $this->uri->assoc_to_uri( $us_export_download_csv_link_array );
		$c_urls[ 'us_export_view_json_link' ] = $c_urls[ 'us_export_management_link' ] . $this->uri->assoc_to_uri( $us_export_view_json_link_array );
		$c_urls[ 'us_export_download_json_link' ] = $c_urls[ 'us_export_management_link' ] . $this->uri->assoc_to_uri( $us_export_download_json_link_array );
		$c_urls[ 'us_export_view_xls_link' ] = $c_urls[ 'us_export_management_link' ] . $this->uri->assoc_to_uri( $us_export_view_xls_link_array );
		$c_urls[ 'us_export_download_xls_link' ] = $c_urls[ 'us_export_management_link' ] . $this->uri->assoc_to_uri( $us_export_download_xls_link_array );
		$c_urls[ 'us_export_view_html_link' ] = $c_urls[ 'us_export_management_link' ] . $this->uri->assoc_to_uri( $us_export_view_html_link_array );
		$c_urls[ 'us_export_download_html_link' ] = $c_urls[ 'us_export_management_link' ] . $this->uri->assoc_to_uri( $us_export_download_html_link_array );
		$c_urls[ 'us_export_view_txt_link' ] = $c_urls[ 'us_export_management_link' ] . $this->uri->assoc_to_uri( $us_export_view_txt_link_array );
		$c_urls[ 'us_export_download_txt_link' ] = $c_urls[ 'us_export_management_link' ] . $this->uri->assoc_to_uri( $us_export_download_txt_link_array );
		$c_urls[ 'us_export_view_pdf_link' ] = $c_urls[ 'us_export_management_link' ] . $this->uri->assoc_to_uri( $us_export_view_pdf_link_array );
		$c_urls[ 'us_export_download_pdf_link' ] = $c_urls[ 'us_export_management_link' ] . $this->uri->assoc_to_uri( $us_export_download_pdf_link_array );


		// Component urls ----------------------------------
		// -------------------------------------------------



	}

	public function index(){

		$this->sfm();

	}

	/*
	 **************************************************************************************************
	 **************************************************************************************************
	 --------------------------------------------------------------------------------------------------
	 Submit_forms management
	 --------------------------------------------------------------------------------------------------
	 */

	public function sfm(){

		// -------------------------------------------------
		// Parsing vars ------------------------------------

		$f_params = $this->uri->ruri_to_assoc();

		$action =								@isset( $f_params['a'] ) ? $f_params['a'] : 'sfl'; // action
		$sub_action =							@isset( $f_params['sa'] ) ? $f_params['sa'] : NULL; // sub action
		$submit_form_id =						@isset( $f_params['sfid'] ) ? $f_params['sfid'] : NULL; // submit form id
		$cp =									@isset( $f_params[ 'cp' ] ) ? $f_params[ 'cp' ] : NULL; // current page
		$ipp =									@isset( $f_params[ 'ipp' ] ) ? $f_params[ 'ipp' ] : NULL; // items per page
		$ob =									@isset( $f_params[ 'ob' ] ) ? $f_params[ 'ob' ] : NULL; // order by

		// Parsing vars ------------------------------------
		// -------------------------------------------------

		// atualizando informações do componente atual
		$this->component_function = __FUNCTION__;
		$this->component_function_action = $action;


		$c_urls = & $this->c_urls;

		$data[ 'c_urls' ] = & $c_urls;

		// admin url
		$a_url = get_url( 'admin' . $this->uri->ruri_string() );

		/*
		 ********************************************************
		 --------------------------------------------------------
		 Submit forms list
		 --------------------------------------------------------
		 */

		if ( $action == 'sfl' OR $action == 's' ){

			$this->load->library(array('str_utils'));
			$this->load->helper( array( 'pagination' ) );

			/*
			 ********************************************************
			 --------------------------------------------------------
			 Ordenção por colunas
			 --------------------------------------------------------
			 */

			$order_by_direction = $this->users_common_model->get_user_preference( 'submit_forms_list_order_by_direction' );

			if ( ! ( $order_by_direction != FALSE AND ( $order_by_direction === 'ASC' OR $order_by_direction === 'DESC' ) ) ){

				$order_by_direction = 'ASC';

			}

			// order by complement
			$comp_ob = '';

			if ( ( $order_by = $this->users_common_model->get_user_preference( 'submit_forms_list_order_by' ) ) != FALSE ){

				$data[ 'order_by' ] = $order_by;

				switch ( $order_by ) {

					case 'id':

						$order_by = 't1.id';
						break;

					case 'alias':

						$order_by = 't1.alias';
						break;

					case 'create_datetime':

						$order_by = 't1.create_datetime';
						break;

					case 'mod_datetime':

						$order_by = 't1.mod_datetime';
						break;

					default:

						$order_by = 't1.title';
						$comp_ob = ', t1.title '. $order_by_direction;
						break;

				}

			}
			else{

				$order_by = 't1.title';
				$data[ 'order_by' ] = 'title';

			}

			$data[ 'order_by_direction' ] = $order_by_direction;

			$order_by = $order_by . ' ' . $order_by_direction . $comp_ob;

			/*
			 --------------------------------------------------------
			 Ordenção por colunas
			 --------------------------------------------------------
			 ********************************************************
			 */

			/*
			 ********************************************************
			 --------------------------------------------------------
			 Paginação
			 --------------------------------------------------------
			 */

			if ( $cp < 1 OR ! gettype( $cp ) == 'int' ) $cp = 1;
			if ( $ipp < 1 OR ! gettype( $ipp ) == 'int' ) $ipp = $this->mcm->filtered_system_params[ 'admin_items_per_page' ];
			$offset = ( $cp - 1 ) * $ipp;

			//validação dos campos
			$errors = FALSE;
			$errors_msg = '';
			$terms = trim( $this->input->post( 'terms', TRUE ) ? $this->input->post( 'terms', TRUE ) : ( $this->input->get( 'q' ) ? urldecode( $this->input->get( 'q' ) ) : FALSE ) );

			if ( $this->input->post( 'submit_search', TRUE ) AND ( $terms OR $terms == 0) ){

				if ( strlen( $terms ) == 0 ){

					$errors = TRUE;
					$errors_msg .= '<div class="error">' . lang( 'validation_error_terms_not_blank' ).'</div>';

				}
				if ( strlen( $terms ) < 2 ){

					$errors = TRUE;
					$errors_msg .= '<div class="error">' . sprintf( lang( 'validation_error_terms_min_lenght' ), 2 ).'</div>';

				}

			}
			else if ( $this->input->post( 'submit_cancel_search', TRUE ) ){

				redirect( $data[ 'submit_forms_list_link' ] );

			}

			$data['search']['terms'] = $terms;

			$this->form_validation->set_rules( 'terms', lang('terms'), 'trim|min_length[2]' );

			$gsf_params = array(

				'order_by' => $order_by,
				'limit' => $ipp,
				'offset' => $offset,

			);

			$get_query = '';

			if( ( $this->input->post( 'submit_search' ) OR $terms ) AND ! $errors){

				$condition = NULL;
				$or_condition = NULL;

				if( $terms ){

					$get_query = urlencode( $terms );

					$full_term = $terms;

					$condition['fake_index_1'] = '';
					$condition['fake_index_1'] .= '(';
					$condition['fake_index_1'] .= '`t1`.`id` LIKE \'%'.$full_term.'%\' ';
					$condition['fake_index_1'] .= 'OR `t1`.`title` LIKE \'%'.$full_term.'%\' ';
					$condition['fake_index_1'] .= 'OR `t1`.`target` LIKE \'%"name":"%'.$full_term.'%"%\' ';
					$condition['fake_index_1'] .= ')';

					$terms = str_replace('#', ' ', $terms);
					$terms = explode(" ", $terms);

					$and_operator = FALSE;
					$like_query = '';

					foreach ($terms as $key => $term) {

						$like_query .= $and_operator === TRUE ? 'AND ' : '';
						$like_query .= '(';
						$like_query .= '`t1`.`id` LIKE \'%'.$full_term.'%\' ';
						$like_query .= 'OR `t1`.`title` LIKE \'%'.$full_term.'%\' ';
						$like_query .= 'OR `t1`.`target` LIKE \'%"name":"%'.$full_term.'%"%\' ';
						$like_query .= ')';

						if ( ! $and_operator ){
							$and_operator = TRUE;
						}

					}

					$or_condition = '(' . $like_query . ')';

					$gsf_params[ 'or_where_condition' ] = $or_condition;

					$get_query = '?q=' . $get_query;

				}

			}
			else if ( $errors ){

				$data[ 'post' ] = $this->input->post();

				msg( ( 'search_fail' ), 'title' );
				msg( $errors_msg,'error' );

				redirect( get_last_url() );

			}

			$submit_forms = $this->submit_forms_common_model->get_submit_forms( $gsf_params )->result_array();

			foreach ( $submit_forms as $key => & $submit_form ) {

				$submit_form_base_link_array = array(

					'sfid' => $submit_form[ 'id' ],

				);

				$submit_form[ 'edit_link' ] = $c_urls[ 'sf_edit_link' ] . '/' . $this->uri->assoc_to_uri( $submit_form_base_link_array );
				$submit_form[ 'remove_link' ] = $c_urls[ 'sf_remove_link' ] . '/' . $this->uri->assoc_to_uri( $submit_form_base_link_array );
				$submit_form[ 'users_submits_link' ] = $c_urls[ 'us_list_link' ] . '/' . $this->uri->assoc_to_uri( $submit_form_base_link_array );
				$submit_form[ 'change_order_link' ] = $c_urls[ 'sf_change_order_link' ] . '/' . $this->uri->assoc_to_uri( $submit_form_base_link_array );
				$submit_form[ 'up_order_link' ] = $c_urls[ 'sf_up_order_link' ] . '/' . $this->uri->assoc_to_uri( $submit_form_base_link_array );
				$submit_form[ 'down_order_link' ] = $c_urls[ 'sf_down_order_link' ] . '/' . $this->uri->assoc_to_uri( $submit_form_base_link_array );

				if ( ! empty( $terms ) ){

					foreach ( $terms as $term ) {

						$submit_form[ 'id' ] = str_highlight( $submit_form[ 'id' ], $term );
						$submit_form[ 'sef_submit_form' ] = str_highlight( $submit_form[ 'sef_submit_form' ], $term );
						$submit_form[ 'target' ] = str_highlight( $submit_form[ 'target' ], $term );

					}

				}

			}

			foreach ( $submit_forms as $key => & $submit_form ) {

				$gus_params[ 'where_condition' ] = array(

					'submit_form_id' => $submit_form[ 'id' ],

				);

				$gus_params[ 'return_type' ] = 'count_all_results';

				$submit_form[ 'users_submit_count' ] = $this->submit_forms_common_model->get_users_submits( $gus_params );

			}

			$data[ 'submit_forms' ] = $submit_forms;

			unset( $gsf_params[ 'order_by' ] );
			unset( $gsf_params[ 'limit' ] );
			unset( $gsf_params[ 'offset' ] );

			$gsf_params[ 'return_type' ] = 'count_all_results';

			$data[ 'pagination' ] = get_pagination(

				( ( ! empty( $terms ) ) ? $data[ 'c_urls' ][ 'sf_search_link' ] : $data[ 'c_urls' ][ 'sf_list_link' ] ) . '/cp/%p%/ipp/%ipp%' . $get_query,
				$cp,
				$ipp,
				$this->submit_forms_common_model->get_submit_forms( $gsf_params )

			);

			/*
			 --------------------------------------------------------
			 Paginação
			 --------------------------------------------------------
			 ********************************************************
			 */

			set_last_url( $a_url );

			$this->_page(

				array(

					'component_view_folder' => $this->component_view_folder,
					'function' => 'submit_forms_management',
					'action' => 'submit_forms_list',
					'layout' => 'default',
					'view' => 'submit_forms_list',
					'data' => $data,

				)

			);

		}

		/*
		 --------------------------------------------------------
		 Submit forms list
		 --------------------------------------------------------
		 ********************************************************
		 */

		/*
		 ********************************************************
		 --------------------------------------------------------
		 Change order by
		 --------------------------------------------------------
		 */

		else if ( ( $action == 'cob' ) AND $ob ){

			$this->users_common_model->set_user_preferences( array( 'submit_forms_list_order_by' => $ob ) );

			if ( ( $order_by_direction = $this->users_common_model->get_user_preference( 'submit_forms_list_order_by_direction' ) ) != FALSE ){

				switch ( $order_by_direction ) {

					case 'ASC':

						$order_by_direction = 'DESC';
						break;

					case 'DESC':

						$order_by_direction = 'ASC';
						break;

				}

				$this->users_common_model->set_user_preferences( array( 'submit_forms_list_order_by_direction' => $order_by_direction ) );

			}
			else {

				$this->users_common_model->set_user_preferences( array( 'submit_forms_list_order_by_direction' => 'ASC' ) );

			}

			redirect( get_last_url() );

		}

		/*
		 --------------------------------------------------------
		 Change order by
		 --------------------------------------------------------
		 ********************************************************
		 */

		/*
		 ********************************************************
		 --------------------------------------------------------
		 Add / edit submit form
		 --------------------------------------------------------
		 */

		else if ( $action == 'asf' OR $action == 'esf' ){

			if ( $action == 'asf' ){

				$submit_form = array();

			}
			if ( $action == 'esf' ){

				$submit_form = $this->submit_forms_common_model->get_submit_form( $submit_form_id )->row_array();
				$data[ 'submit_form' ] = $submit_form;

			}

			// capturando os dados obtidos via post, e guardando-os na variável $post_data
			$post_data = $this->input->post();

			// aqui definimos as ações obtidas via post, ex.: ao salvar, cancelar, adicionar campo, etc.
			// acionados ao submeter os forms
			$submit_action =

				$this->input->post( 'submit_add_field' ) ? 'add_field' :
				( $this->input->post( 'submit_cancel' ) ? 'cancel' :
				( $this->input->post( 'submit' ) ? 'submit' :
				( $this->input->post( 'submit_apply' ) ? 'apply' :
				'none' ) ) );

			if ( ! $post_data ){

				if ( $action == 'esf' ) {

					/*************************************/
					/*************** fields **************/

					$submit_form[ 'fields' ] = json_decode( $submit_form[ 'fields' ], TRUE );

					// verifica se $submit_form['fields'] é um json válido
					if ( $submit_form[ 'fields' ] ){

						// inicializando o array de field
						// o índice 0 é temporário, definido aqui apenas para evitar que seja preenchido pelo json_decode( $submit_form['fields'], TRUE )
						// a ideia é reservar o espaço, e em seguida excluí-lo
						$submit_form[ 'fields' ] = array_merge( array( 0 ), $submit_form[ 'fields' ] );

						// aqui, excluo o primeiro índice, deixando o array começando de 1, e não de 0
						unset( $submit_form[ 'fields' ][ 0 ] );

					}
					else{

						$submit_form[ 'fields' ] = array();

					}

					/*************** fields **************/
					/*************************************/

					$submit_form[ 'params' ] = get_params( $submit_form[ 'params' ] );

				}
				else if( $action == 'asf' ){

					$submit_form[ 'params' ] = array();

				}

			}
			else {

				$submit_form[ 'params' ] = $post_data[ 'params' ];

				/*************************************/
				/*************** fields **************/

				// verifica se há pedido de remoção de campos de fields
				if ( isset( $post_data[ 'submit_remove_field' ] ) ){

					foreach ( $post_data[ 'submit_remove_field' ] as $key => $value ) {

						unset( $post_data[ 'fields' ][ $key ] );

					}

				}

				// verifica se há pedido de adição de campos de fields
				if ( in_array( $submit_action, array( 'add_field' ) ) ){

					$field_key = 0;

					$field_type = isset( $post_data[ 'field_type_to_add' ] ) ? $post_data[ 'field_type_to_add' ] : 'input_text';

					// se existem campos de field, obtem o último índice
					if ( isset( $post_data[ 'fields' ] ) ){

						end( $post_data[ 'fields' ] );
						$field_key = key( $post_data[ 'fields' ] );

					}

					for ( $i = $field_key; $i < $field_key + $post_data[ 'field_fields_to_add' ]; $i++ ) {

						$post_data[ 'fields' ][ $i + 1 ] = array();

						// key é a ordem do field na listagem
						$post_data[ 'fields' ][ $i + 1 ][ 'key' ] = $i + 1;

						$post_data[ 'fields' ][ $i + 1 ][ 'field_type' ] = $field_type;

					}

				}

				// reordenando os índices dos fields
				$post_data[ 'fields' ] = isset( $post_data[ 'fields' ] ) ? $post_data[ 'fields' ] : array();
				$post_data[ 'fields' ] = array_merge( array( 0 ), $post_data[ 'fields' ] );
				$post_data[ 'fields' ] = array_values( $post_data[ 'fields' ] );
				unset( $post_data[ 'fields' ][ 0 ] );

				/*************** fields **************/
				/*************************************/

				$submit_form = array_merge( $submit_form, $post_data );

			}

			/*************************************/
			/*** Reordenando os fields pela key **/

			if ( isset( $submit_form[ 'fields' ] ) AND gettype( $submit_form[ 'fields' ] ) === 'array' ){

				$temp_array = array();

				// part of articles categories code
				// var to prevent extra calls to get the articles categories
				$articles_categories_loaded = FALSE;

				foreach ( $submit_form[ 'fields' ] as $key => $field ) {

					$field[ 'key' ] = $key;
					$temp_array[ $field[ 'key' ] ] = $field;

					// articles categories
					if ( $field[ 'field_type' ] === 'articles' AND ! $articles_categories_loaded ) {

						// loading articles main model
						if ( ! $this->load->is_model_loaded( 'articles' ) ) {

							$this->load->model( 'articles_mdl', 'articles' );

						}

						// loading articles categories
						$data[ 'articles_categories' ] = $this->articles->get_categories_tree( array( 'array' => $this->articles->get_categories( array( 'status' => '1' ) ) ) );

						// prevent extra calls to db
						$articles_categories_loaded = TRUE;

					}

				}
				$submit_form[ 'fields' ] = $temp_array;
				ksort( $submit_form[ 'fields' ] );

				$post_data[ 'fields' ] = $submit_form[ 'fields' ];

			}

			/*** Reordenando os fields pela key **/
			/*************************************/

			if ( $action == 'asf' ){

				if ( empty( $submit_form[ 'fields' ] ) ){

					//$submit_form[ 'fields' ][ 1 ][ 'key' ] = 1;

				}

			}

			$data[ 'submit_form' ] = $submit_form;

			/******************************/
			/********* Parâmetros *********/

			if ( $action == 'esf' ){

				// cruzando os parâmetros globais com os parâmetros locais para obter os valores atuais
				$data[ 'current_params_values' ] = get_params( $submit_form[ 'params' ] );

			}
			else{

				$data[ 'current_params_values' ] = array();

			}

			// obtendo as especificações dos parâmetros
			$data[ 'params_spec' ] = $this->submit_forms_common_model->get_submit_form_params();

			// cruzando os valores padrões das especificações com os do DB
			$data[ 'final_params_values' ] = array_merge( $data[ 'params_spec' ][ 'params_spec_values' ], $data[ 'current_params_values' ] );

			// definindo as regras de validação
			set_params_validations( $data[ 'params_spec' ][ 'params_spec' ] );

			/********* Parâmetros *********/
			/******************************/

			//validação dos campos
			$this->form_validation->set_rules( 'title', lang( 'title' ), 'trim|required' );
			$this->form_validation->set_rules( 'alias', lang( 'alias' ), 'trim' );

			if( in_array( $submit_action, array( 'add_field', 'remove_field' ) ) ){

				msg( ( $submit_action . '_success_message' ), 'success' );

			}
			else if( in_array( $submit_action, array( 'cancel' ) ) ){

				redirect_last_url();

			}
			// se a validação dos campos for positiva
			else if ( $this->form_validation->run() AND ( in_array( $submit_action, array( 'submit', 'apply' ) ) ) ){

				// convertendo os arrays de campos dinâmicos em json para inserção no db
				$post_data[ 'fields' ] = json_encode( $post_data[ 'fields' ] );
				$post_data[ 'params' ] = json_encode( $post_data[ 'params' ] );

				$db_data = elements( array(

					'alias',
					'title',
					'fields',
					'params',

				), $post_data );

				$modified_date_time = gmt_to_local( now(), $this->mcm->filtered_system_params[ 'time_zone' ] );
				$modified_date_time = strftime( '%Y-%m-%d %T', $modified_date_time );

				$db_data[ 'mod_datetime' ] = $modified_date_time;

				if ( $db_data[ 'alias' ] == '' ){
					$db_data[ 'alias' ] = url_title( $db_data[ 'title' ], '-', TRUE );
				}

				if ( $action == 'asf' ){

					$db_data[ 'create_datetime' ] = $modified_date_time;

					$return_id = $this->submit_forms_common_model->insert( $db_data );

					if ( $return_id ){

						msg(('submit_form_created'),'success');

						if ( $this->input->post( 'submit_apply' ) ){

							$assoc_to_uri_array = array(

								'sfid' => $return_id,
								'a' => 'esf',

							);

							$redirect_url = $this->uri->assoc_to_uri( $assoc_to_uri_array );

							$redirect_url = 'admin/' . $this->component_name . '/' . __FUNCTION__ . '/' . $redirect_url;

							redirect( $redirect_url );

						}
						else{
							redirect_last_url();
						}

					}

				}
				else if ( $action == 'esf' ){

					if ( $this->submit_forms_common_model->update( $db_data, array( 'id' => $submit_form_id ) ) ){

						msg( ( 'submit_form_updated' ), 'success' );

						if ( $this->input->post( 'submit_apply' ) ){

							redirect( get_url( 'admin' . $this->uri->ruri_string() ) );

						}
						else{

							redirect_last_url();

						}

					}

				}

			}

			// caso contrário se a validação dos campos for negativa e mensagens de erro conter strings
			else if ( ! $this->form_validation->run() AND validation_errors() != '' ){

				$data[ 'post' ] = $this->input->post();

				msg( ( 'add_submit_form_fail' ),'title' );
				msg( validation_errors( '<div class="error">', '</div>' ), 'error' );

			}

			$this->_page(

				array(

					'component_view_folder' => $this->component_view_folder,
					'function' => 'submit_forms_management',
					'action' => 'submit_form_form',
					'layout' => 'default',
					'view' => 'submit_form_form',
					'data' => $data,

				)

			);

		}

		/*
		 --------------------------------------------------------
		 Add / edit submit form
		 --------------------------------------------------------
		 ********************************************************
		 */

		/*
		 ********************************************************
		 --------------------------------------------------------
		 Remove submit form
		 --------------------------------------------------------
		 */

		else if ( $action == 'rsf' ){

			if ( $submit_form_id AND ( $submit_form = $this->submit_forms_common_model->get_submit_form( $submit_form_id )->row_array() ) ){

				if( $this->input->post( 'submit_cancel' ) ){

					redirect_last_url();

				}
				else if ( $this->input->post( 'submit' ) ){

					if ( $this->submit_forms_common_model->delete( array( 'id'=>$submit_form_id ) ) ){

						msg( 'submit_form_deleted', 'success');
						redirect_last_url();

					}
					else{

						msg($this->lang->line( 'url_deleted_fail' ), 'error' );
						redirect_last_url();

					}

				}
				else{

					$data[ 'submit_form' ] = $submit_form;

					$this->_page(

						array(

							'component_view_folder' => $this->component_view_folder,
							'function' => 'submit_forms_management',
							'action' => 'remove_submit_form',
							'layout' => 'default',
							'view' => 'remove_submit_form',
							'data' => $data,

						)

					);

				}
			}
			else{
				show_404();
			}
		}

		/*
		 --------------------------------------------------------
		 Remove submit form
		 --------------------------------------------------------
		 ********************************************************
		 */

		/*
		 ********************************************************
		 --------------------------------------------------------
		 Remove url
		 --------------------------------------------------------
		 */

		else if ( $action == 'ra' ){


			if ( $this->submit_forms_common_model->delete_all() ){

				msg( 'all_submit_forms_deleted', 'success');
				redirect_last_url();

			}
			else{

				msg($this->lang->line( 'all_submit_forms_deleted_fail' ), 'error' );
				redirect_last_url();

			}

		}

		/*
		 --------------------------------------------------------
		 Remove all
		 --------------------------------------------------------
		 ********************************************************
		 */

		else{
			show_404();
		}
	}

	/*
	 --------------------------------------------------------------------------------------------------
	 Submit_forms management
	 --------------------------------------------------------------------------------------------------
	 **************************************************************************************************
	 **************************************************************************************************
	 */

	/*
	 **************************************************************************************************
	 **************************************************************************************************
	 --------------------------------------------------------------------------------------------------
	 Users submits management
	 --------------------------------------------------------------------------------------------------
	 */

	public function usm(){

		$get = $this->input->get();
		$post = $this->input->post();

		// -------------------------------------------------
		// Parsing vars ------------------------------------

		$f_params = $this->uri->ruri_to_assoc();

		$action =								@isset( $f_params['a'] ) ? $f_params['a'] : 'ul'; // action
		$sub_action =							@isset( $f_params['sa'] ) ? $f_params['sa'] : NULL; // sub action
		$submit_form_id =						@isset( $f_params['sfid'] ) ? $f_params['sfid'] : NULL; // submit form id
		$user_submit_id =						@isset( $f_params['usid'] ) ? $f_params['usid'] : NULL; // user submit id
		$cp =									@isset( $f_params[ 'cp' ] ) ? $f_params[ 'cp' ] : NULL; // current page
		$ipp =									@isset( $f_params[ 'ipp' ] ) ? $f_params[ 'ipp' ] : NULL; // items per page
		$ob =									@isset( $f_params[ 'ob' ] ) ? $f_params[ 'ob' ] : NULL; // order by

		// Parsing vars ------------------------------------
		// -------------------------------------------------

		// atualizando informações do componente atual
		$this->component_function = __FUNCTION__;
		$this->component_function_action = $action;



		$base_link_prefix = 'admin/' . $this->component_name . '/' . __FUNCTION__ . '/';

		$base_link_array = array(

		);

		$add_link_array = $base_link_array + array(

			'a' => 'aus',

		);

		$submit_forms_list_link_array = $base_link_array + array(

			'a' => 'sfl',

		);
		$users_submits_list_link_array = $base_link_array + array(

			'a' => 'usl',

		);

		$search_link_array = $base_link_array + array(

			'a' => 's',

		);

		$delete_all_link_array = $base_link_array + array(

			'a' => 'ra',

		);

		$data[ 'add_link' ] = $base_link_prefix . $this->uri->assoc_to_uri( $add_link_array );
		$data[ 'add_link' ] = $base_link_prefix . $this->uri->assoc_to_uri( $add_link_array );
		$data[ 'submit_forms_list_link' ] = $base_link_prefix . $this->uri->assoc_to_uri( $submit_forms_list_link_array );
		$data[ 'users_submits_list_link' ] = $base_link_prefix . $this->uri->assoc_to_uri( $users_submits_list_link_array );
		$data[ 'search_link' ] = $base_link_prefix . $this->uri->assoc_to_uri( $search_link_array );
		$data[ 'delete_all_link' ] = $base_link_prefix . $this->uri->assoc_to_uri( $delete_all_link_array );

		$c_urls = & $this->c_urls;

		$data[ 'c_urls' ] = & $c_urls;

		// admin url
		$a_url = get_url( $this->environment . $this->uri->ruri_string() );

		if ( $submit_form_id ){

			$data[ 'submit_form_id' ] = $submit_form_id;

		}

		//print_r($post);
		if ( check_var( $post[ 'submit_export' ] ) ){

			if ( check_var( $post[ 'selected_users_submits_ids' ] ) ){

				// export params
				$ep = array(

					'a' => 'usl',
					'usid' => $post[ 'selected_users_submits_ids' ],
					'ct' => $post[ 'submit_export' ],
					'sa' => 'dl',

				);

				$this->export( $ep );

			}
			else {

				msg( ( 'users_submits_export_error' ),'title' );
				msg( ( 'no_users_submits_selected' ), 'error' );
				msg( ( 'select_submissions_to_export' ), 'info' );

				redirect_last_url();

			}

		}

		/*
		 ********************************************************
		 --------------------------------------------------------
		 Users submits list
		 --------------------------------------------------------
		 */
		else if ( $action == 'usl' OR $action == 's' ){

			$this->load->library( array( 'str_utils' ) );
			$this->load->helper( array( 'pagination' ) );

			$gus_params = array();

			// se o id do formulário foi informado, iremos listar as submissões daquele formulário, e com as suas colunas
			if ( $submit_form_id ){

				$gus_params[ 'where_condition' ] = array(

					'submit_form_id' => $submit_form_id,

				);

				$submit_form = $this->submit_forms_common_model->get_submit_form( $submit_form_id )->row_array();

				$submit_form[ 'fields' ] = get_params( $submit_form[ 'fields' ] );
				$submit_form[ 'params' ] = get_params( $submit_form[ 'params' ] );

				// ok, o trabalho com as colunas vai ser o seguinte:
				// primeiro, se é a primeira vez que o usuário acessa a listagem
				// devemos apresentar as colunas baseado em sua importância
				// e essa importância, quem vai definir em primeira instância, é o sistema

				// verificamos se existe o array com as colunas nos parâmetros filtrados
				// se não existir, é aqui que devemos criar
				if ( check_var( $this->mcm->filtered_system_params[ 'admin_submit_form_users_submits_columns' ] ) ){

					$this->mcm->filtered_system_params[ 'admin_submit_form_users_submits_columns' ] = get_params( $this->mcm->filtered_system_params[ 'admin_submit_form_users_submits_columns' ] );

				}

				if ( ! check_var( $this->mcm->filtered_system_params[ 'admin_submit_form_users_submits_columns' ][ 'submit_form_' . $submit_form_id ] ) ){

					$max_columns = 7;

					$priority_search_strings = array(

						'e-mail',
						'voce',
						'username',
						'email',
						'name',
						'date',
						'phone',
						'celphone',
						url_title( lang( 'e-mail' ), '-', TRUE ),
						url_title( lang( 'username' ), '-', TRUE ),
						url_title( lang( 'email' ), '-', TRUE ),
						url_title( lang( 'name' ), '-', TRUE ),
						url_title( lang( 'date' ), '-', TRUE ),
						url_title( lang( 'phone' ), '-', TRUE ),
						url_title( lang( 'celphone' ), '-', TRUE ),

					);

					$columns = array();

					foreach ( $submit_form[ 'fields' ] as $key => $field ) {

						if ( ! in_array( $field[ 'field_type' ], array( 'html', 'button' ) ) ){

							$new_column = & $columns[];

							$new_column[ 'alias' ] = url_title( $field[ 'label' ], '-', TRUE );
							$new_column[ 'title' ] = $field[ 'label' ];
							$new_column[ 'visible' ] = FALSE;

						}

					}

					$search_error = FALSE;

					if ( count( $columns ) > $max_columns ){

						$current_counted_columns = 0;

						// current_priority_search_string_index
						$keep_searching = TRUE;

						$try = 1;

						while ( $keep_searching ) {

							if ( $try < 5 ){

								foreach ( $priority_search_strings as $s_key => $string ) {

									// enquanto o limite de colunas permitidas não for estrapolado ...
									if ( $current_counted_columns < $max_columns ){

										foreach ( $columns as $c_key => & $column ) {

											// se encontrar a string ...
											if ( ! $column[ 'visible' ] AND ( strpos( strtolower( $column[ 'alias' ] ), strtolower( $string ) ) !== FALSE OR
											strpos( strtolower( $column[ 'title' ] ), strtolower( $string ) ) !== FALSE ) ) {

												$column[ 'visible' ] = TRUE;
												$current_counted_columns++;
												break;

											}

										}

									}
									else{

										$keep_searching = FALSE;

									}

								}

								$try++;

							}
							else{

								$search_error = TRUE;
								$keep_searching = FALSE;

							}

						}

					}

					if ( $search_error ){

						foreach ( $columns as $c_key => & $column ) {

							$column[ 'visible' ] = TRUE;

						}

					}
					$user_preference[ 'admin_submit_form_users_submits_columns' ][ 'submit_form_' . $submit_form_id ] = $columns;

					$user_preference[ 'admin_submit_form_users_submits_columns' ] = array_merge_recursive( $user_preference[ 'admin_submit_form_users_submits_columns' ], $this->mcm->filtered_system_params[ 'admin_submit_form_users_submits_columns' ] );

					$user_preference[ 'admin_submit_form_users_submits_columns' ][ 'submit_form_' . $submit_form_id ] = json_encode( $user_preference[ 'admin_submit_form_users_submits_columns' ][ 'submit_form_' . $submit_form_id ] );

					$this->users_common_model->set_user_preferences( $user_preference );

				}
				else {

					$columns = get_params( $this->mcm->filtered_system_params[ 'admin_submit_form_users_submits_columns' ][ 'submit_form_' . $submit_form_id ] );

				}

				$data[ 'submit_form' ] = $columns;
				$data[ 'columns' ] = $columns;

			}

			/*
			 ********************************************************
			 --------------------------------------------------------
			 Ordenção por colunas
			 --------------------------------------------------------
			 */

			if ( ! ( ( $order_by_direction = $this->users_common_model->get_user_preference( 'users_submits_list_order_by_direction' ) ) != FALSE ) ){

				$order_by_direction = 'ASC';

			}

			// order by complement
			$ob_comp = '';

			if ( ( $order_by = $this->users_common_model->get_user_preference( 'users_submits_list_order_by' ) ) != FALSE ){

				$data[ 'order_by' ] = $order_by;

				switch ( $order_by ) {

					case 'id':

						$order_by = 't1.id';
						break;

					case 'submit_form_title':

						$order_by = 't2.title';
						break;

					case 'submit_datetime':

						$order_by = 't1.submit_datetime';
						break;

					case 'output':

						$order_by = 't1.output';
						break;

					case 'data':

						$order_by = 't1.data';
						break;

				}

			}
			else{

				$order_by = 't1.id';
				$data[ 'order_by' ] = 'id';

			}

			$data[ 'order_by_direction' ] = $order_by_direction;

			$order_by = $order_by . ' ' . $order_by_direction . $ob_comp;

			/*
			 --------------------------------------------------------
			 Ordenção por colunas
			 --------------------------------------------------------
			 ********************************************************
			 */

			/*
			 ********************************************************
			 --------------------------------------------------------
			 Paginação
			 --------------------------------------------------------
			 */

			if ( $cp < 1 OR ! gettype( $cp ) == 'int' ) $cp = 1;
			if ( $ipp < 1 OR ! gettype( $ipp ) == 'int' ) $ipp = $this->mcm->filtered_system_params[ 'admin_items_per_page' ];
			$offset = ( $cp - 1 ) * $ipp;

			//validação dos campos
			$errors = FALSE;
			$errors_msg = '';
			$terms = trim( $this->input->post( 'terms', TRUE ) ? $this->input->post( 'terms', TRUE ) : ( $this->input->get( 'q' ) ? urldecode( $this->input->get( 'q' ) ) : FALSE ) );

			if ( $this->input->post( 'submit_search', TRUE ) AND ( $terms OR $terms == 0) ){

				if ( strlen( $terms ) == 0 ){

					$errors = TRUE;
					$errors_msg .= '<div class="error">' . lang( 'validation_error_terms_not_blank' ).'</div>';

				}
				if ( strlen( $terms ) < 2 ){

					$errors = TRUE;
					$errors_msg .= '<div class="error">' . sprintf( lang( 'validation_error_terms_min_lenght' ), 2 ).'</div>';

				}

			}
			else if ( $this->input->post( 'submit_cancel_search', TRUE ) ){

				redirect( $data[ 'users_submits_list_link' ] );

			}

			$data['search']['terms'] = $terms;

			$this->form_validation->set_rules( 'terms', lang('terms'), 'trim|min_length[2]' );

			$gus_params[ 'order_by' ] = $order_by;
			$gus_params[ 'limit' ] = $ipp;
			$gus_params[ 'offset' ] = $offset;

			$get_query = '';

			if( ( $this->input->post( 'submit_search' ) OR $terms ) AND ! $errors){

				$condition = NULL;
				$or_condition = NULL;

				if( $terms ){

					$get_query = urlencode( $terms );

					$full_term = $terms;

					$condition['fake_index_1'] = '';
					$condition['fake_index_1'] .= '(';
					$condition['fake_index_1'] .= '`t1`.`id` LIKE \'%' . $full_term . '%\' ';
					$condition['fake_index_1'] .= 'OR `t2`.`title` LIKE \'%' . $full_term . '%\' ';
					$condition['fake_index_1'] .= 'OR `t1`.`submit_datetime` LIKE \'%' . $full_term . '%\' ';
					$condition['fake_index_1'] .= 'OR `t1`.`output` LIKE \'%' . $full_term . '%\' ';
					$condition['fake_index_1'] .= 'OR `t1`.`data` LIKE \'%"%":"%' . $full_term . '%"%\' ';
					$condition['fake_index_1'] .= ')';

					$terms = str_replace('#', ' ', $terms);
					$terms = explode(" ", $terms);

					$and_operator = FALSE;
					$like_query = '';

					if ( count( $terms ) > 1 ){

						foreach ( $terms as $key => $term ) {

							$like_query .= $and_operator === TRUE ? 'AND ' : '';
							$like_query .= '(';
							$like_query .= '`t1`.`id` LIKE \'%' . $full_term.  '%\' ';
							$like_query .= 'OR `t2`.`title` LIKE \'%' . $full_term . '%\' ';
							$like_query .= 'OR `t1`.`submit_datetime` LIKE \'%' . $full_term . '%\' ';
							$like_query .= 'OR `t1`.`output` LIKE \'%' . $full_term . '%\' ';
							$like_query .= 'OR `t1`.`data` LIKE \'%"%":"%' . $full_term . '%"%\' ';
							$like_query .= ')';

							if ( ! $and_operator ){
								$and_operator = TRUE;
							}

						}

						$or_condition = '(' . $like_query . ')';

					}

					$gus_params[ 'or_where_condition' ] = $or_condition;

					$get_query = '?q=' . $get_query;

				}

			}
			else if ( $errors ){

				$data[ 'post' ] = $this->input->post();

				msg( ( 'search_fail' ), 'title' );
				msg( $errors_msg,'error' );

				redirect( get_last_url() );

			}

			$users_submits = $this->submit_forms_common_model->get_users_submits( $gus_params )->result_array();

			// submit_form_base_link_array
			$sfbla = array();

			// user_submit_base_link_array
			$usbla = array();

			foreach ( $users_submits as $key => & $user_submit ) {

				if ( $submit_form_id ){

					$sfbla = array(

						'sfid' => $submit_form_id,

					);

					$c_urls[ 'back_link' ] = $c_urls[ 'us_list_link' ];

				}

				$usbla = array(

					'usid' => $user_submit[ 'id' ],

				);

				$user_submit[ 'edit_link' ] = $c_urls[ 'us_edit_link' ] . '/' . $this->uri->assoc_to_uri( $sfbla + $usbla );
				$user_submit[ 'view_link' ] = $c_urls[ 'us_view_link' ] . '/' . $this->uri->assoc_to_uri( $sfbla + $usbla );
				$user_submit[ 'remove_link' ] = $c_urls[ 'us_remove_link' ] . '/' . $this->uri->assoc_to_uri( $sfbla + $usbla );
				$user_submit[ 'users_submits_link' ] = $c_urls[ 'us_list_link' ] . '/' . $this->uri->assoc_to_uri( array( 'sfid' => $user_submit[ 'submit_form_id' ], ) );
				$user_submit[ 'change_order_link' ] = $c_urls[ 'us_change_order_link' ] . '/' . $this->uri->assoc_to_uri( $sfbla + $usbla );
				$user_submit[ 'up_order_link' ] = $c_urls[ 'us_up_order_link' ] . '/' . $this->uri->assoc_to_uri( $sfbla + $usbla );
				$user_submit[ 'down_order_link' ] = $c_urls[ 'us_down_order_link' ] . '/' . $this->uri->assoc_to_uri( $sfbla + $usbla );


				if ( ! empty( $terms ) ){

					foreach ( $terms as $term ) {

						$user_submit[ 'id' ] = str_highlight( $user_submit[ 'id' ], $term );
						$user_submit[ 'sef_submit_form' ] = str_highlight( $user_submit[ 'sef_submit_form' ], $term );
						$user_submit[ 'target' ] = str_highlight( $user_submit[ 'target' ], $term );

					}

				}

				$user_submit[ 'data' ] = get_params( $user_submit[ 'data' ] );

			}

			$data[ 'users_submits' ] = $users_submits;

			unset( $gus_params[ 'order_by' ] );
			unset( $gus_params[ 'limit' ] );
			unset( $gus_params[ 'offset' ] );

			$gus_params[ 'return_type' ] = 'count_all_results';

			$data[ 'pagination' ] = get_pagination(

				( ( ! empty( $terms ) ) ? $data[ 'c_urls' ][ 'us_search_link' ] : $data[ 'c_urls' ][ 'us_list_link' ] ) . '/' . $this->uri->assoc_to_uri( $sfbla ) . '/cp/%p%/ipp/%ipp%' . $get_query,
				$cp,
				$ipp,
				$this->submit_forms_common_model->get_users_submits( $gus_params )

			);

			/*
			 --------------------------------------------------------
			 Paginação
			 --------------------------------------------------------
			 ********************************************************
			 */

			// -------------------------------------------------
			// Last url ----------------------------------------

			// setting up the last url
			set_last_url( $a_url );

			// Last url ----------------------------------------
			// -------------------------------------------------

			$this->_page(

				array(

					'component_view_folder' => $this->component_view_folder,
					'function' => 'users_submits_management',
					'action' => 'users_submits_list',
					'layout' => 'default',
					'view' => 'users_submits_list',
					'data' => $data,

				)

			);

		}

		/*
		 --------------------------------------------------------
		 Users submits list
		 --------------------------------------------------------
		 ********************************************************
		 */

		/*
		 ********************************************************
		 --------------------------------------------------------
		 Change order by
		 --------------------------------------------------------
		 */

		else if ( ( $action == 'cob' ) AND $ob ){

			$this->users_common_model->set_user_preferences( array( 'users_submits_list_order_by' => $ob ) );

			if ( ( $order_by_direction = $this->users_common_model->get_user_preference( 'users_submits_list_order_by_direction' ) ) != FALSE ){

				switch ( $order_by_direction ) {

					case 'ASC':

						$order_by_direction = 'DESC';
						break;

					case 'DESC':

						$order_by_direction = 'ASC';
						break;

				}

				$this->users_common_model->set_user_preferences( array( 'users_submits_list_order_by_direction' => $order_by_direction ) );

			}
			else {

				$this->users_common_model->set_user_preferences( array( 'users_submits_list_order_by_direction' => 'ASC' ) );

			}

			redirect_last_url();

		}

		/*
		 --------------------------------------------------------
		 Change order by
		 --------------------------------------------------------
		 ********************************************************
		 */

		/*
		 ********************************************************
		 --------------------------------------------------------
		 Add / edit submit form
		 --------------------------------------------------------
		 */

		else if ( $action == 'aus' OR $action == 'eus' ){

			if ( $action == 'aus' ){

				$submit_form = array();

			}
			if ( $action == 'eus' AND $submit_form_id AND $user_submit_id ){

				// get submit form params
				$gus_params = array(

					'where_condition' => 't1.id = ' . $user_submit_id,
					'limit' => 1,

				 );

				// get submit form params
				$gsfp = array(

					'where_condition' => 't1.id = ' . $submit_form_id,
					'limit' => 1,

				 );

				$submit_form = $this->submit_forms_common_model->get_submit_forms( $gsfp )->row_array();
				$user_submit = $this->submit_forms_common_model->get_users_submits( $gus_params )->row_array();

				$data[ 'submit_form' ] = & $submit_form;
				$data[ 'user_submit' ] = & $user_submit;

				$submit_form[ 'fields' ] = get_params( $submit_form[ 'fields' ] );
				$submit_form[ 'params' ] = get_params( $submit_form[ 'params' ] );
				$user_submit[ 'data' ] = get_params( $user_submit[ 'data' ] );

			}

			foreach ( $submit_form[ 'fields' ] as $key => $field ) {

				$field_name = url_title( $field[ 'label' ], '-', TRUE );
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

								$comp .= '[form[' . url_title( $field[  'validation_rule_parameter_matches'], '-', TRUE ) . ']]';
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






			// capturando os dados obtidos via post, e guardando-os na variável $post_data
			$data[ 'post' ] = $this->input->post();
			$post_data = & $data[ 'post' ];

			// aqui definimos as ações obtidas via post, ex.: ao salvar, cancelar, adicionar campo, etc.
			// acionados ao submeter os forms
			$submit_action =

				$this->input->post( 'submit_cancel' ) ? 'cancel' :
				( $this->input->post( 'submit' ) ? 'submit' :
				( $this->input->post( 'submit_apply' ) ? 'apply' :
				'none' ) );



			if ( ! $post_data ){

				if ( $action == 'eus' ) {



				}
				else if( $action == 'aus' ){



				}

			}
			else{



			}

			if( in_array( $submit_action, array( 'cancel' ) ) ){

				redirect_last_url();

			}
			// se a validação dos campos for positiva
			else if ( $this->form_validation->run() AND ( in_array( $submit_action, array( 'submit', 'apply' ) ) ) ){

				$db_data = elements( array(

					'submit_form_id',
					'mod_datetime',
					'data',

				), $post_data );

				$mod_datetime = gmt_to_local( now(), $this->mcm->filtered_system_params[ 'time_zone' ] );
				$mod_datetime = strftime( '%Y-%m-%d %T', $mod_datetime );

				$db_data[ 'submit_form_id' ] = $submit_form_id;
				$db_data[ 'mod_datetime' ] = $mod_datetime;
				$db_data[ 'data' ] = json_encode( $post_data[ 'form' ] );

				if ( $action == 'aus' ){

					$db_data[ 'submit_datetime' ] = $mod_datetime;

					$return_id = $this->submit_forms_common_model->insert_user_submit( $db_data );

					if ( $return_id ){

						msg(('submit_form_created'),'success');

						if ( $this->input->post( 'submit_apply' ) ){

							$assoc_to_uri_array = array(

								'sfid' => $submit_form_id,
								'usid' => $return_id,
								'a' => 'esf',

							);

							$redirect_url = $this->uri->assoc_to_uri( $assoc_to_uri_array );

							$redirect_url = 'admin/' . $this->component_name . '/' . __FUNCTION__ . '/' . $redirect_url;

							redirect( $redirect_url );

						}
						else{
							redirect_last_url();
						}

					}

				}
				else if ( $action == 'eus' ){

					if ( $this->submit_forms_common_model->update_user_submit( $db_data, array( 'id' => $user_submit_id ) ) ){

						msg( ( 'user_submit_updated' ), 'success' );

						if ( $this->input->post( 'submit_apply' ) ){

							redirect( get_url( 'admin' . $this->uri->ruri_string() ) );

						}
						else{

							redirect_last_url();

						}

					}

				}

			}

			// caso contrário se a validação dos campos for negativa e mensagens de erro conter strings
			else if ( ! $this->form_validation->run() AND validation_errors() != '' ){

				$data[ 'post' ] = $this->input->post();

				msg( ( 'add_submit_form_fail' ),'title' );
				msg( validation_errors( '<div class="error">', '</div>' ), 'error' );

			}

			$this->_page(

				array(

					'component_view_folder' => $this->component_view_folder,
					'function' => 'users_submits_management',
					'action' => 'user_submit_form',
					'layout' => 'default',
					'view' => 'user_submit_form',
					'data' => $data,

				)

			);

		}

		/*
		 --------------------------------------------------------
		 Add / edit submit form
		 --------------------------------------------------------
		 ********************************************************
		 */

		/*
		 ********************************************************
		 --------------------------------------------------------
		 View submit form
		 --------------------------------------------------------
		 */

		else if ( $action == 'vus' ){

			if ( $submit_form_id AND $user_submit_id ){

				// get submit form params
				$gus_params = array(

					'where_condition' => 't1.id = ' . $user_submit_id,
					'limit' => 1,

				 );

				// get submit form params
				$gsfp = array(

					'where_condition' => 't1.id = ' . $submit_form_id,
					'limit' => 1,

				 );

				$submit_form = $this->submit_forms_common_model->get_submit_forms( $gsfp )->row_array();
				$user_submit = $this->submit_forms_common_model->get_users_submits( $gus_params )->row_array();

				$data[ 'submit_form' ] = & $submit_form;
				$data[ 'user_submit' ] = & $user_submit;

				$submit_form[ 'fields' ] = get_params( $submit_form[ 'fields' ] );
				$submit_form[ 'params' ] = get_params( $submit_form[ 'params' ] );
				$user_submit[ 'data' ] = get_params( $user_submit[ 'data' ] );

			}

			$this->_page(

				array(

					'component_view_folder' => $this->component_view_folder,
					'function' => 'users_submits_management',
					'action' => 'view_user_submit',
					'layout' => 'default',
					'view' => 'view_user_submit',
					'data' => $data,

				)

			);

		}

		/*
		 --------------------------------------------------------
		 View user submit
		 --------------------------------------------------------
		 ********************************************************
		 */

		/*
		 ********************************************************
		 --------------------------------------------------------
		 Batch
		 --------------------------------------------------------
		 */

		else if ( $action == 'b' ){

			$ids = array();
			$success = FALSE;
			$errors_count = 0;
			$msg_result = '';

			if ( $this->input->post( 'submit_remove' ) AND $this->input->post( 'selected_users_submits_ids' ) ){

				$ids = $this->input->post( 'selected_articles_ids' );

			}
			else if ( $id AND ! is_array( $id ) ){

				$ids[] = $id;

			}

			if ( $this->input->post( 'submit_remove' ) AND $this->input->post( 'selected_users_submits_ids' ) ){

				$ids = $this->input->post( 'selected_users_submits_ids' );

				foreach ( $ids as $key => $id ) {

					if ( $this->submit_forms_common_model->remove_user_submit( $id ) ){

						$success = TRUE;

					}
					else{

						$errors_count++;
						$msg_result .= lang( 'error_removed_user_submit' ) . ' #' . $id . '<br />';

					}

				}

				if ( $errors_count > 0 ){

					msg( 'error_removing_users_submits', 'title' );
					msg( $msg_result, 'error' );

				}
				else {

					msg( 'users_submits_removed_success', 'success' );

				}

				redirect_last_url();

			}
			else {

				redirect_last_url();

			}

		}

		/*
		 --------------------------------------------------------
		 Batch
		 --------------------------------------------------------
		 ********************************************************
		 */

		/*
		 ********************************************************
		 --------------------------------------------------------
		 Remove submit form
		 --------------------------------------------------------
		 */

		else if ( $action == 'r' ){

			$id = $user_submit_id;

			if ( $id AND ( $user_submit = $this->submit_forms_common_model->get_user_submit( $id ) ) ){

				if( $this->input->post( 'submit_cancel' ) ){

					redirect_last_url();

				}
				else if ( $this->input->post( 'submit' ) ){

					if ( $this->submit_forms_common_model->remove_user_submit( $id ) ){

						msg( 'user_submit_deleted', 'success');
						redirect_last_url();

					}
					else{

						msg($this->lang->line( 'user_submit_deleted_fail' ), 'error' );
						redirect_last_url();

					}

				}
				else{

					$data[ 'user_submit' ] = $user_submit;

					$this->_page(

						array(

							'component_view_folder' => $this->component_view_folder,
							'function' => 'users_submits_management',
							'action' => 'remove_user_submit',
							'layout' => 'default',
							'view' => 'remove_user_submit',
							'data' => $data,

						)

					);

				}
			}
			else{
				show_404();
			}
		}

		/*
		 --------------------------------------------------------
		 Remove submit form
		 --------------------------------------------------------
		 ********************************************************
		 */

		else{
			show_404();
		}

	}

	/*
	 --------------------------------------------------------------------------------------------------
	 Users submits management
	 --------------------------------------------------------------------------------------------------
	 **************************************************************************************************
	 **************************************************************************************************
	 */

	/*
	 **************************************************************************************************
	 **************************************************************************************************
	 --------------------------------------------------------------------------------------------------
	 Export
	 --------------------------------------------------------------------------------------------------
	 */

	public function export( $f_params = NULL ){

		$get = $this->input->get();
		$post = $this->input->post();

		// -------------------------------------------------
		// Parsing vars ------------------------------------

		$f_params = gettype( $f_params ) === 'array' ? $f_params : $this->uri->ruri_to_assoc();

		$action =								isset( $f_params[ 'a' ] ) ? $f_params[ 'a' ] : ( isset( $get[ 'a' ] ) ? $get[ 'a' ] : NULL ); // action
		$sub_action =							isset( $f_params[ 'sa' ] ) ? $f_params[ 'sa' ] : ( isset( $get[ 'sa' ] ) ? $get[ 'sa' ] : NULL ); // sub action
		$submit_form_id =						isset( $f_params[ 'sfid' ] ) ? $f_params[ 'sfid' ] : ( isset( $get[ 'sfid' ] ) ? $get[ 'sfid' ] : NULL ); // submit form id
		$user_submit_id =						isset( $f_params[ 'usid' ] ) ? $f_params[ 'usid' ] : ( isset( $get[ 'usid' ] ) ? $get[ 'usid' ] : NULL ); // user submit id
		$content_type =							isset( $f_params[ 'ct' ] ) ? $f_params[ 'ct' ] : ( isset( $get[ 'ct' ] ) ? $get[ 'ct' ] : 'txt' ); // return type: json, xml, pdf, etc.
		$cp =									isset( $f_params[ 'cp' ] ) ? $f_params[ 'cp' ] : ( isset( $get[ 'cp' ] ) ? $get[ 'cp' ] : NULL ); // current page
		$ipp =									isset( $f_params[ 'ipp' ] ) ? $f_params[ 'ipp' ] : ( isset( $get[ 'ipp' ] ) ? $get[ 'ipp' ] : NULL ); // items per page
		$ob =									isset( $f_params[ 'ob' ] ) ? $f_params[ 'ob' ] : ( isset( $get[ 'ob' ] ) ? $get[ 'ob' ] : NULL ); // order by

		if ( check_var( $post[ 'submit_export' ] ) ){

			if ( check_var( $post[ 'selected_users_submits_ids' ] ) ){

				$user_submit_id = $post[ 'selected_users_submits_ids' ];

			}

		}

		// Parsing vars ------------------------------------
		// -------------------------------------------------

		// atualizando informações do componente atual
		$this->component_function = __FUNCTION__;
		$this->component_function_action = $action;

		$c_urls = & $this->c_urls;

		$data[ 'c_urls' ] = & $c_urls;

		// admin url
		$a_url = get_url( 'admin' . $this->uri->ruri_string() );

		/*
		 ********************************************************
		 --------------------------------------------------------
		 Get users submits
		 --------------------------------------------------------
		 */

		$submit_forms = $users_submits = FALSE;

		if ( $action == 'usl' ){

			if ( $user_submit_id ){

				if ( is_array( $user_submit_id ) ){

					$condition['fake_index_1'] = '';

					foreach ( $user_submit_id as $key => $value ) {

						$gus_p[ 'where_condition' ]['fake_index_1'][] = '`t1`.`id` = \'' . $value . '\' ';

					}

					$gus_p[ 'where_condition' ]['fake_index_1'] = '(' . join( ' OR ', $gus_p[ 'where_condition' ]['fake_index_1'] ) . ')';

					$users_submits = $this->submit_forms_common_model->get_users_submits( $gus_p )->result_array();

				}
				else{

					$user_submit = $this->submit_forms_common_model->get_user_submit( $user_submit_id );

				}

				// get submit form params


				if ( $users_submits ){

					foreach ( $users_submits as $key => & $user_submit ) {

						$user_submit[ 'data' ] = get_params( $user_submit[ 'data' ] );

						// get submit form params
						$gsfp = array(

							'where_condition' => 't1.id = ' . $user_submit[ 'submit_form_id' ],
							'limit' => 1,

						);

						if ( check_var( $submit_forms[ $user_submit[ 'submit_form_id' ] ] ) ){

							$submit_forms[ $user_submit[ 'submit_form_id' ] ][ 'users_submits' ][ $user_submit[ 'id' ] ] = $user_submit;

						}
						else {

							$submit_form = $this->submit_forms_common_model->get_submit_forms( $gsfp )->row_array();

							if ( $submit_form ){

								$submit_form[ 'users_submits' ][ $user_submit[ 'id' ] ] = $user_submit;

								$submit_form[ 'fields' ] = get_params( $submit_form[ 'fields' ] );
								$submit_form[ 'params' ] = get_params( $submit_form[ 'params' ] );

							}

							$submit_forms[ $submit_form[ 'id' ] ] = $submit_form;

						}

					}

				}
				else if ( $user_submit ){

					$user_submit[ 'data' ] = get_params( $user_submit[ 'data' ] );

					// get submit form params
					$gsfp = array(

						'where_condition' => 't1.id = ' . $user_submit[ 'submit_form_id' ],
						'limit' => 1,

					);

					$submit_form = $this->submit_forms_common_model->get_submit_forms( $gsfp )->row_array();

					if ( $submit_form ){

						$submit_form[ 'users_submits' ][ $user_submit[ 'id' ] ] = $user_submit;

						$submit_form[ 'fields' ] = get_params( $submit_form[ 'fields' ] );
						$submit_form[ 'params' ] = get_params( $submit_form[ 'params' ] );

					}

					$submit_forms[ $submit_form[ 'id' ] ] = $submit_form;

				}

			}
			else {

				if ( $submit_form_id ){

					// get submit form params
					$gsfp = array(

						'where_condition' => 't1.id = ' . $submit_form_id,
						'limit' => 1,

					);

					$submit_forms = $this->submit_forms_common_model->get_submit_forms( $gsfp )->result_array(); // note, we're calling result_array(), not row_array()

				}
				else{

					$submit_forms = $this->submit_forms_common_model->get_submit_forms()->result_array();

				}

				// @TODO por aqui deve ser implantado os novos filtros

				foreach ( $submit_forms as $key => & $submit_form ) {

					$submit_form[ 'fields' ] = get_params( $submit_form[ 'fields' ] );
					$submit_form[ 'params' ] = get_params( $submit_form[ 'params' ] );

					// get submit form params
					$gus_params = array(

						'where_condition' => 't1.submit_form_id = ' . $submit_form[ 'id' ],

					);

					$users_submits = $this->submit_forms_common_model->get_users_submits( $gus_params )->result_array();

					$submit_form[ 'users_submits' ] = array();

					foreach ( $users_submits as $key => $user_submit ) {

						$user_submit[ 'data' ] = get_params( $user_submit[ 'data' ] );

						$submit_form[ 'users_submits' ][ $user_submit[ 'id' ] ] = $user_submit;

					}

				}

			}

			if ( $submit_forms ){

				$data[ 'submit_forms' ] = & $submit_forms;
				$data[ 'download' ] = ( $sub_action == 'dl' ) ? TRUE : FALSE;

				$page_params = array(

					'component_view_folder' => $this->component_view_folder,
					'function' => __FUNCTION__,
					'action' => 'get_users_submits',
					'layout' => 'default',
					'view' => 'html',
					'html' => FALSE,
					'load_index' => FALSE,

				);

				$now = gmt_to_local( now(), $this->mcm->filtered_system_params[ 'time_zone' ] );
				$now = strftime( '%Y-%m-%d %T', $now );

				$dl_filename = url_title( $now );
				$data[ 'dl_filename' ] = & $dl_filename;

				if ( $content_type == 'json' ){

					if ( $data[ 'download' ] ){

						header( 'Content-Type: application/json' );
						header( 'Content-Disposition: attachement; filename="' . $dl_filename . '.json' . '"' );

					}

					$page_params[ 'view' ] = 'json';

				}
				else if ( $content_type == 'csv' ){

					$page_params[ 'view' ] = 'csv';
					$data[ 'dl_filename' ] .= '.csv';

				}
				else if ( $content_type == 'xls' ){

					if ( $data[ 'download' ] ){

						header( 'Content-Encoding: UTF-8' );
						header( 'Content-type: application/xls;charset=UTF-8' );
						header( "Content-Type: application/force-download" );
						header( "Content-Type: application/octet-stream" );
						header( "Content-Type: application/download" );
						header( 'Content-Disposition: attachment; filename=' . $dl_filename . '.xls' );

					}

					$page_params[ 'view' ] = 'xls';

				}
				else if ( $content_type == 'html' ){

					if ( $data[ 'download' ] ){

						header( 'Content-Encoding: UTF-8' );
						header( 'Content-type: text/html;charset=UTF-8' );
						header( "Content-Type: application/force-download" );
						header( "Content-Type: application/octet-stream" );
						header( "Content-Type: application/download" );
						header( 'Content-Disposition: attachment; filename=' . $dl_filename . '.html' );

					}

					$page_params[ 'view' ] = 'html';

				}
				else if ( $content_type == 'pdf' ){


					$this->load->library( 'mpdf' );
					$this->load->helper( 'mpdf' );

					$data[ 'dl_filename' ] .= '.pdf';
					$page_params[ 'view' ] = 'pdf';
					$page_params[ 'html' ] = TRUE;
					$page_params[ 'data' ] = $data;

					$dimension = 'A4';
					$mpdf = new mPDF('utf-8', $dimension);


					$mpdf->WriteHTML( $this->_page( $page_params ) );

					$destination = 'I';

					if ( $data[ 'download' ] ){

						$destination = 'D';

					}

					$mpdf->Output( $dl_filename . '.pdf', $destination );

					exit;
				}
				else {

					header( 'Content-Type: text/plain' );

					if ( $data[ 'download' ] ){

						header( 'Content-Encoding: UTF-8' );
						header( 'Content-type: text/plain;charset=UTF-8' );
						header( "Content-Type: application/force-download" );
						header( "Content-Type: application/octet-stream" );
						header( "Content-Type: application/download" );
						header( 'Content-Disposition: attachment; filename=' . $dl_filename . '.txt' );

					}

					$page_params[ 'view' ] = 'txt';

				}

				$page_params[ 'data' ] = $data;

				$this->_page( $page_params );

			}

		}

		/*
		 --------------------------------------------------------
		 Get users submits
		 --------------------------------------------------------
		 ********************************************************
		 */

	}

	/*
	 --------------------------------------------------------------------------------------------------
	 Export
	 --------------------------------------------------------------------------------------------------
	 **************************************************************************************************
	 **************************************************************************************************
	 */

	/*
	 **************************************************************************************************
	 **************************************************************************************************
	 --------------------------------------------------------------------------------------------------
	 Ajax
	 --------------------------------------------------------------------------------------------------
	 */

	public function us_ajax( $action = NULL, $var1 = NULL ){

		$get = $this->input->get();
		$post = $this->input->post();

		// -------------------------------------------------
		// Parsing vars ------------------------------------

		$f_params = $this->uri->ruri_to_assoc();

		$ajax =									( isset( $post[ 'ajax' ] ) ? $post[ 'ajax' ] : NULL );
		$action =								isset( $f_params[ 'a' ] ) ? $f_params[ 'a' ] : ( isset( $get[ 'a' ] ) ? $get[ 'a' ] : NULL ); // action
		$sub_action =							isset( $f_params[ 'sa' ] ) ? $f_params[ 'sa' ] : ( isset( $get[ 'sa' ] ) ? $get[ 'sa' ] : NULL ); // sub action
		$submit_form_id =						isset( $f_params[ 'sfid' ] ) ? $f_params[ 'sfid' ] : ( isset( $get[ 'sfid' ] ) ? $get[ 'sfid' ] : NULL ); // submit form id
		$user_submit_id =						isset( $f_params[ 'usid' ] ) ? $f_params[ 'usid' ] : ( isset( $get[ 'usid' ] ) ? $get[ 'usid' ] : NULL ); // user submit id
		$return_format =						isset( $f_params[ 'rf' ] ) ? $f_params[ 'rf' ] : ( isset( $get[ 'rf' ] ) ? $get[ 'rf' ] : 'ajax' ); // return type: json, xml, pdf, etc.
		$cp =									isset( $f_params[ 'cp' ] ) ? $f_params[ 'cp' ] : ( isset( $get[ 'cp' ] ) ? $get[ 'cp' ] : NULL ); // current page
		$ipp =									isset( $f_params[ 'ipp' ] ) ? $f_params[ 'ipp' ] : ( isset( $get[ 'ipp' ] ) ? $get[ 'ipp' ] : NULL ); // items per page
		$ob =									isset( $f_params[ 'ob' ] ) ? $f_params[ 'ob' ] : ( isset( $get[ 'ob' ] ) ? $get[ 'ob' ] : NULL ); // order by

		// Parsing vars ------------------------------------
		// -------------------------------------------------

		// atualizando informações do componente atual
		$this->component_function = __FUNCTION__;
		$this->component_function_action = $action;

		$c_urls = & $this->c_urls;

		$data[ 'c_urls' ] = & $c_urls;

		// admin url
		$a_url = get_url( 'admin' . $this->uri->ruri_string() );

		/*
		 ********************************************************
		 --------------------------------------------------------
		 Get user submit
		 --------------------------------------------------------
		 */

		if ( $action == 'gus' AND $submit_form_id AND $user_submit_id ){

			// get submit form params
			$gus_params = array(

				'where_condition' => 't1.id = ' . $user_submit_id,
				'limit' => 1,

			 );

			// get submit form params
			$gsfp = array(

				'where_condition' => 't1.id = ' . $submit_form_id,
				'limit' => 1,

			 );

			$submit_form = $this->submit_forms_common_model->get_submit_forms( $gsfp )->row_array();
			$user_submit = $this->submit_forms_common_model->get_users_submits( $gus_params )->row_array();

			if ( $submit_form AND $user_submit ){

				$data[ 'submit_form' ] = & $submit_form;
				$data[ 'user_submit' ] = & $user_submit;

				$submit_form[ 'fields' ] = get_params( $submit_form[ 'fields' ] );
				$submit_form[ 'params' ] = get_params( $submit_form[ 'params' ] );
				$user_submit[ 'data' ] = get_params( $user_submit[ 'data' ] );

				$us_export_base_link_array = array(

					'sfid' => $submit_form_id,
					'usid' => $user_submit_id,

				);

				$c_urls[ 'us_export_download_json_link' ] = $c_urls[ 'us_export_download_json_link' ] . '/' . $this->uri->assoc_to_uri( $us_export_base_link_array );
				$c_urls[ 'us_export_download_csv_link' ] = $c_urls[ 'us_export_download_csv_link' ] . '/' . $this->uri->assoc_to_uri( $us_export_base_link_array );
				$c_urls[ 'us_export_download_xls_link' ] = $c_urls[ 'us_export_download_xls_link' ] . '/' . $this->uri->assoc_to_uri( $us_export_base_link_array );
				$c_urls[ 'us_export_download_html_link' ] = $c_urls[ 'us_export_download_html_link' ] . '/' . $this->uri->assoc_to_uri( $us_export_base_link_array );
				$c_urls[ 'us_export_download_txt_link' ] = $c_urls[ 'us_export_download_txt_link' ] . '/' . $this->uri->assoc_to_uri( $us_export_base_link_array );
				$c_urls[ 'us_export_download_pdf_link' ] = $c_urls[ 'us_export_download_pdf_link' ] . '/' . $this->uri->assoc_to_uri( $us_export_base_link_array );

				$dl_filename = url_title( $submit_form[ 'title' ] . ' - ' . $user_submit[ 'submit_datetime' ] );

				if ( $return_format === 'json' ){

					$this->output->set_content_type( 'application/json' );

					if ( $sub_action == 'dl' ){

						header( 'Content-Disposition: attachement; filename="' . $dl_filename . '.json' . '"' );

					}

					$out = array();

					foreach ( $submit_form[ 'fields' ] as $key => $field ) {

						if ( ! in_array( $field[ 'field_type' ], array( 'html', 'button' ) ) ) {

							$out[ lang( $field[ 'label' ] ) ] = $user_submit[ 'data' ][ url_title( $field[ 'label' ], '-', TRUE ) ];

						}

					}

					$this->output->set_output( json_encode( $out ) );

				}
				else if ( $return_format === 'csv' ){

					$this->load->helper( 'csv' );

					//$this->output->set_content_type( 'text/csv' );

					$out = array();

					foreach ( $submit_form[ 'fields' ] as $key => $field ) {

						if ( ! in_array( $field[ 'field_type' ], array( 'html', 'button' ) ) ) {

							$out[ 0 ][] = $field[ 'label' ];

						}

					}

					foreach ( $submit_form[ 'fields' ] as $key => $field ) {

						if ( ! in_array( $field[ 'field_type' ], array( 'html', 'button' ) ) ) {

							$out[ 1 ][] = $user_submit[ 'data' ][ url_title( $field[ 'label' ], '-', TRUE ) ];

						}

					}

					if ( $sub_action == 'dl' ){

						$this->output->set_output( array_to_csv( $out, $dl_filename . '.csv' ) );

					}
					else {

						$this->output->set_output( array_to_csv( $out ) );

					}

				}
				else if ( $return_format === 'xls' ){

					header('Content-Encoding: UTF-8');
					header( 'Content-type: application/vnd.ms-excel;charset=UTF-8' );

					if ( $sub_action == 'dl' ){

						header("Content-Type: application/force-download");
						header("Content-Type: application/octet-stream");
						header("Content-Type: application/download");;
						header('Content-Disposition: attachment; filename=' . $dl_filename . '.xls');

					}

					$this->_page(

						array(

							'component_view_folder' => $this->component_view_folder,
							'function' => __FUNCTION__,
							'action' => 'get_user_submit',
							'layout' => 'default',
							'view' => 'get_xls',
							'data' => $data,
							'html' => FALSE,
							'load_index' => FALSE,

						)

					);

				}
				else {

					$this->_page(

						array(

							'component_view_folder' => $this->component_view_folder,
							'function' => __FUNCTION__,
							'action' => 'get_user_submit',
							'layout' => 'default',
							'view' => 'get_user_submit',
							'data' => $data,
							'html' => FALSE,
							'load_index' => FALSE,

						)

					);

				}

			}

		}

		/*
		 --------------------------------------------------------
		 Get user submit
		 --------------------------------------------------------
		 ********************************************************
		 */

		/**************************************************/
		/******************* Live search ******************/

		else if ( $action == 'live_search' ){

			$terms = trim( $this->input->get( 'q' ) ? $this->input->get( 'q' ) : FALSE );

			$condition = NULL;
			$or_condition = NULL;

			if ( $terms ){

				$data = array();

				$get_query = urlencode( $terms );

				$full_term = $terms;
				$order_by = 'FIELD(t1.name, \''.$full_term.'\') ASC, t1.id ASC';

				$condition[ 'fake_index_1' ] = '';
				$condition[ 'fake_index_1' ] .= '(';
				$condition[ 'fake_index_1' ] .= '`t1`.`name` LIKE \'%'.$full_term.'%\' ';
				$condition[ 'fake_index_1' ] .= 'OR `t1`.`phones` LIKE \'%'.$full_term.'%\' ';
				$condition[ 'fake_index_1' ] .= 'OR `t1`.`addresses` LIKE \'%'.$full_term.'%\' ';
				$condition[ 'fake_index_1' ] .= 'OR `t1`.`emails` LIKE \'%'.$full_term.'%\' ';
				$condition[ 'fake_index_1' ] .= ')';

				$terms = str_replace( '#', ' ', $terms );
				$terms = explode( " ", $terms );

				$and_operator = FALSE;
				$like_query = '';

				foreach ( $terms as $key => $term ) {

					$like_query .= $and_operator === TRUE ? 'AND ' : '';
					$like_query .= '(';
					$like_query .= '`t1`.`name` LIKE \'%'.$term.'%\' ';
					$like_query .= 'OR `t1`.`phones` LIKE \'%'.$term.'%\' ';
					$like_query .= 'OR `t1`.`addresses` LIKE \'%'.$term.'%\' ';
					$like_query .= 'OR `t1`.`emails` LIKE \'%'.$term.'%\' ';
					$like_query .= ')';

					if ( ! $and_operator ){
						$and_operator = TRUE;
					}

				}

				$or_condition = '(' . $like_query . ')';

				$contacts = $this->contacts_model->get_contacts_search_results( $condition, $or_condition, NULL, NULL, NULL, $order_by, FALSE )->result_array();

				foreach ( $contacts as $key => $contact ) {

					$contacts[ $key ][ 'phones' ] = get_params( $contacts[ $key ][ 'phones' ] );
					$contacts[ $key ][ 'addresses' ] = get_params($contacts[ $key ][ 'addresses' ] );
					$contacts[ $key ][ 'emails' ] = get_params( $contacts[ $key ][ 'emails' ] );

					foreach ($terms as $term) {

						$contacts[ $key ][ 'name' ] = str_highlight( $contacts[ $key ][ 'name' ], $term );

						if ( isset( $contacts[ $key ][ 'phones' ] ) AND $contacts[ $key ][ 'phones' ] AND is_array( $contacts[ $key ][ 'phones' ] ) ){

							foreach ( $contacts[ $key ][ 'phones' ] as $key_2 => $phone ) {

								$contacts[ $key ][ 'phones' ][ $key_2 ][ 'title' ] = str_highlight( $contacts[ $key ][ 'phones' ][ $key_2 ][ 'title' ], $term );
								$contacts[ $key ][ 'phones' ][ $key_2 ][ 'number' ] = str_highlight( $contacts[ $key ][ 'phones' ][ $key_2 ][ 'number' ], $term );
								$contacts[ $key ][ 'phones' ][ $key_2 ][ 'extension_number' ] = str_highlight( $contacts[ $key ][ 'phones' ][ $key_2 ][ 'extension_number' ], $term );

							}

						}

						if ( isset( $contacts[  $key  ][  'addresses'  ] ) AND $contacts[  $key  ][  'addresses'  ] AND is_array( $contacts[  $key  ][  'addresses'  ] ) ){

							foreach ( $contacts[  $key  ][  'addresses'  ] as $key_2 => $address ) {

								$contacts[ $key ][ 'addresses' ][ $key_2 ][ 'title' ] = str_highlight( $contacts[ $key ][ 'addresses' ][ $key_2 ][ 'title' ], $term );
								$contacts[ $key ][ 'addresses' ][ $key_2 ][ 'state_acronym' ] = str_highlight( $contacts[ $key ][ 'addresses' ][ $key_2 ][ 'state_acronym' ], $term );
								$contacts[ $key ][ 'addresses' ][ $key_2 ][ 'city_title' ] = str_highlight( $contacts[ $key ][ 'addresses' ][ $key_2 ][ 'city_title' ], $term );
								$contacts[ $key ][ 'addresses' ][ $key_2 ][ 'neighborhood_title' ] = str_highlight( $contacts[ $key ][ 'addresses' ][ $key_2 ][ 'neighborhood_title' ], $term );
								$contacts[ $key ][ 'addresses' ][ $key_2 ][ 'public_area_title' ] = str_highlight( $contacts[ $key ][ 'addresses' ][ $key_2 ][ 'public_area_title' ], $term );
								$contacts[ $key ][ 'addresses' ][ $key_2 ][ 'postal_code' ] = str_highlight( $contacts[ $key ][ 'addresses' ][ $key_2 ][ 'postal_code' ], $term );
								$contacts[ $key ][ 'addresses' ][ $key_2 ][ 'complement' ] = str_highlight( $contacts[ $key ][ 'addresses' ][ $key_2 ][ 'complement' ], $term );

							}

						}

						if ( isset( $contacts[ $key ][ 'emails' ] ) AND $contacts[ $key ][ 'emails' ] AND is_array( $contacts[ $key ][ 'emails' ] ) ){

							foreach ( $contacts[ $key ][ 'emails' ] as $key_2 => $email ) {

								$contacts[ $key ][ 'emails' ][ $key_2 ][ 'title' ] = str_highlight( $contacts[ $key ][ 'emails' ][ $key_2 ][ 'title' ], $term );
								$contacts[ $key ][ 'emails' ][ $key_2 ][ 'email' ] = str_highlight( $contacts[ $key ][ 'emails' ][ $key_2 ][ 'email' ], $term );

							}

						}

					}

					$contacts[ $key ][ 'phones' ] = json_encode( $contacts[ $key ][ 'phones' ] );
					$contacts[ $key ][ 'addresses' ] = json_encode( $contacts[ $key ][ 'addresses' ] );
					$contacts[ $key ][ 'emails' ] = json_encode( $contacts[ $key ][ 'emails' ] );

				}

				$data[ 'contacts' ] = $contacts;


				$this->_page(

					array(

						'component_view_folder' => $this->component_view_folder,
						'function' => __FUNCTION__,
						'action' => $action,
						'layout' => 'default',
						'view' => $action,
						'data' => $data,
						'html' => FALSE,
						'load_index' => FALSE,

					)

				);

			}

		}

		/******************* Live search ******************/
		/**************************************************/

		/**************************************************/
		/*********************** Form *********************/

		else if ( $action == 'add' OR $action == 'edit' ){

			if ( $action == 'add_contact' AND ! $post_data ) {

				$rand = md5( rand( 2000, 15223 ) );

				if( ! is_dir( FCPATH . 'tmp' ) ){

					mkdir( FCPATH . 'tmp', 0777, TRUE );

				}

				$contact_image_path = 'tmp' . DS . $rand . DS;

			}
			else if ( $action == 'edit' AND isset( $get[ 'contact_id' ] ) ) {

				$contact = $this->contacts_model->get_contacts( array( 't1.id' => $get[ 'contact_id' ] ), 1, NULL )->row_array();

				$contact[ 'emails' ] = get_params( $contact[ 'emails' ] );
				$contact[ 'phones' ] = get_params( $contact[ 'phones' ] );
				$contact[ 'addresses' ] = get_params( $contact[ 'addresses' ] );
				$contact[ 'websites' ] = get_params( $contact[ 'websites' ] );

				$data[ 'lu_url' ][ 'update' ] .= '&id=' . $get[ 'contact_id' ];

				$data[ 'contact' ] = $contact;

				$contact_image_path = 'assets' . DS . 'images' . DS . 'components' . DS . 'contacts' . DS . $get[ 'contact_id' ];

			}

			// criando o diretório destino das imagens, caso este não exista
			if( ! is_dir( $contact_image_path ) ){

				if ( ! @mkdir( $contact_image_path, 0777, TRUE ) ){

					msg( 'unable_to_create_directory', 'title' );
					msg( sprintf( lang( 'unable_to_create_company_temporary_images_directory' ), $contact_image_path ), 'error' );

					log_message( 'error', sprintf( lang( 'unable_to_create_company_temporary_images_directory' ), $contact_image_path ) );

				}

			}




			$data[ 'component_name' ] = $this->component_name;
			$data[ 'f_action' ] = $action;
			$data[ 'contact_image_path' ] = $contact_image_path;

			$this->_page(

				array(

					'component_view_folder' => $this->component_view_folder,
					'function' => __FUNCTION__,
					'action' => 'form',
					'layout' => 'default',
					'view' => 'form',
					'data' => $data,
					'html' => FALSE,
					'load_index' => FALSE,

				)

			);

		}

		/*********************** Form *********************/
		/**************************************************/

	}

	/*
	 --------------------------------------------------------------------------------------------------
	 Ajax
	 --------------------------------------------------------------------------------------------------
	 **************************************************************************************************
	 **************************************************************************************************
	 */

}
