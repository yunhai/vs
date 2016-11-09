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
