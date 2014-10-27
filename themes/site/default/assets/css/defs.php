<?php

if ( ! defined( 'VUI_SCALE' ) ) define( 'VUI_SCALE', 1 );
if ( ! defined( 'VUI_SPACING' ) ) define( 'VUI_SPACING', 1 * VUI_SCALE );

if ( ! defined( 'VUI_DEFAULT_FONT_FAMILY' ) ) define( 'VUI_DEFAULT_FONT_FAMILY', '\'Roboto\', \'Arial\', sans-serif' );
if ( ! defined( 'VUI_SEC_FONT_FAMILY' ) ) define( 'VUI_SEC_FONT_FAMILY', '\'Roboto Condensed\', \'Arial\', sans-serif' );
if ( ! defined( 'VUI_MONO_FONT_FAMILY' ) ) define( 'VUI_MONO_FONT_FAMILY', '\'Droid Sans Mono\', \'Menlo\', \'Monaco\', monospace' );

if ( ! defined( 'VUI_DEFAULT_FONT_COLOR' ) ) define( 'VUI_DEFAULT_FONT_COLOR', $vui->colors->vui_dark->hex_s );
if ( ! defined( 'VUI_SEC_FONT_COLOR' ) ) define( 'VUI_SEC_FONT_COLOR', $vui->colors->vui_darker->hex_s );

if ( ! defined( 'VUI_DEFAULT_FONT_SIZE' ) ) define( 'VUI_DEFAULT_FONT_SIZE', ( 1 * VUI_SCALE ) . 'em' );
if ( ! defined( 'VUI_DEFAULT_FONT_WEIGHT' ) ) define( 'VUI_DEFAULT_FONT_WEIGHT', 'normal' );
if ( ! defined( 'VUI_DEFAULT_LINE_HEIGHT' ) ) define( 'VUI_DEFAULT_LINE_HEIGHT', ( 1.5 * VUI_SCALE ) . 'em' );

if ( ! defined( 'VUI_DEFAULT_BORDER' ) ) define( 'VUI_DEFAULT_BORDER', '1px solid ' . $vui->colors->vui_extra_3->rgba_s( 40 ) );
if ( ! defined( 'VUI_SEC_BORDER' ) ) define( 'VUI_SEC_BORDER', '1px solid ' . $vui->colors->vui_lighter->rgba_s( 200 ) );

if ( ! defined( 'VUI_DEFAULT_BORDER_RADIUS' ) ) define( 'VUI_DEFAULT_BORDER_RADIUS', '0.25em' );

if ( ! defined( 'VUI_DEFAULT_TRANSITION' ) ) define( 'VUI_DEFAULT_TRANSITION', 'all 0.2s ease-in-out' );


if ( ! defined( 'VUI_DEFAULT_SITE_WIDTH' ) ) define( 'VUI_DEFAULT_SITE_WIDTH', '70%' );
if ( ! defined( 'VUI_SITE_WIDTH_480_L' ) ) define( 'VUI_SITE_WIDTH_480_L', '95%' );
if ( ! defined( 'VUI_SITE_WIDTH_480_640' ) ) define( 'VUI_SITE_WIDTH_480_640', '90%' );
if ( ! defined( 'VUI_SITE_WIDTH_640_960' ) ) define( 'VUI_SITE_WIDTH_640_960', '90%' );
if ( ! defined( 'VUI_SITE_WIDTH_960_1280' ) ) define( 'VUI_SITE_WIDTH_960_1280', '90%' );
if ( ! defined( 'VUI_SITE_WIDTH_1280_1400' ) ) define( 'VUI_SITE_WIDTH_1280_1400', '80%' );
if ( ! defined( 'VUI_SITE_WIDTH_1400_1920' ) ) define( 'VUI_SITE_WIDTH_1400_1920', '75%' );




/****************************************************/
/********************* Buttons **********************/

/* ------ Normal status ------ */

if ( ! defined( 'VUI_BUTTONS_FONT_FAMILY' ) ) define('VUI_BUTTONS_FONT_FAMILY', VUI_SEC_FONT_FAMILY);
if ( ! defined( 'VUI_BUTTONS_FONT_SIZE' ) ) define('VUI_BUTTONS_FONT_SIZE', '90%');

if ( ! defined( 'VUI_BUTTONS_BACKGROUND_VUI_COLOR_NAME' ) ) define('VUI_BUTTONS_BACKGROUND_VUI_COLOR_NAME', 'vui_button_bg' );
if ( ! defined( 'VUI_BUTTONS_FOREGROUND_VUI_COLOR_NAME' ) ) define('VUI_BUTTONS_FOREGROUND_VUI_COLOR_NAME', 'vui_button_fg' );


/* ------ Hover status ------ */

if ( ! defined( 'VUI_BUTTONS_BACKGROUND_VUI_COLOR_NAME_HOVER' ) ) define('VUI_BUTTONS_BACKGROUND_VUI_COLOR_NAME_HOVER', 'vui_button_bg' );
if ( ! defined( 'VUI_BUTTONS_FOREGROUND_VUI_COLOR_NAME_HOVER' ) ) define('VUI_BUTTONS_FOREGROUND_VUI_COLOR_NAME_HOVER', 'vui_button_fg' );

/********************* Buttons **********************/
/****************************************************/

/****************************************************/
/********************* Selects **********************/

/* ------ Normal status ------ */



/* ------ Hover status ------ */



/********************* Selects **********************/
/****************************************************/
