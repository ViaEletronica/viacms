
/*
 *********************************************************
 ---------------------------------------------------------
 Dashboard
 ---------------------------------------------------------
 */

.vui .dashboard-items-container{
	
	position:relative;
	<?= css_display_inline_block(); ?>;
	padding:<?= DEFAULT_SPACING; ?>px <?= DEFAULT_SPACING/2; ?>px 0;
	margin-bottom:<?= DEFAULT_SPACING; ?>px;
	background: <?= $vui->colors->vui_lighter->hex_s; ?>;
	
	
	<?= DEFAULT_BORDER_RADIUS; ?>
	
}
.vui .dashboard-item{
	position:relative;
	<?= css_display_inline_block(); ?>;
	margin:0 <?= DEFAULT_SPACING/2; ?>px <?= DEFAULT_SPACING; ?>px;
	
	<?= DEFAULT_BORDER_RADIUS; ?>
	
	color: <?= VUI_FONT_COLOR; ?>;
	text-align: center;
	
	background-color: <?= $vui->colors->vui_light->hex_s; ?>;
	border: 1px solid <?= $vui->colors->vui_extra_3->rgba_s( 15 ); ?>;
	
}
.vui .dashboard-item-icon{
	
	padding:<?= DEFAULT_SPACING * 2; ?>px;
	position:relative;
	<?= css_display_inline_block(); ?>;
	
}
.vui .dashboard-item .icon,
.vui .dashboard-item [class*="icon-"]:before {
	
	font-size: 32px;
	line-height: 32px;
	
}
.vui .dashboard-title{
	display: none;
}
.vui .dashboard-item:hover,
.vui .dashboard-item:focus{
	
	background-color: <?= $vui->colors->vui_lighter->rgba_s( 30 ); ?>;
	border: 1px solid <?= $vui->colors->vui_base->rgba_s( 60 ); ?>;
	box-shadow: 0px 20px 50px <?= $vui->colors->vui_base->darken( 25, TRUE )->rgba_s( 30 ); ?>;
	color: <?= $vui->colors->vui_base->hex_s; ?>;
	
}

/*
 ---------------------------------------------------------
 Dashboard
 ---------------------------------------------------------
 *********************************************************
 */
