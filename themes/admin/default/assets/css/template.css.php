
#site-background{
	position:fixed;
	left:0;
	top:0;
	width:100%;
	height:100%;
	z-index:-1;
	
}
#site-block{
	position:relative;
	display:block;
	
}
body.login #site-block{
	
	display: inline-block;
	margin: <?= DEFAULT_SPACING*2; ?>px auto;
	text-align: left;
	padding-top: <?= 61 + DEFAULT_SPACING*4; ?>px;
	
	background-image: url('<?= $vui->svg_file( 'logo-login', $vui->colors->vui_base->hex_s, TRUE ); ?>');
	background-repeat: no-repeat;
	background-position: center <?= DEFAULT_SPACING * 2; ?>px;
	background-color: <?= $vui->colors->vui_lighter->hex_s; ?>;
	
	background-color: <?= $vui->colors->vui_lighter->rgba_s( 30 ); ?>;
	border: 1px solid <?= $vui->colors->vui_base->rgba_s( 60 ); ?>;
	box-shadow: 0px 20px 50px <?= $vui->colors->vui_base->darken( 25, TRUE )->rgba_s( 30 ); ?>;
	
}
html.responsive_file_manager,
body.responsive_file_manager{
	
	height: 94%;
	
}

body.responsive_file_manager #site-block,
body.responsive_file_manager #content,
body.responsive_file_manager #content .responsive-file-manager-container,
body.responsive_file_manager #content .responsive-file-manager-container #responsive-file-manager{
	
	height: 100%;
	
}
body.responsive_file_manager #content .responsive-file-manager-container #responsive-file-manager{
	
	border: none;
	width: 100%;
	
}



/*
 *********************************************************
 ---------------------------------------------------------
 Top block
 ---------------------------------------------------------
 */

#top-block{
	
	position: fixed;
	top: <?= DEFAULT_SPACING * 2; ?>px;
	left: <?= DEFAULT_SPACING * 2; ?>px;
	right: <?= DEFAULT_SPACING * 2; ?>px;
	display:block;
	text-align:left;
	margin:-<?= DEFAULT_SPACING*2; ?>px -<?= DEFAULT_SPACING*2; ?>px <?= DEFAULT_SPACING; ?>px -<?= DEFAULT_SPACING*2; ?>px;
	
	z-index: 1001;
	
	box-shadow: 0 1px 50px <?= $vui->colors->vui_extra_3->rgba_s( 30 ); ?>;
	
	<?= $vui->colors->vui_lighter->getCssGradient( 5 ); ?>;
	
}
	
	#top-block .btn{
		
		position:relative;
		<?= css_display_inline_block(); ?>;
		margin: 0;
		font-size: inherit;
		border:none;
		text-decoration:none;
		outline: none;
		
		color: <?= VUI_FONT_COLOR; ?>;
		
	}
	#top-block .btn,
	#top-block .component-name{
		
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
	#top-block .btn .content{
		
		line-height: 19px;
		
	}
	
	#top-block ul,
	#top-block li{
		
		position:relative;
		<?= css_display_inline_block(); ?>;
		padding:0;
		margin:0;
		z-index:1;
		
	}
	#top-block ul.main-menu{
		position: relative;
		z-index: 1000;
	}
	#top-block ul.secondary-menu{
		position: relative;
		z-index: 1;
	}
	#top-block ul.main-menu > li,
	#top-block ul.secondary-menu > li{
		
		float: left;
		
	}
	
	#top-block ul{
		padding:0;
	}
	
	#top-block li:hover,
	#top-block li:focus{
		z-index:1000;
	}
	#top-block li ul{
		
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
	#top-block li li ul{
		position:absolute;
		display:none;
		top:-<?= DEFAULT_SPACING; ?>px;
		left:100%;
	}
	#top-block li a{
		
		position:relative;
		<?= css_display_inline_block(); ?>;
		
		color: <?= VUI_FONT_COLOR; ?>;
		
		font-size:<?= DEFAULT_FONT_SIZE; ?>;
		text-decoration: none;
		text-shadow:none;
		white-space:nowrap;
		
	}
	
	#top-block .btn:hover,
	#top-block .btn:focus,
	#top-block .btn.active,
	#top-block li:hover > a,
	#top-block li a:hover,
	#top-block li:focus > a,
	#top-block li a:focus,
	#top-block li a.active,
	#top-block li a.btn.profiler-on{
		
		background-color: <?= $vui->colors->vui_base->rgba_s( 20 ); ?>;
		
		color: <?= $vui->colors->vui_base->hex_s; ?>;
		
		z-index: 1;
		
	}
	#top-block li li,
	#top-block li li a,
	#top-block li li .btn{
		display:block;
	}
	#top-block li li a{
		
		padding-left: <?= DEFAULT_SPACING; ?>px;
		padding-right: <?= DEFAULT_SPACING; ?>px;
		
	}
	#top-block li:hover > ul,
	#top-block li:focus > ul{
		display:block;
		z-index: 0;
	}
	
	#top-block .only-icon{
		
		border-radius: 0;
		
	}
	#toolbar .component-name{
		
	}
	
	
	
	
	#top-block input{
		margin-bottom: 0;
	}
	#top-block .vui-field-wrapper-inline{
		margin: 0;
		padding: 0;
	}
	
	
	
	
	#top-bar,
	#toolbar{
		
		position:relative;
		display:block;
		text-align:left;
		padding: 0;
		text-align:left;
		
		border-top: <?= VUI_BORDER_LIGHT; ?>;
		border-bottom: <?= VUI_BORDER; ?>;
		
		background: <?= $vui->colors->vui_base->rgba_s( 15 ) ; ?>;
		
		z-index: 3;
		
	}
	#top-bar{
		
		z-index: 1000;
		
	}
	
	#toolbar-moved-elements:after{
		
		content: '';
		
		position: relative;
		display: block;
		clear: both;
		
	}
	
	#toolbar-moved-elements-left{
		
		position: relative;
		<?= css_display_inline_block(); ?>;
		
	}
	

/*
 ---------------------------------------------------------
 Top block
 ---------------------------------------------------------
 *********************************************************
 */





/*
 *********************************************************
 ---------------------------------------------------------
 Content block
 ---------------------------------------------------------
 */

#content{
	
	position:relative;
	display:block;
	z-index:2;
	margin-bottom:<?= DEFAULT_SPACING; ?>px;
	
}

/*
 ---------------------------------------------------------
 Content block
 ---------------------------------------------------------
 *********************************************************
 */

/*
 *********************************************************
 ---------------------------------------------------------
 Footer block
 ---------------------------------------------------------
 */

#footer{
	
	position:relative;
	display:block;
	z-index:1;
	padding:<?= DEFAULT_SPACING; ?>px;
	
}

/*
 ---------------------------------------------------------
 Footer block
 ---------------------------------------------------------
 *********************************************************
 */
