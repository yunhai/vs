<?php
class skin_usersprofile {
	
		
	function protab($option){
		global $bw, $vsTemplate, $vsLang;
		
 		$BWHTML .= <<<EOF
 			{$vsTemplate->global_template->GLOBAL_PARTNER}
 			<div id="campus_user">
		    	<div id="tabs">
					<ul class="campus_user_menu">
						<li>
				        	<a href="{$bw->base_url}users/acctab/&ajax=1&tab=acctab">
				        		{$vsLang->getWords('tab_acc','Account')}
				        	</a>
				        </li>
				        <li>
				        	<a href="{$bw->base_url}messages/inbox&ajax=1&tab=inbox">
				        		{$vsLang->getWords('tab_message','Message')}
				        	</a>
				        </li>
				        <li>
				        	<a href="{$bw->base_url}users/protab/&ajax=1&tab=protab">
				        		{$vsLang->getWords('tab_profile','Profile')}
				        	</a>
				        </li>
				        <li>
				        	<a href="{$bw->base_url}listings/mylisting&ajax=1&tab=mylisting">
				        		{$vsLang->getWords('tab_mylisting','My listing')}
				        	</a>
				        </li>
				        <li>
				        	<a href="{$bw->base_url}users/sharing">My sharing</a>
				        </li>
				        <li>
				        	<a href="{$bw->base_url}users/settingtab/&ajax=1&tab=settingtab">
				        		Settings
				        	</a>
				        </li>
	        		</ul>
		            <div class="clear_left"></div>
		            <div id='prelaoding' style="margin: 10px">
		            	<img src="{$bw->vars['img_url']}/ajax-loader.gif" alt="retrieving data ..." style="height: 20px"/>
		            </div>
		        </div>
		        <script type='text/javascript'>
					$(document).ready(function() {
		    			var itab = $("#tabs").utabs({
		    				cache: true,
		    				selected: 2,
		    				select: function(event, ui) {
						        var content = '<img src="'+imgurl+'ajax-loader.gif" alt="retrieving data ..." style="height: 20px"/>';
						        content += '<br /><b>Fetching Data....</b>';
						        
						        var html = '<div style="margin: 10px">' + content + '</div>';
						        $("#ui-tabs-" + (ui.index)).html(html);
							}
		    			});
					})
				</script>
			</div>
        	<div class="clear"></div>
EOF;
	}
	
	function coreprotab($option){
		global $bw, $vsLang;

 		$BWHTML .= <<<EOF
 			<div id='tabprofile'>
		        <ul class="usercp_listing_menu1">
		        	<li>
		        		<a href="#aboutme-tab">
 							{$vsLang->getWords('profile_aboutme','About me')}
 						</a>
		        	</li>
		        	<li>
		        		<a href="#picture-tab">
							{$vsLang->getWords('profile_profilepicture','Profile Picture')}
 						</a>
		        	</li>
		        	<li>
		        		<a href="#skill-tab">
							{$vsLang->getWords('profile_skill','Skills')}
 						</a>
		        	</li>
		        	<li>
		        		<a href="#education-tab">
							{$vsLang->getWords('profile_education','Education')}
 						</a>
		        	</li>
		        	<li>
		        		<a href="#work-tab">
							{$vsLang->getWords('profile_work_experience','Work Experience')}
 						</a>
		        	</li>
		            <div class="clear_left"></div>
		        </ul>
		        <div id='tabprofilecontainer'>
					{$this->protab_abouttab($option['profile'])}
					{$this->protab_picturetab()}
					{$this->protab_skill($option['profile'])}
		       	 	{$this->protab_education($option)}
		       	 	{$this->protab_work($option['work'])}
				</div>
				<script type='text/javascript'>
					$(document).ready(function() {
		    			$("#tabprofile").utabs({
		    				cache: true
		    			});
		    			$('#tabprofilecontainer').ready(function(){
							$('#prelaoding').remove();
						});
					})
				</script>
	        </div>
EOF;
	}
	
	function protab_abouttab($option){
		global $vsLang, $bw;
		
		$BWHTML .= <<<EOF
				<div id="aboutme-tab">
					<div id='changepa_callback'></div>
                	<form id="changpa" method="POST">
                		<input type='hidden' name='a' value='a' />
                		
                		<label>{$vsLang->getWords('cpa_fullname','Fullname')}:</label>
				        <div class="selectdiv" id='fullname'>{$option['fullname']}</div>
				        <div class='clear'></div>
                		
				        <label>{$vsLang->getWords('cpa_location','Location')}:</label>
				        <div class="selectdiv"><input name='profileLocation' value='{$option['profileLocation']}' /></div>
				        <div class='clear'></div>
				        
				        <label>{$vsLang->getWords('cpa_gender','Gender')}:</label>
				        <div class="genderdiv">
				        	<input value="0" name='profileGender' type='radio' class='gender' />
                			<label>{$vsLang->getWords('male', 'Male')}</label>
                			
                			<input value="1" name='profileGender' type='radio' class='gender' />
					        <label>{$vsLang->getWords('female', 'Female')}</label>
				        </div>
				        <div class='clear'></div>
				        
				        <label>{$vsLang->getWords('cpa_birthday','Birthday')}:</label>
				        <div id='bddiv' class="selectdiv date"></div>
				        <div class='clear'></div>
				        
				        <label>{$vsLang->getWords('cpa_rs','Relationship')}:</label>
				        <div id="rsdiv" class="selectdiv">
				        </div>
				        <div class='clear'></div>
				        
				        <label>{$vsLang->getWords('cpa_intro','About me')}:</label>
				        <div>
				        	<textarea name="profileIntro">{$option['profileIntro']}</textarea>
				        </div>
				        <div class='clear'></div>
				        
				        <label>{$vsLang->getWords('cpa_language','Language')}:</label>
				        <div id="languagediv" style="float:left;">
				        </div>
				        <div class='clear'></div>
				        
				        <label>{$vsLang->getWords('cpa_interest','Interests')}:</label>
				        <div>
				        	<textarea name="profileInterest">{$option['profileInterest']}</textarea>
				        </div>
				        <div class='clear'></div>
				        
				        <label>{$vsLang->getWords('cpa_ga','Groups & Associations')}:</label>
				        <div>
				        	<textarea name="profileGA">{$option['profileGA']}</textarea>
				        </div>
				        <div class='clear'></div>
				        
				        <label>{$vsLang->getWords('cpa_honor','Honors & Awards')}:</label>
				        <div>
				        	<textarea name="profileHonor">{$option['profileHonor']}</textarea>
				        </div>
				        <div class='clear'></div>
				        
				        
				        <div id="seperate">
				        	<span>Contact Information</span>
				        </div>
				        <div class='clear'></div>
				        
				        <label>{$vsLang->getWords('cpa_email','Email')}:</label>
				        <div>
				        	<input name="profileEmail" value="{$option['profileEmail']}" />
				        </div>
				        <div class='clear'></div>
				        
				        <label>{$vsLang->getWords('cpa_phone','Phone')}:</label>
				        <div>
				        	<input name="profilePhone" value="{$option['profilePhone']}" />
				        </div>
				        <div class='clear'></div>
				        
				        <label>{$vsLang->getWords('cpa_address','Address')}:</label>
				        <div>
				        	<input name="profileAddress" value="{$option['profileAddress']}" />
				        </div>
				        <div class='clear'></div>
				        
				        <label id='screenname'>{$vsLang->getWords('cpa_sn','Screen name')}:</label>
				        <div id='sndiv' style='float:left;'></div>
				        <div class='clear'></div>
				        
				        <label>{$vsLang->getWords('cpa_website','Website')}:</label>
				        <div>
				        	<input name="profileWebsite" value='{$option['profileWebsite']}' />
				        </div>
				        <div class='clear'></div>
				        
				        <a class='profile_btn' id="cpa_form_submit" style='margin-left: 75px;' href="javascript:;" >
				        	{$vsLang->getWords('cpa_form_save_changes','Save changes')}
				        </a>
				        <div class='clear'></div>
			        </form>
		        	<div class='clear'></div>
		        	
		        	
		        	
			    	<script type='text/javascript'>
						var pfjs = {$option['json']['pfjs']};
						var rsjs = {$option['json']['rsjs']};
						
						$(document).ready(function(){
							vsf.jRadio(pfjs['profileGender'], "profileGender");
						});
                	</script>
                	<script type='text/javascript' src='{$bw->vars['js']}/icampus/scripts/protab_aboutme.js'></script>
                </div>
EOF;
	}
	
	function protab_picturetab(){
		global $bw, $vsLang, $vsUser;
		$BWHTML .= <<<EOF
			<div id="picture-tab">
                	<div id="img_container">
                		{$vsUser->obj->createImageCache($vsUser->obj->getImage(), 180, 180, 0, 0)}
                	</div>
                	<div id="main-image-form">
                		<form id="cpi_form" method='POST'>
	                		<p style='font-size: 12px; height: 29px;'>{$vsLang->getWords('cpi_change_profile_picture','Change profile picture')}</p>
	                		<input name="userImage" id="userImage" type="file" />
	                		<p>{$vsLang->getWords('cpi_intro','(Chose an image file on your computer)')}</p>
	                		<p>{$vsLang->getWords('cpi_intro_max_size','Max file size: 4MB')}</p>
	                			<a id="cpa_preview" href="javascript:;" class='profile_btn' >
						        	{$vsLang->getWords('clt_form_preview','Preview')}
						        </a>
						        <a id="cpi_form_submit" href="javascript:;" class='profile_btn' >
						        	{$vsLang->getWords('clt_form_save_changes','Changes')}
						        </a>
	                		<div class='clear'></div>
                		</form>
                	</div>
                	<div class='clear'></div>
                	<script type="text/javascript">
                		var filename = "";
                		$('#cpi_form_submit').click(function(){
                			if(filename != $('#userImage').val() || ($('#fileId').length > 0 && $('#fileId').val() > 0 )){
                				vsf.submitForm($('#cpi_form'), 'users/changepi', 'img_container');
                				return false;
                			}
                			vsf.uploadFile("cpi_form", "users", "changepi", "img_container", "{$bw->input[0]}");
                			return false;
                		});
                		
                		$('#cpa_preview').click(function(){
                			filename = $('#userImage').val();
                			$('#userImage').val()
                			vsf.uploadFile("cpi_form", "users", "changepipv", "img_container", "{$bw->input[0]}");
                		});
                	</script>
                </div>
EOF;
	}

	function protab_skill($option){
		$BWHTML .= <<<EOF
			<div id="skill-tab">
                	<div id="skill-contain">
                		<div class='proTitle'><span>Skills</span></div>
                		<div id="escb"></div>
                		
                		<div id='skill-detail' class='view'>
							{$option['profileSkill']}
						</div>
                	</div>
                	<div class='clear'></div>
                	<script type="text/javascript">
                		var skill = '';
                		
                		bindSD();
                		function bindSD(){
	                		$('#skill-detail').dblclick(function(){
		                		skill = $('#skill-detail').html();
		                		var html = '<form id="editSkill">'+
		                				    '<input type="hidden" name="a" value="s" />'+	
		                					'<textarea name="profileSkill" id="profileSkill">'+skill+'</textarea>'+
		                					'<input class="submit" id="submit" value="Submit" name="submit" type="button" />'+
		                					'<input class="cancel" id="cancel" value="Cancel" type="button" />'+
		                				   '</form>';
								$('#skill-detail').html(html);
								$('#skill-detail').removeClass('view');
								$('#profileSkill').focus();

								$(this).unbind('dblclick');
								
								$('#submit').click(function(){
									vsf.submitForm($('#editSkill'), 'users/editprofile', 'escb');
									return false;
								});
								
								$('#cancel').click(function(){
									$('#skill-detail').addClass('view');
									$('#skill-detail').html(skill);
									
									bindSD();
									return false;
								});
	                		});
                		}
                		
                		function profilecbtrue_s(){
                			$('#skill-detail').addClass('view');
                			
                			var nskill = $('#profileSkill').val();
                			$('#skill-detail').html(nskill);
                			
                			bindSD();
                			setTimeout(function(){
					        	$('#escb').toggle("slow", function(){	
									$('escb').html('');
								});
					        }, 2000);
                		}
                		
                		function profilecbfalse_s(){
                			$('#skill-detail').addClass('view');
                			$('#skill-detail').html(skill);
                			bindSD();
                			setTimeout(function(){
					        	$('#escb').toggle("slow", function(){	
									$('escb').html('');
								});
					        }, 2000);
                		}
                	</script>
                </div>
EOF;
	}
	
	function protab_education($option){
		global $bw, $vsUser;

		$BWHTML .= <<<EOF
				<div id="education-tab">
                	<div id="edu-contain">
                		<div class='proTitle'>Education</div>
                		<div style='margin-top: 10px;'>
                			<if=" $option['edu']['mainschool'] ">
                			<foreach="$option['edu']['mainschool'] as $mkey => $mainschool ">
                			<div id='{$mkey}' class='econ'>
	                			<div class='einfo' ref='{$mkey}' pan='mainschool' >
	                				<div id="edetail{$mkey}" class='einfodiv' ref='{$mkey}' pan='mainschool'>
				                		<span id='mainschoolTitle' class='etitle' ref="{$mkey}">
				                			
										</span>
										<div class='emore'>
											{$mainschool['eduDegree']}<if=" $mainschool['eduMajor'] ">, {$mainschool['eduMajor']}</if> 
											<if=" $mainschool['eduStart'] ">({$mainschool['eduStart']} to <if=" $mainschool['eduEnd']">{$mainschool['eduEnd']}<else />present</if>)</if>
										</div>
									</div>
									<div class='clear'></div>
								</div>
								<div class='pcontainer'> 
			                		<div class='pctitle'>Projects</div>
			                		<div id='plist{$mkey}'>
			                			<if=" $mainschool['projects'] ">
					                	<foreach=" $mainschool['projects'] as $pkey => $pvalue">
				                			<div class='eduproject' id='p{$pkey}'>
					                			<div id='pinfo{$pkey}' class='pinfo' ref='{$pkey}' pan='mainschool'>
					                				<div id='mainfo{$pkey}'>
														<div class='ptitle'>{$pvalue['epTitle']}</div>
														<div class='ptime'>
															{$pvalue['epStart']} to <if=" $pvalue['epEnd']">{$pvalue['epEnd']}<else />present</if>
														</div>
														<div class='pdetail'>{$pvalue['epDetail']}</div>
													</div>
					                			</div>
					                			<div class='poption'>
						                			<span class='editP' ref='{$pkey}' pan='mainschool' mai='{$mkey}'>Edit</span>
						                			<span class='deleteP' ref='{$pkey}' pan='mainschool' mai='{$mkey}'>X</span>
						                		</div>
						                		<div class='clear'></div>
					                		</div>
					                	</foreach>
					                	</if>
			                		</div>
			                		<div class='addprocon{$mkey}'>
										<div id='option{$mkey}' class='option' ref="{$mkey}">
				                			<a class="addpro" pan="mainschool" mai='{$mkey}' href="javascript:;" >
												Add project
											</a>
											<div class='clear'></div>
										</div>
			                		</div>
			                	</div>
			                </div>
							</foreach>
							</if>
                		</div>
                		<div id='subschool'>
                			<div id='addschool' pan='normalschool' >
                				<div id='optionaddschool'>
			                		<a class="ainput addschool" href="javascript:;" pan="normalschool" >
										<span>Add School</span>
									</a>
									<div class='clear'></div>
								</div>
							</div>
                			<if=" $option['edu']['normalschool'] ">
                			<foreach="$option['edu']['normalschool'] as $nkey => $nschool ">
                			<div id='{$nkey}' class='econ'>
	                			<div class='einfo' ref='{$nkey}' pan='normalschool'>
	                				<div id="edetail{$nkey}" class='einfodiv' pan='normalschool' ref='{$nkey}'>
				                		<span class='etitle'>{$nschool['eduSchool']}</span>
										<div class='emore'>
											{$nschool['eduDegree']}<if=" $nschool['eduMajor'] ">, {$nschool['eduMajor']}</if>
											({$nschool['eduStart']} to <if=" $nschool['eduEnd']">{$nschool['eduEnd']}<else />present</if>)
										</div>
									</div>
									<div class='clear'></div>
								</div>
								<div class='pcontainer'> 
			                		<div class='pctitle'>Projects</div>
			                		<div id='plist{$nkey}'>
			                			<if=" $nschool['projects'] ">
					                	<foreach=" $nschool['projects'] as $pkey => $pvalue">
				                			<div class='eduproject' id='p{$pkey}'>
					                			<div id='pinfo{$pkey}' class='pinfo' ref='{$pkey}' pan='normalschool'>
					                				<div id='mainfo{$pkey}'>
														<div class='ptitle'>{$pvalue['epTitle']}</div>
														<div class='ptime'>
															{$pvalue['epStart']} to <if=" $pvalue['epEnd']">{$pvalue['epEnd']}<else />present</if>
														</div>
														<div class='pdetail'>{$pvalue['epDetail']}</div>
													</div> 
					                			</div>
					                			<div class='poption'>
						                			<span class='editP' ref='{$pkey}' pan='normalschool' mai='{$nkey}'>Edit</span>
						                			<span class='deleteP' ref='{$pkey}' pan='normalschool' mai='{$nkey}'>X</span>
						                		</div>
						                		<div class='clear'></div>
					                		</div>
					                	</foreach>
					                	</if>
			                		</div>
			                		<div class='addprocon{$nkey}'>
			                			<div id='option{$nkey}' class='option' ref="{$nkey}">
				                			<a class="addpro" pan="normalschool" mai='{$nkey}' href="javascript:;" >
												Add project
											</a>
											<div class='clear'></div>
										</div>
			                		</div>
			                	</div>
			                </div>
							</foreach>
							</if>
                		</div>
                	</div>
                </div>	
                <script type="text/javascript">
                	var edujs = {$option['edu']['json']};
                	var campusjs = {$option['edu']['cjs']};
                	
                	var title = '';
                	var tempref = $('#mainschoolTitle').attr('ref');
                	var cid = edujs['mainschool'][tempref]['eduSchool'];
                	if(typeof(campusjs[cid]) != "undefined") title = campusjs[cid]['campusTitle'];
                	$('#mainschoolTitle').html(title);
                	
                </script>
                <script type='text/javascript' src='{$bw->vars['js']}/icampus/scripts/protab_edu.js'></script>
EOF;
	}
	
	function protab_work($option){
		global $bw;
		$BWHTML .= <<<EOF
				<div id="work-tab">
					<div id='work-contain'></div>
                	<script type="text/javascript">
                		var workjs = {$option['json']};
                	</script>
                	<script type='text/javascript' src='{$bw->vars['js']}/icampus/scripts/protab_work.js'></script>
                </div>
EOF;
	}
}
?>