/*
 * jQuery Autocomplete plugin 1.1
 *
 * Copyright (c) 2009 JÃ¶rn Zaefferer
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *
 * Revision: $Id: jquery.autocomplete.js 14 2009-08-22 10:29:29Z joern.zaefferer $
 */

;(function($) {
	$.fn.extend({
		vsTip: function(urlOrData, options) {
		options = $.extend({}, $.VsTip.defaults,  options);

		// if highlight is set to false, replace it with a do-nothing function
		//options.highlight = options.highlight || function(value) { return value; };

		// if the formatMatch option is not specified, then use formatItem for backwards compatibility
		//options.formatMatch = options.formatMatch || options.formatItem;

		return this.each(function() {
			new $.VsTip($(this), options);
		});
	},
	unVsTip: function() {
		return;
	}
	});

	$.VsTip = function(input, options) {
//		$.VsTip.input=input;
//		$.VsTip.options=options;
		var box=$.VsTip.display(input,options);
		box._contructor();
		switch(options.type) {
			case "bind":
				$("<div class='tip_icon'>seo</div>").insertAfter(input); 
				$(".tip_icon").click(function(){
					show();
				});
			break;
			case "mouseover":
				input.mouseover(function(){
					show();
				});
				input.mouseout(function(){
					box.hide();
				});
			break;
			case "dbclick":
				input.dblclick(function () { 
				      show();
				    });
			break;
			case "click":
				input.click(function(){
					show();
				});
			break;
			default:
				input.mouseover(function(){
					show();
				});
			break;
		}
		function show(){
			box.setHtml("troi oi la troi");
			box.setTitle("This is a title");
			box.show();
		}

	};
	$.VsTip.defaults = {
			inputClass: "ac_input",
			tipClass: "_vs_tip",
			barClass: "_vs_bar",
			title:"Title",
			closeBindClass: "_vs_close_bind",
			closeBindText:"close",
			bodyClass:"_vs_body",
			loadingClass: "ac_loading",
			scrollHeight: 180,
			title: "Vs tip",
			zIndex:1000,
			type: "bind"  //click, mouseover, dbclick, bind
		    
			
	};
	$.VsTip.display=function(input,options){
		var taskBar,
			body,
			data,
			closeBind,
			toIni=true,
			element;
		function ini(){
			if(!toIni) return;
			element = $("<div/>")
			.hide()
			.addClass(options.tipClass)
			.css("position", "absolute")
			.appendTo(document.body);
			
			taskBar = $("<div><div class='"++options.closeBindClass+"'></div><div class='"+options.closeBindClass+"'>'"+options.closeBindText+"'<div></div>")
			.addClass(options.barClass)
			//.css("position", "absolute")
			.appendTo(element);
			
			body = $("<div/>")
			.addClass(options.bodyClass)
			//.css("position", "absolute")
			.appendTo(element);
			
			closeBind = $("<div/>")
			.addClass(options.closeBindClass)
			//.css("position", "absolute")
			.appendTo(taskBar);
			toIni=false;
			
		 } 
		function getData(){
		}
		return{
			_contructor:function(){
				ini();
			},
			show: function(){
				element
				.css("top",input.offset().top+input.height())
				.css("left",input.offset().left)
				element.fadeIn("slow");
				body.html('<img src="'+imgurl+'loader.gif"/>');
			},
			hide: function(){
				element.fadeOut("slow");
				
			},
			setHtml: function(html){
				body.html(html);
			},
			setTitle: function(title){
				taskBar.append(title);
			},
			detructor: function(){
				element.remove();
			}
		}
		
		
			
	};
})(jQuery);
//jQuery.vsAjax = function(message){  
//      alert(message);  
//} 
//jQuery.fn.first = function(message){  
//     this.each(function(){  
//         alert(message + " " + this.id);  
//     });  
//} 