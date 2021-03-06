
jQuery.fn.preventDoubleSubmit = function() {
	/* ta dando pau na geração de pdf
	jQuery(this).submit(function() {
		if (this.beenSubmitted)
			return false;
		else
			this.beenSubmitted = true;
	});
	*/
};

// Create a jGrowl
window.createGrowl = function(gContent, persistent, title, type) {
	
	$('<div/>').qtip({
		content: {
			text: gContent
		},
		position: {
			target: [-400,0],
			my: 'top left',
			at: 'right center',
			container: $('#qtip-growl-container')
		},
		show: {
			event: false,
			ready: true,
			effect: function() {
				$(this).css({ opacity: 0 });
				$(this).stop(0, 1).animate({ height: 'toggle', opacity: 1 }, 400, 'swing');
			},
			delay: 0,
			persistent: persistent
		},
		hide: {
			event: false,
			effect: function(api) {
				$(this).stop(0, 1).animate({ height: 'toggle', opacity: 0 }, 400, 'swing');
			}
		},
		style: {
			width: 400,
			def: false,
			classes: 'notification qtip-vecms' + ( type ? ' ' + type : '' ),
			tip: false
		},
		events: {
			render: function(event, api) {
				if( ! api.options.show.persistent ) {
					
					$(this).bind('mouseover mouseout', function(e) {
						var lifespan = 5000;
						
						clearTimeout(api.timer);
						if (e.type !== 'mouseover') {
							api.timer = setTimeout(function() { api.hide(e); }, lifespan);
						}
					})
					.triggerHandler('mouseout');
					
				}
				api.set('content.title', title ? title : '&nbsp;' );
				api.set('content.button', true);
			}
		}
	});
};

function makeNewElementFromElement( tag, elem ) {

	var newElem = document.createElement(tag),
		i, prop,
		attr = elem.attributes,
		attrLen = attr.length;

	// Copy children 
	elem = elem.cloneNode(true);
	while (elem.firstChild) {
		newElem.appendChild(elem.firstChild);
	}

	// Copy DOM properties
	for (i in elem) {
		try {
			prop = elem[i];
			if (prop && i !== 'outerHTML' && (typeof prop === 'string' || typeof prop === 'number')) {
				newElem[i] = elem[i];
			}
		} catch(e) { /* some props throw getter errors */ }
	}

	// Copy attributes
	for (i = 0; i < attrLen; i++) {
		newElem.setAttribute(attr[i].nodeName, attr[i].nodeValue);
	}

	// Copy inline CSS
	newElem.style.cssText = elem.style.cssText;

	return newElem;
}

// implementando a função trim
if (!String.prototype.trim) {
	String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g, '');};
	
	String.prototype.ltrim=function(){return this.replace(/^\s+/,'');};
	
	String.prototype.rtrim=function(){return this.replace(/\s+$/,'');};
	
	String.prototype.fulltrim=function(){return this.replace(/(?:(?:^|\n)\s+|\s+(?:$|\n))/g,'').replace(/\s+/g,' ');};
}

function rand() {
	
	return Math.random().toString(36).substr(2); // remove `0.`
	
};

function token() {
	
	return rand() + rand(); // to make it longer
	
};

/*************************************************/
/******** Verificação de float em inputs *********/

function checkInputFloats( field ) {
	
	if ( field == undefined ){
		field = $('.input-float-filter');
	}
	
	field.each(function(index){
		
		var jthis = $(this);
		var num = jthis.val();
		
		if( ! (parseFloat(num) >= 0) ){
			jthis.addClass('field-error');
		}
		else{
			jthis.removeClass('field-error');
		}
		
	});
	
}

/******** Verificação de float em inputs *********/
/*************************************************/

/*************************************************/
/********* Ajusta margens do #site-block *********/

function adjust_fake_top_block() {
	
	$('#fake-top-block').css({
		'height' : $('#top-block').outerHeight()
	});
	
	$( '#qtip-growl-container' ).css({
		'top' : $('#top-block').outerHeight() + 10
	});
	
}

/********* Ajusta margens do #site-block *********/
/*************************************************/

/*************************************************/
/********* Move elementos para a toolbar *********/

function move_elements_to_toolbar() {
	
	if ( ! $( '#toolbar #toolbar-moved-elements' ).length > 0 ){
		
		if ( $( '#toolbar .clear:last' ).length == 1 ){
			
			$( '#toolbar .clear:last' ).before( '<div id="toolbar-moved-elements" class="fr" />' );
			
		}
		else{
			
			$( '#toolbar' ).append( '<div id="toolbar-moved-elements" class="fr" />' );
			
		}
		
	}
	
	if ( ! $( '#toolbar #toolbar-moved-elements-left' ).length > 0 ){
		
		$( '#toolbar .btn:last' ).after( '<div id="toolbar-moved-elements-left" />' );
		
	}
	
	if ( $( '.to-toolbar' ).length > 0 && $( '#toolbar #toolbar-moved-elements, #toolbar #toolbar-moved-elements-left' ).length > 0 ){
		
		$('.to-toolbar').each(function(){
			
			var jthis = $(this);
			var tagName, val;
			
			tagName = jthis.get(0).tagName;
			
			// se o elemento for uma div
			if ( tagName == 'DIV' ){
				
				if ( jthis.hasClass( 'toolbar-left' ) ){
					
					jthis.appendTo("#toolbar-moved-elements-left");
					
				}
				else{
					
					jthis.appendTo("#toolbar-moved-elements");
					
				}
				
				console.log( 'moved to toolbar: ' + tagName );
				
			}
			// se o elemento for um botão
			else if ( tagName == 'BUTTON' ){
				
				var form = false;
				
				if ( form = jthis.closest( 'form' ) ){
					
					if ( ! form.attr( 'id' ) ){
						
						var form_id = token();
						
						form.attr( 'id', form_id );
						
					}
					
					jthis.attr( 'form', form.attr( 'id' ) );
					
					if ( jthis.hasClass( 'toolbar-left' ) ){
						
						jthis.appendTo("#toolbar-moved-elements-left");
						
					}
					else{
						
						jthis.appendTo("#toolbar-moved-elements");
						
					}
					
				}
				
				console.log( 'moved to toolbar: ' + tagName );
				
			}
			// se o elemento for um botão
			else if ( tagName == 'A' ){
				
				var form = false;
				
				if ( form = jthis.closest( 'form' ) ){
					
					if ( ! form.attr( 'id' ) ){
						
						var form_id = token();
						
						form.attr( 'id', form_id );
						
					}
					
					jthis.attr( 'form', form.attr( 'id' ) );
					
					if ( jthis.hasClass( 'toolbar-left' ) ){
						
						jthis.appendTo("#toolbar-moved-elements-left");
						
					}
					else{
						
						jthis.appendTo("#toolbar-moved-elements");
						
					}
					
				}
				
				console.log( 'moved to toolbar: ' + tagName );
				
			}
			
		});
		
		if ( ! $( '#toolbar #clear-toolbar-end' ).length == 1 || ! $( '#toolbar .clear' ).length == 1 ){
			
			$( '#toolbar #toolbar-moved-elements' ).after( '<div class="clear" id="clear-toolbar-end" />' );
			
		}
		
	}
}

/********* Move elementos para a toolbar *********/
/*************************************************/

/*************************************************/
/** Adiciona classes ao body baseado na largura **/

function responsive_width() {
	
	if ( $( window ).outerWidth() < 500 ){
		
		$( 'body' ).removeClass( 'width-500-900-less' );
		$( 'body' ).addClass( 'width-0-500-less' );
		
	}
	else if ( $( window ).outerWidth() >= 500 && $( window ).outerWidth() < 900 ){
		
		$( 'body' ).removeClass( 'width-0-500-less' );
		$( 'body' ).addClass( 'width-500-900-less' );
		
	}
	
}

/** Adiciona classes ao body baseado na largura **/
/*************************************************/

$( document ).on( 'keyup keydown', function( e ){
	
	shifted = e.shiftKey;
	
	key = e.which;
	
	pressed_key = key;
	pressed_key += e.ctrlKey ? ' Ctrl' : '';
	pressed_key += e.shiftKey ? ' Shift' : '';
	pressed_key += e.altKey ? ' Alt' : '';
	pressed_key.trim();
	
	window.pressedKey = pressed_key;
	console.log('key code is: ' + pressed_key);
	
});

$( window ).on( 'resize', function(){
	
	adjust_fake_top_block();
	
	responsive_width();
	
});

$(document).bind('ready', function(){
	
	window.pressedKey = null;
	
	// checa se tinyMCE foi carregado
	is_tinyMCE_active = false;
	if (typeof(tinyMCE) != "undefined") {
		if (tinyMCE.activeEditor == null || tinyMCE.activeEditor.isHidden() != false) {
			is_tinyMCE_active = true;
		}
	}
	
	move_elements_to_toolbar();
	
	responsive_width();
	
	$(document).delegate('.js-editor', 'keydown', function(e) {
		
		var keyCode = e.keyCode || e.which;
	
		if (keyCode == 9) {
			e.preventDefault();
			var start = $(this).get(0).selectionStart;
			var end = $(this).get(0).selectionEnd;
	
			// set textarea value to: text before caret + tab + text after caret
			$(this).val($(this).val().substring(0, start)
				+ "\t"
				+ $(this).val().substring(end));
	
			// put caret at right position again
			$(this).get(0).selectionStart =
			$(this).get(0).selectionEnd = start + 1;
		}
		
	});
	
	msgContent = '';
	$('body').append('<div id="qtip-growl-container">');
	
	$('.msg').each(function(index) {
		
		var msgType = 'msg-type-normal';
		var msgTypesCount = 0;
		
		if ( $( '.msg-type-success' ).length > 0 ){
			
			msgTypesCount++;
			msgType = 'msg-type-success';
			
		}
		if ( $( '.msg-type-error' ).length > 0 ){
			
			msgTypesCount++;
			msgType = 'msg-type-error';
			
		}
		if ( $( '.msg-type-warning' ).length > 0 ){
			
			msgTypesCount++;
			msgType = 'msg-type-warning';
			
		}
		if ( $( '.msg-type-info' ).length > 0 && msgTypesCount == 0 ){
			
			msgType = 'msg-type-info';
			
		}
		
		if ( msgTypesCount > 1 ){
			
			msgType = 'msg-type-mix';
			
		}
		
		createGrowl( $( this ).html(), null, null, msgType );
		$(this).remove();
		
	});
	
	
	adjust_fake_top_block();
	
	
	$(".input-float-filter").on( 'keydown', function( event ) {
		
		// Allow: backspace, delete, tab, escape, and enter
		if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
		// Allow: Ctrl+A
		(event.keyCode == 65 && event.ctrlKey === true) || 
		// Allow: home, end, left, right
		(event.keyCode >= 35 && event.keyCode <= 39) ||
		// dot
		event.keyCode == 110) {
		// let it happen, don't do anything
			 return;
		}
		else {
		// Ensure that it is a number and stop the keypress
			if ( event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 ) ) {
				event.preventDefault(); 
			}
		}
		
	});
	
	$(".input-float-filter").on('keyup', function(event) {
		
		var jthis = $(this);
		var str = jthis.val();
		var pos = jthis.caret();
		
		str = str.replace(new RegExp(',', 'g'), '.');
		
		jthis.val(str);
		jthis[0].selectionStart = jthis[0].selectionEnd = pos;
		
	});
	
	$(".input-float-filter").on('blur', function(event) {
		
		var jthis = $(this);
		var str = jthis.val();
		
		checkInputFloats(jthis);
		
		str = str.replace(new RegExp(',', 'g'), '.');
		
		jthis.val(str);
	});
	
	$('#submit-apply').bind('click', function(event) {
		
		var jthis = $(this);
		
		if ( is_tinyMCE_active ){
			
			tinyMCE.triggerSave();
			
		}
		
		var form = null;
		
		if ( $(this).closest('form').length > 0 ) {
			
			form = $(this).closest('form');
			
		}
		else if ( jthis.attr( 'form' ) ) {
			
			form = $( '#' + jthis.attr( 'form' ) );
			
		}
		
		if ( form.hasClass('ajax') && ( ! form.attr('enctype') || ! form.attr('enctype') == 'multipart/form-data' ) ){
			
			var formData = form.serializeArray();
			formData.push({ name: this.name, value: this.value });
			
			createGrowl( 'Aguarde...', null, null, 'msg-type-info' );
			
			$.ajax( {
				type: "POST",
				url: form.attr( 'action' ) + '?ajax=submit_apply',
				data: formData,
				success: function( data ) {
					console.log( data );
					
					var object = $('<div/>').html(data).contents();
					
					data = object.html();
					createGrowl( data, null, null, 'msg-type-success' );
				},
				error: function( request, status, error ){
					
					console.log(request);
					//console.log( 'request.responseText', request.responseText );
					
					msg = '<div class="msg-item msg-type-error">';
					msg += '<div class="error">Error trying save form: <strong>' + request.status + ' ' + request.statusText + '</strong></div>';
					msg += '</div>';
					
					createGrowl( msg, null, null, 'msg-type-error' );
					
				}
			} );
			event.preventDefault();
			
		}
		
	});
	
	/*
	$( "textarea.js-editor" ).on('focus', function(e){
		
		var options = {
			
			width:			'100%',
			height:			500
			
		};
		
		var jseditor = $( this ).ckeditor();
	});
	*/
	
	
	//$('select.switch').switchify(/*{ on: '1', off: '0' }*/);
	
	
	
	/*************************************************/
	/*********** Live filter dos produtos ************/
	
	$( document ).on("keyup change", ".live-filter", function() {
		
		var value = $(this).val();
		
		var target_row = $(this).data('live-filter-for');
		
		$(target_row).each(function(index, r) {
			
			var $row = $(r);
			
			$row.data('founded', false);
			$row.find(".live-founded, .live-hidden, .live-visible").removeClass('live-founded live-hidden live-visible');
			$row.removeClass('live-founded live-hidden live-visible');
			
			$row.find(".filter-me").each(function(index, e) {
				
				var e = $(e);
				
				var text = '';
				
				var tagName;
				tagName = e.get(0).tagName;
				
				if ( tagName == 'TEXTAREA' || tagName == 'INPUT' ){
					var text = e.val();
				}
				else {
					var text = e.text();
				}
				
				if ( value != '' ){
					
					if ( text.toLowerCase().indexOf( value.toLowerCase() ) >= 0 ){
						
						$row.data('founded', true);
						
						e.closest('td').addClass('live-founded');
						
						e.closest('tr').removeClass('live-hidden');
						e.closest('tr').addClass('live-visible');
						
					}
					else if ( text.toLowerCase().indexOf( value.toLowerCase() ) === -1 && $row.data('founded') == false ){
						
						$row.removeClass('live-visible');
						$row.addClass('live-hidden');
						
					}
					
				}
				
			});
			
		});
		
	});
	
	/*********** Live filter dos produtos ************/
	/*************************************************/
	
	
	
	// previne a dupla submissão de formulários, quando submetidos via jquery
	// jQuery('form').preventDoubleSubmit();
	
});
