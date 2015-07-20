<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Form Validation Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Validation
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/form_validation.html
 */
class Viacms_Form_validation extends CI_Form_validation {
	
	private $_custom_field_errors = array();
	protected $ci;
	
	public function __construct(){
		
		parent::__construct();
		
		$this->ci =& get_instance();
		
	}
	
	
	
	function _domain_exists( $str, $record = 'ANY' ){
		
		return checkdnsrr( $str, $record );
		
	}
	
	function _valid_domain( $str ){
		
		if ( $str ) {
			
			if ( ( preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $str) //valid chars check
				&& preg_match("/^.{1,253}$/", $str) //overall length check
				&& preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $str ) ) ) //length of each label )
			{
				
				return TRUE;
				
			}
			
			return FALSE;
			
		}
		
	}
	
	function valid_domain( $str ){
		
		if ( $str ) {
			
			if ( $this->_valid_domain( $str ) ) {
				
				return TRUE;
				
			}
			
			$this->CI->form_validation->set_message( 'valid_domain', lang( 'validation_rule_valid_domain_is_invalid' ) );
			return FALSE;
			
		}
		
	}
	
	function valid_domain_dns( $str ){
		
		if ( $str ) {
			
			if ( $this->_valid_domain( $str ) ) {
				
				if ( $this->_domain_exists( $str ) ) {
				
					return TRUE;
					
				}
				else {
					
					$this->CI->form_validation->set_message( 'valid_domain_dns', lang( 'validation_rule_valid_domain_dns_not_exists' ) );
					
					return FALSE;
					
				}
				
			}
			
			$this->CI->form_validation->set_message( 'valid_domain_dns', lang( 'validation_rule_valid_domain_dns_is_invalid' ) );
			return FALSE;
			
		}
		
	}
	
	function valid_email_dns( $str ){
		
		$this->ci->load->library( 'verify_email' );
		
		$email = $str;
		
		if ( $this->ci->verify_email->check( $email ) ) {
			
			return TRUE;
			
		} elseif ( $this->ci->verify_email->isValid( $email ) ) {
			
			$this->CI->form_validation->set_message( 'valid_email_dns', sprintf( lang( 'valid_email_dns_not_exists' ), $email ) );
			return FALSE;
			
		} else {
			
			$this->CI->form_validation->set_message( 'valid_email_dns', sprintf( lang( 'valid_email_dns_is_invalid' ), $email ) );
			return FALSE;
		    
		}
		
	}
	
	public function add_message($field, $message) {
		//this field was validated without error
		if(isset($this->_field_data[$field]) AND (!isset($this->_field_data[$field]['error']) OR !$this->_field_data[$field]['error']) )
			
			$this->_field_data[$field]['error'] = $message;
	}
	
	// --------------------------------------------------------------------

	
	// Substitui a função Matches padrão para suportar campos em formato de array
	public function matches($str, $field){
		
		$return = FALSE;
		
		$indexes = array();
		if (strpos($field, '[') !== FALSE AND preg_match_all('/\[(.*?)\]/', $field, $matches)){
			
			// Note: Due to a bug in current() that affects some versions
			// of PHP we can not pass function call directly into it
			$x = explode('[', $field);
			$indexes[] = current($x);
			
			for ($i = 0; $i < count($matches['0']); $i++)
			{
				if ($matches['1'][$i] != '')
				{
					$indexes[] = $matches['1'][$i];
				}
			}
			
			$is_array = TRUE;
		}
		
		if (!empty($indexes))
		{
			$it = new RecursiveArrayIterator($indexes);
			
			$search = $_POST;
			while ($it->valid() && $search !== FALSE)
			{
				if (isset($search[$it->current()]))
					$search = $search[$it->current()];
				else
					$search = FALSE;

				$it->next();
			}

			if ($search !== FALSE)
				$return = $search === $str;
		}
		else if (isset($_POST[$field]))
		{
			$return = $str === $_POST[$field];
		}
		
		return $return;
		
	}
	
	// Add a validation rule wich allow spaces no alphanumeric function
	public function alpha_dash_space( $str ){
		
		$this->CI->form_validation->set_message( 'alpha_dash_space', lang( 'validation_rule_alpha_dash_spaces' ) );
		
		return ( ! preg_match( '/^[a-z0-9 ._\-]+$/i', $str ) ) ? FALSE : TRUE;
		
	}

	

}
// END Form Validation Class

/* End of file Form_validation.php */
/* Location: ./system/libraries/Form_validation.php */
