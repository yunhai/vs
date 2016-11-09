/* jQuery Alert Dialogs Plugin

 Version 1.1

 Cory S.N. LaViska
 29 December 2008
 Modified author: tongnguyen
 Modified Start Date: 28/04/2009
 Modified Finish Date: 28/04/2009

 Usage:
		jAlert( message, [title, callback] )
		jConfirm( message, [title, callback] )
		jPrompt( message, [value, title, callback] )
 
 History:

		1.00 - Released (29 December 2008)

 License:
 
 This plugin is dual-licensed under the GNU General Public License and the MIT License and
 is copyright 2008 A Beautiful Site, LLC. 
*/

(function($) {
	
	$.alerts = {
		
		// These properties can be read/written by accessing $.alerts.propertyName from your scripts at any time
		
		verticalOffset: -75,                // vertical offset of the dialog from center screen, in pixels
		horizontalOffset: 0,                // horizontal offset of the dialog from center screen, in pixels/
		repositionOnResize: true,           // re-centers the dialog on window resize
		overlayOpacity: .01,                // transparency level of overlay
		overlayColor: '#FFF',               // base color of overlay
		draggable: true,                    // make the dialogs draggable (requires UI Draggables plugin)
		okButton: '&nbsp;OK&nbsp;',         // text for the OK button
		cancelButton: '&nbsp;Cancel&nbsp;', // text for the Cancel button
		dialogClass: null,                  // if specified, this class will be applied to all dialogs
		
		// Public methods
		
		alert: function(message, title, callback) {
			if( title == null ) title = 'Alert';
			$.alerts._show(title, message, null, 'alert', function(result) {
				if( callback ) callback(result);
			});
		},
		
		confirm: function(message, title, callback) {
			if( title == null ) title = 'Confirm';
			$.alerts._show(title, message, null, 'confirm', function(result) {
				if( callback ) callback(result);
			});
		},
			
		prompt: function(message, value, title, callback) {
			if( title == null ) title = 'Prompt';
			$.alerts._show(title, message, value, 'prompt', function(result) {
				if( callback ) callback(result);
			});
		},
		
		// Private methods
		
		_show: function(title, msg, value, type, callback) {
			
			$.alerts._hide();
			$.alerts._overlay('show');
			$("BODY").append(
			  '<div id="popup_container" style="overflow: hidden; display: block; position: fixed; z-index: 1021; outline-color: -moz-use-text-color; outline-style: none; outline-width: 0px; height: auto; width: 300px; top: 320px; left: 350.5px;" class="ui-dialog ui-widget ui-widget-content ui-corner-all" tabindex="-1">' +
			  	'<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" unselectable="on" style="-moz-user-select: none;">'+
      '<span id="ui-dialog-title-dialog" class="ui-dialog-title" unselectable="on" style="-moz-user-select: none;">'+'</span></div>'+
			    '<div id="popup_content">' +
			      '<div id="popup_message" class="ui-dialog-content ui-widget-content"></div>' +
				'</div>' +
			  '</div>');
			
			if( $.alerts.dialogClass ) $("#popup_container").addClass($.alerts.dialogClass);
			
			// IE6 Fix
			var pos = ($.browser.msie && parseInt($.browser.version) <= 6 ) ? 'absolute' : 'fixed'; 
			
			$("#popup_container").css({
				zIndex: 9999,
				width:350,
				position: pos
			});
			$("#ui-dialog-title-dialog").text(title);
			$('.ui-dialog-titlebar-close').attr('role', 'button')
			.hover(
				function() {
					$(this).addClass('ui-state-hover');
				},
				function() {
					$(this).removeClass('ui-state-hover');
				})
			.click( function() {
					$.alerts._hide();
					if( callback ) callback(false);
				});
			$("#popup_content").addClass(type);
			$("#popup_message").text(msg)
			.css({padding:'5px 10px'});
			$("#popup_message").html( $("#popup_message").text().replace(/\n/g, '<br />') );
			
			$("#popup_container").css({
				minWidth: $("#popup_container").outerWidth(),
				maxWidth: $("#popup_container").outerWidth()
			});
			
			$.alerts._reposition();
			$.alerts._maintainPosition(true);
			
			switch( type ) {
				case 'alert':
					$("#popup_message").after('<div id="popup_panel" class="ui-dialog-buttonpane ui-helper-clearfix"><button type="button"  id="popup_ok" class="ui-state-default ui-corner-all ui-state-focus">'+$.alerts.okButton+'</button></div>');
					$("#popup_ok").click( function() {
						$.alerts._hide();
						callback(true);
					});
					$("#popup_ok").focus().keypress( function(e) {
						if( e.keyCode == 13 || e.keyCode == 27 ) $("#popup_ok").trigger('click');
					});
				break;
				case 'confirm':
					$("#popup_message").after('<div id="popup_panel" class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix"><button type="button" id="popup_cancel" class="ui-state-default ui-corner-all ui-state-focus" >' + $.alerts.cancelButton + '</button><button type="button"  id="popup_ok" class="ui-state-default ui-corner-all ui-state-focus">'+$.alerts.okButton+'</button></div> ');
					$("#popup_ok").click( function() {
						$.alerts._hide();
						if( callback ) callback(true);
					});
					$("#popup_cancel").click( function() {
						$.alerts._hide();
						if( callback ) callback(false);
					});
					$("#popup_ok").focus();
					$("#popup_ok, #popup_cancel").keypress( function(e) {
						if( e.keyCode == 13 ) $("#popup_ok").trigger('click');
						if( e.keyCode == 27 ) $("#popup_cancel").trigger('click');
					});
				break;
				case 'prompt':
					$("#popup_message").append('<br /><input type="text" size="30" id="popup_prompt" />').after('<div id="popup_panel" class="ui-dialog-buttonpanel ui-helper-clearfix"><button type="button"  id="popup_ok" class="ui-state-default ui-corner-all ui-state-focus">'+$.alerts.okButton+'</button> <button type="button" id="popup_cancel" class="ui-state-default ui-corner-all ui-state-focus" >' + $.alerts.cancelButton + '</button</div>');
					$("#popup_prompt").width( $("#popup_message").width() );
					$("#popup_ok").click( function() {
						var val = $("#popup_prompt").val();
						$.alerts._hide();
						if( callback ) callback( val );
					});
					$("#popup_cancel").click( function() {
						$.alerts._hide();
						if( callback ) callback( null );
					});
					$("#popup_prompt, #popup_ok, #popup_cancel").keypress( function(e) {
						if( e.keyCode == 13 ) $("#popup_ok").trigger('click');
						if( e.keyCode == 27 ) $("#popup_cancel").trigger('click');
					});
					if( value ) $("#popup_prompt").val(value);
					$("#popup_prompt").focus().select();
				break;
			}
			
			// Make draggable
			if( $.alerts.draggable ) {
				try {
					$("#popup_container").draggable({ handle: $(".ui-dialog-titlebars")});
					$(".ui-dialog-titlebars").css({ cursor: 'move' });
				} catch(e) { /* requires jQuery UI draggables */ }
			}
		},
		
		_hide: function() {
			$("#popup_container").remove();
			$.alerts._overlay('hide');
			$.alerts._maintainPosition(false);
		},
		
		_overlay: function(status) {
			switch( status ) {
				case 'show':
					$.alerts._overlay('hide');
					$("BODY").append('<div id="popup_overlay" class="ui-widget-overlay"></div>');
					$("#popup_overlay").css({
						position: 'absolute',
						zIndex: 1001,
						top: '0px',
						left: '0px',
						width: '100%',
						height: $(document).height()
					});
				break;
				case 'hide':
					$("#popup_overlay").remove();
				break;
			}
		},
		_xDef: function () {
			  for(var i=0; i<arguments.length; ++i){if(typeof(arguments[i])=="" || typeof(arguments[i])=="undefined") return false;}
			  return true;
		},
		
		_xScrollTop:function () {
			  var offset=0;
			  if($.alerts._xDef(window.pageYOffset)) offset=window.pageYOffset;
			  else if(document.documentElement && document.documentElement.scrollTop) offset=document.documentElement.scrollTop;
			  else if(document.body && $.alerts._xDef(document.body.scrollTop)) offset=document.body.scrollTop;
			  return offset;
		},
		
		_reposition: function() {
			var top = (($(window).height() / 2) - ($("#popup_container").outerHeight() / 2)) + $.alerts.verticalOffset;
			var left = (($(window).width() / 2) - ($("#popup_container").outerWidth() / 2)) + $.alerts.horizontalOffset;
			if( top < 0 ) top = 0;
			if( left < 0 ) left = 0;
			
			// IE6 fix
//			if( $.browser.msie && parseInt($.browser.version) <= 6 ) top = top + $(window).scrollTop();
			
			$("#popup_container").css({
				top: top + 'px',
				left: left + 'px'
			});
			$("#popup_overlay").height( $(document).height() );
		},
		
		_maintainPosition: function(status) {
			if( $.alerts.repositionOnResize ) {
				switch(status) {
					case true:
						$(window).bind('resize', function() {
							$.alerts._reposition();
						});
					break;
					case false:
						$(window).unbind('resize');
					break;
				}
			}
		}
		
	}
	
	// Shortuct functions
	jAlert = function(message, title, callback) {
		$.alerts.alert(message, title, callback);
	}
	
	jConfirm = function(message, title, callback) {
		$.alerts.confirm(message, title, callback);
	};
		
	jPrompt = function(message, value, title, callback) {
		$.alerts.prompt(message, value, title, callback);
	};
	
})(jQuery);