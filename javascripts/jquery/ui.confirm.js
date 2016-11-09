/*	
 *	=======================================================
 *	jQuery Confirm Dialogs Plugin
 *	@Version	:	1.0
 *	@Author		:	Renorld Nguyen
 *	Start Date	:	09/09/2009
 *	Finish Date	:	
 *	@License	:	This plugin is not General Public License.
 *	Depends		:	ui.core.js | ui.draggable.js | ui.resizable.js | ui.dialog.js
 *	=======================================================
 */
jQuery.confirm = {
	build : function(user_options){
		var user_options;
		// Setup default params
		var defaults = {
			uiConfirm			:		"vsf-confirm-delete",
			uiConfirmDialog		:		"vsf-dialog",
			confirm_dialog_msg	:		"These items will be permanently deleted and cannot be recovered. Are you sure?",
			confirm_delete_title :		"Confirm Delete",
			// Setup ui.dialog
			confirm_dialog_bgiframe	:	true,
			confirm_dialog_draggable:	true,
//			confirm_dialog_autoOpen	:	false,
			confirm_dialog_modal	:	true
		};
		return jQuery(this).each(
			function(){
				var options = jQuery.extend(defaults, user_options);
				var confirm_dialog_act	=	jQuery(this).attr('href');
			
			// Append html content elements
			/*$('body').append("<div class='"+options.uiConfirmDialog+"' title='"+options.confirm_delete_title+"'></div>");
			$('.vsf-dialog').html("<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>");
			$('.vsf-dialog').html("<p>"+options.confirm_dialog_msg+"</p>")*/
			
				// OK, create action onclick
				jQuery(this).click(function(){
					prev_dialog();
					return false;
				});
/*				.mousedown(function(){
					$(this).addClass("ui-state-active"); 
				})
				.mouseup(function(){
					$(this).removeClass("ui-state-active");
				})*/
			
			// Generate Confirm Dialog
			function prev_dialog(){
				// Begin of Append html content elements
				$('body').append(
					'<div class="'+options.uiConfirmDialog+' ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable" style="overflow: hidden; position: absolute; z-index: 99; outline-color: -moz-use-text-color; outline-style: none; outline-width: 0px; height: auto; width: 300px; top: 329px; left: 487px;" tabindex="-1" role="dialog" aria-labelledby="ui-dialog-title-dialog">'+
						'<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" unselectable="on" style="-moz-user-select: none;">'+
							'<span id="ui-dialog-title-dialog" class="ui-dialog-title" unselectable="on" style="-moz-user-select: none;">'+options.confirm_delete_title+'</span>'+
						'</div>'+
						'<div class="ui-dialog-content ui-widget-content" style="padding:5px 0; width: auto;">'+options.confirm_dialog_msg+
						'</div>'+
						'<div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">'+
							'<button class="ui-state-default ui-corner-all" type="button">Delete</button>'+
							'<button class="ui-state-default ui-corner-all" type="button">Cancel</button>'+
						'</div>'+
					'</div>'
				);
				// Parsing Close button on titlebar
				uiDialogTitlebarClose = $('<a href="#"/>')
				.addClass(
					'ui-dialog-titlebar-close ' +
					'ui-corner-all'
				)
				.attr('role', 'button')
				.hover(
					function() {
						uiDialogTitlebarClose.addClass('ui-state-hover');
					},
					function() {
						uiDialogTitlebarClose.removeClass('ui-state-hover');
					}
				)
				.focus(function() {
					uiDialogTitlebarClose.addClass('ui-state-focus');
				})
				.blur(function() {
					uiDialogTitlebarClose.removeClass('ui-state-focus');
				})
				.mousedown(function(ev) {
					ev.stopPropagation();
				})
				.click(function(event) {
					self.close(event);
					return false;
				})
				.appendTo('.ui-dialog-titlebar'),
				uiDialogTitlebarCloseText	=	$('<span/>')
				.addClass(
					'ui-icon ' +
					'ui-icon-closethick'
				)
				.text("Close")
				.appendTo(uiDialogTitlebarClose)
				/*
							'<a class="ui-dialog-titlebar-close ui-corner-all" href="#" role="button" unselectable="on" style="-moz-user-select: none;">'+
								'<span class="ui-icon ui-icon-closethick" unselectable="on" style="-moz-user-select: none;">close</span>'+
							'</a>'+
				*/
				// Does this one has overlay?
				if(options.confirm_dialog_bgiframe){
					$("body").append('<div class="ui-widget-overlay"></div>');
					$(".ui-widget-overlay").css({
						position: 'absolute',
						zIndex: 1001,
						top: '0px',
						left: '0px',
						width: '100%',
						height: $(document).height(),
					});
				}
				// Is Dragable
				if(options.confirm_dialog_draggable ) {
					try {
						$(".ui-draggable").draggable({ handle: $(".ui-dialog-titlebar")});
					} catch(e) { /* requires jQuery UI draggables */ }
				}
				// Setup dialog action
				$(".ui-dialog-titlebar-close").click( function() {
					jQuery.confirm._hide();
				});
				
				// End of Append html content element
			}
		});
		// Generate Confirm Dialog
	},
	_hide: function() {
		$('.ui-dialog').remove();
		$('.ui-widget-overlay').remove();
	},

}
jQuery.fn.confirm = jQuery.confirm.build;