var date = new Date();
						var y = date.getFullYear();
						
                		generateWorkTabHTML();
                		function generateWorkTabHTML(){
                			var workhtml = generateWorkHTML();
                			var html = 	"<div class='proTitle'>Work Experience</div>"+
                						"	<div style='margin-top: 10px;'>"+
                						"		<div id='addwork' pan='normalschool' >"+
			                			"			<div id='optionaddwork'>"+
						                "				<a class='ainput' href='javascript:;'>"+
										"					<span>Add Campany</span>"+
										"				</a>"+
										"				<div class='clear'></div>"+
										"			</div>"+
										"		</div>"+
                								workhtml +
                						"	</div>"+
                						"</div>";
                			
                			$('#work-contain').html(html);
                		}
                		
                		$('#optionaddwork').click(function(){
							var html = generateWForm(0);

							
							$(this).after(html);
							$(this).css('display', 'none');
							
							bindWCurrent();
							bindWButton();
						});
                		
						function profilecbtrue_work_add(newjs){
                			workjs[newjs['workId']] = newjs;
				
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){
					        		var html = generateWork(newjs, '');
												
												
									$('#projectForm').toggle("slow", function(){
										$('#projectForm').prev().css('display','block');
										$('#projectForm').remove();
										
										$('#addwork').after(html);
										
										unbindWPFEvent();
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
										unbindWPFEvent();
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
								removeWHover(ref);
								
								bindWCurrent();
								bindWButton();
                			});
                		}
                		
                		function profilecbtrue_work_edit(newjs){
                			var ref = $('#projectForm').attr('ref');
                			$.extend(workjs[ref], newjs);
                			
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){	
									var title = newjs['workTitle'];
									
									$('#wdetail'+ref+' .etitle').html(title);
									
									
									var td = newjs['fmonth'] + '-' + newjs['fyear'] + ' to ';
									
									if(newjs['tmonth'] == null && newjs['tyear'] == null) td += 'present';
									else td += newjs['tmonth'] + '-' + newjs['tyear'];
									
									var emore = "";
									if(newjs['workCompany']) emore += newjs['workCompany'];
									emore += ' ('+td+')';

									
									$('#wdetail'+ref+' .emore').html(emore);
									
									$('#projectForm').toggle("slow", function(){
										$('#projectForm').remove();
										
										$('#wdetail'+ref).toggle("slow", function(){
											$(this).css('display','block;');
										});
										
										$('#w'+ref+' .winfo').removeClass('editings');
										unbindWPFEvent();
									});
								});
					        }, 2000);
                		}
                		
                		function profilecbfalse_work_edit(){
                			var ref = $('#projectForm').attr('ref');
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){	
		                			$('#projectForm').toggle("slow", function(){
										$('#projectForm').remove();
										$('#edetail'+ref).toggle("slow");
										unbindWPFEvent();
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
                					if(!$(this).hasClass('editings')){
	                					var ref = $(this).attr('ref');
	                					$(this).addClass('bgremove');
	                					var rm = "<div class='poption'><span class='deleteWork' ref='"+ref+"'>X</spann>";
	                					$(this).prepend(rm);
	                					bindDeleteWork();
	                				}
	                			},
	                			function(){
	                				if(!$(this).hasClass('editconfirm')){
		                				$(this).removeClass('bgremove');
		                				
		                				$(this).children().each(function(){
		                					if($(this).hasClass('poption')){
		                						$(this).remove();
		                					}
		                				});
		                				
		                				$(this).bind('dblclick');
		                			}
	                			}
	                		);
                		}
                		
						function removeWHover(ref){
							$('#w'+ref+' .winfo').removeClass('editconfirm');
							$('#w'+ref+' .winfo').removeClass('bgremove');
							$('#w'+ref+' .poption').remove();
						}
                		
						function bindDeleteWork(){
                			$('.deleteWork').click(function(){
                				var ref = $(this).attr('ref');
                				$('#w'+ref+' .winfo').addClass('editconfirm');

                				jConfirm(
            						'Are you sure to delete', 
									'Dialog board', 
									function(r){
										if(r){
											$('#wdetail'+ref).prepend("<div id='rmepcb' ref='"+ref+"'></div>");
											vsf.get('users/deletework/'+ref, 'rmepcb');
											return false;
										}else{
											removeWHover(ref);
											$('#w'+ref+' .einfo').bind('dblclick');
											return false;
										}
								});
                			});
						}
						
						function profilecbtrue_work_remove(){
                			var ref = $('#rmepcb').attr('ref');

                			delete workjs[ref];
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
                		
						function generateWForm(ref){
                				$('#projectForm').prev().css('display','block');
								$('#projectForm').remove();
						
								var epfmonth = ""; var eptmonth = ""; var epfyear = ""; var eptyear = "";
								var checked = ""; sto = ''; spre = "style='display:none;'";
								var tfmonth = 0, ttmonth = 0, tfyear = 0, ttyear = 0;
								var tepTitle = "", tepCampany = "";
								var cclass = "workproject"; var ssubmit = "Add";
								
								if(ref > 0){
									if(workjs[ref]['workEnd'] == null || workjs[ref]['workEnd'] == ""){
	                					checked = 'checked';
	                					spre=''; sto = "style='display:none;'";
	                				}

									tfmonth 	= workjs[ref]['fmonth'];
									ttmonth 	= workjs[ref]['tmonth'];
									tfyear 		= workjs[ref]['fyear'];
									ttyear 		= workjs[ref]['tyear'];
									
									tepTitle 	= workjs[ref]['workTitle'];
                					tepCampany 	= workjs[ref]['workCompany'];
                					
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
                							"<div class='pinfo'>"+
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
						
                		function generateWork(f, wphtml){
                				var epend = "present";
				        		if(f['workEnd']) epend = f['workEnd'];
								
				        		var emore = '';
				        		if(f['workCompany'] != '') emore = f['workCompany'] + ", ";
								
				        		emore += "("+ f['workStart'] + " to " + epend + ")";
				        		
                				return 		"<div id='w"+f['workId']+"' class='econ'>"+
				        					"	<div class='winfo' ref='"+f['workId']+"'>"+
											"		<div id='wdetail"+f['workId']+"' class='winfodiv' ref='"+f['workId']+"'>"+	
				        					"			<span class='etitle'>"+f['workTitle']+"</span>"+
											"			<div class='emore'>"+
															emore +
											"			</div>"+
											"		</div>"+
											"		<div class='clear'></div>"+
											"	</div>"+
											"	<div class='pcontainer'>"+
											"		<div class='pctitle'>Projects</div>"+
											"		<div id='wplist"+f['workId']+"'>"+
														wphtml +
											"		</div>"+
											"		<div id='addwprocon"+f['workId']+"'>"+
											"			<div id='woption"+f['workId']+"' class='option' ref='"+f['workId']+"'>"+
											"				<a class='addwpro' mai='"+f['workId']+"' href='javascript:;' >"+
											"					Add project"+
											"				</a>"+
											"				<div class='clear'></div>"+
											"			</div>"+
											"		</div>"+
											"	</div>"+
											"</div>";
                		}
                		
                		function generateWP(p){
                					var epend = "present";
					        		if(p['wpEnd']) epend = p['wpEnd'];
					        		
                					return 	"<div id='wp"+p['wpId']+"' class='workproject'>"+
				        					"	<div id='wpinfo"+p['wpId']+"' class='pinfo' ref='"+p['wpId']+"'>"+
											"	<div id='wpmainfo"+p['wpId']+"'>"+	
				        					"			<div class='ptitle'>"+p['wpTitle']+"</div>"+
											"			<div class='ptime'>"+
															p['wpStart'] + " to " +
															epend +
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
                			
	              			for(var f in workjs ){
                				var wphtml = '';
                				if(workjs[f]['projects'] != null)
	                				for(var p in workjs[f]['projects'])
	                					wphtml += generateWP(workjs[f]['projects'][p]);
                				html += generateWork(workjs[f], wphtml);
							}
							return html;
                		}
                		
//////
						bindAddWProject();
                		function bindAddWProject(){
							$('.addwpro').click(function(){
								var mai = $(this).attr('mai');
								var html = generateWPForm(mai, 0);
												
								
								$('#woption'+mai).after(html);
								$('#woption'+mai).css('display','none');
								
								bindWCurrent();
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
							if(workjs[mai]['projects'] == null) workjs[mai]['projects'] = {};
                			workjs[mai]['projects'][newjs['wpId']] = newjs;
                			
                			var html = '';
                			html = generateWP(newjs);
                			
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){
									$('#projectForm').toggle("slow", function(){
										$('#projectForm').prev().css('display','block');
										$('#projectForm').remove();
										
										$('#wplist'+mai).append(html);
										
										unbindWPFEvent();
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
										unbindWPFEvent();
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
								
								bindWCurrent();
								bindWPButton();
                			});
                		}
                		
                		function profilecbtrue_wpro_edit(newjs){
                			var mai = $('#projectForm').attr('mai');
                			var ref = $('#projectForm').attr('ref');
							
                			workjs[mai]['projects'][ref] = newjs;

                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){	
									$('#wpmainfo'+ref+' .ptitle').html(newjs['wpTitle']);
									$('#wpmainfo'+ref+' .pdetail').html(newjs['wpDetail']);
									
									var td = newjs['fmonth'] + '-' + newjs['fyear'] + ' to ';
									
									if(newjs['tmonth'] == null && newjs['tyear'] == null) td += 'present';
									else td += newjs['tmonth'] + '-' + newjs['tyear'];
									
									$('#wpmainfo'+ref+' .ptime').html(td);
									
									$('#projectForm').toggle("slow", function(){
										$('#projectForm').remove();
										$('#wpmainfo'+ref).toggle("slow", function(){
											$(this).css('display','block;');
										});
										unbindWPFEvent();
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
										unbindWPFEvent();
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
            						'Are you sure to delete', 
									'Dialog board',
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

                			delete workjs[mai]['projects'][ref];
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
                				$('#projectForm').prev().css('display','block');
								$('#projectForm').remove();
						
								var epfmonth = ""; var eptmonth = ""; var epfyear = ""; var eptyear = "";
								var checked = ""; sto = ''; spre = "style='display:none;'";
								var tfmonth = 0, ttmonth = 0, tfyear = 0, ttyear = 0;
								var tepTitle = "", tepDetail = ""; var cclass = "eduproject"; var ssubmit = "Add";
								
								if(ref > 0){
									if(workjs[mai]['projects'][ref]['wpEnd'] == null || workjs[mai]['projects'][ref]['wpEnd'] == ""){
	                					checked = 'checked';
	                					spre=''; sto = "style='display:none;'";
	                				}

									tfmonth 	= workjs[mai]['projects'][ref]['fmonth'];
									ttmonth 	= workjs[mai]['projects'][ref]['tmonth'];
									tfyear 		= workjs[mai]['projects'][ref]['fyear'];
									ttyear 		= workjs[mai]['projects'][ref]['tyear'];
									
									tepTitle 	= workjs[mai]['projects'][ref]['wpTitle'];
                					tepDetail 	= workjs[mai]['projects'][ref]['wpDetail'];
                					
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
                							"<div class='pinfo'>"+
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
                		
                		
                		function bindWCurrent(){
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
                		
                		function unbindWPFEvent(){
                			$('#epCurrent').unbind('click');
                			$('#project_cancel').unbind('click');
                			$('#project_submit').unbind('click');
                		}