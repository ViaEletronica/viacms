
/*
 *********************************************************
 ---------------------------------------------------------
 Contact details
 ---------------------------------------------------------
 */

.contact-details{
	
	position: relative;
	display: block;
	
}
.contact-wrapper{
	
	position: relative;
	display: block;
	
}
.contact-details .gmaps,
.contact-details .contact-info,
.contact-details .contact-form{
	
	position: relative;
	<?= $vui->css->display_inline_block(); ?>
	
	margin-top: <?= VUI_SPACING; ?>em;
	margin-bottom: <?= VUI_SPACING; ?>em;
	
	padding: <?= VUI_SPACING; ?>em;
	
	width: 35%;
	
	vertical-align: top;
	
}
.contact-details .contact-info{
	
	width: 30%;
	
}
.contact-details .gmaps > .inner,
.contact-details .contact-info > .inner,
.contact-details .contact-form > .inner{
	
	position: relative;
	display: block;
	
}
.contact-details .gmaps{
	
	position: absolute;
	right: 0;
	
	height: 100%;
	
}
.contact-details .gmaps > .inner,
.contact-details .gmaps iframe{
	
	position: absolute;
	display: block;
	
	width: 100% !important;
	height: 100% !important;
	
}


/* ---------------------------------------------------- */
/* Contact Info */

.contact-details .contact-info{
	
	text-align: right;
	
}



/* ---------------------------------------------------- */
/* Contact form */

.contact-details .contact-form-item{
	
	position: relative;
	
}
.contact-details .form-element{
	
	position: relative;
	width: 100%;
	
}


@media screen and ( max-width: 960px ) {
	
	.contact-details .gmaps,
	.contact-details .contact-info,
	.contact-details .contact-form{
		
		width: <?= 100 / 2; ?>%;
		
	}
	.contact-details .gmaps > .inner,
	.contact-details .contact-info > .inner,
	.contact-details .contact-form > .inner{
		
		position: relative;
		display: block;
		
	}
	.contact-details .gmaps{
		
		position: relative;
		right: auto;
		
		width: 100%;
		height: auto;
		
	}
	.contact-details .gmaps > .inner,
	.contact-details .gmaps iframe{
		
		position: relative;
		display: block;
		
		width: 100% !important;
		height: auto !important;
		
	}

}
@media screen and ( max-width: 640px ) {
	
	.contact-details .gmaps,
	.contact-details .contact-info,
	.contact-details .contact-form{
		
		width: 100%;
		
	}
	.contact-details .thumb,
	.contact-details .contact-info{
		
		text-align: center;
		
	}

}



/*
 ---------------------------------------------------------
 Contact details
 ---------------------------------------------------------
 *********************************************************
 */
