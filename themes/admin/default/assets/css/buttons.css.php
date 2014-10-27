
/*
 *********************************************************
 ---------------------------------------------------------
 Anchor buttons
 ---------------------------------------------------------
 */

.vui .btn,
.vui *.btn{
	position:relative;
	<?= css_display_inline_block(); ?>;
	padding: 0;
	margin: 0;
	border:none;
	text-decoration:none;
	outline: none;
	box-shadow:none;
	background:none;
	
	color: <?= VUI_FONT_COLOR; ?>;
	
}
.vui input[type=submit].btn{
	
	padding: <?= INPUTS_BUTTONS_PADDING; ?>;
	
}

	.vui .btn .content,
	.vui .btn .content .icon,
	.vui .btn .content .text{
		
		position: relative;
		display: inline-block;
		vertical-align: middle;
		
	}
	
	.vui .btn .content{
		
		padding: <?= BUTTONS_PADDING; ?>;
		line-height: inherit;
		
	}
	.vui .btn .content .icon:before{
		
		margin-right: 7px;
		
	}
	.vui .btn .content .icon,
	.vui .btn .content .icon + .text{
		
		line-height: inherit;
		
	}
	
	/* Only icon */
	.vui .btn.only-icon .content .text{
		
		display: none;
		
	}
	.vui .btn.only-icon .content .icon:before{
		
		margin-right: 0;
		
	}

.vui .btn:hover,
.vui .btn:active,
.vui .btn.active,
.vui *.btn:hover,
.vui *.btn:active,
.vui *.btn.active{
	
	color: inherit;
	
}

.vui button.btn{
	
	background: none;
	
	text-shadow: none;
	
	border: 0;
}
.vui a.btn:hover,
.vui a.btn:active,
.vui a.btn.active,
.vui button.btn:hover,
.vui button.btn:active,
.vui button.btn.active,
.vui input.btn:hover,
.vui input.btn:active,
.vui input.btn.active{
	
	color: <?= $vui->colors->vui_base->hex_s; ?>;
	
}

/*
 ---------------------------------------------------------
 Anchor buttons
 ---------------------------------------------------------
 *********************************************************
 */
