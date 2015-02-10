
/*
 *********************************************************
 ---------------------------------------------------------
 Msg
 ---------------------------------------------------------
 */

.msg{
	padding:<?= DEFAULT_SPACING; ?>px;
	margin-bottom:<?= DEFAULT_SPACING; ?>px;
	background:#ffeeaa;
	
	-webkit-box-shadow:	0px 2px 5px 0px rgba(0, 0, 0, 0.2);
	box-shadow:	0px 2px 5px 0px rgba(0, 0, 0, 0.2);
	
	<?= DEFAULT_BORDER_RADIUS; ?>
	
}
.msg-type-title{
	
	padding:<?= DEFAULT_SPACING; ?>px 0;
	font-family: 'Archivo Narrow', sans-serif;
	font-size:120%;
	
}
.msg-item{
	
	padding:<?= DEFAULT_SPACING; ?>px;
	
}
.msg-type-info{
	
}
.msg-type-success{
	
	color: <?= $vui->colors->vui_green->darken( 20, TRUE )->hex_s; ?>;
	
}
.msg-type-error{
	
	background: <?= $vui->colors->vui_red->rgba_s( 20 ); ?>;
	color: <?= $vui->colors->vui_red->hex_s; ?>;
	
}
.msg-type-info{
	
	background: <?= $vui->colors->vui_blue->rgba_s( 20 ); ?>;
	color: <?= $vui->colors->vui_blue->hex_s; ?>;
	
}
.msg-type-warning{
	
	background: <?= $vui->colors->vui_yellow->rgba_s( 20 ); ?>;
	color: <?= $vui->colors->vui_yellow->get_ro_color()->hex_s; ?>;
	
}
.msg-inline-error{
	color:#C35454;
}
.important,
.text-warning{
	color: #C35454;
	font-weight: bold;
}

.vui .msg-item > ul:last-child,
.vui .msg-item > ul > li:last-child{
	
	margin-bottom: 0;
	
}
.vui .msg-item > ul:last-child{
	
	margin-bottom: 0;
	padding-bottom: 0;
	
}

/* qtip success*/
.vui .qtip.msg-type-success{
	
	border: thin solid <?= $vui->colors->vui_green->hex_s; ?>;
	border-left: 5px solid <?= $vui->colors->vui_green->hex_s; ?>;
	
}
/* qtip error*/
.vui .qtip.msg-type-error{
	
	border: thin solid <?= $vui->colors->vui_red->hex_s; ?>;
	border-left: 5px solid <?= $vui->colors->vui_red->hex_s; ?>;
	
}
/* qtip info*/
.vui .qtip.msg-type-info{
	
	border: thin solid <?= $vui->colors->vui_blue->hex_s; ?>;
	border-left: 5px solid <?= $vui->colors->vui_blue->hex_s; ?>;
	
}
/* qtip warning*/
.vui .qtip.msg-type-warning{
	
	border: thin solid <?= $vui->colors->vui_yellow->hex_s; ?>;
	border-left: 5px solid <?= $vui->colors->vui_yellow->hex_s; ?>;
	
}

/*
 ---------------------------------------------------------
 Msg
 ---------------------------------------------------------
 *********************************************************
 */
