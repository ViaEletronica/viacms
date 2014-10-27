<?php if(extension_loaded('zlib')){ob_start('ob_gzhandler');} header ('Content-Type: text/css');

define('SELF', pathinfo( __FILE__, PATHINFO_BASENAME ) );

if ( ! defined( 'DS' ) ) define( 'DS', DIRECTORY_SEPARATOR );

$base_path = explode( DS, $_SERVER[ "SCRIPT_FILENAME" ] );

for ( $i = 1; $i <= 6; $i++ ){
	
	unset( $base_path[ count( $base_path ) - 1 ] );
	
}

$base_path = join( DS, $base_path ) . DS;

if ( ! defined( 'BASE_PATH' ) ) define( 'BASE_PATH', $base_path );
if ( ! defined( 'FCPATH' ) ) define( 'FCPATH', BASE_PATH );
if ( ! defined( 'BASEPATH' ) ) define( 'BASEPATH', TRUE );

require_once( BASE_PATH . 'application/config/host.php');
require_once( BASE_PATH . 'application/config/constants.php');
require_once( BASE_PATH . 'application/config/config.php');

define('THEME_IMAGE_DIR_URL', SITE_THEMES_URL . '/' . $config[ 'site_theme' ] . '/assets/images');
define('THEME_IMAGE_DIR_PATH', SITE_THEMES_PATH . $config[ 'site_theme' ] . DS . 'assets' . DS . 'images' . DS );



/*
 **************************************************************************************************
 **************************************************************************************************
 --------------------------------------------------------------------------------------------------
 VUI - Via CMS UI
 --------------------------------------------------------------------------------------------------
 */

set_include_path( get_include_path() . PATH_SEPARATOR . LIBRARIES_PATH );
require_once 'vui' . DS . 'vui.php';
$vui = new Vui( THEME_IMAGE_DIR_PATH . 'svg' . DS, THEME_IMAGE_DIR_PATH . 'svg' . DS . 'colors.svg' );

/*
 --------------------------------------------------------------------------------------------------
 VUI - Via CMS UI
 --------------------------------------------------------------------------------------------------
 **************************************************************************************************
 **************************************************************************************************
 */

include( 'defs.php' );
include( 'reset.css.php' );
//include( 'font_icons.css.php' );
include( 'html.css.php' );
include( 'template.css.php' );
include( 'articles.css.php' );
include( 'submit-forms.css.php' );
include( 'contacts.css.php' );
include( 'jquery-scrolltop.css.php' );

/*
include( 'html.css.php' );
include( 'template.css.php' );

include( 'msg.css.php' );
include( 'params.css.php' );
include( 'info_cards.css.php' );
include( 'tabs.css.php' );
include( 'modals.css.php' );
include( 'search.css.php' );
include( 'buttons.css.php' );
include( 'jquery_switch.css.php' );


include( 'jquery_ui.css.php' );
include( 'qtip2.css.php' );
include( 'tinymce.css.php' );


include( 'dashboard.css.php' );
include( 'articles.css.php' );
include( 'vesm.css.php' );
include( 'adjustments.css.php' );
*/
?>

