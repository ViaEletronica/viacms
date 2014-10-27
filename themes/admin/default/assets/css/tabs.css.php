
/*
 *********************************************************
 ---------------------------------------------------------
 Tabs
 ---------------------------------------------------------
 */

.tabs-on #content{
	
	padding-left: 0;
	margin-left: 0;
	
}

.tabs-wrapper.tabs-on{
	
}
.tabs-on .tabs-container{
	
	direction: rtl;
	
	position: fixed;
	display: block;
	overflow: auto;
	float: left;
	z-index: 1;
	margin: 0;
	padding: 0;
	text-align: left;
	
	color: <?= $vui->colors->vui_extra_4->get_ro_color()->hex_s; ?>;
	
	<?= $vui->colors->vui_extra_4->getCssGradient( 5, 'rtl' ); ?>;
	
	left: 0;
	top: 80px;
	bottom: 0;
	
	width: 16%;
	
}
.tabs-on .tabs-container > *{
	
	direction: ltr;
	
}
.tabs-on .tabs-container::-webkit-scrollbar{
	
}

.tabs-on .tabs-items{
	
	position: relative;
	display: block;
	margin-left: 16%;
	z-index: 1;
	
}

.tabs-on .tab-item-wrapper{
	
	position: relative;
	display: block;
	margin: 0;
	padding: 0;
	
}

.tabs-on .tab-item{
	
	color: <?= $vui->colors->vui_extra_4->get_ro_color()->hex_s; ?>;
	
	position:relative;
	display: block;
	font-family: <?= DEFAULT_FONT_FAMILY; ?>;
	
	padding: <?= BUTTONS_PADDING_TOP * 0.5; ?>px <?= BUTTONS_PADDING_RIGHT * 0.9; ?>px <?= BUTTONS_PADDING_BOTTOM * 0.5; ?>px <?= BUTTONS_PADDING_LEFT * 2; ?>px;
	
	border-bottom: 1px solid <?= $vui->colors->vui_extra_4->get_ro_color()->rgba_s( 40 ); ?>;
	border-right: none;
	
	border-radius: 0;
	z-index: 1;
	
}
.tabs-on .tabs-on .tab-item .btn{
	
	color: <?= $vui->colors->vui_extra_4->get_ro_color()->hex_s; ?>;
	
}
.tabs-on .tab-item-wrapper:first-child .tab-item{
	
}
.tabs-on .tab-item-wrapper:last-child .tab-item{
	
}
.tabs-on a.tab-item.active,
.tabs-on a.tab-item:hover{
	
	color: <?= $vui->colors->vui_lighter->get_ro_color()->hex_s; ?>;
	
	background: <?= $vui->colors->vui_lighter->rgba_s( 100 ); ?>;
	
}
.tabs-on a.tab-item.active .btn,
.tabs-on a.tab-item:hover .btn{
	
	color: <?= $vui->colors->vui_lighter->get_ro_color()->hex_s; ?>;
	
}
.tabs-on a.tab-item.active{
	
	background: <?= $vui->colors->vui_lighter->hex_s; ?>;
	z-index: 2;
	
	box-shadow: 0px 20px 50px <?= $vui->colors->vui_base->darken( 25, TRUE )->rgba_s( 30 ); ?>;
	
}
.tabs-on a.tab-item:before,
.tabs-on a.tab-item:after{
	
	content: '';
	
	position: absolute;
	display: block;
	right: 0;
	bottom: -16px;
	
	width: 16px;
	height: 16px;
	
}
.tabs-on a.tab-item:after{
	
	bottom: auto;
	top: -16px;
	
}
.tabs-on a.tab-item.active:before,
.tabs-on a.tab-item.active:after{
	
	background: url(<?= $vui->svg_file( 'inner-round-tr', $vui->colors->vui_lighter->hex_s ); ?>) no-repeat right top;
	background-size: 100% 100%;
	
}
.tabs-on a.tab-item.active:after{
	
	background-image: url(<?= $vui->svg_file( 'inner-round-br', $vui->colors->vui_lighter->hex_s ); ?>);
	
}




.tabs-on .tab-item .icon:before,
.tabs-on .tab-item .ui-icon:before{
	
	font-size: 16px;
	line-height: 0;
	
}

.tabs-on .tabs-header .tab-item{
	
	margin: 0;
	font-size: 120%;
	background: none;
	
	font-family: <?= FONT_FAMILY_SEC; ?>;
	font-weight: normal;
	line-height:100%;
	
	padding: <?= DEFAULT_SPACING * 2; ?>px;
	text-shadow: <?= DEFAULT_TEXT_SHADOW; ?>;
}

.tabs-wrapper.tabs-on fieldset{
	
	display: block;
	
}
.tabs-on .tab{
	
	margin: 0;
	padding: <?= DEFAULT_SPACING * 2; ?>px;
	z-index: 1;
	border: none;
	
}
.tabs-on .tab fieldset .params-set{
	
	margin: 0;
	
}

/*
 ---------------------------------------------------------
 Tabs
 ---------------------------------------------------------
 *********************************************************
 */
