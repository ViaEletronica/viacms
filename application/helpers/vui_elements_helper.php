<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Via UI Elements Helpers
 *
 * @category	Helpers
 * @author		Frank Souza
 */

// ------------------------------------------------------------------------

// ------------------------------------------------------------------------

/**
 * Function vui_el_button
 *
 * Generates an HTML button ( should be styled by css ).
 * This function make a button sctructure allowing icons and others cool things
 *
 * @access	public
 * @param	array	The array params
 * @return	string
 */

function vui_el_button( $f_params = NULL ){
	
	// -------------------------------------------------
	// Parsing vars ------------------------------------
	
	// atribuindo valores às variávies
	$button_type =							isset( $f_params['button_type'] ) ? $f_params['button_type'] : 'anchor';
	$url =									isset( $f_params['url'] ) ? $f_params['url'] : '';
	$text =									isset( $f_params['text'] ) ? $f_params['text'] : '';
	$icon =									isset( $f_params['icon'] ) ? $f_params['icon'] : '';
	$only_icon =							isset( $f_params['only_icon'] ) ? $f_params['only_icon'] : FALSE;
	$title =								isset( $f_params['title'] ) ? $f_params['title'] : '';
	$class =								isset( $f_params['class'] ) ? $f_params['class'] : '';
	$id =									isset( $f_params['id'] ) ? $f_params['id'] : '';
	$check_current_url =					isset( $f_params['check_current_url'] ) ? $f_params['check_current_url'] : TRUE;
	$get_url =								isset( $f_params['get_url'] ) ? $f_params['get_url'] : TRUE;
	$type =									isset( $f_params['type'] ) ? $f_params['type'] : '';
	$value =								isset( $f_params['value'] ) ? $f_params['value'] : '';
	$name =									isset( $f_params['name'] ) ? $f_params['name'] : '';
	$target =								isset( $f_params['target'] ) ? $f_params['target'] : '';
	$form =									isset( $f_params['form'] ) ? $f_params['form'] : '';
	$attr =									isset( $f_params['attr'] ) ? $f_params['attr'] : '';
	$minify =								isset( $f_params[ 'minify' ] ) ? $f_params[ 'minify' ] : TRUE;
	
	// Parsing vars ------------------------------------
	// -------------------------------------------------
	
	$class .= ' btn ' . ( ( $icon AND $only_icon ) ? 'only-icon ' : '' );
	
	if ( $icon ){
		
		$class .= 'btn-' . $icon;
		$icon_class = 'icon icon-' . $icon;
		
	}
	
	if ( $url ){
		
		$class .= ( ( $check_current_url AND strpos( current_url(), $url ) !== FALSE ) ? ' active ' : '' );
		$url = 'href="' . ( $get_url ? get_url( $url ) : $url ) . '" ';
		
	}
	
	if ( $title OR ( $text AND ! $title AND $only_icon ) ){
		
		if ( $title ) {
			
			$title = element_title( $title ) . ' ';
			
		}
		else if ( $text AND ! $title AND $only_icon ) {
			
			$title = element_title( $text ) . ' ';
			
		}
		
	}
	
	if ( $value ){
		
		$value = 'value="' . trim( $value ) . '" ';
		
	}
	else if ( ! $value AND $button_type == 'button' ){
		
		$value = 'value="' . $button_type . '" ';
		
	}
	
	if ( $name ){
		
		$name = 'name="' . trim( $name ) . '" ';
		
	}
	
	if ( $target ){
		
		$target = 'target="' . trim( $target ) . '" ';
		
	}
	
	if ( $type ){
		
		$type = 'type="' . trim( $type ) . '" ';
		
	}
	
	if ( $id ){
		
		$id = 'id="' . trim( $id ) . '" ';
		
	}
	
	if ( $class ){
		
		$class = 'class="' . trim( $class ) . '" ';
		
	}
	
	if ( $form ){
		
		$form = 'form="' . trim( $form ) . '" ';
		
	}
	
	// generating output
	$out = array(
		
		'tag_open' => '',
		'tag_content' => '',
		'tag_close' => '',
		
	);
	
	$attr = trim( $name ) . ' ' . trim( $url ) . ' ' . trim( $id ) . ' ' . trim( $class ) . ' ' . trim( $title ) . ' ' . trim( $value ) . ' ' . trim( $type ) . ' ' . trim( $target ) . ' ' . trim( $form ) . ' ' . trim( $attr ) ;
	
	if ( $button_type == 'anchor' ){
		
		if ( $url ){
			
			$out[ 'tag_open' ] = '<a ' . $attr . '>';
			$out[ 'tag_close' ] = '</a>';
			
		}
		else {
			
			$out[ 'tag_open' ] = '<span ' . $attr . '>';
			$out[ 'tag_close' ] = '</span>';
			
		}
		
	}
	else if ( $button_type == 'button' ){
		
		$out[ 'tag_open' ] = '<button ' . $attr . '>';
		$out[ 'tag_close' ] = '</button>';
		
	}
	
	$out[ 'tag_content' ] = '<span class="content">';
	
	if ( $icon ){
		
		$out[ 'tag_content' ] .= '<span class="' . $icon_class . '"></span>';
		
	}
	$out[ 'tag_content' ] .= '<span class="text">';
	
	$out[ 'tag_content' ] .= $text;
	
	$out[ 'tag_content' ] .= '</span>';
	$out[ 'tag_content' ] .= '</span>';
	
	$out = @$out[ 'tag_open' ] . $out[ 'tag_content' ] . $out[ 'tag_close' ];
	
	return $minify ? minify_html( $out ) : $out;
	
}

// ------------------------------------------------------------------------

/**
 * Function vui_el_checkbox
 *
 * Generates an HTML checkbox wrapped with a label ( should be styled by css ).
 * This function make a checkbox sctructure allowing icons and others cool things
 *
 * @access	public
 * @param	array	The array params
 * @return	string
 */

function vui_el_checkbox( $f_params = NULL ){
	
	// -------------------------------------------------
	// Setting variables default values ----------------
	
	$checked = $f_params[ 'checked' ] =											isset( $f_params[ 'checked' ] ) ? $f_params[ 'checked' ] : FALSE;
	$url = $f_params[ 'url' ] =													isset( $f_params[ 'url' ] ) ? $f_params[ 'url' ] : '';
	$text = $f_params[ 'text' ] =												isset( $f_params[ 'text' ] ) ? $f_params[ 'text' ] : '';
	$icon = $f_params[ 'icon' ] =												isset( $f_params[ 'icon' ] ) ? $f_params[ 'icon' ] : '';
	$title = $f_params[ 'title' ] =												isset( $f_params[ 'title' ] ) ? $f_params[ 'title' ] : '';
	$wrapper_class = $f_params[ 'wrapper_class' ] =								isset( $f_params[ 'wrapper_class' ] ) ? $f_params[ 'wrapper_class' ] : '';
	$class = $f_params[ 'class' ] =												isset( $f_params[ 'class' ] ) ? $f_params[ 'class' ] : '';
	$id = $f_params[ 'id' ] =													isset( $f_params[ 'id' ] ) ? $f_params[ 'id' ] : '';
	$name = $f_params[ 'name' ] =												isset( $f_params[ 'name' ] ) ? $f_params[ 'name' ] : '';
	$form = $f_params[ 'form' ] =												isset( $f_params[ 'form' ] ) ? $f_params[ 'form' ] : '';
	$attr = $f_params[ 'attr' ] =												isset( $f_params[ 'attr' ] ) ? $f_params[ 'attr' ] : ''; // extra attributes for the search input element
	$minify = $f_params[ 'minify' ] =											isset( $f_params[ 'minify' ] ) ? $f_params[ 'minify' ] : TRUE; // if true, the html output will be minified
	$layout = $f_params[ 'layout' ] =											isset( $f_params[ 'layout' ] ) ? $f_params[ 'layout' ] : 'default';
	$value = $f_params[ 'value' ] =												isset( $f_params[ 'value' ] ) ? $f_params[ 'value' ] : NULL;
	
	// Setting variables default values ----------------
	// -------------------------------------------------
	
	$CI =& get_instance();
	
	// verificando se o tema atual possui a view
	if ( file_exists( THEMES_PATH . theme_helpers_views_path() . 'vui_el' . DS . $layout . DS . 'checkbox.php' ) ){
		
		$view = $CI->load->view( theme_helpers_views_path() . 'vui_el' . DS . $layout . DS . 'checkbox', $f_params, TRUE );
		
	}
	// verificando se a view existe no diretório de views padrão
	else if ( file_exists( VIEWS_PATH . $CI->mcm->environment . DS . HELPERS_DIR_NAME . DS . 'vui_el' . DS . $layout . DS . 'checkbox.php' ) ){
		
		$view = $CI->load->view( $CI->mcm->environment . DS . HELPERS_DIR_NAME . DS . 'vui_el' . DS . $layout . DS . 'checkbox', $f_params, TRUE);
		
	}
	
	return $minify ? minify_html( $view ) : $view;
	
}

// ------------------------------------------------------------------------

/**
 * Function vui_el_radiobox
 *
 * Generates an HTML radio wrapped with a label ( should be styled by css ).
 * This function make a radio sctructure allowing icons and others cool things
 *
 * @access	public
 * @param	array	The array params
 * @return	string
 */

function vui_el_radiobox( $f_params = NULL ){
	
	// -------------------------------------------------
	// Setting variables default values ----------------
	
	$checked = $f_params[ 'checked' ] =											isset( $f_params[ 'checked' ] ) ? $f_params[ 'checked' ] : FALSE;
	$url = $f_params[ 'url' ] =													isset( $f_params[ 'url' ] ) ? $f_params[ 'url' ] : '';
	$text = $f_params[ 'text' ] =												isset( $f_params[ 'text' ] ) ? $f_params[ 'text' ] : '';
	$icon = $f_params[ 'icon' ] =												isset( $f_params[ 'icon' ] ) ? $f_params[ 'icon' ] : '';
	$title = $f_params[ 'title' ] =												isset( $f_params[ 'title' ] ) ? $f_params[ 'title' ] : '';
	$wrapper_class = $f_params[ 'wrapper_class' ] =								isset( $f_params[ 'wrapper_class' ] ) ? $f_params[ 'wrapper_class' ] : '';
	$class = $f_params[ 'class' ] =												isset( $f_params[ 'class' ] ) ? $f_params[ 'class' ] : '';
	$id = $f_params[ 'id' ] =													isset( $f_params[ 'id' ] ) ? $f_params[ 'id' ] : '';
	$name = $f_params[ 'name' ] =												isset( $f_params[ 'name' ] ) ? $f_params[ 'name' ] : '';
	$form = $f_params[ 'form' ] =												isset( $f_params[ 'form' ] ) ? $f_params[ 'form' ] : '';
	$attr = $f_params[ 'attr' ] =												isset( $f_params[ 'attr' ] ) ? $f_params[ 'attr' ] : ''; // extra attributes for the search input element
	$minify = $f_params[ 'minify' ] =											isset( $f_params[ 'minify' ] ) ? $f_params[ 'minify' ] : TRUE; // if true, the html output will be minified
	$layout = $f_params[ 'layout' ] =											isset( $f_params[ 'layout' ] ) ? $f_params[ 'layout' ] : 'default';
	$value = $f_params[ 'value' ] =												isset( $f_params[ 'value' ] ) ? $f_params[ 'value' ] : NULL;
	
	// Setting variables default values ----------------
	// -------------------------------------------------
	
	$CI =& get_instance();
	
	// verificando se o tema atual possui a view
	if ( file_exists( THEMES_PATH . theme_helpers_views_path() . 'vui_el' . DS . $layout . DS . 'radiobox.php' ) ){
		
		$view = $CI->load->view( theme_helpers_views_path() . 'vui_el' . DS . $layout . DS . 'radiobox', $f_params, TRUE );
		
	}
	// verificando se a view existe no diretório de views padrão
	else if ( file_exists( VIEWS_PATH . $CI->mcm->environment . DS . HELPERS_DIR_NAME . DS . 'vui_el' . DS . $layout . DS . 'radiobox.php' ) ){
		
		$view = $CI->load->view( $CI->mcm->environment . DS . HELPERS_DIR_NAME . DS . 'vui_el' . DS . $layout . DS . 'radiobox', $f_params, TRUE);
		
	}
	
	return $minify ? minify_html( $view ) : $view;
	
}

// ------------------------------------------------------------------------

/**
 * Function vui_el_button
 *
 * Generates an HTML button ( should be styled by css ).
 * This function make a button sctructure allowing icons and others cool things
 *
 * @access	public
 * @param	array	The array params
 * @return	string
 */

function vui_el_search( $f_params = NULL ){
	
	// -------------------------------------------------
	// Setting variables default values ----------------
	
	$CI =& get_instance();
	
	$f_params[ 'url' ] =									( isset( $f_params[ 'url' ] ) AND is_string( $f_params[ 'url' ] ) ) ? $f_params[ 'url' ] : '';
	$f_params[ 'cancel_url' ] =								( isset( $f_params[ 'cancel_url' ] ) AND is_string( $f_params[ 'cancel_url' ] ) ) ? $f_params[ 'cancel_url' ] : NULL; // url wich the user will be redirected when cancel search
	$f_params[ 'live_search_url' ] =						( isset( $f_params[ 'live_search_url' ] ) AND is_string( $f_params[ 'live_search_url' ] ) ) ? $f_params[ 'live_search_url' ] : NULL; // if defined, load thw cool live search plugin
	$f_params[ 'text' ] =									isset( $f_params[ 'text' ] ) ? $f_params[ 'text' ] : lang( 'search' );
	$f_params[ 'icon' ] =									isset( $f_params[ 'icon' ] ) ? $f_params[ 'icon' ] : 'search';
	$f_params[ 'only_icon' ] =								isset( $f_params[ 'only_icon' ] ) ? $f_params[ 'only_icon' ] : NULL;
	$f_params[ 'title' ] =									isset( $f_params[ 'title' ] ) ? $f_params[ 'title' ] : '';
	$f_params[ 'wrapper_class' ] =							isset( $f_params[ 'wrapper_class' ] ) ? $f_params[ 'wrapper_class' ] : '';
	$f_params[ 'class' ] =									isset( $f_params[ 'class' ] ) ? ' ' . $f_params[ 'class' ] : '';
		$f_params[ 'class' ] =								isset( $f_params[ 'live_search_url' ] ) ? $f_params[ 'class' ] . ' live-search search-terms' : $f_params[ 'class' ];
	$f_params[ 'id' ] =										isset( $f_params[ 'id' ] ) ? $f_params[ 'id' ] : '';
	//$f_params[ 'check_current_url' ] =						isset( $f_params[ 'check_current_url' ] ) ? $f_params[ 'check_current_url' ] : TRUE;
	$f_params[ 'get_url' ] =								isset( $f_params[ 'get_url' ] ) ? $f_params[ 'get_url' ] : TRUE;
	$f_params[ 'name' ] =									isset( $f_params[ 'name' ] ) ? $f_params[ 'name' ] : 'search-terms';
	//$type = $f_params[ 'type' ] =							isset( $f_params[ 'type' ] ) ? $f_params[ 'type' ] : '';
	//$target = $f_params[ 'target' ] =						isset( $f_params[ 'target' ] ) ? $f_params[ 'target' ] : '';
	//$form = $f_params[ 'form' ] =							isset( $f_params[ 'form' ] ) ? $f_params[ 'form' ] : '';
	$f_params[ 'attr' ] =									isset( $f_params[ 'attr' ] ) ? $f_params[ 'attr' ] : ''; // extra attributes for the search input element
	$f_params[ 'minify' ] =									isset( $f_params[ 'minify' ] ) ? $f_params[ 'minify' ] : TRUE; // if true, the html output will be minified
	$f_params[ 'terms' ] =									( isset( $f_params[ 'terms' ] ) AND is_string( $f_params[ 'terms' ] ) ) ? $f_params[ 'terms' ] : NULL; // variable containing the search terms
		$f_params[ 'terms' ] =								( ! $f_params[ 'terms' ] AND $CI->input->post( 'terms' ) AND is_string( $CI->input->post( 'terms' ) ) ) ? $CI->input->post( 'terms' ) : $f_params[ 'terms' ];
		$f_params[ 'terms' ] =								( ! $f_params[ 'terms' ] AND $CI->input->get( 'q' ) AND is_string( $CI->input->get( 'q' ) ) ) ? $CI->input->get( 'q' ) : $f_params[ 'terms' ];
	$f_params[ 'layout' ] =									isset( $f_params[ 'layout' ] ) ? $f_params[ 'layout' ] : 'default';
	$f_params[ 'terms' ] =									isset( $f_params[ 'terms' ] ) ? $f_params[ 'terms' ] : '';
	
	// Setting variables default values ----------------
	// -------------------------------------------------
	
	// verificando se o tema atual possui a view
	if ( file_exists( THEMES_PATH . theme_helpers_views_path() . 'vui_el' . DS . $f_params[ 'layout' ] . DS . 'search_box.php' ) ){
		
		$view = $CI->load->view( theme_helpers_views_path() . 'vui_el' . DS . $f_params[ 'layout' ] . DS . 'search_box', $f_params, TRUE );
		
	}
	// verificando se a view existe no diretório de views padrão
	else if ( file_exists( VIEWS_PATH . $CI->mcm->environment . DS . HELPERS_DIR_NAME . DS . 'vui_el' . DS . $f_params[ 'layout' ] . DS . 'search_box.php' ) ){
		
		$view = $CI->load->view( $CI->mcm->environment . DS . HELPERS_DIR_NAME . DS . 'vui_el' . DS . $f_params[ 'layout' ] . DS . 'search_box', $f_params, TRUE);
		
	}
	
	return $f_params[ 'minify' ] ? minify_html( $view ) : $view;
	
}

// ------------------------------------------------------------------------

/**
 * Function vui_el_address_box
 *
 * Present a pre formated address set
 *
 * @access	public
 * @param	array	The array params
 * @return	string
 */

function vui_el_address_box( $f_params = NULL ){
	
	// -------------------------------------------------
	// Setting variables default values ----------------
	
	$text = $f_params[ 'text' ] =												isset( $f_params[ 'text' ] ) ? $f_params[ 'text' ] : '';
	$icon = $f_params[ 'icon' ] =												isset( $f_params[ 'icon' ] ) ? $f_params[ 'icon' ] : '';
	$title = $f_params[ 'title' ] =												isset( $f_params[ 'title' ] ) ? $f_params[ 'title' ] : '';
	$wrapper_class = $f_params[ 'wrapper_class' ] =								isset( $f_params[ 'wrapper_class' ] ) ? $f_params[ 'wrapper_class' ] : '';
	$class = $f_params[ 'class' ] =												isset( $f_params[ 'class' ] ) ? $f_params[ 'class' ] : '';
	$id = $f_params[ 'id' ] =													isset( $f_params[ 'id' ] ) ? $f_params[ 'id' ] : '';
	$name = $f_params[ 'name' ] =												isset( $f_params[ 'name' ] ) ? $f_params[ 'name' ] : '';
	$form = $f_params[ 'form' ] =												isset( $f_params[ 'form' ] ) ? $f_params[ 'form' ] : '';
	$attr = $f_params[ 'attr' ] =												isset( $f_params[ 'attr' ] ) ? $f_params[ 'attr' ] : ''; // extra attributes for the search input element
	$minify = $f_params[ 'minify' ] =											isset( $f_params[ 'minify' ] ) ? $f_params[ 'minify' ] : TRUE; // if true, the html output will be minified
	$layout = $f_params[ 'layout' ] =											isset( $f_params[ 'layout' ] ) ? $f_params[ 'layout' ] : 'default';
	$address = $f_params[ 'address' ] =											isset( $f_params[ 'address' ] ) ? $f_params[ 'address' ] : NULL;
	
	// Setting variables default values ----------------
	// -------------------------------------------------
	
	$CI =& get_instance();
	
	// verificando se o tema atual possui a view
	if ( file_exists( THEMES_PATH . theme_helpers_views_path() . 'vui_el' . DS . $layout . DS . 'address_box.php' ) ){
		
		$view = $CI->load->view( theme_helpers_views_path() . 'vui_el' . DS . $layout . DS . 'address_box', $f_params, TRUE );
		
	}
	// verificando se a view existe no diretório de views padrão
	else if ( file_exists( VIEWS_PATH . $CI->mcm->environment . DS . HELPERS_DIR_NAME . DS . 'vui_el' . DS . $layout . DS . 'address_box.php' ) ){
		
		$view = $CI->load->view( $CI->mcm->environment . DS . HELPERS_DIR_NAME . DS . 'vui_el' . DS . $layout . DS . 'address_box', $f_params, TRUE);
		
	}
	
	return $minify ? minify_html( $view ) : $view;
	
}

// ------------------------------------------------------------------------

/**
 * Function vui_el_thumb
 *
 * Present a pre formated thumb
 *
 * @access	public
 * @param	array	The array params
 * @return	string
 */

function vui_el_thumb( $f_params = NULL ){
	
	// -------------------------------------------------
	// Setting variables default values ----------------
	
	$text = $f_params[ 'text' ] =												isset( $f_params[ 'text' ] ) ? $f_params[ 'text' ] : '';
	$title = $f_params[ 'title' ] =												isset( $f_params[ 'title' ] ) ? $f_params[ 'title' ] : '';
	$wrapper_class = $f_params[ 'wrapper_class' ] =								isset( $f_params[ 'wrapper_class' ] ) ? $f_params[ 'wrapper_class' ] : '';
	$wrappers_el_type = $f_params[ 'wrappers_el_type' ] =						isset( $f_params[ 'wrappers_el_type' ] ) ? $f_params[ 'wrappers_el_type' ] : 'div'; // wrappers element type
	$class = $f_params[ 'class' ] =												isset( $f_params[ 'class' ] ) ? $f_params[ 'class' ] : '';
	$id = $f_params[ 'id' ] =													isset( $f_params[ 'id' ] ) ? $f_params[ 'id' ] : '';
	$src = $f_params[ 'src' ] =													isset( $f_params[ 'src' ] ) ? $f_params[ 'src' ] : '';
	$href = $f_params[ 'href' ] =												isset( $f_params[ 'href' ] ) ? $f_params[ 'href' ] : '';
	$rel = $f_params[ 'rel' ] =													isset( $f_params[ 'rel' ] ) ? $f_params[ 'rel' ] : FALSE;
	$target = $f_params[ 'target' ] =											isset( $f_params[ 'target' ] ) ? $f_params[ 'target' ] : '';
	$attr = $f_params[ 'attr' ] =												isset( $f_params[ 'attr' ] ) ? $f_params[ 'attr' ] : ''; // extra attributes for the image element
	$minify = $f_params[ 'minify' ] =											isset( $f_params[ 'minify' ] ) ? $f_params[ 'minify' ] : TRUE; // if true, the html output will be minified
	$layout = $f_params[ 'layout' ] =											isset( $f_params[ 'layout' ] ) ? $f_params[ 'layout' ] : 'default';
	$figure = $f_params[ 'figure' ] =											isset( $f_params[ 'figure' ] ) ? $f_params[ 'figure' ] : FALSE; // if true, output a figure tag
	$modal = $f_params[ 'modal' ] =												( isset( $f_params[ 'modal' ] ) OR ( check_var( $href ) AND check_var( $src ) AND $href == $src ) ) ? TRUE : FALSE;
	
	// Setting variables default values ----------------
	// -------------------------------------------------
	
	$CI =& get_instance();
	
	// verificando se o tema atual possui a view
	if ( file_exists( THEMES_PATH . theme_helpers_views_path( 'admin' ) . 'vui_el' . DS . $layout . DS . 'thumb.php' ) ){
		
		$view = $CI->load->view( theme_helpers_views_path( 'admin' ) . 'vui_el' . DS . $layout . DS . 'thumb', $f_params, TRUE );
		
	}
	// verificando se o tema atual possui a view
	else if ( file_exists( THEMES_PATH . theme_helpers_views_path( 'site' ) . 'vui_el' . DS . $layout . DS . 'thumb.php' ) ){
		
		$view = $CI->load->view( theme_helpers_views_path( 'site' ) . 'vui_el' . DS . $layout . DS . 'thumb', $f_params, TRUE );
		
	}
	// verificando se a view existe no diretório de views padrão
	else if ( file_exists( VIEWS_PATH . 'admin' . DS . HELPERS_DIR_NAME . DS . 'vui_el' . DS . $layout . DS . 'thumb.php' ) ){
		
		$view = $CI->load->view( 'admin' . DS . HELPERS_DIR_NAME . DS . 'vui_el' . DS . $layout . DS . 'thumb', $f_params, TRUE);
		
	}
	// verificando se a view existe no diretório de views padrão
	else if ( file_exists( VIEWS_PATH . 'site' . DS . HELPERS_DIR_NAME . DS . 'vui_el' . DS . $layout . DS . 'thumb.php' ) ){
		
		$view = $CI->load->view( 'site' . DS . HELPERS_DIR_NAME . DS . 'vui_el' . DS . $layout . DS . 'thumb', $f_params, TRUE);
		
	}
	
	return $minify ? minify_html( $view ) : $view;
	
}

// ------------------------------------------------------------------------


/* End of file vui_elements_helper.php */
/* Location: ./system/helpers/vui_elements_helper.php */