
/*
 *********************************************************
 ---------------------------------------------------------
 Info cards
 ---------------------------------------------------------
 */

.info-wrapper{
	
	position: relative;
	height: 100%;
	min-height: 96px;
	
	padding: <?= DEFAULT_SPACING * 2; ?>px;
	
}
.info-wrapper div.info-title,
.info-wrapper span.info-title{
	
	position: relative;
	display: block;
	font-size: 110%;
	font-weight: bold;
	margin-bottom: <?= DEFAULT_SPACING; ?>px;
	
}
.info-wrapper div.info-items,
.info-wrapper span.info-items{
	
	position: relative;
	display: inline-block;
	float: left;
	
}
.info-wrapper div.thumb-wrapper,
.info-wrapper span.thumb-wrapper{
	
	width: 96px;
	
}
.info-wrapper div.thumb-image-wrapper,
.info-wrapper span.thumb-image-wrapper{
	
	position: relative;
	display: block;
	
	width: 96px;
	height: 96px;
	background: #fff;
	
}
.info-wrapper .no-image div.thumb-image-wrapper:before,
.info-wrapper div.thumb-wrapper img,
.info-wrapper .no-image span.thumb-image-wrapper:before,
.info-wrapper span.thumb-wrapper img{
	
	position: relative;
	display: block;
	
	width: 100%;
	height: 100%;
	
	background: #fff;
	background-size: 100% 100%;
	
	-webkit-border-radius: 50%;
	border-radius: 50%;
	
}
.info-wrapper .no-image div.thumb-image-wrapper:before,
.info-wrapper .no-image span.thumb-image-wrapper:before{
	
	content: '';
	
	background: url('<?= THEME_IMAGE_DIR_URL; ?>/icon-default-no-image.png') no-repeat center center #fff;
	background-size: 100% 100%;
	
}
.info-wrapper div.info-items,
.info-wrapper span.info-items{
	
	position: relative;
	display: block;
	float: none;
	
}
.info-wrapper div.info-item,
.info-wrapper span.info-item{
	
	margin-bottom: <?= DEFAULT_SPACING; ?>px;
	
}
.info-wrapper div.info-item-title-inline,
.info-wrapper div.info-item-title,
.info-wrapper span.info-item-title-inline,
.info-wrapper span.info-item-title{
	
	display:block;
	font-weight: bold;
	margin-bottom: <?= DEFAULT_SPACING/2; ?>px;
	
}
.info-wrapper div.info-item-title-inline,
.info-wrapper span.info-item-title-inline{
	<?= css_display_inline_block(); ?>;
}
.info-wrapper div.info-item-content,
.info-wrapper span.info-item-content{
	display:block;
	margin-bottom: <?= DEFAULT_SPACING/2; ?>px;
	margin-left: 5px;
}

#customer-fields-ajax div.info-items,
#customer-fields-ajax span.info-items{
	padding:<?= DEFAULT_SPACING/2; ?>px;
}

textarea.js-editor{
	
	font-family: monospace;
	
	width: 80%;
	height: 300px;
}

/*
 ---------------------------------------------------------
 Info cards
 ---------------------------------------------------------
 *********************************************************
 */
