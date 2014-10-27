<?php  if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );


// ------------------------------------------------------------------------

/**
 * Number Input Field
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */

function form_input_number( $data = '', $value = '', $extra = '' ){
	
	$defaults = array('type' => 'number', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value );
	
	return "<input " . _parse_form_attributes( $data, $defaults ) . $extra . " />";
	
}

// ------------------------------------------------------------------------

function form_hidden( $name, $value = '', $recursing = FALSE, $extra = '' ){
	
	static $form;
	
	if ( $recursing === FALSE)
	{
		$form = "\n";
	}

	if (is_array($name))
	{
		foreach ($name as $key => $val)
		{
			form_hidden($key, $val, TRUE);
		}
		return $form;
	}

	if ( ! is_array($value))
	{
		$form .= '<input type="hidden" name="'.$name.'" value="'.form_prep($value, $name) . '" ' . $extra . ' />'."\n";
	}
	else
	{
		foreach ($value as $k => $v)
		{
			$k = (is_int($k)) ? '' : $k;
			form_hidden($name.'['.$k.']', $v, TRUE);
		}
	}

	return $form;
}

// ------------------------------------------------------------------------

function form_checkbox( $data = '', $value = '', $checked = FALSE, $extra = '' ){
	
	$defaults = array( 'type' => 'checkbox', 'name' => ( ( ! is_array( $data ) ) ? $data : '' ), 'value' => $value );
	
	if ( is_array( $data ) AND array_key_exists( 'checked', $data ) ){
		
		$checked = $data[ 'checked' ];
		
		if ( $checked == FALSE ){
			
			unset( $data[ 'checked' ] );
			
		}
		else {
			
			$data[ 'checked' ] = 'checked';
			
		}
	}
	
	if ( $checked == TRUE ){
		
		$defaults[ 'checked' ] = 'checked';
		
	}
	else{
		
		unset( $defaults[ 'checked' ] );
		
	}
	
	return "<input " . _parse_form_attributes( $data, $defaults ) . $extra . " />";
}

/* End of file VECMS_url_helper.php */
/* Location: ./application/helpers/VECMS_url_helper.php */