
/*
 *********************************************************
 ---------------------------------------------------------
 Adjustments
 ---------------------------------------------------------
 */

th.col-checkbox,
th.col-id,
th.col-image,
th.col-operations,
th.col-status,
th.col-order,
th.col-ordering,
td.col-checkbox,
td.col-id,
td.col-image,
td.col-priority,
td.col-status,
td.col-operations,
td.col-ordering{
	
	text-align: center;
	white-space: nowrap;
	vertical-align: middle;
	
	width: 1px;
	
}

td.tree-title{
	
	text-align: left;
	
}
tr.tree-level-1 td.tree-title{
	
	padding-left: <?= ( DEFAULT_SPACING * 4 ) * 1; ?>px;
	
}
tr.tree-level-2 td.tree-title{
	
	padding-left: <?= ( DEFAULT_SPACING * 4 ) * 2; ?>px;
	
}
tr.tree-level-3 td.tree-title{
	
	padding-left: <?= ( DEFAULT_SPACING * 4 ) * 3; ?>px;
	
}
tr.tree-level-4 td.tree-title{
	
	padding-left: <?= ( DEFAULT_SPACING * 4 ) * 4; ?>px;
	
}
.btn.btn-sub-item{
	
	min-height:.95em;
	height:.95em;
	line-height:115%;
	padding-top:0;
	padding-bottom:0;
	
}
.btn.btn-sub-item .icon-sub-item:before{
	
	line-height: 64%;
	
}
.btn.btn-sub-item:hover{
	background-color: transparent;
	-webkit-box-shadow: none;
	box-shadow: none;
}
th.order-by{
	
	position: relative;
	
}
th.order-by-column{
	
	background: <?= $vui->colors->vui_extra_3->rgba_s( 25 ); ?>;
	
}
th.order-by a:after{
	
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	background-repeat: no-repeat;
	content: '';
	
}
th.order-by-ASC a:after,
th.order-by-DESC a:after{
	
	background-position: right 0 bottom 0;
	background-image: url(<?= $vui->svg_file( 'symbol-list-asc' ); ?>);
	
}
th.order-by-DESC a:after{
	
	background-position: right 0 top 0;
	background-image: url(<?= $vui->svg_file( 'symbol-list-desc' ); ?>);
	
}
th.order-by-column a{
	
	color: <?= $vui->colors->vui_darker->hex_s; ?>;
	
}
@-moz-document url-prefix() {
	
	th.order-by a:after{
		
		display: none;
		
	}
	
}


/* 
 * ----------------------------
 * ----------------------------
 * Cover me feature
 */

td a.list-link-cover-me:before{
	
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	content: '';
	z-index: 0;
	
}
td a.list-link-cover-me:hover:before{
	
	background: <?= $vui->colors->vui_extra_3->rgba_s( 10 ); ?>;
	
}
td a.list-link-cover-me:hover{
	
	z-index: 2;
	
}

@-moz-document url-prefix() {
	
	td a.list-link-cover-me:before{
		display: none;
	}
	td a.list-link-cover-me:hover{
		
	}
	
}

/* 
 * Cover me feature
 * ----------------------------
 * ----------------------------
 */


.vui .col-checkbox{
	
	vertical-align: middle;
	text-align: center;
	
}
.vui .col-checkbox input{
	
	margin: 0;
	
}


.vui input[type=text].inputbox-order,
.vui input[type=text].inputbox-ordering,
.vui input[type=number].inputbox-order,
.vui input[type=number].inputbox-ordering{
	
	text-align:center;
	min-width:70px;
	width: 0px;
	
}

.vui input[type=text].address-type{
	
	width:150px;
	
}
.vui input[type=text].address-country-title{
	
	width:150px;
	
}
.vui input[type=text].address-state-acronym{
	
	min-width: 70px;
	width: 70px;
	
}
.vui input[type=text].address-city-title{
	
	min-width: 150px;
	width: 150px;
	
}
.vui input[type=text].address-neighborhood-title{
	
	min-width: 150px;
	width: 150px;
	
}
.vui input[type=text].address-postal-code{
	
	min-width: 130px;
	width: 130px;
	
}
.vui input[type=text].address-number{
	
	text-align:center;
	
	min-width: 70px;
	width: 70px;
	
}
.vui td input[type=text],
.vui td input[type=number],
.vui td input[type=button],
.vui td textarea,
.vui td select,
.vui td .button{
	
	margin: 0;
	
}

.vui .field-error{
	
	box-shadow: <?= ERROR_BOX_SHADOW; ?> !important;
	
}
.vui .field-highlight{
	
	box-shadow: <?= HIGHLIGHT_BOX_SHADOW; ?> !important;
	
}


.vui .input-file-wrapper{
	
	position:relative;
	<?= css_display_inline_block(); ?>;
	overflow:hidden;
	margin-bottom:<?= DEFAULT_SPACING; ?>px;
	
}
.vui .input-file-wrapper input[type=file],
.vui .input-file-wrapper input[type=file]:hover,
.vui .input-file-wrapper input[type=file]:focus{
	
	position:absolute;
	display:block;
	-webkit-appearance: push-button;
	left:0;
	top:-2px;
	cursor: pointer;
	opacity:0;
	
}

/*
 ---------------------------------------------------------
 Adjustments
 ---------------------------------------------------------
 *********************************************************
 */
