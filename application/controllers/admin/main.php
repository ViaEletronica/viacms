<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_controller {
	
	public $environment = ADMIN_ALIAS;
	public $f_action = ADMIN_ALIAS;
	
	public $html_data = array();
	
	public function __construct(){
		
		parent::__construct();
		
		// loading helpers, libraries and models
		$this->load->database();
		
		$this->load->helper(
			
			array(
				
				'form',
				'array',
				'text',
				'general',
				'msg',
				'params',
				'date',
				'html',
				'vui_elements',
				'string',
				'directory',
				
			)
			
		);
		
		$this->load->model(
			
			array(
			
				'common/main_common_model',
				
			)
			
		);
		
		
		/************************************* CORREÇÃO DE ALGUMAS COLUNAS, REMOVER ASSIM QUE OS SITES ESTIVEREM USANDO****************************/
		$columns_articles = "SHOW COLUMNS FROM `tb_articles` LIKE 'ordering'";
		$columns_articles = $this->db->query( $columns_articles )->row_array();
		
		$columns_articles_categories = "SHOW COLUMNS FROM `tb_articles_categories` LIKE 'ordering'";
		$columns_articles_categories = $this->db->query( $columns_articles_categories )->result_array();
		
		$columns_customers_categories = "SHOW COLUMNS FROM `tb_customers_categories` LIKE 'ordering'";
		$columns_customers_categories = $this->db->query( $columns_customers_categories )->row_array();
		
		$columns_menus = "SHOW COLUMNS FROM `tb_menus` LIKE 'ordering'";
		$columns_menus = $this->db->query( $columns_menus )->result_array();
		
		$submit_forms = "SHOW COLUMNS FROM `tb_submit_forms` LIKE 'ordering'";
		$submit_forms = $this->db->query( $submit_forms )->result_array();
		
		$articles_publish_datetime = "SHOW COLUMNS FROM `tb_articles` LIKE 'publish_datetime'";
		$articles_publish_datetime = $this->db->query( $articles_publish_datetime )->result_array();
		
		if ( ! $columns_articles ){
			
			$query = "ALTER TABLE `tb_articles` CHANGE `order` `ordering` INT(10) UNSIGNED NOT NULL;";
			$query = $this->db->query( $query );
			
		}
		if ( ! $columns_articles_categories ){
			
			$query = "ALTER TABLE `tb_articles_categories` CHANGE `order` `ordering` INT(10) UNSIGNED NOT NULL;";
			$query = $this->db->query( $query );
			
		}
		if ( ! $columns_customers_categories ){
			
			$query = "ALTER TABLE `tb_customers_categories` CHANGE `order` `ordering` INT(10) UNSIGNED NOT NULL;";
			$query = $this->db->query( $query );
			
		}
		if ( ! $columns_menus ){
			
			$query = "ALTER TABLE `tb_menus` CHANGE `order` `ordering` INT(10) UNSIGNED NOT NULL;";
			$query = $this->db->query( $query );
			
		}
		if ( ! $submit_forms ){
			
			$query = "ALTER TABLE `tb_submit_forms` ADD `ordering` INT(10) NOT NULL AFTER `mod_datetime`;";
			$query = $this->db->query( $query );
			
		}
		if ( ! $articles_publish_datetime ){
			
			$query = "ALTER TABLE `tb_articles` ADD `publish_datetime` DATETIME NOT NULL AFTER `modified_date`;";
			$query = $this->db->query( $query );
			
		}
		$articles_publish_user_id = $this->db->query( "SHOW COLUMNS FROM `tb_articles` LIKE 'publish_user_id'" )->result_array();
		
		if ( ! $articles_publish_user_id ){
			
			$query = $this->db->query( "ALTER TABLE `tb_articles` ADD `publish_user_id` DATETIME NOT NULL AFTER `modified_date`;" );
			
		}
		/************************************* CORREÇÃO DE ALGUMAS COLUNAS, REMOVER ASSIM QUE OS SITES ESTIVEREM USANDO****************************/
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Encurtando o acesso ao model $this->main_common_model
		 */
		
		$this->mcm = &$this->main_common_model;
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Definindo o ambiente
		 */
		
		$this->mcm->environment = ADMIN_ALIAS;
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
		$this->mcm->check_session_config();
		
		$this->load->library(
		
			array(
				
				'voutput',
				'session',
				'user_agent',
				'form_validation',
				'table',
				
			)
			
		);
		
		$this->load->model( 'plugins_mdl', 'plugins' );
		
		$this->load->model(
			
			array(
			
				ADMIN_DIR_NAME . DS . 'main_model',
				'common/users_common_model',
				ADMIN_DIR_NAME . DS . 'users_model',
				ADMIN_DIR_NAME . DS . 'places_model',
				'common/modules_common_model',
				'common/plugins_common_model',
				'common/urls_common_model',
				
			)
			
		);
		
		
		// Se o usuário não está conectado, varificamos se existe algum usuário com o client_hash igual ao calculado,
		// se sim, quer dizer que está logado em modo persistente
		if ( ! $this->session->userdata( $this->mcm->environment . '_login' ) AND ! $this->session->userdata( $this->mcm->environment . '_user_data' ) ){
			
			$hash_user = $this->users_common_model->check_client_hash();
			
			if ( $hash_user ){
				
				// do login params
				$dlp = array(
					
					'user_data' => array(
						
						'username' => $hash_user[ 'username' ],
						
					),
					'login_mode' => 'force', // ignore password
					'session_mode' => 'persistent', // keep logged in
					
				);
				
				$this->users_common_model->do_login( $dlp );
				
			}
			
		}
		
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Encurtando o acesso ao model $this->urls_common_model
		 */
		
		$this->ucm = &$this->urls_common_model;
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Definindo as urls reversas
		 */
		
		$this->ucm->setup_reverse_urls();
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Obtendo as configurações iniciais do sistema a partir do arquivo de configurações do Codeigniter
		 */
		
		foreach ( $this->config->config as $key => $value) {
			
			$this->mcm->system_params[ $key ] = $value;
			
		}
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Encurtando o acesso a library $this->user_agent
		 */
		
		$this->ua = &$this->agent;
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Encurtando o acesso ao model $this->plugins_common_model
		 */
		
		//$this->plugins = &$this->plugins_common_model;
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Encurtando o acesso ao model $this->modules_common_model
		 */
		
		$this->modc = &$this->modules_common_model;
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Profiler
		 */
		
		// verifica se a session do analizador esta ativa, se sim, ativa este
		if ( $this->session->userdata( 'profiler' ) ){
			
			$this->output->enable_profiler( TRUE );
			
		}
		
		//$this->session->sess_destroy();
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Definimos algumas variáveis referente ao componente atual, neste caso o Main
		 */
		
		$this->component_name = get_class_name( get_class() );
		$this->current_component = $this->mcm->get_component( $this->component_name );
		
		/***************** Google contacts ****************/$this->component_view_folder = $this->component_name;
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Se não for informada a última url acessada, definimos a mesma
		 * como sendo a url padrão ( default controller )
		 */
		
		if ( ! $this->session->userdata( ADMIN_ALIAS . '_last_url' ) ){
			
			set_last_url( get_url( 'admin/main/index/dashboard' ) );
			
		}
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Carregando os arquivos de idiomas padrões
		 */
		
		$langs = array(
			
			get_constant_name( $this->mcm->environment . '_DIR_NAME' ) . DS . 'general',
			get_constant_name( $this->mcm->environment . '_DIR_NAME' ) . DS . 'messages',
			'date',
			'calendar',
			
		);
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Componentes
		 */
		
		$this->mcm->get_components();
		
		$this->mcm->system_params = array_merge( $this->mcm->system_params, $this->mcm->components[ 'main' ][ 'params' ] );
		
		$this->mcm->system_params[ 'language' ] = $this->mcm->system_params[ $this->mcm->environment . '_language' ];
		
		$this->mcm->filtered_system_params = filter_params( $this->mcm->system_params, $this->current_component[ 'params' ] );
		
		foreach ( $this->config->config as $key => $value) {
			
			if ( check_var( $this->mcm->filtered_system_params[ $key ] ) ){
				
				$this->config->set_item( $key, $this->mcm->filtered_system_params[ $key ] );
				$this->mcm->system_params[ $key ] = $this->mcm->filtered_system_params[ $key ];
				
			}
			
		}
		
		// Obtemos os componentes ativos
		// Os componentes obtidos estarão disponíveis através do array $this->mcm->components
		foreach ( $this->mcm->components as $key => $component ) {
			
			// adicionamos ao array de idomas a serem carregados os arquivos de idiomas dos componentes ativos
			// estes arquivos são carregados mais a frente
			if ( file_exists( APPPATH . 'language' . DS . $this->mcm->filtered_system_params[ $this->mcm->environment . '_language' ] . DS . $component[ 'unique_name' ] . '_lang.php' ) ) {
				
				$langs[] = $component[ 'unique_name' ];
				
			}
			
		}
		
		$this->mcm->filtered_system_params = $this->mcm->parse_params( $this->mcm->filtered_system_params );
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Login
		 */
		
		
		//$teste = $this->users_common_model->check_hash()
		
		if ( ! $this->session->userdata( $this->mcm->environment . '_login' ) AND ( ! in_array( $this->uri->ruri_string(), array( '/main/index/logout', '/main/index/login', '/main/index/google_login', '/main/index/facebook_login' ) ) ) ){
			
			// define a url que o usuário tentou acessar
			// assim, após o login o usuário será redirecionado para esta url
			$this->session->set_userdata( $this->mcm->environment . '_uri_after_login', 'admin' . $this->uri->ruri_string() );
			
			$this->load->language( 'admin/users' );
			msg( lang( 'authentication_failure' ),'title' );
			msg( lang( 'you_must_be_logged_in' ), 'error' );
			redirect( 'admin/main/index/login' );
			
			// as linhas a seguir são para a resposta em ajax
			$msg = loadMsg();
			
			exit ( $msg );
			
		}
		
		// Se o usuário estiver logado
		if ( $this->session->userdata( $this->mcm->environment . '_login' ) AND $this->session->userdata( $this->mcm->environment . '_user_data' ) ){
			
			// se o usuário já estiver logado, inpedimos que o mesmo acesse a página de login
			if ( $this->uri->ruri_string() == '/main/index/login' ){
				
				redirect( 'admin/main/index/dashboard' );
				
			}
			
			// removemos a variável que indica a url o qual o usuário deve ser redirecionado após o login
			$this->session->unset_userdata( $this->mcm->environment . '_uri_after_login' );
			
			// obtemos o id do usuário da session. O único dado do usuário que guardamos na variável de session "admin_user_data" é a sua id, por segurança
			$user_data = $this->session->userdata( $this->mcm->environment . '_user_data' );
			
			// enviando as informações do usuário para a variável global do usuário
			$this->users_common_model->user_data = $this->users_common_model->get_user( array( 't1.id' => $user_data[ 'id' ] ) )->row_array();
			
			// obtendo os privilégios
			$this->users_common_model->user_data[ 'privileges' ] = json_decode( $this->users_common_model->user_data[ 'privileges' ], TRUE );
			// aqui transformamos o array multidimensional de privilégios em um array simples
			$this->users_common_model->user_data[ 'privileges' ] = array_flatten( $this->users_common_model->user_data[ 'privileges' ] );
			
			// verificando se o usuário possui privilégios para acessar a área administrativa
			if ( ! $this->users_common_model->check_privileges( 'admin_access' ) ){
				
				msg( lang( 'access_denied' ),'title' );
				msg( lang( 'access_denied_admin_access' ), 'error' );
				$this->index( 'logout' );
				
			};
			
			// obtendo os parâmetros do usuário
			$this->users_common_model->user_data[ 'params' ] = json_decode( $this->users_common_model->user_data[ 'params' ], TRUE );
			
			// tratamos os parâmetros do usuário
			$this->users_common_model->user_data[ 'params' ] = $this->mcm->parse_params( $this->users_common_model->user_data[ 'params' ] );
			
			// definimos os parâmetros globais e do usuário como sendo o resultado filtrado entre os mesmos,
			// a prioridade é para o usuário, exceto, claro, se alguma configuração for global
			$this->mcm->user_params = $this->users_common_model->user_data[ 'params' ];
			$this->mcm->filtered_system_params = filter_params( $this->mcm->system_params, $this->users_common_model->user_data[ 'params' ] );
			
			//print "<pre>" . print_r( $this->mcm->system_params, true ) . "</pre>";
			
			// descomente para ver os parâmetros
			// print_r( $this->mcm->system_params );
			
			// definindo o idioma do site de acordo com os parâmetros obtidos
			
		}
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		$this->mcm->filtered_system_params = $this->mcm->parse_params( $this->mcm->filtered_system_params );
		
		//print "<pre>" . print_r( $this->mcm->filtered_system_params, true ) . "</pre>";
		
		foreach ( $this->config->config as $key => $value) {
			
			$this->config->set_item( $key, $this->mcm->filtered_system_params[ $key ] );
			
		}
		
		//print "<pre>" . print_r( $this->config->config, true ) . "</pre>";
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Módulos
		 */
		
		// Obtemos os módulos ativos
		// Os componentes obtidos estarão disponíveis através do array $this->modc->modules_types
		
		$this->modc->get_modules_types();
		
		// idiomas dos tipos de módulos
		foreach ( $this->mcm->modules_types as $key => &$module_type ) {
			
			// adicionamos ao array de idomas a carregar os arquivos de idiomas dos componentes ativos
			if ( file_exists( APPPATH . 'language' . DS . $this->mcm->filtered_system_params[ 'language' ] . DS . get_constant_name( $this->mcm->environment . '_DIR_NAME' ) . DS . 'modules' . DS . $module_type[ 'alias' ] . '_lang.php' ) ) {
				
				$langs[] = get_constant_name( $this->mcm->environment . '_DIR_NAME' ) . DS . 'modules' . DS . $module_type[ 'alias' ];
			}
			
		}
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Carregando os arquivos de idiomas de cada componente ativo
		 */
		
		$this->load->language( $langs );
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Idiomas dos componentes
		 */
		
		// QUANDO AJUSTAR O SALVAMENTO DO ARQUIVO CONFIG, REMOVER ESTAS DUAS LINHAS
		$this->lang->is_loaded = array();
		$this->lang->language = array();
		
		foreach ( $this->mcm->components as $key => &$component ) {
			
			// adicionamos ao array de idomas a carregar os arquivos de idiomas dos componentes ativos
			if ( file_exists( APPPATH . 'language' . DS . $this->mcm->filtered_system_params[ 'language' ] . DS . get_constant_name( $this->mcm->environment . '_DIR_NAME' ) . DS . $component[ 'unique_name' ] . '_lang.php' ) ) {
				$langs[] = get_constant_name( $this->mcm->environment . '_DIR_NAME' ) . DS . $component[ 'unique_name' ];
			}
			
		}
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 * Carregando os arquivos de idiomas de cada componente ativo
		 */
		
		$this->load->language( $langs );
		
		/* 
		 * -------------------------------------------------------------------------------------------------
		 */
		
		
		
		// remove o status de seleção
		$this->session->unset_userdata( 'select_on' );
		
		$this->voutput->set_head_title( lang( $this->mcm->filtered_system_params[ $this->mcm->environment . '_name' ] ) );
		
	}
	
	
	
	
	
	
	// função de testes
	public function plg(){
		
		$get = $this->input->get();
		$post = $this->input->post();
		
		// -------------------------------------------------
		// Parsing vars ------------------------------------
		
		$f_params = $this->uri->ruri_to_assoc();
		
		$plugin_name =							isset( $f_params['pn'] ) ? $f_params['pn'] : NULL; // plugin name
		$plugin_type =							isset( $f_params['pt'] ) ? $f_params['pt'] : NULL; // plugin type
		
		// Parsing vars ------------------------------------
		// -------------------------------------------------
		
		$params[ 'get' ] = $get;
		$params[ 'post' ] = $post;
		
		if ( $plugin_name ){
			
			$data[ 'plugin_name' ] = $plugin_name;
			$this->plugins->load( $plugin_name );
			
		}
		else if ( $plugin_type ){
			
			$data[ 'plugin_type' ] = $plugin_type;
			$this->plugins->load( NULL, $plugin_type );
			
		}
		
		if ( $plugin_name OR $plugin_type ){
			
			$this->plugins->run_plugins( $data, $params );
			
		}
		
	}
	
	// plugins tests
	public function plugins_test(){
		
		$this->db->select('t1.*, t2.title as parent_title, t2.alias as parent_alias');
		$this->db->from('tb_articles_categories t1');
		$this->db->join('tb_articles_categories t2', 't1.parent = t2.id', 'left');
		
		$this->db->order_by('ordering asc, title asc, id asc');
		$query = $this->db->get();
		$query = $query->result_array();
		
		$f_params = array(
			
			'array' => $query,
			'parent_id' => 5,
			
		);
		
		//echo '<pre>' . print_r( $query, TRUE ) . '</pre>';
		echo '<pre>' . print_r( $this->main_common_model->get_children_as_list( $f_params ), TRUE ) . '</pre>';
		
	}
	
	// test search function
	public function search(){
		
		$search_config = array(
			
			'plugins' => 'articles',
			'ipp' => 10,
			'cp' => 1,
			
		);
		
		$this->load->library( 'search' );
		$this->search->config( 'plugins', 'articles_search' );
		$this->search->config( 'ipp', 10 );
		$this->search->config( 'cp', 1 );
		
		// run params
		$rp = array(
			
			'terms' => 'artigo criado',
			'ordeby' => array( // se deve passar um array, onde cada chave deve ser so nome do plugin, order by não pode ser usado globalmente, apenas por plugin
				
				'articles' => 't1.title DESC',
				
			),
		);
		
		$this->search->run( $rp );
		
		print_r( $this->search->get_config() );
		
		print_r( $this->search->get_full_results() );
		
	}
	
	
	
	public function update_contacts_images(){
		
		$contacts = $this->db->get( 'tb_contacts' )->result_array();
		
		foreach ( $contacts as $key => $contact ) {
			
			$data = array( 'thumb_local' => '', 'photo_local' => '', );
			
			
			if ( ( $contact['thumb_local'] != '' AND file_exists( FCPATH . 'assets/images/components/contacts/' . $contact['id'] . '/' . $contact['thumb_local'] ) ) AND
			! ( $contact['photo_local'] != '' AND file_exists( FCPATH . 'assets/images/components/contacts/' . $contact['id'] . '/' . $contact['photo_local'] ) ) ){
				
				$contact['photo_local'] = $contact['thumb_local'];
				
			}
			
			if ( ( $contact['photo_local'] != '' AND file_exists( FCPATH . 'assets/images/components/contacts/' . $contact['id'] . '/' . $contact['photo_local'] ) ) AND
			! ( $contact['thumb_local'] != '' AND file_exists( FCPATH . 'assets/images/components/contacts/' . $contact['id'] . '/' . $contact['thumb_local'] ) ) ){
				
				$contact['thumb_local'] = $contact['photo_local'];
				
			}
			
			if ( $contact['thumb_local'] != '' AND file_exists( FCPATH . 'assets/images/components/contacts/' . $contact['id'] . '/' . $contact['thumb_local'] ) ){
				
				$data[ 'thumb_local' ] = 'thumbs/' . COMPONENTS_IMAGES_URL . 'contacts/' . $contact['id'] . '/' . $contact['thumb_local'];
				mkdir( FCPATH . 'thumbs/assets/images/components/contacts/' . $contact['id'], 0777, TRUE );
				copy( FCPATH . 'assets/images/components/contacts/' . $contact['id'] . '/' . $contact['thumb_local'], FCPATH . 'thumbs/assets/images/components/contacts/' . $contact['id'] . '/' . $contact['thumb_local'] );
				
			}
			
			if ( $contact['photo_local'] != '' AND file_exists( FCPATH . 'assets/images/components/contacts/' . $contact['id'] . '/' . $contact['photo_local'] ) ){
				
				$data[ 'photo_local' ] = COMPONENTS_IMAGES_URL . 'contacts/' . $contact['id'] . '/' . $contact['photo_local'];
				
			}
			
			$this->db->update( 'tb_contacts', $data, array( 'id' => $contact[ 'id' ] ) );
			
		}
		
	}
	
	public function update_companies_images(){
		
		$companies = $this->db->get( 'tb_companies' )->result_array();
		
		foreach ( $companies as $key => $company ) {
			
			$data = array( 'logo_thumb' => '', 'logo' => '', );
			
			
			if ( ( $company['logo_thumb'] != '' AND file_exists( FCPATH . 'assets/images/components/companies/' . $company['id'] . '/' . $company['logo_thumb'] ) ) AND
			! ( $company['logo'] != '' AND file_exists( FCPATH . 'assets/images/components/companies/' . $company['id'] . '/' . $company['logo'] ) ) ){
				
				$company['logo'] = $company['logo_thumb'];
				
			}
			
			if ( ( $company['logo'] != '' AND file_exists( FCPATH . 'assets/images/components/companies/' . $company['id'] . '/' . $company['logo'] ) ) AND
			! ( $company['logo_thumb'] != '' AND file_exists( FCPATH . 'assets/images/components/companies/' . $company['id'] . '/' . $company['logo_thumb'] ) ) ){
				
				$company['logo_thumb'] = $company['logo'];
				
			}
			
			if ( $company['logo_thumb'] != '' AND file_exists( FCPATH . 'assets/images/components/companies/' . $company['id'] . '/' . $company['logo_thumb'] ) ){
				
				$data[ 'logo_thumb' ] = 'thumbs/' . COMPONENTS_IMAGES_URL . 'companies/' . $company['id'] . '/' . $company['logo_thumb'];
				mkdir( FCPATH . 'thumbs/assets/images/components/companies/' . $company['id'], 0777, TRUE );
				copy( FCPATH . 'assets/images/components/companies/' . $company['id'] . '/' . $company['logo_thumb'], FCPATH . 'thumbs/assets/images/components/companies/' . $company['id'] . '/' . $company['logo_thumb'] );
				
			}
			
			if ( $company['logo'] != '' AND file_exists( FCPATH . 'assets/images/components/companies/' . $company['id'] . '/' . $company['logo'] ) ){
				
				$data[ 'logo' ] = COMPONENTS_IMAGES_URL . 'companies/' . $company['id'] . '/' . $company['logo'];
				
			}
			
			$this->db->update( 'tb_companies', $data, array( 'id' => $company[ 'id' ] ) );
			
		}
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	public function switch_profiler(){
		
		if ( $this->session->userdata( 'profiler' ) === FALSE ){
			
			$this->session->set_userdata( 'profiler', TRUE );
			
		}
		else{
			
			$this->session->set_userdata( 'profiler', FALSE );
			
		}
		
		redirect_last_url();
	}
	
	
	
	// função para montar páginas
	protected function _page( $f_params = NULL ){
		
		//$action = NULL, $data = NULL, $view_folder = NULL, $view_file = NULL, $function = NULL, $layout = 'default', $html = FALSE, $load_index = TRUE, 
		
		// -------------------------------------------------
		// Parsing vars ------------------------------------
		
		// atribuindo valores às variávies
		$component_view_folder =				isset( $f_params[ 'component_view_folder' ] ) ? $f_params[ 'component_view_folder' ] : NULL;
		$function =								isset( $f_params[ 'function' ] ) ? $f_params[ 'function' ] : NULL;
		$action =								isset( $f_params[ 'action' ] ) ? $f_params[ 'action' ] : NULL;
		$layout =								isset( $f_params[ 'layout' ] ) ? $f_params[ 'layout' ] : 'default';
		$view =									isset( $f_params[ 'view' ] ) ? $f_params[ 'view' ] : NULL;
		$data =									isset( $f_params[ 'data' ] ) ? $f_params[ 'data' ] : NULL;
		$html =									isset( $f_params[ 'html' ] ) ? $f_params[ 'html' ] : FALSE;
		$load_index =							isset( $f_params[ 'load_index' ] ) ? $f_params[ 'load_index' ] : TRUE;
		
		// Parsing vars ------------------------------------
		// -------------------------------------------------
		
		if ( $component_view_folder AND $function AND $action AND $view ){
			
			if ( ! isset( $data ) ){
				$data = array();
			}
			
			$data[ 'component_name' ] = $this->current_component[ 'unique_name' ];
			$data[ 'current_component' ] = $this->current_component;
			$data[ 'component_function' ] = $this->component_function;
			$data[ 'component_function_action' ] = $this->component_function_action;
			
			/*
			 * html_data var list:
			 * 		
			 * 		$html_data															array
			 * 		$html_data[ 'head' ]													array
			 * 		$html_data[ 'head' ][ 'title' ]											string
			 * 		$html_data[ 'head' ][ 'favicon' ]										array
			 * 		$html_data[ 'head' ][ 'meta' ]											array
			 * 		$html_data[ 'head' ][ 'meta' ][0] ... [n]								string
			 * 		
			 * 		$html_data[ 'content' ]												array
			 * 		$html_data[ 'content' ][ 'title' ]										string
			 * 
			 */
			
			// default meta tags
			$this->voutput->append_head_meta( 'base', '<base href="' . BASE_URL . '/" ><!--[if lte IE 6]></base><![endif]-->', NULL, NULL );
			$this->voutput->append_head_meta( 'charset', 'charset="utf-8"' );
			$this->voutput->append_head_meta( 'content-type', 'http-equiv="content-type" content="text/html; charset=UTF-8"' );
			$this->voutput->append_head_meta( 'content-language', 'name="content-language" content="' . @$this->mcm->filtered_system_params[ $this->mcm->environment . '_language' ] . '"' );
			$this->voutput->append_head_meta( 'cache-control', 'http-equiv="cache-control" content="public"' );
			$this->voutput->append_head_meta( 'X-UA-Compatible', '<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame. Remove this if you use the .htaccess -->', NULL, NULL );
			$this->voutput->append_head_meta( 'X-UA-Compatible', 'http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"' );
			$this->voutput->append_head_meta( 'copyright', 'name="copyright" content="' . @$this->mcm->filtered_system_params[ 'site_copyright' ] . '"' );
			$this->voutput->append_head_meta( 'author', 'name="author" content="' . @$this->mcm->filtered_system_params[ 'author_name' ] . '"' );
			$this->voutput->append_head_meta( 'viewport', 'name="viewport" content="width=device-width, initial-scale=1.0"' );
			$this->voutput->append_head_meta( 'HandheldFriendly', 'name="HandheldFriendly" content="True"' );
			$this->voutput->append_head_meta( 'MobileOptimized', 'name="MobileOptimized" content="320"' );
			$this->voutput->append_head_meta( 'google-site-verification', 'name="google-site-verification" content="' . @$this->mcm->filtered_system_params[ 'google_site_verification' ] . '"' );
			$this->voutput->append_head_meta( 'custom', @$this->mcm->filtered_system_params[ 'meta_custom' ], NULL, NULL );
			
			// favicons
			$this->voutput->append_favicon( 'apple-touch-icon-152x152.png', 'apple-touch-icon', '152x152', 'iPad iOS7+ com Retina Display' );
			$this->voutput->append_favicon( 'apple-touch-icon-144x144.png', 'apple-touch-icon', '144x144', 'iPad iOS7- com Retina Display' );
			$this->voutput->append_favicon( 'apple-touch-icon-120x120.png', 'apple-touch-icon', '120z120', 'iPhone iOS7+ com Retina Display' );
			$this->voutput->append_favicon( 'apple-touch-icon-76x76.png', 'apple-touch-icon', '76x76', 'iPad iOS7+ sem retina display e iPad Mini' );
			$this->voutput->append_favicon( 'apple-touch-icon-72x72.png', 'apple-touch-icon', '72x72', 'iPad iOS7- sem retina display' );
			$this->voutput->append_favicon( 'apple-touch-icon.png', 'apple-touch-icon', NULL, 'iPhone iOS7-, iPod Touch e Android 2.2+' );
			$this->voutput->append_favicon( 'favicon.png', NULL, NULL, 'Default favicon' );
			$this->voutput->append_favicon( 'favicon-16.png', 'icon', '16x16', 'Default favicon 16x16' );
			$this->voutput->append_favicon( 'favicon-24.png', 'icon', '24x24', 'Default favicon 24x24' );
			$this->voutput->append_favicon( 'favicon-32.png', 'icon', '32x32', 'Default favicon 32x32' );
			$this->voutput->append_favicon( 'favicon-48.png', 'icon', '48x48', 'Default favicon 48x48' );
			$this->voutput->append_favicon( 'favicon-64.png', 'icon', '64x64', 'Default favicon 64x64' );
			$this->voutput->append_favicon( 'favicon-128.png', 'icon', '128x128', 'Default favicon 128x128' );
			
			// custom scripts
			$this->voutput->append_head_script_declaration( 'custom', @$this->mcm->filtered_system_params[ 'meta_scripts_declaration_custom' ] );
			
			// head title
			$head_title_prefix = @$this->mcm->filtered_system_params[ 'seo_title_prefix' ];
			$head_title_sufix = @$this->mcm->filtered_system_params[ 'seo_title_suffix' ];
			$head_title_separator = @$this->mcm->filtered_system_params[ 'seo_title_separator' ];
			
			$head_title = $this->voutput->get_head_title() ? $this->voutput->get_head_title() : lang( $this->mcm->filtered_system_params[ $this->mcm->environment . '_name' ] );
			$head_title = $head_title_prefix . ( $head_title_prefix ? $head_title_separator : '' ) . $head_title . $head_title_separator . ( $this->component_name ? lang( $this->component_name ) : '' ) . ( $head_title_sufix ? $head_title_separator : '' ) . $head_title_sufix;
			
			$this->voutput->set_head_title( $head_title );
			
			
			
			$data[ 'user_data' ] = $this->session->userdata('admin_user_data');
			$data[ 'component_view_folder' ] = $component_view_folder;
			$data[ 'view' ] = $view;
			$data[ 'layout' ] = $layout;
			$data[ 'msg' ] = loadMsg();
			
			// verificando se o tema atual possui a view de toolbar
			if ( file_exists( THEMES_PATH . admin_theme_components_views_path() . $component_view_folder . DS . $function . DS . $action . DS . $layout . DS . 'toolbar.php') ){
				
				$data[ 'toolbar' ] = $this->load->view( admin_theme_components_views_path() . $component_view_folder . DS . $function . DS . $action . DS . $layout . DS . 'toolbar', $data, TRUE);
				
			}
			// verificando se a view	de toolbar existe no diretório de views padrão
			else if ( file_exists( VIEWS_PATH . ADMIN_COMPONENTS_VIEWS_PATH . DS . $component_view_folder . DS . $function . DS . $action . DS . $layout . DS . 'toolbar.php') ){
				
				$data[ 'toolbar' ] = $this->load->view( ADMIN_COMPONENTS_VIEWS_PATH . DS . $component_view_folder . DS . $function . DS . $action . DS . $layout . DS . 'toolbar', $data, TRUE);
				
			}
			
			// se a saida for ajax, escreve apenas a saida das mensagens, ajustar isto no futuro
			if ( $this->input->get( 'ajax' ) ){
				
				if ( ! $this->session->userdata( $this->mcm->environment . '_login' ) ){
					
					redirect( 'admin/main/index/login' );
					
				}
				else{
					
					echo $data[ 'msg' ];
					
				}
				
			}
			
			// verificando se o tema atual possui a view
			if ( file_exists( THEMES_PATH . admin_theme_components_views_path() . $component_view_folder . DS . $function . DS . $action . DS . $layout . DS . $view . '.php') ){
				
				if ( $html ){
					
					$content = $this->load->view( admin_theme_components_views_path() . $component_view_folder . DS . $function . DS . $action . DS . $layout . DS . $view, $data, TRUE );
					
				}
				else {
					
					$content = $this->load->view( admin_theme_components_views_path() . $component_view_folder . DS . $function . DS . $action . DS . $layout . DS . $view, $data, ( $load_index ? TRUE : NULL ) );
					
				}
				
			}
			// verificando se a view existe no diretório de views padrão
			else if ( file_exists( VIEWS_PATH . ADMIN_COMPONENTS_VIEWS_PATH . DS . $component_view_folder . DS . $function . DS . $action . DS . $layout . DS . $view . '.php') ){
				
				
				
				if ( $html ){
					
					$content = $this->load->view( ADMIN_COMPONENTS_VIEWS_PATH . $component_view_folder . DS . $function . DS . $action . DS . $layout . DS . $view, $data, TRUE );
					
				}
				else {
					
					$content = $this->load->view( ADMIN_COMPONENTS_VIEWS_PATH . $component_view_folder . DS . $function . DS . $action . DS . $layout . DS . $view, $data, ( $load_index ? TRUE : NULL ) );
					
				}
				
			}
			else{
				
				$content = lang( 'load_view_fail' ) . ': <b>' . VIEWS_PATH . ADMIN_COMPONENTS_VIEWS_PATH . DS . $component_view_folder . DS . $function . DS . $action . DS . $layout . DS . $view . '.php</b>';
				
			}
			
			$this->voutput->append_content( $content );
			
			$data[ 'data' ] = $data;
			
			/* 
			 * -------------------------------------------------------------------------------------------------
			 * Carregando plugins
			 */
			
			//$this->plugins->run_plugins( $data );
			
			/* 
			 * -------------------------------------------------------------------------------------------------
			 */
			
			if ( $load_index ){
				
				$this->load->view( get_constant_name( $this->mcm->environment . '_DIR_NAME' ) . DS . call_user_func( $this->mcm->environment . '_theme' ) . DS . 'index' , $data, $html );
				
			}
			
		}
		else {
			//redirect();
		}
		
	}
	
	protected function _current_url(){
		return ltrim( $_SERVER[ 'PATH_INFO' ], '/' );
	}
	
	public function index( $action = NULL ){
		
		if ( ! $action ) redirect( ADMIN_DIR_NAME . '/' . $this->component_name . '/' . __FUNCTION__ . '/' . 'dashboard' );
		
		$this->component_function = __FUNCTION__;
		$this->component_function_action = $action;
		
		$url = get_url( ADMIN_DIR_NAME . $this->uri->ruri_string() );
		
		if ( $action == 'login' ){
			
			$data = array(
				'component_name' => $this->component_name,
			);
			
			//validação dos campos
			$this->form_validation->set_rules( 'username', lang( 'username' ), 'trim|required' );
			$this->form_validation->set_rules( 'password',lang( 'password' ), 'trim|required' );
			
			if ( $this->input->post() AND $this->form_validation->run() ){
				
				// do login params
				$dlp = array(
					
					'user_data' => array(
						
						'username' => $this->input->post( 'username' ),
						'password' => $this->input->post( 'password' ),
						
					)
					
				);
				
				if ( $this->input->post( 'keep_me_logged_in' ) ){
					
					$dlp[ 'session_mode' ] = 'persistent';
					
				}
				
				$this->users_common_model->do_login( $dlp );
				
			}
			// caso contrário se a validação dos campos for negativa e mensagens de erro conter strings
			else if (!$this->form_validation->run() AND validation_errors() != ''){
				
				$data[ 'post' ] = $this->input->post();
				
				msg(('login_fail'),'title');
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
		else if ( $action == 'facebook_login' ){
			
			$get = $this->input->get();
			$session = FALSE;
			
			$config_array = array(
				
				'app_id' => '289545581237405',
				'app_secret' => '35133fa411e7519b82bb52b176ba5f7b',
				'redirect_url' => get_url( 'admin/main/index/facebook_login' ),
				'permissions' => array(
					
					'email',
					'user_location',
				 	'user_birthday',
				 	
				),
				
			);
			$this->config->set_item( 'facebook', $config_array );
			
			$this->load->library( 'facebook' );
			
			$helper = $this->facebook->helper;
			
			try {
				
				$session = $helper->getSessionFromRedirect();
				
			} catch( FacebookRequestException $e ) {
				
				$error_msg = "[Facebook SDK v4] Error code :" . $e->getCode() . " --- Error message: " . $e->getMessage();
				
				log_message( 'error', $error_msg );
				msg( "[Facebook SDK v4] Error code :" . $e->getCode(), 'title' );
				msg( $e->getMessage(), 'error' );
				
			} catch( Exception $e ) {
				
				$error_msg = "[Facebook SDK v4] Error code :" . $e->getCode() . " --- Error message: " . $e->getMessage();
				
				log_message( 'error', $error_msg );
				msg( "[Facebook SDK v4] Error code :" . $e->getCode(), 'title' );
				msg( $e->getMessage(), 'error' );
				
			}
				
			if ( $session ) {
				
				$user_profile = $this->facebook->get_user( $session );
				
				//redirect_last_url();
				//echo $session->getAccessToken();
				//print "<pre>" . print_r( $user_profile, true ) . "</pre>";
				
				// do login params
				$dlp = array(
					
					'user_data' => array(
						
						'name' => $user_profile[ 'name' ],
						'email' => $user_profile[ 'email' ],
						'picture' => array(
							
							'small' => $user_profile[ 'picture' ][ 'normal' ],
							'normal' => $user_profile[ 'picture' ][ 'large' ],
							
						),
						'params' => array(
							
							'facebook' => $user_profile,
							
						),
						
					),
					'login_mode' => 'insert',
					
				);
				//print "<pre>" . print_r( $dlp, true ) . "</pre>";
				
				$this->users_common_model->do_login( $dlp );
				
				redirect( $this->facebook->login_url() );
				
			}
			else {
				
				//print '<pre>' . print_r( $get, TRUE ) . '</pre>';
				
				if ( check_var( $get[ 'code' ] ) ) {
					
					
					
				}
				else if ( check_var( $get[ 'error' ] ) ) {
					
					switch ( $get[ 'error_reason' ] ) {
						
						case 'user_denied':
							
							msg( 'login_fail', 'title' );
							msg( 'facebook_login_user_denied', 'error' );
							redirect( 'admin/main/index/login' );
							
							break;
							
						default:
							
							break;
							
					}
					
				}
				else{
					
					redirect( $this->facebook->login_url() );
					
				}
				
			}
			
			redirect( $this->facebook->login_url() );
			
			
		}
		else if ( $action == 'google_login' ){
			
			$this->load->library( 'google' );
			require_once 'Google/Service/Oauth2.php';
			
			/*****************************************/
			/***************** Config ****************/
			
			$token = $this->google->get_token_from_db();
			
			if ( $token ){
				
				$this->session->set_userdata( 'google_token', $token );
				
			}
			
			$get = $this->input->get();
			$currentUrl = current_url();
			$currentUrl = explode( '?', $currentUrl );
			
			$redirect_uri = $currentUrl[ 0 ];
			$app_name = lang( 'login_to' ) . ' ' . $this->mcm->filtered_system_params[ 'google_base_app_name' ];
			$client_id = $this->mcm->filtered_system_params[ 'google_client_id' ];
			$developer_key = $this->mcm->filtered_system_params[ 'google_developer_key' ];
			$client_secret = $this->mcm->filtered_system_params[ 'google_client_secret' ];
			$email_address = $this->mcm->filtered_system_params[ 'google_email_address' ];
			
			$service_client_id = $this->mcm->filtered_system_params[ 'google_service_client_id' ]; // service account
			$service_email_address = $this->mcm->filtered_system_params[ 'google_service_email_address' ];
			$service_key_file = APPPATH . 'libraries/google-api-php-client/decrypt';
			$service_key_file = file_get_contents( $service_key_file );
			
			/***************** Config ****************/
			/*****************************************/
			
			$client = $this->google->client();
			//$null_cache = new Google_Cache_Null( $client );
			
			//$client->setCache( $null_cache );
			$client->setApplicationName( $app_name );
			$client->setScopes( array(
				
				'https://www.googleapis.com/auth/userinfo.email',
				
			) );
			$client->setClientId( $client_id );
			$client->setClientSecret( $client_secret );
			$client->setRedirectUri( $redirect_uri );
			$client->setDeveloperKey( $developer_key );
			
			if ( check_var( $get[ 'code' ] ) ) {
				
				$client->authenticate( $get[ 'code' ] );
				$token = $client->getAccessToken();
				$this->google->save_token_on_db( $token );
				$this->session->set_userdata( 'google_token', $client->getAccessToken() );
				redirect( $redirect_uri );
				
			}
			
			if ( $this->session->userdata( 'google_token' ) ){
				
				$client->setAccessToken( $this->session->userdata( 'google_token' ) );
				
			}
			
			$google_oauthV2 = new Google_Service_Oauth2( $client );
			
			/*****************************************/
			/******** Is access token expired? *******/
			
			if ( $this->session->userdata( 'google_token' ) AND $client->getAuth()->isAccessTokenExpired() ) {
				
				try{
					
					$client->getAuth()->refreshTokenWithAssertion();
					$token = $client->getAccessToken();
					$this->google->save_token_on_db( $token );
					
				}
				catch ( Google_Auth_Exception $e ){
					
					$error_msg = "[Google Api] Error code :" . $e->getCode() . " --- Error message: " . $e->getMessage();
					
					log_message( 'error', $error_msg );
					//msg( "[Google Api] Error code :" . $e->getCode(), 'title' );
					//msg( $e->getMessage(), 'error' );
					
				}
				catch ( Google_IO_Exception $e ){
					
					$error_msg = "[Google Api] Error code :" . $e->getCode() . " --- Error message: " . $e->getMessage();
					
					log_message( 'error', $error_msg );
					//msg( "[Google Api] Error code :" . $e->getCode(), 'title' );
					//msg( $e->getMessage(), 'error' );
					
				}
				catch ( Exception $e ){
					
					$error_msg = "[Google Api] Error code :" . $e->getCode() . " --- Error message: " . $e->getMessage();
					
					log_message( 'error', $error_msg );
					//msg( "[Google Api] Error code :" . $e->getCode(), 'title' );
					//msg( $e->getMessage(), 'error' );
					
				}
				
			}
			
			/******** Is access token expired? *******/
			/*****************************************/
			
			if ( $this->session->userdata( 'google_token' ) ) {
				
				try{
					
					$user									= $google_oauthV2->userinfo->get();
					$user_id								= $user['id'];
					$name									= filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
					$email									= filter_var($user['email'], FILTER_SANITIZE_EMAIL);
					$profile_url							= filter_var($user['link'], FILTER_VALIDATE_URL);
					$profile_image_url						= filter_var($user['picture'], FILTER_VALIDATE_URL);
					$personMarkup							= "$email<div><img src='$profile_image_url?sz=50'></div>";
					
					//print "<pre>" . print_r( $user, true ) . "</pre>";
					
					// do login params
					$dlp = array(
						
						'user_data' => array(
							
							'name' => $name,
							'email' => $email,
							'picture' => array(
								
								'normal' => $profile_image_url
								
							),
							
						),
						'login_mode' => 'insert',
						
					);
					
					$this->users_common_model->do_login( $dlp );
					
				}
				catch ( Google_Auth_Exception $e ){
					
					$error_msg = "[Google Api] Error code :" . $e->getCode() . " --- Error message: " . $e->getMessage();
					
					log_message( 'error', $error_msg );
					//msg( "[Google Api] Error code :" . $e->getCode(), 'title' );
					//msg( $e->getMessage(), 'error' );
					$auth = $client->createAuthUrl();
					//redirect( $auth );
					
				}
				catch ( Google_IO_Exception $e ){
					
					$error_msg = "[Google Api] Error code :" . $e->getCode() . " --- Error message: " . $e->getMessage();
					
					log_message( 'error', $error_msg );
					//msg( "[Google Api] Error code :" . $e->getCode(), 'title' );
					//msg( $e->getMessage(), 'error' );
					$auth = $client->createAuthUrl();
					//redirect( $auth );
					
				}
				catch ( Google_Service_Exception $e ){
					
					$error_msg = "[Google Api] Error code :" . $e->getCode() . " --- Error message: " . $e->getMessage();
					
					log_message( 'error', $error_msg );
					//msg( "[Google Api] Error code :" . $e->getCode(), 'title' );
					//msg( $e->getMessage(), 'error' );
					$auth = $client->createAuthUrl();
					//redirect( $auth );
					
				}
				catch ( Exception $e ){
					
					$error_msg = "[Google Api] Error code :" . $e->getCode() . " --- Error message: " . $e->getMessage();
					
					log_message( 'error', $error_msg );
					//msg( "[Google Api] Error code :" . $e->getCode(), 'title' );
					//msg( $e->getMessage(), 'error' );
					
				}
				
			}
			else {
				
				$auth = $client->createAuthUrl();
				redirect( $auth );
				
			}
			
		}
		else if ( $action == 'logout' ){
			
			$this->load->library( 'google' );
			$client = $this->google->client();
			$client->revokeToken();
			
			$this->users_common_model->remove_access_hash();
			$this->users_common_model->remove_session_from_user();
			
			$array_val = array(
				
				$this->mcm->environment . '_user_data' => '',
				$this->mcm->environment . '_login' => '',
				$this->mcm->environment . '_login_mode' => '',
				$this->mcm->environment . '_uri_after_login' => '',
				'facebook_token' => '',
				'google_token' => '',
				'profiler' => '',
				'select_on' => '',
				
			);
			
			$this->session->unset_userdata( $array_val );
			
			$this->main_model->delete_temp_data( array( 'user_id' =>$this->users_common_model->user_data[ 'id' ] ) );
			
			//$this->session->sess_destroy();
			redirect( 'admin/main/index/login' );
			
		}
		else if ( $action == 'dashboard' ){
			
			$url = get_url('admin'.$this->uri->ruri_string());
			set_last_url($url);
			$data = array(
				'component_name' => $this->component_name,
			);
			
			
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
			show_404();
		}
		
	}
	
	public function components_management( $action = NULL ){
		
		if ( ! $action ) redirect('admin/'.$this->component_name . '/' . __FUNCTION__ . '/' . 'components_list');
		
		$this->component_function = __FUNCTION__;
		$this->component_function_action = $action;
		
		$url = get_url('admin'.$this->uri->ruri_string());
		
		if ($action == 'components_list'){
			if ($components = $this->main_model->get_components(array('status'=>'1'))->result()){
				
				$data = array(
					'component_name' => $this->component_name,
					'components' => $components,
				);
				
				set_last_url($url);
				
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
		}
		else{
			show_404();
		}
		
	}
	
	public function config_management( $action = NULL ){
		
		// verificando se o usuário possui privilégios para gerenciar as configurações globais do sistema
		if ( ! $this->users_common_model->check_privileges( 'admin_config_management' ) ){
			
			msg( lang( 'access_denied' ),'title' );
			msg( lang( 'access_denied_admin_config_management' ), 'error' );
			redirect_last_url();
			
		};
		
		if ( ! $action ) redirect('admin/'.$this->component_name . '/' . __FUNCTION__ . '/' . 'components_list');
		
		$this->component_function = __FUNCTION__;
		$this->component_function_action = $action;
		
		$url = get_url('admin'.$this->uri->ruri_string());
		
		if ($action == 'config_list'){
			if ($components = $this->main_model->get_components(array('status'=>'1'))->result()){
				
				$data = array(
					'component_name' => $this->component_name,
					'components' => $components,
				);
				
				set_last_url($url);
				
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
		}
		else if ($action == 'global_config' AND ($component = $this->main_model->get_component(array('unique_name' => $this->component_name))->row())){
			
			$data = array(
				'component_name' => $this->component_name,
				'component' => $component,
			);
			
			// pegando os parâmetros
			$data[ 'params' ] = $this->main_model->get_config_params();
			
			/******************************/
			/********* Parâmetros *********/
			
			// cruzando os parâmetros globais com os parâmetros locais para obter os valores atuais
			$data[ 'current_params_values' ] = get_params($component->params);
			
			// obtendo as especificações dos parâmetros
			$data[ 'params_spec' ] = $this->main_model->get_config_params();
			
			// cruzando os valores padrões das especificações com os do DB
			$data[ 'final_params_values' ] = array_merge( $data[ 'params_spec' ][ 'params_spec_values' ], $data[ 'current_params_values' ] );
			
			// definindo as regras de validação
			set_params_validations( $data[ 'params_spec' ][ 'params_spec' ] );
			
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
				
				//$update_data[ 'params' ][ 'language' ] = $update_data[ 'params' ][ 'site_language' ];
				$update_data[ 'params' ] = json_encode($update_data[ 'params' ]);
				
				if ($this->main_model->update_component($update_data, array('id' => $this->input->post('component_id')))){
					msg( ('component_preferences_updated'), 'success' );
					
					$this->mcm->update_config_file( get_params( $update_data[ 'params' ] ) );
					
					if ($this->input->post('submit_apply')){
						redirect('admin'.$this->uri->ruri_string());
					}
					else{
						redirect_last_url();
					}
				}
				
			}
			// caso contrário se a validação dos campos for negativa e mensagens de erro conter strings
			else if (!$this->form_validation->run() AND validation_errors() != ''){
				
				$data[ 'post' ] = $this->input->post();
				
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
			show_404();
		}
		
	}
	
	
	public function _remap($method, $params = array()){
		
		$method = $method;
		if (method_exists($this, $method)){
			return call_user_func_array(array($this, $method), $params);
		}
		show_404();
		
	}
	
}
