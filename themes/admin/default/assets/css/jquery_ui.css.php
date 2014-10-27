
/*************************************************************************/
/*************************************************************************/
/*********************************** Ui **********************************/

.ui-helper-hidden {
	display: none;
}
.ui-helper-hidden-accessible {
	border: 0;
	clip: rect(0 0 0 0);
	height: 1px;
	margin: -1px;
	overflow: hidden;
	padding: 0;
	position: absolute;
	width: 1px;
}
.ui-helper-reset {
	margin: 0;
	padding: 0;
	border: 0;
	outline: 0;
	line-height: 1.3;
	text-decoration: none;
	font-size: 100%;
	list-style: none;
}
.ui-helper-clearfix:before,
.ui-helper-clearfix:after {
	content: '';
	display: table;
	border-collapse: collapse;
}
.ui-helper-clearfix:after {
	clear: both;
}
.ui-helper-clearfix {
	min-height: 0; /* support: IE7 */
}
.ui-helper-zfix {
	width: 100%;
	height: 100%;
	top: 0;
	left: 0;
	position: absolute;
	opacity: 0;
	filter:Alpha(Opacity=0);
}

.ui-front {
	z-index: 100;
}


/* Interaction Cues
----------------------------------*/
.ui-state-disabled {
	cursor: default !important;
}


/* Icons
----------------------------------*/

/* states and images */
.ui-icon {
	display: block;
	text-indent: 0;
	font-size: 0.00001px;
	overflow: hidden;
	background-repeat: no-repeat;
}
.ui-icon:before {
	font-size: 16px;
	line-height: 16px;
}


/* Misc visuals
----------------------------------*/

/* Overlays */
.ui-widget-overlay {
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}
.ui-datepicker {
	min-width: 20em;
	width: auto;
	padding: <?= DEFAULT_SPACING; ?>px;
	display: none;
	z-index: 10000 !important;
}
.ui-datepicker .ui-datepicker-header {
	position: relative;
	padding: <?= DEFAULT_SPACING; ?>px;
}
.ui-datepicker .ui-datepicker-prev,
.ui-datepicker .ui-datepicker-next {
	position: relative;
	display: block;
	top: auto;
	width: auto;
	height: auto;
	font-size: 16px;
	
	padding: <?= BUTTONS_PADDING; ?>;
	
	border: none;
	
	cursor: pointer;
	line-height: normal;
	
}
.ui-datepicker .ui-datepicker-prev-hover,
.ui-datepicker .ui-datepicker-next-hover {
	top: auto;
}
.ui-datepicker .ui-datepicker-prev {
	left: auto;
	float: left;
}
.ui-datepicker .ui-datepicker-prev:before,
.ui-datepicker .ui-datepicker-next:before {
	content: "";
	position: relative;
	display: block;
	font-size: 16px;
	line-height: 16px;
	text-indent: -10000px;
	
	<?= FONT_ICONS_STYLESHEET; ?>
	
	

}
.ui-datepicker .ui-datepicker-next {
	right: auto;
	float: right;
}
.ui-datepicker .ui-datepicker-prev-hover {
	left: auto;
}
.ui-datepicker .ui-datepicker-next-hover {
	right: auto;
}
.ui-datepicker .ui-datepicker-prev span,
.ui-datepicker .ui-datepicker-next span {
	display: block;
	position: absolute;
	left: 50%;
	margin-left: -8px;
	top: 50%;
	margin-top: -8px;
}
.ui-datepicker .ui-datepicker-title {
	margin: 0 1.5em;
	line-height: 1.8em;
	text-align: center;
}
.ui-datepicker .ui-datepicker-title select {
	font-size: inherit;
	margin: 0;
}
.ui-datepicker select.ui-datepicker-month-year {
	width: 100%;
}
.ui-datepicker select.ui-datepicker-month,
.ui-datepicker select.ui-datepicker-year {
	width: 50%;
}
.ui-datepicker table {
	width: 100%;
	font-size: inherit;
	border-collapse: collapse;
	margin: 0;
	border: 0;
}
.ui-datepicker th {
	padding: .7em .3em;
	text-align: center;
	font-weight: bold;
	border: 0;
	
	<?= DEFAULT_TABLE_TH_BACKGROUND; ?>
	
}
.ui-datepicker tr,
.ui-datepicker tr:hover {
	border: 0 !important;
	background: none !important;
}
.ui-datepicker td,
.ui-datepicker td:hover,
.ui-datepicker tr:nth-child(odd) td,
.ui-datepicker tr:nth-child(even) td {
	border: 0;
	padding: 1px;
	background: none;
	text-align: center;
}
.ui-datepicker td span,
.ui-datepicker td a {
	display: block;
	padding: 2px;
	text-decoration: none;
}
.ui-datepicker .ui-datepicker-buttonpane {
	margin: 0;
	padding: 0;
	border: none !important;
	background: none !important;
}
.ui-datepicker .ui-datepicker-buttonpane button {
	float: right;
	margin: .5em 0 0;
	cursor: pointer;
	padding: <?= INPUTS_BUTTONS_PADDING; ?>;
	width: auto;
	overflow: visible;
}
.ui-datepicker .ui-datepicker-buttonpane button.ui-datepicker-current {
	float: left;
}

/* with multiple calendars */
.ui-datepicker.ui-datepicker-multi {
	width: auto;
}
.ui-datepicker-multi .ui-datepicker-group {
	float: left;
}
.ui-datepicker-multi .ui-datepicker-group table {
	width: 95%;
	margin: 0 auto .4em;
}
.ui-datepicker-multi-2 .ui-datepicker-group {
	width: 50%;
}
.ui-datepicker-multi-3 .ui-datepicker-group {
	width: 33.3%;
}
.ui-datepicker-multi-4 .ui-datepicker-group {
	width: 25%;
}
.ui-datepicker-multi .ui-datepicker-group-last .ui-datepicker-header,
.ui-datepicker-multi .ui-datepicker-group-middle .ui-datepicker-header {
	border-left-width: 0;
}
.ui-datepicker-multi .ui-datepicker-buttonpane {
	clear: left;
}
.ui-datepicker-row-break {
	clear: both;
	width: 100%;
	font-size: 0;
}

/* RTL support */
.ui-datepicker-rtl {
	direction: rtl;
}
.ui-datepicker-rtl .ui-datepicker-prev {
	right: 2px;
	left: auto;
}
.ui-datepicker-rtl .ui-datepicker-next {
	left: 2px;
	right: auto;
}
.ui-datepicker-rtl .ui-datepicker-prev:hover {
	right: 1px;
	left: auto;
}
.ui-datepicker-rtl .ui-datepicker-next:hover {
	left: 1px;
	right: auto;
}
.ui-datepicker-rtl .ui-datepicker-buttonpane {
	clear: right;
}
.ui-datepicker-rtl .ui-datepicker-buttonpane button {
	float: left;
}
.ui-datepicker-rtl .ui-datepicker-buttonpane button.ui-datepicker-current,
.ui-datepicker-rtl .ui-datepicker-group {
	float: right;
}
.ui-datepicker-rtl .ui-datepicker-group-last .ui-datepicker-header,
.ui-datepicker-rtl .ui-datepicker-group-middle .ui-datepicker-header {
	border-right-width: 0;
	border-left-width: 1px;
}





/* Component containers
----------------------------------*/
.ui-widget {
	
	font-family: <?= DEFAULT_FONT_FAMILY; ?>;
	font-size: inherit;
	border: none;
	
	<?= DEFAULT_BOX_SHADOW; ?>
	
	<?= DEFAULT_BORDER_RADIUS; ?>
	
}
.ui-widget .ui-widget {
	font-size: inherit;
}
.ui-widget input,
.ui-widget select,
.ui-widget textarea,
.ui-widget button {
	font-family: <?= DEFAULT_FONT_FAMILY; ?>;
	font-size: <?= BUTTONS_FONT_SIZE; ?>;
}
.ui-widget-content {
	
	<?= MODAL_STYLESHEET; ?>
	
	color: <?= VUI_FONT_COLOR; ?>;
	
}
.ui-widget-content a {
	
}
.ui-widget-header {
	border: none;
	background: none;
	color: <?= VUI_FONT_COLOR; ?>;
	font-weight: normal;
	padding: <?= DEFAULT_SPACING; ?>px;
}
.ui-widget-header {
	border: none;
	font-family: <?= FONT_FAMILY_SEC; ?>;
	background: rgba( 0, 42, 94, .07 );
	color: <?= VUI_FONT_COLOR; ?>;
	font-weight: normal;
}
.ui-widget-header a {
	color: <?= VUI_FONT_COLOR; ?>;
}
.ui-widget-header a:hover {
	color: <?= LINK_COLOR; ?>;
}

/* Interaction states
----------------------------------*/
.ui-state-default,
.ui-widget-content .ui-state-default,
.ui-widget-header .ui-state-default {
	
	font-family: <?= INPUTS_BUTTONS_FONT_FAMILY; ?>;
	font-size: <?= INPUTS_BUTTONS_FONT_SIZE; ?>;
	text-transform: none;
	
	padding: <?= BUTTONS_PADDING; ?>;
	
	color:<?= INPUTS_BUTTONS_COLOR; ?>;

	<?= INPUTS_BUTTONS_BACKGROUND; ?>;
	
	<?= INPUTS_BUTTONS_BORDER; ?>;
	
	transition:<?= DEFAULT_TRANSITION; ?>;
	
	<?= INPUTS_BUTTONS_BOX_SHADOW; ?>;
	
	text-shadow:<?= INPUTS_BUTTONS_TEXT_SHADOW; ?>;
	
	cursor:pointer;
	
}
/* Datepicker Interaction states
----------------------------------*/
.ui-datepicker-calendar .ui-state-default,
.ui-datepicker-calendar .ui-widget-content .ui-state-default,
.ui-datepicker-calendar .ui-widget-header .ui-state-default {
	
	font-size: inherit;
	text-transform: none;
	
	padding: <?= BUTTONS_PADDING_TOP / 2; ?>px <?= BUTTONS_PADDING_RIGHT; ?>px <?= BUTTONS_PADDING_BOTTOM / 2; ?>px <?= BUTTONS_PADDING_LEFT; ?>px;
	
	background: none;
	border: none;
	margin: 0;
	text-align: center;
	transition:<?= DEFAULT_TRANSITION; ?>;
	
	<?= BOX_SHADOW_NONE; ?>;
	
	text-shadow:<?= INPUTS_BUTTONS_TEXT_SHADOW; ?>;
	
	cursor:pointer;
	
}

.ui-state-default a,
.ui-state-default a:link,
.ui-state-default a:visited {
	
}
.ui-state-hover,
.ui-widget-content .ui-state-hover,
.ui-widget-header .ui-state-hover,
.ui-state-focus,
.ui-widget-content .ui-state-focus,
.ui-widget-header .ui-state-focus {
	
	border: none;
	background: none;
	font-weight: normal/*{fwDefault}*/;
	color: <?= VUI_FONT_COLOR; ?>;
	
}
.ui-state-hover a,
.ui-state-hover a:hover,
.ui-state-hover a:link,
.ui-state-hover a:visited {
	
}
.ui-state-active,
.ui-widget-content .ui-state-active,
.ui-widget-header .ui-state-active {
	
	<?= PRESSED_STYLESHEET; ?>
	
}
.ui-state-active a,
.ui-state-active a:link,
.ui-state-active a:visited {
	
}

/* Interaction Cues
----------------------------------*/
.ui-state-highlight,
.ui-widget-content .ui-state-highlight,
.ui-widget-header .ui-state-highlight {
	
	color: <?= HIGHLIGHT_FONT_COLOR; ?>;
	<?= HIGHLIGHT_BACKGROUND; ?>
	
}
.ui-state-highlight a,
.ui-widget-content .ui-state-highlight a,
.ui-widget-header .ui-state-highlight a {
	color: #363636;
}
.ui-state-error,
.ui-widget-content .ui-state-error,
.ui-widget-header .ui-state-error {
	border: 1px solid #cd0a0a;
	background: #b81900 url(images/ui-bg_diagonals-thick_18_b81900_40x40.png) 50% 50% repeat;
	color: #ffffff;
}
.ui-state-error a,
.ui-widget-content .ui-state-error a,
.ui-widget-header .ui-state-error a {
	color: #ffffff;
}
.ui-state-error-text,
.ui-widget-content .ui-state-error-text,
.ui-widget-header .ui-state-error-text {
	color: #ffffff;
}
.ui-priority-primary,
.ui-widget-content .ui-priority-primary,
.ui-widget-header .ui-priority-primary {
	font-weight: inherit;
}
.ui-priority-secondary,
.ui-widget-content .ui-priority-secondary,
.ui-widget-header .ui-priority-secondary {
	opacity: .7;
	filter:Alpha(Opacity=70);
	font-weight: normal;
}



.ui-priority-primary.ui-state-hover,
.ui-widget-content .ui-priority-primary.ui-state-hover,
.ui-widget-header .ui-priority-primary.ui-state-hover,
.ui-priority-secondary.ui-state-hover,
.ui-widget-content .ui-priority-secondary.ui-state-hover,
.ui-widget-header .ui-priority-secondary.ui-state-hover,
.ui-priority-primary:hover,
.ui-widget-content .ui-priority-primary:hover,
.ui-widget-header .ui-priority-primary:hover,
.ui-priority-secondary:hover,
.ui-widget-content .ui-priority-secondary:hover,
.ui-widget-header .ui-priority-secondary:hover {
	
	color:<?= INPUTS_BUTTONS_COLOR_SEC; ?>;
	
	text-shadow:<?= TEXT_SHADOW_DARK_HOVER; ?>;
	
	<?= INPUTS_BUTTONS_BACKGROUND_HOVER; ?>;
	
	<?= INPUTS_BUTTONS_BORDER_SEC; ?>;
	
}
.ui-datepicker-current:before,
.ui-datepicker-close:before{
	
	position: relative;
	display: inline-block;
	font-family: 'vecms-icons';
	speak: none;
	font-size: 16px;
	line-height: 16px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;

	/* Better Font Rendering =========== */
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	
	margin-right: 7px;
}
.ui-datepicker-current:before{
	content: "\e627";
}
.ui-datepicker-close:before{
	content: "\e033";
}
.ui-widget-content .ui-datepicker-current{
	
	opacity: 1;
	filter:Alpha(Opacity=100);
	
}
.ui-state-disabled,
.ui-widget-content .ui-state-disabled,
.ui-widget-header .ui-state-disabled {
	opacity: .35;
	filter:Alpha(Opacity=35);
	background-image: none;
}
.ui-state-disabled .ui-icon {
	filter:Alpha(Opacity=35); /* For IE8 - See #6059 */
}



/* Icons
----------------------------------*/

/* states and images */
.ui-icon {
	width: 16px;
	height: 16px;
}
.ui-icon,
.ui-widget-content .ui-icon {
	background-image: none;
}
.ui-widget-header .ui-icon {
	background-image: none;
}
.ui-icon:before,
.ui-widget-header .ui-icon:before {
	font-size: 16px;
}
.ui-state-default .ui-icon {
	
}
.ui-state-hover .ui-icon,
.ui-state-focus .ui-icon {
	
}
.ui-state-active .ui-icon {
	
}
.ui-state-highlight .ui-icon {
	
}
.ui-state-error .ui-icon,
.ui-state-error-text .ui-icon {
	
}

/* positioning */
.ui-icon-blank { background-position: 16px 16px; }
.ui-icon-carat-1-n { background-position: 0 0; }
.ui-icon-carat-1-ne { background-position: -16px 0; }
.ui-icon-carat-1-e { background-position: -32px 0; }
.ui-icon-carat-1-se { background-position: -48px 0; }
.ui-icon-carat-1-s { background-position: -64px 0; }
.ui-icon-carat-1-sw { background-position: -80px 0; }
.ui-icon-carat-1-w { background-position: -96px 0; }
.ui-icon-carat-1-nw { background-position: -112px 0; }
.ui-icon-carat-2-n-s { background-position: -128px 0; }
.ui-icon-carat-2-e-w { background-position: -144px 0; }
.ui-icon-triangle-1-n { background-position: 0 -16px; }
.ui-icon-triangle-1-ne { background-position: -16px -16px; }
.ui-icon-triangle-1-e { background-position: -32px -16px; }
.ui-icon-triangle-1-se { background-position: -48px -16px; }
.ui-icon-triangle-1-s { background-position: -64px -16px; }
.ui-icon-triangle-1-sw { background-position: -80px -16px; }
.ui-icon-triangle-1-w { background-position: -96px -16px; }
.ui-icon-triangle-1-nw { background-position: -112px -16px; }
.ui-icon-triangle-2-n-s { background-position: -128px -16px; }
.ui-icon-triangle-2-e-w { background-position: -144px -16px; }
.ui-icon-arrow-1-n { background-position: 0 -32px; }
.ui-icon-arrow-1-ne { background-position: -16px -32px; }
.ui-icon-arrow-1-e { background-position: -32px -32px; }
.ui-icon-arrow-1-se { background-position: -48px -32px; }
.ui-icon-arrow-1-s { background-position: -64px -32px; }
.ui-icon-arrow-1-sw { background-position: -80px -32px; }
.ui-icon-arrow-1-w { background-position: -96px -32px; }
.ui-icon-arrow-1-nw { background-position: -112px -32px; }
.ui-icon-arrow-2-n-s { background-position: -128px -32px; }
.ui-icon-arrow-2-ne-sw { background-position: -144px -32px; }
.ui-icon-arrow-2-e-w { background-position: -160px -32px; }
.ui-icon-arrow-2-se-nw { background-position: -176px -32px; }
.ui-icon-arrowstop-1-n { background-position: -192px -32px; }
.ui-icon-arrowstop-1-e { background-position: -208px -32px; }
.ui-icon-arrowstop-1-s { background-position: -224px -32px; }
.ui-icon-arrowstop-1-w { background-position: -240px -32px; }
.ui-icon-arrowthick-1-n { background-position: 0 -48px; }
.ui-icon-arrowthick-1-ne { background-position: -16px -48px; }
.ui-icon-arrowthick-1-e { background-position: -32px -48px; }
.ui-icon-arrowthick-1-se { background-position: -48px -48px; }
.ui-icon-arrowthick-1-s { background-position: -64px -48px; }
.ui-icon-arrowthick-1-sw { background-position: -80px -48px; }
.ui-icon-arrowthick-1-w { background-position: -96px -48px; }
.ui-icon-arrowthick-1-nw { background-position: -112px -48px; }
.ui-icon-arrowthick-2-n-s { background-position: -128px -48px; }
.ui-icon-arrowthick-2-ne-sw { background-position: -144px -48px; }
.ui-icon-arrowthick-2-e-w { background-position: -160px -48px; }
.ui-icon-arrowthick-2-se-nw { background-position: -176px -48px; }
.ui-icon-arrowthickstop-1-n { background-position: -192px -48px; }
.ui-icon-arrowthickstop-1-e { background-position: -208px -48px; }
.ui-icon-arrowthickstop-1-s { background-position: -224px -48px; }
.ui-icon-arrowthickstop-1-w { background-position: -240px -48px; }
.ui-icon-arrowreturnthick-1-w { background-position: 0 -64px; }
.ui-icon-arrowreturnthick-1-n { background-position: -16px -64px; }
.ui-icon-arrowreturnthick-1-e { background-position: -32px -64px; }
.ui-icon-arrowreturnthick-1-s { background-position: -48px -64px; }
.ui-icon-arrowreturn-1-w { background-position: -64px -64px; }
.ui-icon-arrowreturn-1-n { background-position: -80px -64px; }
.ui-icon-arrowreturn-1-e { background-position: -96px -64px; }
.ui-icon-arrowreturn-1-s { background-position: -112px -64px; }
.ui-icon-arrowrefresh-1-w { background-position: -128px -64px; }
.ui-icon-arrowrefresh-1-n { background-position: -144px -64px; }
.ui-icon-arrowrefresh-1-e { background-position: -160px -64px; }
.ui-icon-arrowrefresh-1-s { background-position: -176px -64px; }
.ui-icon-arrow-4 { background-position: 0 -80px; }
.ui-icon-arrow-4-diag { background-position: -16px -80px; }
.ui-icon-extlink { background-position: -32px -80px; }
.ui-icon-newwin { background-position: -48px -80px; }
.ui-icon-refresh { background-position: -64px -80px; }
.ui-icon-shuffle { background-position: -80px -80px; }
.ui-icon-transfer-e-w { background-position: -96px -80px; }
.ui-icon-transferthick-e-w { background-position: -112px -80px; }
.ui-icon-folder-collapsed { background-position: 0 -96px; }
.ui-icon-folder-open { background-position: -16px -96px; }
.ui-icon-document { background-position: -32px -96px; }
.ui-icon-document-b { background-position: -48px -96px; }
.ui-icon-note { background-position: -64px -96px; }
.ui-icon-mail-closed { background-position: -80px -96px; }
.ui-icon-mail-open { background-position: -96px -96px; }
.ui-icon-suitcase { background-position: -112px -96px; }
.ui-icon-comment { background-position: -128px -96px; }
.ui-icon-person { background-position: -144px -96px; }
.ui-icon-print { background-position: -160px -96px; }
.ui-icon-trash { background-position: -176px -96px; }
.ui-icon-locked { background-position: -192px -96px; }
.ui-icon-unlocked { background-position: -208px -96px; }
.ui-icon-bookmark { background-position: -224px -96px; }
.ui-icon-tag { background-position: -240px -96px; }
.ui-icon-home { background-position: 0 -112px; }
.ui-icon-flag { background-position: -16px -112px; }
.ui-icon-calendar { background-position: -32px -112px; }
.ui-icon-cart { background-position: -48px -112px; }
.ui-icon-pencil { background-position: -64px -112px; }
.ui-icon-clock { background-position: -80px -112px; }
.ui-icon-disk { background-position: -96px -112px; }
.ui-icon-calculator { background-position: -112px -112px; }
.ui-icon-zoomin { background-position: -128px -112px; }
.ui-icon-zoomout { background-position: -144px -112px; }
.ui-icon-search { background-position: -160px -112px; }
.ui-icon-wrench { background-position: -176px -112px; }
.ui-icon-gear { background-position: -192px -112px; }
.ui-icon-heart { background-position: -208px -112px; }
.ui-icon-star { background-position: -224px -112px; }
.ui-icon-link { background-position: -240px -112px; }
.ui-icon-cancel { background-position: 0 -128px; }
.ui-icon-plus { background-position: -16px -128px; }
.ui-icon-plusthick { background-position: -32px -128px; }
.ui-icon-minus { background-position: -48px -128px; }
.ui-icon-minusthick { background-position: -64px -128px; }
.ui-icon-close { background-position: -80px -128px; }
.ui-icon-closethick { background-position: -96px -128px; }
.ui-icon-key { background-position: -112px -128px; }
.ui-icon-lightbulb { background-position: -128px -128px; }
.ui-icon-scissors { background-position: -144px -128px; }
.ui-icon-clipboard { background-position: -160px -128px; }
.ui-icon-copy { background-position: -176px -128px; }
.ui-icon-contact { background-position: -192px -128px; }
.ui-icon-image { background-position: -208px -128px; }
.ui-icon-video { background-position: -224px -128px; }
.ui-icon-script { background-position: -240px -128px; }
.ui-icon-alert { background-position: 0 -144px; }
.ui-icon-info { background-position: -16px -144px; }
.ui-icon-notice { background-position: -32px -144px; }
.ui-icon-help { background-position: -48px -144px; }
.ui-icon-check { background-position: -64px -144px; }
.ui-icon-bullet { background-position: -80px -144px; }
.ui-icon-radio-on { background-position: -96px -144px; }
.ui-icon-radio-off { background-position: -112px -144px; }
.ui-icon-pin-w { background-position: -128px -144px; }
.ui-icon-pin-s { background-position: -144px -144px; }
.ui-icon-play { background-position: 0 -160px; }
.ui-icon-pause { background-position: -16px -160px; }
.ui-icon-seek-next { background-position: -32px -160px; }
.ui-icon-seek-prev { background-position: -48px -160px; }
.ui-icon-seek-end { background-position: -64px -160px; }
.ui-icon-seek-start { background-position: -80px -160px; }
/* ui-icon-seek-first is deprecated, use ui-icon-seek-start instead */
.ui-icon-seek-first { background-position: -80px -160px; }
.ui-icon-stop { background-position: -96px -160px; }
.ui-icon-eject { background-position: -112px -160px; }
.ui-icon-volume-off { background-position: -128px -160px; }
.ui-icon-volume-on { background-position: -144px -160px; }
.ui-icon-power { background-position: 0 -176px; }
.ui-icon-signal-diag { background-position: -16px -176px; }
.ui-icon-signal { background-position: -32px -176px; }
.ui-icon-battery-0 { background-position: -48px -176px; }
.ui-icon-battery-1 { background-position: -64px -176px; }
.ui-icon-battery-2 { background-position: -80px -176px; }
.ui-icon-battery-3 { background-position: -96px -176px; }
.ui-icon-circle-plus { background-position: 0 -192px; }
.ui-icon-circle-minus { background-position: -16px -192px; }
.ui-icon-circle-close { background-position: -32px -192px; }

/* right arrow */
.ui-icon-circle-triangle-e:before { 
	
	content: "\e604";
	
}
.ui-icon-circle-triangle-s { background-position: -64px -192px; }

/* left arrow */
.ui-icon-circle-triangle-w:before { 
	
	content: "\e603";
	
}
.ui-icon-circle-triangle-n { background-position: -96px -192px; }
.ui-icon-circle-arrow-e { background-position: -112px -192px; }
.ui-icon-circle-arrow-s { background-position: -128px -192px; }
.ui-icon-circle-arrow-w { background-position: -144px -192px; }
.ui-icon-circle-arrow-n { background-position: -160px -192px; }
.ui-icon-circle-zoomin { background-position: -176px -192px; }
.ui-icon-circle-zoomout { background-position: -192px -192px; }
.ui-icon-circle-check { background-position: -208px -192px; }
.ui-icon-circlesmall-plus { background-position: 0 -208px; }
.ui-icon-circlesmall-minus { background-position: -16px -208px; }
.ui-icon-circlesmall-close { background-position: -32px -208px; }
.ui-icon-squaresmall-plus { background-position: -48px -208px; }
.ui-icon-squaresmall-minus { background-position: -64px -208px; }
.ui-icon-squaresmall-close { background-position: -80px -208px; }
.ui-icon-grip-dotted-vertical { background-position: 0 -224px; }
.ui-icon-grip-dotted-horizontal { background-position: -16px -224px; }
.ui-icon-grip-solid-vertical { background-position: -32px -224px; }
.ui-icon-grip-solid-horizontal { background-position: -48px -224px; }
.ui-icon-gripsmall-diagonal-se { background-position: -64px -224px; }
.ui-icon-grip-diagonal-se { background-position: -80px -224px; }


/* Misc visuals
----------------------------------*/

/* Corner radius */
.ui-corner-all,
.ui-corner-top,
.ui-corner-left,
.ui-corner-tl {
	border-top-left-radius: <?= DEFAULT_BORDER_RADIUS_VALUE; ?>px;
}
.ui-corner-all,
.ui-corner-top,
.ui-corner-right,
.ui-corner-tr {
	border-top-right-radius: <?= DEFAULT_BORDER_RADIUS_VALUE; ?>px;
}
.ui-corner-all,
.ui-corner-bottom,
.ui-corner-left,
.ui-corner-bl {
	border-bottom-left-radius: <?= DEFAULT_BORDER_RADIUS_VALUE; ?>px;
}
.ui-corner-all,
.ui-corner-bottom,
.ui-corner-right,
.ui-corner-br {
	border-bottom-right-radius: <?= DEFAULT_BORDER_RADIUS_VALUE; ?>px;
}

/* Overlays */
.ui-widget-overlay {
	background: #666666 url(images/ui-bg_diagonals-thick_20_666666_40x40.png) 50% 50% repeat;
	opacity: .5;
	filter: Alpha(Opacity=50);
}
.ui-widget-shadow {
	margin: -5px 0 0 -5px;
	padding: 5px;
	background: #000000 url(images/ui-bg_flat_10_000000_40x100.png) 50% 50% repeat-x;
	opacity: .2;
	filter: Alpha(Opacity=20);
	
	<?= DEFAULT_BORDER_RADIUS; ?>;
	
}




/*!
 * jQuery UI Slider 1.10.3
 * http://jqueryui.com
 *
 * Copyright 2013 jQuery Foundation and other contributors
 * Released under the MIT license.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Slider#theming
 */
.ui-slider {
	position: relative;
	text-align: left;
}
.ui-slider .ui-slider-handle {
	position: absolute;
	z-index: 2;
	width: 1em;
	height: 1em;
	cursor: default;
	border: none;
	
	<?= BUTTONS_BACKGROUND_HOVER; ?>
	
}
.ui-slider .ui-slider-range {
	position: absolute;
	z-index: 1;
	font-size: .7em;
	display: block;
	border: 0;
	background-position: 0 0;
}

/* For IE8 - See #6727 */
.ui-slider.ui-state-disabled .ui-slider-handle,
.ui-slider.ui-state-disabled .ui-slider-range {
	filter: inherit;
}

.ui-slider-horizontal {
	
	<?= BOX_SHADOW_NONE; ?>
	
	<?= BUTTONS_BACKGROUND_HOVER; ?>
	
	background-position: center center;
	
	background-size: 100% 2px;
	
	background-repeat: no-repeat;
	
	background-color: transparent;
	
	height: 1em;
}
.ui-slider-horizontal .ui-slider-handle {
	
	<?= FULL_ROUNDED_CORNERS_STYLESHEET; ?>
	
	top: 50%;
	margin-left: -.5em;
	margin-top: -.5em;
	padding: 0;
}
.ui-slider-horizontal .ui-slider-range {
	top: 0;
	height: 100%;
}
.ui-slider-horizontal .ui-slider-range-min {
	left: 0;
}
.ui-slider-horizontal .ui-slider-range-max {
	right: 0;
}

.ui-slider-vertical {
	width: .8em;
	height: 100px;
}
.ui-slider-vertical .ui-slider-handle {
	left: -.3em;
	margin-left: 0;
	margin-bottom: -.6em;
}
.ui-slider-vertical .ui-slider-range {
	left: 0;
	width: 100%;
}
.ui-slider-vertical .ui-slider-range-min {
	bottom: 0;
}
.ui-slider-vertical .ui-slider-range-max {
	top: 0;
}


/*********************************** Ui **********************************/
/*************************************************************************/
/*************************************************************************/
