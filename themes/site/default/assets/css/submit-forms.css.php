
<?php
	
	$articles_horizontal_margins = VUI_SPACING * 2;
	$max_columns = 20;
	
?>

/*
 *********************************************************
 ---------------------------------------------------------
 Submit forms
 ---------------------------------------------------------
 */

.submit-form #component-content{
	
}

.submit-form .submit-form-field-wrapper{
	
	display: block;
	
	position: relative;
	<?= $vui->css->display_inline_block(); ?>
	
	width: 33.3333333%;
	
	padding: 0 <?= VUI_SPACING; ?>em;
	
}
.submit-form .submit-form-field-control{
	
	display: block;
	width: 100%;
	margin-left: auto;
	margin-right: auto;
	
}
.submit-form .form-element{
	
	<?= $vui->css->display_inline_block(); ?>
	width: 90%;
	text-align: left;
	
	<?= $vui->css->box_sizing(); ?>
	
}
.submit-form .submit-form-field-wrapper label{
	
	text-align: left;
	
}
.submit-form .submit-form-field-wrapper-html,
.submit-form .submit-form-field-wrapper-textarea,
.submit-form .submit-form-field-wrapper-button{
	
	width: 100%;
	
}
.submit-form .submit-form-field-wrapper-button,
.submit-form .submit-form-field-wrapper-textarea{
	
}
.submit-form .submit-form-field-wrapper-button .form-element{
	
	text-align: center;
	
}
.submit-form .submit-form-field-wrapper-textarea .form-element,
.submit-form .submit-form-field-wrapper-button .form-element{
	
	width: 96.7%;
	
}




@media screen and ( max-width: 960px ) {
	
	.submit-form .submit-form-field-wrapper{
		
		width: 50%;
		
	}
	.submit-form .submit-form-field-wrapper-html,
	.submit-form .submit-form-field-wrapper-textarea,
	.submit-form .submit-form-field-wrapper-button{
		
		width: 100%;
		
	}
	
}


@media screen and ( max-width: 640px ) {
	
	.submit-form .submit-form-field-wrapper{
		
		width: 100%;
		
	}
	.submit-form .submit-form-field-wrapper-html,
	.submit-form .submit-form-field-wrapper-textarea,
	.submit-form .submit-form-field-wrapper-button{
		
		width: 100%;
		
	}
	
}



/*
 ---------------------------------------------------------
 Submit forms
 ---------------------------------------------------------
 *********************************************************
 */
