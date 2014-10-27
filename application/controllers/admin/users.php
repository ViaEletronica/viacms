<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'controllers/admin/main.php');

class Users extends Main {
	
	public function __construct(){
		
		parent::__construct();
		
		set_current_component();
		
	}
	
	public function index(){
		$this->users_management('users_list');
	}
	
	public function users_management($action = NULL, $id = NULL){
		
		$this->component_function = __FUNCTION__;
		$this->component_function_action = $action;
		
		if ($action){
			
			$url = get_url('admin'.$this->uri->ruri_string());
			
			// verifica se o usuário atual possui privilégios para gerenciar usuários, porém pode editar seu próprio usuário
			if ( $action != 'edit_user' AND ! $this->users_common_model->check_privileges('users_management_users_management') AND ! $id ){
				msg(('access_denied'),'title');
				msg(('access_denied_users_management_users_management'),'error');
				redirect('admin');
			};
			
			if ($action == 'users_list'){
				
				$users = $this->users_common_model->get_users_checking_privileges();
				if ($users){
					
					$data = array(
						'component_name' => $this->component_name,
						'users' => $users->result(),
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
			else if (($action == 'fetch_publish' OR $action == 'fetch_unpublish') AND $id){
					
				$update_data = array(
					'status' => $action == 'fetch_publish'?'2':'1',
				);
				
				$update_data['params'] = '';
				
				if ($this->articles_model->update_article($update_data, array('id' => $id))){
					msg(('article_'.($action == 'fetch_publish'?'published':'unpublished')),'success');
					redirect($url);
				}
			}
			else if ($action == 'add_user'){
				
				// verifica se o usuário atual possui privilégios para adicionar novos usuários
				if ( ! $this->users_common_model->check_privileges('users_management_can_add_user') ){
					msg(('access_denied'),'title');
					msg(('access_denied_users_management_can_add_user'),'error');
					redirect_last_url();
				};
				
				$data = array(
					'component_name' => $this->component_name,
					'users_groups' => $this->users_common_model->get_accessible_users_groups($this->users_common_model->user_data['id']),
					//'categories' => $this->articles_model->get_categories_tree(0,0,'list'),
				);
				
				/******************************/
				/********* Parâmetros *********/
				
				// obtendo as especificações dos parâmetros
				$data['params_spec'] = $this->users_common_model->get_user_params();
				
				// cruzando os valores padrões das especificações com os atuais
				$data['final_params_values'] = $data['params_spec']['params_spec_values'];
				
				// definindo as regras de validação
				set_params_validations( $data['params_spec']['params_spec'] );
				
				/********* Parâmetros *********/
				/******************************/
				
				//validação dos campos
				$this->form_validation->set_message('is_unique', "Este %s já existe");
				$this->form_validation->set_rules('username',lang('username'),'trim|required|min_length[3]|max_length[24]|is_unique[tb_users.username]');
				$this->form_validation->set_rules('name',lang('name'),'trim|required');
				$this->form_validation->set_rules('email',lang('email'),'trim|required|email|is_unique[tb_users.email]');
				$this->form_validation->set_rules('group_id',lang('user_group'),'trim|required|integer');
				$this->form_validation->set_rules('password',lang('password'),'trim|required|min_length[6]|max_length[24]');
				$this->form_validation->set_rules('confirm_password',lang('confirm_password'),'trim|matches[password]');
				$this->form_validation->set_rules('checkbox_array[]',lang('name'),'trim');
				$this->form_validation->set_rules('checkbox_normal',lang('name'),'trim');
				
				if($this->input->post('submit_cancel')){
					redirect_last_url();
				}
				// se a validação dos campos for positiva
				else if ($this->form_validation->run() AND ($this->input->post('submit') OR $this->input->post('submit_apply'))){
					$insert_data = elements(array(
						'username',
						'name',
						'email',
						'group_id',
						'params',
					),$this->input->post());
					
					$insert_data['password'] = base64_encode(md5($this->input->post('password')));
					
					$insert_data['params'] = json_encode( $insert_data['params'] );
					
					$return_id=$this->users_common_model->insert_user($insert_data);
					if ($return_id){
						msg(('user_created'),'success');
						if ($this->input->post('submit_apply')){
							redirect('admin/'.$this->component_name . '/' . __FUNCTION__.'/edit_user/'.base64_encode(base64_encode(base64_encode(base64_encode($return_id)))));
						}
						else{
							redirect_last_url();
						}
					}
					
				}
				// caso contrário se a validação dos campos for negativa e mensagens de erro conter strings
				else if (!$this->form_validation->run() AND validation_errors() != ''){
					
					$data['post'] = $this->input->post();
					
					msg(('create_user_fail'),'title');
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
			else if ($action == 'edit_user' AND $id AND ($user = $this->users_common_model->get_user(array('t1.id' => base64_decode(base64_decode(base64_decode(base64_decode($id))))))->row())){
				
				$id = base64_decode(base64_decode(base64_decode(base64_decode($id))));
				
				// verifica se o usuário atual possui privilégios para gerenciar usuários
				if ( ! $this->users_common_model->check_privileges('users_management_users_management') AND $id != $this->users_common_model->user_data['id'] ){
					msg(('access_denied'),'title');
					msg(('access_denied_users_management_users_management'),'error');
					redirect('admin');
				};
				
				// verifica se o usuário atual possui privilégios para ver informações dos usuários, exceto o seu próprio
				if ( ! $this->users_common_model->check_privileges('users_management_view_personal_info') AND $id != $this->users_common_model->user_data['id'] ){
					msg(('access_denied'),'title');
					msg(('access_denied_users_management_view_personal_info'),'error');
					redirect_last_url();
				};
				
				// checa as permissões
				if ( $this->input->post() AND ! $this->input->post('submit_cancel') ){
					
					if ( $id != $this->users_common_model->user_data['id'] AND ! $this->users_common_model->check_privileges('users_management_can_edit_only_your_own_user') ){
						
						$is_on_same_or_below_group_level = $this->users_common_model->check_if_user_is_on_same_and_low_group_level( $id );
						$is_on_same_group_level = $this->users_common_model->check_if_user_is_on_same_group_level($id);
						$is_on_same_group_or_below = $this->users_common_model->check_if_user_is_on_same_group_and_below($id);
						$is_on_same_group = $this->users_common_model->check_if_user_is_on_same_group($id);
						$is_on_below_groups = $this->users_common_model->check_if_user_is_on_below_groups($id);
						
						$can_edit_all_users = $this->users_common_model->check_privileges( 'can_edit_all_users' );
						$can_edit_only_same_and_low_group_level = $this->users_common_model->check_privileges('users_management_can_edit_only_same_and_low_group_level');
						$can_edit_only_same_group_level = $this->users_common_model->check_privileges('users_management_can_edit_only_same_group_level');
						$can_edit_only_same_group_and_below = $this->users_common_model->check_privileges('users_management_can_edit_only_same_group_and_below');
						$can_edit_only_same_group = $this->users_common_model->check_privileges('users_management_can_edit_only_same_group');
						$can_edit_only_below_groups = $this->users_common_model->check_privileges('users_management_can_edit_only_low_groups');
							
						if ( $can_edit_only_same_and_low_group_level AND ! ( $is_on_same_or_below_group_level ) ){
							
							msg(('access_denied'),'title');
							msg(('access_denied_users_management_can_edit_only_same_and_low_group_level'),'error');
							
							redirect_last_url();
							
						}
						else if ( $can_edit_only_same_group_level AND ! ( $is_on_same_group_level ) ){
							
							msg(('access_denied'),'title');
							msg(('access_denied_users_management_edit_same_group_level'),'error');
							
							redirect_last_url();
							
						}
						else if ( $can_edit_only_same_group_and_below AND ! ( $is_on_same_group_or_below ) ){
							
							msg(('access_denied'),'title');
							msg(('access_denied_users_management_edit_same_group_and_below'),'error');
							
							redirect_last_url();
							
						}
						else if ( $can_edit_only_same_group AND ! ( $is_on_same_group ) ){
							
							msg(('access_denied'),'title');
							msg(('access_denied_users_management_edit_same_group'),'error');
							
							redirect_last_url();
							
						}
						else if ( $can_edit_only_below_groups AND ! ( $is_on_below_groups )){
							
							msg(('access_denied'),'title');
							msg(('access_denied_users_management_edit_below_groups'),'error');
							
							redirect_last_url();
							
						}
						
					}
					else if ( $id != $this->users_common_model->user_data['id'] AND $this->users_common_model->check_privileges('users_management_can_edit_only_your_own_user')){
						
						msg(('access_denied'),'title');
						msg(('access_denied_users_management_edit_only_your_own_user'),'error');
						
							redirect_last_url();
						
					};
				}
				
				$data = array(
					'component_name' => $this->component_name,
					//'categories' => $this->articles_model->get_categories_tree(0,0,'list'),
					'user' => $user,
					'users_groups' => $this->users_common_model->get_accessible_users_groups($id),
				);
				
				/******************************/
				/********* Parâmetros *********/
				
				// obtendo os valores atuais dos parâmetros
				$data['current_params_values'] = get_params( $user->params );
				
				// obtendo as especificações dos parâmetros
				$data['params_spec'] = $this->users_common_model->get_user_params();
				
				// cruzando os valores padrões das especificações com os atuais
				$data['final_params_values'] = array_merge( $data['params_spec']['params_spec_values'], $data['current_params_values'] );
				
				// definindo as regras de validação
				set_params_validations( $data['params_spec']['params_spec'] );
				
				/********* Parâmetros *********/
				/******************************/
				
				//validação dos campos
				$this->form_validation->set_rules('name',lang('name'),'trim|required');
				$this->form_validation->set_rules('group_id',lang('user_group'),'trim|required|integer');
				if($this->input->post('password') OR $this->input->post('confirm_password')){
					$this->form_validation->set_rules('password',lang('password'),'trim|required|min_length[6]|max_length[24]');
					$this->form_validation->set_rules('confirm_password',lang('confirm_password'),'trim|required|min_length[6]|max_length[24]|matches[password]');
				}
				
				if($this->input->post('submit_cancel')){
					redirect_last_url();
				}
				// se a validação dos campos for positiva
				else if ($this->form_validation->run() AND ($this->input->post('submit') OR $this->input->post('submit_apply'))){
					
					$update_data = elements(array(
						'name',
						'group_id',
						'params',
					),$this->input->post());
					
					if($this->input->post('password')){
						$update_data['password'] = base64_encode(md5($this->input->post('password')));
					}
					
					$update_data['params'] = json_encode( $update_data['params'] );
					
					if ($this->users_common_model->update_user($update_data, array('id' => $id))){
						
						if ($id == $this->users_common_model->user_data['id']){
							
							$user_data = $this->users_common_model->get_user(array('t1.id' => $id))->row_array();
							
							$user_data['privileges'] = get_params( $user_data['privileges'] );
							$user_data['privileges'] = array_flatten( $user_data['privileges'] );
							
							$user_data['params'] = get_params( $user_data['params'] );
							
							$this->users_common_model->set_user_preferences( $user_data['params'], FALSE );
							
						}
						
						msg( 'user_updated', 'success' );
						
						if ($this->input->post('submit_apply')){
							redirect('admin/'.$this->component_name . '/' . __FUNCTION__.'/edit_user/'.$this->input->post('user_id'));
						}
						else{
							redirect_last_url();
						}
					}
					
				}
				// caso contrário se a validação dos campos for negativa e mensagens de erro conter strings
				else if (!$this->form_validation->run() AND validation_errors() != ''){
					
					$data['post'] = $this->input->post();
					
					msg(('update_user_fail'),'title');
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
			else if ($action == 'remove_user' AND $id){
				
				$id = base64_decode(base64_decode(base64_decode(base64_decode($id))));
				
				$user = $this->users_common_model->get_user(array('t1.id'=>$id))->row();
				
				if ($user){
					
					if($this->input->post('submit_cancel')){
						redirect_last_url();
					}
					else if ($this->input->post('submit')){
						if ($this->users_common_model->delete_user(array('id'=>$id))){
							msg(('user_deleted'),'success');
							redirect_last_url();
						}
						else{
							msg($this->lang->line('user_deleted_fail'),'error');
							redirect_last_url();
						}
					}
					else{
						$data=array(
							'component_name' => $this->component_name,
							'user'=>$user,
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
			}
			else{
				show_404();
			}
		}
		
	}
	
	
	/******************************************************************************/
	/******************************************************************************/
	/******************************** Users groups ********************************/
	
	public function users_groups_management($action = NULL, $id = NULL){
		
		$this->component_function = __FUNCTION__;
		$this->component_function_action = $action;
		
		// verifica se o usuário atual possui privilégios para gerenciar grupos de usuários
		if ( ! $this->users_common_model->check_privileges('users_management_users_groups_management') ){
			msg(('access_denied'),'title');
			msg(('access_denied_users_management_users_groups_management'),'error');
			redirect_last_url();
		};
		
		if ($action){
			
			$url = get_url('admin'.$this->uri->ruri_string());
			
			
			/**************************************************/
			/********************** fetch *********************/
			if ($action == 'users_groups_list'){
				
				if ($users_groups = $this->users_common_model->get_users_groups_tree(0,0,'list')){
					
					$data = array(
						'component_name' => $this->component_name,
						'users_groups' => $users_groups,
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
			/********************** fetch *********************/
			/**************************************************/
			
			/**************************************************/
			/*********************** add **********************/
			else if ($action == 'add_users_group'){
				
				$data = array(
					'component_name' => $this->component_name,
					'users_groups' => $this->users_common_model->get_users_groups_tree(0,0,'list'),
				);
				
				/******************************/
				/******** Privilégios *********/
				
				// obtendo os valores atuais dos parâmetros
				$data['privileges_current_params_values'] = array();
				
				// obtendo as especificações dos parâmetros
				$data['privileges_params_spec'] = $this->users_common_model->get_users_groups_privileges();
				
				// cruzando os valores padrões das especificações com os atuais
				$data['privileges_final_params_values'] = array_merge( $data['privileges_params_spec']['params_spec_values'], $data['privileges_current_params_values'] );
				
				// definindo as regras de validação, o último argumento define o prefixo dos campos, que é o mesmo da coluna no DB
				set_params_validations( $data['privileges_params_spec']['params_spec'], 'privileges' );
				
				/******** Privilégios *********/
				/******************************/
				
				//validação dos campos
				$this->form_validation->set_rules('title',lang('title'),'trim|required');
				$this->form_validation->set_rules('alias',lang('alias'),'trim');
				$this->form_validation->set_rules('parent',lang('parent'),'trim|required|integer');
				
				if($this->input->post('submit_cancel')){
					redirect_last_url();
				}
				
				// se a validação dos campos for bem sucessida
				else if ($this->form_validation->run() AND ($this->input->post('submit') OR $this->input->post('submit_apply'))){
					$insert_data = elements(array(
						'title',
						'alias',
						'parent',
						'privileges',
					),$this->input->post());
					
					if ($insert_data['alias'] == ''){
						$insert_data['alias'] = url_title($insert_data['title'],'-',TRUE);
					}
					
					$insert_data['privileges'] = json_encode( $insert_data[ 'privileges' ] );
					
					$return_id=$this->users_common_model->insert_user_group($insert_data);
					if ($return_id){
						msg(('user_group_created'),'success');
						
						if ($this->input->post('submit_apply')){
							redirect('admin/'.$this->component_name . '/' . __FUNCTION__.'/edit_users_group/'.$return_id);
						}
						else{
							redirect_last_url();
						}
					}
					
				}
				// caso contrário se a validação dos campos for negativa e mensagens de erro conter strings
				else if (!$this->form_validation->run() AND validation_errors() != ''){
					
					$data['post'] = $this->input->post();
					
					msg(('create_user_group_fail'),'title');
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
			/*********************** add **********************/
			/**************************************************/
			
			/**************************************************/
			/********************** edit **********************/
			else if ($action == 'edit_users_group' AND $id AND ($user_group = $this->users_common_model->get_user_group(array('t1.id' => $id))->row())){
				
				$data = array(
					'component_name' => $this->component_name,
					'users_groups' => $this->users_common_model->get_users_groups_as_list_childrens_hidden(0,$id),
					'user_group' => $user_group,
				);
				
				/******************************/
				/******** Privilégios *********/
				
				// obtendo os valores atuais dos parâmetros
				$data['privileges_current_params_values'] = get_params( $user_group->privileges );
				
				// obtendo as especificações dos parâmetros
				$data['privileges_params_spec'] = $this->users_common_model->get_users_groups_privileges();
				
				// cruzando os valores padrões das especificações com os atuais
				$data['privileges_final_params_values'] = array_merge( $data['privileges_params_spec']['params_spec_values'], $data['privileges_current_params_values'] );
				
				// definindo as regras de validação, o último argumento define o prefixo dos campos, que é o mesmo da coluna no DB
				set_params_validations( $data['privileges_params_spec']['params_spec'], 'privileges' );
				
				/******** Privilégios *********/
				/******************************/
				
				//validação dos campos
				$this->form_validation->set_rules('title',lang('title'),'trim|required');
				$this->form_validation->set_rules('alias',lang('alias'),'trim');
				$this->form_validation->set_rules('parent',lang('parent'),'trim|required|integer');
				
				if($this->input->post('submit_cancel')){
					redirect_last_url();
				}
				// se a validação dos campos for bem sucessida
				else if ($this->form_validation->run() AND ($this->input->post('submit') OR $this->input->post('submit_apply'))){
					$update_data = elements(array(
						'title',
						'alias',
						'parent',
						'privileges',
					),$this->input->post());
					
					if ($update_data['alias'] == ''){
						$update_data['alias'] = url_title($update_data['title'],'-',TRUE);
					}
					
					$update_data['privileges'] = json_encode($this->input->post('privileges'));
					
					if ($this->users_common_model->update_user_group($update_data, array('id' => $this->input->post('user_group_id')))){
						msg(('user_group_updated'),'success');
						
						if ($this->input->post('submit_apply')){
							redirect('admin'.$this->uri->ruri_string());
						}
						else{
							redirect_last_url();
						}
					}
					
				}
				// caso contrário se a validação dos campos falhar e se existir mensagens de erro
				else if (!$this->form_validation->run() AND validation_errors() != ''){
					
					$data['post'] = $this->input->post();
					
					msg(('update_user_group_fail'),'title');
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
			/********************** edit **********************/
			/**************************************************/
			
			/**************************************************/
			/********************* remove *********************/
			else if ($action == 'remove_users_group' AND $id AND ($users_group = $this->users_common_model->get_user_group(array('t1.id'=>$id))->row())){
				
				if($this->input->post('submit_cancel')){
					redirect_last_url();
				}
				else if ($this->input->post('users_group_id')>0 AND $this->input->post('submit')){
					if ($this->users_common_model->delete_users_group(array('id'=>$id))){
						msg(('users_group_deleted'),'success');
						redirect_last_url();
					}
					else{
						msg($this->lang->line('users_group_deleted_fail'),'error');
						redirect_last_url();
					}
				}
				else{
					$data=array(
						'component_name' => $this->component_name,
						'users_group'=>$users_group,
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
			/********************** remove **********************/
			/**************************************************/
			
			else{
				//show_404();
			}
		}
		
	}
	
	/******************************** Users groups ********************************/
	/******************************************************************************/
	/******************************************************************************/
	
	
	public function preferences($action = NULL, $layout = 'default'){
		
		$this->component_function = __FUNCTION__;
		$this->component_function_action = $action;
		
		if ($action){
			
			if ($action == 'edit' AND ($component = $this->main_model->get_component(array('alias' => $this->component_name))->row())){
				
				$data = array(
					'component_name' => $this->component_name,
					'component' => $component,
				);
				
				// pegando os parâmetros
				$data['params'] = $this->articles_model->get_general_params();
				
				$this->form_validation->set_rules('component_id',lang('id'),'trim|required|integer');
				
				// pegando as validações dos parâmetros do item específico do componente
				foreach ($data['params'] as $key => $value) {
					foreach ($value as $key_1 => $value_1) {
						foreach ($value_1 as $key_2 => $value_2) {
							foreach ($value_2 as $key_3 => $value_3) {
								if ($key_3 == 'validation'){
									if (isset($value_3['messages'])){
										foreach ($value_3['messages'] as $key_4 => $value_4) {
											$this->form_validation->set_message($value_4['rule'],lang($value_4['message']));
										}
									}
									$this->form_validation->set_rules(PARAM_PREFIX.$key_2,lang($value_2['title']),isset($value_3['rules'])?$value_3['rules']:'');
								}
							}
						}
					}
				}
				
				if($this->input->post('submit_cancel')){
					redirect_last_url();
				}
				// se a validação dos campos for positiva
				else if ($this->form_validation->run() AND ($this->input->post('submit') OR $this->input->post('submit_apply'))){
					
					$update_data = elements(array(
						'params',
					),$this->input->post());
					
					$update_data['params'] = '';
					foreach ($this->input->post() as $key => $value) {
						if (strpos($key,PARAM_PREFIX) !== FALSE){
							$update_data['params'] .= str_replace(PARAM_PREFIX, '', $key).'='.$value."\n";
						}
					}
					
					if ($this->main_model->update_component($update_data, array('id' => $this->input->post('component_id')))){
						msg(('component_preferences_updated'),'success');
						
						if ($this->input->post('submit_apply')){
							redirect('admin/'.$this->component_name . '/' . __FUNCTION__.'/edit/'.$layout);
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
				show_404();
			}
		}
		
	}
	
}
