<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function google_contacts_get_all( $message = NULL, $type = NULL ){
	
	if ( $message ){
		
		$CI =& get_instance();
		
		if ( $CI->session->userdata( $CI->mcm->environment . '_msg' ) ) {
			
			$current_msg = $CI->session->userdata( $CI->mcm->environment . '_msg' );
			$msg = array(
				
				 $CI->mcm->environment . '_msg'  => $current_msg,
				 
			);
			
			$msg[ $CI->mcm->environment . '_msg' ][] = array(
			
				'msg' => $message,
				'type' => $type,
				
			);
			
		}
		else{
			$msg = array(
				
				$CI->mcm->environment . '_msg'  => array(),
				
			);
			
			$msg[ $CI->mcm->environment . '_msg' ][] = array(
				
				'msg' => $message,
				'type' => $type,
				
			);
		}
		
		$CI->session->set_userdata( $msg );
		
	}
	else {
		return FALSE;
	}
	
}

/* End of file msg_helper.php */
/* Location: ./application/helpers/msg_helper.php */