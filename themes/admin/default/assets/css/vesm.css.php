
/*
 **************************************************************************************************
 **************************************************************************************************
 --------------------------------------------------------------------------------------------------
 VESM
 --------------------------------------------------------------------------------------------------
 */

#tenders-list .tender-status{
	
	width: 150px;
	
}

#customer-information-wrapper{
	
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	
	padding: <?= DEFAULT_SPACING * 2; ?>px;
	margin: 0;
	
	max-width: 20%;
	
}
#customer-fields-ajax{
	
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	
	margin: 0;
	padding: 0;
	
	max-width: 79%;
	
}
#customer-fields-ajax .info-items{
	
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	
	border-left: <?= TAB_ITEM_BORDER_SEC; ?>;
	<?= css_display_inline_block(); ?>;
	margin: 0;
	padding: <?= DEFAULT_SPACING * 2; ?>px;
	
}
#customer-information-wrapper .info-title,
#customer-information-wrapper .info-item{
	max-width: 218px;
}
#tender #customer-fields-ajax .customer-contacts input[type=radio]{
	margin-top: 10px;
}

#contacts-wrapper,
#addresses-wrapper,
#phones-wrapper{
	position:relative;
}
#contacts-preloader,
#addresses-preloader,
#phones-preloader{
	position:absolute;
	width: 100%;
	height: 100%;
	background: url('<?= THEME_IMAGE_DIR_URL; ?>/horizontal-preloader.gif') no-repeat center center;
	opacity:0;
	z-index: 1;
}
#customer-logo-thumb,
#contact-photo-thumb{
	position:relative;
	<?= css_display_inline_block(); ?>;
	-webkit-border-radius: 50%;
	border-radius: 50%;
	width: 40px;
	height: 40px;
	margin-right:10px;
}
#customer-logo-thumb img,
#contact-photo-thumb img{
	position:relative;
	<?= css_display_inline_block(); ?>;
	-webkit-border-radius: 50%;
	border-radius: 50%;
	display: block;
	width: 100%;
	height: 100%;
}
#customers-elements,
#contacts-elements,
#addresses-elements,
#phones-elements{
	position:relative;
	z-index: 2;
}
#customer-logo-preloader,
#contact-photo-preloader{
	position:absolute;
	width: 100%;
	height: 100%;
	background: url('<?= THEME_IMAGE_DIR_URL; ?>/preloader-image-20.gif') no-repeat center center;
	opacity:0;
}
#customer-logo-thumb .logo-thumb,
#contact-photo-thumb .photo-thumb{
	position:absolute;
	width: 100%;
	height: 100%;
	background: url('<?= THEME_IMAGE_DIR_URL; ?>/icon-36-no-photo.png') no-repeat center center;
}

.vesm-tender-information-item{
	position:relative;
	display:block;
}
#address-postal-code,
#address-city,
#address-state-acronym{
	<?= css_display_inline_block(); ?>;
}

.tender-information{
	position:relative;
	display:block;
	margin-bottom:<?= DEFAULT_SPACING; ?>px;
}
.tender-information-code,
.tender-information-creation-datetime{
	position:relative;
	<?= css_display_inline_block(); ?>;
	padding:5px <?= DEFAULT_SPACING; ?>px 7px;
	background:rgba(255, 255, 255, 0.5);
	
	<?= DEFAULT_BORDER_RADIUS; ?>
	
	border-top: 2px solid #fff;
	border-bottom: 1px solid rgba(0,0,0,0.1);
	box-shadow: 0 5px 10px rgba(37, 108, 163, 0.2);
}
.tender-information-creation-date,
.tender-information-creation-time,
.tender-information-code-code{
	font-weight: bold;
}

table.products,
table.prov-conds{
	margin-bottom: 0;
}
table.products tr{
	border-bottom:none;
}
table.products th,
table.products td{
	
	vertical-align: middle;
	text-align: center;
	
}
table.products th > *:last-child,
table.products td > *:last-child{
	
	margin-bottom: 0;
	
}
table.products td{
	padding:0;
}
table.products.even td{
	border-bottom:none;
}


.editable-text{
	
	position: relative;
	display: block;
	color: inherit;
	padding: 5px;
	
}
.editable-text:hover{
	
	color: inherit;
	background: <?= $vui->colors->vui_base->rgba_s( 20 ); ?>;
	
}

table.products .row-expander{
	cursor: pointer;
}
table.products td.row-expander{
	padding:0;
}
table.products .row-expander:hover{
	
	background: #fff;
	box-shadow: <?= HIGHLIGHT_BOX_SHADOW; ?>;
	z-index: 2;
	
}
table.products.row-expanded tr td,
table.products tr.selected-row td{
	
	background: <?= $vui->colors->vui_lighter->hex_s; ?>;
	border:none;
	
}
table.products tr.not-focused-row{
	opacity: 0.2;
	background: none;
}
table.products tr.not-focused-row:hover{
	opacity: 1;
}
table.products tr.not-focused-row td{
	background: none;
}
table.products tr.secondary-fields td{
	text-align: left;
}
table.products tr.secondary-fields .vui-field-wrapper-inline{
	padding: 0	<?= DEFAULT_SPACING/2; ?>px <?= DEFAULT_SPACING/2; ?>px;
}
table.products td.product-title .editable-text{
	text-align: left;
}
table th.row-expander,
table td.row-expander,
table th.product-selling-price,
table td.product-selling-price,
table th.product-selling-price-per-unit,
table td.product-selling-price-per-unit,
table th.product-total,
table td.product-total,
table th.product-quantity,
table td.product-quantity,
table th.product-key,
table td.product-key,
table th.product-warranty,
table td.product-warranty,
table th.product-provider,
table td.product-provider,
table th.prov-cond-title,
table td.prov-cond-title,
table th.corporate-tax-register,
table td.corporate-tax-register,
table th.prov-cond-freight-type,
table td.prov-cond-freight-type,
table th.prov-conds-payment-conditions,
table td.prov-conds-payment-conditions,
table th.prov-conds-delivery-time,
table td.prov-conds-delivery-time,
table th.prov-conds-tender-validity,
table td.prov-conds-tender-validity
th.product-code,
td.product-code{
	white-space: nowrap;
	width: 1px;
	text-align: center;
}
table.products.row-expanded td{
	
	cursor: pointer;
	border: none;
	
}
table.products.row-expanded tr.product-row{
	
	cursor: pointer;
	border: none;
	border-top: 3px solid <?= $vui->colors->vui_base->hex_s; ?>;
	
}
table.products.row-expanded tr.secondary-fields{
	
	border-bottom: 3px solid <?= $vui->colors->vui_base->hex_s; ?>;
	
}
table.products tr.product-row.selected-row{
	
	border-top: 3px solid <?= $vui->colors->vui_base->hex_s; ?>;
	
}
table.products tr.secondary-fields.selected-row{
	
	border-bottom: 3px solid <?= $vui->colors->vui_base->hex_s; ?>;
	
}
table th.prov-conds-notes,
table td.prov-conds-notes{
	text-align: center;
}
table.products td.product-cost-price{
	
}
table.products.value{
	
	font-weight: bold;
	
}
table.products .product-selling-price-per-unit.value,
table.products .product-selling-price-total.value{
	font-size: 110%;
	padding: 0 <?= DEFAULT_SPACING/2; ?>px
}


input[type=text].prov-cond-freight-type{
	width:50px;
}
select.prov-cond-freight-type{
	width: auto;
}
select.prov-conds-payment-conditions{
	width:50px;
}
input[type=text].prov-conds-payment-conditions{
	
	width: 265px;
	
}
input[type=text].prov-conds-delivery-time,
select.prov-conds-delivery-time{
	width:80px;
}
input[type=text].prov-conds-tender-validity,
select.prov-conds-tender-validity{
	width:80px;
}
input[type=text].prov-conds-notes,
select.prov-conds-notes{
	
	width: 300px;
	
}


textarea.product-title{
	width:90%;
	min-height:100px;
}
input[type=text].product-code{
	width:120px;
}
input[type=text].product-unit{
	width: 70px;
}
input[type=text].product-warranty,
select.product-warranty{
	width:74px;
}
select.product-provider-id{
	width:100px;
}
input[type=text].product-code-on-provider{
	width:100px;
}
input[type=text].product-delivery-time{
	width: 130px;
}
input[type=text].product-cost-price{
	width: 70px;
}
input[type=text].product-provider-tax{
	width: 80px;
}
input[type=text].product-mcn{
	width:100px;
}
input[type=text].company-tax{
	width:90px;
}
input[type=text].product-tax-other{
	width: 80px;
}
input[type=text].product-profit-factor{
	width: 60px;
}
input[type=text].product-quantity,
input[type=number].product-quantity{
	text-align:center;
	width: 60px;
}
select.product-origin-state{
	width: 100px;
}
input[type=text].product-tax{
	width: 70px;
}
input[type=text].product-external-url{
	width: 150px;
}


select.customers-category,
select.customers-category-id{
	min-width:1px;
	width:150px;
}
select.customer{
	min-width:1px;
	width:150px;
}
select.contacts{
	min-width:1px;
	width:150px;
}
select.phones-combobox{
	min-width:1px;
	width:128px;
}
select.emails-combobox{
	min-width:1px;
	width:238px;
}
select.addresses-combobox{
	min-width:1px;
	width:150px;
}

table.products-totals .value{
	font-size: 110%;
}
table.products-totals tr:hover td{
	
	background: rgba(255, 255, 255, .5);
	
}
table.products-totals td{
	padding:<?= DEFAULT_SPACING; ?>px;
	text-align: right;
	white-space: nowrap;
	width: 100%;
	border-top: none;
}
table.products-totals td.product-cost-price-total{
	
}

table.products a.product-order-btn {
	padding:0 5px;
	display: inline-block;
	margin-top:-2px;
}

tr.tender-status-1 td.status select,
tr.tender-status-1 td.status select:hover{
	
	color: <?= $vui->colors->vui_yellow->get_ro_color()->hex_s; ?>;
	<?= $vui->colors->vui_yellow->getCssGradient( 5, 'btt', FALSE, 'url("' . $vui->svg_file( 'icon-select', $vui->colors->vui_yellow->get_ro_color()->hex_s ) . '"), ' ); ?>;
	border-bottom-color: #<?= $vui->colors->vui_yellow->darken( 25 ); ?>;
	
}

tr.tender-status-2 td.status select,
tr.tender-status-2 td.status select:hover,
tr.tender-status-8 td.status select,
tr.tender-status-8 td.status select:hover{
	
	color: <?= $vui->colors->vui_green->get_ro_color()->hex_s; ?>;
	<?= $vui->colors->vui_green->getCssGradient( 5, 'btt', FALSE, 'url("' . $vui->svg_file( 'icon-select', $vui->colors->vui_green->get_ro_color()->hex_s ) . '"), ' ); ?>;
	border-bottom-color: #<?= $vui->colors->vui_green->darken( 20 ); ?>;
	
}

tr.tender-status-3 td.status select,
tr.tender-status-3 td.status select:hover{
	
	color: <?= $vui->colors->vui_green->darken( 25, TRUE )->get_ro_color()->hex_s; ?>;
	<?= $vui->colors->vui_green->darken( 25, TRUE )->getCssGradient( 5, 'btt', FALSE, 'url("' . $vui->svg_file( 'icon-select', $vui->colors->vui_green->darken( 25, TRUE )->get_ro_color()->hex_s ) . '"), ' ); ?>;
	border-bottom-color: #<?= $vui->colors->vui_green->darken( 25, TRUE )->darken( 20 ); ?>;
	
}

tr.tender-status-4 td.status select,
tr.tender-status-4 td.status select:hover{
	
	color: <?= $vui->colors->vui_blue->darken( 25, TRUE )->get_ro_color()->hex_s; ?>;
	<?= $vui->colors->vui_blue->darken( 25, TRUE )->getCssGradient( 5, 'btt', FALSE, 'url("' . $vui->svg_file( 'icon-select', $vui->colors->vui_blue->darken( 25, TRUE )->get_ro_color()->hex_s ) . '"), ' ); ?>;
	border-bottom-color: #<?= $vui->colors->vui_blue->darken( 25, TRUE )->darken( 20 ); ?>;
	
}

tr.tender-status-5 td.status select,
tr.tender-status-5 td.status select:hover{
	
	color: <?= $vui->colors->vui_blue->get_ro_color()->hex_s; ?>;
	<?= $vui->colors->vui_blue->getCssGradient( 5, 'btt', FALSE, 'url("' . $vui->svg_file( 'icon-select', $vui->colors->vui_blue->get_ro_color()->hex_s ) . '"), ' ); ?>;
	border-bottom-color: #<?= $vui->colors->vui_blue->darken( 20 ); ?>;
	
}

tr.tender-status-6 td.status select,
tr.tender-status-6 td.status select:hover{
	
	color: <?= $vui->colors->vui_green->darken( 12.5, TRUE )->get_ro_color()->hex_s; ?>;
	<?= $vui->colors->vui_green->darken( 12.5, TRUE )->getCssGradient( 5, 'btt', FALSE, 'url("' . $vui->svg_file( 'icon-select', $vui->colors->vui_green->darken( 12.5, TRUE )->get_ro_color()->hex_s ) . '"), ' ); ?>;
	border-bottom-color: #<?= $vui->colors->vui_green->darken( 12.5, TRUE )->darken( 20 ); ?>;
	
}

tr.tender-status-7 td.status select,
tr.tender-status-7 td.status select:hover{
	
	color: <?= $vui->colors->vui_purple->darken( 25, TRUE )->get_ro_color()->hex_s; ?>;
	<?= $vui->colors->vui_purple->darken( 25, TRUE )->getCssGradient( 5, 'btt', FALSE, 'url("' . $vui->svg_file( 'icon-select', $vui->colors->vui_purple->darken( 25, TRUE )->get_ro_color()->hex_s ) . '"), ' ); ?>;
	border-bottom-color: #<?= $vui->colors->vui_purple->darken( 25, TRUE )->darken( 20 ); ?>;
	
}

tr.tender-status-8{
	
	opacity: .3;
	
}

tr.tender-status-9 td.status select,
tr.tender-status-9 td.status select:hover{
	
	color: <?= $vui->colors->vui_purple->get_ro_color()->hex_s; ?>;
	<?= $vui->colors->vui_purple->getCssGradient( 5, 'btt', FALSE, 'url("' . $vui->svg_file( 'icon-select', $vui->colors->vui_purple->get_ro_color()->hex_s ) . '"), ' ); ?>;
	border-bottom-color: #<?= $vui->colors->vui_purple->darken( 20 ); ?>;
	
}

tr.tender-status-10 td.status select,
tr.tender-status-10 td.status select:hover{
	
	color: <?= $vui->colors->vui_red->get_ro_color()->hex_s; ?>;
	<?= $vui->colors->vui_red->getCssGradient( 5, 'btt', FALSE, 'url("' . $vui->svg_file( 'icon-select', $vui->colors->vui_red->get_ro_color()->hex_s) . '"), ' ); ?>;
	border-bottom-color: #<?= $vui->colors->vui_red->darken( 20 ); ?>;
	
}

tr.tender-status-11{
	
	opacity: .3;
	
}

/*
 --------------------------------------------------------------------------------------------------
 VESM
 --------------------------------------------------------------------------------------------------
 **************************************************************************************************
 **************************************************************************************************
 */
