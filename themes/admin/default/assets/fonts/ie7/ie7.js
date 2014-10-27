/* To avoid CSS expressions while still supporting IE 7 and IE 6, use this script */
/* The script tag referring to this file must be placed before the ending body tag. */

/* Use conditional comments in order to target IE 7 and older:
	<!--[if lt IE 8]><!-->
	<script src="ie7/ie7.js"></script>
	<!--<![endif]-->
*/

(function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'vecms-icons\'">' + entity + '</span>' + html;
	}
	var icons = {
		'icon-download': '&#xe63e;',
		'icon-move-handle': '&#xe63d;',
		'icon-users_submits': '&#xe63c;',
		'icon-appearence': '&#xe63b;',
		'icon-look_and_feel': '&#xe63b;',
		'icon-phone': '&#xe63a;',
		'icon-plugins': '&#xe639;',
		'icon-more': '&#xe638;',
		'icon-google-plus': '&#xe637;',
		'icon-article-detail': '&#xe636;',
		'icon-disqus': '&#xe634;',
		'icon-admin': '&#xe635;',
		'icon-google': '&#xe633;',
		'icon-info': '&#xe632;',
		'icon-facebook': '&#xe631;',
		'icon-email': '&#xe630;',
		'icon-document-properties': '&#xe62f;',
		'icon-basic_details': '&#xe62f;',
		'icon-details': '&#xe62f;',
		'icon-submit-forms': '&#xe62e;',
		'icon-forms': '&#xe62e;',
		'icon-url': '&#xe62d;',
		'icon-sub-item': '&#xe62c;',
		'icon-preview_site': '&#xe62b;',
		'icon-web': '&#xe62b;',
		'icon-modules': '&#xe629;',
		'icon-ordering': '&#xe628;',
		'icon-clock': '&#xe627;',
		'icon-time': '&#xe627;',
		'icon-schedule': '&#xe627;',
		'icon-add-customer': '&#xe626;',
		'icon-add-provider': '&#xe625;',
		'icon-vesm': '&#xe624;',
		'icon-providers': '&#xe623;',
		'icon-truck': '&#xe622;',
		'icon-places': '&#xe621;',
		'icon-coord': '&#xe621;',
		'icon-map': '&#xe621;',
		'icon-pdf': '&#xe620;',
		'icon-customers': '&#xe61f;',
		'icon-cancel': '&#xe61e;',
		'icon-error': '&#xe61e;',
		'icon-clear': '&#xe61d;',
		'icon-products': '&#xe61c;',
		'icon-add-product': '&#xe61b;',
		'icon-add-company': '&#xe61a;',
		'icon-analyzer': '&#xe619;',
		'icon-profiler': '&#xe619;',
		'icon-logout': '&#xe618;',
		'icon-add-menu-item': '&#xe617;',
		'icon-menu-items': '&#xe616;',
		'icon-add-menu': '&#xe615;',
		'icon-key': '&#xe614;',
		'icon-login': '&#xe614;',
		'icon-security': '&#xe614;',
		'icon-vecms': '&#xe613;',
		'icon-fire': '&#xe613;',
		'icon-add-category': '&#xe612;',
		'icon-add-article': '&#xe600;',
		'icon-add-user': '&#xe601;',
		'icon-arrow-down': '&#xe602;',
		'icon-down': '&#xe602;',
		'icon-arrow-left': '&#xe603;',
		'icon-back': '&#xe603;',
		'icon-arrow-right': '&#xe604;',
		'icon-forward': '&#xe604;',
		'icon-arrow-up': '&#xe605;',
		'icon-up': '&#xe605;',
		'icon-articles': '&#xe606;',
		'icon-categories': '&#xe607;',
		'icon-companies': '&#xe608;',
		'icon-contacts': '&#xe609;',
		'icon-decrease': '&#xe60a;',
		'icon-pencil': '&#xe60b;',
		'icon-write': '&#xe60b;',
		'icon-edit': '&#xe60b;',
		'icon-increase': '&#xe60c;',
		'icon-add': '&#xe60c;',
		'icon-menus': '&#xe60d;',
		'icon-preferences': '&#xe60e;',
		'icon-remove': '&#xe60f;',
		'icon-trash': '&#xe60f;',
		'icon-user': '&#xe610;',
		'icon-users': '&#xe611;',
		'icon-pastetext': '&#xe035;',
		'icon-uniE033': '&#xe033;',
		'icon-ok': '&#xe033;',
		'icon-apply': '&#xe033;',
		'icon-save': '&#xe000;',
		'icon-newdocument': '&#xe001;',
		'icon-fullpage': '&#xe002;',
		'icon-config': '&#xe002;',
		'icon-alignleft': '&#xe003;',
		'icon-aligncenter': '&#xe004;',
		'icon-alignright': '&#xe005;',
		'icon-alignjustify': '&#xe006;',
		'icon-cut': '&#xe007;',
		'icon-paste': '&#xe008;',
		'icon-searchreplace': '&#xe009;',
		'icon-search': '&#xe009;',
		'icon-find': '&#xe009;',
		'icon-bullist': '&#xe00a;',
		'icon-numlist': '&#xe00b;',
		'icon-indent': '&#xe00c;',
		'icon-outdent': '&#xe00d;',
		'icon-blockquote': '&#xe00e;',
		'icon-undo': '&#xe00f;',
		'icon-redo': '&#xe010;',
		'icon-link': '&#xe011;',
		'icon-unlink': '&#xe012;',
		'icon-anchor': '&#xe013;',
		'icon-image': '&#xe014;',
		'icon-media': '&#xe015;',
		'icon-help': '&#xe016;',
		'icon-code': '&#xe017;',
		'icon-inserttime': '&#xe018;',
		'icon-preview': '&#xe019;',
		'icon-view': '&#xe019;',
		'icon-forecolor': '&#xe01a;',
		'icon-table': '&#xe01b;',
		'icon-hr': '&#xe01c;',
		'icon-removeformat': '&#xe01d;',
		'icon-sub': '&#xe01e;',
		'icon-sup': '&#xe01f;',
		'icon-charmap': '&#xe020;',
		'icon-emoticons': '&#xe021;',
		'icon-print': '&#xe022;',
		'icon-fullscreen': '&#xe023;',
		'icon-spellchecker': '&#xe024;',
		'icon-nonbreaking': '&#xe025;',
		'icon-template': '&#xe026;',
		'icon-pagebreak': '&#xe027;',
		'icon-restoredraft': '&#xe028;',
		'icon-uniE029': '&#xe029;',
		'icon-bold0': '&#xe02a;',
		'icon-italic': '&#xe02b;',
		'icon-underline': '&#xe02c;',
		'icon-strikethrough': '&#xe02d;',
		'icon-visualchars': '&#xe02e;',
		'icon-ltr': '&#xe02f;',
		'icon-rtl': '&#xe030;',
		'icon-copy': '&#xe031;',
		'icon-resize': '&#xe032;',
		'icon-uniE034': '&#xe034;',
		'icon-contact_forms': '&#xe62a;',
		'0': 0
		},
		els = document.getElementsByTagName('*'),
		i, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
}());
