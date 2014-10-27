<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function msg( $message = NULL, $type = NULL ){
	
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

function loadMsg(){
	
	$CI =& get_instance();
	
	$html_msg = '';
	
	if ( $CI->session->userdata( $CI->mcm->environment . '_msg' ) ) {
		
		$html_msg .= '<div class="msg">';
		
		$msg = $CI->session->userdata( $CI->mcm->environment . '_msg' );
		foreach ($msg as $item) {
			
			$html_msg .= '<div class="msg-item msg-type-'.$item['type'].'">';
			$html_msg .= lang( $item['msg'] );
			$html_msg .= '</div>';
			
		}
		
		$CI->session->unset_userdata( $CI->mcm->environment . '_msg' );
		
		$html_msg .= '</div>';
		
		return $html_msg;
		
	}
	
}
/* End of file msg_helper.php */
/* Location: ./application/helpers/msg_helper.php */