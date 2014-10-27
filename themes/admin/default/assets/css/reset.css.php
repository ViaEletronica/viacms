
/*
 **************************************************************************************************
 **************************************************************************************************
 --------------------------------------------------------------------------------------------------
 Reset
 --------------------------------------------------------------------------------------------------
 */

*,
*:after,
*:before,
*:focus{
	
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	
	outline: none;
	
}
*{
	
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	
	vertical-align: top;
	-webkit-appearance:none;
    -moz-appearance:none;
    appearance:none;
}

html{color:#000;background:#FFF}body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,textarea,p,blockquote,th,td{margin:0;padding:0}table{border-collapse:collapse;border-spacing:0}fieldset,img{border:0}address,caption,cite,code,dfn,em,strong,th,var{font-style:normal;font-weight:normal}ol,ul{list-style:none}caption,th{text-align:left}h1,h2,h3,h4,h5,h6{font-size:100%;font-weight:normal}q:before,q:after{content:''}abbr,acronym{border:0;font-variant:normal}sup{vertical-align:text-top}sub{vertical-align:text-bottom}input,textarea,select{font-family:inherit;font-size:inherit;font-weight:inherit}input,textarea,select{*font-size:100%}legend{color:#000}

::-moz-focus-inner {
	
	outline: none;
	border: 0;
	padding: 0;
	-moz-outline-style: none;
	outline-style: none;
	
}


/* Mozilla based browsers */
::-moz-selection {
	background-color: rgba(43, 116, 199, 0.7);
	color: #fff;
	text-shadow:<?= DEFAULT_TEXT_SHADOW_HOVER; ?>;
}

/* Works in Safari */
::selection {
	background-color: rgba(43, 116, 199, 0.7);
	color: #fff;
	text-shadow:<?= DEFAULT_TEXT_SHADOW_HOVER; ?>;
}

/*
 --------------------------------------------------------------------------------------------------
 Reset
 --------------------------------------------------------------------------------------------------
 **************************************************************************************************
 **************************************************************************************************
 */
