						var date = new Date();
						var y = date.getFullYear();
						
                		function generateEForm(pan, ref, etype){
                				$('#projectForm').prev().css('display','block');
								$('#projectForm').remove();
						
								var epfmonth = ""; var eptmonth = ""; var epfyear = ""; var eptyear = "";
								var checked = ""; sto = ''; spre = "style='display:none;'";
								var tfmonth = 0, ttmonth = 0, tfyear = 0, ttyear = 0;
								var tepSchool = "", tepDegree = "", tepMajor = "";
								var cclass = "eduproject"; var ssubmit = "Add";
								
								if(ref > 0){
									if(edujs[pan][ref]['eduEnd'] == null || edujs[pan][ref]['eduEnd'] == ""){
	                					checked = 'checked';
	                					spre=''; sto = "style='display:none;'";
	                				}

									tfmonth 	= edujs[pan][ref]['fmonth'];
									ttmonth 	= edujs[pan][ref]['tmonth'];
									tfyear 		= edujs[pan][ref]['fyear'];
									ttyear 		= edujs[pan][ref]['tyear'];
									
									tepSchool 	= edujs[pan][ref]['eduSchool'];
									
									
									if(edujs[pan][ref]['eduDegree'] != null) tepDegree 	= edujs[pan][ref]['eduDegree'];
                					if(edujs[pan][ref]['eduMajor'] != null) tepMajor = edujs[pan][ref]['eduMajor'];
                					
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
									for( f in campusjs ){
										var selected = '';
										if(campusjs[f]['campusId'] == edujs[pan][ref]['eduSchool']) selected = 'selected';
										cselect += "<option value='"+campusjs[f]['campusId']+"' "+selected+">"+campusjs[f]['campusTitle']+"</option>";
									}
									shtml	= 	"<label>School</label>"+
												"<select name='eduSchool' class='campus'>"+
													cselect + 
												"</select>"+
												"<div class='clear'></div>";
								}else{
									shtml	= 	"<label>School</label>"+
												"<input name='eduSchool' value='"+tepSchool+"' class='input' id ='eduSchool' />"+
												"<div class='clear'></div>";
								}
								
                				var html = 	"<form id='projectForm' class='projectForm' ref='"+ref+"' pan='"+pan+"'>"+
                							"<div class='"+cclass+"'>"+
                							"<div class='pinfo'>"+
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
                		
                		bindHoverSchool();
                		function bindHoverSchool(){
                			$('.einfo').unbind('mouseenter mouseleave');
                			$('.einfo').hover(
                				function(){
                					if(!$(this).hasClass('editings')){
	                					var ref = $(this).attr('ref');
	                					var pan = $(this).attr('pan');
	                					if(pan != 'mainschool'){
		                					var rm = "<div class='poption'><span class='deleteSchool' ref='"+ref+"' pan='"+pan+"'>X</spann>";
		                					$(this).prepend(rm);
		                					bindDeleteSchool();
		                				}
	                				}
	                			},
	                			function(){
	                				if(!$(this).hasClass('editconfirm')){
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
                		
                		function bindDeleteSchool(){
                			$('.deleteSchool').click(function(){
                				var ref = $(this).attr('ref');
                				var pan = $(this).attr('pan');
                				
                				$('#'+ref+' .einfo').addClass('editconfirm');

                				jConfirm(
									'Are you sure to delete', 
									'Dialog board', 
									function(r){
										if(r){
											$('#edetail'+ref).prepend("<div id='rmepcb' ref='"+ref+"' pan='"+pan+"'></div>");
											vsf.get('users/deleteedu/'+ref, 'rmepcb');
											return false;
										}
									}
								);
                			});
						}
						
						function profilecbtrue_edu_remove(){
                			var ref = $('#rmepcb').attr('ref');
                			var pan = $('#rmepcb').attr('pan');

                			delete edujs[pan][ref];
							$('#'+ref).toggle("slow", function(){	
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
						
						function removeHover(ref){
							$('#'+ref+' .einfo').removeClass('editconfirm');
							$('#'+ref+' .poption').remove();
						}
						
                		bindEditSchool();
                		function bindEditSchool(){
                			$('.einfodiv').dblclick(function(){
                				var pan = $(this).attr('pan');
								var ref = $(this).attr('ref');
								
								var etype = 0;
								if(pan == 'mainschool') etype = 1;
								
								var html = generateEForm(pan, ref, etype);
								
								$('#edetail'+ref).after(html);
								$('#edetail'+ref).css('display', 'none');
								
								
								$('#'+ref+' .einfo').addClass('editings');
								removeHover(ref);
								bindCurrent();
								bindEButton();
                			});
                		}
                		
                		function validateEFrom(){
                			if($('#eduSchool').val() == '') return 1;
                			if($('#efmonth').val() == 0 || $('#efyear').val() == 0) return 2;
                			
                			if(!$('#epCurrent').is(':checked')){
                				if($('#etmonth').val() == 0 || $('#etyear').val() == 0) return 3;
                				
                				var nstart = parseInt($('#efyear').val() + $('#efmonth').val());
                				var nend = parseInt($('#etyear').val()+$('#etmonth').val());
                				
                				if(nstart > nend) return 3;
                			}
                			return 0;
                		}
                		
                		function bindEButton(){
                			$('#project_submit').click(function(){
                				var validate = validateEFrom();
                				if(validate > 0){
                					var errorjson = {1:'School cannot be blank', 2: 'Start time is not valid', 3: 'Finish time is not valid'};
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
								$('#projectForm').toggle("slow", function(){	
									$('#projectForm').prev().css('display','block');
									$('#projectForm').remove();
									
									$('#'+ref+' .einfo').removeClass('editings');
								});
                				return false;
                			});
                		}
                		
                			
                		function profilecbtrue_edu_edit(newjs){
                			var ref = $('#projectForm').attr('ref');
							var pan = $('#projectForm').attr('pan');
							
                			$.extend(edujs[pan][ref], newjs);
                			
                			
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){	
									var title = newjs['eduSchool'];
									if(newjs['eduMain'] == 1){
										for(f in campusjs){
											if(campusjs[f]['campusId'] == title) title = campusjs[f]['campusTitle'];
										}
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
										$('#'+ref+' .einfo').removeClass('editings');
										unbindPFEvent();
									});
								});
					        }, 2000);
                		}
                		
                		function profilecbfalse_edu_edit(){
                			var ref = $('#projectForm').attr('ref');
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
                		
                		$('.addschool').click(function(){
							var pan = $(this).attr('pan');
							
							var etype = 0;
							if(pan == 'mainschool') etype = 1;
							
							var html = generateEForm(pan, 0, etype);

							
							$('#optionaddschool').after(html);
							$('#optionaddschool').css('display', 'none');
							
							bindCurrent();
							bindEButton();
						});
                		
						function profilecbtrue_edu_add(newjs){
							var pan = $('#projectForm').attr('pan');
					
							if(typeof(edujs[pan]) == 'undefined') edujs[pan] = {};
                			edujs[pan][newjs['eduId']] = newjs;
				
                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){
					        		var epend = "present";
					        		if(newjs['eduEnd']) epend = newjs['eduEnd'];
									
					        		var emore = '';
					        		if(newjs['eduDegree'] != '') emore = newjs['eduDegree'] + ", ";
					        		if(newjs['eduMajor'] != '') emore += newjs['eduMajor'] + " ";
									
					        		emore += "("+ newjs['eduStart'] + " to " + epend + ")";
					        		
					        		var html =  "<div id='"+newjs['eduId']+"' class='econ'>"+
					        					"	<div class='einfo' ref='"+newjs['eduId']+"' pan='"+pan+"'>"+
												"		<div id='edetail"+newjs['eduId']+"' class='einfodiv' pan='"+pan+"' ref='"+newjs['eduId']+"'>"+	
					        					"			<span class='etitle'>"+newjs['eduSchool']+"</span>"+
												"			<div class='emore'>"+
																emore +
												"			</div>"+
												"		</div>"+
												"		<div class='clear'></div>"+
												"	</div>"+
												"	<div class='pcontainer'>"+
												"		<div class='pctitle'>Projects</div>"+
												"		<div id='plist"+newjs['eduId']+"'></div>"+
												"		<div class='addprocon"+newjs['eduId']+"'>"+
												"			<div id='option"+newjs['eduId']+"' class='option' ref='"+newjs['eduId']+"'>"+
												"				<a class='addpro' pan='"+pan+"' mai='"+newjs['eduId']+"' href='javascript:;' >"+
												"					Add project"+
												"				</a>"+
												"				<div class='clear'></div>"+
												"			</div>"+
												"		</div>"+
												"	</div>"+
												"</div>";
												
												
									$('#projectForm').toggle("slow", function(){
										$('#projectForm').prev().css('display','block');
										$('#projectForm').remove();
										
										$('#addschool').after(html);
										
										unbindPFEvent();
										bindHoverSchool();
										bindEditSchool();
										bindAddProject();
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
//education projects                		
                		function generateEPForm(mai, pan, ref){
                				$('#projectForm').prev().css('display','block');
								$('#projectForm').remove();
						
								var epfmonth = ""; var eptmonth = ""; var epfyear = ""; var eptyear = "";
								var checked = ""; sto = ''; spre = "style='display:none;'";
								var tfmonth = 0, ttmonth = 0, tfyear = 0, ttyear = 0;
								var tepTitle = "", tepDetail = ""; var cclass = "eduproject"; var ssubmit = "Add";
								
								if(ref > 0){
									if(edujs[pan][mai]['projects'][ref]['epEnd'] == null || edujs[pan][mai]['projects'][ref]['epEnd'] == ""){
	                					checked = 'checked';
	                					spre=''; sto = "style='display:none;'";
	                				}

									tfmonth 	= edujs[pan][mai]['projects'][ref]['fmonth'];
									ttmonth 	= edujs[pan][mai]['projects'][ref]['tmonth'];
									tfyear 		= edujs[pan][mai]['projects'][ref]['fyear'];
									ttyear 		= edujs[pan][mai]['projects'][ref]['tyear'];
									
									tepTitle 	= edujs[pan][mai]['projects'][ref]['epTitle'];
                					tepDetail 	= edujs[pan][mai]['projects'][ref]['epDetail'];
                					
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
									    	
                				
                				var html = 	"<form id='projectForm' class='projectForm' ref='"+ref+"' mai='"+mai+"' pan='"+pan+"'>"+
                							"<div class='"+cclass+"'>"+
                							"<div class='pinfo'>"+
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
                		
                		bindAddProject();
                		function bindAddProject(){
							$('.addpro').click(function(){
								var pan = $(this).attr('pan');
								var mai = $(this).attr('mai');
								
								var html = generateEPForm(mai, pan, 0);
												
								
								$('#option'+mai).after(html);
								$('#option'+mai).css('display','none');
								
								bindCurrent();
								bindEPButton();
							});
						}
                			
                			
						function validateEPFrom(){
                			if($('#epTitle').val() == '') return 1;
                			if($('#efmonth').val() == 0 || $('#efyear').val() == 0) return 2;
                			
                			if(!$('#epCurrent').is(':checked')){
                				if($('#etmonth').val() == 0 || $('#etyear').val() == 0) return 3;
                				
                				var nstart = parseInt($('#efyear').val() + $('#efmonth').val());
                				var nend = parseInt($('#etyear').val()+$('#etmonth').val());

                				if(nstart > nend) return 3;
                			}
                			return 0;
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
                		
                		function unbindPFEvent(){
                			$('#epCurrent').unbind('click');
                			$('#project_cancel').unbind('click');
                			$('#project_submit').unbind('click');
                		}
                		
                		function profilecbtrue_epro_add(newjs){
							var mai = $('#projectForm').attr('mai');
							var pan = $('#projectForm').attr('pan');
							
							if(edujs[pan][mai]['projects'] == null) edujs[pan][mai]['projects'] = {};
                			edujs[pan][mai]['projects'][newjs['epId']] = newjs;

                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){
					        		var epend = "present";
					        		if(newjs['epEnd']) epend = newjs['epEnd'];
									
					        		var html =  "<div id='p"+newjs['epId']+"' class='eduproject'>"+
					        					"	<div id='pinfo"+newjs['epId']+"' class='pinfo' ref='"+newjs['epId']+"' pan='"+pan+"'>"+
												"	<div id='mainfo"+newjs['epId']+"'>"+	
					        					"			<div class='ptitle'>"+newjs['epTitle']+"</div>"+
												"			<div class='ptime'>"+
																newjs['epStart'] + " to " +
																epend +
												"			</div>"+
												"			<div class='pdetail'>"+newjs['epDetail']+"</div>"+
												"		</div>"+
												"	</div>"+
												"	<div class='poption'>"+
												"		<span class='editP' ref='"+newjs['epId']+"' pan='"+pan+"' mai='"+newjs['epEdu']+"'>Edit</span>"+
												"		<span class='deleteP' ref='"+newjs['epId']+"' pan='"+pan+"' mai='"+newjs['epId']+"'>X</span>"+
												"	</div>"+
												"	<div class='clear'></div>"+
												"</div>";
									
									$('#projectForm').toggle("slow", function(){
										$('#projectForm').prev().css('display','block');
										$('#projectForm').remove();
										
										
										$('#plist'+mai).append(html);
										
										unbindPFEvent();
										bindEditProject();
                						bindRemoveProject();
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
                		
                		bindEditProject();
                		function bindEditProject(){
                			$('.editP').click(function(){
                				var ref = $(this).attr('ref');
                				var pan = $(this).attr('pan');
                				var mai = $(this).attr('mai');
                				
								var html = generateEPForm(mai, pan, ref);
                				
								$('#mainfo'+ref).css('display','none');
								$('#mainfo'+ref).after(html);
								bindCurrent();
								bindEPButton();
                			});
                		}
                		
                		function profilecbtrue_epro_edit(newjs){
                			var mai = $('#projectForm').attr('mai');
                			var ref = $('#projectForm').attr('ref');
							var pan = $('#projectForm').attr('pan');
							
                			edujs[pan][mai]['projects'][ref] = newjs;

                			setTimeout(function(){
					        	$('#message').toggle("slow", function(){	
									$('#mainfo'+ref+' .ptitle').html(newjs['epTitle']);
									$('#mainfo'+ref+' .pdetail').html(newjs['epDetail']);
									
									var td = newjs['fmonth'] + '-' + newjs['fyear'] + ' to ';
									
									if(newjs['tmonth'] == null && newjs['tyear'] == null) td += 'present';
									else td += newjs['tmonth'] + '-' + newjs['tyear'];
									
									$('#mainfo'+ref+' .ptime').html(td);
									
									$('#projectForm').toggle("slow", function(){
										$('#projectForm').remove();
										$('#mainfo'+ref).toggle("slow", function(){
											$(this).css('display','block;');
										});
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
										$('#projectForm').remove();
										$('#mainfo'+ref).toggle("slow");
										unbindPFEvent();
									});
								});
					        }, 2000);
                		}
						
                		bindRemoveProject();
                		function bindRemoveProject(){
                			$('.deleteP').click(function(){
                				var ref = $(this).attr('ref');
                				var mai = $(this).attr('mai');
                				var pan = $(this).attr('pan');
                				
                				jConfirm(
            						'Are you sure to delete', 
									'Dialog board',
									function(r){
										if(r){
											$('#mainfo'+ref).prepend("<div id='rmepcb' mai='"+mai+"' ref='"+ref+"' pand='"+pan+"'></div>");
											vsf.get('users/deleteepro/'+ref, 'rmepcb');
											return false;
										}
								});
                			});
                		}
                		
                		function profilecbtrue_epro_remove(){
                			var ref = $('#rmepcb').attr('ref');
                			var mai = $('#rmepcb').attr('mai');
                			var pan = $('#rmepcb').attr('pan');
                				
                			delete edujs[pan][mai]['projects'][ref];
							$('#p'+ref).toggle("slow", function(){	
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