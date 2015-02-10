
/*
 *********************************************************
 ---------------------------------------------------------
 Modals
 ---------------------------------------------------------
 */
/*
.fancybox-lock body > *:not(.fancybox-overlay){
	
	<?= $vui->css->filter( array( 'brightness' => 0.953, 'saturate' => 0.5, 'sepia' => 2, 'blur' => 5, ) ); ?>
	
}
.fancybox-lock body > .fancybox-overlay,
.fancybox-lock body > .image-cropper-main{
	
	<?= $vui->css->filter( array( 'brightness' => 1, 'saturate' => 1, 'sepia' => 0, 'blur' => 0, ) ); ?> !important
	
}
*/
.vui .vui-modal .controls{
	
}
.vui .vui-modal .modal-controls,
.vui .vui-modal .controls{
	
	position: relative;
	display: block;
	width: 100%;
	
	box-shadow: 0 1px 50px <?= $vui->colors->vui_extra_3->rgba_s( 30 ); ?>;
	
	background: <?= $vui->colors->vui_extra_2->hex_s; ?>;
	<?= $vui->colors->vui_lighter->getCssGradient( 3 ); ?>;
	
	border-bottom: <?= VUI_BORDER; ?>;
	
	z-index: 2;
	
}

.vui .modal-controls > *,
.vui .modal-controls .btn,
.vui .modal-controls .button,
.vui .modal-controls input,
.vui .modal-controls select,
.vui .modal-controls textarea,
.vui .vui-modal .controls > *,
.vui .vui-modal .controls .btn,
.vui .vui-modal .controls .button,
.vui .vui-modal .controls input,
.vui .vui-modal .controls select,
.vui .vui-modal .controls textarea{
	
	margin-bottom: 0;
	
}
.vui .vui-modal .controls-inner{
	
	padding: <?= DEFAULT_SPACING; ?>px;
	
	position: relative;
	display: block;
	width: 100%;
	
	box-shadow: 0 1px 50px <?= $vui->colors->vui_extra_3->rgba_s( 30 ); ?>;
	
	background: <?= $vui->colors->vui_extra_2->hex_s; ?>;
	
	border-bottom: <?= VUI_BORDER; ?>;
	
	z-index: 2;
	
}


	
	
	





.modal-content{
	
	position: absolute;
	left: 0;
	bottom: 0;
	right: 0;
	display: block;
	
	z-index: 1;
	
	padding: <?= DEFAULT_SPACING * 2; ?>px;
	padding-top: 0;
	
}

.vui .image-cropper-main,
.vui .image-cropper-main-inner{
	
	position: fixed;
	display: block;
	
	left: 0;
	top: 0;
	right: 0;
	bottom: 0;
	
	z-index: 999999999;
	
}
.vui .image-cropper-main-inner{
	
	position: absolute;
	
}
.vui .image-cropper-wrapper{
	
	position: absolute;
	
	min-width: 96px;
	min-height: 96px;
	max-width: 100%;
	max-height: 100%;
	
	left: 50%;
	top: 50%;
	
	z-index: 1;
	
}
.vui .image-cropper-main .cropper-viewer > img{
	
	background-color: <?= $vui->colors->vui_lighter->hex_s; ?>;
	
}

.vui .image-cropper-controls{
	
	position: absolute;
	
	top: 0;
	right: 0;
	bottom: 0;
	
	width: 20%;
	min-width: 100px;
	
	z-index: 3;
	
	background: url(<?= $vui->svg_file( 'modal-overlay' ); ?>) no-repeat center center <?= $vui->colors->vui_darker->rgba_s( 200 ); ?>;
	
	vertical-align: top;
	
}
.vui .image-cropper-controls .btn{
	
	color: <?= $vui->colors->vui_darker->get_ro_color()->hex_s; ?>;
	
}
.vui .image-cropper-preview{
	
	position: relative;
	
	display: block;
	
	width: 100%;
	height: 100%;
	max-width: 96px;
	max-height: 96px;
	
	overflow: hidden;
	
	z-index: 2;
	
}

.vui-image-cropper .modal-content{
	
	position: absolute;
	
	overflow: hidden;
	
}
.vui-image-cropper .modal-content-inner{
	
	position: relative;
	
	width: 100%;
	height: 100%;
	
	overflow: auto;
	
}
.modal-content .image-cropper-wrapper{
	
	position: absolute;
	left: 0;
	top: 0;
	right: 0;
	bottom: 0;
	
	width: 100%;
	height: 100%;
	
}
.modal-content img.image-cropper{
	
	position: absolute;
	height: 100%;
	
}
.vui-modal .image-cropper-preview-wrapper{
	
	overflow: hidden;
	
	width: 96px;
	height: 96px;
	
}
.modal-content .image-cropper-image-wrapper{
	
	position: absolute;
	left: 96px;
	top: 0;
	right: 0;
	bottom: 0;
	
}
.vui-modal.image-cropper-on .live-update-container{
	
	padding: <?= VUI_SPACING; ?>px;
	height: 100%;
	
}




.fancybox-overlay,
.image-cropper-main,
.cropper-modal{
	
	background: url(<?= $vui->svg_file( 'modal-overlay' ); ?>) no-repeat center center <?= $vui->colors->vui_darker->rgba_s( 200 ); ?>;
	background-size: 500%;
	
}
.fancybox-opened .fancybox-skin{
	
	box-shadow: 0 1px 50px <?= $vui->colors->vui_extra_3->rgba_s( 30 ); ?>;
	
}
#fancybox-loading{
	
	position: fixed;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	
	background: <?= $vui->colors->vui_darker->rgba_s( 150 ); ?>;
	background: none;
	
	margin: 0;
	
	opacity: 1;
	
	/*
	margin-left: -<?= ( ( DEFAULT_SPACING * 3 ) + ( DEFAULT_SPACING * 2 ) + 70 ) / 2; ?>px;
	margin-top: -<?= ( ( DEFAULT_SPACING * 4 ) + ( 35 / 3 ) ) / 2; ?>px;
	
	background: <?= $vui->colors->vui_darker->rgba_s( 128 ); ?>;
	
	padding: <?= DEFAULT_SPACING * 2; ?>px;
	box-shadow: 0 1px 50px <?= $vui->colors->vui_extra_3->rgba_s( 30 ); ?>;
	
	border-radius: 5px;
	
	opacity: 1;
	
	width: <?= ( DEFAULT_SPACING * 3 ) + ( DEFAULT_SPACING * 2 ) + 70; ?>px;
	height: <?= ( DEFAULT_SPACING * 4 ) + ( 35 / 3 ); ?>px;
	text-align: center;
	*/
}
#fancybox-loading div,
#fancybox-loading:before,
#fancybox-loading:after{
	
	position: absolute;
	left: 50%;
	top: 50%;
	
	width: 12px;
	height: 12px;
	
	background: <?= $vui->colors->vui_lighter->hex_s; ?>;
	border: 3px solid <?= $vui->colors->vui_base->hex_s; ?>;
	
	margin: 0;
	
	/*
	position: relative;
	width: 30px;
	height: 30px;
	background-image: none;
	
	background-color: <?= $vui->colors->vui_lighter->hex_s; ?>;
	
	width: <?= 35 / 3; ?>px;
	height: <?= 35 / 3; ?>px;
	
	margin: 0 <?= DEFAULT_SPACING / 2; ?>px;
	*/
	
	border-radius: 100%;
	
	<?= $vui_css->animation( 'vui_preload_h 1.4s infinite ease-in-out' ); ?>
	
	box-shadow: 0px 5px 10px <?= $vui->colors->vui_darker->rgba_s( 20 ); ?>;
	
	<?= $vui_css->box_sizing(); ?>
	
}
#fancybox-loading:before,
#fancybox-loading:after{
	
	content: '';
	
}
#fancybox-loading div{
	
	<?= $vui_css->animation_delay( '-0.16s' ); ?>
	
}
#fancybox-loading:before{
	
	<?= $vui_css->animation_delay( '-0.32s' ); ?>
	
}
#fancybox-loading:after{
	
	<?= $vui_css->animation_delay( '-0.0s' ); ?>
	
}

<?php
	
	$vui_preload_h_css = '
		
		0%{
			
			opacity: 0.5;
			' . $vui_css->animation_timing_function( 'ease-in' ) . '
			' . $vui_css->transform( 'translate( -3em,0 ) scale( 1 )' ) . '
			
		}
		
		25%{
			
			opacity: 1;
			' . $vui_css->animation_timing_function( 'ease-out' ) . '
			' . $vui_css->transform( 'translate( 0,0 ) scale( 1.5 )' ) . '
			
		}
		
		50%{
			
			opacity: 0.5;
			' . $vui_css->animation_timing_function( 'ease-in' ) . '
			' . $vui_css->transform( 'translate( 3em,0 ) scale( 1 )' ) . '
			
		}
		
		75%{
			
			opacity: 0;
			' . $vui_css->animation_timing_function( 'ease-out' ) . '
			' . $vui_css->transform( 'translate( 0,0 ) scale( 0.5 )' ) . '
			
		}
		
		100%{
			
			opacity: 0.5;
			' . $vui_css->animation_timing_function( 'ease-out' ) . '
			' . $vui_css->transform( 'translate( -3em,0 ) scale( 1 )' ) . '
			
		}
		
	';
	
?>


<?= $vui_css->keyframes( 'vui_preload_h', $vui_preload_h_css ); ?>





.fancybox-skin{
	
	padding: <?= DEFAULT_SPACING * 2; ?>px !important;
	
	<?= MODAL_STYLESHEET; ?>
	
	color:<?= VUI_FONT_COLOR; ?>;
	
}
.fancybox-nav{
	
	position: fixed;
	width: 30%;
	z-index: 1;
	
}
.fancybox-inner{
	
	position: relative;
	overflow: hidden !important;
	
}
.fancybox-inner #modal-articles-categories,
.fancybox-inner #modal-articles-list{
	
	position: absolute;
	left: 0;
	top: 0;
	width: 40%;
	height: 100%;
	
}
.fancybox-inner #modal-articles-categories{
	
	padding-left: <?= DEFAULT_SPACING; ?>px;
	padding-bottom: <?= DEFAULT_SPACING * 2; ?>px;
	
	color: <?= $vui->colors->vui_extra_4->get_ro_color()->hex_s; ?>;
	
	<?= $vui->colors->vui_extra_4->getCssGradient( 5, 'rtl' ); ?>;
	
}
.fancybox-inner #modal-articles-list{
	
	padding-left: <?= DEFAULT_SPACING; ?>px;
	padding-right: <?= DEFAULT_SPACING * 2; ?>px;
	padding-bottom: <?= DEFAULT_SPACING * 2; ?>px;
	left: 40%;
	width: 60%;
	
}
.modal-content #modal-articles-categories .search-results,
.modal-content #modal-articles-list .search-results{
	
	position: relative;
	display: block;
	overflow: auto;
	width: 100%;
	height: 100%;
	max-width: 100%;
	max-height: 100%;
	
}
.modal-content #modal-articles-categories .search-results{
	
	direction: rtl;
	
}
.modal-content #modal-articles-categories .search-results .search-result{
	
	position:relative;
	display: block;
	z-index: 1;
	
	direction: ltr;
	color: <?= $vui->colors->vui_extra_4->get_ro_color()->hex_s; ?>;
	
}
.modal-content #modal-articles-categories .search-results .selected{
	
	background: <?= $vui->colors->vui_lighter->hex_s; ?>;
	z-index: 2;
	
}
.modal-content #modal-articles-categories .search-results .selected:before,
.modal-content #modal-articles-categories .search-results .selected:after{
	
	content: '';
	
	position: absolute;
	display: block;
	right: 0;
	bottom: -15px;
	
	width: 16px;
	height: 16px;
	
	z-index: 3;
	
}
.modal-content #modal-articles-categories .search-results .selected:after{
	
	bottom: auto;
	top: -15px;
	
}
.modal-content #modal-articles-categories .search-results .selected:before,
.modal-content #modal-articles-categories .search-results .selected:after{
	
	background: url(<?= $vui->svg_file( 'inner-round-tr', $vui->colors->vui_lighter->hex_s ); ?>) no-repeat right top;
	background-size: 100% 100%;
	
}
.modal-content #modal-articles-categories .search-results .selected:after{
	
	background-image: url(<?= $vui->svg_file( 'inner-round-br', $vui->colors->vui_lighter->hex_s ); ?>);
	
}
.modal-content #modal-articles-categories .search-results .selected .category-item{
	
	background: <?= $vui->colors->vui_lighter->hex_s; ?>;
	
	box-shadow: 0px 20px 50px <?= $vui->colors->vui_base->darken( 25, TRUE )->rgba_s( 30 ); ?>;
	
}
.modal-content .category-list-live-search .sub-item .category-item:before{
	
	content: '⤷';
	
}
.modal-content .category-list-live-search .category-level-2 .category-item{
	
	padding-left: <?= DEFAULT_SPACING * 2; ?>px;
	
}
.modal-content .category-list-live-search .category-level-3 .category-item{
	
	padding-left: <?= DEFAULT_SPACING * 3; ?>px;
	
}
.modal-content .category-list-live-search .category-level-4 .category-item{
	
	padding-left: <?= DEFAULT_SPACING * 4; ?>px;
	
}
.modal-content .category-list-live-search .category-level-5 .category-item{
	
	padding-left: <?= DEFAULT_SPACING * 5; ?>px;
	
}





.vui-modal{
	
	color: <?= VUI_FONT_COLOR; ?>;
	
}

.vui-modal .fancybox-skin{
	
	padding: 0 !important;
	
}
.vui-modal .fancybox-inner{
	
	overflow: visible !important;
	z-index: 2;
	
}
.vui-modal .info-wrapper.has-image{
	
	padding-left: 0 !important;
	
}
.vui-modal .info-wrapper.has-image div.thumb-wrapper{
	
	position: absolute;
	top: 96px;
	bottom: 0;
	left: 0;
	width: 48px;
	
	background: <?= $vui->colors->vui_base->hex_s; ?>;
	
	border-radius: 0 24px 0 3px;
	
}
.vui-modal .info-wrapper.has-image div.thumb-image-wrapper{
	
	position: absolute;
	top: -96px;
	left: -48px;
	border-radius: 50% 0 0 50%;
	box-shadow: none;
	
}
.vui-modal .info-wrapper.has-image div.info-items{
	
	position: relative;
	height: 100%;
	overflow: auto;
	padding: <?= DEFAULT_SPACING; ?>px;
	margin-left: <?= ( DEFAULT_SPACING + 48 ); ?>px;
	
}
.vui-modal .info-wrapper div.edit-button{
	
	padding: 0;
	margin: 0;
	
}
.vui-modal .info-wrapper div.info-items *:last-child{
	
	margin-bottom: 0;
	
}

/*
 ---------------------------------------------------------
 Modals
 ---------------------------------------------------------
 *********************************************************
 */
