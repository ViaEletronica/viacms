
/*
 **************************************************************************************************
 **************************************************************************************************
 --------------------------------------------------------------------------------------------------
 Tinymce
 --------------------------------------------------------------------------------------------------
 */

.mce-container, .vui .mce-container *, .vui .mce-widget, .vui .mce-widget * {
	margin: 0;
	padding: 0;
	border: 0;
	outline: 0;
	vertical-align: top;
	background: transparent;
	text-decoration: none;
	color: <?= VUI_FONT_COLOR; ?>;
	font-family: <?= INPUTS_BUTTONS_FONT_FAMILY; ?>;
	font-size: 14px;
	text-shadow: none;
	float: none;
	position: static;
	width: auto;
	height: auto;
	white-space: nowrap;
	cursor: inherit;
	-webkit-tap-highlight-color: transparent;
	line-height: normal;
	font-weight: normal;
	text-align: left;
	-moz-box-sizing: content-box;
	-webkit-box-sizing: content-box;
	box-sizing: content-box;
}
.vui .mce-widget button {
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
}
.vui .mce-container *[unselectable] {
	-moz-user-select: none;
	-webkit-user-select: none;
	-o-user-select: none;
	user-select: none;
}
.vui .mce-container ::-webkit-scrollbar {
	
}
.vui .mce-container ::-webkit-scrollbar-track, .vui .mce-container ::-webkit-scrollbar-track-piece {
	
}
.vui .mce-container ::-webkit-scrollbar-track:vertical,
.vui .mce-container ::-webkit-scrollbar-track-piece:vertical {
	width: 2px;
}
.vui .mce-container ::-webkit-scrollbar-thumb {
	
	border: none;
}
.vui .mce-container ::-webkit-scrollbar-track-piece {
	border: none;
}
.vui .mce-container ::-webkit-scrollbar-corner {
	border: none;
}
.vui .mce-container ::-webkit-scrollbar-track {
	border: none;
}
.vui .mce-fade {
	opacity: 0;
	-webkit-transition: opacity .15s linear;
	transition: opacity .15s linear;
}
.vui .mce-fade.mce-in {
	opacity: 1;
}
.vui .mce-tinymce {
	visibility: visible!important;
	position: relative;
	margin-bottom: <?= DEFAULT_SPACING; ?>px;
}
.vui.mce-fullscreen,
.vui .mce-fullscreen {
	border: 0;
	padding: 0;
	margin: 0;
	overflow: hidden;
	background: #FFF;
	height: 100%;
	z-index: 100;
}
.vui div.mce-fullscreen {
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: auto;
	
	background: <?= $vui->colors->vui_light->hex_s; ?>;
	
}
.vui .mce-tinymce {
	display: block;
	border-radius: 2px;
}
.vui .mce-wordcount {
	position: absolute;
	top: 0;
	right: 0;
	padding: 8px;
}
.vui .mce-panel.mce-edit-area {
	background: #FFF;
	
	<?= INPUTS_BORDER; ?>
	
	<?= INPUTS_BACKGROUND; ?>
	
	<?= DEFAULT_INSET_BOX_SHADOW; ?>
	
}
.vui .mce-panel.mce-edit-area iframe {
	<?= INPUTS_BORDER; ?>
}
.vui .mce-statusbar {
	font-size: 90%;
	position: relative;
	background: rgba(0,  42,  94,  0.07);
	z-index: 1;
	
}
.vui .mce-statusbar .mce-path-item,
.vui .mce-statusbar .mce-wordcount{
	font-size: 90%;
}
.vui .mce-statusbar .mce-container-body {
	position: relative;
}
.vui.mce-fullscreen .mce-resizehandle,
.vui .mce-fullscreen .mce-resizehandle {
	display: none;
}
.vui .mce-charmap {
	border-collapse: collapse;
}
.vui .mce-charmap td {
	cursor: default;
	border: 1px solid #c5c5c5;
	width: 20px;
	height: 20px;
	line-height: 20px;
	text-align: center;
	vertical-align: middle;
	padding: 2px;
}
.vui .mce-charmap td div {
	text-align: center;
}
.vui .mce-charmap td:hover {
	background: #d9d9d9;
}
.vui .mce-grid td div {
	border: none;
	width: 12px;
	height: 12px;
	margin: 0;
	cursor: pointer;
}
.vui .mce-grid td div:hover {
	
}
.vui .mce-grid td div:focus {
	
}
.vui .mce-grid {
	border-spacing: 1px;
	border-collapse: separate;
}
.vui .mce-grid td{
	border: none;
}
.vui .mce-grid a {
	display: block;
	border: 1px solid transparent;
}
.vui .mce-grid a:hover {
	border-color: #c5c5c5;
}
.vui .mce-grid-border {
	margin: 0 4px 0 4px;
}
.vui .mce-grid-border a {
	border-color: #e8e8e8;
	width: 13px;
	height: 13px;
}
.vui .mce-grid-border a:hover, .vui .mce-grid-border a.mce-active {
	border-color: #c4daff;
	background: #deeafa;
}
.vui .mce-text-center {
	text-align: center;
}
div.mce-tinymce-inline {
	width: 100%;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}
.vui .mce-container.mce-panel.mce-first.mce-stack-layout-item{
	position: relative;
	z-index: 1;
}
.vui .mce-container.mce-panel.mce-first.mce-stack-layout-item .mce-container-body.mce-stack-layout{
	/*
	padding-bottom: <?= DEFAULT_SPACING; ?>px;
	*/
}
.vui .mce-container, .vui .mce-container-body {
	display: block;
}
.vui .mce-autoscroll {
	overflow: hidden;
}
.vui .mce-scrollbar {
	position: absolute;
	width: 7px;
	height: 100%;
	top: 2px;
	right: 2px;
	opacity: .4;
	filter: alpha(opacity=40);
	zoom: 1;
}
.vui .mce-scrollbar-h {
	top: auto;
	right: auto;
	left: 2px;
	bottom: 2px;
	width: 100%;
	height: 7px;
}
.vui .mce-scrollbar-thumb {
	position: absolute;
	background-color: #000;
	border: 1px solid #888;
	border-color: rgba(85, 85, 85, 0.6);
	width: 5px;
	height: 100%;
	-webkit-border-radius: 7px;
	-moz-border-radius: 7px;
	border-radius: 7px;
}
.vui .mce-scrollbar-h .mce-scrollbar-thumb {
	width: 100%;
	height: 5px;
}
.vui .mce-scrollbar:hover, .vui .mce-scrollbar.mce-active {
	background-color: #AAA;
	opacity: .6;
	filter: alpha(opacity=60);
	zoom: 1;
	-webkit-border-radius: 7px;
	-moz-border-radius: 7px;
	border-radius: 7px;
}
.vui .mce-scroll {
	position: relative;
}
.vui .mce-panel {
	
	filter:none;
	zoom: 1;
}
.vui.mce-fullscreen .mce-panel {
	
	background: <?= $vui->colors->vui_base->rgba_s( 5 ); ?>;
	
}
.vui .mce-floatpanel {
	position: absolute;
	-webkit-box-shadow: #ccc 5px 5px 5px;
	-moz-box-shadow: #ccc 5px 5px 5px;
	box-shadow: #ccc 5px 5px 5px;
}
.vui.mce-fullscreen .mce-floatpanel,
.vui .mce-fullscreen .mce-floatpanel {
	margin-top: 2px;
}
.vui .mce-floatpanel.mce-fixed {
	position: fixed;
}
.vui .mce-floatpanel .mce-arrow, .vui .mce-floatpanel .mce-arrow:after {
	position: absolute;
	display: block;
	width: 0;
	height: 0;
	border-color: transparent;
	border-style: solid;
}
.vui .mce-floatpanel .mce-arrow {
	border-width: 11px;
}
.vui .mce-floatpanel .mce-arrow:after {
	border-width: 10px;
	content: ""
}
.vui .mce-floatpanel.mce-popover {
	top: 0;
	left: 0;
	background: url("<?= THEME_IMAGE_DIR_URL; ?>/noise.png") repeat center center #f4f6f7;
	
	-webkit-background-clip: padding-box;
	-moz-background-clip: padding;
	background-clip: padding-box;
	
	<?= DEFAULT_BOX_SHADOW; ?>
	
}
.vui .mce-floatpanel.mce-popover.mce-bottom {
	margin-top: 10px;
}
.vui.mce-fullscreen .mce-floatpanel.mce-popover.mce-bottom,
.vui .mce-fullscreen .mce-floatpanel.mce-popover.mce-bottom {
	margin-top: 10px;
}
.vui .mce-floatpanel.mce-popover.mce-bottom>.mce-arrow {
	left: 50%;
	margin-left: -11px;
	border-top-width: 0;
	top: -11px;
}
.vui .mce-floatpanel.mce-popover.mce-bottom>.mce-arrow:after {
	top: 1px;
	margin-left: -10px;
	border-top-width: 0;
	border-bottom-color: #f4f6f7;
}
.vui .mce-floatpanel.mce-popover.mce-bottom.mce-start {
	margin-left: -22px;
}
.vui .mce-floatpanel.mce-popover.mce-bottom.mce-start>.mce-arrow {
	left: 20px;
}
.vui .mce-floatpanel.mce-popover.mce-bottom.mce-end {
	margin-left: 22px;
}
.vui .mce-floatpanel.mce-popover.mce-bottom.mce-end>.mce-arrow {
	right: 10px;
	left: auto;
}
.vui.mce-fullscreen,
.vui .mce-fullscreen {
	border: 0;
	padding: 0;
	margin: 0;
	overflow: hidden;
	background: #FFF;
	height: 100%}
.vui div.mce-fullscreen {
	position: fixed;
	top: 0;
	left: 0;
}
#mce-modal-block {
	opacity: 0;
	filter: alpha(opacity=0);
	zoom: 1;
	position: fixed;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	background: #000;
}
#mce-modal-block.mce-in {
	opacity: .3;
	filter: alpha(opacity=30);
	zoom: 1;
}
.vui .mce-window-move {
	cursor: move;
}
.vui .mce-window {
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	border-radius: 6px;
	-webkit-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
	-moz-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
	box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
	filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
	background: transparent;
	background: #FFF;
	position: fixed;
	top: 0;
	left: 0;
	opacity: 0;
	-webkit-transition: opacity 150ms ease-in;
	transition: opacity 150ms ease-in;
	margin-top: auto;
}
.vui .mce-window.mce-in {
	opacity: 1;
}
.vui .mce-window-head {
	padding: 9px 15px;
	border-bottom: 1px solid #EEE;
	position: relative;
}
.vui .mce-window-head .mce-close {
	position: absolute;
	right: 15px;
	top: 9px;
	font-size: 20px;
	font-weight: bold;
	line-height: 20px;
	color: #CCC;
	text-shadow: 0 1px 0 white;
	cursor: pointer;
	height: 20px;
	overflow: hidden;
}
.vui .mce-close:hover {
	color: #AAA;
}
.vui .mce-window-head .mce-title {
	display: inline-block;
	*display: inline;
	*zoom: 1;
	line-height: 20px;
	font-size: 20px;
	font-weight: bold;
	text-rendering: optimizelegibility;
	padding-right: 10px;
}
.vui .mce-window .mce-container-body {
	display: block;
}
.vui .mce-foot {
	display: block;
	background-color: whiteSmoke;
	border-top: 1px solid #DDD;
	
	-webkit-box-shadow: inset 0 1px 0 #fff;
	-moz-box-shadow: inset 0 1px 0 #fff;
	box-shadow: inset 0 1px 0 #fff;
}
.vui .mce-window-head .mce-dragh {
	position: absolute;
	top: 0;
	left: 0;
	cursor: move;
	width: 90%;
	height: 100%}
.vui .mce-window iframe {
	width: 100%;
	height: 100%}
.vui.mce-window.mce-fullscreen, .vui .mce-window.mce-fullscreen .mce-foot {
	
}
.vui .mce-abs-layout {
	position: relative;
}
body.vui .mce-abs-layout-item, .vui .mce-abs-end {
	position: absolute;
}
.vui .mce-abs-end {
	width: 1px;
	height: 1px;
}
.vui .mce-container-body.mce-abs-layout {
	overflow: hidden;
}
.vui .mce-tooltip {
	position: absolute;
	padding: 5px;
}
.vui.mce-fullscreen .mce-tooltip,
.vui .mce-fullscreen .mce-tooltip {
	margin-top: 2px;
}
.vui .mce-tooltip-inner {
	font-size: 11px;
	background-color: #000;
	color: #fff;
	max-width: 200px;
	text-align: center;
	white-space: normal;
	
	<?= TOOLTIP_STYLESHEET; ?>
	
	<?= TOOLTIP_CONTENT_STYLESHEET; ?>
	
}
.vui .mce-tooltip-inner {
	
}
.vui .mce-tooltip-inner {
	
}
.vui .mce-tooltip-arrow {
	position: absolute;
	width: 0;
	height: 0;
	line-height: 0;
	border: 5px dashed <?= SCHEME_1_COLOR_1; ?>;
}
.vui .mce-tooltip-arrow-n {
	border-bottom-color: #000;
}
.vui .mce-tooltip-arrow-s {
	border-top-color: #000;
}
.vui .mce-tooltip-arrow-e {
	border-left-color: #000;
}
.vui .mce-tooltip-arrow-w {
	border-right-color: #000;
}
.vui .mce-tooltip-nw, .vui .mce-tooltip-sw {
	margin-left: -14px;
}
.vui .mce-tooltip-n .mce-tooltip-arrow {
	top: 0;
	left: 50%;
	margin-left: -5px;
	border-bottom-style: solid;
	border-top: 0;
	border-left-color: transparent;
	border-right-color: transparent;
}
.vui .mce-tooltip-nw .mce-tooltip-arrow {
	top: 0;
	left: 10px;
	border-bottom-style: solid;
	border-top: 0;
	border-left-color: transparent;
	border-right-color: transparent;
}
.vui .mce-tooltip-ne .mce-tooltip-arrow {
	top: 0;
	right: 10px;
	border-bottom-style: solid;
	border-top: 0;
	border-left-color: transparent;
	border-right-color: transparent;
}
.vui .mce-tooltip-s .mce-tooltip-arrow {
	bottom: 0;
	left: 50%;
	margin-left: -5px;
	border-top-style: solid;
	border-bottom: 0;
	border-left-color: transparent;
	border-right-color: transparent;
}
.vui .mce-tooltip-sw .mce-tooltip-arrow {
	bottom: 0;
	left: 10px;
	border-top-style: solid;
	border-bottom: 0;
	border-left-color: transparent;
	border-right-color: transparent;
}
.vui .mce-tooltip-se .mce-tooltip-arrow {
	bottom: 0;
	right: 10px;
	border-top-style: solid;
	border-bottom: 0;
	border-left-color: transparent;
	border-right-color: transparent;
}
.vui .mce-tooltip-e .mce-tooltip-arrow {
	right: 0;
	top: 50%;
	margin-top: -5px;
	border-left-style: solid;
	border-right: 0;
	border-top-color: transparent;
	border-bottom-color: transparent;
}
.vui .mce-tooltip-w .mce-tooltip-arrow {
	left: 0;
	top: 50%;
	margin-top: -5px;
	border-right-style: solid;
	border-left: none;
	border-top-color: transparent;
	border-bottom-color: transparent;
}
.vui .mce-btn {
	
	position:relative;
	
	display: inline-block;
	*display: inline;
	*zoom: 1;
	
	border:none;
	text-transform: none;
	color:<?= INPUTS_BUTTONS_COLOR; ?>;

	<?= INPUTS_BUTTONS_BACKGROUND; ?>;
	
	<?= INPUTS_BUTTONS_BORDER; ?>;
	
	transition:<?= DEFAULT_TRANSITION; ?>;
	
	<?= DEFAULT_BOX_SHADOW; ?>
	
	text-shadow:<?= TEXT_SHADOW_DARK; ?>;
	
	cursor:pointer;
	
	height: auto !important;
	
}
.vui .mce-btn:hover,
.vui .mce-btn:focus,
.vui .mce-btn:hover button,
.vui .mce-btn:focus button {
	
	color:<?= INPUTS_BUTTONS_COLOR_SEC; ?>;
	
	text-shadow:<?= TEXT_SHADOW_DARK_HOVER; ?>;
	
	<?= INPUTS_BUTTONS_BACKGROUND_HOVER; ?>;
	
	<?= INPUTS_BUTTONS_BORDER_SEC; ?>;
	
}
.vui .mce-btn.mce-disabled, .vui .mce-btn.mce-disabled:hover {
	cursor: default;
	background-image: none;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
	opacity: .65;
	filter: alpha(opacity=65);
	zoom: 1;
}
.vui .mce-btn.mce-active, .vui .mce-btn.mce-active:hover {
	color: #333;
	text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
	background-color: #d6d6d6;
	background-image: -moz-linear-gradient(top, #e6e6e6, #bfbfbf);
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#e6e6e6), to(#bfbfbf));
	background-image: -webkit-linear-gradient(top, #e6e6e6, #bfbfbf);
	background-image: -o-linear-gradient(top, #e6e6e6, #bfbfbf);
	background-image: linear-gradient(to bottom, #e6e6e6, #bfbfbf);
	background-repeat: repeat-x;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffe6e6e6', endColorstr='#ffbfbfbf', GradientType=0);
	zoom: 1;
	border-color: #bfbfbf #bfbfbf #999;
	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
	
	<?= DEFAULT_INSET_BOX_SHADOW; ?>
	
}
.vui .mce-btn button {
	
	padding: <?= BUTTONS_PADDING; ?>;
	font-size: <?= INPUTS_BUTTONS_FONT_SIZE; ?>;
	line-height: <?= DEFAULT_LINE_HEIGHT; ?>;
	*line-height: <?= DEFAULT_LINE_HEIGHT; ?>;
	cursor: pointer;
	color: <?= INPUTS_BUTTONS_COLOR; ?>;
	text-align: center;
	overflow: visible;
	-webkit-appearance: none;
	
}
.vui .mce-btn button::-moz-focus-inner {
	border: 0;
	padding: 0;
}
.vui .mce-btn i {
	
	<?= INPUTS_BUTTONS_BOX_SHADOW; ?>;
	
}
.vui .mce-primary {
	
	color:<?= INPUTS_BUTTONS_COLOR_SEC; ?>;
	
	text-shadow:<?= TEXT_SHADOW_DARK_HOVER; ?>;
	
	<?= SWITCH_BUTTONS_ACTIVE_BACKGROUND; ?>;
	
	<?= SWITCH_BUTTONS_ACTIVE_BORDER; ?>;
	
}
.vui .mce-primary:hover, .vui .mce-primary:focus {
	color: #fff;
	text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
	background-color: #005fb3;
	background-image: -moz-linear-gradient(top, #0077b3, #003cb3);
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0077b3), to(#003cb3));
	background-image: -webkit-linear-gradient(top, #0077b3, #003cb3);
	background-image: -o-linear-gradient(top, #0077b3, #003cb3);
	background-image: linear-gradient(to bottom, #0077b3, #003cb3);
	background-repeat: repeat-x;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff0077b3', endColorstr='#ff003cb3', GradientType=0);
	zoom: 1;
	border-color: #003cb3 #003cb3 #026;
	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
}
.vui .mce-primary button {
	color: #fff;
}
.vui .mce-btn-large button {
	padding:<?= INPUTS_BUTTONS_PADDING; ?>;
	font-size: <?= INPUTS_BUTTONS_FONT_SIZE; ?>;
	line-height: normal;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
}
.vui .mce-btn-large i {
	margin-top: 2px;
}
.vui .mce-btn-small button {
	padding: 3px 5px;
	font-size: 12px;
	line-height: 15px;
}
.vui .mce-btn-small i {
	margin-top: 0;
}
.vui .mce-btn .mce-caret {
	margin-top: 7px;
	*margin-top: 5px;
	margin-left: 0;
}
.vui .mce-btn-small .mce-caret {
	margin-top: 6px;
	*margin-top: 4px;
	margin-left: 0;
}

.vui .mce-toolbar .mce-btn,
.vui .mce-toolbar .mce-btn button,
.vui .mce-toolbar .mce-btn-group .mce-btn.mce-disabled{
	
	border: none;
	
	background: none;
	
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
	
}
.vui .mce-toolbar .mce-btn button{
	
	padding: 5px 7px;
		padding: <?= BUTTONS_PADDING; ?>;
	
}
.vui .mce-toolbar .mce-btn button,
.vui .mce-toolbar .mce-btn i,
.vui .mce-toolbar .mce-btn span{
	
	color: <?= VUI_FONT_COLOR; ?>;
	text-shadow: <?= DEFAULT_TEXT_SHADOW; ?>;
	
}
.vui .mce-toolbar .mce-btn:hover,
.vui .mce-toolbar .mce-btn:hover button,
.vui .mce-toolbar .mce-btn:hover button i,
.vui .mce-toolbar .mce-btn:hover span{
	
	color:<?= INPUTS_BUTTONS_COLOR_SEC; ?>;
	
	text-shadow:<?= TEXT_SHADOW_DARK_HOVER; ?>;
	
	<?= INPUTS_BUTTONS_BACKGROUND_HOVER; ?>;
	
}

.vui .mce-caret {
	display: inline-block;
	*display: inline;
	*zoom: 1;
	width: 0;
	height: 0;
	vertical-align: top;
	border-top: 4px solid <?= VUI_FONT_COLOR; ?>;
	border-right: 4px solid transparent;
	border-left: 4px solid transparent;
	content: ""
}
.vui .mce-toolbar .mce-btn:hover button i.mce-caret{
	
	border-top-color: <?= INPUTS_BUTTONS_COLOR_SEC; ?>;
	
}

.vui .mce-disabled .mce-caret {
	border-top-color: #999;
}
.vui .mce-caret.mce-up {
	border-bottom: 4px solid <?= VUI_FONT_COLOR; ?>;
	border-top: 0;
}
.vui .mce-btn-group .mce-btn {
	
	border-width: 1px 0 1px 0;
	margin: 0;
	
}
.vui .mce-btn-group .mce-btn:hover, .vui .mce-btn-group .mce-btn:focus {
	
}
.vui .mce-btn-group .mce-btn.mce-disabled, .vui .mce-btn-group .mce-btn.mce-disabled:hover {
	
	-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	-moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	
	
}
.vui .mce-btn-group .mce-btn.mce-active, .vui .mce-btn-group .mce-btn.mce-active:hover, .vui .mce-btn-group .mce-btn:active {
	
	background: rgba(0, 42, 94, 0.07);
	
	<?= DEFAULT_INSET_BOX_SHADOW; ?>
	
}
.vui .mce-btn-group .mce-btn.mce-disabled button {
	opacity: .65;
	filter: alpha(opacity=65);
	zoom: 1;
}
.vui .mce-btn-group .mce-first {
	
	border-left: 1px solid rgba(0, 42, 94, 0.1);
	
}
.vui .mce-btn-group .mce-last {
	
}
.vui .mce-btn-group .mce-first.mce-last {
	
}
.vui .mce-btn-group .mce-btn.mce-flow-layout-item {
	margin: 0;
}
.vui .mce-checkbox {
	cursor: pointer;
}
.vui i.mce-i-checkbox {
	margin: 0 3px 0 0;
	border: 1px solid #c5c5c5;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	-moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	background-color: #f0f0f0;
	background-image: -moz-linear-gradient(top, #fdfdfd, #ddd);
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fdfdfd), to(#ddd));
	background-image: -webkit-linear-gradient(top, #fdfdfd, #ddd);
	background-image: -o-linear-gradient(top, #fdfdfd, #ddd);
	background-image: linear-gradient(to bottom, #fdfdfd, #ddd);
	background-repeat: repeat-x;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fffdfdfd', endColorstr='#ffdddddd', GradientType=0);
	zoom: 1;
	text-indent: -1000%;
	overflow: hidden;
	*font-size: 0;
	*line-height: 0;
	*text-indent: 0;
}
.vui .mce-checked i.mce-i-checkbox {
	color: #000;
	font-size: 16px;
	line-height: 16px;
	text-indent: 0;
}
.vui .mce-checkbox:focus i.mce-i-checkbox {
	border: 1px solid #59a5e1;
	border: 1px solid rgba(82, 168, 236, 0.8);
	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
}
.vui .mce-colorbutton .mce-ico {
	position: relative;
}
.vui .mce-colorpicker {
	background: #FFF;
}
.vui .mce-colorbutton-grid {
	margin: 4px;
}
.vui .mce-colorbutton button {
	padding-right: 2px !important;
}
.vui .mce-colorbutton .mce-preview {
	padding-right: 3px;
	display: block;
	position: absolute;
	left: 50%;
	top: 50%;
	margin-left: -12px;
	margin-top: 7px;
	background: gray;
	width: 13px;
	height: 2px;
	overflow: hidden;
}
.vui .mce-colorbutton.mce-btn-small .mce-preview {
	margin-left: -17px;
	padding-right: 0;
	width: 16px;
}
.vui .mce-colorbutton .mce-open {
	padding-left: 2px !important;
	padding-right: 2px !important;
	border-left: 1px solid transparent;
	border-right: 1px solid transparent;
}
.vui .mce-colorbutton:hover .mce-open {
	border-left-color: #c5c5c5;
	border-right-color: #c5c5c5;
}
.vui .mce-combobox {
	display: inline-block;
	*display: inline;
	*zoom: 1;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	width: 100px;
	-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	-moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
}
.vui .mce-combobox input {
	
	height: auto;
	
}
.vui .mce-combobox.mce-has-open input {
	-webkit-border-radius: 4px 0 0 4px;
	-moz-border-radius: 4px 0 0 4px;
	border-radius: 4px 0 0 4px;
}
.vui .mce-combobox .mce-btn {
	border-left: 0;
	-webkit-border-radius: 0 4px 4px 0;
	-moz-border-radius: 0 4px 4px 0;
	border-radius: 0 4px 4px 0;
}
.vui .mce-combobox button {
	padding-right: 8px;
	padding-left: 8px;
}
.vui .mce-combobox *:focus {
	border-color: #59a5e1;
	border-color: rgba(82, 168, 236, 0.8);
	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
}
.vui .mce-path {
	display: inline-block;
	*display: inline;
	*zoom: 1;
	padding: 8px;
	white-space: normal;
}
.vui .mce-path .mce-txt {
	display: inline-block;
	padding-right: 3px;
}
.vui .mce-path .mce-path-body {
	display: inline-block;
}
.vui .mce-path-item {
	display: inline-block;
	*display: inline;
	*zoom: 1;
	cursor: pointer;
	color: <?= VUI_FONT_COLOR; ?>;
}
.vui .mce-path-item:hover {
	text-decoration: underline;
}
.vui .mce-path-item:focus {
	background: gray;
	color: white;
}
.vui .mce-path .mce-divider {
	display: inline;
}
.vui .mce-fieldset {
	border: 0 solid #9e9e9e;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
}
.vui .mce-fieldset>.mce-container-body {
	margin-top: -15px;
}
.vui .mce-fieldset-title {
	margin-left: 5px;
	padding: 0 5px 0 5px;
}
.vui .mce-fit-layout {
	display: inline-block;
	*display: inline;
	*zoom: 1;
}
.vui .mce-fit-layout-item {
	position: absolute;
}
.vui .mce-flow-layout-item {
	display: inline-block;
	*display: inline;
	*zoom: 1;
}
.vui .mce-flow-layout-item {
	
}
.vui .mce-flow-layout-item.mce-last {
	margin-right: 2px;
}
.vui .mce-flow-layout {
	white-space: normal;
}
.vui .mce-tinymce-inline .mce-flow-layout {
	white-space: nowrap;
}
.vui .mce-iframe {
	border: 0 solid #c5c5c5;
	width: 100%;
	height: 100%}
.vui .mce-label {
	display: inline-block;
	*display: inline;
	*zoom: 1;
	text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
	border: 0 solid #c5c5c5;
	overflow: hidden;
}
.vui .mce-label.mce-autoscroll {
	overflow: auto;
}
.vui .mce-label-disabled .mce-text {
	color: #999;
}
.vui .mce-label.mce-multiline {
	white-space: pre-wrap;
}
.vui .mce-menubar .mce-menubtn {
	border-color: transparent;
	background: transparent;
	-webkit-border-radius: 0;
	-moz-border-radius: 0;
	border-radius: 0;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
	filter: none;
}
.vui .mce-menubar {
	border: 1px solid #ddd;
}
.vui .mce-menubar .mce-menubtn button {
	color: #000;
}
.vui .mce-menubar .mce-menubtn:hover, .vui .mce-menubar .mce-menubtn.mce-active, .vui .mce-menubar .mce-menubtn:focus {
	border-color: transparent;
	background: #ddd;
	filter: none;
}
.vui .mce-menubtn.mce-disabled span {
	color: <?= VUI_FONT_COLOR; ?>;
	opacity: .5;
	filter: alpha(opacity=50);
}
.vui .mce-menubtn span {
	margin-right: 2px;
}
.vui .mce-menubtn.mce-btn-small span {
	font-size: 12px;
	line-height: 15px;
	*line-height: 16px;
}
.vui .mce-menubtn.mce-fixed-width span {
	display: inline-block;
	overflow-x: hidden;
	text-overflow: ellipsis;
	width: 90px;
}
.vui .mce-menubtn.mce-fixed-width.mce-btn-small span {
	width: 70px;
}
.vui .mce-listbox button {
	text-align: left;
	padding-right: 20px;
	position: relative;
}
.vui .mce-listbox .mce-caret {
	position: absolute;
	margin-top: -2px;
	right: 8px;
	top: 50%;
}
.vui .mce-menu-item {
	display: block;
	padding: <?= LINK_BUTTONS_PADDING; ?>;
	clear: both;
	font-weight: normal;
	color: <?= VUI_FONT_COLOR; ?>;
	white-space: nowrap;
	cursor: pointer;
	line-height: normal;
	border-left: 4px solid transparent;
	margin-bottom: 1px;
}
.vui .mce-menu-item.mce-disabled .mce-text {
	color: #999;
}
.vui .mce-menu-item:hover, .vui .mce-menu-item.mce-selected, .vui .mce-menu-item:focus {
	text-decoration: none;
	color: <?= INPUTS_BUTTONS_COLOR_SEC; ?>;
	<?= INPUTS_BUTTONS_BACKGROUND_HOVER; ?>
	zoom: 1;
}
.vui .mce-menu-item:hover .mce-text, .vui .mce-menu-item.mce-selected .mce-text {
	color: <?= INPUTS_BUTTONS_COLOR_SEC; ?>;
}
.vui .mce-menu-item:hover .mce-ico, .vui .mce-menu-item.mce-selected .mce-ico, .vui .mce-menu-item:focus .mce-ico {
	color: white;
}
.vui .mce-menu-item.mce-disabled:hover {
	background: #CCC;
}
.vui .mce-menu-shortcut {
	display: inline-block;
	color: #999;
}
.vui .mce-menu-shortcut {
	display: inline-block;
	*display: inline;
	*zoom: 1;
	padding: 0 15px 0 20px;
}
.vui .mce-menu-item .mce-caret {
	margin-top: 4px;
	*margin-top: 3px;
	margin-right: 6px;
	border-top: 4px solid transparent;
	border-bottom: 4px solid transparent;
	border-left: 4px solid <?= VUI_FONT_COLOR; ?>;
}
.vui .mce-menu-item.mce-selected .mce-caret, .vui .mce-menu-item:focus .mce-caret {
	border-left-color: #FFF;
}
.vui .mce-menu-align .mce-menu-shortcut {
	*margin-top: -2px;
}
.vui .mce-menu-align .mce-menu-shortcut, .vui .mce-menu-align .mce-caret {
	position: absolute;
	right: 0;
}
.vui .mce-menu-item-sep, .vui .mce-menu-item-sep:hover {
	padding: 0;
	height: 1px;
	margin: 9px 1px;
	overflow: hidden;
	background: #e5e5e5;
	border-bottom: 1px solid white;
	cursor: default;
	filter: none;
}
.vui .mce-menu-item.mce-active i {
	visibility: visible;
}
.vui .mce-menu-item.mce-active {
	background-color: #c8def4;
	outline: 1px solid #c5c5c5;
}
.vui .mce-menu-item-preview.mce-active {
	border-left: 5px solid #aaa;
	background-color: transparent;
	outline: 0;
}
.vui .mce-menu-item-checkbox.mce-active {
	background-color: #FFF;
	outline: 0;
}
.vui .mce-menu{
	z-index: 1000;
	margin: 2px 0 0;
	min-width: 160px;
	z-index: 1002;
	
	max-height: 400px;
	overflow: auto;
	overflow-x: hidden;
	
	<?= MODAL_STYLESHEET; ?>
	
}
.vui.mce-fullscreen .mce-menu,
.vui .mce-fullscreen .mce-menu{
	margin-top: 2px;
}
.vui .mce-menu i {
	display: none;
}
.vui .mce-menu-has-icons i {
	display: inline-block;
	*display: inline;
	*zoom: 1;
}
.vui .mce-menu-sub-tr-tl {
	margin: -6px 0 0 -1px;
}
.vui .mce-menu-sub-br-bl {
	margin: 6px 0 0 -1px;
}
.vui .mce-menu-sub-tl-tr {
	margin: -6px 0 0 1px;
}
.vui .mce-menu-sub-bl-br {
	margin: 6px 0 0 1px;
}
.vui.mce-fullscreen .mce-menu-sub-tr-tl,
.vui .mce-fullscreen .mce-menu-sub-tr-tl {
	margin-top: 6px;
}
.vui.mce-fullscreen .mce-menu-sub-br-bl,
.vui .mce-fullscreen .mce-menu-sub-br-bl {
	margin-top: 6px;
}
.vui.mce-fullscreen .mce-menu-sub-tl-tr,
.vui .mce-fullscreen .mce-menu-sub-tl-tr {
	margin-top: 6px;
}
.vui.mce-fullscreen .mce-menu-sub-bl-br,
.vui .mce-fullscreen .mce-menu-sub-bl-br {
	margin-top: 6px;
}
.vui i.mce-radio {
	padding: 1px;
	margin: 0 3px 0 0;
	background-color: #fafafa;
	border: 1px solid #cacece;
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	-moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	background-color: #f0f0f0;
	background-image: -moz-linear-gradient(top, #fdfdfd, #ddd);
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fdfdfd), to(#ddd));
	background-image: -webkit-linear-gradient(top, #fdfdfd, #ddd);
	background-image: -o-linear-gradient(top, #fdfdfd, #ddd);
	background-image: linear-gradient(to bottom, #fdfdfd, #ddd);
	background-repeat: repeat-x;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fffdfdfd', endColorstr='#ffdddddd', GradientType=0);
	zoom: 1;
}
.vui i.mce-radio:after {
	font-family: <?= INPUTS_BUTTONS_FONT_FAMILY; ?>;
	font-size: 12px;
	color: #000;
	content: '\25cf'}
.vui .mce-container-body .mce-resizehandle {
	position: absolute;
	right: 0;
	bottom: 0;
	width: 16px;
	height: 16px;
	visibility: visible;
	cursor: s-resize;
	margin: 0;
}
.vui .mce-container-body .mce-resizehandle-both {
	cursor: se-resize;
}
.vui i.mce-i-resize {
	color: <?= VUI_FONT_COLOR; ?>;
}
.vui .mce-spacer {
	visibility: hidden;
}
.vui .mce-splitbtn .mce-open {
	border-left: 1px solid transparent;
	border-right: 1px solid transparent;
}
.vui .mce-splitbtn:hover .mce-open {
	border-left-color: #c5c5c5;
	border-right-color: #c5c5c5;
}
.vui .mce-splitbtn button {
	padding-right: 4px;
}
.vui .mce-splitbtn .mce-open {
	padding-left: 4px;
}
.vui .mce-splitbtn .mce-open.mce-active {
	
	background: rgba(0, 42, 94, 0.07);
	
	<?= DEFAULT_INSET_BOX_SHADOW; ?>
	
}
.vui .mce-stack-layout-item {
	display: block;
}
.vui .mce-tabs {
	display: block;
	border-bottom: 1px solid #ccc;
}
.vui .mce-tab {
	display: inline-block;
	*display: inline;
	*zoom: 1;
	border: 1px solid #ccc;
	border-width: 1px 1px 0 0;
	background: #e3e3e3;
	padding: 8px;
	text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
	height: 13px;
	cursor: pointer;
}
.vui .mce-tab:hover {
	background: #fdfdfd;
}
.vui .mce-tab.mce-active {
	background: #fdfdfd;
	border-bottom-color: transparent;
	margin-bottom: -1px;
	height: 14px;
}
.vui .mce-textbox {
	
	resize: none;
	
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	
	position:relative;
	<?= css_display_inline_block(); ?>;
	
	<?= INPUTS_BORDER; ?>
	
	font-family: <?= DEFAULT_FONT_FAMILY; ?>;
	font-size: inherit;
	padding:<?= INPUTS_PADDING; ?>;
	margin:0;
	margin-bottom:<?= DEFAULT_SPACING; ?>px;
	color:<?= INPUTS_FOREGROUND_COLOR; ?>;
	line-height: normal;
	
	<?= INPUTS_BACKGROUND; ?>
	
	<?= DEFAULT_INSET_BOX_SHADOW; ?>
	
	<?= DEFAULT_BORDER_RADIUS; ?>
	
	transition:
		opacity  0.1s ease-in-out,
		color 0.1s ease-in-out,
		background 0.1s ease-in-out,
		border 0.1s ease-in-out;
	
	text-shadow:<?= TEXT_SHADOW_LIGHT; ?>;
	
	cursor:text;
	
	white-space: pre-wrap;
	*white-space: pre;
	
}
.vui .mce-textbox:focus {
	
}
.vui .mce-placeholder .mce-textbox {
	color: #aaa;
}
.vui .mce-textbox.mce-multiline {
	
}
.vui .mce-throbber {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	opacity: .6;
	filter: alpha(opacity=60);
	zoom: 1;
	background: #fff url('<?= JS_DIR_URL; ?>/plugins/tinymce/skins/vecms/img/loader.gif') no-repeat center center;
}
@font-face {
	font-family: 'tinymce';
	src: url('<?= JS_DIR_URL; ?>/plugins/tinymce/skins/vecms/fonts/icomoon.eot');
	src: url('<?= JS_DIR_URL; ?>/plugins/tinymce/skins/vecms/fonts/icomoon.eot?#iefix') format('embedded-opentype'), url('<?= JS_DIR_URL; ?>/plugins/tinymce/skins/vecms/fonts/icomoon.svg#icomoon') format('svg'), url('<?= JS_DIR_URL; ?>/plugins/tinymce/skins/vecms/fonts/icomoon.woff') format('woff'), url('<?= JS_DIR_URL; ?>/plugins/tinymce/skins/vecms/fonts/icomoon.ttf') format('truetype');
	font-weight: normal;
	font-style: normal;
}
@font-face {
	font-family: 'tinymce-small';
	src: url('<?= JS_DIR_URL; ?>/plugins/tinymce/skins/vecms/fonts/icomoon-small.eot');
	src: url('<?= JS_DIR_URL; ?>/plugins/tinymce/skins/vecms/fonts/icomoon-small.eot?#iefix') format('embedded-opentype'), url('<?= JS_DIR_URL; ?>/plugins/tinymce/skins/vecms/fonts/icomoon-small.svg#icomoon') format('svg'), url('<?= JS_DIR_URL; ?>/plugins/tinymce/skins/vecms/fonts/icomoon-small.woff') format('woff'), url('<?= JS_DIR_URL; ?>/plugins/tinymce/skins/vecms/fonts/icomoon-small.ttf') format('truetype');
	font-weight: normal;
	font-style: normal;
}
.vui .mce-ico {
	
	font-family: 'tinymce', Arial;
	font-style: normal;
	font-weight: normal;
	font-size: 16px;
	line-height: 16px;
	vertical-align: text-top;
	-webkit-font-smoothing: antialiased;
	display: inline-block;
	background: transparent center center;
	width: 16px;
	height: 16px;
	color:<?= INPUTS_BUTTONS_COLOR; ?>;

}
.vui .mce-btn:hover .mce-ico,
.vui .mce-btn:focus .mce-ico {
	
	color:<?= INPUTS_BUTTONS_COLOR_SEC; ?>;
	
}
.vui .mce-btn-small .mce-ico {
	font-family: 'tinymce-small', Arial;
}
.vui .mce-i-save:before {
	content: "\e000"}
.vui .mce-i-newdocument:before {
	content: "\e001"}
.vui .mce-i-fullpage:before {
	content: "\e002"}
.vui .mce-i-alignleft:before {
	content: "\e003"}
.vui .mce-i-aligncenter:before {
	content: "\e004"}
.vui .mce-i-alignright:before {
	content: "\e005"}
.vui .mce-i-alignjustify:before {
	content: "\e006"}
.vui .mce-i-cut:before {
	content: "\e007"}
.vui .mce-i-paste:before {
	content: "\e008"}
.vui .mce-i-searchreplace:before {
	content: "\e009"}
.vui .mce-i-bullist:before {
	content: "\e00a"}
.vui .mce-i-numlist:before {
	content: "\e00b"}
.vui .mce-i-indent:before {
	content: "\e00c"}
.vui .mce-i-outdent:before {
	content: "\e00d"}
.vui .mce-i-blockquote:before {
	content: "\e00e"}
.vui .mce-i-undo:before {
	content: "\e00f"}
.vui .mce-i-redo:before {
	content: "\e010"}
.vui .mce-i-link:before {
	content: "\e011"}
.vui .mce-i-unlink:before {
	content: "\e012"}
.vui .mce-i-anchor:before {
	content: "\e013"}
.vui .mce-i-image:before {
	content: "\e014"}
.vui .mce-i-media:before {
	content: "\e015"}
.vui .mce-i-help:before {
	content: "\e016"}
.vui .mce-i-code:before {
	content: "\e017"}
.vui .mce-i-inserttime:before {
	content: "\e018"}
.vui .mce-i-preview:before {
	content: "\e019"}
.vui .mce-i-forecolor:before {
	content: "\e01a"}
.vui .mce-i-backcolor:before {
	content: "\e01a"}
.vui .mce-i-table:before {
	content: "\e01b"}
.vui .mce-i-hr:before {
	content: "\e01c"}
.vui .mce-i-removeformat:before {
	content: "\e01d"}
.vui .mce-i-subscript:before {
	content: "\e01e"}
.vui .mce-i-superscript:before {
	content: "\e01f"}
.vui .mce-i-charmap:before {
	content: "\e020"}
.vui .mce-i-emoticons:before {
	content: "\e021"}
.vui .mce-i-print:before {
	content: "\e022"}
.vui .mce-i-fullscreen:before {
	content: "\e023"}
.vui .mce-i-spellchecker:before {
	content: "\e024"}
.vui .mce-i-nonbreaking:before {
	content: "\e025"}
.vui .mce-i-template:before {
	content: "\e026"}
.vui .mce-i-pagebreak:before {
	content: "\e027"}
.vui .mce-i-restoredraft:before {
	content: "\e028"}
.vui .mce-i-untitled:before {
	content: "\e029"}
.vui .mce-i-bold:before {
	content: "\e02a"}
.vui .mce-i-italic:before {
	content: "\e02b"}
.vui .mce-i-underline:before {
	content: "\e02c"}
.vui .mce-i-strikethrough:before {
	content: "\e02d"}
.vui .mce-i-visualchars:before {
	content: "\e02e"}
.vui .mce-i-visualblocks:before {
	content: "\e02e"}
.vui .mce-i-ltr:before {
	content: "\e02f"}
.vui .mce-i-rtl:before {
	content: "\e030"}
.vui .mce-i-copy:before {
	content: "\e031"}
.vui .mce-i-resize:before {
	content: "\e032"}
.vui .mce-i-browse:before {
	content: "\e034"}
.vui .mce-i-pastetext:before {
	content: "\e035"}
.vui .mce-i-checkbox:before, .vui .mce-i-selected:before {
	content: "\e033"}
.vui .mce-i-selected {
	visibility: hidden;
}
.vui .mce-toolbar .mce-btn i.mce-i-backcolor {
	color: #fff;
	text-shadow: none;
	background: <?= VUI_FONT_COLOR; ?>;
}
.vui.mce-fullscreen.tabs-on .tabs-container,
.vui.mce-fullscreen .tabs-container,
.vui.mce-fullscreen .form-actions,
.vui.mce-fullscreen #toolbar,
.vui.mce-fullscreen #top-block,
.vui.mce-fullscreen #content,
.vui .mce-fullscreen.tabs-on .tabs-container,
.vui .mce-fullscreen .tabs-on .tabs-container,
.vui .mce-fullscreen .form-actions,
.vui .mce-fullscreen #toolbar,
.vui .mce-fullscreen #top-block,
.vui .mce-fullscreen #content{
	
	z-index: 0;
	
}
div.mce-fullscreen *{
	
	z-index: 0 !important;
	
}
div.vui.mce-fullscreen{
	
	z-index: 1000 !important;
	
}




/*
 --------------------------------------------------------------------------------------------------
 Tinymce
 --------------------------------------------------------------------------------------------------
 **************************************************************************************************
 **************************************************************************************************
 */
