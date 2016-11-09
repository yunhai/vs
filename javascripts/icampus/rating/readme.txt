<div id="ratingdiv">
	<div id='mainratingdiv'>
	<div ref="{$book->getId()}">
		<input type='hidden' id='currate' name='currate' value='{$book->getStar()}' />
		<img id="R1" alt="0" width="18" title="Not at All" src="{$bw->vars['js']}/icampus/rating/images/rate0.png" />
		<img id="R2" alt="1" width="18" title="Somewhat" src="{$bw->vars['js']}/icampus/rating/images/rate0.png" />
		<img id="R3" alt="2" width="18" title="Average" src="{$bw->vars['js']}/icampus/rating/images/rate0.png" />
		<img id="R4" alt="3" width="18" title="Good" src="{$bw->vars['js']}/icampus/rating/images/rate0.png" />
		<img id="R5" alt="4" width="18" title="Very Good" src="{$bw->vars['js']}/icampus/rating/images/rate0.png" />
	</div>
	<div id='confirmrating'></div>
	</div>
</div>



<script type="text/javascript">
		    	$(function(){
					setRating('{$book->getStar()}'); //hien gia tri sao mac dinh
				});
<script type="text/javascript">

SERVER SIDE:

			$rate = $rate + 1; // so nguoi rate
			
			
			$rateValue = rateValue + $star; // cong so diem(sao) moi rate vao tong so diem
			$newstar = ($rateValue)/$rate; // tinh ra diem(sao) moi sau khi rate

			// cap nhat lai database
		
			$this->output = <<<EOF
				<script type='text/javascript'>
					
					$('#currate').val('{$newstar}');
					setRating('{$newstar}');
					
// phan demo tra ve html sau khi rate
					$('#confirmrating').html('<span id="rateresult">You have rated this textbook {$star} star.</span>');
					
					setTimeout(function(){
			        	$('#confirmrating').toggle("slow", function(){
							$('#rateresult').remove();
							$('#confirmrating').attr('style','');
						});
			        }, 2000);
				</script>
EOF;