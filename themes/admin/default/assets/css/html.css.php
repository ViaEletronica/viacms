
.vui{
	
	color: <?= $vui->colors->vui_darker->hex_s; ?>;
	
}



.vui::-webkit-scrollbar-track,
.vui ::-webkit-scrollbar-track
{
	-webkit-box-shadow: none;
	border: none;
}

.vui::-webkit-scrollbar,
.vui ::-webkit-scrollbar
{
	width: 9px;
	border: none;
}

.vui::-webkit-scrollbar-thumb,
.vui ::-webkit-scrollbar-thumb
{
	border: none;
	background-color: <?= $vui->colors->vui_darker->hex_s; ?>;
}


html,
body.vui{
	
	position:relative;
	display:block;
	margin:0;
	font-family: <?= DEFAULT_FONT_FAMILY; ?>;
	font-size: <?= DEFAULT_FONT_SIZE; ?>;
	line-height: <?= DEFAULT_LINE_HEIGHT; ?>;
	
	background: <?= $vui->colors->vui_lighter->hex_s; ?>;
	
}

body.login.vui{
	
	text-align: center;
	
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
	position:relative;
	display:block;
	margin:0 0 <?= DEFAULT_SPACING; ?>px;
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
 Headers
 ---------------------------------------------------------
 */

.vui h1,
.vui h2,
.vui h3,
.vui h4,
.vui h5,
.vui h6{
	font-family: <?= FONT_FAMILY_SEC; ?>;
	font-size:200%;
	font-weight: normal;
	line-height:100%;
	margin-bottom:<?= DEFAULT_SPACING; ?>px;
	
	text-shadow: <?= DEFAULT_TEXT_SHADOW; ?>;
}
.vui h1{
	
}
.vui h2{
	font-size:180%;
}
.vui h3{
	font-size:160%;
}
.vui h3{
	font-size:140%;
}
.vui h4{
	font-size:120%;
}
.vui h5{
	font-size:110%;
}
.vui h6{
	font-size:100%;
}

.vui header h1{
	
	padding: <?= DEFAULT_SPACING; ?>px;
	
	/*
	<?= DEFAULT_TABLE_TH_BACKGROUND; ?>;
	color: <?= DEFAULT_TABLE_TH_FOREGROUND_COLOR; ?>;
	margin: -<?= DEFAULT_SPACING * 2; ?>px -<?= DEFAULT_SPACING*2; ?>px <?= DEFAULT_SPACING; ?>px -<?= DEFAULT_SPACING*2; ?>px;
	
	*/
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
 *********************************************************
 ---------------------------------------------------------
 Forms
 ---------------------------------------------------------
 */

form{
	position: relative;
	display: block;
}
form.form-change-order{
	position:relative;
	<?= css_display_inline_block(); ?>;
}
fieldset{
	
	<?= FIELDSET_STYLESHEET; ?>
	
}
legend{
	
	<?= LEGEND_STYLESHEET; ?>
	
}
legend:after{
	
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

.vui label,
.vui .fake-label{
	position:relative;
	display:block;
	
	font-size: inherit;
	
	margin-bottom:<?= DEFAULT_SPACING; ?>px;
	vertical-align: top;
}
.vui .label-content{
	position:relative;
	display:block;
	
	margin-bottom:<?= DEFAULT_SPACING/2; ?>px;
}
.vui label.switch .label-content{
	display: inline-block;
	margin-bottom: 0;
	line-height: 2em;
}
.vui label.checkbox-sub-item{
	margin-left:<?= DEFAULT_SPACING*2; ?>px;
}


.vui input,
.vui button,
.vui select,
.vui textarea{
	
	-webkit-appearance: none;
	
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	
	vertical-align: top;
	
}

.vui select,
.vui select.switch,
.vui select.switch-off,
.vui select.switch:hover,
.vui select.switch-off:hover,
.vui button,
.vui input[type=submit],
.vui input[type=submit]:disabled,
.vui input[type=submit]:hover:disabled,
.vui input[type=submit]:focus:disabled,
.vui input[type=button],
.vui input[type=button]:disabled,
.vui input[type=button]:hover:disabled,
.vui input[type=button]:focus:disabled,
.vui .button,
.vui .input-file-wrapper,
.vui .mce-primary,
.vui .mce-btn{
	
	/* remove select arrow on firefox */
	/* Very thanx to João Cunha */
	-moz-appearance: none;
	text-indent: 0.01px;
	text-overflow: '';
	/* remove select arrow */
	
	position:relative;
	
	display: inline-block;
	*display: inline;
	*zoom: 1;
	
	border:none;
	font-family: <?= INPUTS_BUTTONS_FONT_FAMILY; ?>;
	font-size: <?= INPUTS_BUTTONS_FONT_SIZE; ?>;
	text-transform: none;
	
	padding: <?= INPUTS_BUTTONS_PADDING; ?>;
	
	margin:0;
	margin-bottom: <?= DEFAULT_SPACING; ?>px;
	
	<?= $vui->colors->vui_extra_2->getCssGradient( 5 ); ?>;
	color: <?= $vui->colors->vui_extra_2->get_ro_color()->hex_s; ?>;
	border-bottom: 2px solid #<?= $vui->colors->vui_extra_2->darken( 15 ); ?>;
	box-shadow: 0px 3px 7px <?= $vui->colors->vui_base->darken( 28, TRUE )->rgba_s( 25 ); ?>;
	
	<?= DEFAULT_BORDER_RADIUS; ?>
	/*
	text-shadow: 1px 1px 0px <?= $vui->colors->vui_extra_2->{ $vui->colors->vui_extra_2->is_dark() ? 'darken' : 'lighten' }( 30, TRUE )->rgba_s( 150 ); ?>;
	*/
	cursor: pointer;
	
	vertical-align: top;
	
}
.vui optgroup,
.vui option{
	
	color: <?= VUI_FONT_COLOR; ?>;
	text-shadow: none;
	
	background: <?= $vui->colors->vui_lighter->hex_s; ?>;
	
}

select::-ms-expand {
	
	display: none;
	
}
.vui select:hover,
.vui select:focus,
.vui button:hover,
.vui button:focus,
.vui input[type=button]:hover,
.vui input[type=button]:focus,
.vui input[type=submit]:hover,
.vui input[type=submit]:focus,
.vui .button:hover,
.vui .button:focus,
.vui .input-file-wrapper:hover,
.vui .input-file-wrapper:focus{
	
	color:<?= INPUTS_BUTTONS_COLOR_SEC; ?>;
	
	<?= INPUTS_BUTTONS_BACKGROUND_HOVER; ?>;
	
	<?= INPUTS_BUTTONS_BORDER_SEC; ?>;
	
}
.vui select{
	
	cursor:pointer;
	width: auto;
	padding:<?= SELECT_BUTTONS_PADDING; ?>;
	
	padding-right: <?= ( BUTTONS_PADDING_RIGHT * 1.5 ) + 13 + ( BUTTONS_PADDING_RIGHT * 1.5 ); ?>px;
	
	<?= SELECT_BUTTONS_BACKGROUND; ?>;
	
	background-repeat: no-repeat, repeat !important;
	background-position: right <?= BUTTONS_PADDING_RIGHT * 1.5; ?>px center, center center !important;
	
}
.vui select:hover,
.vui select:focus{
	
	cursor: pointer;
	
	<?= SELECT_BUTTONS_BACKGROUND_HOVER; ?>;
	
}

@-moz-document url-prefix() {
	.vui select:focus:-moz-focusring {
		
		color: transparent;
		text-shadow: 0 0 0 <?= $vui->colors->{SELECT_BUTTONS_BACKGROUND_VUI_COLOR_HOVER}->get_ro_color()->hex_s; ?>
	
	}
}
.vui select.switch,
.vui select.switch-off,
.vui select.switch-off:hover{
	
	padding:<?= SELECT_BUTTONS_PADDING; ?>;
	
	<?= INPUTS_BUTTONS_BACKGROUND; ?>;
	
	background-repeat: repeat !important;
	
}
.vui select.switch-on option:before{
	
	content: "\e62c";
	
}
.vui select.switch-on,
.vui select.switch-on:hover{
	
	padding:<?= SELECT_BUTTONS_PADDING; ?>;
	
	color: <?= $vui->colors->vui_green->get_ro_color()->hex_s; ?>;
	<?= $vui->colors->vui_green->getCssGradient( 5 ); ?>;
	border-bottom-color: #<?= $vui->colors->vui_green->darken( 20 ); ?>;
	
	background-repeat: repeat !important;
	
}
.vui select.switch-middle,
.vui select.switch-middle:hover{
	
	padding:<?= SELECT_BUTTONS_PADDING; ?>;
	
	color: <?= $vui->colors->vui_orange->get_ro_color()->hex_s; ?>;
	<?= $vui->colors->vui_orange->getCssGradient( 5 ); ?>;
	border-bottom-color: #<?= $vui->colors->vui_orange->darken( 20 ); ?>;
	
	background-repeat: repeat !important;
	
}




.vui input[type=submit].button-cancel,
.vui input[type=submit].button-cancel:disabled,
.vui input[type=submit].button-cancel:hover:disabled,
.vui input[type=submit].button-cancel:focus:disabled,
.vui input[type=button].button-cancel,
.vui input[type=button].button-cancel:disabled,
.vui input[type=button].button-cancel:hover:disabled,
.vui input[type=button].button-cancel:focus:disabled,
.vui .button.button-cancel,
.vui .input-file-wrapper.button-cancel{
	color:<?= CANCEL_BUTTON_FOREGROUND_COLOR; ?>;

	<?= CANCEL_BUTTON_BACKGROUND; ?>;
}
.vui input[type=button].button-cancel:hover,
.vui input[type=button].button-cancel:focus,
.vui input[type=submit].button-cancel:hover,
.vui input[type=submit].button-cancel:focus,
.vui .button.button-cancel:hover,
.vui .button.button-cancel:focus,
.vui .input-file-wrapper.button-cancel:hover,
.vui .input-file-wrapper.button-cancel:focus{
	color:<?= CANCEL_BUTTON_FOREGROUND_COLOR_SEC; ?>;

	<?= CANCEL_BUTTON_BACKGROUND_SEC; ?>;
}

.vui input[type=submit].button-cancel,
.vui input[type=submit].button-cancel:disabled,
.vui input[type=submit].button-cancel:hover:disabled,
.vui input[type=submit].button-cancel:focus:disabled,
.vui input[type=button].button-cancel,
.vui input[type=button].button-cancel:disabled,
.vui input[type=button].button-cancel:hover:disabled,
.vui input[type=button].button-cancel:focus:disabled,
.vui .button.button-cancel,
.vui .input-file-wrapper.button-cancel{
	color:<?= CANCEL_BUTTON_FOREGROUND_COLOR; ?>;

	<?= CANCEL_BUTTON_BACKGROUND; ?>;
}
.vui input[type=button].button-cancel:hover,
.vui input[type=button].button-cancel:focus,
.vui input[type=submit].button-cancel:hover,
.vui input[type=submit].button-cancel:focus,
.vui .button.button-cancel:hover,
.vui .button.button-cancel:focus,
.vui .input-file-wrapper.button-cancel:hover,
.vui .input-file-wrapper.button-cancel:focus{
	color:<?= CANCEL_BUTTON_FOREGROUND_COLOR_SEC; ?>;

	<?= CANCEL_BUTTON_BACKGROUND_SEC; ?>;
}


.vui input[type=submit].button-apply,
.vui input[type=submit].button-apply:disabled,
.vui input[type=submit].button-apply:hover:disabled,
.vui input[type=submit].button-apply:focus:disabled,
.vui input[type=button].button-apply,
.vui input[type=button].button-apply:disabled,
.vui input[type=button].button-apply:hover:disabled,
.vui input[type=button].button-apply:focus:disabled,
.vui .button.button-apply,
.vui .input-file-wrapper.button-apply{
	color:<?= APPLY_BUTTON_FOREGROUND_COLOR; ?>;

	<?= APPLY_BUTTON_BACKGROUND; ?>;
}
.vui input[type=button].button-apply:hover,
.vui input[type=button].button-apply:focus,
.vui input[type=submit].button-apply:hover,
.vui input[type=submit].button-apply:focus,
.vui .button.button-apply:hover,
.vui .button.button-apply:focus,
.vui .input-file-wrapper.button-apply:hover,
.vui .input-file-wrapper.button-apply:focus{
	color:<?= APPLY_BUTTON_FOREGROUND_COLOR_SEC; ?>;

	<?= APPLY_BUTTON_BACKGROUND_SEC; ?>;
}

.vui input[type=submit].button-apply,
.vui input[type=submit].button-apply:disabled,
.vui input[type=submit].button-apply:hover:disabled,
.vui input[type=submit].button-apply:focus:disabled,
.vui input[type=button].button-apply,
.vui input[type=button].button-apply:disabled,
.vui input[type=button].button-apply:hover:disabled,
.vui input[type=button].button-apply:focus:disabled,
.vui .button.button-apply,
.vui .input-file-wrapper.button-apply{
	color:<?= APPLY_BUTTON_FOREGROUND_COLOR; ?>;

	<?= APPLY_BUTTON_BACKGROUND; ?>;
}
.vui input[type=button].button-apply:hover,
.vui input[type=button].button-apply:focus,
.vui input[type=submit].button-apply:hover,
.vui input[type=submit].button-apply:focus,
.vui .button.button-apply:hover,
.vui .button.button-apply:focus,
.vui .input-file-wrapper.button-apply:hover,
.vui .input-file-wrapper.button-apply:focus{
	color:<?= APPLY_BUTTON_FOREGROUND_COLOR_SEC; ?>;

	<?= APPLY_BUTTON_BACKGROUND_SEC; ?>;
}


.vui select:disabled,
.vui input[type=button]:disabled,
.vui input[type=submit]:disabled,
.vui input[type=file]:disabled,
.vui input[type=text]:disabled,
.vui input[type=number]:disabled,
.vui input[type=password]:disabled,
.vui textarea:disabled,
.vui .disabled{
	
	opacity:.4;
	
}



.vui input[type=text],
.vui input[type=number],
.vui input[type=password],
.vui input[type=file],
.vui textarea,
.vui select[multiple],
.vui .inputbox,
.vui .cleditorMain,
.vui .mce-combobox input,
.vui .mce-textbox{
	
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	
	position:relative;
	<?= css_display_inline_block(); ?>;
	
	border: <?= VUI_BORDER; ?>;
	
	font-family: <?= DEFAULT_FONT_FAMILY; ?>;
	font-size: inherit;
	padding:<?= INPUTS_PADDING; ?>;
	margin:0;
	margin-bottom:<?= DEFAULT_SPACING; ?>px;
	color:<?= INPUTS_FOREGROUND_COLOR; ?>;
	line-height: normal;
	
	<?= INPUTS_BACKGROUND; ?>
	
	<?= DEFAULT_INSET_BOX_SHADOW; ?>
	
	<?= DEFAULT_BORDER_RADIUS; ?>
	
	<?= $vui_css->transition(); ?>
	
	text-shadow:<?= TEXT_SHADOW_LIGHT; ?>;
	
	cursor:text;
	
	width:350px;
}
.vui select[multiple]{
	
	width: auto;
	
}
.vui .input-near-complement{
	
	position: relative;
	<?= css_display_inline_block(); ?>;
	padding: 8px 0;
	
}


.vui .vui-checkbox,
.vui .vui-radiobox{
	
	position: relative;
	
	white-space: nowrap;
	
}
.vui .vui-checkbox input[type=checkbox],
.vui .vui-radiobox input[type=radio]{
	
	display: none;
	/*
	opacity: 0;
	position: absolute;
	width: 100%;
	height: 100%;
	
	z-index: 2;
	*/
}
.vui .vui-checkbox .check,
.vui .vui-radiobox .check{
	
	position: relative;
	<?= css_display_inline_block(); ?>;
	
	padding: 0;
	border: 1px solid <?= $vui->colors->vui_extra_3->rgba_s( 50 ); ?>;
	color: <?= INPUTS_FOREGROUND_COLOR_SEC; ?>;
	
	background: <?= $vui->colors->vui_extra_3->rgba_s( 10 ); ?>;
	
	border-radius: <?= CHECKBOX_BORDER_RADIUS; ?>;
	
	cursor: default;
	
	margin: 0 <?= DEFAULT_SPACING / 2; ?>px;
	
	width: 1.1em;
	height: 1.1em;
	line-height: 1em;
	
	<?= $vui_css->transition(); ?>
	<?= $vui_css->transform( 'rotate( 0deg ) translate( 0,0 ) scale( 1 )' ); ?>
	
	z-index: 1;
	
}
.vui .vui-radiobox input[type=radio] + span{
	
	border-radius: 100%;
	
}
.vui .vui-radiobox > .content{
	
	<?= css_display_inline_block(); ?>;
	
	white-space: normal;
	
}
th .vui-checkbox:last-child,
td .vui-checkbox:last-child,
th .vui-radiobox:last-child,
td .vui-radiobox:last-child{
	
	margin-bottom: 0;
	
}


.vui-checkbox input[type=checkbox]:checked + span,
.vui-radiobox input[type=radio]:checked + span{
	
	background: none;
	
	border: 1px solid <?= VUI_FONT_COLOR; ?>;
	border-top-color: transparent;
	border-right-color: transparent;
	height: 0.45em;
	
	<?= $vui_css->transform( 'rotate( -48deg ) translate( -0.1em, 0.1em ) scale( 1.2 )' ); ?>
	
	border-radius: 0;
	
}


.vui label input,
.vui .fake-label input,
.vui label input[type=checkbox],
.vui .fake-label input[type=checkbox],
.vui label input[type=radio],
.vui .fake-label input[type=radio]{
	
	margin-bottom: 0;
	
}


.vui input[type=text]:hover,
.vui input[type=text]:focus,
.vui input[type=number]:hover,
.vui input[type=number]:focus,
.vui input[type=password]:hover,
.vui input[type=password]:focus,
.vui input[type=file]:hover,
.vui input[type=file]:focus,
.vui textarea:hover,
.vui textarea:focus,
.vui .inputbox:hover,
.vui .inputbox:focus,
.vui select[multiple]:hover,
.vui select[multiple]:focus{
	
	<?= INPUTS_BORDER_SEC; ?>;
	
	color:<?= INPUTS_FOREGROUND_COLOR_SEC; ?>;

	<?= INPUTS_BACKGROUND_SEC; ?>;
	
}
.vui input[type=text]:focus,
.vui input[type=number]:focus,
.vui input[type=password]:focus,
.vui input[type=file]:focus,
.vui textarea:focus,
.vui .inputbox:focus{
	
}


.vui select,
.vui button,
.vui input,
.vui textarea{
	
	line-height: normal;
	
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
 List items
 ---------------------------------------------------------
 */

.vui ul,
.vui ol{
	
	position:relative;
	display: block;
	margin-bottom: <?= DEFAULT_SPACING; ?>px;
	padding-bottom:<?= DEFAULT_SPACING; ?>px;
	
}
.vui ul ol,
.vui ul ul,
.vui ol ol,
.vui ol ul{
	
	margin-top: <?= DEFAULT_SPACING / 2; ?>px;
	margin-bottom: 0;
	
}
.vui ol{
	
	counter-reset: my-badass-counter;
	
}
	.vui li{
		
		position: relative;
		display: list-item;
		margin-bottom: <?= DEFAULT_SPACING / 2; ?>px;
		margin-left: <?= DEFAULT_SPACING; ?>px;
		padding-left: <?= DEFAULT_SPACING / 2; ?>px;
		list-style-type: disc;
		list-style-position: inside;
		
	}
		.vui li li{
			
		}
	
	.vui ol li{
		
		display: block;
		margin-left: <?= DEFAULT_SPACING + ( DEFAULT_SPACING * 2 ) - ( DEFAULT_SPACING / 2 ); ?>px;
		padding-left: 0;
		
	}
	.vui ol li:before{
		
		<?= css_box_sizing(); ?>
		
		content: counter( my-badass-counter, decimal );
		counter-increment: my-badass-counter;
		
		position: absolute;
		display: block;
		margin-left: -<?= DEFAULT_SPACING * 1.3; ?>px;
		padding-right: <?= DEFAULT_SPACING + ( DEFAULT_SPACING / 2 ); ?>px;
		text-align: center;
		width: <?= DEFAULT_SPACING * 2; ?>px;
		
		font-family: <?= FONT_FAMILY_SEC; ?>;
		
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
 Tables
 ---------------------------------------------------------
 */

.vui table{
	
	border-collapse: collapse;
	border: none;
	text-align: center;
	width:100%;
	
}
.vui tr{
	
	border:none;
	
}
.vui td,
.vui th{
	
	border: 1px solid <?= $vui->colors->vui_extra_3->rgba_s( 10 ); ?>;
	border-top: none;
	padding: <?= DEFAULT_SPACING; ?>px <?= DEFAULT_SPACING; ?>px;
	vertical-align: middle;
	
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
.vui td:last-child,
.vui th:last-child{
	
	border-right: none;
	
}
.vui th{
	
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
tr:nth-child(even) td.order-by-column,
tr:nth-child(odd) td.order-by-column{
	
}
tr td.order-by-column,
.vui tr:nth-child(even):hover td.order-by-column,
.vui tr:nth-child(odd):hover td.order-by-column,
.vui th{
	
}
.vui th,
.vui tr:hover td{
	
	background-color: <?= $vui->colors->vui_extra_3->rgba_s( 10 ); ?>;
	
}
.vui tr.selected{
	
	background-color: <?= $vui->colors->vui_base->rgba_s( 10 ); ?>;
	
}
.vui table.no-bg tr td,
.vui table.no-bg tr:nth-child(odd) td,
.vui table.no-bg tr:nth-child(even) td,
.vui table.no-bg tr.odd td,
.vui table.no-bg tr.even td{
	
	background-color: none;
	
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
