
/*
 *********************************************************
 ---------------------------------------------------------
 jQuery switch
 ---------------------------------------------------------
 */

.ui-switch {
	display: inline-block;
	position: relative;
	border: none;
	cursor: pointer;
	font-family: Helvetica, Arial, sans-serif;
	
	-moz-border-radius: 18px;
	-webkit-border-radius: 18px;
	border-radius: 18px;
}

.ui-switch:focus {
	border-color: #8aade1;
	-webkit-box-shadow: 0 0 5px #8aade1; /* Safari before v5 and Google Chrome */
	-moz-box-shadow: 0 0 5px #8aade1; /* Firefox */
	-o-box-shadow: 0 0 5px #8aade1; /* Opera */
	box-shadow: 0 0 5px #8aade1; /* CSS3 browsers */
	outline: none; /* disabling Safari's default behavior*/
}

.ui-switch.disabled {
	border-color: #999;
	cursor: default;
}

.ui-switch-middle {
	height: 16px;
	width: 60px;
	border: solid 7px white;
	position: relative;
	margin-top: -31px;
	z-index: 100;
	
	-moz-border-radius: 17px;
	-webkit-border-radius: 17px;
	border-radius: 17px;
}

.ui-switch-mask {
	height: 28px;
	margin: 0px 4px;
	overflow: hidden;
}

.ui-switch-master {
	height: 27px;
	position: relative;
	left: 10px;
}

.ui-switch-upper {
	height: 14px;
	width: auto;
	margin: 5px 8.5px;
	position: absolute;
	z-index: 101;
}

.ui-switch-handle {
	display: block;
	height: 25px;
	width: 25px;
	position: absolute;
	top: -5px;
	left: -12px;
	background: url('<?= THEME_IMAGE_DIR_URL; ?>/jquery.switch.png');
	background-size: 100%;
	-moz-border-radius: 15px;
	-webkit-border-radius: 15px;
	border-radius: 15px;
}

.ui-switch-.disabled .ui-switch-handle:after {
	display: block;
	content: ' ';
	position: absolute;
	top: 0; left: 0;
	height: 30px; width: 30px;
	background: white;
	
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)"; /* IE 8 */
	filter: alpha(opacity=50); /* IE 5-7 */
	-moz-opacity: 0.5; /* Mozilla */
	-khtml-opacity: 0.5; /* Safari 1.x */
	opacity: 0.5; /* Good browsers */
	
	-moz-border-radius: 15px;
	-webkit-border-radius: 15px;
	border-radius: 15px;
}

.ui-switch-lower {
	height: 16px; width: 1000px;
	margin: 5px;
	position: absolute;
	z-index: 99;
}

.ui-switch-labels {
	clear: both;
}

.ui-switch-on,
.ui-switch-off {
	display: block;
	float: left;
	line-height: 16px;
	font-size: 10px;
	background: green;
	padding: 0 12px 1px;
	margin-top: -2px;
	text-align: center;
	font-weight: bold;
	text-decoration: none;
	
	text-shadow: 0 1px 1px rgba(0,0,0,0.5);
	
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
}

.ui-switch-on {
	color:<?= INPUTS_BUTTONS_COLOR; ?>;
	padding-right: 18px;
	
	-moz-border-radius-topright: 0;
	-moz-border-radius-bottomright: 0;
	-webkit-border-top-right-radius: 0;
	-webkit-border-bottom-right-radius: 0;
	border-top-right-radius: 0;
	border-bottom-right-radius: 0;
	
	<?= INPUTS_BUTTONS_BACKGROUND; ?>;
	
}

.ui-switch-off {
	color:<?= CANCEL_BUTTON_FOREGROUND_COLOR; ?>;
	padding-left: 21px;
	
	-moz-border-radius-topleft: 0;
	-moz-border-radius-bottomleft: 0;
	-webkit-border-top-left-radius: 0;
	-webkit-border-bottom-left-radius: 0;
	border-top-left-radius: 0;
	border-bottom-left-radius: 0;
	
	<?= CANCEL_BUTTON_BACKGROUND; ?>;
	
}

.ui-switch.disabled .ui-switch-on,
.ui-switch.disabled .ui-switch-off {
	border-color: #333;
	
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)"; /* IE 8 */
	filter: alpha(opacity=50); /* IE 5-7 */
	-moz-opacity: 0.5; /* Mozilla */
	-khtml-opacity: 0.5; /* Safari 1.x */
	opacity: 0.5; /* Good browsers */
	
	background: #525252; /* Old browsers */
	background: -moz-linear-gradient(top,	#525252 0%, #3e3e3e 2%, #545454 10%, #5d5d5d 17%, #787878 90%, #757575 98%, #525252 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#525252), color-stop(2%,#3e3e3e), color-stop(10%,#545454), color-stop(17%,#5d5d5d), color-stop(90%,#787878), color-stop(98%,#757575), color-stop(100%,#525252)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,	#525252 0%,#3e3e3e 2%,#545454 10%,#5d5d5d 17%,#787878 90%,#757575 98%,#525252 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,	#525252 0%,#3e3e3e 2%,#545454 10%,#5d5d5d 17%,#787878 90%,#757575 98%,#525252 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,	#525252 0%,#3e3e3e 2%,#545454 10%,#5d5d5d 17%,#787878 90%,#757575 98%,#525252 100%); /* IE10+ */
	background: linear-gradient(top,	#525252 0%,#3e3e3e 2%,#545454 10%,#5d5d5d 17%,#787878 90%,#757575 98%,#525252 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#525252', endColorstr='#525252',GradientType=0 ); /* IE6-9 */
}

.ui-switch-on:hover,
.ui-switch-off:hover {
	color: white;
	text-decoration: none;
}

.ui-switch, .ui-switch * {
	-moz-user-select: -moz-none;
	-khtml-user-select: none;
	-webkit-user-select: none;
	user-select: none;
}

/*
 ---------------------------------------------------------
 jQuery switch
 ---------------------------------------------------------
 *********************************************************
 */
