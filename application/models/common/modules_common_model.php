<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modules_common_model extends CI_Model{
	
	public function get_modules(){
		
		$this->db->select('
			
			t1.*,
			
		');
		
		$this->db->from( 'tb_modules t1' );
		
		$this->db->order_by( 't1.ordering asc, t1.position asc, t1.id asc', '', TRUE );
		
		$mi_id = $this->mcm->current_menu_item[ 'id' ];
		
		$all_cond = 't1.mi_cond LIKE \'%"all"%\''; // módulos com condição de item de menu "todos"
		$all_except_cond = 't1.mi_cond NOT LIKE \'%"all_except"%"' . $mi_id . '"%\''; // módulos com condição de item de menu "todos, exceto"
		//$none_cond = 't1.mi_cond LIKE \'%"none"%\''; // módulos com condição de item de menu "nenhum"
		$none_except_cond = 't1.mi_cond LIKE \'%"none_except"%"' . $mi_id . '"%\''; // módulos com condição de item de menu "nenhum, exceto"
		$specific_cond = 't1.mi_cond LIKE \'%"specific"%"' . $mi_id . '"%\''; // módulos com condição de item de menu "específicos"
		
		$where =	't1.status = 1'; // módulos ativos
		$where .=	' AND ';
		$where .=	' t1.environment = \'' . environment() . '\' '; // módulos do ambiente atual
		$where .=	' AND ( ( ' . $all_except_cond . ' AND ( ' . $all_cond . ' OR ' . $specific_cond . ' OR ' . $none_except_cond . ') )';
		$where .=	' OR ( ' . $all_except_cond . ' AND t1.mi_cond LIKE \'%"all%\') )';
		
		$this->db->where( $where );
		
		$modules = $this->db->get()->result_array();
		
		$modules_result = array();
		foreach ( $modules as $key => &$module ) {
			
			$module_model_name = $module[ 'type' ] . '_module';
			
			$this->load->model( 'modules/' . $module_model_name );
			
			$module[ 'params' ] = get_params( $module[ 'params' ] );
			
			$modules_result[ $module[ 'position' ] ][ $module[ 'ordering' ] . '-' . $module[ 'alias' ] ] = $this->{ $module_model_name }->run( $module );
			
			$data[ 'content' ] = &$modules_result[ $module[ 'position' ] ][ $module[ 'ordering' ] . '-' . $module[ 'alias' ] ];
			
			// -------------------------------------------------
			// loading content plugins -------------------------
			
			$this->plugins->load( NULL, 'content' );
			
			// loading content plugins -------------------------
			// -------------------------------------------------
			
			
			
			
		}
		
		$this->mcm->loaded_modules = &$modules_result;
		
	}
	
	public function get_module( $id = NULL ){
		
		if ( $id != NULL ){
			
			$this->db->select('
				
				t1.*,
				
			');
			
			$this->db->from('tb_modules t1');
			$this->db->where( 't1.id', $id );
			// limitando o resultando em apenas 1
			$this->db->limit(1);
			return $this->db->get();
			
		}
		else {
			
			return FALSE;
			
		}
		
	}
	
	public function get_modules_types(){
		
		$modules_types = file_list_to_array( MODULES_PATH, '*.php' );
		
		foreach ( $modules_types as $key => &$module_type ) {
			
			$module_type = array( 
				
				'title' => 'module_type_' . basename( $module_type, '_module.php' ),
				'alias' => basename( $module_type, '_module.php' ),
				
			 );
			
		}
		
		$this->mcm->modules_types = &$modules_types;
		
	}
	
	public function insert( $data = NULL ){
		
		if ( $data != NULL ){
			
			if ( $this->db->insert( 'tb_modules', $data ) ){
				
				// confirm the insertion for controller
				return $this->db->insert_id();
				
			}
			else {
				
				// case the insertion fails, return false
				return FALSE;
				
			}
		}
		else {
			
			redirect( 'admin/modules/a/ml' );
			
		}
		
	}
	
	public function update( $data = NULL, $condition = NULL ){
		
		if ($data != NULL && $condition != NULL){
			if ($this->db->update('tb_modules', $data, $condition)){
				// confirm update for controller
				return TRUE;
			}
			else {
				// case update fails, return false
				return FALSE;
			}
		}
		redirect( 'admin/modules/a/ml' );
		
	}
	
	public function delete($condition = NULL){
		if ($condition != null){
			if ($this->db->delete('tb_modules',$condition)){
				// confirm delete for controller
				return TRUE;
			}
			else {
				// case delete fails, return false
				return FALSE;
			}
		}
		redirect();
	}
	
}
