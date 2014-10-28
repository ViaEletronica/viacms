<?php if(extension_loaded('zlib')){ob_start('ob_gzhandler');} header ('Content-Type: text/css');

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

define('THEME_IMAGE_DIR_URL', ADMIN_THEMES_URL . '/' . $config[ 'admin_theme' ] . '/assets/images');
define('THEME_IMAGE_DIR_PATH', ADMIN_THEMES_PATH . $config[ 'admin_theme' ] . DS . 'assets' . DS . 'images' . DS );

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
$vui_css = new Vui_css();

print_r( $vui );

if ( ! defined( 'VUI_SPACING' ) ) define( 'VUI_SPACING', 15 );
if ( ! defined( 'VUI_FONT_COLOR' ) ) define( 'VUI_FONT_COLOR', $vui->colors->vui_darker->hex_s );
if ( ! defined( 'VUI_BORDER' ) ) define( 'VUI_BORDER', '1px solid ' . $vui->colors->vui_extra_3->rgba_s( 30 ) );
if ( ! defined( 'VUI_BORDER_LIGHT' ) ) define( 'VUI_BORDER_LIGHT', '1px solid ' . $vui->colors->vui_lighter->rgba_s( 200 ) );
if ( ! defined( 'VUI_BORDER_RADIUS' ) ) define( 'VUI_BORDER_RADIUS', '5px' );

/*
 --------------------------------------------------------------------------------------------------
 VUI - Via CMS UI
 --------------------------------------------------------------------------------------------------
 **************************************************************************************************
 **************************************************************************************************
 */



/*
 **************************************************************************************************
 **************************************************************************************************
 --------------------------------------------------------------------------------------------------
 Colors schemes
 --------------------------------------------------------------------------------------------------
 */

define('SCHEME_1_COLOR_1', '#fff' );
define('SCHEME_1_COLOR_1_COMPLEMENTARY', '#576372' );
define('SCHEME_1_COLOR_2', '#e6e9ec' );
define('SCHEME_1_COLOR_2_COMPLEMENTARY', SCHEME_1_COLOR_1 );
define('SCHEME_1_COLOR_3', '#f4f6f7' );
define('SCHEME_1_COLOR_3_COMPLEMENTARY', SCHEME_1_COLOR_1_COMPLEMENTARY );
define('SCHEME_1_COLOR_4', 'rgba(0, 42, 94, 0.07)' );
define('SCHEME_1_COLOR_5', 'rgba(0, 26, 59, 0.61)' );
define('SCHEME_1_COLOR_6', 'rgba(0, 21, 47, 0.76)' );
define('SCHEME_1_COLOR_7', '#f4f6f7' );
define('SCHEME_1_COLOR_7_COMPLEMENTARY', 'rgba( 42, 48, 55, 0.92 )' );

define('SCHEME_2_COLOR_1', '#2b74c7' );
define('SCHEME_2_COLOR_1_COMPLEMENTARY', '#fff' );
define('SCHEME_2_COLOR_2', '#5c9ceb' );
define('SCHEME_2_COLOR_2_COMPLEMENTARY', '#fff' );
define('SCHEME_2_COLOR_3', '#f2f6fb' );
define('SCHEME_2_COLOR_3_COMPLEMENTARY', SCHEME_1_COLOR_1_COMPLEMENTARY );
define('SCHEME_2_COLOR_4', '#fff' );
define('SCHEME_2_COLOR_5', 'rgba( 255, 255, 255, .478 )' );

/*
 --------------------------------------------------------------------------------------------------
 Colors schemes
 --------------------------------------------------------------------------------------------------
 **************************************************************************************************
 **************************************************************************************************
 */



define('DEFAULT_SPACING', 10);

define('DEFAULT_TRANSITION', 'all 0.1s ease-in-out');

define('DEFAULT_FONT_FAMILY', '\'Arial\', sans-serif');
define('FONT_FAMILY_SEC', '\'Federo\', \'Arial\', sans-serif');
define('DEFAULT_FONT_SIZE', '.92em');
define('DEFAULT_LINE_HEIGHT', 'normal');
define('DEFAULT_FONT_BOLD_COLOR', VUI_FONT_COLOR);

define('LINK_COLOR', SCHEME_2_COLOR_1 );
define('LINK_HOVER_COLOR', SCHEME_2_COLOR_2 );

define('DEFAULT_BORDER_DARK', 'thin solid rgba(0, 42, 94, 0.15)');
define('DEFAULT_BORDER_LIGHT', 'thin solid rgba(255, 255, 255, 0.5)');
define('DEFAULT_BORDER_RADIUS_VALUE', '5');

define('DEFAULT_BORDER', '
	
	border: 1px solid ' . SCHEME_1_COLOR_4 . ';
	
');

define('DEFAULT_BORDER_RADIUS', '
	
	border-top-left-radius: ' . DEFAULT_BORDER_RADIUS_VALUE . 'px;
	border-top-right-radius: ' . DEFAULT_BORDER_RADIUS_VALUE . 'px;
	border-bottom-left-radius: ' . DEFAULT_BORDER_RADIUS_VALUE . 'px;
	border-bottom-right-radius: ' . DEFAULT_BORDER_RADIUS_VALUE . 'px;
	
');

define('DEFAULT_BOX_SHADOW', '
	
	-webkit-box-shadow: 0 3px 2px rgba(0, 36, 109, 0.08);
	-moz-box-shadow: 0 3px 2px rgba(0, 36, 109, 0.08);
	box-shadow: 0 3px 2px rgba(0, 36, 109, 0.08);
	
');

define('BOX_SHADOW_NONE', '
	
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
	
');

define('DEFAULT_BOX_SHADOW_HOVER', '0 3px 5px rgba(15, 64, 102, 0.5)');

define('DEFAULT_INSET_BOX_SHADOW', '
	
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
	
');

define('DEFAULT_INSET_BOX_SHADOW_HOVER', '
	
	-webkit-box-shadow: inset 0 3px 5px rgba(15, 64, 102, 0.5);
	-moz-box-shadow: inset 0 3px 5px rgba(15, 64, 102, 0.5);
	box-shadow: inset inset 0 3px 5px rgba(15, 64, 102, 0.5);
	
');

define('DEFAULT_SIDE_PANEL_WIDTH', '35%');

define('DEFAULT_TEXT_SHADOW', 'none' );
define('DEFAULT_TEXT_SHADOW_HOVER', '0 0 20px rgba(137, 200, 254, 1)');

define('TEXT_SHADOW_DARK', '0 0 10px rgba(0, 36, 109, 0.5), 0 1px 0px rgba(0, 0, 0, 0.04)' );
define('TEXT_SHADOW_DARK_HOVER', '0 0 20px rgba(0, 22, 66, 0.5)');

define('TEXT_SHADOW_LIGHT', '0 1px 0px rgba(255, 255, 255, 1)' );
define('TEXT_SHADOW_LIGHT_HOVER', DEFAULT_TEXT_SHADOW_HOVER);

define('SELECTION_FOREGROUND_COLOR', '#ffffff');
define('SELECTION_BACKGROUND_COLOR', '#348fe5');
define('SELECTION_SEC_FOREGROUND_COLOR', VUI_FONT_COLOR);
define('SELECTION_SEC_BACKGROUND_COLOR', '#dde6f2');

define('HIGHLIGHT_BOX_SHADOW', '0 0 20px ' . $vui->colors->vui_base->rgba_s( 200 ) );
define('ERROR_BOX_SHADOW', '0 0 20px ' . $vui->colors->vui_red->rgba_s( 100 ) );

define('HIGHLIGHT_FONT_COLOR', VUI_FONT_COLOR);
define('HIGHLIGHT_BACKGROUND', '
	
	background: rgba( 255, 255, 255, .7 );
	
');

define('DEFAULT_TABLE_BORDER', '1px solid rgba(8, 24, 38, .07)');
define('DEFAULT_TABLE_FONT_SIZE', '100%');

define('DEFAULT_TABLE_TR_FOREGROUND_COLOR', VUI_FONT_COLOR);
define('DEFAULT_TABLE_TR_BACKGROUND_COLOR', 'none');
define('DEFAULT_TABLE_TR_BACKGROUND', '
	
	background: none;
	
');
define('DEFAULT_TABLE_TR_FOREGROUND_COLOR_SEC', SELECTION_SEC_FOREGROUND_COLOR);
define('DEFAULT_TABLE_TR_BACKGROUND_COLOR_SEC', SELECTION_SEC_BACKGROUND_COLOR);
define('DEFAULT_TABLE_TR_BACKGROUND_SEC', '
	
	background: url("	' . THEME_IMAGE_DIR_URL . '/table-row-odd.png") repeat center center;
	
');

define('DEFAULT_TABLE_TH_FONT_SIZE', DEFAULT_TABLE_FONT_SIZE);
define('DEFAULT_TABLE_TH_FOREGROUND_COLOR', '#fff');
define('DEFAULT_TABLE_TH_BACKGROUND_COLOR', SELECTION_SEC_BACKGROUND_COLOR);
define('DEFAULT_TABLE_TH_BACKGROUND', '
	
	background-image: url("	' . THEME_IMAGE_DIR_URL . '/noise-white.png");
	background-repeat: repeat;
	background-position: center;
	background-color: ' . SCHEME_1_COLOR_5 . ';
	
');

define('DEFAULT_TABLE_TD_FONT_SIZE', DEFAULT_TABLE_FONT_SIZE);
define('DEFAULT_TABLE_TD_FOREGROUND_COLOR', VUI_FONT_COLOR);
define('DEFAULT_TABLE_TD_BACKGROUND_COLOR', '#ffffff');
define('DEFAULT_TABLE_TD_FOREGROUND_COLOR_SEC', VUI_FONT_COLOR);
define('DEFAULT_TABLE_TD_BACKGROUND_COLOR_SEC', '#f3f6fa');

define('DEFAULT_TABLE_TH_OB_FOREGROUND_COLOR', '#fff');
define('DEFAULT_TABLE_TH_OB_BACKGROUND', '
	
	background-color: ' . SCHEME_1_COLOR_6 . ';
	
');

/****************************************************/
/********************* Buttons **********************/

/* default state */
define( 'BUTTONS_PADDING_TOP', DEFAULT_SPACING );
define( 'BUTTONS_PADDING_RIGHT', DEFAULT_SPACING );
define( 'BUTTONS_PADDING_BOTTOM', DEFAULT_SPACING );
define( 'BUTTONS_PADDING_LEFT', DEFAULT_SPACING );

define( 'BUTTONS_PADDING', BUTTONS_PADDING_TOP . 'px ' . BUTTONS_PADDING_RIGHT . 'px ' . BUTTONS_PADDING_BOTTOM . 'px ' . BUTTONS_PADDING_LEFT . 'px ');

define('BUTTONS_FONT_SIZE', '90%');
define('BUTTONS_BACKGROUND_VUI_COLOR', 'vui_extra_2' );
define('BUTTONS_COLOR', $vui->colors->{BUTTONS_BACKGROUND_VUI_COLOR}->get_ro_color()->hex_s );
define('BUTTONS_BACKGROUND', '
	
	' . $vui->colors->{BUTTONS_BACKGROUND_VUI_COLOR}->getCssGradient( 5 ) . ';
	
');

define('BUTTONS_BORDER', '
	
	border: none;
	border-bottom: 2px solid #' . $vui->colors->{BUTTONS_BACKGROUND_VUI_COLOR}->darken( 15 ) . ';
	
');

define('BUTTONS_BOX_SHADOW', '
	
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
	
');

define('BUTTONS_TEXT_SHADOW', TEXT_SHADOW_LIGHT );



/* hover state */
define('BUTTONS_BACKGROUND_VUI_COLOR_HOVER', 'vui_extra_1' );
define('BUTTONS_COLOR_HOVER', $vui->colors->{BUTTONS_BACKGROUND_VUI_COLOR_HOVER}->get_ro_color()->hex_s );
define('BUTTONS_BACKGROUND_HOVER', '
	
	' . $vui->colors->{BUTTONS_BACKGROUND_VUI_COLOR_HOVER}->getCssGradient( 5 ) . ';
	
');

define('BUTTONS_BORDER_HOVER', '
	
	border-bottom: 2px solid #' . $vui->colors->{BUTTONS_BACKGROUND_VUI_COLOR_HOVER}->darken( 20 ) . ';
	
');


/********************* Buttons **********************/
/****************************************************/

/****************************************************/
/****************** Input Buttons *******************/

/* default state */
define('INPUTS_BUTTONS_PADDING', ( BUTTONS_PADDING_TOP + 2 ) . 'px ' . ( BUTTONS_PADDING_RIGHT * 1.5 ) . 'px ' . ( BUTTONS_PADDING_BOTTOM ) . 'px ' . ( BUTTONS_PADDING_LEFT * 1.5 ) . 'px' );
define('INPUTS_BUTTONS_FONT_FAMILY', DEFAULT_FONT_FAMILY);
define('INPUTS_BUTTONS_FONT_SIZE', BUTTONS_FONT_SIZE);
define('INPUTS_BUTTONS_COLOR', BUTTONS_COLOR );
define('INPUTS_BUTTONS_BACKGROUND_COLOR', '#426387' );
define('INPUTS_BUTTONS_BACKGROUND', BUTTONS_BACKGROUND );

define('INPUTS_BUTTONS_BORDER', BUTTONS_BORDER );

define('INPUTS_BUTTONS_BOX_SHADOW', BUTTONS_BOX_SHADOW );

define('INPUTS_BUTTONS_TEXT_SHADOW', 'none' );

/* hover state */
define('INPUTS_BUTTONS_COLOR_SEC', BUTTONS_COLOR_HOVER );
define('INPUTS_BUTTONS_BACKGROUND_COLOR_SEC', '#a0c5e8' );
define('INPUTS_BUTTONS_BACKGROUND_HOVER', BUTTONS_BACKGROUND_HOVER );
define('INPUTS_BUTTONS_BORDER_SEC', BUTTONS_BORDER_HOVER );

/* active state */




define('APPLY_BUTTON_FOREGROUND_COLOR', '#fff');
define('APPLY_BUTTON_BACKGROUND', '
	
	background-image: -webkit-gradient(linear, center top, center bottom, color-stop(0%, #728297), color-stop(100%, #495462));
	background-image: -webkit-linear-gradient(top, #728297 0%, #495462 100%);
	background-image: -moz-linear-gradient(top, #728297 0%, #495462 100%);
	background-image: -ms-linear-gradient(top, #728297 0%, #495462 100%);
	background-image: -o-linear-gradient(top, #728297 0%, #495462 100%);
	background-image: linear-gradient(to bottom, #728297 0%, #495462 100%);
	
');

define('APPLY_BUTTON_FOREGROUND_COLOR_SEC', '#fff');
define('APPLY_BUTTON_BACKGROUND_SEC', '
	
	/* CSS */
	background-image: -webkit-gradient(linear, center top, center bottom, color-stop(0%, #63c312), color-stop(21%, #82d40a), color-stop(100%, #51a100));
	background-image: -webkit-linear-gradient(top, #63c312 0%, #82d40a 21%, #51a100 100%);
	background-image: -moz-linear-gradient(top, #63c312 0%, #82d40a 21%, #51a100 100%);
	background-image: -ms-linear-gradient(top, #63c312 0%, #82d40a 21%, #51a100 100%);
	background-image: -o-linear-gradient(top, #63c312 0%, #82d40a 21%, #51a100 100%);
	background-image: linear-gradient(to bottom, #63c312 0%, #82d40a 21%, #51a100 100%);
	
');


define('CANCEL_BUTTON_FOREGROUND_COLOR', '#fff');
define('CANCEL_BUTTON_BACKGROUND', '
	
	/* CSS */
	background-image: -webkit-gradient(linear, center top, center bottom, color-stop(0%, #d03535), color-stop(21%, #dc4747), color-stop(100%, #9d3939));
	background-image: -webkit-linear-gradient(top, #d03535 0%, #dc4747 21%, #9d3939 100%);
	background-image: -moz-linear-gradient(top, #d03535 0%, #dc4747 21%, #9d3939 100%);
	background-image: -ms-linear-gradient(top, #d03535 0%, #dc4747 21%, #9d3939 100%);
	background-image: -o-linear-gradient(top, #d03535 0%, #dc4747 21%, #9d3939 100%);
	background-image: linear-gradient(to bottom, #d03535 0%, #dc4747 21%, #9d3939 100%);
	
');

define('CANCEL_BUTTON_FOREGROUND_COLOR_SEC', '#fff');
define('CANCEL_BUTTON_BACKGROUND_SEC', '
	
	/* CSS */
	background-image: -webkit-gradient(linear, center top, center bottom, color-stop(0%, #e14646), color-stop(21%, #f75353), color-stop(100%, #c22f2f));
	background-image: -webkit-linear-gradient(top, #e14646 0%, #f75353 21%, #c22f2f 100%);
	background-image: -moz-linear-gradient(top, #e14646 0%, #f75353 21%, #c22f2f 100%);
	background-image: -ms-linear-gradient(top, #e14646 0%, #f75353 21%, #c22f2f 100%);
	background-image: -o-linear-gradient(top, #e14646 0%, #f75353 21%, #c22f2f 100%);
	background-image: linear-gradient(to bottom, #e14646 0%, #f75353 21%, #c22f2f 100%);
	
');

/****************** Input Buttons *******************/
/****************************************************/

/****************************************************/
/******************* Link Buttons *******************/

define('LINK_BUTTONS_PADDING', BUTTONS_PADDING );

/******************* Link Buttons *******************/
/****************************************************/

/****************************************************/
/****************** Select Buttons ******************/

define('SELECT_BUTTONS_BACKGROUND_VUI_COLOR', BUTTONS_BACKGROUND_VUI_COLOR );
define('SELECT_BUTTONS_BACKGROUND', '
	
	' . $vui->colors->{SELECT_BUTTONS_BACKGROUND_VUI_COLOR}->getCssGradient( 5, 'btt', FALSE, 'url("' . $vui->svg_file( 'icon-select', $vui->colors->{SELECT_BUTTONS_BACKGROUND_VUI_COLOR}->get_ro_color()->hex_s) . '"), ' ) . ';
	
');

define('SELECT_BUTTONS_PADDING', ( BUTTONS_PADDING_TOP ) . 'px ' . ( BUTTONS_PADDING_RIGHT * 1.5 ) . 'px ' . ( BUTTONS_PADDING_BOTTOM ) . 'px ' . ( BUTTONS_PADDING_LEFT * 1.5 ) . 'px' );

/* hover state */
define('SELECT_BUTTONS_BACKGROUND_VUI_COLOR_HOVER', BUTTONS_BACKGROUND_VUI_COLOR_HOVER );
define('SELECT_BUTTONS_BACKGROUND_HOVER', '
	
	' . $vui->colors->{SELECT_BUTTONS_BACKGROUND_VUI_COLOR_HOVER}->getCssGradient( 5, 'btt', FALSE, 'url("' . $vui->svg_file( 'icon-select', $vui->colors->{SELECT_BUTTONS_BACKGROUND_VUI_COLOR_HOVER}->get_ro_color()->hex_s ) . '"), ' ) . ';
	
');

/****************** Select Buttons ******************/
/****************************************************/

/****************************************************/
/****************** Switch Buttons ******************/

define('SWITCH_BUTTONS_ACTIVE_BACKGROUND', '
	
	' . $vui->colors->vui_green->getCssGradient( 5 ) . ';
	
');
define( 'SWITCH_BUTTONS_ACTIVE_BORDER', '
	
	border: none;
	border-bottom: 2px solid #' . $vui->colors->vui_green->darken( 20 ) . ';
	
');

define('SWITCH_BUTTONS_SEMIACTIVE_BACKGROUND', '
	
	' . $vui->colors->vui_orange->getCssGradient( 5 ) . ';
	
');
define( 'SWITCH_BUTTONS_SEMIACTIVE_BORDER', '
	
	border: none;
	border-bottom: 2px solid #' . $vui->colors->vui_orange->darken( 20 ) . ';
	
');

/****************** Switch Buttons ******************/
/****************************************************/

/****************************************************/
/******************** Inputs text *******************/

define( 'INPUTS_PADDING_TOP', BUTTONS_PADDING_TOP );
define( 'INPUTS_PADDING_RIGHT', BUTTONS_PADDING_RIGHT );
define( 'INPUTS_PADDING_BOTTOM', BUTTONS_PADDING_BOTTOM );
define( 'INPUTS_PADDING_LEFT', BUTTONS_PADDING_LEFT );

define('INPUTS_PADDING', INPUTS_PADDING_TOP . 'px ' . INPUTS_PADDING_RIGHT . 'px ' . INPUTS_PADDING_BOTTOM . 'px ' . INPUTS_PADDING_LEFT . 'px ');
define('INPUTS_FONT_FAMILY', DEFAULT_FONT_FAMILY);
define('INPUTS_FONT_SIZE', '90%');
define('INPUTS_FOREGROUND_COLOR', VUI_FONT_COLOR);
define('INPUTS_BACKGROUND_COLOR', '#e0e9f2');
define('INPUTS_BACKGROUND', '
	
	background: ' . $vui->colors->vui_lighter->lighten( 20, TRUE )->hex_s . ';
	
');
define('INPUTS_BORDER', '
	
	border: ' . VUI_BORDER . ';
	
');

define('INPUTS_FOREGROUND_COLOR_SEC', VUI_FONT_COLOR);
define('INPUTS_BACKGROUND_COLOR_SEC', '#cbdff2');
define('INPUTS_BACKGROUND_SEC', '
	
	
	
');
define('INPUTS_BORDER_SEC', '
	
	border: 1px solid ' . $vui->colors->vui_base->rgb_s . ';
	
');

/******************** Inputs text *******************/
/****************************************************/

/****************************************************/
/********************** Checkbox ********************/

define('CHECKBOX_PADDING', ( DEFAULT_SPACING / 1.5 ) . 'px' );

define('CHECKBOX_BORDER_RADIUS', 0);

define('CHECKBOX_FOREGROUND_COLOR', INPUTS_BUTTONS_COLOR);
define('CHECKBOX_BACKGROUND', INPUTS_BACKGROUND);
define('CHECKBOX_BORDER', INPUTS_BORDER);

define('CHECKBOX_FOREGROUND_COLOR_SEC', INPUTS_BUTTONS_COLOR_SEC);
define('CHECKBOX_BACKGROUND_SEC', INPUTS_BUTTONS_BACKGROUND_HOVER);
define('CHECKBOX_BORDER_SEC', INPUTS_BORDER);

/********************** Checkbox ********************/
/****************************************************/

/****************************************************/
/********************** Radiobox ********************/

define('RADIO_PADDING', CHECKBOX_PADDING);

define('RADIO_BORDER_RADIUS', 100);

define('RADIO_FOREGROUND_COLOR', CHECKBOX_FOREGROUND_COLOR);
define('RADIO_BACKGROUND', CHECKBOX_BACKGROUND);
define('RADIO_BORDER', CHECKBOX_BORDER);

define('RADIO_FOREGROUND_COLOR_SEC', CHECKBOX_FOREGROUND_COLOR_SEC);
define('RADIO_BACKGROUND_SEC', CHECKBOX_BACKGROUND_SEC);
define('RADIO_BORDER_SEC', CHECKBOX_BORDER_SEC);

/********************** Radiobox ********************/
/****************************************************/

/****************************************************/
/*********************** Tabs ***********************/

define('TAB_ITEM_FOREGROUND_COLOR', VUI_FONT_COLOR);
define('TAB_ITEM_BACKGROUND', '
	
	background: ' . SCHEME_1_COLOR_4 . ';
	
');
define('TAB_ITEM_BORDER', '1px solid ' . SCHEME_1_COLOR_4 );

define('TAB_ITEM_FOREGROUND_COLOR_SEC', VUI_FONT_COLOR);
define('TAB_ITEM_BACKGROUND_SEC', '
	
	background: url("	' . THEME_IMAGE_DIR_URL . '/noise-2.png") repeat center center ' . SCHEME_1_COLOR_1 . ';
	
');
define('TAB_ITEM_BORDER_SEC', '1px solid ' . SCHEME_1_COLOR_4 );

/*********************** Tabs ***********************/
/****************************************************/


/*
 **************************************************************************************************
 **************************************************************************************************
 --------------------------------------------------------------------------------------------------
 Styles sets definitions
 --------------------------------------------------------------------------------------------------
 */


/* Modals, dialogs, popup menus */
define('MODAL_STYLESHEET', '
	
	background: ' . SCHEME_1_COLOR_1 . ';
	
	color: ' . SCHEME_1_COLOR_2 . '; /* influencia na cor das setas no qtip */
	
	border: 1px solid ' . SCHEME_1_COLOR_4 . ' !important;
	
	' . DEFAULT_BOX_SHADOW . '
	
	' . DEFAULT_BORDER_RADIUS . '
	
	-webkit-background-clip: padding-box;
	-moz-background-clip: padding;
	background-clip: padding-box;
	
	line-height: normal;
');

/* Pressed widgets */
define('PRESSED_STYLESHEET', '
	
	background: ' . SCHEME_1_COLOR_4 . ';
	
	' . DEFAULT_INSET_BOX_SHADOW . '
	
');

/* Font icons */
define('FONT_ICONS_STYLESHEET', '
	
	position: relative;
	display: inline-block;
	font-family: "vecms-icons";
	speak: none;
	font-size: 16px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;

	/* Better Font Rendering =========== */
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	
');

/* Fieldsets */
define('FIELDSET_STYLESHEET', '
	
	position: relative;
	display: inline-block;
	background: rgba(255, 255, 255, 0.22);
	margin-right: ' . DEFAULT_SPACING . 'px;
	margin-bottom: ' . DEFAULT_SPACING . 'px;
	
	border: none;
	
');

/* Legends */
define('LEGEND_STYLESHEET', '
	
	position:relative;
	display: block;
	
	font-family: ' . FONT_FAMILY_SEC . ';
	color: ' . VUI_FONT_COLOR . ';
	font-size: 120%;
	text-align: left;
	margin: 0 0 ' . DEFAULT_SPACING . 'px;
	padding: ' . DEFAULT_SPACING . 'px;
	
	float: left;
	
	white-space: normal;
	width: 100%;
	text-shadow: ' . DEFAULT_TEXT_SHADOW . ';
	
	background: ' . $vui->colors->vui_extra_2->hex_s . ';
	
	z-index: 2;
	
');

/* Full rounded corners */
define('FULL_ROUNDED_CORNERS_STYLESHEET', '
	
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	border-radius: 50%;
	
');

/* Tooltips */
define('TOOLTIP_STYLESHEET', '
	
	background: ' . SCHEME_1_COLOR_1 . ';
	
	color: ' . SCHEME_1_COLOR_1 . '; /* influencia na cor das setas */
	font-size: 90%;
	
	border: 1px solid ' . SCHEME_1_COLOR_4 . ';
	
	' . DEFAULT_BOX_SHADOW . '
	
	' . DEFAULT_BORDER_RADIUS . '
	
	-webkit-background-clip: padding-box;
	-moz-background-clip: padding;
	background-clip: padding-box;
	
	line-height: normal;
');
define('TOOLTIP_CONTENT_STYLESHEET', '
	
	padding: ' . ( DEFAULT_SPACING * 2 ) . 'px;
	
	color: ' . SCHEME_1_COLOR_1_COMPLEMENTARY . ';
	
');

/* Default contact view */
define('CONTACT_STYLESHEET', '
	
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	
	position:relative;
	display: inline-block;
	
	font-family: ' . DEFAULT_FONT_FAMILY . ';
	color: ' . SCHEME_1_COLOR_1_COMPLEMENTARY . ';
	font-size: 120%;
	text-align: center;
	margin: 0 0 ' . DEFAULT_SPACING . 'px;
	padding: ' . ( DEFAULT_SPACING * 2 ) . 'px;
	
	' . DEFAULT_BORDER . '
	
	white-space: normal;
	text-shadow: ' . DEFAULT_TEXT_SHADOW . ';
	
	' . ( css_boxshadow() ) . '
	
	background: ' . SCHEME_1_COLOR_1 . ';
	
	z-index: 2;
	
');

/*
 --------------------------------------------------------------------------------------------------
 Styles sets definitions
 --------------------------------------------------------------------------------------------------
 **************************************************************************************************
 **************************************************************************************************
 */



define('LINK_COLOR_ALT', LINK_HOVER_COLOR);
define('LINK_BACKGROUND_ALT', INPUTS_BUTTONS_BACKGROUND);







function css_transition( $at = DEFAULT_TRANSITION ){
	
	return "
	-webkit-transition: $at;
	-moz-transition: $at;
	-khtml-transition: $at;
	-ms-transition: $at;
	-o-transition: $at;
	-icab-transition: $at;
	transition: $at;
	";
	
}
function css_boxshadow( $bs = DEFAULT_BOX_SHADOW ){
	
	return "
	-webkit-box-shadow: $bs; 
	-moz-box-shadow: $bs;
	-khtml-box-shadow: $bs;
	-ms-box-shadow: $bs;
	-o-box-shadow: $bs;
	-icab-box-shadow: $bs;
	box-shadow: $bs;
	";
	
}
function css_textshadow( $ts='1px 1px 1px #000' ){
	
	return "
	text-shadow: $ts;
	";
	
}
function css_display_inline_block(){
	
	return "
	display: -moz-inline-stack;
	display: inline-block;
	zoom: 1;
	*display: inline;
	";
	
}


function css_box_sizing( $bs = 'border-box' ){
	
	return "
	
	-webkit-box-sizing: $bs;
	-moz-box-sizing: $bs;
	box-sizing: $bs;
	
	";
	
}





?>
@charset "UTF-8";




<?php include( 'reset.css.php' ); ?>

<?php include( 'font_icons.css.php' ); ?>

<?php include( 'html.css.php' ); ?>

<?php include( 'template.css.php' ); ?>





/*
 **************************************************************************************************
 **************************************************************************************************
 --------------------------------------------------------------------------------------------------
 Table form
 --------------------------------------------------------------------------------------------------
 */

table.table-form{
	
	font-size: 100%;
	text-align: left;
	
}
	table.table-form tr.table-form-row,
	table.table-form td.table-form-content,
	table.table-form td.table-form-right{
		
		vertical-align: top;
		border: none;
		background: none;
		padding: 0;
		
	}
	table.table-form > tr:hover,
	table.table-form > tr:hover > td
	table.table-form > tbody > tr:hover,
	table.table-form > tbody > tr:hover > td{
		
		border-top: none;
		border-bottom: none;
		
	}
	table.table-form .table-form-content,
	table.table-form .table-form-right{
		
		
		
	}
	table.table-form .table-form-content{
		
		position: relative;
		z-index: 1;
		
	}
	table.table-form .table-form-right{
		
		width: 1px;
		
	}
	table.table-form fieldset{
		
		display: block;
		width: auto;
		margin: 0 <?= DEFAULT_SPACING/2; ?>px <?= DEFAULT_SPACING; ?>px;
		
	}
	table.table-form .table-form-right fieldset{
		
		margin-right: 0;
		
	}
	
	table.table-form td input[type=text],
	table.table-form td input[type=number],
	table.table-form td input[type=button],
	table.table-form td textarea,
	table.table-form td select,
	table.table-form td .button{
		
		margin-bottom: <?= DEFAULT_SPACING; ?>px;
		
	}

/*
 --------------------------------------------------------------------------------------------------
 Table form
 --------------------------------------------------------------------------------------------------
 **************************************************************************************************
 **************************************************************************************************
 */




















hr{
	position: relative;
	display: block;
	height: 1px;
	border: none;
	border-bottom: 1px solid rgba(66, 99, 135, .2);
}



.divisor-h{
	
	position: relative;
	display: block;
	clear: both;
	height: 2px;
	overflow: hidden;
	margin-bottom:<?= DEFAULT_SPACING; ?>px;
	
	background-image: url('<?= THEME_IMAGE_DIR_URL; ?>/divisor-h.png');
	
}

.hidden{
	
	display: none !important;
	
}
.clear{
	position:relative;
	display:block;
	height:0px;
	overflow:hidden;
	clear: both;
	zoom:1;
}
.fn{
	float:none;
}
.fl{
	float:left;
}
.fr{
	float:right;
}
.ta-left{
	text-align:left;
}
.ta-right{
	text-align:right;
}
.ta-center{
	text-align:center;
}






.select-on #top-bar{
	
	display:none;
	
}

#fake-top-block{
	
	position:relative;
	display:block;
	
}



























/*************************************************************************/
/*************************************************************************/
/******************************** Forms **********************************/

.dinamic-fields-wrapper{
	position:relative;
	<?= css_display_inline_block(); ?>;
	background-color: rgba(41, 89, 130, 0.05);
	padding:<?= DEFAULT_SPACING; ?>px;
	
	<?= DEFAULT_BORDER_RADIUS; ?>
	
	margin-left:<?= DEFAULT_SPACING/2; ?>px;
	margin-right:<?= DEFAULT_SPACING/2; ?>px;
	margin-bottom:<?= DEFAULT_SPACING; ?>px;
}
.field-wrapper{
	position:relative;
	display:block;
	padding: <?= DEFAULT_SPACING/2; ?>px;
	margin-bottom:<?= DEFAULT_SPACING; ?>px;
}
.vui-field-wrapper-inline{
	position:relative;
	<?= css_display_inline_block(); ?>;
	padding: <?= DEFAULT_SPACING / 2; ?>px;
	margin-bottom:<?= DEFAULT_SPACING; ?>px;
}
.field-wrapper input,
.vui-field-wrapper-inline input{
	
	margin-bottom: 0;
	
}

input[type=text].code{
	min-width:<?= DEFAULT_SPACING*2; ?>px;
	width:120px;
}
input[type=text].unit{
	min-width:1px;
	width:60px;
}
input[type=text].product-provider-tax{
	min-width: 80px;
	width: 80px;
}
input[type=text].provider,
select.provider{
	min-width:<?= DEFAULT_SPACING*2; ?>px;
	width:200px;
}
input[type=text].warranty,
select.warranty,
input[type=text].custom-warranty,
select.custom-warranty{
	min-width:<?= DEFAULT_SPACING*2; ?>px;
	width:200px;
}
input[type=text].cost-price,
input[type=number].cost-price,
select.cost-price{
	min-width:<?= DEFAULT_SPACING*2; ?>px;
	width:100px;
}
input[type=text].add-num-email,
input[type=text].add-num-phone,
input[type=text].add-num-contact,
input[type=text].add-num-website,
input[type=text].add-num-field,
input[type=number].add-num-email,
input[type=number].add-num-phone,
input[type=number].add-num-contact,
input[type=number].add-num-website,
input[type=number].add-num-field{
	
	min-width: 70px;
	width: 70px;
	text-align: center;
	
}
input[type=text].email-title,
input[type=text].phone-title,
input[type=text].contact-title,
input[type=text].website-title,
input[type=text].address-title{
	
	min-width: 100px;
	width: 150px;
	
}
select.contact-id{
	min-width:0px;
	width:350px;
}
input[type=text].dynamic-email{
	min-width:250px;
	width:250px;
}
input[type=text].phone-area-code{
	
	min-width: 50px;
	width: 50px;
	
}
input[type=text].phone-number{
	min-width: 120px;
	width: 120px;
}
input[type=text].phone-extension-number{
	min-width:80px;
	width:80px;
}
input.field-key{
	
	min-width: 70px;
	width: 70px;
	
}
input.field-label{
	
	min-width: 220px;
	width: 220px;
	
}

/******************************** Forms **********************************/
/*************************************************************************/
/*************************************************************************/

/*************************************************************************/
/*************************************************************************/
/****************************** Companies ********************************/


th.company-contacts,
td.company-contacts{
	
}
.list-info-wrapper-website,
.list-info-wrapper{
	
	position:relative;
	<?= css_display_inline_block(); ?>;
	padding: 3px 8px;
	line-height:16px;
	
	<?= DEFAULT_BORDER_RADIUS; ?>
	
	margin: 0;
	
}
.list-info-wrapper-website:hover,
.list-info-wrapper:hover{
	background-color: rgba(255, 255, 255, 0.5);
}
.list-info-thumb-wrapper{
	position:relative;
	<?= css_display_inline_block(); ?>;
	border-radius: 50%;
	margin-right: 3px;
	width: 16px;
	height: 16px;
	overflow: hidden;
	background: url('<?= THEME_IMAGE_DIR_URL; ?>/icon-18-no-image.png') no-repeat center center;
}
.list-info-thumb-wrapper img{
	position:relative;
	<?= css_display_inline_block(); ?>;
	width: 16px;
	height: 16px;
}
.list-info-wrapper-website-facebook{
	padding-left: 28px;
	background: url('<?= THEME_IMAGE_DIR_URL; ?>/icon-16-facebook.png') no-repeat 8px center;
}





/****************************** Companies ********************************/
/*************************************************************************/
/*************************************************************************/

.visible{
	display: block !important;
}
.invisible{
	display: none !important;
}

.component-head{
	
	position: relative;
	display: inline-block;
	
}
.component-head h1{
	
	margin-right: <?= DEFAULT_SPACING; ?>px;
	
}

.form-actions,
.pagination,
.filter{
	
	position: relative;
	display: inline-block;
	margin-bottom: 0;
	margin-right: <?= DEFAULT_SPACING * 2; ?>px;
	text-align: center;
	padding: <?= DEFAULT_SPACING; ?>px 0;
	background: none;
	
}
.form-actions *,
.pagination *,
.filter *,
.component-head{
	
	margin-bottom: 0 !important;
	
}

.form-actions .button,
.pagination .button{
	text-align: center;
	margin-bottom: 0;
}
.pagination .current,
.pagination .inactive{
	opacity:.4;
}

#toolbar .form-actions{
	
	padding: 0;
	margin: 0;
	
}



.add-menu-component,
.add-menu-component-item{
	position:relative;
	<?= css_display_inline_block(); ?>;
	border:none;
	padding:10px;
	margin:0 5px <?= DEFAULT_SPACING; ?>px;
	color:#3b4b58;

	background-image: -ms-radial-gradient(center top, ellipse farthest-corner, rgba(255, 255, 255, 0.80) 0%, rgba(255, 255, 255, 0.80) 100%);
	background-image: -moz-radial-gradient(center top, ellipse farthest-corner, rgba(255, 255, 255, 0.80) 0%, rgba(255, 255, 255, 0.80) 100%);
	background-image: -o-radial-gradient(center top, ellipse farthest-corner, rgba(255, 255, 255, 0.80) 0%, rgba(255, 255, 255, 0.80) 100%);
	background-image: -webkit-gradient(radial, center top, 0, center top, 509, color-stop(0, rgba(255, 255, 255, 0.80)), color-stop(1, rgba(255, 255, 255, 0.80)));
	background-image: -webkit-radial-gradient(center top, ellipse farthest-corner, rgba(255, 255, 255, 0.80) 0%, rgba(255, 255, 255, 0.80) 100%);
	background-image: radial-gradient(ellipse farthest-corner at center top, rgba(255, 255, 255, 0.80) 0%, rgba(255, 255, 255, 0.80) 100%);
	
	text-shadow: 0px 1px 0px #fff;
	box-shadow: 0px 2px 4px 0px rgba(0, 49, 87, .1);
	border-radius: <?= DEFAULT_BORDER_RADIUS; ?>px;
}
.add-menu-component:hover,
.add-menu-component:focus,
.add-menu-component-item:hover,
.add-menu-component-item:focus{
	color:#3b4b58;

	background: #ffffff;
	
	text-shadow: 0px 1px 0px #fff;
	box-shadow: 0px 4px 10px 0px rgba(0, 49, 87, .3);
}



.thumb-wrapper{
	
	position: relative;
	display: inline-block;
	margin: 0 auto;
	
}
.thumb-image-wrapper{
	
	position: relative;
	display: inline-block;
	-webkit-border-radius: 50%;
	border-radius: 50%;
	margin: 0 auto;
	overflow: hidden;
	
	border: 5px solid <?= SCHEME_1_COLOR_1; ?>;
	
	<?= FULL_ROUNDED_CORNERS_STYLESHEET; ?>
	
	<?= DEFAULT_BOX_SHADOW; ?>
	
}

.contact-thumb-wrapper{
	-webkit-border-radius: 50%;
	border-radius: 50%;
	display: inline-block;
	margin: 0 auto;
}
.contact-thumb-wrapper .company-logo-thumb{
	position: relative;
	display: inline-block;
}
.contact-thumb-wrapper img{
	
	display: block;
	-webkit-border-radius: 50%;
	border-radius: 50%;
	width:24px;
	height:24px;
	
}
.contact-thumb-wrapper.edit-page,
.contact-photo-wrapper.edit-page{
	
	<?= DEFAULT_BORDER_RADIUS; ?>
	
	display: table;
	margin: 0 auto <?= DEFAULT_SPACING/2; ?>px;
}
.contact-thumb-wrapper.edit-page img,
.contact-photo-wrapper.edit-page img{
	
	<?= DEFAULT_BORDER_RADIUS; ?>
	
	display: block;
	padding:10px;
	background:#fff;
	
	width: 128px;
	height: 128px;
	
}
.contact-photo-wrapper.edit-page img{
	
	width: auto;
	height: auto;
	
}


td.contact-thumb,
th.company-thumb{
	
	width: 1px;
	
}
th.company-trading-name{
	
	width: 20%;
	
}
.company-thumb-wrapper{
	
	position: relative;
	display: inline-block;
	
	margin: 0 auto;
	
}
.company-thumb-wrapper .company-logo-thumb{
	position: relative;
	display: inline-block;
}
.company-thumb-wrapper img{
	
	<?= FULL_ROUNDED_CORNERS_STYLESHEET; ?>
	
	display: block;
	width:24px;
	height:24px;
}
.company-thumb-wrapper.edit-page,
.company-thumb-wrapper.edit-page{
	
	<?= DEFAULT_BORDER_RADIUS; ?>
	
	display: table;
	margin: 0 auto <?= DEFAULT_SPACING/2; ?>px;
}
.company-thumb-wrapper.edit-page img,
.contact-photo-wrapper.edit-page img{
	
	<?= DEFAULT_BORDER_RADIUS; ?>
	
	display: block;
	padding:10px;
	background:#fff;
	max-width:300px;
}
.contact-thumb-wrapper .contact-photo-thumb{
	position: relative;
	display: inline-block;
}


.vui-modal .contact-info-wrapper div.info-items{
	
	position: relative;
	height: 100%;
	overflow: auto;
	padding: <?= DEFAULT_SPACING; ?>px;
	margin-left: <?= ( DEFAULT_SPACING + 48 ); ?>px;
	
}
.contact .vui-radiobox{
	
	display: block;
	margin-bottom: 0;
	
}
.contact .vui-radiobox .list-info-wrapper{
	
	display: block;
	padding: <?= DEFAULT_SPACING; ?>px;
	
	z-index: 1;
	
}
.contact .vui-radiobox .content{
	
	display: block;
	
}
.contact .vui-radiobox .selected .list-info-wrapper{
	
	display: block;
	background: <?= $vui->colors->vui_base->hex_s; ?>;
	color: <?= $vui->colors->vui_base->get_ro_color()->hex_s; ?>;
	
}

.contact .vui-radiobox .check{
	
	display: none;
	
}


/*************************************************************************/
/*************************************************************************/
/************************** Contacts / Articles **************************/


.qtip.qtip-contact-info{
	
	max-width:600px;
	
}



.live-search-result-wrapper,
.contact-list-live-search{
	
}
.article-list-live-search .info-wrapper,
.article-list-live-search .article-item,
.contact-list-live-search .info-wrapper,
.contact-list-live-search .contact-item{
	
	position: relative;
	display: block;
	height: auto;
	min-height: 0;
	
	padding: 0;
	
}
.article-list-live-search .article-item,
.contact-list-live-search .contact-item{
	
	padding: <?= ( DEFAULT_SPACING / 2 ); ?>px;
	padding-right: 0;
	
	color:<?= VUI_FONT_COLOR; ?>;
	
}
.article-list-live-search .article-item:hover,
.contact-list-live-search .contact-item:hover{
	
	color: <?= $vui->colors->vui_base->get_ro_color()->hex_s; ?>;
	
	background: <?= $vui->colors->vui_base->hex_s; ?>;
	
}
.article-list-live-search .article-item:hover .article-title-content,
.contact-list-live-search .contact-item:hover .contact-name-content{
	
	color:<?= INPUTS_BUTTONS_COLOR_SEC; ?>;
	
}
.article-list-live-search .article-item:hover .search-term-highlight,
.contact-list-live-search .contact-item:hover .search-term-highlight{
	
	color:<?= INPUTS_BUTTONS_COLOR_SEC; ?>;
	background: none;
	font-weight: normal;
	
}
.article-list-live-search .thumb-wrapper,
.contact-list-live-search .thumb-wrapper{
	
	position: absolute;
	display: block;
	
	top: 0;
	
	width: 48px;
	height: 100%;
	
	border: none;
	border-radius: 0;
	box-shadow: none;
	
	background: none;
	
	line-height:<?= DEFAULT_LINE_HEIGHT; ?>;
	overflow: visible;
	
}
.article-list-live-search .thumb-wrapper-content,
.contact-list-live-search .thumb-wrapper-content{
	
	position: absolute;
	display: block;
	
	top: 50%;
	margin-top: -24px;
	
	width: 48px;
	height: 48px;
	
	border: 2px solid <?= SCHEME_1_COLOR_1; ?>;
	
	background: url('<?= THEME_IMAGE_DIR_URL; ?>/icon-default-no-image.png') no-repeat center center <?= SCHEME_1_COLOR_1; ?>;
	background-size: 100% 100%;
	
	-webkit-border-radius: 50%;
	border-radius: 50%;
	overflow: hidden;
	
	<?= FULL_ROUNDED_CORNERS_STYLESHEET; ?>
	
	<?= DEFAULT_BOX_SHADOW; ?>
	
}
.article-list-live-search .article-title-wrapper,
.contact-list-live-search .contact-name-wrapper{
	
	position: relative;
	display: table;
	vertical-align: middle;
	min-height: 48px;
	padding: <?= ( DEFAULT_SPACING ); ?>px;
	margin-left: 48px;
	
}

.article-list-live-search .article-title-content
.contact-list-live-search .contact-name-content{
	
	vertical-align: middle;
	display: table-cell;
	
}





.vui .contact-item-wrapper{
	
	position: relative;
	display: inline-block;
	
	width: 225px;
	
	margin: 0 <?= ( DEFAULT_SPACING / 2 ); ?>px <?= DEFAULT_SPACING; ?>px;
	
}

.vui .contact-item-wrapper .contact-item{
	
	<?= CONTACT_STYLESHEET; ?>
	
	width: 100%;
	
	z-index: 1;
	
}
.vui .contact-item-wrapper .contact-item .contact-thumb-wrapper{
	
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	
	position: relative;
	display: block;
	
	text-align: center;
	
	border: 5px solid <?= SCHEME_1_COLOR_1; ?>;
	
	width: 96px;
	height: 96px;
	
	background: url('<?= THEME_IMAGE_DIR_URL; ?>/icon-default-no-image.png') no-repeat center center <?= SCHEME_1_COLOR_1; ?>;
	background-size: 100% 100%;
	
	-webkit-border-radius: 50%;
	border-radius: 50%;
	overflow: hidden;
	
	<?= FULL_ROUNDED_CORNERS_STYLESHEET; ?>
	
	<?= DEFAULT_BOX_SHADOW; ?>
	
	margin-bottom: <?= DEFAULT_SPACING; ?>px;
	
}
.vui .contact-item-wrapper .contact-item .contact-thumb-content,
.vui .contact-item-wrapper .contact-item .contact-thumb-content img{
	
	position: relative;
	display: inline-block;
	
	width: 100%;
	height: 100%;
	
}

.vui .contact-item-wrapper .contact-delete-button-wrapper{
	
	position: absolute;
	display: none;
	right: 0;
	top: 0;
	
	z-index: 2;
	
}
.vui .contact-item-wrapper:hover .contact-delete-button-wrapper{
	
	display: block;
	
}
.vui .contact-item-wrapper .contact-title-field,
.vui .contact-item-wrapper .contact-company-contact-field{
	
	width: 100%;
	
}




/************************** Contacts / Articles **************************/
/*************************************************************************/
/*************************************************************************/
























@-moz-keyframes fade {
	0% {
		background-color: rgba(255, 245, 202, 0.6);
	}
	50% {
		background-color: rgba(255, 245, 202, 1);
	}
	100% {
		background-color: rgba(255, 245, 202, 0.6);
	}
}

@-o-keyframes fade {
	0% {
		background-color: rgba(255, 245, 202, 0.6);
	}
	50% {
		background-color: rgba(255, 245, 202, 1);
	}
	100% {
		background-color: rgba(255, 245, 202, 0.6);
	}
}

@keyframes fade {
	0% {
		background-color: rgba(255, 245, 202, 0.6);
	}
	50% {
		background-color: rgba(255, 245, 202, 1);
	}
	100% {
		background-color: rgba(255, 245, 202, 0.6);
	}
}

@-webkit-keyframes fade {
	0% {
		background-color: rgba(255, 245, 202, 0.6);
	}
	50% {
		background-color: rgba(255, 245, 202, 1);
	}
	100% {
		background-color: rgba(255, 245, 202, 0.6);
	}
}

















/*
 **************************************************************************************************
 **************************************************************************************************
 --------------------------------------------------------------------------------------------------
 VUI - Via CMS UI
 --------------------------------------------------------------------------------------------------
 */











.vui-box-level-1{
	
	background: <?= $vui->colors->vui_light->hex_s; ?>;
	
	border: none;
	margin: 0;
	
}
.vui-box-level-2{
	
	background: <?= $vui->colors->vui_lighter->hex_s; ?>;
	
	padding: <?= VUI_SPACING; ?>px;
	
}

.vui-box-level-3{
	
	background: #f6f8fa;
	
	border: <?= VUI_BORDER; ?>;
	
	margin: <?= VUI_SPACING; ?>px;
	padding: <?= VUI_SPACING; ?>px;
	
}


/* VUI Data list */
.vui-data-list,
.vui-data-list tr.vui-data-list-row,
.vui-data-list td.vui-data-list-col,
.vui-data-list th.vui-data-list-col{
	
	background: none;
	
	color: <?= VUI_FONT_COLOR; ?>;
	
	border: none;
	
}
.vui-data-list tr.vui-data-list-row{
	
}

.vui-data-list td.vui-data-list-col{
	
	border-bottom: <?= VUI_BORDER; ?>;
	
}
.vui-data-list th.vui-data-list-col{
	
	border-bottom: <?= VUI_BORDER; ?>;
	
}














/*
 --------------------------------------------------------------------------------------------------
 VUI - Via CMS UI
 --------------------------------------------------------------------------------------------------
 **************************************************************************************************
 **************************************************************************************************
 */





















/* Comuns do Via UI */
<?php include( 'msg.css.php' ); ?>

<?php include( 'params.css.php' ); ?>

<?php include( 'info_cards.css.php' ); ?>

<?php include( 'tabs.css.php' ); ?>

<?php include( 'modals.css.php' ); ?>

<?php include( 'search.css.php' ); ?>

<?php include( 'buttons.css.php' ); ?>

<?php include( 'jquery_switch.css.php' ); ?>


/* De terceiros */
<?php include( 'jquery_ui.css.php' ); ?>

<?php include( 'qtip2.css.php' ); ?>

<?php include( 'tinymce.css.php' ); ?>


/* Componentes */
<?php include( 'dashboard.css.php' ); ?>

<?php include( 'articles.css.php' ); ?>

<?php include( 'vesm.css.php' ); ?>

<?php include( 'adjustments.css.php' ); ?>




.dynamic-field-item .item{
	
	border: 1px solid transparent; ?>;
	display: inline-block;
	padding: <?= VUI_SPACING / 2; ?>px;
	cursor: text;
	
}
.dynamic-field-item .item:hover{
	
}








.inline-edit{
	
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	
	position: relative;
	display: inline-block;
	
	border: 1px solid transparent; ?>;
}
.inline-edit:hover{
	
	border: 1px solid <?= $vui->colors->vui_base->rgba_s( 60 ); ?>;
	
}
.inline-edit:before{
	
	font-family: "vecms-icons";
	content: "\e60b   ";
	opacity: 0.3;
	
}
.inline-edit:hover:before{
	
	opacity: 1;
	
}
.inline-edit .inline-edit-input-wrapper,
.inline-edit input.inline-edit-input{
	
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	
	position: absolute;
	display: inline-block;
	
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	
	padding: 0;
	margin: 0;
	
	text-align: center;
	vertical-align: middle;
	
}





.live-update-container{
	
	padding: <?= VUI_SPACING * 2; ?>px;
	height: 100%;
	
}
.live-update-inner{
	
	overflow: auto;
	height: 100%;
	
}



.live-update-container .contact-form{
	
	min-width: 600px;
	
}

.live-update-inner .contact-image{
	
	position: relative;
	
}
.live-update-inner .contact-image .modal-file-picker{
	
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	opacity: 0;
	padding: 0;
	margin: 0;
	
}




.sortable{
	
	display: block;
	
}
.sortable-item{
	
	position: relative;
	display: block;
	
	margin-right: <?= VUI_SPACING / 2; ?>px;
	margin-bottom: <?= VUI_SPACING / 2; ?>px;
	
	border-left: 3px solid <?= $vui->colors->vui_base->hex_s; ?>;
	background-color: <?= $vui->colors->vui_lighter->hex_s; ?>;
	color: <?= $vui->colors->vui_base->hex_s; ?>;
	
	
}
.sortable-item-inner{
	
	position: relative;
	display: block;
	
}
.sortable-item .contact-email{
	
	position: relative;
	
	white-space: nowrap;
	
}
.sortable-item .remove{
	
	float: right;
	
	overflow: hidden;
	text-indent: -1000px;
	
	width: 24px;
	
	background-image: url('<?= $vui->svg_file( 'remove', $vui->colors->vui_base->hex_s ); ?>');
	background-repeat: no-repeat;
	background-position: center;
	background-size: 80%;
	background-color: transparent;
	
	border: 1px solid transparent;
	
	cursor: pointer;
	
	opacity: 0.2;
	
}
.sortable-item:hover .remove{
	
	opacity: 0.5;
	
}
.sortable-item .remove:hover{
	
	border: 1px solid transparent; ?>;
	opacity: 1;
	
}
.sortable-item .key{
	
	display: none;
	
}
.sortable-item .title{
	
	background-color: <?= $vui->colors->vui_base->rgba_s( 30 ); ?>;
	
}
.sortable-item:hover{
	
	background-color: <?= $vui->colors->vui_base->rgba_s( 10 ); ?>;
	
}
.sortable-item.sorting{
	
	opacity: .3;
	background-color: <?= $vui->colors->vui_lighter->hex_s; ?>;
	box-shadow: 0px 20px 50px <?= $vui->colors->vui_base->darken( 25, TRUE )->rgba_s( 30 ); ?>;
	
}

.sortable-item .sortable-handle{
	
	cursor: move;
	background-color: <?= $vui->colors->vui_base->rgba_s( 30 ); ?>;
	
}
.sortable-item .sortable-handle:before{
	
	font-family: "vecms-icons";
	content: "\e63d";
	
}














.vui-modal .view-user-submit-inner{
	
	overflow: auto;
	height: 100%;
	
}













	.vui .controls-menu{
		
		position:relative;
		<?= css_display_inline_block(); ?>;
		margin: 0;
		padding: 0;
		
	}
	.vui .controls-menu .btn{
		
		position:relative;
		<?= css_display_inline_block(); ?>;
		margin: 0;
		font-size: inherit;
		border:none;
		text-decoration:none;
		outline: none;
		
		color: <?= VUI_FONT_COLOR; ?>;
		
	}
	.vui .controls-menu .btn,
	.vui .controls-menu .component-name{
		
		position:relative;
		<?= css_display_inline_block(); ?>;
		margin: 0;
		font-size: inherit;
		border:none;
		text-decoration:none;
		outline: none;
		text-shadow: <?= DEFAULT_TEXT_SHADOW; ?>;
		vertical-align: middle;
		
	}
	.vui .controls-menu .btn .content{
		
		line-height: 19px;
		
	}
	
	.vui .controls-menu ul,
	.vui .controls-menu li{
		
		position:relative;
		<?= css_display_inline_block(); ?>;
		padding:0;
		margin:0;
		z-index:1;
		
	}
	.vui .controls-menu ul.main-menu{
		position: relative;
		z-index: 1000;
	}
	.vui .controls-menu ul.secondary-menu{
		position: relative;
		z-index: 1;
	}
	.vui .controls-menu ul.main-menu > li,
	.vui .controls-menu ul.secondary-menu > li{
		
		float: left;
		
	}
	
	.vui .controls-menu ul{
		padding:0;
	}
	
	.vui .controls-menu li:hover,
	.vui .controls-menu li:focus{
		z-index:1000;
	}
	.vui .controls-menu li ul{
		
		position:absolute;
		display:none;
		top:100%;
		left:0;
		padding:0;
		text-align:left;
		
		background-color: <?= $vui->colors->vui_lighter->hex_s; ?>;
		
		border: <?= VUI_BORDER; ?>;
		border-left: 3px solid <?= $vui->colors->vui_base->hex_s; ?>;
		
		box-shadow: 0 1px 50px <?= $vui->colors->vui_extra_3->rgba_s( 30 ); ?>;
		
		border-radius: <?= VUI_BORDER_RADIUS; ?>;
		
		z-index: 0;
	}
	.vui .controls-menu li li ul{
		position:absolute;
		display:none;
		top:-<?= DEFAULT_SPACING; ?>px;
		left:100%;
	}
	.vui .controls-menu li a,
	.vui .controls-menu li button{
		
		position:relative;
		<?= css_display_inline_block(); ?>;
		
		color: <?= VUI_FONT_COLOR; ?>;
		
		font-size:<?= DEFAULT_FONT_SIZE; ?>;
		text-decoration: none;
		text-shadow:none;
		white-space:nowrap;
		
	}
	
	.vui .controls-menu .btn:hover,
	.vui .controls-menu .btn:focus,
	.vui .controls-menu .btn.active,
	.vui .controls-menu li:hover > a,
	.vui .controls-menu li:hover > button,
	.vui .controls-menu li a:hover,
	.vui .controls-menu li button:hover,
	.vui .controls-menu li:focus > a,
	.vui .controls-menu li:focus > button,
	.vui .controls-menu li a:focus,
	.vui .controls-menu li button:focus,
	.vui .controls-menu li a.active,
	.vui .controls-menu li button.active,
	.vui .controls-menu li a.btn.profiler-on
	.vui .controls-menu li button.btn.profiler-on{
		
		background-color: <?= $vui->colors->vui_base->rgba_s( 20 ); ?>;
		
		color: <?= $vui->colors->vui_base->hex_s; ?>;
		
		z-index: 1;
		
	}
	.vui .controls-menu li li,
	.vui .controls-menu li li a,
	.vui .controls-menu li li button,
	.vui .controls-menu li li .btn{
		
		text-align: left;
		display: block;
		
	}
	.vui .controls-menu li li button{
		
		width: 100%;
		
	}
	.vui .controls-menu li li button .content{
		
		display: block;
		width: 100%;
		
	}
	.vui .controls-menu li li a,
	.vui .controls-menu li li button{
		
		padding-left: <?= DEFAULT_SPACING; ?>px;
		padding-right: <?= DEFAULT_SPACING; ?>px;
		
	}
	.vui .controls-menu li:hover > ul,
	.vui .controls-menu li:focus > ul{
		display:block;
		z-index: 0;
	}
	
	.vui .controls-menu .only-icon{
		
		border-radius: 0;
		
	}
	
	


.vui .no-multi-selection-action{
	
	cursor: default !important;
	opacity: 0.3;
	
}
.vui ul.no-multi-selection-action li:hover ul{
	
	display: none !important;
	
}





.vui .vui-address-box{
	
	position: relative;
	<?= css_display_inline_block(); ?>;
	
}
.vui .vui-address-box .vui-address-box-inner > .title,
.vui .vui-address-box .vui-address-box-inner > .content,
.vui .vui-address-box .vui-address-box-inner .street,
.vui .vui-address-box .vui-address-box-inner .city-state,
.vui .vui-address-box .vui-address-box-inner .postal-code,
.vui .vui-address-box .vui-address-box-inner .country{
	
	position: relative;
	display: block;
	
}
.vui .vui-address-box .vui-address-box-inner .neighborhood{
	
	display: block;
	
}
.vui .vui-address-box .vui-address-box-inner .public-area:after,
.vui .vui-address-box .vui-address-box-inner .complement:after{
	
	content: ".";
	display: block;
	height: 0;
	clear: both;
	visibility: hidden;
	
}



