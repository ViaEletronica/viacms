
#site-block{
	
	position: relative;
	display:block;
	text-align: center;
	
}


/*
 *********************************************************
 ---------------------------------------------------------
 Top block
 ---------------------------------------------------------
 */

<?php

$logo_width = 196;
$logo_height = 110;

?>

#top-bar,
#after-banner-block{
	
	position: relative;
	display: block;
	text-align: center;
	
	background: <?= $vui->colors->vui_top_bar_bg->hex_s; ?>;
	color: <?= $vui->colors->vui_top_bar_fg->hex_s; ?>;
	
	z-index: 3;
	
}
#after-banner-block{
	
	background: url(<?= $vui->svg_file( 'bottom-shadow', $vui->colors->vui_base->darken( 40, TRUE )->rgba_s( 150 ), 'vui_change_color' ); ?>) no-repeat center bottom;
	background-size: 100% 3em;
	
}

	#top-bar > .s1,
	#after-banner-block > .s1{
		
		position: relative;
		display: block;
		text-align: left;
		margin: 0 auto;
		width: <?= VUI_DEFAULT_SITE_WIDTH; ?>;
		
	}
		
		#top-bar:after{
			
			content: '';
			position: relative;
			display: block;
			clear: both;
			
		}
		#top-bar:before{
			
			content: '';
			position: absolute;
			display: block;
			background: url(<?= $vui->svg_file( 'top-shadow', $vui->colors->vui_base->darken( 40, TRUE )->hex_s, 'vui_change_color' ); ?>) no-repeat center center;
			background-size: 100% 100%;
			left: 0;
			bottom: -2em;
			width:100%;
			height: 2em;
			z-index: -1;
			overflow: hidden;
			
		}
		#top-logo{
			
			position: relative;
			<?= $vui->css->display_inline_block(); ?>
			float: left;
			
			z-index: 2;
			
		}
			#logo{
				
				position: relative;
				<?= $vui->css->display_inline_block(); ?>
				width: <?= $logo_width; ?>px;
				height: <?= $logo_height; ?>px;
				
				background: url(<?= $vui->svg_file( 'top-logo', $vui->colors->vui_base->hex_s ); ?>) no-repeat center center;
				background-size: 100% auto;
				
			}
		
/* ---------------------------------------------------- */
/* Top menu */

		#top-menu,
		#after-banner-menu{
			
			position: relative;
			display: block;
			text-align: center;
			
		}
		#top-menu{
			
			text-align: right;
			z-index: 1;
			
		}
		#top-menu ul,
		#top-menu li,
		#after-banner-menu ul,
		#after-banner-menu li{
			
			position: relative;
			<?= $vui->css->display_inline_block() ?>
			padding:0;
			margin:0;
			z-index:1;
			
		}
		#top-menu ul,
		#after-banner-menu ul{
			
			padding: 0;
			
		}
		#top-menu > ul.menu,
		#after-banner-menu > ul.menu{
			
			<?= $vui->css->display_inline_block() ?>
			padding: 0;
			
		}
		#top-menu > ul.menu{
			
			text-align: left;
			
		}
		
		
		#top-menu li:hover,
		#after-banner-menu li:hover{
			z-index:1000;
		}
		#top-menu ul.menu ul,
		#after-banner-menu ul.menu ul{
			position:absolute;
			top:100%;
			left:0;
			
			text-align: left;
			
			background: <?= $vui->colors->vui_base->hex_s; ?>;
			color: <?= $vui->colors->vui_base->get_ro_color()->hex_s; ?>;
			
			padding:0;
			z-index: -11;
			
			<?= $vui->css->transition( VUI_DEFAULT_TRANSITION ) ?>
			<?= $vui->css->box_shadow( '0 0.5em 2.5em ' . $vui->colors->vui_base->darken( 20, TRUE )->rgba_s( 100 ) ); ?>
			
			<?= $vui->css->transform( 'rotate( 0deg ) translate( 0,-2em ) scale( 1 )' ); ?>
			
			opacity: 0;
			overflow: hidden;
			height: 0;
			
		}
		#top-menu ul.menu li li ul,
		#after-banner-menu ul.menu li li ul{
			
			position: absolute;
			top: 0px;
			left: 100%;
			margin-top: -<?= VUI_SPACING; ?>em;
			
			<?= $vui->css->transform( 'rotate( 0deg ) translate( -2em,0 ) scale( 1 )' ); ?>
			
		}
		#top-menu li:hover > ul,
		#after-banner-menu li:hover > ul,
		#top-menu ul.menu li li:hover > ul,
		#after-banner-menu ul.menu li li:hover > ul{
			
			display: block;
			
			padding: <?= VUI_SPACING; ?>em 0;
			
			opacity: 1;
			overflow: visible;
			height: auto;
			
			z-index: 1;
			
			<?= $vui->css->transform( 'rotate( 0deg ) translate( 0,0 ) scale( 1 )' ); ?>
			
		}
		#top-menu li a,
		#after-banner-menu li a{
			
			position: relative;
			<?= $vui->css->display_inline_block() ?>
			font-size: 100%;
			color: <?= $vui->colors->vui_base->hex_s; ?>;
			text-transform: uppercase;
			text-decoration: none;
			text-shadow:none;
			white-space:nowrap;
			padding: <?= VUI_SPACING; ?>em;
			z-index: 2;
			
		}
		#top-menu > ul.menu > li > a{
			
			font-family: <?= VUI_SEC_FONT_FAMILY; ?>;
			line-height: <?= $logo_height; ?>px;
			height: <?= $logo_height; ?>px;
			padding-top: 0;
			padding-bottom: 0;
			
		}
		#top-menu > ul.menu > li > a:before,
		#after-banner-menu > ul.menu > li > a:before{
			
			content: '';
			position: absolute;
			
			left: 50%;
			top: 35%;
			width: 20px;
			height: 20px;
			margin-top: -10px;
			
			<?= $vui->css->border_radius( '100%' ) ?>
			
			<?= $vui->css->transition( VUI_DEFAULT_TRANSITION ); ?>
			
			background: <?= $vui->colors->vui_base->darken( 15, TRUE )->hex_s; ?>;
			
			opacity: 0;
			
		}
		#after-banner-menu > ul.menu > li > a:before{
			
			top: 20%;
			
		}
		#top-menu > ul.menu > li.current > a:before,
		#top-menu > ul.menu > li > a:hover:before,
		#top-menu > ul.menu > li:hover > a:before,
		#after-banner-menu > ul.menu > li.current > a:before,
		#after-banner-menu > ul.menu > li > a:hover:before,
		#after-banner-menu > ul.menu > li:hover > a:before{
			
			left: 0%;
			width: 100%;
			height: 3px;
			margin-top: -1.5px;
			
			<?= $vui->css->border_radius( '0' ) ?>
			
			<?= $vui->css->transition( VUI_DEFAULT_TRANSITION ); ?>
			
			opacity: 1;
			
		}
		#top-menu > ul.menu > li.parent > a:hover:before,
		#top-menu > ul.menu > li.parent:hover > a:before,
		#after-banner-menu > ul.menu > li.parent > a:hover:before,
		#after-banner-menu > ul.menu > li.parent:hover > a:before{
			
			height: auto;
			margin-top: 0;
			
			background: <?= $vui->colors->vui_base->hex_s; ?>;
			
			top: 80%;
			bottom: 0;
			
		}
		#top-menu ul.menu li.parent > a:after,
		#after-banner-menu ul.menu li.parent > a:after{
			
			content: '';
			position: absolute;
			
			right: 1em;
			top: 50%;
			width: 0.333em;
			height: 0.333em;
			margin-top: -0.15em;
			
			<?= $vui->css->border_radius( '100%' ) ?>
			
			<?= $vui->css->transition( VUI_DEFAULT_TRANSITION ); ?>
			
			background: <?= $vui->colors->vui_base->darken( 15, TRUE )->get_ro_color()->hex_s; ?>;
			
			opacity: 1;
			
		}
		#top-menu > ul.menu > li.parent > a:after,
		#after-banner-menu > ul.menu > li.parent > a:after{
			
			background: <?= $vui->colors->vui_base->darken( 15, TRUE )->rgba_s( 50 ); ?>;
			
		}
		
		
		#top-menu li li,
		#top-menu li li a,
		#after-banner-menu li li,
		#after-banner-menu li li a{
			
			text-transform: none;
			display: block;
			color: <?= $vui->colors->vui_base->get_ro_color()->hex_s; ?>;
			
		}
		#top-menu li li a,
		#after-banner-menu li li a{
			
			padding: <?= VUI_SPACING / 2; ?>em <?= VUI_SPACING * 1.5; ?>em;
			
		}
		#top-menu li.parent > a,
		#after-banner-menu li.parent > a{
			
			padding-right: 2.3em;
			
		}
		#top-menu li li a:before,
		#after-banner-menu li li a:before{
			
			content: '';
			
			position: absolute;
			left: 1em;
			top: 50%;
			margin-top: -1em;
			
			width: 2em;
			height: 2em;
			
			background: <?= $vui->colors->vui_base->darken( 10, TRUE )->hex_s; ?>;
			
			<?= $vui->css->border_radius( '100%' ); ?>
			
			<?= $vui->css->transition( VUI_DEFAULT_TRANSITION ); ?>
			
			opacity: 0;
			
			z-index: -1;
			
		}
		#top-menu li.current > a,
		#top-menu li.current:hover > a,
		#top-menu li:hover > a,
		#top-menu li a:hover,
		#top-menu > li:hover,
		#after-banner-menu li.current > a,
		#after-banner-menu li.current:hover > a,
		#after-banner-menu li:hover > a,
		#after-banner-menu li a:hover,
		#after-banner-menu > li:hover{
			
			color: <?= $vui->colors->vui_base->darken( 15, TRUE )->hex_s; ?>;
			
		}
		#top-menu li.current:hover > a,
		#after-banner-menu li.current:hover > a{
			
		}
		#top-menu li.current li.current > a,
		#top-menu li li a:hover,
		#top-menu li li:hover > a,
		#after-banner-menu li.current li.current > a,
		#after-banner-menu li li a:hover,
		#after-banner-menu li li:hover > a{
			
			color: <?= $vui->colors->vui_base->darken( 10, TRUE )->get_ro_color()->hex_s; ?>;
			
		}
		#top-menu li.current li.current > a:before,
		#top-menu li li a:hover:before,
		#top-menu li li:hover > a:before,
		#after-banner-menu li.current li.current > a:before,
		#after-banner-menu li li a:hover:before,
		#after-banner-menu li li:hover > a:before{
			
			left: 0;
			top: 0;
			
			width: 100%;
			height: 100%;
			margin-top: 0;
			
			background: <?= $vui->colors->vui_base->darken( 10, TRUE )->hex_s; ?>;
			
			<?= $vui->css->border_radius( 0 ); ?>
			
			opacity: 1;
			
		}
		
		

/* ---------------------------------------------------- */
/* Top banner */

#top-banner-block{
	
	position: relative;
	display: block;
	text-align: center;
	
	background: <?= $vui->colors->vui_top_banner_bg->hex_s; ?>;
	color: <?= COLOR_SCHEME_2___FOREGROUND_NORMAL; ?>;
	
	z-index: 1;
	
}

	#top-banner-block > .s1{
		
		position: relative;
		<?= $vui->css->display_inline_block(); ?>
		text-align: left;
		margin: 0 auto;
		width: <?= VUI_DEFAULT_SITE_WIDTH; ?>;
		z-index: 1;
		
	}
	#top-banner-block:after{
		
		content: '';
		position: absolute;
		display: block;
		background-image: url(<?= $vui->svg_file( 'bottom-shadow', $vui->colors->vui_base->darken( 40, TRUE )->hex_s, 'vui_change_color' ); ?>);
		background-size: 100% 100%;
		left: 0;
		bottom: 0;
		width:100%;
		height: 2em;
		z-index: 2;
		overflow: hidden;
		
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

#content-block{
	
	position: relative;
	display: block;
	margin: 0 auto;
	text-align: center;
	
}
	#content-block ul{
		
	}
		#content-block li{
			
		}
			#content-block li li{
				
			}
	#content-block > .s1{
		
		position: relative;
		<?= $vui->css->display_inline_block(); ?>
		margin: 0 auto;
		text-align: left;
		width: <?= VUI_DEFAULT_SITE_WIDTH; ?>;
		
		background: <?= COLOR_SCHEME_1___BACKGROUND_NORMAL; ?>;
		
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
 Bottom content block
 ---------------------------------------------------------
 */

#bottom-content-block{
	
	position: relative;
	display: block;
	text-align: center;
	
	margin-top: <?= VUI_SPACING * 2; ?>em;
	margin-bottom: <?= VUI_SPACING * 2; ?>em;
	
	z-index: 1;
	
	background: <?= COLOR_G1_8; ?>;
	color: <?= COLOR_G7_1; ?>;
	
}
	#bottom-content-block > .s1{
		
		position: relative;
		<?= $vui->css->display_inline_block() ?>
		text-align: left;
		margin: 0 auto;
		width: <?= SITE_WIDTH; ?>;
		
	}
	
		#bottom-content-block > .s1 > .s2{
			
			position: relative;
			display: block;
			
		}
		
/*
 ---------------------------------------------------------
 Bottom content block
 ---------------------------------------------------------
 *********************************************************
 */

/*
 *********************************************************
 ---------------------------------------------------------
 Footer block
 ---------------------------------------------------------
 */

#footer-block{
	
	position: relative;
	display: block;
	text-align: center;
	
	background: <?= $vui->colors->vui_footer_block_bg->hex_s; ?>;
	color: <?= $vui->colors->vui_footer_block_fg->hex_s; ?>;
	
	z-index: 1;
	
}
	#footer-block:before{
		
		content: '';
		position: absolute;
		display: block;
		background: url(<?= $vui->svg_file( 'top-shadow', $vui->colors->vui_base->darken( 40, TRUE )->hex_s, 'vui_change_color' ); ?>) no-repeat center center;
		background-size: 100% 100%;
		left: 0;
		top: 0;
		width:100%;
		height: 2em;
		z-index: 2;
		overflow: hidden;
		
	}
	#footer-block h1,
	#footer-block h2,
	#footer-block h3,
	#footer-block h4,
	#footer-block h5,
	#footer-block h6{
		
		color: <?= $vui->colors->vui_footer_block_fg->hex_s; ?>;
		
	}
	#footer-block a{
		
		color: <?= $vui->colors->vui_footer_block_fg->hex_s; ?>;
		
	}
	#footer-block a:hover,
	#footer-block a:focus{
		
		color: <?= $vui->colors->vui_footer_block_fg->darken( 40, TRUE )->hex_s; ?>;
		
		text-decoration: underline;
		
	}
	#footer-block > .s1{
		
		position: relative;
		<?= $vui->css->display_inline_block() ?>
		margin: 0 auto;
		text-align: left;
		width: <?= VUI_DEFAULT_SITE_WIDTH; ?>;
		
	}
	.width-500-960 #footer-block > .s1,
	.width-500-lower #footer-block > .s1{
		
		width:100%;
		
	}
		#footer-block .footer-col{
			
			position: relative;
			<?= $vui->css->display_inline_block() ?>
			margin:0 auto;
			padding: <?= VUI_SPACING; ?>em;
			text-align: left;
			width: 100%;
			
		}
		#footer-block.footer-2-cols .footer-col{
			
			width: 50%;
			
		}

		#footer-block.footer-3-cols .footer-col{
			
			width: 33.333333%;
			
		}

#footer-block .contact-module-phone{
	
	position: relative;
	display: block;
	font-weight: normal;
	line-height: normal;
	
}

#footer-block .list-info-wrapper-website-wwwfacebookcom,
#footer-block .list-info-wrapper-website-facebookcom{
	
	background: url(<?= $vui->svg_file( 'icon-facebook', $vui->colors->vui_footer_block_fg->hex_s ); ?>) no-repeat center center;
	
}
#footer-block .list-info-wrapper-website-wwwplusgooglecom,
#footer-block .list-info-wrapper-website-plusgooglecom{
	
	background: url(<?= $vui->svg_file( 'icon-gplus', $vui->colors->vui_footer_block_fg->hex_s ); ?>) no-repeat center center;
	
}
#footer-block .list-info-wrapper-website-twittercom,
#footer-block .list-info-wrapper-website-wwwtwittercom{
	
	background: url(<?= $vui->svg_file( 'icon-twitter', $vui->colors->vui_footer_block_fg->hex_s ); ?>) no-repeat center center;
	
}
#footer-block .list-info-wrapper-website-youtubecom,
#footer-block .list-info-wrapper-website-wwwyoutubecom{
	
	background: url(<?= $vui->svg_file( 'icon-youtube', $vui->colors->vui_footer_block_fg->hex_s ); ?>) no-repeat center center;
	
}
#footer-block .list-info-wrapper-website-facebookcom,
#footer-block .list-info-wrapper-website-wwwfacebookcom,
#footer-block .list-info-wrapper-website-plusgooglecom,
#footer-block .list-info-wrapper-website-twittercom,
#footer-block .list-info-wrapper-website-wwwtwittercom,
#footer-block .list-info-wrapper-website-youtubecom,
#footer-block .list-info-wrapper-website-wwwyoutubecom{
	
	background-size: 100%;
	
}

/*
 ---------------------------------------------------------
 Footer block
 ---------------------------------------------------------
 *********************************************************
 */











@media screen and ( max-width: 480px ) {
	
	.vui body,
	body.vui{
		
		font-size: <?= (int)VUI_DEFAULT_FONT_SIZE * 0.9; ?>em;
		
	}
	
	#top-bar > .s1,
	#after-banner-block > .s1,
	#footer-block > .s1,
	#bottom-content-block > .s1,
	#content-block > .s1,
	#top-banner-block > .s1{
		
		width: <?= VUI_SITE_WIDTH_480_L; ?>;
		
	}
	
}

@media screen and ( max-width: 960px ) {
	
	#top-bar > .s1,
	#after-banner-block > .s1,
	#footer-block > .s1,
	#bottom-content-block > .s1,
	#content-block > .s1,
	#top-banner-block > .s1{
		
		width: <?= VUI_SITE_WIDTH_640_960; ?>;
		
	}
	
	/*
	 **************************************************************************************************
	 **************************************************************************************************
	 --------------------------------------------------------------------------------------------------
	 Top menu
	 --------------------------------------------------------------------------------------------------
	 */
	
	#top-menu,
	#after-banner-menu{
		
		position: fixed;
		display: block;
		right: 10px;
		top: 10px;
		width: 64px;
		max-width: 300px;
		height: 64px;
		overflow: hidden;
		
		text-align: left;
		
		color: <?= $vui->colors->vui_base->get_ro_color()->hex_s; ?>;
		
		<?= $vui->css->transition( 'width 0.3s ease-in-out, right 0.5s ease-in-out' ) ?>
		
	}
	
	#top-menu:hover,
	#after-banner-menu:hover{
		
		right: 0;
		top: 0;
		bottom: 0;
		width: 80%;
		height: 100%;
		padding: 0;
		overflow: auto;
		
		background: transparent;
		
		<?= $vui->css->border_radius( '0' ) ?>
		
	}
	#top-menu:before,
	#after-banner-menu:before{
		
		content: '';
		
		position: fixed;
		right: 10px;
		top: 10px;
		width: 64px;
		height: 64px;
		margin: 0;
		
		<?= $vui->colors->vui_base->getCssGradient( 4, 'rtl', TRUE, 'url(' . $vui->svg_file( 'icon-menu', $vui->colors->vui_base->get_ro_color()->hex_s ) . '), ' ); ?>
		background-repeat: no-repeat, no-repeat;
		background-position: center center, center center;
		background-size: auto auto, 100% 100%;
		
		<?= $vui->css->border_radius( '100%' ) ?>
		
		z-index: 2;
		
		<?= $vui->css->transition( 'all 0.4s ease-in-out' ) ?>
		
		opacity: 1;
		
		<?= $vui->css->transform( 'rotate( 0deg ) translate( 0,0 ) scale( 1 )' ); ?>
		
	}
	#top-menu:hover:before,
	#after-banner-menu:hover:before{
		
		opacity: 0;
		
	}
	#top-menu ul.menu,
	#top-menu ul.menu li,
	#top-menu ul.menu a,
	#top-menu ul.menu ul,
	#after-banner-menu ul.menu,
	#after-banner-menu ul.menu li,
	#after-banner-menu ul.menu a,
	#after-banner-menu ul.menu ul{
		
		position: relative;
		display: block;
		overflow: visible;
		background: none;
		
	}
	#top-menu ul.menu ul,
	#after-banner-menu ul.menu ul{
		
		display: block;
		
		padding: 0;
		
		opacity: 1;
		overflow: visible;
		height: auto;
		
		z-index: 1;
		
		<?= $vui->css->transition( 'none' ) ?>
		<?= $vui->css->box_shadow( 'none' ); ?>
		
		<?= $vui->css->transform( 'rotate( 0deg ) translate( 0,0 ) scale( 1 )' ); ?>
		
	}
	#top-menu > ul.menu,
	#after-banner-menu > ul.menu{
		
		background-color: <?= $vui->colors->vui_base->hex_s; ?>;
		background-repeat: no-repeat, no-repeat;
		background-position: center center, center center;
		background-size: auto auto, 100% 100%;
		
		opacity: 0;
		
		color: <?= $vui->colors->vui_base->get_ro_color()->hex_s; ?>;
		
		width: 100%;
		height: 100%;
		
		padding: 64px;
		margin: 0;
		
		<?= $vui->css->box_shadow( '0 0 0 transparent' ); ?>
		<?= $vui->css->border_radius( VUI_DEFAULT_BORDER_RADIUS ) ?>
		
		border-left: 0 solid <?= $vui->colors->vui_base->hex_s; ?>;
		
		<?= $vui->css->transition( 'all 0.5s ease-in-out' ) ?>
		
	}
	#top-menu:hover > ul,
	#after-banner-menu:hover > ul{
		
		opacity: 1;
		
		width: auto;
		height: auto;
		padding-left: 0;
		padding-right: 0;
		padding-top: <?= VUI_SPACING; ?>em;
		padding-bottom: <?= VUI_SPACING; ?>em;
		margin: <?= VUI_SPACING; ?>em;
		margin-left: <?= VUI_SPACING * 2; ?>em;
		border-left: 0.2em solid <?= $vui->colors->vui_base->hex_s; ?>;
		
		<?= $vui->css->box_shadow( '0 0.5em ' . ( VUI_SPACING * 2 ) . 'em ' . $vui->colors->vui_base->darken( 20, TRUE )->rgba_s( 100 ) ); ?>
		
	}
		#top-menu ul.menu li li ul,
		#after-banner-menu ul.menu li li ul,
		#top-menu li:hover > ul,
		#after-banner-menu li:hover > ul,
		#top-menu ul.menu li li:hover ul,
		#after-banner-menu ul.menu li li:hover ul{
			
			position: relative;
			left: auto;
			display: block;
			
			padding: 0;
			margin: 0;
			
			opacity: 1;
			overflow: visible;
			height: auto;
			
			z-index: 1;
			
			<?= $vui->css->transform( 'rotate( 0deg ) translate( 0,0 ) scale( 1 )' ); ?>
			
		}
	#top-menu ul li,
	#after-banner-menu ul li{
		
		
		
	}
	#top-menu > ul.menu > li:after,
	#after-banner-menu > ul.menu > li:after{
		
		content: '';
		position: relative;
		display: block;
		width: 100%;
		height: 0;
		border-bottom: thin solid <?= $vui->colors->vui_base->darken( 10, TRUE )->hex_s; ?>;
		
		background: <?= $vui->colors->vui_base->darken( 10, TRUE )->hex_s; ?>;
		
	}
	#top-menu li a,
	#top-menu > ul.menu > li > a,
	#after-banner-menu li a,
	#after-banner-menu > ul.menu > li > a{
		
		text-transform: none;
		line-height: normal;
		height: auto;
		white-space: normal;
		
	}
	#top-menu > ul.menu > li > a:before,
	#after-banner-menu > ul.menu > li > a:before{
		
		content: '';
		
		position: absolute;
		left: 1em;
		top: 50%;
		margin-top: -1em;
		
		width: 2em;
		height: 2em;
		
		background: <?= $vui->colors->vui_base->darken( 10, TRUE )->hex_s; ?>;
		
		<?= $vui->css->border_radius( '100%' ); ?>
		
		<?= $vui->css->transition( VUI_DEFAULT_TRANSITION ); ?>
		
		opacity: 0;
		
		z-index: -1;
		
	}
	#top-menu > ul.menu > li.current > a:before,
	#top-menu > ul.menu > li > a:hover:before,
	#top-menu > ul.menu > li:hover > a:before,
	#top-menu > ul.menu > li.parent > a:hover:before,
	#top-menu > ul.menu > li.parent:hover > a:before,
	#top-menu > ul.menu > li.parent:hover > a:hover:before,
	#after-banner-menu > ul.menu > li.current > a:before,
	#after-banner-menu > ul.menu > li > a:hover:before,
	#after-banner-menu > ul.menu > li:hover > a:before,
	#after-banner-menu > ul.menu > li.parent > a:hover:before,
	#after-banner-menu > ul.menu > li.parent:hover > a:before,
	#after-banner-menu > ul.menu > li.parent:hover > a:hover:before,
	
	#top-menu > ul.menu li.current > a:before,
	#top-menu > ul.menu li > a:hover:before,
	#top-menu > ul.menu li:hover > a:before,
	#top-menu > ul.menu li.parent > a:hover:before,
	#top-menu > ul.menu li.parent:hover > a:before,
	#top-menu > ul.menu li.parent:hover > a:hover:before,
	#after-banner-menu > ul.menu li.current > a:before,
	#after-banner-menu > ul.menu li > a:hover:before,
	#after-banner-menu > ul.menu li:hover > a:before,
	#after-banner-menu > ul.menu li.parent > a:hover:before,
	#after-banner-menu > ul.menu li.parent:hover > a:before,
	#after-banner-menu > ul.menu li.parent:hover > a:hover:before{
		
		left: 0;
		top: 0;
		
		width: 100%;
		height: 100%;
		margin-top: 0;
		
		background: <?= $vui->colors->vui_base->darken( 10, TRUE )->hex_s; ?>;
		
		<?= $vui->css->border_radius( 0 ); ?>
		
		opacity: 1;
		
	}
	#top-menu li.parent > a,
	#after-banner-menu li.parent > a{
		
		padding-right: <?= VUI_SPACING * 1.5; ?>em;
		
	}
	#top-menu ul.menu li.parent > a:after,
	#after-banner-menu ul.menu li.parent > a:after{
		
		display: none;
		
	}
	#top-menu li.hash-link:hover > a,
	#top-menu li:hover > a[href="#"],
	#top-menu li.hash-link,
	#top-menu li.hash-link > a,
	#top-menu li > a[href="#"],
	#after-banner-menu li.hash-link:hover > a,
	#after-banner-menu li:hover > a[href="#"],
	#after-banner-menu li.hash-link,
	#after-banner-menu li.hash-link > a,
	#after-banner-menu li > a[href="#"]{
		
		display: none;
		
	}
	#top-menu > ul.menu > li > a,
	#top-menu li a,
	#after-banner-menu li a,
	#top-menu li li a,
	#after-banner-menu li li a{
		
		background: transparent;
		color: <?= $vui->colors->vui_base->get_ro_color()->hex_s; ?>;
		padding: <?= VUI_SPACING / 1.5; ?>em <?= VUI_SPACING * 1.5; ?>em;
		
	}
	#top-menu li li a,
	#after-banner-menu li li a{
		
	}
	#top-menu li.current > a,
	#top-menu li.current:hover > a,
	#top-menu li:hover > a,
	#top-menu li a:hover,
	#top-menu li:hover + a,
	#after-banner-menu li.current > a,
	#after-banner-menu li.current:hover > a,
	#after-banner-menu li:hover > a,
	#after-banner-menu li a:hover,
	#after-banner-menu li:hover + a{
		
		color: <?= $vui->colors->vui_base->darken( 10, TRUE )->get_ro_color()->hex_s; ?>;
		
	}
	#top-menu li.current li.current > a,
	#top-menu li li a:hover,
	#after-banner-menu li.current li.current > a,
	#after-banner-menu li li a:hover{
		
		background: <?= COLOR_SCHEME_5___FOREGROUND_NORMAL; ?>;
		color: <?= COLOR_SCHEME_5___BACKGROUND_NORMAL; ?>;
		
	}
	#top-menu ul.menu a,
	#after-banner-menu ul.menu a{
		
		<?= $vui->css->transition( VUI_DEFAULT_TRANSITION ); ?>
		
		white-space: normal;
	}
	
	/*
	 --------------------------------------------------------------------------------------------------
	 Top menu
	 --------------------------------------------------------------------------------------------------
	 **************************************************************************************************
	 **************************************************************************************************
	 */
	
}











/* ---------------------------------------------------- */
/* Thumb */

.thumb{
	
	position: relative;
	display: block;
	
	margin-top: <?= VUI_SPACING; ?>em;
	margin-bottom: <?= VUI_SPACING; ?>em;
	
}
.thumb .s1{
	
	position: relative;
	<?= $vui->css->display_inline_block(); ?>
	min-width: 10em;
	min-height: 10em;
	overflow: hidden;
	
	<?= $vui->css->border_radius( VUI_DEFAULT_BORDER_RADIUS . ' ' . VUI_DEFAULT_BORDER_RADIUS . ' 0 0' ); ?>
	
	<?= $vui->css->box_shadow( '0 0.2em 0.8em ' . $vui->colors->vui_base->darken( 20, TRUE )->rgba_s( 50 ) ); ?>
	
	border: 0.2em solid <?= $vui->colors->vui_lighter->hex_s; ?>;
	
	<?= $vui->css->transition( VUI_DEFAULT_TRANSITION ); ?>
	
}
.thumb .s1:before{
	
	content: "";
	display: block;
	padding-top: 100%;
	
}
.thumb .s1:hover{
	
	<?= $vui->css->box_shadow( '0 0.7em 2em ' . $vui->colors->vui_base->darken( 30, TRUE )->rgba_s( 100 ) ); ?>
	
}
.thumb .s2{
	
	position: absolute;
	top: 50%;
	transform: translateY(-50%);
	width: 100%;
	
}
.thumb .s2 a{
	
	position: relative;
	width: 100%;
	height: 100%;
	
}
.thumb .s2 img{
	
	position: relative;
	width: 100%;
	
	<?= $vui->css->filter( array( 'saturate' => 0.3, ) ); ?>
	
}
.thumb:hover .s2 img{
	
	<?= $vui->css->filter( array( 'saturate' => 1, ) ); ?>
	
}














@media screen and ( min-width: 960px ) and ( max-width: 1280px ) {
	
	#top-bar > .s1,
	#after-banner-block > .s1,
	#footer-block > .s1,
	#bottom-content-block > .s1,
	#content-block > .s1,
	#top-banner-block > .s1{
		
		width: <?= VUI_SITE_WIDTH_960_1280; ?>;
		
	}
	
}

@media screen and ( min-width: 1280px ) and ( max-width: 1400px ) {
	
	#top-bar > .s1,
	#after-banner-block > .s1,
	#footer-block > .s1,
	#bottom-content-block > .s1,
	#content-block > .s1,
	#top-banner-block > .s1{
		
		width: <?= VUI_SITE_WIDTH_1280_1400; ?>;
		
	}
	
}
@media screen and ( min-width: 1400px ) and ( max-width: 1920px ) {
	
	#top-bar > .s1,
	#after-banner-block > .s1,
	#footer-block > .s1,
	#bottom-content-block > .s1,
	#content-block > .s1,
	#top-banner-block > .s1{
		
		width: <?= VUI_SITE_WIDTH_1400_1920; ?>;
		
	}
	
}