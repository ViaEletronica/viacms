
/*
 *********************************************************
 ---------------------------------------------------------
 Search
 ---------------------------------------------------------
 */

input[type=text].search-terms{
	min-width: 0px;
	width: 200px;
}
.search-term-highlight{
	
	color: <?= HIGHLIGHT_FONT_COLOR; ?>;
	<?= HIGHLIGHT_BACKGROUND; ?>
	
	font-weight:bold;
}

.live-visible{
	
}
.live-hidden{
	display: none !important;
}
.live-founded{
	background-color: rgba(255, 245, 202, 0.3);
}


.live-founded{
	
	animation: fade 1s forwards;
	-webkit-animation: fade 1s forwards;
	-moz-animation: fade 1s forwards;
	-o-animation: fade 1s forwards;
	animation-iteration-count: infinite;
	-webkit-animation-iteration-count: infinite;
	-moz-animation-iteration-count: infinite;	
	-o-animation-iteration-count: infinite;
}

/*
 ---------------------------------------------------------
 Search
 ---------------------------------------------------------
 *********************************************************
 */
