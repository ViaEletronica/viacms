<?php	if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );


/**
 * 
 *
 * Convert multidimensional array into single array
 * 
 * @author			AlienWebguy http://stackoverflow.com/questions/6785355/convert-multidimensional-array-into-single-array
 * 
 */
function array_flatten( $array ){
	
	if ( !is_array( $array ) ){
		
		return FALSE;
		
	}
	
	$result = array();
	
	//echo 'analisando o array' . "\n";
	foreach ( $array as $key => $value ){
		
		//echo 'analisando ' . $key . ' => ' . $value . "\n";
		
		if ( is_array( $value ) ){
			
			$result = array_merge( $result, array_flatten( $value ) );
			
		}
		else{
			
			$result[ $key ] = $value;
			
		}
		
	}
	
	return $result;
	
}



/**
 * 
 * Function array_search_recursive ( mixed needle, array haystack [ , bool strict[ , array path ] ] )
 * 
 * Searches haystack for needle and returns an array of the key path if it is found in the ( multidimensional ) array, FALSE otherwise.
 *
 * @param needle mixed
 * 
 * The searched value. 
 * If needle is a string, the comparison is done in a case-sensitive manner.
 * 
 * @param haystack array
 * 
 * The array.
 * 
 * @param strict bool[optional] 
 * 
 * If the third parameter strict is set to true then the array_search function will search for identical elements in the
 * haystack. This means it will also check the types of the needle in the haystack, and objects must be the same 
 * instance. 
 * 
 * If needle is found in haystack more than once, the first matching key is returned. To return the keys for all 
 * matching values, use array_keys with the optional search_value parameter instead.
 * 
 * @return mixed the key for needle if it is found in the array, false otherwise. 
 * 
 */

function array_search_recursive( $needle, $haystack, $strict = FALSE, $path = array() ){
	
	if( ! is_array( $haystack ) ) {
		return FALSE;
	}
 
	foreach( $haystack as $key => $val ) {
		
		if( is_array( $val ) AND $sub_path = array_search_recursive( $needle, $val, $strict, $path ) ) {
			
			$path = array_merge( $path, array( $key ), $sub_path );
			
			return $path;
			
		}
		else if( ( ! $strict AND $val == $needle ) || ( $strict AND $val === $needle ) ) {
			
			$path[] = $key;
			
			return $path;
			
		}
	}
	
	return FALSE;
	
}


/* End of file VECMS_array_helper.php */
/* Location: ./application/helpers/VECMS_array_helper.php */