<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'controllers/admin/main.php');

class Articles extends Main {
	
	public function __construct(){
		
		parent::__construct();
		
		$this->load->database();
		
		$this->load->model( 'articles_mdl', 'articles' );
		$this->load->model( 'admin/articles_model' );
		
		set_current_component();
		
		// verifica se o usuário atual possui privilégios para gerenciar artigos
		if ( ! $this->users_common_model->check_privileges('articles_management_articles_management') ){
			msg(('access_denied'),'title');
			msg(('access_denied_articles_management_articles_management'),'error');
			redirect_last_url();
		};
		
	}
	
	public function index(){
		
		$this->am();
		
	}
	
	/*
	 **************************************************************************************************
	 **************************************************************************************************
	 --------------------------------------------------------------------------------------------------
	 Articles management
	 --------------------------------------------------------------------------------------------------
	 */
	
	public function am(){
		
		// -------------------------------------------------
		// Parsing vars ------------------------------------
		
		$f_params = $this->uri->ruri_to_assoc();
		
		$action =								isset( $f_params[ 'a' ] ) ? $f_params[ 'a' ] : 'l'; // action
		$sub_action =							isset( $f_params[ 'sa' ] ) ? $f_params[ 'sa' ] : NULL; // sub action
		$article_id =							isset( $f_params[ 'aid' ] ) ? $f_params[ 'aid' ] : NULL; // id
		$category_id =							isset( $f_params[ 'cid' ] ) ? $f_params[ 'cid' ] : NULL; // category id
		$order_by =								isset( $f_params[ 'ob' ] ) ? $f_params[ 'ob' ] : NULL; // order by
		$post =									$this->input->post( NULL, TRUE ); // post array input
		$get =									$this->input->get(); // get array input
		
		// -------------
		
		$cp =									isset( $f_params[ 'cp' ] ) ? ( int ) $f_params[ 'cp' ] : NULL; // current page
			$cp =								( $cp < 1 ) ? 1 : $cp;
		$ipp =									isset( $f_params[ 'ipp' ] ) ? ( int ) $f_params[ 'ipp' ] : NULL; // items per page
			$ipp =								( $ipp < 1 ) ? $this->mcm->filtered_system_params[ $this->mcm->environment . '_items_per_page' ] : $ipp;
		
		// Parsing vars ------------------------------------
		// -------------------------------------------------
		
		$this->component_function = __FUNCTION__;
		$this->component_function_action = $action;
		
		// admin url
		$a_url = get_url( $this->environment . $this->uri->ruri_string() );
		
		if ( $action ){
			
			/*
			 ********************************************************
			 --------------------------------------------------------
			 List
			 --------------------------------------------------------
			 */
			
			if ( $action == 'l' OR $action === 's' ){
				
				$this->load->helper( array( 'pagination' ) );
				
				// -------------------------------------------------
				// Columns ordering --------------------------------
				
				if ( ! ( ( $order_by_direction = $this->users_common_model->get_user_preference( 'articles_order_by_direction' ) ) != FALSE ) ){
					
					$order_by_direction = 'ASC';
					
				}
				
				// order by complement
				$comp_ob = '';
				
				if ( ( $order_by = $this->users_common_model->get_user_preference( 'articles_order_by' ) ) != FALSE ){
					
					$data[ 'order_by' ] = $order_by;
					
					switch ( $order_by ) {
						
						case 'id':
							
							$order_by = 't1.id';
							break;
							
						case 'image':
							
							$order_by = 'if( `t1`.`image` = \'\' or `t1`.`image` is null, 1, 0 ), `t1`.`image`';
							$comp_ob = ', t1.ordering ' . $order_by_direction . ', t1.title ' . $order_by_direction;
							break;
							
						case 'title':
						
							$order_by = 't1.title';
							break;
							
						case 'alias':
						
							$order_by = 't1.alias';
							break;
							
						case 'category_id':
						
							$order_by = 't1.category_id';
							break;
							
						case 'category_title':
						
							$order_by = 't7.title';
							$comp_ob = ', t2.title ' . $order_by_direction . ', t2.ordering ' . $order_by_direction . ', t1.ordering ' . $order_by_direction . ', t1.title ' . $order_by_direction;
							break;
							
						case 'ordering':
						
							$order_by = 't1.ordering';
							break;
							
						case 'status':
						
							$order_by = 't1.status';
							break;
							
						case 'access_type':
						
							$order_by = 't1.access_type';
							break;
							
						case 'created_by_id':
						
							$order_by = 't1.created_by_id';
							break;
							
						case 'created_by_name':
						
							$order_by = 't3.name';
							break;
							
						case 'created_date':
						
							$order_by = 't1.created_date';
							break;
							
						case 'modified_by_id':
						
							$order_by = 't1.modified_by_id';
							break;
							
						case 'modified_date':
						
							$order_by = 't1.modified_date';
							break;
							
						case 'created_by_alias':
						
							$order_by = 't1.created_by_alias';
							break;
							
						default:
							
							$order_by = 't1.id';
							$data[ 'order_by' ] = 'id';
							
							break;
							
					}
					
				}
				else{
					
					$order_by = 't1.id';
					$data[ 'order_by' ] = 'id';
					
				}
				
				$data[ 'order_by_direction' ] = $order_by_direction;
				
				$order_by = $order_by . ' ' . $order_by_direction . $comp_ob;
				
				// Columns ordering --------------------------------
				// -------------------------------------------------
				
				// -------------------------------------------------
				// Filtering ---------------------------------------
				
				// items per page
				if ( isset( $post[ 'ipp' ] ) AND isset( $post[ 'submit_change_ipp' ] ) ){
					
					// setting the user preference
					$this->users_common_model->set_user_preferences( array( $this->mcm->environment . '_articles_categories_items_per_page' => $post[ 'ipp' ] ) );
					
					// também temos que definir a página atual como 1, para cortar o risco do resultado da pesquisa cair fora do alcance
					$cp = 1;
					
				}
				
				// -------------
				
				// category
				$filter_by_category = $this->users_common_model->get_user_preference( 'articles_filter_by_category' );
				
				if ( isset( $post[ 'articles_filter_by_category' ] ) AND isset( $post[ 'submit_filter_by_category' ] ) ){
					
					$filter_by_category = $post[ 'articles_filter_by_category' ];
					
					// setting the user preference
					$this->users_common_model->set_user_preferences( array( 'articles_filter_by_category' => $filter_by_category ) );
					
					// também temos que definir a página atual como 1, para cortar o risco do resultado da pesquisa cair fora do alcance
					$cp = 1;
					
				}
				// se não for encontrada a preferência do usuário com relação ao filtro de categoria, definimos esta como sendo -1 (todos as categorias)
				else if ( $filter_by_category === FALSE ){
					
					$filter_by_category = '-1';
					
				}
				
				$category_id = $filter_by_category;
				
				// Filtering ---------------------------------------
				// -------------------------------------------------
				
				// -------------------------------------------------
				// List / Search -----------------------------------
				
				$terms = trim( $this->input->post( 'terms', TRUE ) ? $this->input->post( 'terms', TRUE ) : ( ( $this->input->get( 'q' ) != FALSE ) ? $this->input->get( 'q' ) : FALSE ) );
				
				$search_config = array(
					
					'plugins' => 'articles_search',
					'ipp' => $ipp,
					'cp' => $cp,
					'terms' => $terms,
					'allow_empty_terms' => ( $action === 's' ? FALSE : TRUE ),
					'order_by' => array( // deve-se enviar um array associativo, onde cada chave deve ser so nome do plugin, order by não pode ser usado globalmente, apenas por plugin
						
						'articles_search' => $order_by, // pode ser um array
						
					),
					'plugins_params' => array( // se deve passar um array associativo, onde cada chave deve ser so nome do plugin
						
						'articles_search' => array(
							
							'category_id' => $category_id,
							
						),
						
					),
					
				);
				
				$this->load->library( 'search', $search_config );
				
				$articles = $this->search->get_full_results( 'articles_search' );
				
				// List / Search -----------------------------------
				// -------------------------------------------------
				
				// -------------------------------------------------
				// Pagination --------------------------------------
				
				// get article url params
				$gaup = array(
					
					'ipp' => $ipp,
					'cp' => $cp,
					'get' => $this->input->get(),
					'return' => 'template',
					'template_fields' => array(
						
						'ipp' => '%ipp%',
						'cp' => '%p%',
						
					),
					
				);
				
				if ( $terms ) {
					
					$gaup[ 'get' ][ 'q' ] = $terms;
					
				}
				
				$pagination_url = $this->articles->get_a_url( ( $action === 's' ? 'search' : 'list' ), $gaup );
				
				// Pagination --------------------------------------
				// -------------------------------------------------
				
				// -------------------------------------------------
				// Last url ----------------------------------------
				
				// setting up the last url
				unset( $gaup[ 'return' ] );
				unset( $gaup[ 'template_fields' ] );
				set_last_url( $this->articles->get_a_url( ( $action === 's' ? 'search' : 'list' ), $gaup ) );
				
				// Last url ----------------------------------------
				// -------------------------------------------------
				
				$data[ 'articles' ] = $articles;
				$data[ 'pagination' ] = get_pagination( $pagination_url, $cp, $ipp, $this->search->count_all_results( 'articles_search' ) );
				$data[ 'categories' ] = $this->articles->get_categories_tree();
				$data[ 'filter_by_category' ] = $filter_by_category;
				
				// -------------------------------------------------
				// Load page ---------------------------------------
				
				$this->_page(
					
					array(
						
						'component_view_folder' => $this->component_view_folder,
						'function' => 'articles_management',
						'action' => 'list',
						'layout' => 'default',
						'view' => 'list',
						'data' => $data,
						
					)
					
				);
				
				// Load page ---------------------------------------
				// -------------------------------------------------
				
			}
			
			/*
			 --------------------------------------------------------
			 List
			 --------------------------------------------------------
			 ********************************************************
			 */
			
			/*
			 ********************************************************
			 --------------------------------------------------------
			 Copy
			 --------------------------------------------------------
			 */
			
			else if ( ( $action == 'c' ) AND $article_id ){
				
				if ( $this->articles->copy( $article_id ) ){
					
					msg( 'article_copied_success', 'success' );
					redirect_last_url();
					
				}
				
			}
			
			/*
			 --------------------------------------------------------
			 Copy
			 --------------------------------------------------------
			 ********************************************************
			 */
			
			/*
			 ********************************************************
			 --------------------------------------------------------
			 Set status
			 --------------------------------------------------------
			 */
			
			else if ( ( $action == 'ss' ) AND $article_id AND $sub_action ) {
				
				if ( $this->articles->status( $article_id, $sub_action ) ) {
					
					msg( ( 'article_' . ( $sub_action == 'p' ? 'published' : ( $sub_action == 'u' ? 'unpublished' : 'archived' ) ) ), 'success' );
					redirect_last_url();
					
				}
				
			}
			
			/*
			 --------------------------------------------------------
			 Set status
			 --------------------------------------------------------
			 ********************************************************
			 */
			
			/*
			 ********************************************************
			 --------------------------------------------------------
			 Change order by
			 --------------------------------------------------------
			 */
			
			else if ( ( $action == 'cob' ) AND $order_by ){
				
				$this->users_common_model->set_user_preferences( array( 'articles_order_by' => $order_by ) );
				
				if ( ( $order_by_direction = $this->users_common_model->get_user_preference( 'articles_order_by_direction' ) ) != FALSE ){
					
					switch ( $order_by_direction ) {
						
						case 'ASC':
							
							$order_by_direction = 'DESC';
							break;
							
						case 'DESC':
						
							$order_by_direction = 'ASC';
							break;
							
					}
					
					$this->users_common_model->set_user_preferences( array( 'articles_order_by_direction' => $order_by_direction ) );
					
				}
				else {
					
					$this->users_common_model->set_user_preferences( array( 'articles_order_by_direction' => 'ASC' ) );
					
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
			 Add / Edit
			 --------------------------------------------------------
			 */
			
			else if ( $action == 'a' OR ( $action == 'e' AND $article_id AND ( $article = $this->articles->get( $article_id ) ) ) ){
				
				if ( $action == 'a' ){
					
					// verifica se o usuário atual possui privilégios para gerenciar criar artigos
					if ( ! $this->users_common_model->check_privileges( 'articles_management_can_add_articles' ) ){
						
						msg( ( 'access_denied' ), 'title' );
						msg( ( 'access_denied_articles_management_can_add_articles' ), 'error' );
						redirect_last_url();
						
					};
					
					$article = array();
					
					$article[ 'created_by_id' ] = $this->users_common_model->user_data[ 'id' ];
					
				}
				
				if ( $action == 'e' ){
					
					$article_user_id = $article[ 'created_by_id' ];
					
					// -------------------------------------------------
					// Checking privileges -----------------------------
					
					if ( $article_user_id != $this->users_common_model->user_data[ 'id' ] AND ! $this->users_common_model->check_privileges( 'articles_management_can_edit_all_articles' ) ){
						
						if ( $this->users_common_model->check_privileges( 'articles_management_can_edit_only_your_own_user' ) ){
							
							msg( ( 'access_denied' ),'title' );
							msg( ( 'access_denied_articles_management_can_edit_only_your_own_user' ), 'error' );
							
							redirect_last_url();
							
						}
						else if ( ! $this->users_common_model->check_privileges( 'articles_management_can_edit_only_your_own_user' ) ){
							
							$is_on_same_or_below_group_level = $this->users_common_model->check_if_user_is_on_same_and_low_group_level( $article_user_id );
							$is_on_same_group_level = $this->users_common_model->check_if_user_is_on_same_group_level( $article_user_id );
							$is_on_same_group_or_below = $this->users_common_model->check_if_user_is_on_same_group_and_below( $article_user_id );
							$is_on_same_group = $this->users_common_model->check_if_user_is_on_same_group( $article_user_id );
							$is_on_below_groups = $this->users_common_model->check_if_user_is_on_below_groups( $article_user_id );
							
							$can_edit_only_same_and_low_group_level = $this->users_common_model->check_privileges( 'articles_management_can_edit_only_same_and_low_group_level' );
							$can_edit_only_same_group_level = $this->users_common_model->check_privileges( 'articles_management_can_edit_only_same_group_level' );
							$can_edit_only_same_group_and_below = $this->users_common_model->check_privileges( 'articles_management_can_edit_only_same_group_and_below' );
							$can_edit_only_same_group = $this->users_common_model->check_privileges( 'articles_management_can_edit_only_same_group' );
							$can_edit_only_below_groups = $this->users_common_model->check_privileges( 'articles_management_can_edit_only_low_groups' );
								
							if ( $can_edit_only_same_and_low_group_level AND ! ( $is_on_same_or_below_group_level ) ){
								
								msg( ( 'access_denied' ), 'title' );
								msg( ( 'access_denied_articles_management_can_edit_only_same_and_low_group_level' ), 'error' );
								
								redirect_last_url();
								
							}
							else if ( $can_edit_only_same_group_level AND ! ( $is_on_same_group_level ) ){
								
								msg( ( 'access_denied' ), 'title' );
								msg( ( 'access_denied_articles_management_edit_same_group_level' ), 'error' );
								
								redirect( get_url( $this->uri->uri_string() ) );
								
							}
							else if ( $can_edit_only_same_group_and_below AND ! ( $is_on_same_group_or_below ) ){
								
								msg( ( 'access_denied' ), 'title' );
								msg( ( 'access_denied_articles_management_edit_same_group_and_below' ), 'error' );
								
								redirect( get_url( $this->uri->uri_string() ) );
								
							}
							else if ( $can_edit_only_same_group AND ! ( $is_on_same_group ) ){
								
								msg( ( 'access_denied' ), 'title' );
								msg( ( 'access_denied_articles_management_edit_same_group' ), 'error' );
								
								redirect( get_url( $this->uri->uri_string() ) );
								
							}
							else if ( $can_edit_only_below_groups AND ! ( $is_on_below_groups ) ){
								
								msg( ( 'access_denied' ), 'title' );
								msg( ( 'access_denied_articles_management_edit_below_groups' ), 'error' );
								
								redirect( get_url( $this->uri->uri_string() ) );
								
							}
							
						}
					}
					
					// Checking privileges -----------------------------
					// -------------------------------------------------
					
				}
				
				$data[ 'f_action' ] = $action;
				$data[ 'categories' ] = $this->articles_model->get_categories_tree();
				$data[ 'article' ] = & $article;
				$data[ 'users' ] = $this->users_common_model->get_users_checking_privileges()->result_array();
				$data[ 'users_groups' ] = $this->users_common_model->get_accessible_users_groups( $this->users_common_model->user_data[ 'id' ] );
				
				if ( $action == 'e' ){
					
					$this->articles->parse( $article );
					
				}
				
				// -------------------------------------------------
				// Params ------------------------------------------
				
				if ( $action == 'e' ){
					
					// cruzando os parâmetros globais com os parâmetros locais para obter os valores atuais
					$data[ 'current_params_values' ] = get_params( $article[ 'params' ] );
					
				}
				else{
					
					$data[ 'current_params_values' ] = array();
					
				}
				
				// obtendo as especificações dos parâmetros
				$data[ 'params_spec' ] = $this->articles_model->get_article_params();
				
				// cruzando os valores padrões das especificações com os do DB
				$data['final_params_values'] = array_merge( $data['params_spec']['params_spec_values'], $data['current_params_values'] );
				
				// definindo as regras de validação
				set_params_validations( $data['params_spec']['params_spec'] );
				
				// Params ------------------------------------------
				// -------------------------------------------------
				
				
				// -------------------------------------------------
				// Default validation ------------------------------
				
				$this->form_validation->set_rules( 'created_by_id', lang( 'user' ), 'xss|trim|required|integer' );
				$this->form_validation->set_rules( 'title', lang( 'title' ), 'xss|html_escape|trim|required' );
				$this->form_validation->set_rules( 'alias', lang( 'alias' ), 'xss|strip_tags|trim');
				$this->form_validation->set_rules( 'status', lang( 'status' ), 'xss|html_escape|trim|required|integer' );
				$this->form_validation->set_rules( 'category_id', lang( 'category' ), 'xss|html_escape|trim|required|integer' );
				$this->form_validation->set_rules( 'introtext', lang( 'introtext' ), 'html_escape|trim' );
				
				$fullcontent_rules = 'html_escape|trim';
				
				if ( check_var( $this->mcm->filtered_system_params[ 'param_content_is_required' ] ) ) {
					
					$fullcontent_rules .= '|required';
					
				}
				
				if ( isset( $post[ 'fulltext' ] ) ){
					
					$this->form_validation->set_rules( 'fulltext', lang( 'fulltext' ), $fullcontent_rules );
					
				}
				else if ( isset( $post[ 'fullcontent' ] ) ){
					
					$this->form_validation->set_rules( 'fullcontent', lang( 'fullcontent' ), $fullcontent_rules );
					
				}
				
				// se o tipo de nível de acesso for para usuários específicos, aplicamos a validação pertinente
				if ( $this->input->post( 'access_type' ) == 'users' ){
					
					$this->form_validation->set_rules( 'access_user_id[]', lang( 'specific_users' ), 'trim|required' );
					
				}
				// caso contrário, se o tipo de nível de acesso for para grupos de usuários específicos, aplicamos a validação pertinente
				else if ( $this->input->post( 'access_type' ) == 'users_groups' ){
					
					$this->form_validation->set_rules( 'access_user_group_id[]', lang( 'specific_users_groups' ), 'trim|required' );
					
				}
				
				// Default validation ------------------------------
				// -------------------------------------------------
				
				if( $this->input->post( 'submit_cancel' ) ){
					
					redirect_last_url();
					
				}
				// se a validação dos campos for positiva
				else if ( $this->form_validation->run() AND ( $this->input->post( 'submit' ) OR $this->input->post( 'submit_apply' ) ) ){
					
					$db_data = elements(array(
						
						'created_by_id',
						'status',
						'created_date',
						'title',
						'alias',
						'category_id',
						'access_type',
						'params',
						'image',
						
					), $this->input->post( NULL, TRUE ) );
					
					if ( $db_data[ 'access_type' ] == 'users' ){
						$db_data[ 'access_id' ] = implode( '|', $this->input->post( 'access_user_id' ) );
					}
					else if ( $db_data[ 'access_type' ] == 'users_groups' ){
						$db_data[ 'access_id' ] = implode( '|', $this->input->post( 'access_user_group_id' ) );
					}
					else{
						$db_data[ 'access_id' ] = 0;
					}
					
					if ( $this->input->post( 'fulltext' ) ){
						
						$db_data[ 'introtext' ] = $this->input->post( 'introtext' );
						$db_data[ 'fulltext' ] = $this->input->post( 'fulltext' );
						
					}
					else if ( $this->input->post( 'fullcontent' ) ){
						
						$content = explode( html_escape( '<hr id="vcms-readmore" />' ), $this->input->post( 'fullcontent' ) );
						
						if ( check_var( $content[ 1 ] ) ){
							
							$db_data['introtext'] = $content[ 0 ];
							$db_data['fulltext'] = $content[ 1 ];
							
						}
						else{
							
							$db_data['introtext'] = '';
							$db_data['fulltext'] = $content[ 0 ];
							
						}
					}
					
					$modified_date_time = gmt_to_local( now(), $this->mcm->filtered_system_params[ 'time_zone' ] );
					$modified_date_time = strftime( '%Y-%m-%d %T', $modified_date_time );
					
					$db_data[ 'modified_date' ] = $modified_date_time;
					
					$db_data[ 'modified_by_id' ] = $this->users_common_model->user_data[ 'id' ];
					
					$db_data['created_date'] = $this->input->post( 'created_date' ) . ' ' . $this->input->post( 'created_time' );
					
					if ( $db_data[ 'alias' ] == '' ){
						$db_data[ 'alias' ] = url_title( $db_data[ 'title' ], '-', TRUE );
					}
					
					$db_data['params'] = json_encode( $db_data['params'] );
					
					if ( $action == 'e' ) {
						
						if ( $this->articles->update( $db_data, array( 'id' => $article_id ) ) ){
							
							$this->articles->fix_ordering();
							
							msg( lang( 'article_updated' ), 'success' );
							
							if ( $this->input->post( 'submit_apply' ) ){
								
								redirect( 'admin'. $this->uri->ruri_string() );
								
							}
							else{
								
								redirect_last_url();
								
							}
							
						}
						
					}
					else if ( $action == 'a' ) {
						
						$db_data[ 'ordering' ] = $this->articles->get_max_ordering( $db_data[ 'category_id' ] ) + 1;
						
						$returned_id = $this->articles_model->insert_article( $db_data );
						
						if ( $returned_id ){
							
							$this->articles->fix_ordering();
							
							msg( lang( 'article_created' ), 'success' );
							
							if ( $this->input->post( 'submit_apply' ) ){
								
								redirect( $this->articles->get_a_url( 'edit', $returned_id ) );
								
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
					
					msg( ( 'update_article_fail' ), 'title' );
					msg( validation_errors( '<div class="error">', '</div>' ), 'error' );
				}
				
				$this->_page(
					
					array(
						
						'component_view_folder' => $this->component_view_folder,
						'function' => 'articles_management',
						'action' => 'form',
						'layout' => 'default',
						'view' => 'form',
						'data' => $data,
						
					)
					
				);
				
			}
			
			/*
			 --------------------------------------------------------
			 Add / Edit
			 --------------------------------------------------------
			 ********************************************************
			 */
			
			/*
			 ********************************************************
			 --------------------------------------------------------
			 Remove
			 --------------------------------------------------------
			 */
			
			else if ( $action == 'r' ){
				
				if( $this->input->post( 'submit_cancel' ) ){
					
					redirect_last_url();
					
				}
				
				$ids = array();
				$result = FALSE;
				
				if ( $this->input->post( 'submit_remove' ) AND $this->input->post( 'selected_articles_ids' ) ){
					
					$ids = $this->input->post( 'selected_articles_ids' );
					
				}
				else if ( $article_id AND $this->input->post( 'submit' ) ){
					
					if ( $this->articles_model->delete_article( array( 'id' => $article_id ) ) ){
						
						$this->articles->fix_ordering();
						
						msg( ( 'article_deleted' ), 'success' );
						redirect_last_url();
						
					}
					else{
						
						msg( $this->lang->line( 'article_deleted_fail' ), 'error' );
						redirect_last_url();
						
					}
					
				}
				else if ( $article_id ){
					
					$gap = array(
						
						'art_id' => $article_id,
						'limit' => 1,
						
					);
					
					$article = $this->articles->get_articles_respecting_privileges( $gap )->row_array();
					
					$this->articles->parse( $article );
					
					$data[ 'article' ] = $article;
					
				}
				
				$this->_page(
					
					array(
						
						'component_view_folder' => $this->component_view_folder,
						'function' => 'articles_management',
						'action' => 'remove',
						'layout' => 'default',
						'view' => 'remove',
						'data' => $data,
						
					)
					
				);
				
			}
			
			/*
			 --------------------------------------------------------
			 Remove
			 --------------------------------------------------------
			 ********************************************************
			 */
			
			/*
			 ********************************************************
			 --------------------------------------------------------
			 Change ordering
			 --------------------------------------------------------
			 */
			
			else if ( ( $action == 'co' ) ){
				
				$article_id = $article_id ? ( int ) $article_id : ( $this->input->post( 'article_id' ) ? ( int ) $this->input->post( 'article_id' ) : FALSE );
				$set_up = $sub_action == 'u' ? TRUE : ( $this->input->post( 'submit_up_ordering' ) ? TRUE : FALSE );
				$set_down = $sub_action == 'd' ? TRUE : ( $this->input->post( 'submit_down_ordering' ) ? TRUE : FALSE );
				$set_custom_ordering = $this->input->post( 'ordering' ) ? ( string ) ( ( int ) $this->input->post( 'ordering' ) ) : FALSE;
				
				if ( $article_id ){
					
					if ( $set_up ){
						
						$this->articles->up_ordering( $article_id );
						msg( ( 'article_order_changed' ), 'success' );
						redirect_last_url();
						
					}
					else if ( $set_down ){
						
						$this->articles->down_ordering( $article_id );
						msg( ( 'article_order_changed' ), 'success' );
						redirect_last_url();
						
					}
					else if ( $set_custom_ordering AND ( $article = $this->articles->get( $article_id ) ) ){
						
						if ( $this->articles->set_ordering( $article_id, ( int ) $set_custom_ordering ) ){
							
							msg( ( 'article_order_changed' ), 'success' );
							redirect_last_url();
							
						}
						
					}
					
				}
				else {
					
					msg( ( 'no_article_id_informed' ), 'error' );
					redirect_last_url();
					
				}
				
			}
			
			/*
			 --------------------------------------------------------
			 Change ordering
			 --------------------------------------------------------
			 ********************************************************
			 */
			
			/*
			 ********************************************************
			 --------------------------------------------------------
			 Fix ordering
			 --------------------------------------------------------
			 */
			
			else if ( ( $action == 'fo' ) ) {
				
				if ( $this->articles->fix_ordering() ) {
					
					msg( 'articles_ordering_fixed', 'success' );
					redirect_last_url();
					
				}
				
			}
			
			/*
			 --------------------------------------------------------
			 Fix ordering
			 --------------------------------------------------------
			 ********************************************************
			 */
			
			else if ( $action == 'b' ){
				
				$ids = array();
				$success = FALSE;
				$errors_count = 0;
				$msg_result = '';
				
				if ( $this->input->post( 'submit_remove' ) AND $this->input->post( 'selected_articles_ids' ) ){
					
					$ids = $this->input->post( 'selected_articles_ids' );
					
				}
				else if ( $id AND ! is_array( $id ) ){
					
					$ids[] = $id;
					
				}
				
				if ( $this->input->post( 'submit_copy' ) AND $this->input->post( 'selected_articles_ids' ) ){
					
					$ids = $this->input->post( 'selected_articles_ids' );
					
					foreach ( $ids as $key => $id ) {
						
						if ( $this->articles->copy( $id ) ){
							
							$success = TRUE;
							
						}
						else{
							
							$errors_count++;
							$msg_result .= lang( 'error_copying_article' ) . ' #' . $id . '<br />';
							
						}
						
					}
					
					if ( $errors_count > 0 ){
						
						msg( 'error_copying_articles', 'title' );
						msg( $msg_result, 'error' );
						
					}
					else {
						
						$this->articles->fix_ordering();
						msg( 'articles_copying_success', 'success' );
						
					}
					
					redirect_last_url();
					
				}
				else if ( $this->input->post( 'submit_remove' ) AND $this->input->post( 'selected_articles_ids' ) ){
					
					$ids = $this->input->post( 'selected_articles_ids' );
					
					foreach ( $ids as $key => $id ) {
						
						if ( $this->articles->remove_article( $id ) ){
							
							$success = TRUE;
							
						}
						else{
							
							$errors_count++;
							$msg_result .= lang( 'error_removed_article' ) . ' #' . $id . '<br />';
							
						}
						
					}
					
					if ( $errors_count > 0 ){
						
						msg( 'error_removed_articles', 'title' );
						msg( $msg_result, 'error' );
						
					}
					else {
						
						$this->articles->fix_ordering();
						msg( 'articles_removed_success', 'success' );
						
					}
					
					redirect_last_url();
					
				}
				else {
					
					redirect_last_url();
					
				}
				
			}
			else{
				
				show_404();
				
			}
		}
		
	}
	
	/*
	 --------------------------------------------------------------------------------------------------
	 Articles management
	 --------------------------------------------------------------------------------------------------
	 **************************************************************************************************
	 **************************************************************************************************
	 */
	
	/*
	 **************************************************************************************************
	 **************************************************************************************************
	 --------------------------------------------------------------------------------------------------
	 Categories management
	 --------------------------------------------------------------------------------------------------
	 */
	
	public function cm(){
		
		// -------------------------------------------------
		// Parsing vars ------------------------------------
		
		$f_params = $this->uri->ruri_to_assoc();
		
		$action =								isset( $f_params[ 'a' ] ) ? $f_params[ 'a' ] : NULL; // action
		$sub_action =							isset( $f_params[ 'sa' ] ) ? $f_params[ 'sa' ] : NULL; // sub action
		$category_id =							isset( $f_params[ 'cid' ] ) ? $f_params[ 'cid' ] : NULL; // category id
		$order_by =								isset( $f_params[ 'ob' ] ) ? $f_params[ 'ob' ] : NULL; // order by
		$post =									$this->input->post( NULL, TRUE ); // post array input
		$get =									$this->input->get(); // get array input
		
		// -------------
		
		$cp =									isset( $f_params[ 'cp' ] ) ? ( int ) $f_params[ 'cp' ] : NULL; // current page
			$cp =								( $cp < 1 ) ? 1 : $cp;
		$ipp =									isset( $f_params[ 'ipp' ] ) ? ( int ) $f_params[ 'ipp' ] : NULL; // items per page
			$ipp =								isset( $post[ 'ipp' ] ) ? ( int ) $post[ 'ipp' ] : $ipp; // items per page
		
		if (
			
			is_numeric( $this->users_common_model->get_user_preference( $this->mcm->environment . '_articles_categories_items_per_page' ) ) AND
			$this->users_common_model->get_user_preference( $this->mcm->environment . '_articles_categories_items_per_page' ) > -1 AND
			! isset( $post[ 'ipp' ] )
			
		){
			
			$ipp = $this->users_common_model->get_user_preference( $this->mcm->environment . '_articles_categories_items_per_page' );
			
		}
		else if ( ! isset( $ipp ) OR $ipp == -1 ){
			
			$ipp = $this->mcm->filtered_system_params[ $this->mcm->environment . '_items_per_page' ];
			
		}
		
		if ( $ipp < -1 ){
			
			$ipp = -1;
			
			if ( isset( $post[ 'ipp' ] ) ) {
				
				$post[ 'ipp' ] = $ipp;
				
			}
			
		}
		
		// Parsing vars ------------------------------------
		// -------------------------------------------------
		
		$this->component_function = __FUNCTION__;
		$this->component_function_action = $action;
		
		if ( $action ){
			
			/*
			 ********************************************************
			 --------------------------------------------------------
			 List
			 --------------------------------------------------------
			 */
			
			if ( $action == 'l' ){
				
				$this->load->helper( array( 'pagination' ) );
				
				// -------------------------------------------------
				// Columns ordering --------------------------------
				
				if ( ! ( ( $order_by_direction = $this->users_common_model->get_user_preference( 'articles_categories_order_by_direction' ) ) != FALSE ) ){
					
					$order_by_direction = 'ASC';
					
				}
				
				// order by complement
				$comp_ob = '';
				
				if ( ( $order_by = $this->users_common_model->get_user_preference( 'articles_categories_order_by' ) ) != FALSE ){
					
					$data[ 'order_by' ] = $order_by;
					
					switch ( $order_by ) {
						
						case 'id':
							
							$order_by = 't1.id';
							break;
							
						case 'image':
							
							$order_by = 'if( `t1`.`image` = \'\' or `t1`.`image` is null, 1, 0 ), `t1`.`image`';
							$comp_ob = ', t1.ordering ' . $order_by_direction . ', t1.title ' . $order_by_direction;
							break;
							
						case 'title':
							
							$order_by = 't1.title';
							$comp_ob = ', t1.ordering ' . $order_by_direction;
							break;
							
						case 'ordering':
						
							$order_by = 't1.parent';
							$comp_ob = ', t1.ordering ' . $order_by_direction . ', t1.title ' . $order_by_direction;
							break;
							
						case 'status':
						
							$order_by = 't1.status';
							$comp_ob = ', t1.parent ' . $order_by_direction . ', t1.ordering ' . $order_by_direction . ', t1.title ' . $order_by_direction;
							break;
							
						default:
							
							$order_by = 't1.id';
							$data[ 'order_by' ] = 'id';
							
							break;
							
					}
					
				}
				else {
					
					$order_by = 't1.id';
					$data[ 'order_by' ] = 'id';
					
				}
				
				$data[ 'order_by_direction' ] = $order_by_direction;
				
				$order_by = $order_by . ' ' . $order_by_direction . $comp_ob;
				
				// Columns ordering --------------------------------
				// -------------------------------------------------
				
				// -------------------------------------------------
				// Filtering ---------------------------------------
				
				// se hover submit de filtro de categoria, definimos a variável correspondente, bem como a preferência do usuário
				if ( isset( $post[ 'ipp' ] ) AND isset( $post[ 'submit_change_ipp' ] ) ){
					
					// setting the user preference
					$this->users_common_model->set_user_preferences( array( $this->mcm->environment . '_articles_categories_items_per_page' => $post[ 'ipp' ] ) );
					
					// também temos que definir a página atual como 1, para cortar o risco do resultado da pesquisa cair fora do alcance
					$cp = 1;
					
				}
				
				// Filtering ---------------------------------------
				// -------------------------------------------------
				
				// -------------------------------------------------
				// List / Search -----------------------------------
				
				$terms = trim( $this->input->post( 'terms', TRUE ) ? $this->input->post( 'terms', TRUE ) : ( ( $this->input->get( 'q' ) != FALSE ) ? $this->input->get( 'q' ) : FALSE ) );
				
				$search_config = array(
					
					'plugins' => 'articles_categories_search',
					'ipp' => $ipp,
					'cp' => $cp,
					'terms' => $terms,
					'allow_empty_terms' => ( $action === 's' ? FALSE : TRUE ),
					'order_by' => array( // deve-se enviar um array associativo, onde cada chave deve ser so nome do plugin, order by não pode ser usado globalmente, apenas por plugin
						
						'articles_categories_search' => $order_by, // pode ser um array
						
					),
					
				);
				
				$this->load->library( 'search', $search_config );
				
				$categories = $this->search->get_full_results( 'articles_categories_search' );
				
				// get categories tree params
				$gctp = array(
					
					'array' => $categories,
					
				);
				
				//$categories = $this->articles->get_categories_tree();
				
				// List / Search -----------------------------------
				// -------------------------------------------------
				
				// -------------------------------------------------
				// Pagination --------------------------------------
				
				// get article url params
				$gaup = array(
					
					'ipp' => $ipp,
					'cp' => $cp,
					'get' => $this->input->get(),
					'return' => 'template',
					'template_fields' => array(
						
						'ipp' => '%ipp%',
						'cp' => '%p%',
						
					),
					
				);
				
				if ( $terms ) {
					
					$gaup[ 'get' ][ 'q' ] = $terms;
					
				}
				
				$pagination_url = $this->articles->get_c_url( ( $action === 's' ? 'search' : 'list' ), $gaup );
				
				// Pagination --------------------------------------
				// -------------------------------------------------
				
				// -------------------------------------------------
				// Last url ----------------------------------------
				
				// setting up the last url
				unset( $gaup[ 'return' ] );
				unset( $gaup[ 'template_fields' ] );
				set_last_url( $this->articles->get_c_url( ( $action === 's' ? 'search' : 'list' ), $gaup ) );
				
				// Last url ----------------------------------------
				// -------------------------------------------------
				
				$data[ 'ipp' ] = $ipp;
				$data[ 'categories' ] = $categories;
				$data[ 'pagination' ] = get_pagination( $pagination_url, $cp, $ipp, $this->search->count_all_results( 'articles_categories_search' ) );
				
				// -------------------------------------------------
				// Load page ---------------------------------------
				
				$this->_page(
					
					array(
						
						'component_view_folder' => $this->component_view_folder,
						'function' => 'categories_management',
						'action' => 'list',
						'layout' => 'default',
						'view' => 'list',
						'data' => $data,
						
					)
					
				);
				
				// Load page ---------------------------------------
				// -------------------------------------------------
				
			}
			
			/*
			 --------------------------------------------------------
			 List
			 --------------------------------------------------------
			 ********************************************************
			 */
			
			/*
			 ********************************************************
			 --------------------------------------------------------
			 Change ordering
			 --------------------------------------------------------
			 */
			
			else if ( ( $action == 'co' ) ){
				
				$category_id = $category_id ? ( int ) $category_id : ( $this->input->post( 'category_id' ) ? ( int ) $this->input->post( 'category_id' ) : FALSE );
				$set_up = $sub_action == 'u' ? TRUE : ( $this->input->post( 'submit_up_ordering' ) ? TRUE : FALSE );
				$set_down = $sub_action == 'd' ? TRUE : ( $this->input->post( 'submit_down_ordering' ) ? TRUE : FALSE );
				$set_custom_ordering = $this->input->post( 'ordering' ) ? ( string ) ( ( int ) $this->input->post( 'ordering' ) ) : FALSE;
				
				if ( $category_id ){
					
					if ( $set_up ){
						
						$this->articles->up_c_ordering( $category_id );
						msg( ( 'category_order_changed' ), 'success' );
						redirect_last_url();
						
					}
					else if ( $set_down ){
						
						$this->articles->down_c_ordering( $category_id );
						msg( ( 'category_order_changed' ), 'success' );
						redirect_last_url();
						
					}
					else if ( $set_custom_ordering AND ( $category = $this->articles->get_category( $category_id ) ) ){
						
						if ( $this->articles->set_c_ordering( $category_id, ( int ) $set_custom_ordering ) ){
							
							msg( ( 'category_order_changed' ), 'success' );
							redirect_last_url();
							
						}
						
					}
					
				}
				else {
					
					msg( ( 'no_category_id_informed' ), 'error' );
					redirect_last_url();
					
				}
				
			}
			
			/*
			 --------------------------------------------------------
			 Change ordering
			 --------------------------------------------------------
			 ********************************************************
			 */
			
			/*
			 ********************************************************
			 --------------------------------------------------------
			 Fix ordering
			 --------------------------------------------------------
			 */
			
			else if ( ( $action == 'fo' ) ) {
				
				if ( $this->articles->fix_c_ordering() ) {
					
					msg( 'articles_categories_ordering_fixed', 'success' );
					redirect_last_url();
					
				}
				
			}
			
			/*
			 --------------------------------------------------------
			 Fix ordering
			 --------------------------------------------------------
			 ********************************************************
			 */
			
			/*
			 ********************************************************
			 --------------------------------------------------------
			 Set status
			 --------------------------------------------------------
			 */
			
			else if ( ( $action == 'ss' ) AND $category_id AND $sub_action ) {
				
				if ( $this->articles->category_status( $category_id, $sub_action ) ) {
					
					msg( ( 'category_' . ( $sub_action == 'p' ? 'published' : 'unpublished' ) ), 'success' );
					redirect_last_url();
					
				}
				
			}
			
			/*
			 --------------------------------------------------------
			 Set status
			 --------------------------------------------------------
			 ********************************************************
			 */
			
			/*
			 ********************************************************
			 --------------------------------------------------------
			 Change order by
			 --------------------------------------------------------
			 */
			
			else if ( ( $action == 'cob' ) AND $order_by ){
				
				$this->users_common_model->set_user_preferences( array( 'articles_categories_order_by' => $order_by ) );
				
				if ( ( $order_by_direction = $this->users_common_model->get_user_preference( 'articles_categories_order_by_direction' ) ) != FALSE ){
					
					switch ( $order_by_direction ) {
						
						case 'ASC':
							
							$order_by_direction = 'DESC';
							break;
							
						case 'DESC':
						
							$order_by_direction = 'ASC';
							break;
							
					}
					
					$this->users_common_model->set_user_preferences( array( 'articles_categories_order_by_direction' => $order_by_direction ) );
					
				}
				else {
					
					$this->users_common_model->set_user_preferences( array( 'articles_categories_order_by_direction' => 'ASC' ) );
					
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
			 Change ordering, up or down
			 --------------------------------------------------------
			 */
			
			else if ( ( $action == 'uo' OR $action == 'do' ) AND $this->input->post( 'category_id' ) ){
				
				$current_order = $this->input->post( 'order' );
				
				if ( $this->input->post( 'submit_up_order' ) ){
					
					$current_order += 1;
					
				}
				else if ( $this->input->post( 'submit_down_order' ) AND $current_order > 1 ){
					
					$current_order -= 1;
					
				}
				
				$new_order = $current_order > 0 ? $current_order : 1;
				
				$update_data = array(
				
					'order' => $new_order,
					
				);
				
				if ( $this->articles_model->update_category( $update_data, array( 'id' => $this->input->post( 'category_id' ) ) ) ){
					
					msg(('menu_item_order_changed'),'success');
					redirect( get_url( $data[ 'categories_list_link' ] ) );
					
				}
			}
			
			/*
			 --------------------------------------------------------
			 Change ordering, up or down
			 --------------------------------------------------------
			 ********************************************************
			 */
			
			else if ( $action == 'a' ){
				
				$data[ 'categories' ] = $this->articles_model->get_categories_tree( 0, 0, 'list' );
				
				//validação dos campos
				$this->form_validation->set_rules('status',lang('status'),'trim|required|integer');
				$this->form_validation->set_rules('title',lang('title'),'trim|required');
				$this->form_validation->set_rules('alias',lang('alias'),'trim');
				$this->form_validation->set_rules('parent',lang('parent'),'trim|required|integer');
				$this->form_validation->set_rules('order',lang('order'),'trim|integer|greater_than[-1]');
				$this->form_validation->set_rules('description',lang('description'),'trim');
				
				if ( $this->input->post( 'submit_cancel' ) ){
					
					redirect( get_url( $data[ 'categories_list_link' ] ) );
					
				}
				// se a validação dos campos for positiva
				else if ( $this->form_validation->run() AND ( $this->input->post( 'submit' ) OR $this->input->post( 'submit_apply' ) ) ){
					
					$insert_data = elements( array(
						
						'status',
						'title',
						'alias',
						'parent',
						'ordering',
						'description',
						
					), $this->input->post() );
					
					if ($insert_data['alias'] == ''){
						
						$insert_data['alias'] = url_title($insert_data['title'],'-',TRUE);
					}
					
					$return_id=$this->articles_model->insert_category($insert_data);
					if ( $return_id ){
						
						msg(('category_created'),'success');
						
						$edit_link_array = $base_link_array + array(
							
							'a' => 'e',
							'cid' => $return_id,
							
						);
						
						if ( $this->input->post( 'submit_apply' ) ){
							
							redirect( $base_link_prefix . $this->uri->assoc_to_uri( $edit_link_array ) );
							
						}
						else{
							
							redirect_last_url();
							
						}
					}
					
				}
				// caso contrário se a validação dos campos for negativa e mensagens de erro conter strings
				else if (!$this->form_validation->run() AND validation_errors() != ''){
					
					$data['post'] = $this->input->post();
					
					msg(('create_category_fail'),'title');
					msg(validation_errors('<div class="error">', '</div>'),'error');
				}
				
				$this->_page(
					
					array(
						
						'component_view_folder' => $this->component_view_folder,
						'function' => 'categories_management',
						'action' => 'category_form',
						'layout' => 'default',
						'view' => 'category_form',
						'data' => $data,
						
					)
					
				);
				
			}
			else if ( $action == 'e' AND $category_id AND ( $category = $this->articles_model->get_category( $category_id )->row() ) ){
				
				$data[ 'categories' ] = $this->articles_model->get_categories_as_list_childrens_hidden( 0, $category_id );
				$data[ 'category' ] = $category;
				
				//validação dos campos
				$this->form_validation->set_rules('status',lang('status'),'trim|required|integer');
				$this->form_validation->set_rules('title',lang('title'),'trim|required');
				$this->form_validation->set_rules('alias',lang('alias'),'trim');
				$this->form_validation->set_rules('parent',lang('parent'),'trim|required|integer');
				$this->form_validation->set_rules('order',lang('order'),'trim|integer|greater_than[-1]');
				$this->form_validation->set_rules('description',lang('description'),'trim');
				
				if($this->input->post('submit_cancel')){
					redirect_last_url();
				}
				// se a validação dos campos for positiva
				else if ( $this->form_validation->run() AND ( $this->input->post( 'submit' ) OR $this->input->post( 'submit_apply' ) ) ){
					$update_data = elements(array(
						'status',
						'title',
						'alias',
						'parent',
						'ordering',
						'description',
					),$this->input->post());
					
					if ($update_data['alias'] == ''){
						$update_data['alias'] = url_title($update_data['title'],'-',TRUE);
					}
					
					if ( $this->articles_model->update_category( $update_data, array( 'id' => $this->input->post( 'category_id' ) ) ) ){
						msg( ( 'category_updated' ), 'success' );
						
						if ($this->input->post( 'submit_apply' ) ){
							
							redirect( current_url() );
							
						}
						else{
							redirect_last_url();
						}
					}
					
				}
				// caso contrário se a validação dos campos for negativa e mensagens de erro conter strings
				else if ( ! $this->form_validation->run() AND validation_errors() != '' ){
					
					$data['post'] = $this->input->post();
					
					msg( 'update_category_fail', 'title' );
					msg( validation_errors( '<div class="error">', '</div>' ), 'error' );
				}
				
				$this->_page(
					
					array(
						
						'component_view_folder' => $this->component_view_folder,
						'function' => 'categories_management',
						'action' => 'category_form',
						'layout' => 'default',
						'view' => 'category_form',
						'data' => $data,
						
					)
					
				);
				
			}
			else if ( $action == 'rc' AND $category_id AND ( $category = $this->articles_model->get_category( $category_id )->row() ) ){
				
				if ( $this->input->post( 'submit_cancel' ) ){
					
					redirect( get_url( $data[ 'categories_list_link' ] ) );
					
				}
				else if ( $this->input->post('category_id') > 0 AND $this->input->post( 'submit' ) ){
					
					$articles_update_data = array(
						
						'category_id' => 0,
						
					);
					$categories_update_data = array(
						
						'parent' => $category->parent,
						
					);
					
					$this->articles_model->update_article( $articles_update_data, array( 'category_id' => $category->id ) );
					$this->articles_model->update_category( $categories_update_data, array( 'parent' => $category->id ) );
					
					if ( $this->articles_model->delete_category(array('id'=>$this->input->post( 'category_id' ) ) ) ){
						
						msg(('category_deleted'),'success');
						redirect_last_url();
						
					}
					else{
						
						msg($this->lang->line('category_deleted_fail'),'error');
						redirect_last_url();
						
					}
				}
				else{
					
					$articles = $this->articles_model->get_articles( $category_id )->result_array();
					$childrens_categories = $this->articles_model->get_categories( array( 't1.parent' => $category_id ) )->result_array();
					
					if ( $articles ){
						
						$msg_articles = '<p>';
						$msg_articles .= lang('delete_warning_category_has_articles');
						$msg_articles .= '</p>';
						$msg_articles .= '<ul>';
						foreach($articles as $article){
							$msg_articles .= '<li>';
							$msg_articles .= '<b>'.$article[ 'title' ].' (id '.$article[ 'id' ].')</b>';
							$msg_articles .= '</li>';
						};
						$msg_articles .= '</ul>';
						
						msg( 'category_has_articles', 'title' );
						msg( $msg_articles, 'warning' );
					}
					
					if ( $childrens_categories ){
						
						$msg_childrens_categories = '<p>';
						$msg_childrens_categories .= lang('delete_warning_category_has_childrens');
						$msg_childrens_categories .= '</p>';
						$msg_childrens_categories .= '<ul>';
						foreach($childrens_categories as $children_category){
							$msg_childrens_categories .= '<li>';
							$msg_childrens_categories .= '<b>' . $children_category[ 'title' ] . ' (id ' . $children_category[ 'id' ] . ')</b>';
							$msg_childrens_categories .= '</li>';
						};
						$msg_childrens_categories .= '</ul>';
						
						msg(('category_has_childrens_categories'),'title');
						msg($msg_childrens_categories,'warning');
					}
					
					$data[ 'category' ] = $category;
					
					$this->_page(
						
						array(
							
							'component_view_folder' => $this->component_view_folder,
							'function' => 'categories_management',
							'action' => 'remove_category',
							'layout' => 'default',
							'view' => 'remove_category',
							'data' => $data,
							
						)
						
					);
					
				}
				
			}
			else{
				show_404();
			}
		}
		
	}
	public function component_config($action = NULL, $layout = 'default'){
		
		$this->component_function = __FUNCTION__;
		$this->component_function_action = $action;
		
		if ($action){
			
			$base_link_prefix = 'admin/' . $this->component_name . '/' . __FUNCTION__ . '/';
			
			$base_link_array = array();
			
			$categories_list_link_array = $base_link_array + array(
				
				'a' => 'cl',
				
			);
			$add_category_link_array = $base_link_array + array(
				
				'a' => 'ac',
				
			);
			
			$data[ 'categories_list_link' ] = $base_link_prefix . $this->uri->assoc_to_uri( $categories_list_link_array );
			$data[ 'add_category_link' ] = $base_link_prefix . $this->uri->assoc_to_uri( $add_category_link_array );
			
			if ($action == 'edit_config' AND ($component = $this->main_model->get_component(array('unique_name' => $this->component_name))->row())){
				
				$data[ 'component' ] = $component;
				
				/******************************/
				/********* Parâmetros *********/
				
				// pegando os parâmetros
				$data['component']->params = json_decode($data['component']->params, TRUE);
				
				// obtendo as especificações dos parâmetros
				$data['params'] = $this->articles_model->get_general_params();
				
				// cruzando os valores padrões das especificações com os do DB
				$params_values = array_merge( $data['params']['params_spec_values'], $data['component']->params );
				
				// convertendo todos os elementos para html
				$data['params'] = params_to_html( $data['params'], $params_values );
				
				/********* Parâmetros *********/
				/******************************/
				
				$this->form_validation->set_rules('component_id',lang('id'),'trim|required|integer');
				
				if($this->input->post('submit_cancel')){
					redirect_last_url();
				}
				// se a validação dos campos for positiva
				else if ($this->form_validation->run() AND ($this->input->post('submit') OR $this->input->post('submit_apply'))){
					
					$update_data = elements(array(
						'params',
					),$this->input->post());
					
					$update_data['params'] = json_encode($update_data['params']);
					
					if ($this->main_model->update_component($update_data, array('id' => $this->input->post('component_id')))){
						msg(('component_preferences_updated'),'success');
						
						if ($this->input->post('submit_apply')){
							redirect('admin/'.$this->component_name . '/' . __FUNCTION__ . '/' . $action);
						}
						else{
							redirect_last_url();
						}
					}
					
				}
				// caso contrário se a validação dos campos for negativa e mensagens de erro conter strings
				else if (!$this->form_validation->run() AND validation_errors() != ''){
					
					$data['post'] = $this->input->post();
					
					msg(('update_component_preferences_fail'),'title');
					msg(validation_errors('<div class="error">', '</div>'),'error');
				}
				
				$this->_page(
					
					array(
						
						'component_view_folder' => $this->component_view_folder,
						'function' => __FUNCTION__,
						'action' => $action,
						'layout' => 'default',
						'view' => $action,
						'data' => $data,
						
					)
					
				);
				
			}
			else{
				redirect('admin/'.$this->component_name.'/articles_management/articles_list/1');
			}
		}
		
	}
	
	/******************************************************************************/
	/******************************************************************************/
	/************************************ Ajax ************************************/
	
	public function ajax( $action = NULL, $var1 = NULL ){
		
		// -------------------------------------------------
		// Parsing vars ------------------------------------
		
		$f_params = $this->uri->ruri_to_assoc();
		
		$action =								isset( $f_params[ 'a' ] ) ? $f_params[ 'a' ] : 'l'; // action
		$sub_action =							isset( $f_params[ 'sa' ] ) ? $f_params[ 'sa' ] : NULL; // sub action
		$article_id =							isset( $f_params[ 'aid' ] ) ? $f_params[ 'aid' ] : NULL; // id
		$category_id =							isset( $f_params[ 'cid' ] ) ? $f_params[ 'cid' ] : NULL; // category id
		$cp =									isset( $f_params[ 'cp' ] ) ? ( int ) $f_params[ 'cp' ] : NULL; // current page
		$ipp =									isset( $f_params[ 'ipp' ] ) ? ( int ) $f_params[ 'ipp' ] : NULL; // items per page
		$order_by =								isset( $f_params[ 'ob' ] ) ? $f_params[ 'ob' ] : NULL; // order by
		$post =									$this->input->post( NULL, TRUE ); // post array input
		$get =									$this->input->get(); // get array input
		
		// Parsing vars ------------------------------------
		// -------------------------------------------------
		
		$this->component_function = __FUNCTION__;
		$this->component_function_action = $action;
		
		if ( $action ){
			
			/**************************************************/
			/******************* Live search ******************/
			
			if ( $action == 's' ){
				
				$get = $this->input->get();
				
				// -------------------------------------------------
				// list / search -----------------------------------
				
				$terms = trim( $this->input->post( 'terms', TRUE ) ? $this->input->post( 'terms', TRUE ) : ( ( $this->input->get( 'q' ) != FALSE ) ? $this->input->get( 'q' ) : FALSE ) );
				
				/**
				 * @TODO falta criar a filtragem por categorias no plugin de busca de artigos
				 */
				$category_id = trim( ( isset( $get[ 'c' ] ) ) ? $get[ 'c' ] : '-1' );
				
				$search_config = array(
					
					'plugins' => 'articles_search',
					'terms' => $terms,
					
				);
				
				$search_config = array(
					
					'plugins' => 'articles_search',
					'ipp' => $ipp,
					'cp' => $cp,
					'terms' => $terms,
					'allow_empty_terms' => ( $action === 's' ? FALSE : TRUE ),
					'plugins_params' => array( // se deve passar um array associativo, onde cada chave deve ser so nome do plugin
						
						'articles_search' => array(
							
							'category_id' => ( $action === 's' ? FALSE : $category_id ),
							
						),
						
					),
					
				);
				
				$this->load->library( 'search', $search_config );
				
				$articles = $this->search->get_full_results( 'articles_search' );
				
				// list / search -----------------------------------
				// -------------------------------------------------
				
				$data[ 'articles' ] = $articles;
				
				$this->_page(
					
					array(
						
						'component_view_folder' => $this->component_view_folder,
						'function' => 'ajax',
						'action' => 'live_search',
						'layout' => 'default',
						'view' => 'articles_live_search',
						'data' => $data,
						'html' => FALSE,
						'load_index' => FALSE,
						
					)
					
				);
				
			}
			else if ( $action == 'categories_live_search' ){
				
				$categories = $this->articles_model->get_categories_tree( 0, 0, 'list' );
				
				if ( $categories ){
					
					foreach ( $categories as $key => $category ) {
						
					}
					
				}
				else{
					
					$categories = array();
					
				}
				
				$data[ 'categories' ] = $categories;
				
				$this->_page(
					
					array(
						
						'component_view_folder' => $this->component_view_folder,
						'function' => 'ajax',
						'action' => 'live_search',
						'layout' => 'default',
						'view' => 'categories_live_search',
						'data' => $data,
						'html' => FALSE,
						'load_index' => FALSE,
						
					)
					
				);
				
			}
			
			/******************* Live search ******************/
			/**************************************************/
			
		}
		
		if ( $this->input->post('ajax') ){
			
			/**************************************************/
			/***************** Get article data ***************/
			
			if ( $action == 'get_article_data' ){
				
				if ($article = $this->articles_model->get_articles(array( 't1.id' => $this->input->post('article_id') ), 1, NULL)->row_array()){
					
					$article['params'] = json_decode($article['params'], TRUE);
					
					$data = array(
						'article' => $article,
					);
					
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
			else{
				
			}
			
			/***************** Get article data ***************/
			/**************************************************/
			
		}
	}
	
	/************************************ Ajax ************************************/
	/******************************************************************************/
	/******************************************************************************/
	
}
