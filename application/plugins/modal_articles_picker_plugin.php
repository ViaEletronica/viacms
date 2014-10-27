<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modal_articles_picker_plugin extends Plugins_mdl{
	
	public function run( &$data, $params = NULL ){
		
		$return = FALSE;
		
		if ( parent::_performed( 'fancybox' ) ) {
			
			log_message( 'debug', '[Plugins] Modal Articles Picker plugin initialized' );
			
			$this->voutput->append_head_script_declaration( 'modal_articles_picker', $this->load->view( 'admin/plugins/modal_articles_picker/default/modal_articles_picker', NULL, TRUE ), NULL, NULL );
			
			$return = TRUE;
			
		}
		else{
			
			log_message( 'debug', '[Plugins] Modal Articles Picker plugin could not be executed! Fancybox plugin not performed!' );
			
			$return = FALSE;
			
		}
		
		parent::_set_performed( 'modal_articles_picker' );
		
		return $return;
		
	}
	
}
