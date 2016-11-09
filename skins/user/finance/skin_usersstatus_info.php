<?php
class skin_comments{
	
	function info($option){
		global $bw, $vsLang, $vsUser;

		
		$langs = $option['profile']['profileLanguages'];
		$count0 = count($langs)+1;
		
		$sns = $option['profile']['profileSN'];
		$count1 = count($sns)+1;
		
		$snhtml = ""; $langhtml = "";
		if($bw->input['profile'] == $vsUser->obj->getId()){
			if($langs){
				$index = 0;
	     		foreach($langs as $lang){
	     			$index++;
	        		$langhtml .= <<<EOF
		        		<input name='lang[{$index}]' class='lang' id='lang{$index}' value='{$lang}' ref='{$index}' style='display:none' />
		        		<div class='langdiv' name='{$index}' id='div{$index}'>
		        			{$lang}
							<span onclick='removeLang({$index})' name='{$index}'>X</span>
							<div class='clear'></div>
						</div>
EOF;
				}
			}
			$langhtml .= "<input name='lang[{$count0}]' class='lang' id='lang{$count0}' ref='{$count0}' />"; 
		
			if($sns){
				$index = 0;
	     		foreach($sns as $sm){
	     			$index++;
	        		$snhtml .= <<<EOF
		        		<div id='main{$index}' class="snitem" ref="{$index}" style='display:none;'>
							<input id="sn{$index}" class="sn" value="{$sm['value']}" name=sn[{$index}][value]"" />
							<select id="snt{$index}" name="sn[{$index}][type]">
								<option value='yahoo'>Yahoo</option>
			        			<option value='skype'>Skype</option>
			        			<option value='aim'>AIM</option>
			        			<option value='msn'>MSN</option>
		        			</select>
							<div class="clear"></div>
						</div>
		        		<div id='view{$index}' class='sndiv' ref='{$index}'>
							<span class='snvalue'>{$sm['value']}</span>
							<span class='sntype'>{$sm['type']}</span>
							<span onclick='removeSN({$index})' name='{$index}' class='rmsn'>X</span>
							<div class='clear'></div>
						</div>
EOF;
				}
			}
			$snhtml .= <<<EOF
					<div id='main{$count1}' class='snitem' ref='{$count1}'>
		        		<input name="sn[{$count1}][value]" class='sn' value="" id="sn{$count1}" />
		        		<select name="sn[{$count1}][type]" id='snt{$count1}'>
		        			<option value='yahoo'>Yahoo</option>
		        			<option value='skype'>Skype</option>
		        			<option value='aim'>AIM</option>
		        			<option value='msn'>MSN</option>
		        		</select>
		        		<div class='clear'></div>
	        		</div>
EOF;
		}else{
			if($langs){
				$index = 0;
				foreach($langs as $lang)
        			$langhtml .= $lang.', ';
        		$langhtml = trim($langhtml, ', ');
			}
			if($sns){
				$index = 0;
				foreach($sns as $sm){
	     			$index++;
	        		$snhtml .= <<<EOF
		        		<div class='sndiv' ref='{$index}'>
							<span class='snvalue'>{$sm['value']}</span>
							<span class='sntype'>{$sm['type']}</span>
							<div class='clear'></div>
						</div>
EOF;
        		}
			}
		}
		
		$BWHTML .= <<<EOF
			<div id='tabinfo'>
				<div class='groupcontainer'>
					<div class='info'>
						<h3>About you</h3>
						<div id='about' class='texteditable' name='profileIntro'>
							<div id='aboutdetail'>
								{$option['profile']['profileIntro']}
							</div>
						</div>
					</div>
				</div>
				
				<div class='groupcontainer'>
					<div class='info'>
						<h3>Skills</h3>
						<div id='skill' class='texteditable' name='profileSkill'>
							<div id='skilldetail'>{$option['profile']['profileSkill']}</div>
						</div>
					</div>
				</div>
				
				<div class='groupcontainer'>
					<div class='info'>
						<h3>Education</h3>
						<div id='education'></div>
					</div>
				</div>
				
				<div class='groupcontainer'>
					<div class='info'>
						<h3>Work Experience</h3>
						<div id='work'></div>
					</div>
				</div>
				
				<div class='groupcontainer'>
					<div class='info'>
						<h3>Groups and Associations</h3>
						<div id='ga' class='texteditable' name='profileGA'>
							<div id='gadetail'>
								{$option['profile']['profileGA']}
							</div>
						</div>
					</div>
				</div>
				<div class='groupcontainer'>
					<div class='info'>
						<h3>Honors and Awards</h3>
						<div id='honors' class='texteditable' name='profileHonor'>
							<div id='honorsdetail'>
								{$option['profile']['profileHonor']}
							</div>
						</div>
					</div>
				</div>
				
				<div class='groupcontainer'>
					<div class='info'>
						<h3>Persional Information</h3>
						<div class='ginfo'>
							<div class='grow'>
								<label id='bdlabel'>Birthday</label>
								<div id='birthday' name="profileBirthday">
									<div id='birthdaydetail' class='detail'>{$option['profile']['profileBirthday']}</div>
								</div>
								<div class='clear'></div>
							</div>
							
							<div class='grow'>
								<label id='rslabel'>Relationship status</label>
								<div id='relationship' name="profileRS">
									<div id='relationshipdetail' class='detail'>{$option['profile']['profileRSV']}</div>
								</div>
								<div class='clear'></div>
							</div>
							
							<div class='grow'>
								<label id='llabel'>Languages</label>
								<div id='languages'>
									<div id='languagediv' class='detail' style='width: 300px'>
										{$langhtml}
									</div>
								</div>
								<div class='clear'></div>
							</div>
							
							<div class='grow'>
								<label>Interests</label>
								<div id='interests' class='texteditable detail' name='profileInterest'>
									<div id='interestsdetail'>
										{$option['profile']['profileInterest']}
									</div>
								</div>
								<div class='clear'></div>
							</div>
							
						</div>
					</div>
				</div>
				<div class='groupcontainer'>
					<div class='info'>
						<h3>Contact Information</h3>
						<div class='ginfo'>
							<div class='grow'>
								<label>Email</label>
								<div id='email' class='inputeditable' name='profileEmail'>
									<div id='emaildetail' class='detail'>{$option['profile']['profileEmail']}</div>
								</div>
								<div class='clear'></div>
							</div>
							
							<div class='grow'>
								<label>Phone</label>
								<div id='phone' class='inputeditable' name='profileEmail'>
									<div id='phonedetail' class='detail'>{$option['profile']['profilePhone']}</div>
								</div>
								<div class='clear'></div>
							</div>
							
							<div class='grow'>
								<label>Address</label>
								<div id='address' class='inputeditable' name='profileAddress'>
									<div id='addressdetail' class='detail'>{$option['profile']['profileAddress']}</div>
								</div>
								<div class='clear'></div>
							</div>
							
							<div class='grow'>
								<label id='snlabel'>Screen name</label>
								<div id='sn' class='detail'>{$snhtml}</div>
								<div class='clear'></div>
							</div>
							
							<div class='grow'>
								<label>Website</label>
								<div id='website' class='inputeditable' name='profileWebsite'>
									<div id='websitedetail' class='detail'>{$option['profile']['profileWebsite']}</div>
								</div>
								<div class='clear'></div>
							</div>
						</div>
					</div>
				</div>
				<script>
						var js = {$option['profilejs']}; 
						var cpjs = {$option['campusjs']};
						var rsjs = {$option['rsjs']};
						
						var lindex = {$count0}; var snindex = {$count1};
				</script>
				<script type='text/javascript' src='{$bw->vars['js']}/icampus/scripts/usersstatus_info{$option['editable']}.js'></script>
			</div>
EOF;
	}
?>