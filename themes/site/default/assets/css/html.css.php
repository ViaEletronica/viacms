
.vui::-webkit-scrollbar-track,
.vui ::-webkit-scrollbar-track{
	
	-webkit-box-shadow: none;
	border: none;
	
}

.vui::-webkit-scrollbar,
.vui ::-webkit-scrollbar{
	
	width: 12px;
	border: none;
	
}

.vui::-webkit-scrollbar-thumb,
.vui ::-webkit-scrollbar-thumb{
	
	border: 5px solid <?= $vui->colors->vui_base->hex_s; ?>;
	background-color: <?= $vui->colors->vui_base->get_ro_color()->hex_s; ?>;
	
}


.vui body,
body.vui{
	
	position: relative;
	display: block;
	margin: 0;
	font-family: <?= VUI_DEFAULT_FONT_FAMILY; ?>;
	font-size: <?= VUI_DEFAULT_FONT_SIZE; ?>;
	line-height: <?= VUI_DEFAULT_LINE_HEIGHT; ?>;
	font-weight: <?= VUI_DEFAULT_FONT_WEIGHT; ?>;
	color: <?= VUI_DEFAULT_FONT_COLOR; ?>;
	
}

.vui strong{
	
	font-weight: bold;
	
}

/*
 *********************************************************
 ---------------------------------------------------------
 Paragraphs
 ---------------------------------------------------------
 */

.vui p{
	
	position: relative;
	display: block;
	margin: 0;
	margin-top: <?= VUI_SPACING; ?>em;
	margin-bottom: <?= VUI_SPACING; ?>em;
	
}

/*
 ---------------------------------------------------------
 Paragraphs
 ---------------------------------------------------------
 *********************************************************
 */

/*
 *********************************************************
 ---------------------------------------------------------
 Rules
 ---------------------------------------------------------
 */

.vui hr{
	
	position: relative;
	display: block;
	clear: both;
	height: 0;
	border: none;
	border-bottom: thin solid <?= $vui->colors->vui_darker->rgba_s( 30 ); ?>;
	margin: 0;
	margin-top: <?= VUI_SPACING; ?>em;
	margin-bottom: <?= VUI_SPACING; ?>em;
	
}

/*
 ---------------------------------------------------------
 Rules
 ---------------------------------------------------------
 *********************************************************
 */

/*
 *********************************************************
 ---------------------------------------------------------
 Pre, code, samp
 ---------------------------------------------------------
 */

.vui code,
.vui pre,
.vui samp{
	
	position: relative;
	<?= $vui->css->display_inline_block(); ?>
	
	font-family: <?= VUI_MONO_FONT_FAMILY; ?>;
	font-weight: normal;
	padding-left: <?= VUI_SPACING / 2; ?>em;
	padding-right: <?= VUI_SPACING / 2; ?>em;
	background-color: <?= $vui->colors->vui_light->hex_s; ?>;
	
}
.vui pre{
	
	position: relative;
	display: block;
	padding: <?= VUI_SPACING; ?>em;
	margin-bottom: <?= VUI_SPACING; ?>em;
	
	overflow: auto;
	
}
.vui pre code,
.vui pre samp{
	
	font-family: inherit;
	font-weight: inherit;
	padding: 0;
	background: none;
	
}

/*
 ---------------------------------------------------------
 Pre, code, samp
 ---------------------------------------------------------
 *********************************************************
 */

/*
 *********************************************************
 ---------------------------------------------------------
 Mark
 ---------------------------------------------------------
 */

.vui mark{
	
	background: <?= $vui->colors->vui_yellow->hex_s; ?>;
	color: <?= $vui->colors->vui_yellow->get_ro_color( 35 )->hex_s; ?>;
	
}

/*
 ---------------------------------------------------------
 Mark
 ---------------------------------------------------------
 *********************************************************
 */

/*
 *********************************************************
 ---------------------------------------------------------
 Blockquote
 ---------------------------------------------------------
 */

.vui blockquote,
.vui q{
	
	font-style: italic;
	
}
.vui blockquote:before,
.vui q:before{
	
	content: '';
	
}
.vui blockquote{
	
	padding: <?= VUI_SPACING; ?>em;
	margin: <?= VUI_SPACING * 2; ?>em;
	margin-left: <?= VUI_SPACING * 3; ?>em;
	background: <?= $vui->colors->vui_darker->rgba_s( 10 ); ?>;
	border-left: 0.5em solid <?= $vui->colors->vui_darker->rgba_s( 15 ); ?>;
	font-style: italic;
	
}

/*
 ---------------------------------------------------------
 Blockquote
 ---------------------------------------------------------
 *********************************************************
 */

/*
 *********************************************************
 ---------------------------------------------------------
 Headers
 ---------------------------------------------------------
 */

<?php
	
	$max = 250;
	$min = 120;
	$diff = $max - $min;
	$factor = $diff / 5;
	
?>

.vui h1,
.vui h2,
.vui h3,
.vui h4,
.vui h5,
.vui h6{
	
	font-family: <?= VUI_SEC_FONT_FAMILY; ?>;
	color: <?= VUI_SEC_FONT_COLOR; ?>;
	font-size: <?= ( $max ); ?>%;
	font-weight: 100;
	line-height: normal;
	margin-top: <?= VUI_SPACING; ?>em;
	margin-bottom: <?= VUI_SPACING; ?>em;
	
}
.vui h1{
	
	border-bottom: thin solid <?= $vui->colors->vui_darker->rgba_s( 30 ); ?>;
	padding-bottom: <?= VUI_SPACING / 3; ?>em;
	
}
.vui h2{
	
	font-size: <?= ( $min + ( $factor * 4 ) ); ?>%;
	
}
.vui h3{
	
	font-size: <?= ( $min + ( $factor * 3 ) ); ?>%;
	
}
.vui h4{
	
	font-size: <?= ( $min + ( $factor * 2 ) ); ?>%;
	
}
.vui h5{
	
	font-size: <?= ( $min + ( $factor * 1 ) ); ?>%;
	
}
.vui h6{
	
	font-size: <?= ( $min + ( $factor * 0 ) ); ?>%;
	
}

.vui header h1{
	
}

/*
 ---------------------------------------------------------
 Headers
 ---------------------------------------------------------
 *********************************************************
 */

/*
 *********************************************************
 ---------------------------------------------------------
 Links
 ---------------------------------------------------------
 */

.vui a{
	
	text-decoration: none;
	color: <?= $vui->colors->vui_base->hex_s; ?>;
	
}
.vui a:hover{
	
	color: <?= $vui->colors->vui_extra_1->hex_s; ?>;
	
}

/*
 ---------------------------------------------------------
 Links
 ---------------------------------------------------------
 *********************************************************
 */

/*
 **************************************************************************************************
 **************************************************************************************************
 --------------------------------------------------------------------------------------------------
 Figures
 --------------------------------------------------------------------------------------------------
 */

.vui figure{
	
	position: relative;
	display: block;
	
	padding: 0;
	margin: 0;
	margin-top: <?= VUI_SPACING; ?>em;
	margin-bottom: <?= VUI_SPACING; ?>em;
	
}
.vui figcaption{
	
	position: relative;
	display: block;
	
	font-size: 90%;
	
	margin: 0;
	padding: <?= VUI_SPACING / 2; ?>em 0;
	
}

/*
 --------------------------------------------------------------------------------------------------
 Figures
 --------------------------------------------------------------------------------------------------
 **************************************************************************************************
 **************************************************************************************************
 */

/*
 *********************************************************
 ---------------------------------------------------------
 List items
 ---------------------------------------------------------
 */

.vui ul,
.vui ol{
	
	position: relative;
	display: block;
	margin-top: <?= VUI_SPACING; ?>em;
	margin-bottom: <?= VUI_SPACING; ?>em;
	
}
.vui ul ol,
.vui ul ul,
.vui ol ol,
.vui ol ul{
	
	
	
}
.vui ol{
	
	counter-reset: ol-counter;
	
}
	.vui li{
		
		position: relative;
		display: list-item;
		
		margin-top: <?= VUI_SPACING; ?>em;
		margin-bottom: <?= VUI_SPACING; ?>em;
		margin-left: <?= VUI_SPACING; ?>em;
		
		padding-left: <?= VUI_SPACING / 2; ?>em;
		list-style-type: disc;
		list-style-position: inside;
		
	}
		.vui li li{
			
		}
	
	.vui ol li{
		
		display: block;
		margin-left: <?= VUI_SPACING + ( VUI_SPACING * 2 ) - ( VUI_SPACING / 2 ); ?>em;
		padding-left: 0;
		
	}
	.vui ol li:before{
		
		content: counter( ol-counter, decimal );
		counter-increment: ol-counter;
		
		position: absolute;
		display: block;
		margin-left: -<?= VUI_SPACING * 1.3; ?>em;
		padding-right: <?= VUI_SPACING + ( VUI_SPACING / 2 ); ?>em;
		text-align: center;
		width: <?= VUI_SPACING * 2; ?>em;
		
		font-family: <?= VUI_SEC_FONT_FAMILY; ?>;
		
	}

/*
 ---------------------------------------------------------
 List items
 ---------------------------------------------------------
 *********************************************************
 */

/*
 *********************************************************
 ---------------------------------------------------------
 Definitions lists
 ---------------------------------------------------------
 */

.vui dl,
.vui dt,
.vui dd{
	
	position: relative;
	display: block;
	margin-top: <?= VUI_SPACING; ?>em;
	margin-bottom: <?= VUI_SPACING; ?>em;
	
}

.vui dt{
	
	font-size: 130%;
	font-weight: bold;
	
}
.vui dd{
	
	left: <?= VUI_SPACING; ?>em;
	
}

/*
 ---------------------------------------------------------
 Definitions lists
 ---------------------------------------------------------
 *********************************************************
 */

/*
 *********************************************************
 ---------------------------------------------------------
 Details, summary
 ---------------------------------------------------------
 */

.vui details{
	
	position: relative;
	display: block;
	
	padding: <?= VUI_SPACING; ?>em;
	margin: <?= VUI_SPACING; ?>em;
	
	border: thin solid <?= $vui->colors->vui_lighter->darken( 8, TRUE )->hex_s; ?>;
	
}
.vui details[open]{
	
	border: thin solid <?= $vui->colors->vui_base->hex_s; ?>;
	
}
.vui details > summary{
	
	display: block;
	position: relative;
	
}
.vui details > summary *{
	
}
.vui details > summary:before,
.vui details > summary:after{
	
	content: '';
	position: absolute;
	top: -1em;
	right: -1em;
	bottom: -1em;
	left: -1em;
	background-color: yellow;
	<?= $vui->colors->vui_lighter->getCssGradient( 2 ); ?>
	
	z-index: -1;
	
}
.vui details > summary:after{
	
	background: none;
	z-index: 1;
	
}
.vui details[open] > summary{
	
	color: <?= $vui->colors->vui_base->hex_s; ?>;
	margin-bottom: <?= VUI_SPACING * 2; ?>em;
	
}

/* ---------------------------------------------------- */
/* Fix for Firefox */

@-moz-document url-prefix() {
	
	.vui details > summary{
		
		margin-bottom: <?= VUI_SPACING * 2; ?>em;
		
	}
	
}
/*
 ---------------------------------------------------------
 Details, summary
 ---------------------------------------------------------
 *********************************************************
 */

/*
 *********************************************************
 ---------------------------------------------------------
 Forms
 ---------------------------------------------------------
 */

.vui form{
	
	position: relative;
	display: block;
	
}
.vui fieldset{
	
	border-top: thin solid <?= $vui->colors->vui_lighter->darken( 8, TRUE )->hex_s; ?>;
	
	padding: <?= VUI_SPACING; ?>em;
	
}
.vui legend{
	
	font-family: <?= VUI_SEC_FONT_FAMILY; ?>;
	
	color: <?= VUI_SEC_FONT_COLOR; ?>;
	
	padding: <?= VUI_SPACING / 2; ?>em;
	margin: 0;
	
}
.vui legend:after{
	
	position: relative;
	content: '';
	display: block;
	clear: both;
	height: 2px;
	
}

/*
 ---------------------------------------------------------
 Forms
 ---------------------------------------------------------
 *********************************************************
 */

/*
 *********************************************************
 ---------------------------------------------------------
 Actions elements (labels, selects, inputs, textareas,
 buttons, link buttons, etc)
 ---------------------------------------------------------
 */

.vui label{
	
	position: relative;
	display: block;
	
	font-size: inherit;
	
	margin-bottom: <?= VUI_SPACING; ?>em;
	vertical-align: top;
	
}


/* ---------------------------------------------------- */
/* All form inputs */

.vui input,
.vui button,
.vui select,
.vui textarea{
	
	position: relative;
	
	<?= $vui->css->display_inline_block(); ?>
	
	font-family: <?= VUI_BUTTONS_FONT_FAMILY; ?>;
	font-size: <?= VUI_BUTTONS_FONT_SIZE; ?>;
	text-transform: none;
	
	margin: 0;
	margin-bottom: <?= VUI_SPACING; ?>em;
	
	<?= $vui->colors->{ VUI_BUTTONS_BACKGROUND_VUI_COLOR_NAME }->getCssGradient( 2 ); ?>
	color: <?= $vui->colors->{ VUI_BUTTONS_FOREGROUND_VUI_COLOR_NAME }->hex_s; ?>;
	
	border-top: thin solid <?= $vui->colors->{ VUI_BUTTONS_BACKGROUND_VUI_COLOR_NAME }->darken( 2, TRUE )->hex_s; ?>;
	border-right: thin solid <?= $vui->colors->{ VUI_BUTTONS_BACKGROUND_VUI_COLOR_NAME }->darken( 8, TRUE )->hex_s; ?>;
	border-bottom: thin solid <?= $vui->colors->{ VUI_BUTTONS_BACKGROUND_VUI_COLOR_NAME }->darken( 15, TRUE )->hex_s; ?>;
	border-left: thin solid <?= $vui->colors->{ VUI_BUTTONS_BACKGROUND_VUI_COLOR_NAME }->darken( 8, TRUE )->hex_s; ?>;
	
	padding-top: .6em;
	padding-right: 1.2em;
	padding-bottom: .6em;
	padding-left: 1.2em;
	
	<?= $vui->css->border_radius( VUI_DEFAULT_BORDER_RADIUS ); ?>
	
	<?= $vui->css->box_shadow( '0px 3px 7px ' . $vui->colors->vui_base->darken( 28, TRUE )->rgba_s( 15 ) ); ?>
	
	<?= $vui->css->transition( VUI_DEFAULT_TRANSITION ); ?>
	
	cursor: pointer;
	
	vertical-align: top;
	
	z-index: 1;
	
}
.vui select{
	
	padding: .531em 2.5em .531em 0.9em;
	
}
.vui optgroup,
.vui option{
	
	color: <?= VUI_DEFAULT_FONT_COLOR; ?>;
	text-shadow: none;
	
	background: <?= $vui->colors->vui_lighter->hex_s; ?>;
	
}

/* Hiding dropdown arrows on IE*/
.vui select::-ms-expand {
	
	display: none;
	
}
.vui select:hover,
.vui select:focus,
.vui button:hover,
.vui button:focus,
.vui input:hover,
.vui input:focus,
.vui textarea:hover,
.vui textarea:focus{
	
	<?= $vui->colors->{ VUI_BUTTONS_BACKGROUND_VUI_COLOR_NAME_HOVER }->getCssGradient( 3 ); ?>
	color: <?= $vui->colors->{ VUI_BUTTONS_FOREGROUND_VUI_COLOR_NAME_HOVER }->hex_s; ?>;
	
	border-top: thin solid <?= $vui->colors->{ VUI_BUTTONS_BACKGROUND_VUI_COLOR_NAME }->darken( 7, TRUE )->hex_s; ?>;
	border-right: thin solid <?= $vui->colors->{ VUI_BUTTONS_BACKGROUND_VUI_COLOR_NAME }->darken( 13, TRUE )->hex_s; ?>;
	border-bottom: thin solid <?= $vui->colors->{ VUI_BUTTONS_BACKGROUND_VUI_COLOR_NAME }->darken( 20, TRUE )->hex_s; ?>;
	border-left: thin solid <?= $vui->colors->{ VUI_BUTTONS_BACKGROUND_VUI_COLOR_NAME }->darken( 13, TRUE )->hex_s; ?>;
	
	<?= $vui->css->box_shadow( '0px 5px 14px ' . $vui->colors->vui_base->darken( 28, TRUE )->rgba_s( 50 ) ); ?>
	
	z-index: 2;
	
}
.vui select:focus,
.vui button:focus,
.vui input:focus,
.vui textarea:focus{
	
	z-index: 3;
	
}
.vui select:active,
.vui button:active,
.vui input:active,
.vui textarea:active{
	
	<?= $vui->colors->{ VUI_BUTTONS_BACKGROUND_VUI_COLOR_NAME_HOVER }->getCssGradient( 1 ); ?>
	color: <?= $vui->colors->{ VUI_BUTTONS_FOREGROUND_VUI_COLOR_NAME_HOVER }->hex_s; ?>;
	
	border-top: thin solid <?= $vui->colors->{ VUI_BUTTONS_BACKGROUND_VUI_COLOR_NAME }->darken( 2, TRUE )->hex_s; ?>;
	border-right: thin solid <?= $vui->colors->{ VUI_BUTTONS_BACKGROUND_VUI_COLOR_NAME }->darken( 8, TRUE )->hex_s; ?>;
	border-bottom: thin solid <?= $vui->colors->{ VUI_BUTTONS_BACKGROUND_VUI_COLOR_NAME }->darken( 15, TRUE )->hex_s; ?>;
	border-left: thin solid <?= $vui->colors->{ VUI_BUTTONS_BACKGROUND_VUI_COLOR_NAME }->darken( 8, TRUE )->hex_s; ?>;
	
	<?= $vui->css->box_shadow( '0px 1px 2px ' . $vui->colors->vui_base->darken( 28, TRUE )->rgba_s( 15 ) ); ?>
	
	z-index: 2;
	
}





/* ---------------------------------------------------- */
/* Text inputs */

.vui input[type=text],
.vui input[type=password],
.vui input[type=number],
.vui input[type=date],
.vui input[type=time],
.vui input[type=datetime],
.vui input[type=datetime-local],
.vui select[multiple],
.vui select[size]:not([size="1"]),
.vui textarea{
	
	<?= $vui->colors->vui_lighter->getCssGradient( 0 ); ?>
	
	color: <?= $vui->colors->vui_dark->hex_s; ?>;
	
	padding: .6em;
	
	border-top: thin solid <?= $vui->colors->vui_lighter->darken( 8, TRUE )->hex_s; ?>;
	border-right: thin solid <?= $vui->colors->vui_lighter->darken( 8, TRUE )->hex_s; ?>;
	border-bottom: thin solid <?= $vui->colors->vui_lighter->darken( 15, TRUE )->hex_s; ?>;
	border-left: thin solid <?= $vui->colors->vui_lighter->darken( 8, TRUE )->hex_s; ?>;
	
	<?= $vui->css->box_shadow( '0px 3px 7px ' . $vui->colors->vui_base->darken( 28, TRUE )->rgba_s( 10 ) ); ?>
	
	cursor: text;
	
}
.vui select[multiple],
.vui select[size]:not([size="1"]){
	
	padding: .6em;
	
}
.vui input[type=text]:hover,
.vui input[type=text]:focus,
.vui input[type=password]:hover,
.vui input[type=password]:focus,
.vui input[type=number]:hover,
.vui input[type=number]:focus,
.vui input[type=date]:hover,
.vui input[type=date]:focus,
.vui input[type=time]:hover,
.vui input[type=time]:focus,
.vui input[type=datetime]:hover,
.vui input[type=datetime]:focus,
.vui input[type=datetime-local]:hover,
.vui input[type=datetime-local]:focus,
.vui select[multiple]:hover,
.vui select[multiple]:focus,
.vui select[size]:not([size="1"]):hover,
.vui select[size]:not([size="1"]):focus,
.vui textarea:hover,
.vui textarea:focus{
	
	color: <?= $vui->colors->vui_dark->hex_s; ?>;
	<?= $vui->colors->vui_lighter->getCssGradient( 0 ); ?>
	
	border: thin solid <?= $vui->colors->vui_lighter->darken( 15, TRUE )->hex_s; ?>;
	
	<?= $vui->css->box_shadow( '0px 3px 7px ' . $vui->colors->vui_base->darken( 28, TRUE )->rgba_s( 10 ) ); ?>
	
	cursor: text;
	
}
.vui input[type=text]:focus,
.vui input[type=password]:focus,
.vui input[type=number]:focus,
.vui input[type=date]:focus,
.vui input[type=time]:focus,
.vui input[type=datetime]:focus,
.vui input[type=datetime-local]:focus,
.vui select[multiple]:focus,
.vui select[size]:not([size="1"]):focus,
.vui textarea:focus{
	
	border: thin solid <?= $vui->colors->vui_base->hex_s; ?>;
	
	<?= $vui->css->box_shadow( '0px 5px 14px ' . $vui->colors->vui_base->darken( 28, TRUE )->rgba_s( 50 ) ); ?>
	
}

/* ---------------------------------------------------- */
/* Fix for Webkit */

@media screen and (-webkit-min-device-pixel-ratio:0) {
	
	.vui input[type=date],
	.vui input[type=time],
	.vui input[type=datetime-local]{
		
		padding-top: 0.51em;
		padding-bottom: 0.51em;
		
	}
	.vui input[type=file]{
		
		padding-top: 0.5em;
		padding-bottom: 0.5em;
		
	}
	 
}

/* ---------------------------------------------------- */
/* Fix for Firefox */

@-moz-document url-prefix() {
	
	.vui input[type=file]{
		
		padding: 0.28em;
		
	}
	.vui select:focus:-moz-focusring {
		
		color: transparent;
		text-shadow: 0 0 0 <?= $vui->colors->{ VUI_BUTTONS_BACKGROUND_VUI_COLOR_NAME_HOVER }->get_ro_color()->hex_s; ?>;
	
	}
	
}

/*
 ---------------------------------------------------------
 Actions elements (labels, selects, inputs, textareas,
 buttons, link buttons, etc)
 ---------------------------------------------------------
 *********************************************************
 */

/*
 *********************************************************
 ---------------------------------------------------------
 Tables
 ---------------------------------------------------------
 */

.vui table{
	
	border-collapse: collapse;
	border: none;
	text-align: center;
	width: 100%;
	margin-top: <?= VUI_SPACING; ?>em;
	margin-bottom: <?= VUI_SPACING; ?>em;
	
}
.vui tr{
	
	border:none;
	
	<?= $vui->css->transition( VUI_DEFAULT_TRANSITION ); ?>
	
}
.vui td,
.vui th,
.vui table caption{
	
	border: 1px solid <?= $vui->colors->vui_extra_3->rgba_s( 10 ); ?>;
	border-top: none;
	padding: <?= VUI_SPACING; ?>em <?= VUI_SPACING; ?>em;
	vertical-align: middle;
	
	<?= $vui->css->transition( VUI_DEFAULT_TRANSITION ); ?>
	
}
.vui tr:hover,
.vui td:hover,
.vui th:hover{
	
}
.vui table:hover tr{
	
}
.vui table tr:hover{
	
}
.vui td:first-child,
.vui th:first-child{
	
	border-left: none;
	
}
.vui td:first-child,
.vui th:first-child{
	
	border-left: none;
	
}
.vui tr:last-of-type td,
.vui tr:last-of-type th{
	
	border-bottom: none;
	
}
.vui th,
.vui table caption{
	
	font-weight: bold;
	
}
.vui td{
	position:relative;
	text-align: left;
}
.vui th a{

}
.vui th a:hover{
	
}

.vui tr:nth-child(odd){
	
}
.vui tr:nth-child(odd) td{
	
}
.vui tr:nth-child(even) td{
	
}
.vui tr.odd{
	
}
.vui tr.even{
	
}
.vui tr:hover{
	
}
.vui th,
.vui table caption,
.vui thead td,
.vui tfoot td{
	
	background: <?= $vui->colors->vui_extra_3->rgba_s( 10 ); ?>;
	
}
.vui tr:hover{
	
	background: <?= $vui->colors->vui_extra_3->rgba_s( 10 ); ?>;
	
}
.vui tr.selected{
	
	background: <?= $vui->colors->vui_base->rgba_s( 10 ); ?>;
	
}
.vui table.no-bg tr td,
.vui table.no-bg tr:nth-child(odd) td,
.vui table.no-bg tr:nth-child(even) td,
.vui table.no-bg tr.odd td,
.vui table.no-bg tr.even td{
	
	background: none;
	
}

tr th.col-hidden,
tr td.col-hidden{
	
	display: none;
	
}



/*
 ---------------------------------------------------------
 Tables
 ---------------------------------------------------------
 *********************************************************
 */
