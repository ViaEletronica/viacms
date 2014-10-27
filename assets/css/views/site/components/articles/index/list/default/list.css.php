<?php if(extension_loaded('zlib')){ob_start('ob_gzhandler');} header ('Content-Type: text/css');
	
if ( ! defined( 'SPACING' ) ) define( 'SPACING', 1 );
	$articles_horizontal_margins = 2;
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
	
	display:-moz-inline-stack;display:inline-block;zoom:1;*display:inline;	
	
	width: <?= 100 / $i; ?>%;
	
}

<?php } ?>

.articles-list .article{
	
	vertical-align: top;
	
	padding-top: <?= SPACING; ?>em;
	padding-bottom: <?= SPACING; ?>em;
	
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
	
	margin-top: <?= SPACING; ?>em;
	margin-bottom: <?= SPACING; ?>em;
	
	text-align: center;
	
}
.articles-list .article .thumb .s1{
	
	position: relative;
	display: block;
	max-width: 100%;
	max-height: 10em;
	overflow: hidden;
	
}
.articles-list .article .thumb .s1:hover{
	
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
	
	margin-top: <?= SPACING; ?>em;
	margin-bottom: <?= SPACING; ?>em;
	
}



/* ---------------------------------------------------- */
/* Article info */

.articles-list .article .info{
	
	position: relative;
	display: block;
	
	margin-left: <?= $articles_horizontal_margins; ?>em;
	margin-right: <?= $articles_horizontal_margins; ?>em;
	
	opacity: 0.5;
	
}


/* ---------------------------------------------------- */
/* Article category*/

.articles-list .article .category{
	
	position: relative;
	display: block;
	
	font-size: 80%;
	
}


/* ---------------------------------------------------- */
/* Article created by */

.articles-list .article .created-by{
	
	display: block;
	
	font-size: 80%;
	
}


/* ---------------------------------------------------- */
/* Created date time */

.articles-list .article .created-date-time{
	
	font-size: 80%;
	
}


/* ---------------------------------------------------- */
/* Article content*/

.articles-list .article .content{
	
	position: relative;
	display: block;
	
	margin-left: <?= $articles_horizontal_margins; ?>em;
	margin-right: <?= $articles_horizontal_margins; ?>em;
	
	margin-top: <?= SPACING; ?>em;
	margin-bottom: <?= SPACING; ?>em;
	
	text-align: left;
	
}


/* ---------------------------------------------------- */
/* Read more*/

.articles-list .article .read-more{
	
	position: relative;
	display: block;
	
	margin-left: <?= $articles_horizontal_margins; ?>em;
	margin-right: <?= $articles_horizontal_margins; ?>em;
	
	margin-top: <?= SPACING; ?>em;
	margin-bottom: <?= SPACING; ?>em;
	
}









@media screen and ( max-width: 640px ) {
	
	.articles-list .col{
		
		position: relative;
		display: block;
		
	}
	
	<?php for ( $i = 2; $i <= $max_columns; $i++ ) { ?>
	
	.articles-list .columns-<?= $i; ?> .col{
		
		display:-moz-inline-stack;display:inline-block;zoom:1;*display:inline;
		
		width: <?= 100; ?>%;
		
	}
	
	<?php } ?>
	
}

@media screen and ( min-width: 640px ) and ( max-width: 960px ) {
	
	<?php for ( $i = 2; $i <= $max_columns; $i++ ) { ?>
	
	.articles-list .columns-<?= $i; ?> .col{
		
		display:-moz-inline-stack;display:inline-block;zoom:1;*display:inline;
		
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
		
		display:-moz-inline-stack;display:inline-block;zoom:1;*display:inline;
		
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
