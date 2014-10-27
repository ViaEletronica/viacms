
/*
 *********************************************************
 ---------------------------------------------------------
 Params
 ---------------------------------------------------------
 */

.params-group{
	
	position:relative;
	display: block;
	
}

.params-set-wrapper{
	
	position:relative;
	<?= css_display_inline_block(); ?>;
	
}
.params-set{
	
	position:relative;
	<?= css_display_inline_block(); ?>;
	margin:0 5px <?= DEFAULT_SPACING; ?>px;
	
}
.params-set-wrapper tr,
.params-set-wrapper tr td{
	
	background: none;
	border: none;
	
}
.params-set-wrapper table:hover,
.params-set-wrapper table:hover tr{
	
}
.params-set-wrapper .field-title{
	
	text-align: right;
	
}
.params-set-wrapper .field-title *:last-child{
	
	margin-bottom: 0;
	
}
.params-set-wrapper .field{
	
	text-align: left;
	
}
.params-set-wrapper .params-set-title{
	
	<?= LEGEND_STYLESHEET; ?>
	
}

/*
 ---------------------------------------------------------
 Params
 ---------------------------------------------------------
 *********************************************************
 */
