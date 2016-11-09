					var prefix = {
							0 : {'name'	: 	'profileIntro', 	'key' 	:'aboutdetail'},
							1 : {'name'	: 	'profileSkill', 	'key' 	:'skilldetail'},
							2 : {'name'	: 	'profileGA', 		'key' 	:'gadetail'},
							3 : {'name'	: 	'profileInterest', 	'key' 	:'interestsdetail'},
							4 : {'name'	: 	'profileHonor'	, 	'key' 	:'honorsdetail'},
							5 : {'name'	: 	'profileEmail', 	'key' 	:'emaildetail'},
							6 : {'name'	: 	'profilePhone', 	'key' 	:'phonedetail'},
							7 : {'name'	: 	'profileAddress', 	'key' 	:'addressdetail'},
							8 : {'name'	: 	'profileWebsite', 	'key' 	:'websitedetail'},
							9 : {'name'	: 	'profileRSV', 		'key' 	:'relationshipdetail'}
						}
						
						var edittext = 'Click here to edit';
						for (var p in prefix){
							if(js[prefix[p]['name']] == null) $('#'+prefix[p]['key']).html(edittext);
						}
						
			
						var date = new Date();
						var y = date.getFullYear();
								
						function generateWork(f, wphtml){
							var epend = "present";
			        		if(f['workEnd']) epend = f['workEnd'];
							
			        		var emore = '';
			        		if(f['workCompany'] != '') emore = f['workCompany'];
							
			        		var ttime = "("+ f['workStart'] + " to " + epend + ")";
			        		
							return 		"<div id='w"+f['workId']+"' class='wcon'>"+
			        					"	<div class='winfo' ref='"+f['workId']+"'>"+
										"		<div id='wdetail"+f['workId']+"' class='winfodiv' ref='"+f['workId']+"'>"+	
			        					"			<span class='wtitle'>"+f['workTitle']+ " " + ttime + "</span>"+
										"			<div class='wmore'>"+
														emore +
										"			</div>"+
										"		</div>"+
										"		<div class='clear'></div>"+
										"	</div>"+
										"	<div class='pcontainer'>"+
										"		<div class='pctitle'>Projects</div>"+
										"		<div class='listcontainer'>"+
										"			<div id='wplist"+f['workId']+"' class='plist'>"+
														wphtml +
										"			</div>"+
										"			<div class='plist'>"+
										"				<div id='woption"+f['workId']+"' class='option' ref='"+f['workId']+"'>"+
										"					<a class='addwpro' mai='"+f['workId']+"' href='javascript:;' >"+
										"						Add project"+
										"					</a>"+
										"					<div class='clear'></div>"+
										"				</div>"+
										"			</div>"+
										"		</div>"+
										"		<div class='clear'></div>"+
										"	</div>"+
										"</div>";
						}
			                		
						function generateWP(p){
								var epend = "present";
				        		if(p['wpEnd']) epend = p['wpEnd'];
				        		
								return 	"<div id='wp"+p['wpId']+"' class='workproject'>"+
			        					"	<div id='wpinfo"+p['wpId']+"' class='pinfo' ref='"+p['wpId']+"'>"+
										"	<div id='wpmainfo"+p['wpId']+"'>"+	
			        					"			<div class='ptitle'>"+
			        									p['wpTitle']+" (" + p['wpStart'] + " to " + epend + ")" +
			        					"			</div>"+
										"			<div class='pdetail'>"+p['wpDetail']+"</div>"+
										"		</div>"+
										"	</div>"+
										"	<div class='poption'>"+
										"		<span class='editWP' ref='"+p['wpId']+"' mai='"+p['wpWork']+"'>Edit</span>"+
										"		<span class='deleteWP' ref='"+p['wpId']+"' mai='"+p['wpWork']+"'>X</span>"+
										"	</div>"+
										"	<div class='clear'></div>"+
										"</div>";
						}
			                		
			                		
			    		function generateWorkHTML(){
			    			var html = '';
			
			      			for(var i in js['work']){
			    				var wphtml = '';
			    				var f = js['work'][i];
			    				if(f['projects'] != null){
			        				for(var j in f['projects']){
			        					var p = f['projects'][j];
			        					wphtml += generateWP(p);
			        				}
			        			}
			    				html += generateWork(f, wphtml);
							}
			      			
			      			return 	"<div id='workcon' class='workcon'>"+html+"</div>"+
			      					"	<div class='addmain' id='addworkoption'>"+
			      					"		<div id='addwork'>"+
						            "			<div class='ainput' >"+
									"				<span>Add Campany</span>"+
									"			</div>"+
									"			<div class='clear'></div>"+
									"		</div>"+
									"	</div>";
			    		}
			    		$('#work').html(generateWorkHTML());
    		
    		
  //////pandog add work
  						$('#addwork').click(function(){
							var html = generateWForm(0);

							$('#addworkoption').addClass('wcon');
							$(this).after(html);
							$(this).css('display', 'none');

							bindCurrent();
							bindWButton();
						});
                		
						function profilecbtrue_work_add(newjs){
                			js['work'][newjs['workId']] = newjs;
				
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){
					        		var html = generateWork(newjs, '');
												
												
									$('#projectForm').toggle("slow", function(){
										$('#projectForm').prev().css('display','block');
										$('#projectForm').remove();
										
										$('#addworkoption').removeClass('wcon');
										$('#workcon').append(html);
										
										unbindPFEvent();
										bindHoverWork();
										bindEditWork();
										bindAddWProject();
                						return false;
									});
								});
					        }, 2000);
                		}

                		
                		function profilecbfalse_work_add(){
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){	
		                			$('#projectForm').toggle("slow", function(){
		                				$(this).prev().css('display','block');
										$(this).remove();
										unbindPFEvent();
									});
								});
					        }, 2000);
                		}
                		
                		bindEditWork();
                		function bindEditWork(){
                			$('.winfodiv').dblclick(function(){
								var ref = $(this).attr('ref');
								
								var html = generateWForm(ref);
								
								$('#wdetail'+ref).after(html);
								$('#wdetail'+ref).css('display', 'none');
								
								$('#w'+ref+' .winfo').addClass('editings');
								$('#w'+ref+' .poption').remove();
								
								bindCurrent();
								bindWButton();
                			});
                		}
                		
                		function profilecbtrue_work_edit(newjs){
                			var ref = $('#projectForm').attr('ref');
                			$.extend(js['work'][ref], newjs);
                			
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){	
									var title = newjs['workTitle'];
									
									$('#wdetail'+ref+' .wtitle').html(title);
									
									var td = newjs['fmonth'] + '-' + newjs['fyear'] + ' to ';
									
									if(newjs['tmonth'] == null && newjs['tyear'] == null) td += 'present';
									else td += newjs['tmonth'] + '-' + newjs['tyear'];
									
									var emore = "";
									if(newjs['workCompany']) emore += newjs['workCompany'];
									emore += ' ('+td+')';

									
									$('#wdetail'+ref+' .wmore').html(emore);
									
									$('#projectForm').toggle("slow", function(){
										$('#projectForm').remove();
										
										$('#wdetail'+ref).toggle("slow", function(){
											$(this).css('display','block;');
										});
										
										$('#w'+ref+' .winfo').removeClass('editings');
										unbindPFEvent();
										$('#w'+ref+' .editings').removeClass('editings');
									});
								});
					        }, 2000);
                		}
                		
                		function profilecbfalse_work_edit(){
                			var ref = $('#projectForm').attr('ref');
                			$('#w'+ref+' .editings').removeClass('editings');
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){	
		                			$('#projectForm').toggle("slow", function(){
										$('#projectForm').remove();
										$('#edetail'+ref).toggle("slow");
										unbindPFEvent();
										$('#'+ref+' .einfo').removeClass('editings');
									});
								});
					        }, 2000);
                		}
                		
                		
                		bindHoverWork();
                		function bindHoverWork(){
                			$('.winfo').unbind('mouseenter mouseleave');
                			$('.winfo').hover(
                				function(){
                					if($('#dwoption').length == 0 && !$(this).hasClass('editings')){
	                					var ref = $(this).attr('ref');
	                					var rm = "<div id='dwoption' class='poption'><span class='deleteWork' ref='"+ref+"'>X</spann>";
	                					$(this).prepend(rm);
	                					bindDeleteWork();
	                				}
	                			},
	                			function(){
	                				$('#dwoption').remove();
	                				$(this).bind('dblclick');
		                		}
	                		);
                		}
                		
                		function bindDeleteWork(){
                			$('.deleteWork').click(function(){
                				var ref = $(this).attr('ref');

                				jConfirm(
            						'Are you sure to delete', 
									'Dialog board',
									function(r){
										if(r){
											$('#wdetail'+ref).prepend("<div id='rmepcb' ref='"+ref+"'></div>");
											vsf.get('users/deletework/'+ref, 'rmepcb');
											return false;
										}else{
											$('#w'+ref+' .einfo').bind('dblclick');
											return false;
										}
								});
                			});
						}
						
						function profilecbtrue_work_remove(){
                			var ref = $('#rmepcb').attr('ref');

                			delete js['work'][ref];
							$('#w'+ref).toggle("slow", function(){	
								$(this).remove();
							});
                		}
                		
                		function profilecbfalse_work_remove(){
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){	
									$('#rmepcb').remove();
								});
					        }, 2000);
                		}
                		
                		function generateWForm(ref){
                				removeAllForm();
						
								var epfmonth = ""; var eptmonth = ""; var epfyear = ""; var eptyear = "";
								var checked = ""; sto = ''; spre = "style='display:none;'";
								var tfmonth = 0, ttmonth = 0, tfyear = 0, ttyear = 0;
								var tepTitle = "", tepCampany = "";
								var cclass = "workproject"; var ssubmit = "Add";
								
								if(ref > 0){
									if(js['work'][ref]['workEnd'] == null || js['work'][ref]['workEnd'] == ""){
	                					checked = 'checked';
	                					spre=''; sto = "style='display:none;'";
	                				}

									tfmonth 	= js['work'][ref]['fmonth'];
									ttmonth 	= js['work'][ref]['tmonth'];
									tfyear 		= js['work'][ref]['fyear'];
									ttyear 		= js['work'][ref]['tyear'];
									
									tepTitle 	= js['work'][ref]['workTitle'];
                					tepCampany 	= js['work'][ref]['workCompany'];
                					
                					ssubmit = "Edit";
	                			}
                				
	                			for(i=1; i<=12; i++){
									var current = "";
									if(i == tfmonth) current = 'selected';
									epfmonth += "<option value='"+i+"' "+current+">"+i+"</option>";
									
									var current = "";
									if(i == ttmonth) current = 'selected';
									eptmonth += "<option value='"+i+"' "+current+">"+i+"</option>";
								}
                				
                				for(i = y; i >= y-60; i--){
                					var current = "";
                					if(i == tfyear) current = 'selected';
									epfyear += "<option value='"+i+"' "+current+">"+i+"</option>";
									
									var current = "";
									if(i == ttyear) current = 'selected';
									eptyear += "<option value='"+i+"' "+current+">"+i+"</option>";
								}
								
                				var todate = "";
                				todate =	"		<div id='epto' " +sto+ ">"+
											"			<select name='etmonth' id='etmonth' class='date'>"+
											"           	<option value='0'>Month</option>"+
															eptmonth + 
											"            </select>"+
										
											"            <select name='etyear' id='etyear' class='date'>"+
											"            	<option value='0'>Year</option>"+
															eptyear +
											"            </select>"+
									    	"        </div>"+
									    	"        <div id='eptopresent' "+spre+">"+
									    	"        	<span>present</span>"+
									    	"        </div>";
									    	
								
                				var html = 	"<form id='projectForm' class='projectForm' ref='"+ref+"'>"+
                							"<div class='"+cclass+"'>"+
                							"<div class=''>"+
                							"	<input type='hidden' name='workId' value='"+ref+"' />"+
                							"	<div id='pfcb'></div>"+
											
                							"	<label>Title</label>"+
											"	<input name='workTitle' value='"+tepTitle+"' class='input' id ='workTitle' />"+
											"	<div class='clear'></div>"+
											
											"	<label>Company</label>"+
											"	<input name='workCompany' value='"+tepCampany+"' class='input'/>"+
											"	<div class='clear'></div>"+
											
											"	<label>Timeline </label>"+
											"	<input name='epCurrent' class='epcurrent' id='epCurrent' value='current' type='checkbox' "+checked+"><span>Current</span>"+
											"	<div class='clear'></div>"+
											
											"	<div class='epto'>"+
											"		<select name='efmonth' id='efmonth' class='date'>"+
										    "        	<option value='0'>Month</option>"+
										   				epfmonth +			
										    "        </select>"+
										    "        <select name='efyear' id='efyear' class='date'>"+
										    "        	<option value='0'>Year</option>"+
										    			epfyear +
										    "        </select>"+
											"       <span style='margin: 0px 3px;'>to</span>"+		
										    		todate+	
											"	</div>"+
											"	<div class='clear'></div>"+
		
											"	<div class='epoption'>"+
											"		<a id='project_submit' class='ainput' href='javascript:;'>"+
											"			<span>"+ssubmit+"</span>"+
											"		</a>"+
											"		<a id='project_cancel' class='ainput' href='javascript:;'>"+
											"			<span>Cancel</span>"+
											"		</a>"+
											"		<div class='clear'></div>"+
											"	</div>"+
											"	<div class='clear'></div>"+
											"</div>"+
											"<div class='clear'></div>"+
											"</div>"+
											"</form>";
							return html;
                		}
                		
                		function bindWButton(){
                			$('#project_submit').click(function(){
                				var validate = validateWFrom();
                				if(validate > 0){
                					var errorjson = {1:'Title cannot be blank', 2: 'Start time is not valid', 3: 'Finish time is not valid'};
                					var errormessage = "<div class='message' id='message'>"+errorjson[validate]+'</div>'; 
                					$('#pfcb').html(errormessage);
                					setTimeout(function(){
							        	$('#message').toggle("slow", function(){	
											$(this).remove();
										});
							        }, 2000);
                					return false;
                				}
                				vsf.submitForm($('#projectForm'), 'users/editwork', 'pfcb');
                				unbindAllInfoEditableEvent();
                				return false;
                			});
                			
                			$('#project_cancel').click(function(){
								var ref = $('#projectForm').attr('ref');
								
								$('#w'+ref+' .editings').removeClass('editings');
								$('#addworkoption').removeClass('wcon');
								
								$('#projectForm').toggle("slow", function(){	
									$('#projectForm').prev().css('display','block');
									$('#projectForm').remove();
								});
                				return false;
                			});
                		}
                		
                		function validateWFrom(){
                			if($('#workTitle').val() == '') return 1;
                			if($('#efmonth').val() == 0 || $('#efyear').val() == 0) return 2;
                			
                			if(!$('#epCurrent').is(':checked')){
                				if($('#etmonth').val() == 0 || $('#etyear').val() == 0) return 3;
                				
                				var nstart = parseInt($('#efyear').val() + $('#efmonth').val());
                				var nend = parseInt($('#etyear').val()+$('#etmonth').val());
                				
                				if(nstart > nend) return 3;
                			}
                			
                			return 0;
                		}
  //////pandog add work  		
    		
						bindAddWProject();
                		function bindAddWProject(){
							$('.addwpro').click(function(){
								var mai = $(this).attr('mai');
								var html = generateWPForm(mai, 0);
												
								
								$('#woption'+mai).after(html);
								$('#woption'+mai).css('display','none');
								
								bindCurrent();
								bindWPButton();
							});
						}
						
						function bindWPButton(){
                			$('#project_submit').click(function(){
                				var validate = validateWPFrom();
                				if(validate > 0){
                					var errorjson = {1:'Title cannot be blank', 2: 'Start time is not valid', 3: 'Finish time is not valid'};
                					var errormessage = "<div class='message' id='message'>"+errorjson[validate]+'</div>'; 
                					$('#pfcb').html(errormessage);
                					setTimeout(function(){
							        	$('#message').toggle("slow", function(){	
											$(this).remove();
										});
							        }, 2000);
                					return false;
                				}
                				vsf.submitForm($('#projectForm'), 'users/editwpro', 'pfcb');
                				return false;
                			});
                			
                			$('#project_cancel').click(function(){
								var ref = $('#projectForm').attr('ref');
								$('#projectForm').toggle("slow", function(){	
									$('#projectForm').prev().css('display','block');
									$('#projectForm').remove();
								});
                				return false;
                			});
                		}
                	
                		function profilecbtrue_wpro_add(newjs){
							var mai = $('#projectForm').attr('mai');
							if(js['work'][mai]['projects'] == null) js['work'][mai]['projects'] = {};
                			js['work'][mai]['projects'][newjs['wpId']] = newjs;
                			
                			var html = '';
                			html = generateWP(newjs);
                			
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){
									$('#projectForm').toggle("slow", function(){
										$('#projectForm').prev().css('display','block');
										$('#projectForm').remove();
										
										$('#wplist'+mai).append(html);
										
										unbindPFEvent();
										bindEditWProject();
                						bindRemoveWProject();
                						return false;
									});
								});
					        }, 2000);
                		}
                		
						function profilecbfalse_wpro_add(){
                			var mai = $('#projectForm').attr('mai');
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){	
		                			$('#projectForm').toggle("slow", function(){
		                				$('#woption'+mai).css('display','block');
										$('#projectForm').remove();
										unbindPFEvent();
									});
								});
					        }, 2000);
                		}
                		
                		bindEditWProject();
                		function bindEditWProject(){
                			$('.editWP').click(function(){
                				var mai = $(this).attr('mai');
                				var ref = $(this).attr('ref');
								var html = generateWPForm(mai, ref);
												
								
								$('#wpmainfo'+ref).after(html);
								$('#wpmainfo'+ref).css('display','none');
								
								bindCurrent();
								bindWPButton();
                			});
                		}
                		
                		function profilecbtrue_wpro_edit(newjs){
                			var mai = $('#projectForm').attr('mai');
                			var ref = $('#projectForm').attr('ref');
							
                			js['work'][mai]['projects'][ref] = newjs;

                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){
					        		var td = newjs['fmonth'] + '-' + newjs['fyear'] + ' to ';
									
									if(newjs['tmonth'] == null && newjs['tyear'] == null) td += 'present';
									else td += newjs['tmonth'] + '-' + newjs['tyear'];
									
									var ptitle = newjs['wpTitle'] + " (" + td + ")";
									$('#wpmainfo'+ref+' .ptitle').html(ptitle);
									$('#wpmainfo'+ref+' .pdetail').html(newjs['wpDetail']);
									
									
									$('#projectForm').toggle("slow", function(){
										$(this).prev().toggle("slow", function(){
											$(this).css('display','block;');
										});
										$(this).remove();
										unbindPFEvent();
									});
								});
					        }, 2000);
                		}

                		function profilecbfalse_wpro_edit(){
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){	
									var ref = $('#projectForm').attr('ref');
		                			$('#projectForm').toggle("slow", function(){	
										$('#projectForm').remove();
										$('#mainfo'+ref).toggle("slow");
										unbindPFEvent();
									});
								});
					        }, 2000);
                		}
						
                		bindRemoveWProject();
                		function bindRemoveWProject(){
                			$('.deleteWP').click(function(){
                				var ref = $(this).attr('ref');
                				var mai = $(this).attr('mai');
                				
                				jConfirm(
									'Are you sure to delete this information?', 
									'Delete a project', 
									function(r){
										if(r){
											$('#wpmainfo'+ref).prepend("<div id='rmepcb' mai='"+mai+"' ref='"+ref+"'></div>");
											vsf.get('users/deletewpro/'+ref, 'rmepcb');
											return false;
										}
								});
                			});
                		}
                		
                		function profilecbtrue_wpro_remove(){
                			var ref = $('#rmepcb').attr('ref');
                			var mai = $('#rmepcb').attr('mai');

                			delete js['work'][mai]['projects'][ref];
							$('#wp'+ref).toggle("slow", function(){	
								$(this).remove();
							});
                		}
                		
                		function profilecbfalse_wpro_remove(){
                			setTimeout(function(){
					        $('#message').toggle("slow", function(){	
									$('#rmepcb').remove();
								});
					        }, 2000);
                		}
                		
                		function validateWPFrom(){
                			var nstart = parseInt($('#efyear').val() + $('#efmonth').val());
                			if($('#wpTitle').val() == '') return 1;
                			if($('#efmonth').val() == 0 || $('#efyear').val() == 0) return 2;
							
                			if(!$('#epCurrent').is(':checked')){
                				if($('#etmonth').val() == 0 || $('#etyear').val() == 0) return 3;
								var nend = parseInt($('#etyear').val()+$('#etmonth').val());
                				
                				if(nstart > nend) return 3;
                			}
                			return 0;
                		}
                		
						function generateWPForm(mai, ref){
                				removeAllForm();
						
								var epfmonth = ""; var eptmonth = ""; var epfyear = ""; var eptyear = "";
								var checked = ""; sto = ''; spre = "style='display:none;'";
								var tfmonth = 0, ttmonth = 0, tfyear = 0, ttyear = 0;
								var tepTitle = "", tepDetail = ""; var cclass = "eduproject"; var ssubmit = "Add";
								
								if(ref > 0){
									if(js['work'][mai]['projects'][ref]['wpEnd'] == null || js['work'][mai]['projects'][ref]['wpEnd'] == ""){
	                					checked = 'checked';
	                					spre=''; sto = "style='display:none;'";
	                				}

									tfmonth 	= js['work'][mai]['projects'][ref]['fmonth'];
									ttmonth 	= js['work'][mai]['projects'][ref]['tmonth'];
									tfyear 		= js['work'][mai]['projects'][ref]['fyear'];
									ttyear 		= js['work'][mai]['projects'][ref]['tyear'];
									
									tepTitle 	= js['work'][mai]['projects'][ref]['wpTitle'];
                					tepDetail 	= js['work'][mai]['projects'][ref]['wpDetail'];
                					
                					cclass		= ""; ssubmit = "Edit";
	                			}
                				
	                			for(i=1; i<=12; i++){
									var current = "";
									if(i == tfmonth) current = 'selected';
									epfmonth += "<option value='"+i+"' "+current+">"+i+"</option>";
									
									var current = "";
									if(i == ttmonth) current = 'selected';
									eptmonth += "<option value='"+i+"' "+current+">"+i+"</option>";
								}
                				
                				for(i = y; i >= y-60; i--){
                					var current = "";
                					if(i == tfyear) current = 'selected';
									epfyear += "<option value='"+i+"' "+current+">"+i+"</option>";
									
									var current = "";
									if(i == ttyear) current = 'selected';
									eptyear += "<option value='"+i+"' "+current+">"+i+"</option>";
								}
								
                				var todate = "";
                				todate =	"		<div id='epto' " +sto+ ">"+
											"			<select name='etmonth' id='etmonth' class='date'>"+
											"           	<option value='0'>Month</option>"+
															eptmonth + 
											"            </select>"+
										
											"            <select name='etyear' id='etyear' class='date'>"+
											"            	<option value='0'>Year</option>"+
															eptyear +
											"            </select>"+
									    	"        </div>"+
									    	"        <div id='eptopresent' "+spre+">"+
									    	"        	<span>present</span>"+
									    	"        </div>";
									    	
                				
                				var html = 	"<form id='projectForm' class='projectForm' ref='"+ref+"' mai='"+mai+"'>"+
                							"<div class='"+cclass+"'>"+
                							"<div class='formdiv'>"+
                							"	<input type='hidden' name='wpId' value='"+ref+"' />"+
                							"	<input type='hidden' name='wpWork' value='"+mai+"' />"+
                							"	<div id='pfcb'></div>"+
											"	<label>Title</label>"+
											"	<input name='wpTitle' id='wpTitle' value='"+tepTitle+"' class='input'/>"+
											"	<div class='clear'></div>"+
											
											"	<label>Detail</label>"+
											"	<textarea name='wpDetail'>"+tepDetail+"</textarea>"+
											"	<div class='clear'></div>"+
											
											"	<label>Timeline</label>"+
											"	<input name='epCurrent' class='epcurrent' id='epCurrent' value='current' type='checkbox' "+checked+"><span>Current</span>"+
											"	<div class='clear'></div>"+
											
											"	<div class='epto'>"+
											"		<select name='efmonth' id='efmonth' class='date'>"+
										    "        	<option value='0'>Month</option>"+
										   				epfmonth +			
										    "        </select>"+
										    "        <select name='efyear' id='efyear' class='date'>"+
										    "        	<option value='0'>Year</option>"+
										    			epfyear +
										    "        </select>"+
											"       <span style='margin: 0px 3px;'>to</span>"+		
										    		todate+	
											"	</div>"+
											"	<div class='clear'></div>"+
		
											"	<div class='epoption'>"+
											"		<a id='project_submit' class='ainput' href='javascript:;'>"+
											"			<span>"+ssubmit+"</span>"+
											"		</a>"+
											"		<a id='project_cancel' class='ainput' href='javascript:;'>"+
											"			<span>Cancel</span>"+
											"		</a>"+
											"		<div class='clear'></div>"+
											"	</div>"+
											"	<div class='clear'></div>"+
											"</div>"+
											"<div class='clear'></div>"+
											"</div>"+
											"</form>";
							return html;
                		}
                		
                		
                		
	   
                		
////Education
							function generateEP(p){
								var epend = "present";
				        		if(p['epEnd']) epend = p['epEnd'];
				        		
								return 	"<div id='ep"+p['epId']+"' class='eduproject'>"+
				    					"	<div id='epinfo"+p['epId']+"' class='pinfo' ref='"+p['epId']+"'>"+
										"	<div id='epmainfo"+p['epId']+"'>"+	
				    					"			<div class='ptitle'>"+
				    									p['epTitle']+ " (" + p['epStart'] + " to " + epend + ")" + 
				    					"			</div>"+
										"			<div class='pdetail'>"+p['epDetail']+"</div>"+
										"		</div>"+
										"	</div>"+
										"	<div class='poption'>"+
										"		<span class='editEP' ref='"+p['epId']+"' mai='"+p['epEdu']+"'>Edit</span>"+
										"		<span class='deleteEP' ref='"+p['epId']+"' mai='"+p['epEdu']+"'>X</span>"+
										"	</div>"+
										"	<div class='clear'></div>"+
										"</div>";
							}
                		
                			function generateEdu(f, ephtml){
                				var epend = "present";
				        		if(f['eduEnd']) epend = f['eduEnd'];
								
				        		var eduTitle = f['eduSchool'];
				        		if(f['eduMain'] == 1) eduTitle = cpjs[f['eduSchool']]['title'];
				        		
				        		var emore = '';
				        		if(f['eduDegree'] != '' && f['eduDegree'] != null) emore = f['eduDegree'] + ", ";
				        		if(f['eduMajor'] != '' && f['eduMajor'] != null) emore += f['eduMajor'] + " ";
								
				        		if(f['eduStart'] != null) emore += " ("+ f['eduStart'] + " to " + epend + ")";

		        				return 	"<div id='e"+f['eduId']+"' class='econ'>"+
			        					"	<div class='einfo' ref='"+f['eduId']+"'>"+
										"		<div id='edetail"+f['eduId']+"' class='einfodiv' ref='"+f['eduId']+"'>"+	
			        					"			<span class='etitle'>"+eduTitle+"</span>"+
										"			<div class='emore'>"+
														emore +
										"			</div>"+
										"		</div>"+
										"		<div class='clear'></div>"+
										"	</div>"+
										"	<div class='pcontainer'>"+
										"		<div class='pctitle'>Projects</div>"+
										"		<div class='listcontainer'>"+
										"			<div id='plist"+f['eduId']+"' class='plist'>"+
														ephtml +
										"			</div>"+
										"			<div class='plist'>"+
										"				<div id='option"+f['eduId']+"' class='option' ref='"+f['eduId']+"'>"+
										"					<a class='addpro' mai='"+f['eduId']+"' href='javascript:;' >"+
										"						Add project"+
										"					</a>"+
										"					<div class='clear'></div>"+
										"				</div>"+
										"			</div>"+
										"			<div class='clear'></div>"+
										"		</div>"+
										"		<div class='clear'></div>"+
										"	</div>"+
										"</div>";
                		}
                		
                		function generateEducationHTML(){
                			var html = '';
                			
	              			for(var i in js['education'] ){
                				var ephtml = '';
                				var f = js['education'][i];
                				if(f['projects'] != null){
	                				for(var j in f['projects']){
	                					var p = f['projects'][j];
	                					ephtml += generateEP(p);
	                				}
	                			}

                				html += generateEdu(f, ephtml);
							}
							
							return 	"<div id='educon' class='educon'>"+html+"</div>"+
			      					"	<div class='addmain' id='addeduoption'>"+
			      					"		<div id='addedu'>"+
						            "			<div class='ainput' >"+
									"				<span>Add School</span>"+
									"			</div>"+
									"			<div class='clear'></div>"+
									"		</div>"+
									"	</div>";
                		}
                		
                		$('#education').html(generateEducationHTML());
                		
//////pandog add edu 
						$('#addedu').click(function(){
							var html = generateEForm(0);

							$('#addeduoption').addClass('econ');
							$(this).after(html);
							$(this).css('display', 'none');

							bindCurrent();
							bindEButton();
						});
						
                		function profilecbtrue_edu_add(newjs){
                			js['education'][newjs['eduId']] = newjs;
				
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){
					        		var html = generateEdu(newjs, '');
												
												
									$('#projectForm').toggle("slow", function(){
										$('#projectForm').prev().css('display','block');
										$('#projectForm').remove();
										
										$('#addeduoption').removeClass('econ');
										$('#educon').append(html);
										
										unbindPFEvent();
										bindHoverEdu();
										bindEditEdu();
										bindAddEProject();
                						return false;
									});
								});
					        }, 2000);
                		}

                		
                		function profilecbfalse_edu_add(){
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){	
		                			$('#projectForm').toggle("slow", function(){
		                				$(this).prev().css('display','block');
										$(this).remove();
										unbindPFEvent();
									});
								});
					        }, 2000);
                		}
                		
                		bindEditEdu();
                		function bindEditEdu(){
                			$('.einfodiv').dblclick(function(){
								var ref = $(this).attr('ref');
								
								var html = generateEForm(ref);
								
								$('#edetail'+ref).after(html);
								$('#edetail'+ref).css('display', 'none');
								
								$('#e'+ref+' .einfo').addClass('editings');
								$('#e'+ref+' .poption').remove();
								
								bindCurrent();
								bindEButton();
                			});
                		}
                		
                		function profilecbtrue_edu_edit(newjs){
                			var ref = $('#projectForm').attr('ref');
                			$.extend(js['education'][ref], newjs);
                			
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){	
									var title = newjs['eduSchool'];

									
									if(newjs['eduMain'] == 1)
										for(var i in cpjs ){
											f = cpjs[i];
											if(f['id'] == title) title = f['title'];
										}
										
									$('#edetail'+ref+' .etitle').html(title);
									
									
									var td = newjs['fmonth'] + '-' + newjs['fyear'] + ' to ';
									
									if(newjs['tmonth'] == null && newjs['tyear'] == null) td += 'present';
									else td += newjs['tmonth'] + '-' + newjs['tyear'];
									
									var emore = "";
									if(newjs['eduDegree']) emore += newjs['eduDegree'];
									if(newjs['eduMajor']){
										if(newjs['eduDegree']) emore += ', ';
										emore += newjs['eduMajor'];
									}
									emore += ' ('+td+')';

									
									$('#edetail'+ref+' .emore').html(emore);
									
									$('#projectForm').toggle("slow", function(){
										$('#projectForm').remove();
										
										$('#edetail'+ref).toggle("slow", function(){
											$(this).css('display','block;');
										});
										
										$('#e'+ref+' .winfo').removeClass('editings');
										unbindPFEvent();
									});
								});
					        }, 2000);
                		}
                		
                		function profilecbfalse_edu_edit(){
                			var ref = $('#projectForm').attr('ref');
                			$('#e'+ref+' .editings').removeClass('editings');
                			
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){	
		                			$('#projectForm').toggle("slow", function(){
										$('#projectForm').remove();
										$('#edetail'+ref).toggle("slow");
										unbindPFEvent();
									});
								});
					        }, 2000);
                		}
                		
                		
                		bindHoverEdu();
                		function bindHoverEdu(){
                			$('.einfo').unbind('mouseenter mouseleave');
                			$('.einfo').hover(
                				function(){
                					var ref = $(this).attr('ref');
                					if($('#deoption').length == 0 && !$(this).hasClass('editings') && js['education'][ref]['eduMain'] == 0){
	                					var rm = "<div id='deoption' class='poption'><span class='deleteEdu' ref='"+ref+"'>X</spann>";
	                					$(this).prepend(rm);
	                					bindDeleteEdu();
	                				}
	                			},
	                			function(){
	                				$('#deoption').remove();
	                				$(this).bind('dblclick');
		                		}
	                		);
                		}
                		
                		function bindDeleteEdu(){
                			$('.deleteEdu').click(function(){
                				var ref = $(this).attr('ref');

                				jConfirm(
									'Are you sure to delete this information?', 
									'Delete a school', 
									function(r){
										if(r){
											$('#edetail'+ref).prepend("<div id='rmepcb' ref='"+ref+"'></div>");
											vsf.get('users/deleteedu/'+ref, 'rmepcb');
											return false;
										}else{
											$('#e'+ref+' .einfo').bind('dblclick');
											return false;
										}
								});
                			});
						}
						
						function profilecbtrue_edu_remove(){
                			var ref = $('#rmepcb').attr('ref');

                			delete js['education'][ref];
							$('#e'+ref).toggle("slow", function(){	
								$(this).remove();
							});
                		}
                		
                		function profilecbfalse_edu_remove(){
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){	
									$('#rmepcb').remove();
								});
					        }, 2000);
                		}
                		
                			
						
                		
                		
                		
                		
                		function generateEForm(ref){
                				removeAllForm();
						
								var epfmonth = ""; var eptmonth = ""; var epfyear = ""; var eptyear = "";
								var checked = ""; sto = ''; spre = "style='display:none;'";
								var tfmonth = 0, ttmonth = 0, tfyear = 0, ttyear = 0;
								var tepSchool = "", tepDegree = "", tepMajor = "";
								var cclass = "eduproject"; var ssubmit = "Add";
								
								var etype = 0;
								if(ref > 0){
	                				if(js['education'][ref]['eduMain'] == 1)etype = 1;

									if(js['education'][ref]['eduEnd'] == null || js['education'][ref]['eduEnd'] == ""){
	                					checked = 'checked';
	                					spre=''; sto = "style='display:none;'";
	                				}

									tfmonth 	= js['education'][ref]['fmonth'];
									ttmonth 	= js['education'][ref]['tmonth'];
									tfyear 		= js['education'][ref]['fyear'];
									ttyear 		= js['education'][ref]['tyear'];
									
									tepSchool 	= js['education'][ref]['eduSchool'];
									
									
									if(js['education'][ref]['eduDegree'] != null) tepDegree 	= js['education'][ref]['eduDegree'];
                					if(js['education'][ref]['eduMajor'] != null) tepMajor = js['education'][ref]['eduMajor'];
                					
                					ssubmit = "Edit";
	                			}
                				
	                			for(i=1; i<=12; i++){
									var current = "";
									if(i == tfmonth) current = 'selected';
									epfmonth += "<option value='"+i+"' "+current+">"+i+"</option>";
									
									var current = "";
									if(i == ttmonth) current = 'selected';
									eptmonth += "<option value='"+i+"' "+current+">"+i+"</option>";
								}
                				
                				for(i = y; i >= y-60; i--){
                					var current = "";
                					if(i == tfyear) current = 'selected';
									epfyear += "<option value='"+i+"' "+current+">"+i+"</option>";
									
									var current = "";
									if(i == ttyear) current = 'selected';
									eptyear += "<option value='"+i+"' "+current+">"+i+"</option>";
								}
								
                				var todate = "";
                				todate =	"		<div id='epto' " +sto+ ">"+
											"			<select name='etmonth' id='etmonth' class='date'>"+
											"           	<option value='0'>Month</option>"+
															eptmonth + 
											"            </select>"+
										
											"            <select name='etyear' id='etyear' class='date'>"+
											"            	<option value='0'>Year</option>"+
															eptyear +
											"            </select>"+
									    	"        </div>"+
									    	"        <div id='eptopresent' "+spre+">"+
									    	"        	<span>present</span>"+
									    	"        </div>";
									    	
								var shtml = "";
								if(etype == 1){
									var cselect = '';
									for(var i in cpjs ){
										var selected = '';
										var f = cpjs[i];
										if(f['id'] == js['education'][ref]['eduSchool']) selected = 'selected';
										cselect += "<option value='"+f['id']+"' "+selected+">"+f['title']+"</option>";
									}
									shtml	= 	"<label>School</label>"+
												"<select name='eduSchool' class='campus'>"+
													cselect + 
												"</select>"+
												"<div class='clear'></div>";
								}else shtml	= 	"<label>School</label>"+
												"<input name='eduSchool' value='"+tepSchool+"' class='input' id ='eduSchool' />"+
												"<div class='clear'></div>";


                				var html = 	"<form id='projectForm' class='projectForm' ref='"+ref+"'>"+
                							"<div class='"+cclass+"'>"+
                							"<div>"+
                							"	<input type='hidden' name='eduId' value='"+ref+"' />"+
                							"	<input type='hidden' name='eduMain' value='"+etype+"' />"+
                							
                							"	<div id='pfcb'></div>"+
											
                								shtml +
											
											"	<label>Degree</label>"+
											"	<input name='eduDegree' value='"+tepDegree+"' class='input'/>"+
											"	<div class='clear'></div>"+
											
											"	<label>Major</label>"+
											"	<input name='eduMajor' value='"+tepMajor+"' class='input'/>"+
											"	<div class='clear'></div>"+
											
											"	<label>Timeline </label>"+
											"	<input name='epCurrent' class='epcurrent' id='epCurrent' value='current' type='checkbox' "+checked+"><span>Current</span>"+
											"	<div class='clear'></div>"+
											
											"	<div class='epto'>"+
											"		<select name='efmonth' id='efmonth' class='date'>"+
										    "        	<option value='0'>Month</option>"+
										   				epfmonth +			
										    "        </select>"+
										    "        <select name='efyear' id='efyear' class='date'>"+
										    "        	<option value='0'>Year</option>"+
										    			epfyear +
										    "        </select>"+
											"       <span style='margin: 0px 3px;'>to</span>"+		
										    		todate+	
											"	</div>"+
											"	<div class='clear'></div>"+
		
											"	<div class='epoption'>"+
											"		<a id='project_submit' class='ainput' href='javascript:;'>"+
											"			<span>"+ssubmit+"</span>"+
											"		</a>"+
											"		<a id='project_cancel' class='ainput' href='javascript:;'>"+
											"			<span>Cancel</span>"+
											"		</a>"+
											"		<div class='clear'></div>"+
											"	</div>"+
											"	<div class='clear'></div>"+
											"</div>"+
											"<div class='clear'></div>"+
											"</div>"+
											"</form>";
							return html;
                		}
                		
                		
                		function bindEButton(){
                			$('#project_submit').click(function(){
                				var validate = validateWFrom();
                				if(validate > 0){
                					var errorjson = {1:'Title cannot be blank', 2: 'Start time is not valid', 3: 'Finish time is not valid'};
                					var errormessage = "<div class='message' id='message'>"+errorjson[validate]+'</div>'; 
                					$('#pfcb').html(errormessage);
                					setTimeout(function(){
							        	$('#message').toggle("slow", function(){	
											$(this).remove();
										});
							        }, 2000);
                					return false;
                				}
                				vsf.submitForm($('#projectForm'), 'users/editedu', 'pfcb');
                				return false;
                			});
                			
                			$('#project_cancel').click(function(){
								var ref = $('#projectForm').attr('ref');
								$('#e'+ref+' .editings').removeClass('editings');
								
								$('#projectForm').toggle("slow", function(){	
									$('#projectForm').prev().css('display','block');
									$('#projectForm').remove();
								});
                				return false;
                			});
                		}
                		
                		function validateEFrom(){
                			if($('#workTitle').val() == '') return 1;
                			if($('#efmonth').val() == 0 || $('#efyear').val() == 0) return 2;
                			
                			if(!$('#epCurrent').is(':checked')){
                				if($('#etmonth').val() == 0 || $('#etyear').val() == 0) return 3;
                				
                				var nstart = parseInt($('#efyear').val() + $('#efmonth').val());
                				var nend = parseInt($('#etyear').val()+$('#etmonth').val());
                				
                				if(nstart > nend) return 3;
                			}
                			
                			return 0;
                		}
////pandog add edu
                		
                		
                		
                		bindAddEProject();
                		function bindAddEProject(){
							$('.addpro').click(function(){
								var mai = $(this).attr('mai');
								var html = generateEPForm(mai, 0);
												
								
								$('#option'+mai).after(html);
								$('#option'+mai).css('display','none');
								
								bindCurrent();
								bindEPButton();
							});
						}
						
						 		
                		function profilecbtrue_epro_add(newjs){
							var mai = $('#projectForm').attr('mai');
							
							if(js['education'][mai]['projects'] == null) js['education'][mai]['projects'] = {};
                			js['education'][mai]['projects'][newjs['epId']] = newjs;

                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){
					        		var html = generateEP(newjs);
									
									$('#projectForm').toggle("slow", function(){
										$(this).prev().css('display','block');
										$(this).remove();
										
										
										$('#plist'+mai).append(html);
										
										unbindPFEvent();
										bindEditEProject();
                						bindRemoveEProject();
                						return false;
									});
								});
					        }, 2000);
                		}

                		function profilecbfalse_epro_add(){
                			var mai = $('#projectForm').attr('mai');
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){	
		                			$('#projectForm').toggle("slow", function(){
		                				$('#option'+mai).css('display','block');
										$('#projectForm').remove();
										unbindPFEvent();
									});
								});
					        }, 2000);
                		}
                		
						bindEditEProject();
                		function bindEditEProject(){
                			$('.editEP').click(function(){
                				var ref = $(this).attr('ref');
                				var mai = $(this).attr('mai');
                				
								var html = generateEPForm(mai, ref);
                				
								$('#epmainfo'+ref).css('display','none');
								$('#epmainfo'+ref).after(html);
								bindCurrent();
								bindEPButton();
                			});
                		}
                		
                		
                		function profilecbtrue_epro_edit(newjs){
                			var mai = $('#projectForm').attr('mai');
                			var ref = $('#projectForm').attr('ref');
							
                			js['education'][mai]['projects'][ref] = newjs;

                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){
					        		var td = newjs['fmonth'] + '-' + newjs['fyear'] + ' to ';
									
									if(newjs['tmonth'] == null && newjs['tyear'] == null) td += 'present';
									else td += newjs['tmonth'] + '-' + newjs['tyear'];
									
									var ptitle = newjs['epTitle'] + " (" + td + ")";
									$('#epmainfo'+ref+' .ptitle').html(ptitle);
									$('#epmainfo'+ref+' .pdetail').html(newjs['epDetail']);
									
									$('#projectForm').toggle("slow", function(){
										$(this).prev().toggle("slow", function(){
											$(this).css('display','block;');
										});
										$(this).remove();
										unbindPFEvent();
									});
								});
					        }, 2000);
                		}

                		function profilecbfalse_epro_edit(){
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){	
									var ref = $('#projectForm').attr('ref');
		                			$('#projectForm').toggle("slow", function(){	
										$(this).remove();
										$(this).prev().toggle("slow");
										unbindPFEvent();
									});
								});
					        }, 2000);
                		}
						
                		bindRemoveEProject();
                		function bindRemoveEProject(){
                			$('.deleteEP').click(function(){
                				var ref = $(this).attr('ref');
                				var mai = $(this).attr('mai');
                				
                				jConfirm(
									'Are you sure to delete this information?', 
									'Delete a project', 
									function(r){
										if(r){
											$('#epmainfo'+ref).prepend("<div id='rmepcb' mai='"+mai+"' ref='"+ref+"'></div>");
											vsf.get('users/deleteepro/'+ref, 'rmepcb');
											return false;
										}
								});
                			});
                		}
                		
                		function profilecbtrue_epro_remove(){
                			var ref = $('#rmepcb').attr('ref');
                			var mai = $('#rmepcb').attr('mai');
                			
                			delete js['education'][mai]['projects'][ref];
							$('#ep'+ref).toggle("slow", function(){	
								$(this).remove();
							});
                		}
                		
                		function profilecbfalse_epro_remove(){
                			setTimeout(function(){
					        $('#message').toggle("slow", function(){	
									$('#rmepcb').remove();
								});
					        }, 2000);
                		}
                		
						function bindCurrent(){
                			$('#epCurrent').click(function(){
	                			if($(this).is(':checked')){
									$('#epto').css('display','none');
									$('#eptopresent').css('display','inline');
								}else{
									$('#epto').css('display','inline');
									$('#eptopresent').css('display','none');
								}
	                		});
                		}
                		
                		function bindEPButton(){
                			$('#project_submit').click(function(){
                				var validate = validateEPFrom();
                				if(validate > 0){
                					var errorjson = {1:'Title cannot be blank', 2: 'Start time is not valid', 3: 'Finish time is not valid'};
                					var errormessage = "<div class='message' id='message'>"+errorjson[validate]+'</div>'; 
                					$('#pfcb').html(errormessage);
                					setTimeout(function(){
							        	$('#message').toggle("slow", function(){	
											$(this).remove();
										});
							        }, 2000);
                					return false;
                				}
                				vsf.submitForm($('#projectForm'), 'users/editepro', 'pfcb');
                				return false;
                			});
                			
                			$('#project_cancel').click(function(){
								var ref = $('#projectForm').attr('ref');
								$('#projectForm').toggle("slow", function(){	
									$('#projectForm').prev().css('display','block');
									$('#projectForm').remove();
								});
                				return false;
                			});
                		}
                		
                		function unbindPFEvent(){ //unbind project form event
                			$('#epCurrent').unbind('click');
                			$('#project_cancel').unbind('click');
                			$('#project_submit').unbind('click');
                		}
                		
                		function validateEPFrom(){
                			var nstart = parseInt($('#efyear').val() + $('#efmonth').val());
                			
                			if($('#epTitle').val() == '') return 1;
                			if($('#efmonth').val() == 0 || $('#efyear').val() == 0) return 2;
                			
                			if(!$('#epCurrent').is(':checked')){
                				if($('#etmonth').val() == 0 || $('#etyear').val() == 0) return 3;
                				var nend = parseInt($('#etyear').val()+$('#etmonth').val());

                				if(nstart > nend) return 3;
                			}
                			return 0;
                		}
                		
						function generateEPForm(mai, ref){
                				removeAllForm();
						
								var epfmonth = ""; var eptmonth = ""; var epfyear = ""; var eptyear = "";
								var checked = ""; sto = ''; spre = "style='display:none;'";
								var tfmonth = 0, ttmonth = 0, tfyear = 0, ttyear = 0;
								var tepTitle = "", tepDetail = ""; var cclass = "eduproject"; var ssubmit = "Add";
								
								if(ref > 0){
									if(js['education'][mai]['projects'][ref]['epEnd'] == null || js['education'][mai]['projects'][ref]['epEnd'] == ""){
	                					checked = 'checked';
	                					spre=''; sto = "style='display:none;'";
	                				}

									tfmonth 	= js['education'][mai]['projects'][ref]['fmonth'];
									ttmonth 	= js['education'][mai]['projects'][ref]['tmonth'];
									tfyear 		= js['education'][mai]['projects'][ref]['fyear'];
									ttyear 		= js['education'][mai]['projects'][ref]['tyear'];
									
									tepTitle 	= js['education'][mai]['projects'][ref]['epTitle'];
                					tepDetail 	= js['education'][mai]['projects'][ref]['epDetail'];
                					
                					cclass		= ""; ssubmit = "Edit";
	                			}
                				
	                			for(i=1; i<=12; i++){
									var current = "";
									if(i == tfmonth) current = 'selected';
									epfmonth += "<option value='"+i+"' "+current+">"+i+"</option>";
									
									var current = "";
									if(i == ttmonth) current = 'selected';
									eptmonth += "<option value='"+i+"' "+current+">"+i+"</option>";
								}
                				
                				for(i = y; i >= y-60; i--){
                					var current = "";
                					if(i == tfyear) current = 'selected';
									epfyear += "<option value='"+i+"' "+current+">"+i+"</option>";
									
									var current = "";
									if(i == ttyear) current = 'selected';
									eptyear += "<option value='"+i+"' "+current+">"+i+"</option>";
								}
								
                				var todate = "";
                				todate =	"		<div id='epto' " +sto+ ">"+
											"			<select name='etmonth' id='etmonth' class='date'>"+
											"           	<option value='0'>Month</option>"+
															eptmonth + 
											"            </select>"+
										
											"            <select name='etyear' id='etyear' class='date'>"+
											"            	<option value='0'>Year</option>"+
															eptyear +
											"            </select>"+
									    	"        </div>"+
									    	"        <div id='eptopresent' "+spre+">"+
									    	"        	<span>present</span>"+
									    	"        </div>";
									    	
                				
                				var html = 	"<form id='projectForm' class='projectForm' ref='"+ref+"' mai='"+mai+"'>"+
                							"<div class='"+cclass+"'>"+
                							"<div class='formdiv'>"+
                							"	<input type='hidden' name='epId' value='"+ref+"' />"+
                							"	<input type='hidden' name='epEdu' value='"+mai+"' />"+
                							"	<div id='pfcb'></div>"+
											"	<label>Title</label>"+
											"	<input name='epTitle' id='epTitle' value='"+tepTitle+"' class='input'/>"+
											"	<div class='clear'></div>"+
											
											"	<label>Detail</label>"+
											"	<textarea name='epDetail'>"+tepDetail+"</textarea>"+
											"	<div class='clear'></div>"+
											
											"	<label>Timeline</label>"+
											"	<input name='epCurrent' class='epcurrent' id='epCurrent' value='current' type='checkbox' "+checked+"><span>Current</span>"+
											"	<div class='clear'></div>"+
											
											"	<div class='epto'>"+
											"		<select name='efmonth' id='efmonth' class='date'>"+
										    "        	<option value='0'>Month</option>"+
										   				epfmonth +			
										    "        </select>"+
										    "        <select name='efyear' id='efyear' class='date'>"+
										    "        	<option value='0'>Year</option>"+
										    			epfyear +
										    "        </select>"+
											"       <span style='margin: 0px 3px;'>to</span>"+		
										    		todate+	
											"	</div>"+
											"	<div class='clear'></div>"+
		
											"	<div class='epoption'>"+
											"		<a id='project_submit' class='ainput' href='javascript:;'>"+
											"			<span>"+ssubmit+"</span>"+
											"		</a>"+
											"		<a id='project_cancel' class='ainput' href='javascript:;'>"+
											"			<span>Cancel</span>"+
											"		</a>"+
											"		<div class='clear'></div>"+
											"	</div>"+
											"	<div class='clear'></div>"+
											"</div>"+
											"<div class='clear'></div>"+
											"</div>"+
											"</form>";
							return html;
                		}
                		
						
						bindBirthdayEditable();
						function bindBirthdayEditable(){
							$('#birthday').dblclick(function(){
	                			removeAllForm();
	                			
	                			var birthday = js['profileBirthday'];
								var bdarray = birthday.split('-');
								
								var arrayMonth = new Array(31,29,31,30,31,30,31,30,31,30,31,30);
								var date = new Date();
								var y = date.getFullYear();
								
								
								var i; var month = date.getMonth();

								var bdday = "<select name='day' id='day'>";
								for(i=1; i<=arrayMonth[month]; i++){
									var current = '';
									if(i==bdarray[1]) var current = 'selected'; 
									bdday += "<option value='"+i+"' "+current+" >"+i+"</option>";
								}
								bdday += "</select>";
								
								var bdmonth = "<select name='month' id='month'>";
								for(i=1;i<=12;i++){
									var current = "";
									if(i==bdarray[0]) var current = 'selected'; 
									bdmonth += "<option value='"+i+"' " + current +" >"+i+"</option>";
								}
								bdmonth += "<select>";
								
								var bdyear = "<select name='year' id='year'>";
								for(i = y-17; i >= y-70; i--){
									var current = "";
									if(i==bdarray[2]) var current = 'selected'; 
									bdyear += "<option value='"+i+"' " + current +" >"+i+"</option>";
								}
								bdyear += "<select>";
								
	                			var a = $(this).attr('id');
	                			$('#'+a+'detail').css('display','none');
	                			
	                			var iname = $(this).attr('name');
		                		var html = 	"<form id='editFrom' name='"+iname+"' ref='bdtype'>"+
		                					"	<div id='escb'></div>"+
		                				   	"	<input type='hidden' name='a' value='profile' />"+	
		                							bdmonth+
		                							bdday+
		                							bdyear+
											"	<div class='option'>" +
		                					"		<div class='ainput' id='submit'>"+
		                					"			<span>Submit</span>"+
		                					"		</div>"+
		                					"		<div class='ainput' id='cancel'>"+
		                					"			<span>Cancel</span>"+
		                					"		</div>"+
		                					"	<div class='clear'></div>"+
		                					"	</div>"+
		                				   	"</form>";

								$('#'+a+'detail').after(html);
								$(this).unbind('dblclick');
								bindFormButton_profile();
							});
						}
						
						
						bindRSEditable();
						function bindRSEditable(){
							$('#relationship').dblclick(function(){
	                			removeAllForm();
	                			var a = $(this).attr('id');
	                			$('#'+a+'detail').css('display','none');
	                			
	                			var rsopt = ''; var current = '';
	                			for(var i in rsjs){
	                				current = '';
	                				var rs = rsjs[i];
	                				if(rs['id'] == js['profileRS']) current = 'selected';
	                				rsopt += "<option value='"+rs['id']+"' "+current+">"+rs['title']+"</option>";
	                			}
	                			
	                			var iname = $(this).attr('name');
		                		var html = 	"<form id='editFrom' name='"+iname+"' ref='rstype'>"+
		                					"	<div id='escb'></div>"+
		                				   	"	<input type='hidden' name='a' value='profile' />"+	
		                					"	<select name='"+iname+"' id='"+iname+"'>"+
		                							rsopt+
		                					"	</select>"+
											"	<div class='option'>" +
		                					"		<div class='ainput' id='submit'>"+
		                					"			<span>Submit</span>"+
		                					"		</div>"+
		                					"		<div class='ainput' id='cancel'>"+
		                					"			<span>Cancel</span>"+
		                					"		</div>"+
		                					"	<div class='clear'></div>"+
		                					"	</div>"+
		                				   	"</form>";

								$('#'+a+'detail').after(html);
								$(this).unbind('dblclick');
								bindFormButton_profile();
							});
						}
						
						bindInputEditable();
                		function bindInputEditable(){
	                		$('.inputeditable').dblclick(function(){
	                			removeAllForm();
	                			
	                			var a = $(this).attr('id');
	                			var content = $('#'+a+'detail').html();
	                			$('#'+a+'detail').css('display','none');
	                			
	                			if(content == edittext) content = ''; 
	                			
	                			
	                			var iname = $(this).attr('name');
		                		var html = 	"<form id='editFrom' name='"+iname+"' ref='inputtype'>"+
		                					"	<div id='escb'></div>"+
		                				   	"	<input type='hidden' name='a' value='profile' />"+	
		                					"	<input name='"+iname+"' id='"+iname+"' value='"+content+"' />"+
											"	<div class='option'>" +
		                					"		<div class='ainput' id='submit'>"+
		                					"			<span>Submit</span>"+
		                					"		</div>"+
		                					"		<div class='ainput' id='cancel'>"+
		                					"			<span>Cancel</span>"+
		                					"		</div>"+
		                					"	<div class='clear'></div>"+
		                					"	</div>"+
		                				   	"</form>";

								$('#'+a+'detail').after(html);
								$(this).unbind('dblclick');
								bindFormButton_profile();
	                		});
                		}
                		
                		function removeAllForm(ktemp){
                			console.log(typeof(ktemp));
                			if(typeof(ktemp) == 'undefined') ktemp = 0;
                			console.log((ktemp));
                			
                			if(ktemp == 0){
	                			$('.temsn').remove();
	                			$('.temlang').remove();
	                			$('.removed').removeClass('removed');
                			}
                			$('#editFrom').prev().css('display','block');
							$('#editFrom').remove();
							
							$('#projectForm').prev().css('display','block');
							$('#projectForm').remove();
							$('#addworkoption').removeClass('wcon');
							$('#addeduoption').removeClass('econ');
							
							bindAllInfoEditableEvent();
                		};
                		
                		bindTextEditable();
                		function bindTextEditable(){
	                		$('.texteditable').dblclick(function(){
	                			removeAllForm();
	                			
	                			var a = $(this).attr('id');
	                			var content = $('#'+a+'detail').html();
	                			$('#'+a+'detail').css('display','none');
	                			
	                			if(content == edittext) content = '';
	                			else content = content.replace('<br>', ' ');
	                			
	                			
	                			var iname = $(this).attr('name');
		                		var html = 	"<form id='editFrom' name='"+iname+"' ref='texttype'>"+
		                					"	<div id='escb'></div>"+
		                				   	"	<input type='hidden' name='a' value='profile' />"+	
		                					"	<textarea name='"+iname+"' id='"+iname+"'>"+content+"</textarea>"+
											"	<div class='option'>" +
		                					"		<div class='ainput' id='submit'>"+
		                					"			<span>Submit</span>"+
		                					"		</div>"+
		                					"		<div class='ainput' id='cancel'>"+
		                					"			<span>Cancel</span>"+
		                					"		</div>"+
		                					"	<div class='clear'></div>"+
		                					"	</div>"+
		                				   	"</form>";

								$('#'+a+'detail').after(html);
								$(this).unbind('dblclick');
								bindFormButton_profile();
	                		});
                		}
                		
                		function bindFormButton_profile(){
                				$('#submit').click(function(){
                					unbindAllInfoEditableEvent();
									vsf.submitForm($('#editFrom'), 'users/editprofile', 'escb');
									return false;
								});
								
								$('#cancel').click(function(){
									var ref = $('#editFrom').attr('ref');
									switch(ref){
										case 'texttype':
												bindTextEditable();
											break;
										case 'inputtype':
												bindInputEditable();
											break;
										case 'rstype':
												bindRSEditable();
											break;
										case 'bdtype':
												bindBirthdayEditable();
											break;	
									}
									bindAllInfoEditableEvent();
									$('#editFrom').prev().toggle("slow");
									$('#editFrom').remove();
									return false;
								});
                		}
                		
                		function profilecbtrue_profile(){
                			var nname = $('#editFrom').attr('name');
                			var ref = $('#editFrom').attr('ref');
                			
                			setTimeout(function(){
					        	$('#escb').toggle("slow", function(){
					        		
					        		var ncontent = '';
									switch(ref){
										case 'texttype':
												ncontent = $('#'+nname).val();
												ncontent = ncontent.replace('\\n', '<br>');
												js[nname] = ncontent;
											break;
										case 'inputtype':
												ncontent = $('#'+nname).val();
												ncontent = ncontent.replace('\\n', '<br>');
												js[nname] = ncontent;
											break;
										case 'rstype':
												ncontent = $('#'+nname).val();
												js[nname] = ncontent;
												ncontent = rsjs[ncontent]['title'];
											break;
										case 'bdtype':
												ncontent = $('#month').val()+"-"+$('#day').val()+"-"+$('#year').val();
												js[nname] = ncontent;
											break;
									}
									
									bindAllInfoEditableEvent();
					        		$('#editFrom').prev().html(ncontent);
									$('#editFrom').prev().toggle("slow");
									
									$('#editFrom').remove();
								});
					        }, 2000);
                		}
                		
                		function profilecbfalse_profile(){
                			setTimeout(function(){
					        	$('#escb').toggle("slow", function(){
									$('#editFrom').prev().toggle("slow");
									$('#editFrom').remove();
								});
					        }, 2000);
                		}
                		
                		function bindAllInfoEditableEvent(){
                			bindTextEditable();
                			bindInputEditable();
                			bindRSEditable();
                			bindBirthdayEditable();
                		}
                		
                		function unbindAllInfoEditableEvent(){
                			$('.inputeditable').unbind('dblclick');
                			$('.texteditable').unbind('dblclick');
                			
                			$('#relationship').unbind('dblclick');
							$('#birthday').unbind('dblclick');
                		}
                		
                		
////////////////SN
						
		        		bindSN();
                		function bindSN(){
                			$('#sn .snitem').bind('keypress', function(e) {
	                			var code = (e.keyCode ? e.keyCode : e.which);
	                			
								if(code == 13) {
									snindex++;
									
									removeAllForm(1);
									var ref = $(this).attr('ref');
									
									if($('#sn'+ref).val() != ""){
										$('#loption').remove();
										
										$(this).css('display','none');
										$(this).addClass('temsn');

										var objAppend = "<div class='sndiv temsn' ref='"+ref+"' id='view"+ref+"'>"+
														"<span class='snvalue'>"+$('#sn'+ref).val()+"</span>"+
														"<span class='sntype'>"+$('#snt'+ref).val()+"</span>"+
														"<span onclick='removeSN("+ref+")' name='"+ref+"' class='rmsn'>X</span>"+
														"<div class='clear'></div>"
														"</div>";
										$('#sn').append(objAppend);
										
										var objAppend = "<div class='snitem' ref='"+snindex+"' id='main"+snindex+"'>"+
											        	"	<input name='sn["+snindex+"][value]' class='sn input' value='' id='sn"+snindex+"' />"+
											        	"	<select name='sn["+snindex+"][type]' id='snt"+snindex+"' >"+
											        	"		<option value='yahoo'>Yahoo</option>"+
											        	"		<option value='skype'>Skype</option>"+
											        	"		<option value='aim'>AIM</option>"+
											        	"		<option value='msn'>MSN</option>"+
											        	"	</select>"+
											        	"	<div class='clear'></div>"+
										        		"</div>"+
										        		"<div id='loption' class='temsn'>"+
														"	<div class='ainput' id='submit'>"+
														"		<span>Changes</span>"+
														"	</div>"+
														"	<div class='ainput' id='cancel'>"+
														"		<span>Cancel</span>"+
														"	</div>"+
														"</div>";
										
										$('#sn').append(objAppend);
										bindFormButton_profile_sn();
										$('.snitem .input:last').focus();
										bindSN();
									}
									else return false;
								}
							});
						}
						
						function bindFormButton_profile_sn(){
                				$('#submit').click(function(){
                					var iform = "<div class='clear'></div>"+
                								"<div class='temsn clear'>"+
                								"	<div id='escb' style='margin-top: 10px;'></div>"+
                								"	<form id='editFrom' ref='sntype' style='display:none'>"+
                								"		<input type='hidden' name='a' value='psns' style='display:none'/>"+
                								"	</form>"+
                								"</div>";
                					$('#loption').append(iform);
                					
                					unbindAllInfoEditableEvent();
									$("#sn .snitem").each(function(){
										if($(this).css('display') == 'none' && !$(this).hasClass('removed'))
											$('#editFrom').append($(this).clone());
                					});
                					$('#submit').unbind('click');
                					
                					
                					vsf.submitForm($('#editFrom'), 'users/editprofile', 'escb');
									return false;
								});
								
								$('#cancel').click(function(){
									$('#loption').remove();
									$('#sn .temsn').remove();
									$('#sn .removed').removeClass('removed');
									return false;
								});
                		}
                		
                		function profilecbtrue_psns(){
                			setTimeout(function(){
					        	$('#escb').toggle("slow", function(){
									$('#loption').remove();
								});
								bindAllInfoEditableEvent();
					        }, 2000);
					        
					        $('.temsn').removeClass('temsn');
					        $('.removed').remove();
                		}
                		
                		function profilecbfalse_psns(){
                			setTimeout(function(){
					        	$('#escb').toggle("slow", function(){
									 $('.temsn').remove();
									 $('.removed').removeClass('removed');
									 bindAllInfoEditableEvent();
								});
					        }, 2000);
                		}
						
                		
                		
                		function removeSN(name){
							if($('#sn #loption').length == 0){
								removeAllForm();
								var objAppend = "<div class='clear'></div>"+
												"<div id='loption' class='temsn'>"+
												"	<div class='ainput' id='submit'>"+
												"		<span>Changes</span>"+
												"	</div>"+
												"	<div class='ainput' id='cancel'>"+
												"		<span>Cancel</span>"+
												"	</div>"+
												"	<div class='clear'></div>"+
												"</div>";
								
								$('#sn').append(objAppend);
								bindFormButton_profile_sn();
							}
							$("#main"+name).addClass('removed');
							$("#view"+name).addClass('removed');
						}
						
						
						
/////////////////////Languages						
						
						bindEditLanguage();
                		function bindEditLanguage(){
                			$('#languagediv input.lang').bind('keypress', function(e) {
	                			var code = (e.keyCode ? e.keyCode : e.which);
								if(code == 13) {
									if($(this).val() != ""){
										lindex++;
										$('#loption').remove();
										
										removeAllForm(1);
										
										$(this).css('display','none');
										$(this).addClass('temlang');
										
										var langid = $(this).attr('ref');
										var objAppend = "<div class='langdiv temlang' name='"+langid+"' id='div"+langid+"'>"+$(this).val()+
														"	<span onclick='removeLang("+langid+")' name='"+$(this).attr('id')+"'>X</span>"+
														"</div>";
										$('#languagediv').append(objAppend);

										
										var objAppend = "<input name='lang["+(lindex)+"]' id='lang"+(lindex)+"' class='lang' ref='"+langid+"' />"+
														"<div id='loption' class='temlang'>"+
														"	<div class='ainput' id='submit'>"+
														"		<span>Changes</span>"+
														"	</div>"+
														"	<div class='ainput' id='cancel'>"+
														"		<span>Cancel</span>"+
														"	</div>"+
														"</div>";
										
										$('#languagediv').append(objAppend);
										bindFormButton_profile_language();
										$('.lang:last').focus();
										bindEditLanguage();
									}
									else return false;
								}
							});
						}
                	
						function removeLang(name){
							if($('#languagediv #loption').length == 0){
								removeAllForm();
								var objAppend = "<div class='clear'></div>"+
												"<div id='loption' class='temlang'>"+
												"	<div class='ainput' id='submit'>"+
												"		<span>Changes</span>"+
												"	</div>"+
												"	<div class='ainput' id='cancel'>"+
												"		<span>Cancel</span>"+
												"	</div>"+
												"	<div class='clear'></div>"+
												"</div>";
								
								$('#languagediv').append(objAppend);
								bindFormButton_profile_language();
							}
							$("#lang"+name).addClass('removed');
							$("#div"+name).addClass('removed');
						}
						
						function bindFormButton_profile_language(){
                				$('#submit').click(function(){
                					var iform = "<div class='clear'></div>"+
                								"<div class='temlang clear'>"+
                								"	<div id='escb' style='margin-top: 10px;'></div>"+
                								"	<form id='editFrom' ref='ltype' style='display:none'>"+
                								"		<input type='hidden' name='a' value='planguages' style='display:none'/>"+
                								"	</form>"+
                								"</div>";
                					$('#loption').append(iform);
                					
									$("#languagediv :input").each(function(){
										if($(this).css('display') == 'none' && !$(this).hasClass('removed'))
											$('#editFrom').append($(this).clone());
                					});
                					
                					unbindAllInfoEditableEvent();
                					vsf.submitForm($('#editFrom'), 'users/editprofile', 'escb');
									return false;
								});
								
								$('#cancel').click(function(){
									$('#loption').remove();
									$('#languagediv .temlang').remove();
									return false;
								});
                		}
                		
                		function profilecbtrue_planguages(){
                			setTimeout(function(){
					        	$('#escb').toggle("slow", function(){
					        		var llast = $('#languagediv input.lang:last');
					        		
					        		$(llast).val(''); $(llast).focus();
									
									$('#loption').remove();
								});
								bindAllInfoEditableEvent();
					        }, 2000);
					        $('.temlang').removeClass('temlang');
					        $('.removed').remove();
                		}
                		
                		function profilecbfalse_planguages(){
                			setTimeout(function(){
					        	$('#escb').toggle("slow", function(){
									 $('.temlang').remove();
									 $('.removed').removeClass('removed');
								});
								bindAllInfoEditableEvent();
					        }, 2000);
                		}