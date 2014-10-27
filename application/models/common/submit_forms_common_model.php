<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Submit_forms_common_model extends CI_Model{
	
	public function get_submit_forms( $f_params = NULL ){
		
		// inicializando as variáveis
		$where_condition =						@$f_params['where_condition'] ? $f_params['where_condition'] : NULL;
		$or_where_condition =					@$f_params['or_where_condition'] ? $f_params['or_where_condition'] : NULL;
		$limit =								@$f_params['limit'] ? $f_params['limit'] : NULL;
		$offset =								@$f_params['offset'] ? $f_params['offset'] : NULL;
		$order_by =								@$f_params['order_by'] ? $f_params['order_by'] : 't1.title asc, t1.id asc';
		$order_by_escape =						@$f_params['order_by_escape'] ? $f_params['order_by_escape'] : TRUE;
		$return_type =							@$f_params['return_type'] ? $f_params['return_type'] : 'get';
		
		$this->db->select('
			
			t1.*
			
		');
		
		$this->db->from('tb_submit_forms t1');
		
		$this->db->order_by( $order_by, '', $order_by_escape );
		
		if ( $where_condition ){
			
			if( is_array( $where_condition ) ){
				
				foreach ( $where_condition as $key => $value ) {
					
					if( gettype( $where_condition ) === 'array' AND ( strpos( $key, 'fake_index_' ) !== FALSE ) ){
						
						$this->db->where( $value );
					}
					else $this->db->where( $key, $value );
				}
			}
			else $this->db->where( $where_condition );
		}
		if ( $or_where_condition ){
			if( is_array( $or_where_condition ) ){
				foreach ( $or_where_condition as $key => $value ) {
					
					if( gettype( $or_where_condition ) === 'array' AND ( strpos( $key, 'fake_index_' ) !== FALSE ) ){
						
						$this->db->or_where( $value );
						
					}
					else $this->db->or_where( $key, $value );
					
				}
			}
			else $this->db->or_where( $or_where_condition );
			
		}
		if ( $return_type === 'count_all_results' ){
			
			return $this->db->count_all_results();
			
		}
		if ( $limit ){
			
			$this->db->limit( $limit, $offset ? $offset : NULL );
			
		}
		
		return $this->db->get();
		
	}
	
	public function get_users_submits( $f_params = NULL ){
		
		// inicializando as variáveis
		$where_condition =						@$f_params['where_condition'] ? $f_params['where_condition'] : NULL;
		$or_where_condition =					@$f_params['or_where_condition'] ? $f_params['or_where_condition'] : NULL;
		$limit =								@$f_params['limit'] ? $f_params['limit'] : NULL;
		$offset =								@$f_params['offset'] ? $f_params['offset'] : NULL;
		$order_by =								@$f_params['order_by'] ? $f_params['order_by'] : 't1.submit_datetime desc, t1.id asc';
		$order_by_escape =						@$f_params['order_by_escape'] ? $f_params['order_by_escape'] : TRUE;
		$return_type =							@$f_params['return_type'] ? $f_params['return_type'] : 'get';
		
		$this->db->select('
			
			t1.*,
			t2.title as submit_form_title,
			
		');
		
		$this->db->from('tb_submit_forms_us t1');
		$this->db->join('tb_submit_forms t2', 't1.submit_form_id = t2.id', 'left');
		
		$this->db->order_by( $order_by, '', $order_by_escape );
		
		if ( $where_condition ){
			
			if( is_array( $where_condition ) ){
				
				foreach ( $where_condition as $key => $value ) {
					
					if( gettype( $where_condition ) === 'array' AND ( strpos( $key, 'fake_index_' ) !== FALSE ) ){
						
						$this->db->where( $value );
					}
					else $this->db->where( $key, $value );
				}
			}
			else $this->db->where( $where_condition );
		}
		if ( $or_where_condition ){
			if( is_array( $or_where_condition ) ){
				foreach ( $or_where_condition as $key => $value ) {
					
					if( gettype( $or_where_condition ) === 'array' AND ( strpos( $key, 'fake_index_' ) !== FALSE ) ){
						
						$this->db->or_where( $value );
						
					}
					else $this->db->or_where( $key, $value );
					
				}
			}
			else $this->db->or_where( $or_where_condition );
			
		}
		if ( $return_type === 'count_all_results' ){
			
			return $this->db->count_all_results();
			
		}
		if ( $limit ){
			
			$this->db->limit( $limit, $offset ? $offset : NULL );
			
		}
		
		return $this->db->get();
		
	}
	
	public function get_submit_form( $id = NULL ){
		
		if ( $id!=NULL ){
			$this->db->select('t1.*');
			$this->db->from('tb_submit_forms t1');
			$this->db->where( 't1.id', $id );
			// limitando o resultando em apenas 1
			$this->db->limit(1);
			return $this->db->get();
		}
		else {
			return FALSE;
		}
		
	}
	
	public function insert( $data = NULL ){
		if ($data != NULL){
			if ($this->db->insert('tb_submit_forms',$data)){
				// confirm the insertion for controller
				return $this->db->insert_id();
			}
			else {
				// case the insertion fails, return false
				return FALSE;
			}
		}
		else {
			redirect('categories');
		}
	}
	
	public function insert_user_submit( $data = NULL ){
		
		if ( $data != NULL AND gettype( $data ) === 'array' ){
			
			if ( $this->db->insert( 'tb_submit_forms_us', $data ) ){
				
				return $this->db->insert_id();
				
			}
			
		}
		
		log_message( 'error', '[Submit forms] Error attempting to insert submit record!' );
		
		return FALSE;
		
	}
	
	public function update($data = NULL,$condition = NULL){
		if ($data != NULL && $condition != NULL){
			if ($this->db->update('tb_submit_forms',$data,$condition)){
				// confirm update for controller
				return TRUE;
			}
			else {
				// case update fails, return false
				return FALSE;
			}
		}
		redirect('admin/menus');
	}
	public function update_user_submit( $data = NULL,$condition = NULL ){
		if ($data != NULL && $condition != NULL){
			if ($this->db->update('tb_submit_forms_us',$data,$condition)){
				// confirm update for controller
				return TRUE;
			}
			else {
				// case update fails, return false
				return FALSE;
			}
		}
		redirect('admin/menus');
	}
	
	public function remove_user_submit( $id = NULL ){
		
		
		if ( $id ) {
			
			if ( $this->db->delete( 'tb_submit_forms_us', array( 'id' => $id ) ) ){
				
				return TRUE;
				
			}
			
		}
		
		return FALSE;
		
	}
	
	public function delete( $condition = NULL ){
		if ($condition != null){
			if ($this->db->delete('tb_submit_forms',$condition)){
				// confirm delete for controller
				return TRUE;
			}
			else {
				// case delete fails, return false
				return FALSE;
			}
		}
		
	}
	
	public function delete_all(){
		
		$sql = 'DELETE FROM tb_submit_forms';
		
		if ( $this->db->query( $sql ) ){
			
			// confirm delete for controller
			return TRUE;
			
		}
		else {
			
			// case delete fails, return false
			return FALSE;
			
		}
		
	}
	
	public function get_submit_form_params(){
		
		$params = get_params_spec_from_xml( APPPATH . 'controllers/admin/com_submit_forms/submit_form_params.xml' );
		
		
		/*************************************/
		/******* Carregando os contatos ******/
		
		$this->load->model( array( 'common/contacts_common_model' ) );
		
		$contacts = $this->contacts_common_model->get_contacts()->result_array();
		
		$contacts_options = array();
		
		foreach ( $contacts as $contact ){
			
			$contacts_options[ $contact[ 'id' ] ] = $contact[ 'name' ];
			
		}
		
		/******* Carregando os contatos ******/
		/*************************************/
		
		
		// carregando os layouts do tema atual
		$layouts_sending_email = dir_list_to_array( THEMES_PATH . site_theme_components_views_path() . 'submit_forms' . DS . 'index' . DS . 'sending_email' );
		// carregando os layouts do diretório de views padrão
		$layouts_sending_email = array_merge( $layouts_sending_email, dir_list_to_array( VIEWS_PATH . SITE_COMPONENTS_VIEWS_PATH . 'submit_forms' . DS . 'index' . DS . 'sending_email' ) );
		
		$current_section = 'sending';
		foreach ( $params[ 'params_spec' ][ $current_section ] as $key => $element ) {
			
			if ( $element[ 'name' ] == 'submit_form_param_send_email_to_contact' ){
				
				$spec_options = array();
				
				if ( isset( $params[ 'params_spec' ][ $current_section ][ $key ][ 'options' ] ) )
					$spec_options = $params[ 'params_spec' ][ $current_section ][ $key ][ 'options' ];
				
				$params[ 'params_spec' ][ $current_section ][ $key ][ 'options' ] = is_array( $spec_options ) ? $spec_options + $contacts_options : $contacts_options;
				
			}
			if ( $element[ 'name' ] == 'submit_form_sending_email_layout_view' ){
				
				$spec_options = array();
				
				if ( isset( $params[ 'params_spec' ][ $current_section ][ $key ][ 'options' ] ) )
					$spec_options = $params[ 'params_spec' ][ $current_section ][ $key ][ 'options' ];
				
				$params[ 'params_spec' ][ $current_section ][ $key ][ 'options' ] = is_array( $spec_options ) ? $spec_options + $layouts_sending_email : $layouts_sending_email;
				
			}
			
		}
		
		// carregando os layouts do tema atual
		$layouts = dir_list_to_array( THEMES_PATH . site_theme_components_views_path() . 'submit_forms' . DS . 'index' . DS . 'submit_form' );
		// carregando os layouts do diretório de views padrão
		$layouts = array_merge( $layouts, dir_list_to_array( VIEWS_PATH . SITE_COMPONENTS_VIEWS_PATH . 'submit_forms' . DS . 'index' . DS . 'submit_form' ) );
		
		$current_section = 'look_and_feel';
		foreach ( $params[ 'params_spec' ][ $current_section ] as $key => $element ) {
			
			if ( $element[ 'name' ] == 'submit_form_layout_view' ){
				
				$spec_options = array();
				
				if ( isset( $params[ 'params_spec' ][ $current_section ][ $key ][ 'options' ] ) )
					$spec_options = $params[ 'params_spec' ][ $current_section ][ $key ][ 'options' ];
				
				$params[ 'params_spec' ][ $current_section ][ $key ][ 'options' ] = is_array( $spec_options ) ? $spec_options + $layouts : $layouts;
				
			}
			
		}
		
		// print_r($params);
		
		return $params;
	}
	
	
}
