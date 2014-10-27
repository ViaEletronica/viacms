<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'controllers/admin/main.php');

class Menus extends Main {
	
	/* 
	 * Component urls in array format
	 */
	var $c_urls_array = array();
	
	/* 
	 * Component urls in string format
	 */
	var $c_urls = array();
	
	public function __construct(){
		
		parent::__construct();
		
		$this->load->model(
			
			array(
				
				'admin/menus_model',
				'common/menus_common_model',
				
			)
			
		);
		$this->load->language(array('admin/menus'));
		
		set_current_component();
		
		// verifica se o usuário atual possui privilégios para gerenciar menus
		if ( ! $this->users_common_model->check_privileges('menus_management_menus_management') ){
			msg(('access_denied'),'title');
			msg(('access_denied_menus_management_menus_management'),'error');
			redirect_last_url();
		};
		
		$this->menus = & $this->menus_common_model;
		
	}
	
	public function index(){
		
		$this->menu_types_management('menu_types_list');
		
	}
	
	// Padrão da montagem das urls: admin/ [componente] / [função] / [ação] / [layout] / [outros parâmetros]
	
	public function menu_types_management( $action = NULL, $menu_type_id = 0 ){
		
		$this->component_function = __FUNCTION__;
		$this->component_function_action = $action;
		
		if ($action){
			
			$url = get_url('admin'.$this->uri->ruri_string());
			
			if ( $action == 'menu_types_list' ){
				if ($menu_types = $this->menus_model->get_menu_types()->result()){
					$data = array(
						'component_name' => $this->component_name,
						'menu_types' => $menu_types,
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
			else if ($action == 'add_menu_type'){
				
				$data = array(
					'component_name' => $this->component_name,
				);
				
				//validação dos campos
				$this->form_validation->set_rules('title',lang('title'),'trim|required');
				$this->form_validation->set_rules('alias',lang('alias'),'trim');
				$this->form_validation->set_rules('description',lang('description'),'trim');
				
				if($this->input->post('submit_cancel')){
					redirect_last_url();
				}
				// se a validação dos campos for positiva
				else if ($this->form_validation->run() AND ($this->input->post('submit') OR $this->input->post('submit_apply'))){
					$insert_data = elements(array(
						'title',
						'alias',
						'description',
					),$this->input->post());
					
					if ($insert_data['alias'] == ''){
						$insert_data['alias'] = url_title($insert_data['title'],'-',TRUE);
					}
					
					$return_id=$this->menus_model->insert_menu_type($insert_data);
					if ($return_id){
						msg(('menu_type_created'),'success');
						$this->menus_model->update($insert_data, 'id = '.$return_id);
						if ($this->input->post('submit_apply')){
							redirect('admin/'.$this->component_name . '/' . __FUNCTION__.'/edit_menu_type/'.$return_id);
						}
						else{
							redirect_last_url();
						}
					}
					
				}
				// caso contrário se a validação dos campos for negativa e mensagens de erro conter strings
				else if (!$this->form_validation->run() AND validation_errors() != ''){
					
					$data['post'] = $this->input->post();
					
					msg(('add_menu_type_fail'),'title');
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
			else if ($action == 'edit_menu_type'){
				
				if ($menu_type_id AND ($menu_type = $this->menus_model->get_menu_type($menu_type_id)->row())){
					
					$data = array(
						'menu_type' => $menu_type,
						'menu_type_id' => $menu_type_id,
						'component_name' => $this->component_name,
					);
					
					//validação dos campos
					$this->form_validation->set_rules('title',lang('title'),'trim|required');
					$this->form_validation->set_rules('alias',lang('alias'),'trim');
					$this->form_validation->set_rules('description',lang('description'),'trim');
					
					if($this->input->post('submit_cancel')){
						redirect_last_url();
					}
					// se a validação dos campos for positiva
					else if ($this->form_validation->run() AND ($this->input->post('submit') OR $this->input->post('submit_apply'))){
						$update_data = elements(array(
							'title',
							'alias',
							'description',
						),$this->input->post());
						
						if ($update_data['alias'] == ''){
							$update_data['alias'] = url_title($update_data['title'],'-',TRUE);
						}
						
						if ($this->menus_model->update_menu_type($update_data, array('id' => $this->input->post('menu_type_id')))){
							msg(('menu_item_updated'),'success');
							if ($this->input->post('submit_apply')){
								redirect(get_url('admin'.$this->uri->ruri_string()));
							}
							else{
								redirect_last_url();
							}
						}
						
					}
					// caso contrário se a validação dos campos for negativa e mensagens de erro conter strings
					else if (!$this->form_validation->run() AND validation_errors() != ''){
						
						$data['post'] = $this->input->post();
						
						msg(('edit_menu_type_fail'),'title');
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
			}
			else if ($action == 'remove_menu_type'){
				
				if ($menu_type_id AND ($menu_type = $this->menus_model->get_menu_type($menu_type_id)->row())){
					if($this->input->post('submit_cancel')){
						redirect_last_url();
					}
					else if ($this->input->post('menu_type_id')>0 AND $menu_type AND $this->input->post('submit')){
						if ($this->menus_model->delete_menu_type(array('id'=>$this->input->post('menu_type_id')))){
							msg(('menu_type_deleted'),'success');
							redirect_last_url();
						}
						else{
							msg($this->lang->line('menu_type_deleted_fail'),'error');
							redirect_last_url();
						}
					}
					else{
						$data=array(
							'menu_type_id' => $menu_type_id,
							'component_name' => $this->component_name,
							'menu_type'=>$menu_type,
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
				}
				else{
					show_404();
				}
			}
			else{
				show_404();
			}
		}
	}
	
	/*
	 **************************************************************************************************
	 **************************************************************************************************
	 --------------------------------------------------------------------------------------------------
	 Menu items management
	 --------------------------------------------------------------------------------------------------
	 */
	
	public function mim(){
		
		// -------------------------------------------------
		// Parsing vars ------------------------------------
		
		$f_params = $this->uri->ruri_to_assoc();
		
		$action =								isset( $f_params['a'] ) ? $f_params['a'] : NULL; // action
		$sub_action =							isset( $f_params['sa'] ) ? $f_params['sa'] : NULL; // sub action
		$menu_type_id =							isset( $f_params['mtid'] ) ? $f_params['mtid'] : NULL; // menu type id
		$menu_item_id =							isset( $f_params['miid'] ) ? $f_params['miid'] : NULL; // menu item id
		$type =									isset( $f_params['t'] ) ? $f_params['t'] : NULL; // menu item id
		$component_id =							isset( $f_params['cid'] ) ? $f_params['cid'] : NULL; // component id
		$component_item =						isset( $f_params['ci'] ) ? $f_params['ci'] : NULL; // component item
		$post =									$this->input->post();
		// Parsing vars ------------------------------------
		// -------------------------------------------------
		
		// atualizando informações do componente atual
		$this->component_function = __FUNCTION__;
		$this->component_function_action = $action;
		
		$c_urls = & $this->menus->c_urls;
		$c_urls_array = & $this->menus->c_urls_array;
		
		$data[ 'c_urls' ] = & $this->menus->c_urls;
		
		// admin url
		$a_url = get_url( 'admin' . $this->uri->ruri_string() );
		
		
		
		
		
		$data[ 'menu_type_id' ] = $menu_type_id;
		$data[ 'type' ] = $type;
		
		$base_link_prefix = $this->menus->c_urls[ 'mi_management' ];
		
		$this->menus->c_urls_array[ 'base_link' ][ 'mtid' ] = $menu_type_id;
		
		/*
		 ********************************************************
		 --------------------------------------------------------
		 Menu items list
		 --------------------------------------------------------
		 */
		
		if ( $action == 'mil' ){
			
			$menu_items = $this->menus_model->get_menu_tree( 0, 0, 'list', $menu_type_id );
			
			$data[ 'menu_items' ] = $menu_items;
			
			set_last_url( $a_url );
			
			$this->_page(
				
				array(
					
					'component_view_folder' => $this->component_view_folder,
					'function' => 'menu_items_management',
					'action' => 'menu_items_list',
					'layout' => 'default',
					'view' => 'menu_items_list',
					'data' => $data,
					
				)
				
			);
			
		}
		
		/*
		 --------------------------------------------------------
		 Menu items list
		 --------------------------------------------------------
		 ********************************************************
		 */
		
		/*
		 ********************************************************
		 --------------------------------------------------------
		 Set home page
		 --------------------------------------------------------
		 */
		
		else if ( ( $action == 'shp' ) AND $menu_item_id ){
			
			if ( $this->menus_model->set_home_page( $menu_item_id ) ){
				
				msg( ( 'menu_item_set_as_home_page' ), 'success' );
				redirect_last_url();
				
			}
		}
		
		/*
		 --------------------------------------------------------
		 Set home page
		 --------------------------------------------------------
		 ********************************************************
		 */
		
		/*
		 ********************************************************
		 --------------------------------------------------------
		 Change status
		 --------------------------------------------------------
		 */
		
		else if ( ( $action == 'csp' OR $action == 'csu' ) AND $menu_item_id ){
			
			$update_data = array(
				
				'status' => $action == 'csp' ? '1' : '0',
				
			);
			
			if ( $this->menus_model->update( $update_data, array( 'id' => $menu_item_id ) ) ){
				
				msg( ('menu_item_' . ($action == 'csp' ? 'published' : 'unpublished' ) ), 'success' );
				redirect_last_url();
				
			}
		}
		
		/*
		 --------------------------------------------------------
		 Change status
		 --------------------------------------------------------
		 ********************************************************
		 */
		
		/*
		 ********************************************************
		 --------------------------------------------------------
		 Change ordering
		 --------------------------------------------------------
		 */
		
		else if ( $action == 'co' ) {
			
			$menu_item_id = $menu_item_id ? ( int ) $menu_item_id : ( isset( $post[ 'menu_item_id' ] ) ? ( int ) $post[ 'menu_item_id' ] : FALSE );
			$set_up = $sub_action == 'u' ? TRUE : ( isset( $post[ 'submit_up_ordering' ] ) ? TRUE : FALSE );
			$set_down = $sub_action == 'd' ? TRUE : ( isset( $post[ 'submit_down_ordering' ] ) ? TRUE : FALSE );
			$set_custom_ordering = isset( $post[ 'ordering' ] ) ? ( string ) ( ( int ) $post[ 'ordering' ] ) : FALSE;
			
			if ( ! $menu_item_id ){
				
				$menu_item_id =  $set_up ? ( int ) $post[ 'submit_up_order' ] : ( $set_down ? ( int ) $post[ 'submit_down_order' ] : FALSE );
				
			}
			
			if ( $menu_item_id ){
				
				if ( $set_up ){
					
					$this->menus->up_menu_item_ordering( $menu_item_id );
					
						msg( ( 'menu_item_order_changed' ), 'success' );
						redirect_last_url();
						
				}
				else if ( $set_down ){
					
					$this->menus->down_menu_item_ordering( $menu_item_id );
					
						msg( ( 'menu_item_order_changed' ), 'success' );
						redirect_last_url();
						
				}
				else if ( $set_custom_ordering AND ( $menu_item = $this->menus->get_menu_item( $menu_item_id ) ) ){
					
					if ( $this->menus->set_menu_item_ordering( $menu_item_id, ( int ) $set_custom_ordering ) ){
						
						msg( ( 'menu_item_order_changed' ), 'success' );
						redirect_last_url();
						
					}
					
				}
				
			}
			else {
				
				msg( ( 'no_menu_item_id_informed' ), 'error' );
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
		 Change ordering, up or down
		 --------------------------------------------------------
		 */
		
		else if ( ( $action == 'uo' OR $action == 'do' ) AND $this->input->post( 'menu_item_id' ) ){
			
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
			
			if ( $this->menus_model->update( $update_data, array( 'id' => $this->input->post( 'menu_item_id' ) ) ) ){
				
				msg( ( 'menu_item_order_changed' ), 'success' );
				redirect_last_url();
				
			}
			
		}
		
		/*
		 --------------------------------------------------------
		 Change ordering, up or down
		 --------------------------------------------------------
		 ********************************************************
		 */
		
		/*
		 ********************************************************
		 --------------------------------------------------------
		 Add / edit menu item
		 --------------------------------------------------------
		 */
		
		else if ( $action == 'ami' OR $action == 'emi' ){
			
			$this->load->helper( 'menus' );
			
			// verificamos se a ação é de edição ou adição
			// se for adição, desatribuímos a variável $menu_item_id ( se esta estiver definida ), pois esta não é necessária nesta ação
			if ( $menu_item_id ){
				
				if ( $menu_item = $this->menus_model->get_menu_item( $menu_item_id )->row_array() ){
					
					$data[ 'menu_item' ] = &$menu_item;
					$data[ 'params' ] = $menu_item[ 'params' ] = get_params( $menu_item[ 'params' ] );
					
				}
				else {
					
					show_404();
					
				}
				
			}
			
			if ( $sub_action AND $sub_action == 'select_menu_item_type' ){
				
				$this->db->select('
					
					t1.*,
					
					t2.title as component_title,
					t2.unique_name as component_alias,
					
				');
				
				$this->db->from('tb_menu_items_types t1');
				$this->db->join('tb_components t2', 't1.component_id = t2.id', 'left');
				$menu_items_types = $this->db->get()->result_array();
				
				foreach ( $menu_items_types as $key => &$menu_items_type ) {
					
					if ( $menu_items_type[ 'type' ] == 'component' ){
						
						$assoc_to_uri_array = array(
							
							'mtid' => $menu_type_id,
							'a' => $action,
							't' => $menu_items_type[ 'type' ],
							'cid' => $menu_items_type[ 'component_id' ],
							'ci' => $menu_items_type[ 'component_item' ],
							
						);
						
						if ( $action == 'emi' ){
							
							$assoc_to_uri_array[ 'miid' ] = $menu_item_id;
							
						}
						
						$menu_items_type[ 'link' ] = $this->uri->assoc_to_uri( $assoc_to_uri_array );
						
						$menu_items_type[ 'link' ] = 'admin/' . $this->component_name . '/' . __FUNCTION__ . '/' . $menu_items_type[ 'link' ];
						
					}
					else if ( $menu_items_type[ 'type' ] == 'blank_content' ){
						
						$assoc_to_uri_array = array(
							
							'mtid' => $menu_type_id,
							'a' => $action,
							't' => $menu_items_type[ 'type' ],
							
						);
						
						if ( $action == 'emi' ){
							
							$assoc_to_uri_array[ 'miid' ] = $menu_item_id;
							
						}
						
						$menu_items_type[ 'link' ] = $this->uri->assoc_to_uri( $assoc_to_uri_array );
						
						$menu_items_type[ 'link' ] = 'admin/' . $this->component_name . '/' . __FUNCTION__ . '/' . $menu_items_type[ 'link' ];
						
					}
					else if ( $menu_items_type[ 'type' ] == 'html_content' ){
						
						$assoc_to_uri_array = array(
							
							'mtid' => $menu_type_id,
							'a' => $action,
							't' => $menu_items_type[ 'type' ],
							
						);
						
						if ( $action == 'emi' ){
							
							$assoc_to_uri_array[ 'miid' ] = $menu_item_id;
							
						}
						
						$menu_items_type[ 'link' ] = $this->uri->assoc_to_uri( $assoc_to_uri_array );
						
						$menu_items_type[ 'link' ] = 'admin/' . $this->component_name . '/' . __FUNCTION__ . '/' . $menu_items_type[ 'link' ];
						
					}
					else if ( $menu_items_type[ 'type' ] == 'external_link' ){
						
						$assoc_to_uri_array = array(
							
							'mtid' => $menu_type_id,
							'a' => $action,
							't' => $menu_items_type[ 'type' ],
							
						);
						
						if ( $action == 'emi' ){
							
							$assoc_to_uri_array[ 'miid' ] = $menu_item_id;
							
						}
						
						$menu_items_type[ 'link' ] = $this->uri->assoc_to_uri( $assoc_to_uri_array );
						
						$menu_items_type[ 'link' ] = 'admin/' . $this->component_name . '/' . __FUNCTION__ . '/' . $menu_items_type[ 'link' ];
						
					}
					
				}
				
				$menu_items_types = array_menu_to_array_tree( $menu_items_types, 'id', 'parent' );
				
				$data[ 'menu_items_types' ] = ul_menu( $menu_items_types );
				
				$this->_page(
					
					array(
						
						'component_view_folder' => $this->component_view_folder,
						'function' => 'menu_items_management',
						'action' => 'menu_item_form',
						'layout' => 'default',
						'view' => 'select_menu_item_type',
						'data' => $data,
						
					)
					
				);
				
				//echo ul_menu( $menu_items );
				
			}
			
			// se o tipo do item de menu estiver definido, quer dizer que o tipo de item de menu foi escolhido, logo, podemos prosseguir para o formulário
			else if ( $type ){
				
				$data[ 'menu_items' ] = $this->menus_model->get_menu_tree( 0, 0, 'list', $menu_type_id );
				$data[ 'users' ] = $this->users_common_model->get_users_checking_privileges()->result_array();
				$data[ 'users_groups' ] = $this->users_common_model->get_accessible_users_groups( $this->users_common_model->user_data[ 'id' ] );
				
				/******************************/
				/********* Parâmetros *********/
				
				/******** Item de menu ********/
				
				// obtendo as especificações dos parâmetros
				$data['menu_item_params_spec'] = $this->menus_model->get_menu_item_params();
				
				if ( $action == 'emi' ){
					
					// obtendo os valores atuais dos parâmetros
					$data['current_params_values'] = $menu_item[ 'params' ];
					
					// cruzando os valores padrões das especificações com os atuais
					$data['menu_item_final_params_values'] = array_merge( $data['menu_item_params_spec']['params_spec_values'], $data['current_params_values'] );
					
				}
				else {
					
					// cruzando os valores padrões das especificações com os atuais
					$data['menu_item_final_params_values'] = $data['menu_item_params_spec']['params_spec_values'];
					
				}
				
				// definindo as regras de validação
				set_params_validations( $data['menu_item_params_spec']['params_spec'] );
				
				/******** Item de menu ********/
				
				/********* Parâmetros *********/
				/******************************/
				
				// se o tipo for component, então preparamos / obtemos os parâmetros necessários
				if ( $type == 'component' AND $component_id ){
					
					// obtendo o componente relacionado
					foreach ( $this->mcm->components as $key => $component ) {
						
						if ( $component[ 'id' ] == $component_id ){
							
							$target_component = $component;
							
							break;
							
						}
						
					}
					
					$data[ 'target_component' ] = $target_component;
					$data[ 'component_item' ] = $component_item;
					
					// carregando o model do componente
					$this->load->model( 'admin/' . $target_component[ 'unique_name' ] . '_model' );
					
					/******************************/
					/********* Parâmetros *********/
					
					/********* Componente *********/
					
					// Registrando o item do componente para identificação
					$this->menu_item_component_item = 'menu_item_' . $component_item;
					
					// obtendo as especificações dos parâmetros
					$data['component_params_spec'] = $this->{ $target_component[ 'unique_name' ] . '_model' }->{ 'menu_item_' . $component_item }();
					
					if ( $action == 'emi' ){
						
						// cruzando os valores padrões das especificações com os atuais
						$data['component_final_params_values'] = array_merge( $data['component_params_spec']['params_spec_values'], $data['current_params_values'] );
						
					}
					else {
						
						// cruzando os valores padrões das especificações com os atuais
						$data['component_final_params_values'] = $data['component_params_spec']['params_spec_values'];
						
					}
					
					// definindo as regras de validação
					set_params_validations( $data['component_params_spec']['params_spec'] );
					
					/********* Componente *********/
					
					/********* Parâmetros *********/
					/******************************/
					
					$data[ 'menu_item_link_disabled' ] = TRUE;
					
				}
				else if ( $type == 'blank_content' ) {
					
					$data[ 'menu_item_link_disabled' ] = TRUE;
					
				}
				else if ( $type == 'html_content' ) {
					
					$data[ 'menu_item_link_disabled' ] = TRUE;
					
					$menu_item[ 'html_content' ] = array();
					
				}
				else if ( $type == 'external_link' ) {
					
					$data[ 'menu_item_link_disabled' ] = FALSE;
					
				}
				
				// ajustando as permissões
				if ( $action == 'emi' ){
					
					if ( $menu_item[ 'access_type' ] === 'users' ){
						
						$menu_item[ 'access_user_id' ] = explode( '|', $menu_item[ 'access_ids' ] );
						
					}
					else if ( $menu_item[ 'access_type' ] === 'users_groups' ){
						
						$menu_item[ 'access_user_group_id' ] = explode( '|', $menu_item[ 'access_ids' ] );
						
					}
					
					if ( $type == 'html_content' ) {
						
						$menu_item[ 'html_content' ] = $menu_item[ 'params' ][ 'html_content' ];
						
					}
					
				}
				
				//validação dos campos
				$this->form_validation->set_rules( 'title', lang( 'title' ), 'trim|required' );
				$this->form_validation->set_rules( 'alias', lang( 'alias' ), 'trim' );
				$this->form_validation->set_rules( 'status', lang('status' ), 'trim|required|integer' );
				$this->form_validation->set_rules( 'parent', lang( 'parent' ), 'trim|required|integer' );
				$this->form_validation->set_rules( 'description', lang( 'description' ), 'trim' );
				
				// se o tipo de nível de acesso for para usuários específicos, aplicamos a validação pertinente
				if ( $this->input->post( 'access_type' ) == 'users' ){
					
					$this->form_validation->set_rules('access_user_id[]',lang('access_user'),'trim|required');
					
				}
				// caso contrário, se o tipo de nível de acesso for para grupos de usuários específicos, aplicamos a validação pertinente
				else if ( $this->input->post( 'access_type' ) == 'users_groups' ){
					
					$this->form_validation->set_rules( 'access_user_group_id[]', lang( 'access_user_group' ), 'trim|required' );
					
				}
				
				if($this->input->post('submit_cancel')){
					redirect_last_url();
				}
				// se a validação dos campos for positiva
				else if ( $this->form_validation->run() AND ( $this->input->post( 'submit' ) OR $this->input->post( 'submit_apply' ) ) ){
					
					$db_data = elements( array(
						
						'alias',
						'title',
						'description',
						'status',
						'parent',
						'component_id',
						'component_item',
						'menu_type_id',
						'access_type',
						'params',
						
					), $this->input->post() );
					
					if ( $type == 'component' ){
						
						$db_data[ 'type' ] = 'component';
						$db_data[ 'component_item' ] = $component_item;
						
					}
					else if ( $type == 'blank_content' ){
						
						$db_data[ 'type' ] = 'blank_content';
						
					}
					else if ( $type == 'html_content' ){
						
						$db_data[ 'type' ] = 'html_content';
						$db_data[ 'params' ][ 'html_content' ] = $this->input->post( 'html_content' );
						
					}
					else if ( $type == 'external_link' ){
						
						$db_data[ 'type' ] = 'external_link';
						$db_data[ 'link' ] = $this->input->post( 'link' );
						
					}
					
					if ( $db_data[ 'access_type' ] == 'users'){
						
						$db_data[ 'access_ids' ] = implode( '|', $this->input->post( 'access_user_id' ) );
						
					}
					else if ( $db_data[ 'access_type' ] == 'users_groups' ){
						
						$db_data[ 'access_ids' ] = implode( '|', $this->input->post( 'access_user_group_id' ) );
						
					}
					else{
						
						$db_data[ 'access_ids' ] = 0;
						
					}
					
					if ( $db_data[ 'alias' ] == '' ){
						
						$db_data[ 'alias' ] = url_title( $db_data[ 'title' ], '-', TRUE );
						
					}
					
					$db_data[ 'params' ] = json_encode( $db_data[ 'params' ] );
					
					$data_for_component_get_link = get_params( $db_data['params'] );
					
					if ( $action == 'ami' ){
						
						$return_id=$this->menus_model->insert( $db_data );
						
						if ( $return_id ){
							
							if ( $type == 'component' ){
								
								$db_data[ 'link' ] = $this->{ $target_component[ 'unique_name' ] . '_model'}->{'menu_item_get_link_' . $component_item }( $return_id, $data_for_component_get_link );
								$this->menus_model->update( $db_data, 'id = ' . $return_id );
								
							}
							else if ( $type == 'html_content' ){
								
								$db_data[ 'link' ] = $this->menus_model->get_link_html_content( $return_id );
								$this->menus_model->update( $db_data, 'id = ' . $return_id );
								
							}
							else if ( $type == 'blank_content' ){
								
								$db_data[ 'link' ] = $this->menus_model->get_link_blank_content( $return_id );
								$this->menus_model->update( $db_data, 'id = ' . $return_id );
								
							}
							
							msg(('menu_item_created'),'success');
							
							if ( $this->input->post( 'submit_apply' ) ){
								
								if ( $type == 'component' ){
									
									$assoc_to_uri_array = array(
										
										'mtid' => $menu_type_id,
										'a' => 'emi',
										't' => $type,
										'cid' => $component[ 'id' ],
										'ci' => $component_item,
										'miid' => $return_id,
										
									);
									
								}
								else if ( $type == 'blank_content' OR $type == 'html_content' OR $type == 'external_link' ){
									
									$assoc_to_uri_array = array(
										
										'mtid' => $menu_type_id,
										'a' => 'emi',
										't' => $type,
										'miid' => $return_id,
										
									);
									
								}
								
								$redirect_url = $this->uri->assoc_to_uri( $assoc_to_uri_array );
								
								$redirect_url = 'admin/' . $this->component_name . '/' . __FUNCTION__ . '/' . $redirect_url;
								
								redirect( $redirect_url );
								
							}
							else{
								redirect_last_url();
							}
							
						}
						
					}
					else if ( $action == 'emi' ){
						
						if ( $type == 'component' ){
							
							$db_data[ 'link' ] = $this->{ $target_component[ 'unique_name' ] . '_model' }->{ 'menu_item_get_link_' . $component_item }( $menu_item_id, $data_for_component_get_link );
							
						}
						
						if ( $this->menus_model->update( $db_data, array( 'id' => $menu_item_id ) ) ){
							
							msg( ( 'menu_item_updated' ), 'success' );
							
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
				else if (!$this->form_validation->run() AND validation_errors() != ''){
					
					$data['post'] = $this->input->post();
					
					msg(('add_menu_item_fail'),'title');
					msg(validation_errors('<div class="error">', '</div>'),'error');
					
				}
				//print_r($data);
				$this->_page(
					
					array(
						
						'component_view_folder' => $this->component_view_folder,
						'function' => 'menu_items_management',
						'action' => 'menu_item_form',
						'layout' => 'default',
						'view' => 'menu_item_form',
						'data' => $data,
						
					)
					
				);
				
			}
			
		}
		
		
		/*
		 --------------------------------------------------------
		 Add / edit menu item
		 --------------------------------------------------------
		 ********************************************************
		 */
		
		/*
		 ********************************************************
		 --------------------------------------------------------
		 Remove menu item
		 --------------------------------------------------------
		 */
		
		else if ( $action == 'r' ){
			
			if ( $menu_item_id AND ( $menu_item = $this->menus_model->get_menu_item( $menu_item_id )->row() ) ){
				
				if( $this->input->post( 'submit_cancel' ) ){
					
					redirect_last_url();
					
				}
				else if ($this->input->post('menu_item_id')>0 AND $menu_item AND $this->input->post('submit')){
					if ($this->menus_model->delete(array('id'=>$this->input->post('menu_item_id')))){
						msg(('menu_item_deleted'),'success');
						redirect_last_url();
					}
					else{
						msg($this->lang->line('menu_item_deleted_fail'),'error');
						redirect_last_url();
					}
				}
				else{
					
					$data[ 'menu_item' ] = $menu_item;
					
					$this->_page(
						
						array(
							
							'component_view_folder' => $this->component_view_folder,
							'function' => 'menu_items_management',
							'action' => 'remove_menu_item',
							'layout' => 'default',
							'view' => 'remove_menu_item',
							'data' => $data,
							
						)
						
					);
					
				}
			}
			else{
				
			}
		}
		
		/*
		 --------------------------------------------------------
		 Remove menu item
		 --------------------------------------------------------
		 ********************************************************
		 */
		
		else{
			show_404();
		}
	}
	
	/*
	 --------------------------------------------------------------------------------------------------
	 Menu items management
	 --------------------------------------------------------------------------------------------------
	 **************************************************************************************************
	 **************************************************************************************************
	 */
	
}
