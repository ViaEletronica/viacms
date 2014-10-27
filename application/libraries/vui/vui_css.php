<?php

use \Exception;

class Vui_css extends Vui{
	
	var $minify = TRUE;
	
	function __construct(){
		
		if ( ! defined ( 'DS' ) ) define( 'DS', DIRECTORY_SEPARATOR );
		
	}
	
	function gradient( $start_color = '#000', $end_color = '#fff', $direction = 'btt', $prefix = '', $suffix = '' ) {
		
		if ( $direction === 'ttb' OR $direction === 'ltr' ){
			
			$old_start_color = $start_color;
			$start_color = $end_color;
			$end_color = $old_start_color;
			
		}
		
		$css = '';
		
		if ( $direction === 'btt' OR $direction === 'ttb' ){
			
			$css .= "background-image: {$prefix}-moz-linear-gradient(top, " . $start_color . " 0%, " . $end_color . " 100%){$suffix};\n";
			$css .= "background-image: {$prefix}-webkit-gradient(linear, left top, left bottom, color-stop(0%," . $start_color . "), color-stop(100%," . $end_color . ")){$suffix};\n";
			$css .= "background-image: {$prefix}-webkit-linear-gradient(top, " . $start_color . " 0%," . $end_color . " 100%){$suffix};\n";
			$css .= "background-image: {$prefix}-o-linear-gradient(top, " . $start_color . " 0%," . $end_color . " 100%); /* Opera 11.10+ */{$suffix};\n";
			$css .= "background-image: {$prefix}-ms-linear-gradient(top, " . $start_color . " 0%," . $end_color . " 100%){$suffix};\n";
			$css .= "background-image: {$prefix}linear-gradient(to bottom, " . $start_color . " 0%," . $end_color . " 100%){$suffix};\n";
			$css .= "filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='" . $start_color . "', endColorstr='" . $end_color . "',GradientType=0 );\n";

			
		}
		else if ( $direction === 'ltr' OR $direction === 'rtl' ){
			
			$css .= "background-image: {$prefix}-moz-linear-gradient(left, " . $start_color . " 0%, " . $end_color . " 100%); /* FF3.6+ */{$suffix}\n";
			$css .= "background-image: {$prefix}-webkit-gradient(linear, left top, right top, color-stop(0%," . $start_color . "), color-stop(100%," . $end_color . ")); /* Chrome,Safari4+ */{$suffix}\n";
			$css .= "background-image: {$prefix}-webkit-linear-gradient(left, " . $start_color . " 0%," . $end_color . " 100%); /* Chrome10+,Safari5.1+ */{$suffix}\n";
			$css .= "background-image: {$prefix}-o-linear-gradient(left, " . $start_color . " 0%," . $end_color . " 100%); /* Opera 11.10+ */{$suffix}\n";
			$css .= "background-image: {$prefix}-ms-linear-gradient(left, " . $start_color . " 0%," . $end_color . " 100%); /* IE10+ */{$suffix}\n";
			$css .= "background-image: {$prefix}linear-gradient(to right, " . $start_color . " 0%," . $end_color . " 100%); /* W3C */{$suffix}\n";
			$css .= "filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='" . $start_color . "', endColorstr='" . $end_color . "',GradientType=1 ); /* IE6-9 */\n";
			
		}
		
		// Return our CSS
		return $this->_minify( $css );
		
	}
	function transition( $value = 'all 0.2s ease-in-out' ) {
		
		$css = '';
		
		$css .= "-webkit-transition: $value;";
		$css .= "-moz-transition: $value;";
		$css .= "-o-transition: $value;";
		$css .= "-ms-transition: $value;";
		$css .= "transition: $value;";
		
		// Return our CSS
		return $this->_minify( $css );
		
	}
	function transform( $value = NULL ) {
		
		if ( $value ){
			
			$css = '';
			
			$css .= "-webkit-transform: $value;";
			$css .= "-moz-transform: $value;";
			$css .= "-o-transform: $value;";
			$css .= "-ms-transform: $value;";
			$css .= "transform: $value;";
			
			// Return our CSS
			return $this->_minify( $css );
			
			
		}
		
		return FALSE;
		
	}
	function animation( $value = NULL ) {
		
		if ( $value ){
			
			$css = '';
			
			$css .= "-webkit-animation: $value;";
			$css .= "-moz-animation: $value;";
			$css .= "-o-animation: $value;";
			$css .= "-ms-animation: $value;";
			$css .= "animation: $value;";
			
			// Return our CSS
			return $this->_minify( $css );
			
			
		}
		
		return FALSE;
		
	}
	function animation_delay( $value = NULL ) {
		
		if ( $value ){
			
			$css = '';
			
			$css .= "-webkit-animation-delay: $value;";
			$css .= "-moz-animation-delay: $value;";
			$css .= "-o-animation-delay: $value;";
			$css .= "-ms-animation-delay: $value;";
			$css .= "animation-delay: $value;";
			
			// Return our CSS
			return $this->_minify( $css );
			
			
		}
		
		return FALSE;
		
	}
	function animation_timing_function( $value = NULL ) {
		
		if ( $value ){
			
			$css = '';
			
			$css .= "-webkit-animation-timing-function: $value;";
			$css .= "-moz-animation-timing-function: $value;";
			$css .= "-o-animation-timing-function: $value;";
			$css .= "-ms-animation-timing-function: $value;";
			$css .= "animation-timing-function: $value;";
			
			// Return our CSS
			return $this->_minify( $css );
			
			
		}
		
		return FALSE;
		
	}
	function keyframes( $name = NULL, $value = NULL ){
		
		if ( $name AND $value ){
			
			$css = '';
			
			$css .= "@-webkit-keyframes $name { $value }";
			$css .= "@-moz-keyframes $name { $value }";
			$css .= "@-o-keyframes $name { $value }";
			$css .= "@-ms-keyframes $name { $value }";
			$css .= "@keyframes $name { $value }";
			
			// Return our CSS
			return $this->_minify( $css );
			
			
		}
		
		return FALSE;
		
	}
	function display_inline_block(){
		
		$css = '';
		
		$css .= "display: -moz-inline-stack;";
		$css .= "display: inline-block;";
		$css .= "zoom: 1;";
		$css .= "*display: inline;";
		
		// Return our CSS
		return $this->_minify( $css );
		
	}
	function box_sizing( $value = 'border-box' ){
		
		$css = '';
		
		$css .= "-webkit-box-sizing: $value;";
		$css .= "-moz-box-sizing: $value;";
		$css .= "-o-box-sizing: $value;";
		$css .= "-ms-box-sizing: $value;";
		$css .= "box-sizing: $value;";
		
		// Return our CSS
		return $this->_minify( $css );
		
	}
	function box_shadow( $value = 'initial' ){
		
		$css = '';
		
		$css .= "-webkit-box-shadow: $value;";
		$css .= "-moz-box-shadow: $value;";
		$css .= "-o-box-shadow: $value;";
		$css .= "-ms-box-shadow: $value;";
		$css .= "box-shadow: $value;";
		
		// Return our CSS
		return $this->_minify( $css );
		
	}
	function border_radius( $value = '0' ){
		
		$css = '';
		
		$css .= "-webkit-border-radius: $value;";
		$css .= "-moz-border-radius: $value;";
		$css .= "-o-border-radius: $value;";
		$css .= "-ms-border-radius: $value;";
		$css .= "border-radius: $value;";
		
		// Return our CSS
		return $this->_minify( $css );
		
	}
	function appearance( $value = 'initial' ){
		
		$css = '';
		
		$css .= "-webkit-appearance: $value;";
		$css .= "-moz-appearance: $value;";
		$css .= "-o-appearance: $value;";
		$css .= "-ms-appearance: $value;";
		$css .= "appearance: $value;";
		
		// Return our CSS
		return $this->_minify( $css );
		
	}
	function selection( $value = '' ){
		
		$css = "::-moz-selection { $value }";
		$css = "::selection { $value }";
		
		// Return our CSS
		return $this->_minify( $css );
		
	}
	function filter( $value ){
		
		if ( is_array( $value ) ){
			
			$css_value = '';
			$svg = '<svg height="0" xmlns="http://www.w3.org/2000/svg">';
			$svg .= '<filter id="filter">';
			
			if ( isset( $value[ 'blur' ] ) ){
				
				$svg .= '<feGaussianBlur in="SourceGraphic" stdDeviation="' . $value[ 'blur' ] . '"/>';
				
				$css_value .= ' blur(' . $value[ 'blur' ] . 'px)';
				
			}
			if ( isset( $value[ 'brightness' ] ) ){
				
				$svg .= '<feComponentTransfer>';
				$svg .= '<feFuncR type="linear" slope="' . $value[ 'brightness' ] . '"/>';
				$svg .= '<feFuncG type="linear" slope="' . $value[ 'brightness' ] . '"/>';
				$svg .= '<feFuncB type="linear" slope="' . $value[ 'brightness' ] . '"/>';
				$svg .= '</feComponentTransfer>';
				
				$css_value .= ' brightness(' . $value[ 'brightness' ] . ')';
				
			}
			if ( isset( $value[ 'contrast' ] ) ){
				
				$svg .= '<feComponentTransfer>';
				$svg .= '<feFuncR type="linear" slope="' . $value[ 'contrast' ] . '" intercept="-(0.5 * ' . $value[ 'contrast' ] . ') + 0.5"/>';
				$svg .= '<feFuncG type="linear" slope="' . $value[ 'contrast' ] . '" intercept="-(0.5 * ' . $value[ 'contrast' ] . ') + 0.5"/>';
				$svg .= '<feFuncB type="linear" slope="' . $value[ 'contrast' ] . '" intercept="-(0.5 * ' . $value[ 'contrast' ] . ') + 0.5"/>';
				$svg .= '</feComponentTransfer>';
				
				$css_value .= ' contrast(' . $value[ 'contrast' ] . ')';
				
			}
			if ( isset( $value[ 'opacity' ] ) ){
				
				$svg .= '<feComponentTransfer>';
				$svg .= '<feFuncA type="table" tableValues="0 ' . $value[ 'contrast' ] . '"></feFuncA>';
				$svg .= '</feComponentTransfer>';
				
				$css_value .= ' opacity(' . $value[ 'opacity' ] . ')';
				
			}
			if ( isset( $value[ 'saturate' ] ) ){
				
				$svg .= '<feColorMatrix type="saturate" values="' . $value[ 'saturate' ] . '"></feColorMatrix>';
				
				$css_value .= ' saturate(' . $value[ 'saturate' ] . ')';
				
			}
			if ( isset( $value[ 'hue-rotate' ] ) ){
				
				$svg .= '<feColorMatrix type="hueRotate" values="' . $value[ 'hue-rotate' ] . '"></feColorMatrix>';
				
				$css_value .= ' hue-rotate(' . $value[ 'hue-rotate' ] . 'deg)';
				
			}
			
			$svg .= '</filter>';
			$svg .= '</svg>';
			
			$css = '';
			$css .= 'data:image/svg+xml;base64,' . base64_encode( $svg );
			
			$css = "filter: url($css#filter);";
			
			$css .= "-webkit-filter: $css_value;";
			$css .= "-moz-filter: $css_value;";
			$css .= "-o-filter: $css_value;";
			$css .= "-ms-filter: $css_value;";
			$css .= "filter: $css_value;";
			
			// Return our CSS
			return $this->_minify( $css );
			
		}
		else {
			
			return FALSE;
			
		}
	}
	
	private function _minify( $buffer ){
		
		if ( $buffer AND $this->minify ){
			
			// Remove comments
			$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
			 
			// Remove space after colons
			$buffer = str_replace(': ', ':', $buffer);
			 
			// Remove whitespace
			$buffer = str_replace(array("\r\n", "\r", "\n", "\t"), '', $buffer);
			 
			// Collapse adjacent spaces into a single space
			$buffer = ereg_replace(" {2,}", ' ',$buffer);
			
			// Remove spaces that might still be left where we know they aren't needed
			$buffer = str_replace(array('} '), '}', $buffer);
			$buffer = str_replace(array('{ '), '{', $buffer);
			$buffer = str_replace(array('; '), ';', $buffer);
			$buffer = str_replace(array(', '), ',', $buffer);
			$buffer = str_replace(array(' }'), '}', $buffer);
			$buffer = str_replace(array(' {'), '{', $buffer);
			$buffer = str_replace(array(' ;'), ';', $buffer);
			$buffer = str_replace(array(' ,'), ',', $buffer);
			
			return $buffer;
			
		}
		
	}
	
}

?>
