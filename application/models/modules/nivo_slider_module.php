<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Nivo_slider_module extends CI_Model{
	
	public function run( $module_data = NULL ){
		
		if ( $this->plugins->load( 'jquery' ) ){
			
			if ( ! defined( 'NIVO_SLIDER' ) ) define( 'NIVO_SLIDER', TRUE );
			
			/* 
			 * -------------------------------------------------------------------------------------------------
			 * Declarando as folhas de estilos
			 */
			
			$this->voutput->append_head_stylesheet( 'nivo_slider', STYLES_DIR_URL . '/modules/nivo-slider/nivo-slider.css' );
			$this->voutput->append_head_stylesheet( 'nivo_slider_' . $module_data[ 'params' ][ 'theme' ], STYLES_DIR_URL . '/modules/nivo-slider/themes/' . $module_data[ 'params' ][ 'theme' ] . '/' . $module_data[ 'params' ][ 'theme' ] . '.css' );
			
			/* 
			 * -------------------------------------------------------------------------------------------------
			 */
			
			
			
			/* 
			 * -------------------------------------------------------------------------------------------------
			 * Declarando o javascript
			 */
			
			$this->voutput->append_head_script( 'nivo_slider', JS_DIR_URL . '/modules/nivo-slider/jquery.nivo.slider.pack.js' );
			$this->voutput->append_head_script_declaration( 'nivo_slider', $this->load->view( $this->mcm->environment . '/modules/nivo-slider/default/default', $module_data, TRUE ), NULL, NULL );
			
			/* 
			 * -------------------------------------------------------------------------------------------------
			 */
			
			$imagesDir = FCPATH . $module_data[ 'params' ][ 'images_dir' ] . DS;
			$images = glob( $imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE );
			
			$images_list = '';
			
			foreach ( $images as $key => &$image ) {
				
				$image = explode( DS, $image );
				end( $image );
				$image = $image[ key( $image ) ];
				
				if ( isset( $module_data[ 'params' ][ 'avoid_prefix' ] ) AND $module_data[ 'params' ][ 'avoid_prefix' ] ){
					
					if ( strpos( $image, $module_data[ 'params' ][ 'avoid_prefix' ] ) === FALSE OR strpos( $image, $module_data[ 'params' ][ 'avoid_prefix' ] ) !== 0 ) {
						
						$images_list .= '<img src="' . BASE_URL . '/' . $module_data[ 'params' ][ 'images_dir' ] . '/' . $image . '" />' . "\n";
						
					}
					
				}
				else $images_list .= '<img src="' . BASE_URL . '/' . $module_data[ 'params' ][ 'images_dir' ] . '/' . $image . '" />' . "\n";
			}
			
			
			$html = '
			
			<div class="slider-wrapper theme-' . $module_data[ 'params' ][ 'theme' ] . '">
			    <div class="ribbon"></div>
			    <div id="slider" class="nivoSlider">
				    ' . $images_list . '
			    </div>
				<div id="htmlcaption" class="nivo-html-caption">
				    <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>.
				</div>
			</div>
			
			
			';
			
			
			
			return $html;
			
		}
		
		return FALSE;
		
	}
	
	public function get_module_params(){
		
		$this->lang->load( 'admin/modules/nivo_slider' );
		
		$params = get_params_spec_from_xml( MODULES_PATH . 'nivo_slider/params.xml' );
		
		// carregando os layouts do tema atual
		$directories_options = array( MEDIA_DIR_NAME => MEDIA_DIR_NAME );
		$directories_options = $directories_options + scandir_to_array( MEDIA_DIR_NAME );
		
		// carregando os layouts do tema atual
		$themes_options = dir_list_to_array( STYLES_PATH . MODULES_DIR_NAME . DS . 'nivo-slider' . DS . 'themes' );
		
		foreach ( $params[ 'params_spec' ][ 'nivo_slider_module_config' ] as $key => $element ) {
			
			if ( $element[ 'name' ] == 'theme' ){
				
				$spec_options = array();
				
				if ( isset( $params[ 'params_spec' ][ 'nivo_slider_module_config' ][ $key ][ 'options' ] ) )
					$spec_options = $params[ 'params_spec' ][ 'nivo_slider_module_config' ][ $key ][ 'options' ];
				
				$params[ 'params_spec' ][ 'nivo_slider_module_config' ][ $key ][ 'options' ] = is_array( $spec_options ) ? $spec_options + $themes_options : $themes_options;
				
			}
			
			if ( $element[ 'name' ] == 'images_dir' ){
				
				$spec_options = array();
				
				if ( isset( $params[ 'params_spec' ][ 'nivo_slider_module_config' ][ $key ][ 'options' ] ) )
					$spec_options = $params[ 'params_spec' ][ 'nivo_slider_module_config' ][ $key ][ 'options' ];
				
				$params[ 'params_spec' ][ 'nivo_slider_module_config' ][ $key ][ 'options' ] = is_array( $spec_options ) ? $spec_options + $directories_options : $directories_options;
				
			}
			
		}
		
		return $params;
	}
	
}
