						$('#fullname').dblclick(function() {
							var html =	"<div id='profile_changenamecontainer'>"+
								    	"	<div id='profile_cn_form_callback'></div>"+
								    	"	<form id='profilename' method='POST'>"+
								    	"       <input type='hidden' name='a' value='protab_changname' />"+
								    	"		<label>First Name</label>"+
										"       <input name='userFirstName' value='"+pfjs['firstname']+"' />"+
										"       <div class='clear'></div>"+
										        
										"       <label>Last Name</label>"+
										"       <input name='userLastName' value='"+pfjs['lastname']+"' />"+
										"       <div class='clear'></div>"+
										        
										"		<a href='javascript:;' class='ainput' id='profile_cn_form_submit'>"+
										"        	<span>Submit</span>"+
										"       </a>"+
										"       <a href='javascript:;' class='ainput' id='profile_cn_form_cancel'>"+
										"        	<span>Cancel</span>"+
										"       </a>"+
										"       <div class='clear'></div>"+
								    	"	</form>"+
								    	"	<div class='clear'></div>"+
								    	"</div>"
					    	
					        $.blockUI({
					        	theme: true,
           						title: 'Change name information', 
						        message: html,
						        fadeIn: 1000
							});
							bindChangeNameButton();
							$('.blockOverlay').click($.unblockUI);
					    });
						
						function bindChangeNameButton(){
							$('#profile_cn_form_cancel').click(function(){
								$.unblockUI();
							});
							
							$('#profile_cn_form_submit').click(function(){
								vsf.submitForm($('#profilename'), 'users/changname/', 'profile_cn_form_callback');
								return false;
							});
						}
						
						function protab_changname_true(newjs){
								pfjs = $.extend(pfjs, newjs);
								$("#fullname").html(newjs['fullname']);
								
								setTimeout(function(){
						        	$('#message').toggle("slow", function(){
										$('#message').remove();
										$('label.error').remove();
				
										$.unblockUI();
									});
						        }, 2000);
						}
						
						function protab_changname_false(){
							setTimeout(function(){
					        	$('#message').toggle("slow", function(){
									$('#message').remove();
									$('label.error').remove();
			
									$.unblockUI();
								});
					        }, 2000);
						}
						
						var snindex = 1; var snhtml = '';
						for(var p in pfjs['profileSN'])
							snhtml += generateSN(snindex++, pfjs['profileSN'][p]);

						snhtml += 	"<div class='snitem' ref='"+snindex+"'>"+
						        	"	<input name='sn["+snindex+"][value]' class='sn' value='' id='sn"+snindex+"' />"+
						        	"	<select name='sn["+snindex+"][type]' id='snt"+snindex+"'>"+
						        	"		<option value='yahoo'>Yahoo</option>"+
						        	"		<option value='skype'>Skype</option>"+
						        	"		<option value='aim'>AIM</option>"+
						        	"		<option value='msn'>MSN</option>"+
						        	"	</select>"+
						        	"	<div class='clear'></div>"+
					        		"</div>";
					        		
						$('#sndiv').html(snhtml);
						
						function generateSN(index, node){
							var selected = {'yahoo':'', 'skype':'', 'aim':'', 'msn':''};
							selected[node['type']] = "selected = 'selected'";
							
							return 	"<div class='snitem' ref='"+index+"' style='display:none;'>"+
									"	<input id='sn"+index+"' class='sn' value='"+node['value']+"' name='sn["+index+"][value]' />"+
									"	<select id='snt"+index+"' name='sn["+index+"][type]'>"+
									"		<option value='yahoo' "+selected['yahoo']+">Yahoo</option>"+
						        	"		<option value='skype' "+selected['skype']+">Skype</option>"+
						        	"		<option value='aim' "+selected['aim']+">AIM</option>"+
						        	"		<option value='msn' "+selected['msn']+">MSN</option>"+
					        		"	</select>"+
									"	<div class='clear'></div>"+
									"</div>"+
					        		"<div class='sndiv' ref='"+index+"'>"+
									"	<span class='snvalue'>"+node['value']+"</span>"+
									"	<span class='sntype'>"+node['type']+"</span>"+
									"	<span onclick='removeSN("+index+")' name='"+index+"' class='rmsn'>X</span>"+
									"	<div class='clear'></div>"+
									"</div>";
						}
						
						bindSN();
                		function bindSN(){
                			$('#sndiv .snitem').bind('keypress', function(e) {
	                			var code = (e.keyCode ? e.keyCode : e.which);
	                			var ref = $(this).attr('ref');
								if(code == 13) {
									if($('#sn'+ref).val() != ""){
										$(this).css('display','none');
										var objAppend = "<div class='sndiv' ref='"+ref+"'>"+
														"<span class='snvalue'>"+$('#sn'+ref).val()+"</span>"+
														"<span class='sntype'>"+$('#snt'+ref).val()+"</span>"+
														"<span onclick='removeSN("+ref+")' name='"+ref+"' class='rmsn'>X</span>"+
														"<div class='clear'></div>"
														"</div>";
										$('#sndiv').append(objAppend);
										
										snindex++;
										var objAppend = "<div class='snitem' ref='"+snindex+"'>"+
											        	"	<input name='sn["+snindex+"][value]' class='sn input' value='' id='sn"+snindex+"' />"+
											        	"	<select name='sn["+snindex+"][type]' id='snt"+snindex+"' >"+
											        	"		<option value='yahoo'>Yahoo</option>"+
											        	"		<option value='skype'>Skype</option>"+
											        	"		<option value='aim'>AIM</option>"+
											        	"		<option value='msn'>MSN</option>"+
											        	"	</select>"+
											        	"	<div class='clear'></div>"+
										        		"</div>";
										$('#sndiv').append(objAppend);
										
										$('.snitem .input:last').focus();
										snindex++;
										bindSN();
									}
									else return false;
								}
							});
						}
						
						function removeSN(name){
							$("#sndiv [ref="+name+"]").remove();
						}
		        		
						var larray = pfjs['profileLanguage'].split(',');
						
						var lindex = 1; lhtml = '';
						for(var p in larray){
							if(larray[p])
							lhtml += generateLanguage(lindex++, larray[p]);
						}
						
						lhtml += "<input name='lang["+lindex+"]' id='lang"+lindex+"' ref='"+lindex+"' class='lang' />";
						$('#languagediv').html(lhtml);
						
						function generateLanguage(index, node){
							return 	"<input name='lang["+index+"]' class='lang' id='lang"+index+"' value='"+node+"' ref='"+index+"' style='display:none' />"+
					        		"<div class='langdiv' name='"+index+"'>"+
					        			node+
									"	<span onclick='removeLang("+index+")' name='"+index+"'>X</span>"+
									"	<div class='clear'></div>"+
									"</div>";
						}
						
						initLanguageBind();
                		function initLanguageBind(){
                			$('#languagediv input.lang').bind('keypress', function(e) {
	                			var code = (e.keyCode ? e.keyCode : e.which);
								if(code == 13) {
									if($(this).val() != ""){
										var langid = $(this).attr('ref');
										$(this).css('display','none');
										var objAppend = "<div class='langdiv' name='"+langid+"'>"+$(this).val()+
														"<span onclick='removeLang("+langid+")' name='"+$(this).attr('id')+"'>X</span>"+
														"</div>";
										$('#languagediv').append(objAppend);
										
										lindex++;
										
										var objAppend = "<input name='lang["+lindex+"]' id='lang"+lindex+"' ref='"+lindex+"' class='lang' />";
										$('#languagediv').append(objAppend);
										
										$('.lang:last').focus();
										initLanguageBind();
									}
									else return false;
								}
							});
						}
                	
						function removeLang(name){
							$("[name="+name+"]").remove();
							$("#lang"+name).remove();
						}
		        		
						
	                	$('#cpa_form_submit').click(function(){
	                		$.blockUI({
					       		css: {
					        		border: 'none',
		            				padding: '50px',
						            backgroundColor: '#C0C0C0',
						            color: '#000',
						            cursor:'progress'
						        }
							});
							vsf.submitForm($('#changpa'), 'users/editprofile/', "changepa_callback");
							return false;
						});
						
						
						
                		
						
						
						function profilecbtrue_a(){
		        			$.unblockUI();
							
							setTimeout(function(){
					        	$('#message').toggle("slow", function(){
									$(this).remove();
								});
					        }, 2000);
                		}
                		
                		function profilecbfalse_a(){
                			$.unblockUI();
							
							setTimeout(function(){
					        	$('#message').toggle("slow", function(){
									$(this).remove();
								});
					        }, 2000);
                		}
                		
                		var date = new Date();
	                	var arrayMonth = new Array(31,28,31,30,31,30,31,30,31,30,31,30);
						var y = date.getFullYear();
						
						if(date.getMonth()==2){
							var d = new Date("2,29," + y);
							if(d.getDate()==29) arrayMonth[1]=29;
							else arrayMonth[1]=28;
						}
						
						var i;
						var bd_explode = pfjs['profileBirthday'].split('-');
						
						var bdhtml = "<select id='month' name='month'>"+
									 "	<option value='0'>Month</option>";
						for(i=1;i<=12;i++){
							var current = "";
							if(i == bd_explode[0]) current = 'selected';
							bdhtml += "<option value='"+i+"' " + current +" >"+i+"</option>";
						}
						bdhtml += 	"</select>";
						
						
						bdhtml += 	"<select id='day' name='day'>"+
						 			"	<option value='0'>Day</option>";
						for(i=1;i<=arrayMonth[date.getMonth()];i++){
							var current = "";
							if(i == bd_explode[1]) var current = 'selected'; 
							bdhtml += "<option value='"+i+"' " + current +" >"+i+"</option>";
						}
						bdhtml += 	"</select>";
						
						
						bdhtml += 	"<select id='year' name='year'>"+
						 			"	<option value='0'>Year</option>";
						for(i = y-5; i >= y-70; i--){
							var current = "";
							if(i == bd_explode[2]) var current = 'selected';
							bdhtml += "<option value='"+i+"' " + current +" >"+i+"</option>";
						}
						bdhtml += 	"</select>";
						$("#bddiv").append(bdhtml);
                		
						
						
						generateRS();
						function generateRS(){
							var ohtml = ''; var rshtml = '';
							
							for(var index in rsjs){
								var value = rsjs[index]; var selected = '';
								
								if(pfjs['profileRS'] == index) selected = "selected='selected'";
								ohtml += "<option value='"+index+"' "+selected+">"+value+"</option>";
					        }
					        
							rshtml =	"<select name='profileRS' id='profileRS'  style='width:100%'>"+
											ohtml +
					        			"</select>";
					        $('#rsdiv').html(rshtml);
						}