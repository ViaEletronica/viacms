<?php  if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );


function get_params( $attributes = NULL ){
	
	if ( ! is_json( $attributes ) AND ! is_array( $attributes ) ){
		
		$attributes = explode( "\n", $attributes );
		$array = array();
		$array2 = array();
		foreach ( $attributes as $value ) {
			$array2 = explode( "=", $value );
			$array2[1] = trim( isset( $array2[1] )?( string )$array2[1]:'' );
			if ( $array2[1] != '' ) {
				$array[$array2[0]] = trim( $array2[1] );
			}
		}
		
		return array_merge( array(), $array );
		
	}
	else if ( is_json( $attributes ) ){
		return array_merge( array(), json_decode( $attributes, TRUE ) );
	}
	else if ( is_array( $attributes ) ){
		return $attributes;
	}
	else{
		return array();
	}
	
}
function get_json_params( $attributes = NULL ){
	if ( $attributes ){
		$array = json_decode( $attributes, TRUE );
		return $array;
	}
}


// $weak_params são os parâmetros que serão usados caso algum parâmetro em $params seja global
function filter_params( $weak_params = NULL, $params = NULL, $keep_blank = FALSE ){
	
	if ( ! $weak_params ) return ( $params ? $params : array() );
	
	if ( $weak_params AND ! is_array( $weak_params ) ) $weak_params = array();
	if ( $params AND ! is_array( $params ) ) $params = array();
	
	if ( $weak_params ){
		
		foreach ( $weak_params as $key => $weak_param ) {
			
			if ( is_array( $weak_params ) AND is_array( $params ) ) {
				
				if ( ! array_key_exists( $key, $params ) OR ( $params[ $key ] == 'global' AND array_key_exists( $key, $weak_params ) ) OR ( $params[ $key ] == '' AND ! $keep_blank ) ) {
					
					$params[ $key ] = $weak_params[$key];
					
				}
			}
		}
		
		return $params;
		
	}
}


// Obtém um array de especificações de elementos a partir de um XML
function get_params_spec_from_xml( $xml_file = NULL ){
	
	if ( $xml_file ){
		$params = array();
		
		$xml = simplexml_load_file( $xml_file );
		
		if ( $xml->getName() == 'params' ){
			$params['params_spec'] = $params['params_spec_values'] = array();
		}
		
		foreach( $xml->children() as $children ){
			
			//echo 'nome da sessao: '.( string )$children['name'].'<br/>';
			
			$children_name = ( string )$children['name'];
			$children_icon = ( string )$children['icon'];
			$params['params_spec'][$children_name] = array();
			$i = 0;
			foreach( $children->children() as $param_1 ){
				
				//echo 'elemento sendo analisado: '.( string )$param_1['name'].'<br/>';
				
				// obtendo os atributos para facilitar a leitura do desenvolvedor e reduzir a codificação
				$type = ( string )$param_1['type'];
				$name = ( string )$param_1['name'];
				$value = ( string )$param_1['value'];
				$default = ( string )$param_1['default'];
				$label = ( string )$param_1['label'];
				$tip = ( string )$param_1['tip'];
				$ext_tip = ( string )$param_1['ext_tip'];
				$class = ( string )$param_1['class'];
				$editor = ( string )$param_1['editor'];
				
				$disabled = ( string )$param_1['disabled'];
				$readonly = ( string )$param_1['readonly'];
				$maxlength = ( string )$param_1['maxlength'];
				$size = ( string )$param_1['size'];
				
				$min = isset( $param_1['min'] ) ? ( int )$param_1['min'] : FALSE;
				$max = isset( $param_1['max'] ) ? ( int )$param_1['max'] : FALSE;
				$pattern = ( string )$param_1['pattern'];
				$step = isset( $param_1['step'] ) ? ( int )$param_1['step'] : FALSE;
				
				//echo $default;
				$params['params_spec'][$children_name][$i] = array(
					
					'type' => $type,
					'name' => $name,
					'value' => $value,
					//'default' => $default,
					'label' => $label,
					'tip' => $tip,
					'class' => $class,
					'editor' => $editor,
					
					'disabled' => $disabled,
					'readonly' => $readonly,
					'maxlength' => $maxlength,
					'size' => $size,
					
					'min' => $min,
					'max' => $max,
					'pattern' => $pattern,
					'step' => $step,
					
				);
				
				
				
				if ( $type == 'select' ){
					
					foreach( $param_1->children() as $param_2 ){
						
						if ( $param_2->getName() == 'option' ){
							
							$param_2_name = 'options';
							
							$params['params_spec'][$children_name][$i][$param_2_name][( string )$param_2['value']] = ( string )$param_2;
						}
						else if ( $param_2->getName() == 'validation' ){
							
							$param_2_name = 'validation';
							
							$params['params_spec'][$children_name][$i][$param_2_name]['rules'] = ( string )$param_2['rules'];
							foreach( $param_2->children() as $message ){
								
								if ( $message->getName() == 'message' ){
									
									$params['params_spec'][$children_name][$i][$param_2_name]['messages'] = array( 
										'rule' => ( string )$message['rule'],
										'message' => ( string )$message,
									 );
								}
								
							}
						}
						
					}
					
				}
				else if ( $type == 'html' ){
					
					$default = ( string )$param_1;
					$params['params_spec'][$children_name][$i][ 'value' ] = $default;
					
				}
				else if ( $type == 'php' ){
					
					if ( ! isset( $CI ) ){
						
						$CI =& get_instance();
						
					}
					
					eval( ( string )$param_1 );
					
				}
				else{
					
					foreach( $param_1->children() as $param_2 ){
						
						if ( $param_2->getName() == 'validation' ){
							
							$param_2_name = 'validation';
							
							$params['params_spec'][$children_name][$i][$param_2_name]['rules'] = ( string )$param_2['rules'];
							
						}
						
					}
					
				}
				
				
				/************* criando o array final com os valores padrões *************/
				
				$key = $params['params_spec'][$children_name][$i]['name'];
				
				// definindo o valor padrão, que pode variar conforme o tipo de elemento
				// por exemplo, campos de textos utilizam o atributo default como valor, radio e checkbox utilizam o value juntamente com o default, o qual indica se o campo estará marcado ou não
				
				// iniciando o valor final
				$final_value = $default;
				
				// se o elemento for do tipo checkbox ou radio
				if ( $type == 'radio' OR $type == 'checkbox' ){
					
					// checkbox e radio inputs utilizam o value como valor, se somente estiverem marcados
					// portanto atribuimos seus valores se $value possuir conteudo
					$final_value = $default ? $value : FALSE;
					
				}
				
				// se já existir uma chave no array com o mesmo name, quer dizer que o campo é um array
				// ATENÇÃO! até o momento, campos em array são suportados apenas para o tipos checkbox, veja que está incluso checkbox no final da condição abaixo
				if ( key_exists( $key, $params['params_spec_values'] ) AND $final_value AND ( $type == 'checkbox' ) ){
					
					// se a chave possuir conteúdo e não for do tipo array, convertemos este em um
					// a primeira vez que esta chave possui valor, ela é do tipo string
					// em uma segunda análise pela chave, vemos que ela já existe, logo a convertemos em array
					if ( $params['params_spec_values'][$key] AND ! is_array( $params['params_spec_values'][$key] ) ){
						$params['params_spec_values'][$key] = ( array ) $params['params_spec_values'][$key];
					}
					
					// caso contrário, se for um checkbox, adicionamos ao array seus valores
					else{
						
						$params['params_spec_values'][$key][$final_value] = $final_value;
						
					}
					
				}
				// caso contrário, se não existir a chave, atribui esta
				// para todos os outros tipos de campos
				else if ( ! key_exists( $key, $params['params_spec_values'] ) ){
					$params['params_spec_values'][$key] = $final_value;
				}
				
				$i++;
				
			}
			
		}
		
		//echo '<br/><br/>';
		//print_r( $params );
		
		return $params;
	}
}

function params_to_string( $data = NULL ){
	
	if ( $data ){
		$output = '';
		foreach ( $data as $key => $value ) {
			if ( strpos( $key,PARAM_PREFIX ) !== FALSE ){
				if ( is_array( $value ) ){
					$output .= str_replace( PARAM_PREFIX, '', $key ).'[]='.( implode( '|', $value ) )."\n";
				}
				else{
					$output .= str_replace( PARAM_PREFIX, '', $key ).'='.$value."\n";
				}
			}
		}
		return $output;
	}
}

// define as regras de validação dos campos
function set_params_validations( $params_spec = NULL, $param_prefix = PARAM_PREFIX ){
	
	if ( $params_spec ){
		
		$CI =& get_instance();
		$CI->load->library( array( 'form_validation' ) );
		
		foreach ( $params_spec as $section_key => $section ) {
			
			foreach ( $section as $element_key => $element ) {
				
				$CI->form_validation->set_rules( $param_prefix.'[' . $element['name'] . ']', lang( $element['label'] ), isset( $element['validation']['rules'] ) ? $element['validation']['rules'] : '' );
				
			}
			
		}
		
	}
	
}

function params_to_html( $params = NULL, $params_values = NULL, $param_prefix = PARAM_PREFIX, $layout = 'default' ){
	
	if ( $params ){
		
		$CI =& get_instance();
		
		$output = '';
		$data = array();
		
		//print_r( $params );
		foreach ( $params['params_spec'] as $section_key => $section ) {
			
			$data['header'] = $section_key;
			$data['class'] = str_replace( '_', '-', $section_key );
			
			foreach ( $section as $element_key => $element ) {
				
				$data['elements'][] = get_param_element( $element, $params_values, $params, $param_prefix );
				
			}
			
			if ( file_exists( THEMES_PATH . ADMIN_DIR_NAME . DS . $CI->config->item( 'admin_theme' ) . DS . 'views' . DS . OTHERS_VIEWS_DIR_NAME . DS . 'params' . DS . $layout . 'params_set.php' ) ){
				
				$output .= $CI->load->view( 'admin' . DS . $CI->config->item( 'admin_theme' ) . DS . 'views' . DS . OTHERS_VIEWS_DIR_NAME . DS . 'params' . DS . $layout . DS . 'params_set', $data, TRUE );
				
			}
			else if ( file_exists( VIEWS_PATH . ADMIN_DIR_NAME . DS . OTHERS_VIEWS_DIR_NAME . DS . 'params' . DS . $layout . DS . 'params_set.php' ) ){
				
				$output .= $CI->load->view( ADMIN_DIR_NAME . DS . OTHERS_VIEWS_DIR_NAME . DS . 'params' . DS . $layout . DS . 'params_set', $data, TRUE );
				
			}
			
			// reiniciando a variavel $data para uso na próxima section
			$data = array();
			
		}
		
		$data['params'] = $output;
		
		if ( file_exists( THEMES_PATH . ADMIN_DIR_NAME . DS . $CI->config->item( 'admin_theme' ) . DS . 'views' . DS . OTHERS_VIEWS_DIR_NAME . DS . 'params' . DS . $layout . 'params_group.php' ) ){
			
			return $CI->load->view( 'admin' . DS . $CI->config->item( 'admin_theme' ) . DS . 'views' . DS . OTHERS_VIEWS_DIR_NAME . DS . 'params' . DS . $layout . DS . 'params_group', $data, TRUE );
			
		}
		else if ( file_exists( VIEWS_PATH . ADMIN_DIR_NAME . DS . OTHERS_VIEWS_DIR_NAME . DS . 'params' . DS . $layout . DS . 'params_group.php' ) ){
			
			return $CI->load->view( ADMIN_DIR_NAME . DS . OTHERS_VIEWS_DIR_NAME . DS . 'params' . DS . $layout . DS . 'params_group', $data, TRUE );
			
		}
		
	}
	
}

// converte uma estrutura de array em um elemento de formulário html
function get_param_element( $element = NULL, $params_values = NULL, $params_spec = NULL, $param_prefix = PARAM_PREFIX ){
	
	if ( $element ){
		
		$CI =& get_instance();
		$CI->load->helper( array( 'form' ) );
		
		if ( $CI->input->post( $param_prefix ) ){
			$post = $CI->input->post( $param_prefix );
		}
		
		if ( isset( $post ) ){
			
			// substitui os valores padrões pelos obtidos via post
			$params_values = $post;
			
		}
		
		//print_r( $params_values );
		
		$type = ( isset( $element['type'] ) AND $element['type'] ) ? $element['type'] : '';
		$name = ( isset( $element['name'] ) AND $element['name'] ) ? $element['name'] : '';
		$formatted_name = ( isset( $element['name'] ) AND $element['name'] ) ? $param_prefix.'['.$name.']' : '';
		$label = ( isset( $element['label'] ) AND $element['label'] ) ? lang( $element['label'] ) : '';
		$class = ( isset( $element['class'] ) AND $element['class'] ) ? $element['class'] : '';
		$value = ( isset( $element['value'] ) AND $element['value'] ) ? $element['value'] : '';
		$editor = ( isset( $element['editor'] ) AND $element['editor'] ) ? $element['editor'] : 0;
		$tip = ( isset( $element['tip'] ) AND $element['tip'] ) ? lang( $element['tip'] ) : '';
		$icon = ( isset( $element['icon'] ) AND $element['icon'] ) ? $element['icon'] : '';
		$ext_tip = rawurlencode( $tip );
		
		$disabled = ( check_var( $element['disabled'] ) ) ? TRUE : FALSE;
		$readonly = ( check_var( $element['readonly'] ) ) ? TRUE : FALSE;
		$maxlength = ( isset( $element['maxlength'] ) ) ? ( int ) $element['maxlength'] : NULL;
		$size = ( isset( $element['size'] ) ) ? ( int ) $element['size'] : NULL;
		
		$min = ( isset( $element['min'] ) AND is_int( $element['min'] ) ) ? ( int ) $element['min'] : NULL;
		$max = ( isset( $element['max'] ) AND is_int( $element['max'] ) ) ? ( int ) $element['max'] : NULL;
		$pattern = ( isset( $element['pattern'] ) AND $element['pattern'] ) ? $element['pattern'] : NULL;
		$step = ( isset( $element['step'] ) AND is_int( $element['step'] ) ) ? ( int ) $element['step'] : NULL;
		
		$breaks = array( '<br/>', '<br />', '<br>', );
		$tip = str_ireplace( $breaks, "\r\n", $tip );
		$tip = str_replace( '"', "'", $tip );
		$tip = strip_tags( $tip );
		
		if ( $tip ){
			
			$class .= ' info-tip ';
			
		}
		
		$element_value = isset( $params_values[$name] ) ? $params_values[$name] : '';
		$element_spec_value = isset( $params_spec['params_spec_values'][$name] ) ? $params_spec['params_spec_values'][$name] : '';
		
		if ( is_array( @$element_spec_value ) ){
			$formatted_name .= '[]';
		}
		
		// obtem os options das especificações
		$options = ( isset( $element['options'] ) AND $element['options'] ) ? ( array ) $element['options'] : '';
		
		$params_values[$name] = ( isset( $params_values[$name] ) ) ? $params_values[$name] : '';
		
		// o código abaixo não mantém o valor 0 ( zero ) nos campos de texto
		//$params_values[$name] = ( isset( $params_values[$name] ) AND $params_values[$name] ) ? $params_values[$name] : '';
		
		if ( $type == 'html' ) {
			
			$html = '<td class="field" colspan="2" >' . $params_values[ $name ] . '</td>';
			$html = '<tr>' . $html . '</tr>';
			
			return $html;
			
		}
		else if ( $type == 'text' ) {
			
			$html = '<td class="field-title" >' . form_error( $formatted_name, '<div class="msg-inline-error">', '</div>' );
			$html .= '<label title="' .  $tip . '" class="' . $class . '" data-ext-tip="' . $ext_tip . '" for="param-' . $name . '">' . $label . '</label>' . '</td>';
			
			$html .= '<td class="field" >' . form_input( 
				array( 
					'id'=>$name,
					'name'=>$formatted_name,
					//'title' => $tip,
					'class' => $class,
					//'data-ext-tip' => $ext_tip,
				),
				$params_values[ $name ]
			) . '</td>';
			
			$html = '<tr>' . $html . '</tr>';
			
			return $html;
			
		}
		else if ( $type == 'number' ) {
			
			$html = '<td class="field-title" >' . form_error( $formatted_name, '<div class="msg-inline-error">', '</div>' );
			$html .= '<label title="' .  $tip . '" class="' . $class . '" data-ext-tip="' . $ext_tip . '" for="param-' . $name . '">' . $label . '</label>' . '</td>';
			
			// input number params
			$inp[ 'id' ] = $name;
			$inp[ 'name' ] = $formatted_name;
			$inp[ 'class' ] = $class;
			
			if ( check_var( $disabled ) ) $inp[ 'disabled' ] = TRUE;
			if ( check_var( $readonly ) ) $inp[ 'readonly' ] = TRUE;
			
			if ( $min !== NULL ) $inp[ 'min' ] = $min;
			if ( $max !== NULL ) $inp[ 'max' ] = $max;
			if ( check_var( $pattern ) ) $inp[ 'pattern' ] = $pattern;
			if ( $step !== NULL ) $inp[ 'step' ] = $step;
			
			$html .= '<td class="field" >' . form_input_number( 
				$inp,
				$params_values[ $name ]
			) . '</td>';
			
			$html = '<tr>' . $html . '</tr>';
			
			return $html;
			
		}
		else if ( $type == 'password' ) {
			
			$html = '<td class="field-title" >' . form_error( $formatted_name, '<div class="msg-inline-error">', '</div>' );
			$html .= '<label title="' .  $tip . '" class="' . $class . '" data-ext-tip="' . $ext_tip . '" for="param-' . $name . '">' . $label . '</label>' . '</td>';
			
			$html .= '<td class="field" >' . form_password(
				array( 
					'id'=>$name,
					'name'=>$formatted_name,
					//'title' => $tip,
					'class' => $class,
					//'data-ext-tip' => $ext_tip,
				 ),
				$params_values[ $name ]
			 ) . '</td>';
			
			$html = '<tr>' . $html . '</tr>';
			
			return $html;
			
		}
		else if ( $type == 'select' ) {
			
			$switch = count( $options ) == 2 ? TRUE : FALSE;
			
			if ( count( $options ) > 0 AND is_array( $options ) ){
				
				foreach( $options as $key => $option ) {
					
					$options[ html_escape( $key ) ] = lang( $option );
					
				};
				
			}
			
			$html = '<td class="field-title" >' . form_error( $formatted_name, '<div class="msg-inline-error">', '</div>' );
			$html .= '<label title="' .  $tip . '" class="' . $class . '" data-ext-tip="' . $ext_tip . '" for="param-' . $name . '">' . $label . '</label>' . '</td>';
			
			$html .= '<td class="field" >' . form_dropdown( 
				
				$formatted_name,
				$options,
				$element_value,
				'id="param-'.$name.'" class="' . $class . '"'
				
			 ) . '</td>';
			
			$html = '<tr>' . $html . '</tr>';
			
			return $html;
			
		}
		else if ( $type == 'radio' ) {
			
			$html = '<td class="field-title" >' . form_error( $formatted_name, '<div class="msg-inline-error">', '</div>' );
			$html .= '<label title="' .  $tip . '" class="' . $class . '" data-ext-tip="' . $ext_tip . '" for="param-' . $name . '">' . $label . '</label>' . '</td>';
			
			$html .= '<td class="field" >' . '<input type="radio" name="'.$formatted_name.'" value="'.$value.'" class="switch '.$class.'" ';
			
			$checked = ( $params_values[$name] AND $params_values[$name] == $value ) ? 'checked="checked"' : '';
			
			$html .= $checked;
			$html .= ' />' . '</td>';
			
			$html = '<tr>' . $html . '</tr>';
			
			return $html;
			
		}
		
		else if ( $type == 'checkbox' ) {
			
			$html = '<td class="field-title" >' . form_error( $formatted_name, '<div class="msg-inline-error">', '</div>' );
			$html .= '<label title="' .  $tip . '" class="' . $class . '" data-ext-tip="' . $ext_tip . '" for="param-' . $name . '">' . $label . '</label>' . '</td>';
			
			// isso permitirá que o valor do checkbox sempre seja enviado via post, agora como 0
			$html .= '<td class="field" >' . '<input type="hidden" name="'.$formatted_name.'" value="0" />';
			
			$html .= '<input type="checkbox" name="'.$formatted_name.'" value="'.$value.'" class="switch '.$class.'" ';
			
			if ( is_array( $params_values[$name] ) ){
				
				$checked = in_array( $value, $params_values[$name] ) ? 'checked="checked"' : '';
				
			}
			else {
				
				$checked = ( $params_values[$name] AND $params_values[$name] == $value ) ? 'checked="checked"' : '';
				
			}
			
			$html .= $checked;
			$html .= ' />' . '</td>';
			
			$html = '<tr>' . $html . '</tr>';
			
			return $html;
			
		}
		
		else if ( $type == 'textarea' ) {
			
			$html = '<td class="field-title" >' . form_error( $formatted_name, '<div class="msg-inline-error">', '</div>' );
			$html .= '<label title="' .  $tip . '" class="' . $class . '" data-ext-tip="' . $ext_tip . '" for="param-' . $name . '">' . $label . '</label>' . '</td>';
			
			
			
			
			
			
			
			
			if ( $editor ){
				
				$CI->plugins->load( NULL, 'js_text_editor' );
				
			}
			
			
			
			
			
			
			
			
			
			$html .= '<td class="field" >' . '<div>' . form_textarea( 
				array( 
					'id'=>$name,
					'name'=>$formatted_name,
					//'title' => lang( $tip ),
					'class'=> $class . ( $editor ? ' js-editor' : '' ),
					//'data-ext-tip' => $ext_tip,
				 ),
				$params_values[$name]
			 ) . '</div>' . '</td>';
			
			$html = '<tr>' . $html . '</tr>';
			
			return $html;
			
		}
		else if ( $type == 'spacer' ) {
			
			$html = '<hr class="'.$class.'"/>';
			$html .= $label ? '<label title="' .  $tip . '" class="' . $class . '" data-ext-tip="' . $ext_tip . '" >' . $label . '</label>' . '</td>' : '';
			
			$html = '<tr><td colspan="2">' . $html . '</td></tr>';
			
			return $html;
			
		}
	}
}


/* End of file general_helper.php */
/* Location: ./application/helpers/params_helper.php */