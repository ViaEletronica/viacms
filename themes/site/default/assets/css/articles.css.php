
<?php
	
	$articles_horizontal_margins = VUI_SPACING * 2;
	$max_columns = 20;
	
?>

/*
 *********************************************************
 ---------------------------------------------------------
 Articles list
 ---------------------------------------------------------
 */

.articles-list{
	
	position: relative;
	display: block;
	
}
.articles-list .col{
	
	position: relative;
	display: block;
	
}

<?php for ( $i = 2; $i <= $max_columns; $i++ ) { ?>

.articles-list .columns-<?= $i; ?> .col{
	
	<?= $vui->css->display_inline_block(); ?>
	
	width: <?= 100 / $i; ?>%;
	
}

<?php } ?>

.articles-list .article{
	
	vertical-align: top;
	
	<?= $vui->css->transition(); ?>
	
	padding-top: <?= VUI_SPACING; ?>em;
	padding-bottom: <?= VUI_SPACING; ?>em;
	
}
.articles-list .featured{
	
	vertical-align: top;
	
	display: block;
	
	width: 100%;
	
}
.articles-list .article:hover{
	
}

.articles-list .row-separator{
	
	display: none;
	
}
.articles-list .row-separator:last-of-type{
	
	display: none;
	
}


/* ---------------------------------------------------- */
/* Thumb */

.articles-list .article .thumb{
	
	position: relative;
	display: block;
	
	margin-left: <?= $articles_horizontal_margins; ?>em;
	margin-right: <?= $articles_horizontal_margins; ?>em;
	
	margin-top: <?= VUI_SPACING; ?>em;
	margin-bottom: <?= VUI_SPACING; ?>em;
	
	text-align: center;
	
}
.articles-list .article .thumb .s1{
	
	position: relative;
	display: block;
	max-width: 100%;
	max-height: 10em;
	overflow: hidden;
	
	<?= $vui->css->border_radius( VUI_DEFAULT_BORDER_RADIUS . ' ' . VUI_DEFAULT_BORDER_RADIUS . ' 0 0' ); ?>
	
	<?= $vui->css->box_shadow( '0 0.2em 0.8em ' . $vui->colors->vui_base->darken( 20, TRUE )->rgba_s( 50 ) ); ?>
	
	border: 0.2em solid <?= $vui->colors->vui_lighter->hex_s; ?>;
	
	<?= $vui->css->transition(); ?>
	
}
.articles-list .article .thumb .s1:hover{
	
	<?= $vui->css->box_shadow( '0 0.7em 2em ' . $vui->colors->vui_base->darken( 30, TRUE )->rgba_s( 100 ) ); ?>
	
}
.articles-list .article .thumb .s2{
	
}
.articles-list .article .thumb .s2 a{
	
	position: relative;
	width: 100%;
	height: 100%;
	
}
.articles-list .article .thumb .s2 img{
	
	position: relative;
	width: 100%;
	
}



/* ---------------------------------------------------- */
/* Article title*/

.articles-list .article .title{
	
	position: relative;
	display: block;
	
	margin-left: <?= $articles_horizontal_margins; ?>em;
	margin-right: <?= $articles_horizontal_margins; ?>em;
	
	margin-top: <?= VUI_SPACING; ?>em;
	margin-bottom: <?= VUI_SPACING; ?>em;
	
	text-align: center;
	
}
.articles-list .article .title *{
	
	position: relative;
	display: block;
	
	margin-top: 0;
	margin-bottom: 0;
	
}
.articles-list .article .title h3{
	
}
.articles-list .article .title h3,
.articles-list .article .title h3 a{
	
	color: <?= VUI_SEC_FONT_COLOR; ?>;
	
}


/* ---------------------------------------------------- */
/* Article info */

.articles-list .article .info{
	
	margin-left: 0;
	margin-right: 0;
	
	opacity: 1;
	
}


/* ---------------------------------------------------- */
/* Article category*/

.articles-list .article .category{
	
	position: relative;
	display: block;
	
	margin-left: <?= $articles_horizontal_margins; ?>em;
	margin-right: <?= $articles_horizontal_margins; ?>em;
	
	text-align: center;
	
	font-size: 80%;
	
	opacity: 0.3;
	
}


/* ---------------------------------------------------- */
/* Article created by*/

.articles-list .article .created-by{
	
	position: relative;
	display: block;
	
	margin-left: <?= $articles_horizontal_margins; ?>em;
	margin-right: <?= $articles_horizontal_margins; ?>em;
	
	text-align: center;
	
	font-size: 80%;
	
	opacity: 0.3;
	
}
.articles-list .article .post-created-by{
	
	position: relative;
	display: block;
	
	clear: both;
	
}


/* ---------------------------------------------------- */
/* Created date time */

.articles-list .article .created-date-time{
	
	position: relative;
	display: block;
	
	margin-left: <?= $articles_horizontal_margins; ?>em;
	margin-right: <?= $articles_horizontal_margins; ?>em;
	
	margin-top: <?= VUI_SPACING; ?>em;
	margin-bottom: <?= VUI_SPACING; ?>em;
	
	text-align: center;
	
	overflow: hidden;
	
}
.articles-list .article .created-date-time .s1:before,
.articles-list .article .created-date-time .s1:after{
	
	content: '';
	
	position: absolute;
	display: block;
	
	top: 50%;
	left: 120%;
	
	width: 20000%;
	height: 0;
	
	border-bottom: thin solid <?= $vui->colors->vui_darker->rgba_s( 30 ); ?>;
	
}
.articles-list .article .created-date-time .s1:after{
	
	left: auto;
	right: 120%;
	
}
.articles-list .article .created-date-time .s1{
	
	position: relative;
	<?= $vui->css->display_inline_block(); ?>
	
	margin-left: auto;
	margin-right: auto;
	
	text-align: center;
	
}
.articles-list .article .created-date-time .s2{
	
	position: relative;
	display: table;
	width: 5em;
	height: 5em;
	
	text-align: center;
	font-size: .7em;
	line-height: 1em;
	
	overflow: hidden;
	
	background: <?= $vui->colors->vui_darker->rgba_s( 5 ); ?>;
	color: <?= $vui->colors->vui_darker->rgba_s( 100 ); ?>;
	
	<?= $vui->css->border_radius( '100%' ); ?>
	
	vertical-align: middle;
	
}
.articles-list .article .created-date-time .s2 > .datetime{
	
	position: relative;
	display: table-cell;
	width: 100%;
	height: 100%;
	
	vertical-align: middle;
	
}
.articles-list .article .created-date-time .day-month{
	
	position: relative;
	display: block;
	
}


/* ---------------------------------------------------- */
/* Article content*/

.articles-list .article .content{
	
	position: relative;
	display: block;
	
	margin-left: <?= $articles_horizontal_margins; ?>em;
	margin-right: <?= $articles_horizontal_margins; ?>em;
	
	margin-top: <?= VUI_SPACING; ?>em;
	margin-bottom: <?= VUI_SPACING; ?>em;
	
	text-align: left;
	
}


/* ---------------------------------------------------- */
/* Read more*/

.articles-list .article .read-more{
	
	position: relative;
	display: block;
	
	margin-left: <?= $articles_horizontal_margins; ?>em;
	margin-right: <?= $articles_horizontal_margins; ?>em;
	
	margin-top: <?= VUI_SPACING; ?>em;
	margin-bottom: <?= VUI_SPACING; ?>em;
	
	text-align: center;
	
	overflow: hidden;
	
}
.articles-list .article .read-more .s1:before,
.articles-list .article .read-more .s1:after{
	
	content: '';
	
	position: absolute;
	display: block;
	
	top: 50%;
	left: 120%;
	
	width: 500%;
	height: 0;
	
	border-bottom: thin solid <?= $vui->colors->vui_darker->rgba_s( 30 ); ?>;
	
}
.articles-list .article .read-more .s1:after{
	
	left: auto;
	right: 120%;
	
}
.articles-list .article .read-more .s1{
	
	position: relative;
	<?= $vui->css->display_inline_block(); ?>
	
	margin-left: auto;
	margin-right: auto;
	
	text-align: center;
	
}
.articles-list .article .read-more .s2{
	
	position: relative;
	<?= $vui->css->display_inline_block(); ?>
	width: 3em;
	height: 3em;
	
	text-align: center;
	
	overflow: hidden;
	
	color: <?= $vui->colors->vui_darker->rgba_s( 100 ); ?>;
	
	<?= $vui->css->border_radius( '100%' ); ?>
	
	<?= $vui->css->transition( 'all 0.5s ease-in-out' ); ?>
	
}
.articles-list .article .read-more .s2 a{
	
	position: absolute;
	<?= $vui->css->display_inline_block(); ?>
	width: 100%;
	height: 100%;
	
	left: 0;
	top: 0;
	
	text-align: left;
	
	text-indent: -20000%;
	
	overflow: hidden;
	
	background: url(<?= $vui->svg_file( 'icon-readmore', $vui->colors->vui_darker->rgba_s( 80 ) ); ?>) no-repeat center center transparent;
	background-size: 100% auto;
	
	<?= $vui->css->border_radius( '100%' ); ?>
	
	<?= $vui->css->transition( 'all 0.3s ease-in-out' ); ?>
	
}
.articles-list .article .read-more .s2:hover{
	
	<?= $vui->css->transform( 'rotate( -360deg ) translate( 0,0 ) scale( 1 )' ); ?>
	
}
.articles-list .article .read-more .s2:hover a{
	
	background: url(<?= $vui->svg_file( 'icon-readmore', $vui->colors->vui_base->get_ro_color( 50 )->hex_s ); ?>) no-repeat center center <?= $vui->colors->vui_base->hex_s; ?>;
	background-size: 100% auto;
	
}










@media screen and ( max-width: 640px ) {
	
	.articles-list .col{
		
		position: relative;
		display: block;
		
	}
	
	<?php for ( $i = 2; $i <= $max_columns; $i++ ) { ?>
	
	.articles-list .columns-<?= $i; ?> .col{
		
		<?= $vui->css->display_inline_block(); ?>
		
		width: <?= 100; ?>%;
		
	}
	
	<?php } ?>
	
}

@media screen and ( min-width: 640px ) and ( max-width: 960px ) {
	
	<?php for ( $i = 2; $i <= $max_columns; $i++ ) { ?>
	
	.articles-list .columns-<?= $i; ?> .col{
		
		<?= $vui->css->display_inline_block(); ?>
		
		width: <?= 100 / 2; ?>%;
		
	}
	
	<?php } ?>
	
}

@media screen and ( min-width: 960px ) and ( max-width: 1280px ) {
	
	
	.articles-list .row-separator{
		
		display: none;
		
	}
	<?php for ( $i = 4; $i <= $max_columns; $i++ ) { ?>
	
	.articles-list .columns-<?= $i; ?> .col{
		
		<?= $vui->css->display_inline_block(); ?>
		
		width: <?= 100 / 3; ?>%;
		
	}
	
	<?php } ?>
	
	
}










/*
 ---------------------------------------------------------
 Articles list
 ---------------------------------------------------------
 *********************************************************
 */






/*
 *********************************************************
 ---------------------------------------------------------
 Article detail
 ---------------------------------------------------------
 */

/* ---------------------------------------------------- */
/* Thumb */

.article-detail .thumb{
	
	position: relative;
	display: block;
	
	float: left;
	margin-top: 0;
	margin-right: <?= VUI_SPACING * 2; ?>em;
	margin-bottom: <?= VUI_SPACING * 2; ?>em;
	
	width: 28%;
	
	z-index: 2;
	
}
.article-detail .thumb .s1{
	
	width: 100%;
	
}
.article-detail .content{
	
	position: relative;
	z-index: 1;
	
}
.article-detail .s1{
	
	min-width: 0;
	min-height: 0;
	
}

/*
 ---------------------------------------------------------
 Article detail
 ---------------------------------------------------------
 *********************************************************
 */









.articles-module{
	
	text-align: center;
	
}


.articles-module .article{
	
	position: relative;
	<?= $vui->css->display_inline_block(); ?>
	
	z-index: 1;
	
	width: <?= 100 / 6; ?>%;
	
}
.articles-module .article:hover{
	
	z-index: 2;
	
}
.articles-module .thumb .s1{
	
	<?= $vui->css->box_shadow( 'none' ); ?>
	
	width: 100%;
	
	min-width: 0;
	min-height: 0;
	
}
.articles-module .thumb .s1:hover{
	
	<?= $vui->css->box_shadow( '0 0.7em 2em ' . $vui->colors->vui_base->darken( 30, TRUE )->rgba_s( 100 ) ); ?>
	
}


@media screen and ( max-width: 960px ) {
	
	.articles-module .article{
		
		width: <?= 100 / 4; ?>%;
		
	}
	.articles-module .thumb .s1:before{
		
		padding-top: 70%;
		
	}
	
}
@media screen and ( max-width: 640px ) {
	
	.articles-module .article{
		
		width: <?= 100 / 2; ?>%;
		
	}
	
}
@media screen and ( max-width: 480px ) {
	
	.articles-module .article{
		
		width: 100%;
		
	}
	
}




