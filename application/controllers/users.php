<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'controllers/main.php');

class Users extends Main {
	
	public function __construct(){
		
		parent::__construct();
		
		$this->load->language( array( 'calendar' ) );
		$this->load->model( array( 'common/users_common_model', ) );
		
		set_current_component();
		
	}
	
	public function index( $action = NULL, $current_menu_item_id = 0, $var1 = NULL, $var2 = NULL ){
		
		$this->component_function = __FUNCTION__;
		$this->component_function_action = $action;
		
		// obtendo os parâmetros globais do componente
		$component_params = get_params( $this->current_component[ 'params' ] );
		
		// obtendo os parâmetros do item de menu
		if ( $this->mcm->current_menu_item ){
			
			$menu_item_params = get_params( $this->mcm->current_menu_item[ 'params' ] );
			$data[ 'params' ] = filter_params( $component_params, $menu_item_params );
			
		}
		else{
			$data[ 'params' ] = $component_params;
		}
		
		if ( $action === 'login' ){
			
			if ( $this->session->userdata( 'site_login' ) ){
				
				redirect( get_url( $this->users_model->get_link_logout_page( $current_menu_item_id ) ) );
				
			}
			
			$url = get_url( $this->uri->ruri_string() );
			
			$data[ 'url' ] = $url;
			
			// obtendo o título do conteúdo da página,
			$this->mcm->html_data[ 'page_content_title' ] = '';
			if ( isset( $data[ 'params' ][ 'show_page_content_title' ] ) ){
				$data[ 'params' ][ 'show_page_content_title' ] = $data['params']['show_page_content_title']?1:0;
			}
			else{
				$data[ 'params' ][ 'show_page_content_title' ] = 1;
			}
			
			if ( @$data[ 'params' ][ 'custom_page_title' ] ){
				$this->mcm->html_data[ 'content' ][ 'title' ] = $data[ 'params' ][ 'custom_page_title' ];
			}
			else if ( $this->mcm->current_menu_item ){
				$this->mcm->html_data[ 'content' ][ 'title' ] = $this->mcm->current_menu_item[ 'title' ];
			}
			else{
				$this->mcm->html_data[ 'content' ][ 'title' ] = lang( 'login' );
			}
			
				$this->voutput->set_head_title( $this->mcm->html_data[ 'content' ][ 'title' ] );
				
			//validação dos campos
			$this->form_validation->set_rules( 'username', lang( 'username' ), 'trim|required' );
			$this->form_validation->set_rules( 'password', lang( 'password' ), 'trim|required' );
			
			if ( $this->input->post() AND $this->form_validation->run() ){
				
				$user_data = $this->users_common_model->get_user( array( 't1.username' => $this->input->post( 'username' ) ) )->row_array();
				
				// se o usuário existir
				if ( $user_data ){
					
					if ( base64_encode( md5( $this->input->post( 'password' ) ) ) == $user_data[ 'password' ] ){
						$user_data = array(
							'id' => $user_data['id'],
						);
						$this->session->set_userdata('site_login',TRUE);
						$this->session->set_userdata('site_user_data',$user_data);
						
						msg(('users_login_success'),'success');
						
						// TODO
						// redirecionar para uma página configurada nas configurações do item de menu ou configurações do componente
						redirect( get_last_url() );
					}
					else{
						msg( ( 'login_fail' ), 'title' );
						msg( ( 'incorrect_password' ), 'error' );
					}
				}
				else{
					msg( ( 'login_fail' ), 'title' );
					msg( ( 'the_user_does_not_exist' ), 'error' );
				}
				
			}
			// caso contrário se a validação dos campos falhar e existir mensagens de erro
			else if ( !$this->form_validation->run() AND validation_errors() != '' ){
				
				$data[ 'post' ] = $this->input->post();
				
				msg( ( 'login_fail' ), 'title' );
				msg( validation_errors( '<div class="error">', '</div>' ), 'error' );
			}
			
			$this->_page(
				
				array(
					
					'component_view_folder' => $this->component_view_folder,
					'function' => __FUNCTION__,
					'action' => $action,
					'view' => $action,
					'data' => $data,
					
				)
				
			);
			
		}
		else if ( $action === 'logout' ){
			
			$url = get_url( $this->uri->ruri_string() );
			
			$data = array(
				
				'url' => $url,
				'params' => array(),
				
			);
			
			$data[ 'params' ] = filter_params( get_params( $this->mcm->current_component[ 'params' ] ), get_params( $this->mcm->current_menu_item[ 'params' ] ) );
			
			// obtendo o título do conteúdo da página,
			$this->mcm->html_data['page_content_title'] = '';
			if ( isset($data['params']['show_page_content_title']) ){
				$data['params']['show_page_content_title'] = $data['params']['show_page_content_title']?1:0;
			}
			else{
				$data['params']['show_page_content_title'] = 1;
			}
			
			if ( @$data['params']['custom_page_title'] ){
				$this->mcm->html_data['content']['title'] = $data['params']['custom_page_title'];
			}
			else if ( $this->mcm->current_menu_item ){
				$this->mcm->html_data['content']['title'] = $this->mcm->current_menu_item['title'];
			}
			else{
				$this->mcm->html_data['content']['title'] = lang('login');
			}
			
			$this->voutput->set_head_title( $this->mcm->html_data[ 'content' ][ 'title' ] );
			
			if ( $this->input->post('submit_logout') ){
				
				$this->load->library( 'google' );
				$client = $this->google->client();
				$client->revokeToken();
				
				$this->users_common_model->remove_access_hash();
				$this->users_common_model->remove_session_from_user();
				
				$array_val = array(
					
					$this->mcm->environment . '_user_data' => '',
					$this->mcm->environment . '_login' => '',
					$this->mcm->environment . '_login_mode' => '',
					'facebook_token' => '',
					'google_token' => '',
					'profiler' => '',
					'select_on' => '',
					
				);
				
				$this->session->unset_userdata( $array_val );
				
				msg(('users_logout_success'),'success');
				//$this->session->sess_destroy();
				redirect( get_url($this->users_common_model->get_link_login_page($current_menu_item_id)) );
				
			}
			
			$this->_page(
				
				array(
					
					'component_view_folder' => $this->component_view_folder,
					'function' => __FUNCTION__,
					'action' => $action,
					'view' => $action,
					'data' => $data,
					
				)
				
			);
			
		}
		
	}
	
}
