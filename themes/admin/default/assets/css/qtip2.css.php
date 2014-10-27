
/*
 *********************************************************
 ---------------------------------------------------------
 qTip
 ---------------------------------------------------------
 */

label.info-tip:before{
	
	font-family: 'vecms-icons';
	content: "\e632";
	font-size: 16px;
	line-height: 16px;
	padding: 0 5px;
	opacity: 0.3;
	
}
label.info-tip:hover:before{
	
	opacity: 1;
	
}

.qtip-vecms{
	
	<?= TOOLTIP_STYLESHEET; ?>
	
	min-width: 300px;
	
	z-index: 99999999999 !important;
}
	
	.qtip-vecms .button{
		
		margin-bottom: 0;
		
	}

	.qtip-vecms .qtip-tip,
	.qtip-vecms .qtip-tip canvas{
		color: <?= SCHEME_1_COLOR_7_COMPLEMENTARY; ?>;
	}
	.qtip-vecms .qtip-titlebar{
		
		display: block;
		
		color: <?= SCHEME_1_COLOR_7; ?>;
		padding: 0;
		margin: 0;
		font-weight: normal;
		line-height: normal;
		background-color: <?= SCHEME_1_COLOR_4; ?>;
		
		overflow: visible;
		height: 0;
		background: none;
		
		z-index: 2;
		
		width: 100%;
		text-align: right;
		
	}
		
		.qtip-vecms .qtip-titlebar .qtip-close{
			
			-moz-box-sizing: border-box;
			-webkit-box-sizing: border-box;
			box-sizing: border-box;
			
			right: 0;
			top: 0;
			position: absolute;
			margin-top: 0;
			margin-right: 0;
			border-style: none;
			color: <?= VUI_FONT_COLOR; ?>;
			
			opacity: 0.2;
			
			<?= css_transition(); ?>;
			text-align: center;
			
			width: 10%;
			
		}
		.qtip-vecms .qtip-titlebar .qtip-close:hover{
			
			opacity: 1;
			color: <?= LINK_HOVER_COLOR; ?>;
			
		}
			.qtip-vecms .qtip-titlebar .qtip-close:before{
				
				content: "\e61e";
				
				<?= FONT_ICONS_STYLESHEET; ?>
				
				font-size: 16px;
				line-height: 100%;
				padding: <?= DEFAULT_SPACING * 1.7; ?>px 0;
				
			}
			.qtip-vecms .qtip-titlebar .qtip-close .ui-icon{
				display: none;
			}
		
	.qtip-vecms .qtip-content{
		
		-moz-box-sizing: border-box;
		-webkit-box-sizing: border-box;
		box-sizing: border-box;
		
		<?= TOOLTIP_CONTENT_STYLESHEET; ?>
		
		z-index: 1;
		
	}
	.qtip-vecms .qtip-content > p:last-child,
	.qtip-vecms .qtip-content > ul:last-child,
	.qtip-vecms .qtip-content > ol:last-child,
	.qtip-vecms .qtip-content > table:last-child{
		
		margin-bottom: 0;
		padding-bottom: 0;
		
	}

	.qtip-vecms .qtip-icon{
		
		background: transparent;
		
	}

		.qtip-vecms .qtip-icon .ui-icon{
			
			width: auto;
			height: auto;
			
			float: right;
			font-size: 110%;
			font-weight: bold;
			line-height: 18px;
			color: <?= VUI_FONT_COLOR; ?>;
			text-shadow: 0 1px 0 #ffffff;
			padding: <?= DEFAULT_SPACING/2; ?>px <?= DEFAULT_SPACING + 4; ?>px;
			opacity: 0.2;
			filter: alpha(opacity=20);
			
		}

		.qtip-vecms .qtip-icon .ui-icon:hover{
			
			color: <?= VUI_FONT_COLOR; ?>;
			text-decoration: none;
			cursor: pointer;
			opacity: 0.4;
			filter: alpha(opacity=40);
		}

#qtip-growl-container{
	position: fixed;
	top: 10px;
	right: 10px;
	z-index: 1000;
}
#qtip-growl-container .qtip{
	max-width: 400px;
}
	#qtip-growl-container .qtip{
		position: static;
		min-height: 0;
		overflow: hidden;
		margin: 0 0 5px 0;
	}

.qtip-vecms .msg-inline-error,
.qtip-vecms .important{
	
	color: #de8787;
	font-weight: bold;
	
}

.qtip.notification{
	
	border: <?= DEFAULT_BORDER_DARK; ?>;
	
}
	.qtip.notification .qtip-content{
		
		width: 90%;
		
	}
.qtip.notification .qtip-close{
	
	
	
}
.qtip.notification .qtip-close .ui-icon-close{
	
	
	
}
.qtip.notification .qtip-close .ui-icon-close:before{
	
	
	
}

/*
 ---------------------------------------------------------
 qTip
 ---------------------------------------------------------
 *********************************************************
 */
