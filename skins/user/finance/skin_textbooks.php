<?php
class skin_textbooks{

	function isbnBooks($option){
		global $vsLang, $bw, $vsPrint, $vsTemplate;

		$BWHTML .= <<<EOF
			{$option['leftHTML']}
			<div id="content1">
				{$vsTemplate->global_template->GLOBAL_PARTNER}
	        	<div id="content_left">
		            <div id="pro_tab">
		            	<ul class='tabs-nav'>                
		                	<span class="sort">{$vsLang->getWords('searchforsell','Please select/verify the textbook you want to sell')}</span>	
		                </ul>
		                <div id="BEST">
		                	<if=" $option['pageList'] ">
		                	<foreach=" $option['pageList'] as $book ">
		                	<div class="product">
		                   		<div class="product_img">
		                   			<a href="{$bw->vars['board_url']}/textbooks/sell&tb=<if="$book->amazon">{$book->stt}&isbn={$book->key}<else />{$book->getId()}</if>" title="{$book->getTitle()}">
		                        	<if=" $book->getImage() ">
										{$book->createImageCache($book->getImage(),85,115)}
									<else />
										<img src="{$bw->vars['img_url']}/noimage.jpg" alt="{$vsLang->getWords('global_no_image','No Imgae')}" width="85" height="115" />
									</if>
									</a>
								</div>
		                        <div class="product_intro">
		                        	<h4><a href="{$bw->vars['board_url']}/textbooks/sell&tb=<if="$book->amazon">{$book->stt}&isbn={$book->key}&time={$option['cachetime']}<else />{$book->getId()}</if>" title="{$book->getTitle()}">{$book->getTitle()}</a></h4>
		                            <p>{$book->getAuthor()}</p>
		                            <p>
		                            	<if="$book->getISBN()">
		                            		<span><b>ISBN 13</b>: {$book->getISBN()}</span>
		                            	</if>
		                            	
		                            	<if="$book->getISBN10()">
		                            		<span><b>ISBN 10</b>: {$book->getISBN10()}</span>
		                            	</if>
		                            </p>
									<p>
										<span><b>Publisher</b>: {$book->getPublisher()}</span>
										<span><b>Edition</b>: {$book->getEdition()}</span>
									</p>
			                        <p>
										<span><b>Publication date</b>: {$book->getRelease()}</span>
										<if=" $book->getPage() ">
										<span>{$book->getPage()} <b>pages</b></span>
										</if>
									</p>
		                            <p>
			                        	<span><b>Language</b>: {$book->getLanguage()}</span>
		                            </p>
		                        </div>
		                        <div class="clear_left"></div>
		                   </div>
		                   </foreach>
		                   </if>
		                   
		                   <if=" $option['paging'] ">
		                   <div class="page">
		                   		<span>Browse Pages:</span>
		                   		{$option['paging']}
		                   </div>
		                   </if>
		                </div>
		            </div>
		        </div>
	    	</div>
	    	<div class="clear"></div>
EOF;
	}
	
	function loadMain($option){
		global $vsLang, $bw, $vsTemplate;
		
		$BWHTML .= <<<EOF
		{$option['leftHTML']}
		<div id="content1">
			{$vsTemplate->global_template->GLOBAL_PARTNER}
        
	        <div id="content_left">
	        	{$this->searchForm()}
	        	
	            <!-- FIND BOOK BORDER -->
	            
	            <div class="seller_border">
	            	<div class="user_title">
	                	<h3>{$vsLang->getWords('global_new_listing','New Listings')}</h3>
	                    <a href="{$bw->vars['board_url']}/textbooks/more/new-listing" title="{$vsLang->getWords('global_new_listing','New Listings')}">
	                    	{$vsLang->getWords('global_more','more')}
	                    </a>
	                </div>
	                <div class="seller_list">
	                	<if=" $option['newBooks'] ">
	                	<foreach=" $option['newBooks'] as $new ">
	                    <div class="seller_item">
	                        <div class="seller_img">
	                        	<a href="{$new->getListingURL('textbooks')}" title="{$new->getTitle()}">
									{$new->createImageCache($new->getImage(),85,115, 0, 1)}
								</a>
	                        </div>
	                        <h3 class="bookTitle">
	                        	<a href="{$new->getListingURL('textbooks')}" title="{$new->getTitle()}">
	                        		{$new->getTitle(50)}
                        		</a>
                        	</h3>
                        	<div class="description">
	                        	<p class='author'>{$new->getAuthor(25)}</p>
	                        	<if=" $new->getPublisher() || $new->getRelease() ">
	                        	<p>(<if="  $new->getFormat() ">{$new->getFormat()},</if><if="$new->getRelease()">{$new->getRelease()}</if>)</p>
	                        	</if>
	                        </div>
	                        <p class="cost">
	                        	<if=" $new->price ">
	                        		<span class='buyfrom'>{$vsLang->getWords('global_buy_from','Buy from')}</span>
	                        		{$vsLang->getWords('global_curency','$')}{$new->price}
	                        	</if>
	                        </p>
	                    </div>
	                    <if=" $new->begingroup ">
	                    	<div class="clear_left"></div>
	                    	<div class='seperate'></div>
	                    </if>
	                    </foreach>
	                    </if>
	                    <div class="clear_left"></div>
	                </div>
	            </div>
	           
	           
	           <if=" $option['bestSellBooks'] ">
	           <div class="seller_border">
	            	<div class="user_title">
	                    <h3>{$vsLang->getWords('global_best_selling','Best Selling')}</h3>
	                    <a href="{$bw->vars['board_url']}/textbooks/more/2" title="{$vsLang->getWords('global_best_selling','Best Selling')}">
	                    	{$vsLang->getWords('global_more','more')}
	                    </a>
	                </div>
	                <div class="seller_list">
	                    
	                	<foreach=" $option['bestSellBooks'] as $best ">
	                    <div class="seller_item">
	                        <div class="seller_img">
	                        	<a href="{$best->getListingURL('textbooks')}" title="{$best->getTitle()}">
	                        	<if=" $best->getImage() ">
									{$best->createImageCache($best->getImage(),85,115)}
								<else />
									<img src="{$bw->vars['img_url']}/noimage.jpg" alt="{$vsLang->getWords('global_no_image','No Imgae')}" width="85" height="115" />
								</if>
								</a>
	                        </div>
	                        <h3 class="bookTitle">
	                        	<a href="{$best->getListingURL('textbooks')}" title="{$best->getTitle()}">
	                        		{$best->getTitle(50)}
                        		</a>
                        	</h3>
                        	<div class="description">
	                        <p class='author'>{$best->getAuthor(25)}</p>
	                        <if=" $best->getFormat() || $best->getRelease() ">
	                        <p>(
	                        	<if="  $best->getFormat() ">
	                        	{$best->getFormat()}, 
	                        	</if>
	                        	<if="$best->getRelease()">
	                        	{$best->getRelease()}
	                        	</if>
	                        	)
	                        </p>
	                        </if>
	                        </div>
	                        <p class="cost">
	                        	<if=" $best->price ">
	                        		<span class='buyfrom'>{$vsLang->getWords('global_buy_from','Buy from')}</span>
	                        		{$vsLang->getWords('global_curency','$')}{$best->price}
	                        	</if>
	                        </p>
	                    </div>
	                    </foreach>
	                    
	                    <div class="clear_left"></div>
	                </div>
	            </div>
	            </if>
	            
	            <if=" $option['campusBooks'] ">
	            <div class="seller_border">
	            	<div class="user_title">
	                    <h3>{$vsLang->getWords('global_most_recommended','Most Recommended')}</h3>
	                    <a href="{$bw->vars['board_url']}/textbooks/more/3" title="{$vsLang->getWords('global_most_recommended','Most Recommended')}">
	                    	{$vsLang->getWords('global_more','more')}
	                    </a>
	                </div>
	                <div class="seller_list">
	                	<foreach=" $option['campusBooks'] as $campus ">
	                    <div class="seller_item">
	                        <div class="seller_img">
	                        	<a href="{$campus->getUrl('textbooks')}" title="{$campus->getTitle()}">
	                        	<if=" $campus->getImage() ">
									{$campus->createImageCache($campus->getImage(),85,115)}
								<else />
									<img src="{$bw->vars['img_url']}/noimage.jpg" alt="{$vsLang->getWords('global_no_image','No Imgae')}" width="85" height="115" />
								</if>
								</a>
	                        </div>
	                        <h3 class="bookTitle">
	                        	<a href="{$campus->getUrl('textbooks')}" title="{$campus->getTitle()}">
	                        		{$campus->getTitle(30)}
                        		</a>
                        	</h3>
                        	<div class="description">
	                        <p class='author'>{$campus->getAuthor(25)}</p>
	                       	<p>(
	                        	<if="  $best->getFormat() ">
	                        	{$best->getFormat()}, 
	                        	</if>
	                        	<if="$best->getRelease()">
	                        	{$best->getRelease()}
	                        	</if>
	                        	)
	                        </p>
	                        </div>
	                        <p class="cost">
	                        	<if=" $campus->price ">
	                        		<span class='buyfrom'>{$vsLang->getWords('global_buy_from','Buy from')}</span>
	                        		{$vsLang->getWords('global_curency','$')}
	                        		{$campus->price}
	                        	</if>
	                        </p>
	                    </div>
	                    </foreach>
	                    <div class="clear_left"></div>
	                </div>
	            </div>
	            </if>
	        </div>

	    </div>
	    <div class="clear"></div>
EOF;
		return $BWHTML;
	}
	
	function listing($book, $option){
		global $vsLang, $bw, $vsPrint;
		$this->vsLang = $vsLang;
		$option['obj_title'] = $book->getTitle();
		
		$BWHTML .= <<<EOF
			{$option['leftHTML']}
			<div id="content1">
		        <div id="textbook_listing">
					<div class="listing_detail">
						<div id="objinfo" class="listing_book_detail">
			            	<div class="product_img">
								{$book->createImageCache($book->getImage(),85,115, 0, 1)}
			            	</div>
			               	<div class="product_intro">
	                        	<h4>
	                        		<a href="#" title="{$book->getTitle()}">
	                        			{$book->getTitle()}
	                        		</a>
	                        	</h4>
	                            <p>{$book->getAuthor()}</p>
								<p>({$book->getFormat()}<if="$book->getRelease(1)">, {$book->getRelease(0, 1)}</if>)</p>
								
								<p style="margin-bottom: 10px;">
									<b>Publisher:</b> {$book->getPublisher()}
								</p>
								
								<if=" $option['bestprice'] ">
								<foreach=" $option['bestprice'] as $key => $bestprice ">
				                <p class='cost'>
				                	<span class='buyfrom'>{$option['seller'][$key]['from']} from </span> {$this->vsLang->getWords('global_curency','$')}{$bestprice}
				                </p>
				                </foreach>
				                </if>
	                        </div>
	                        <div class="clear"></div>
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
			                
			                <div class="bookdetail_btn" id="displaydetail">
			                	<span>{$vsLang->getWords('detail','Details')}</span>
			                </div>
			                <div class="clear_left"></div>
			                
			                <div id="detail_tab" style="display:none;">
			                	<div id="close_detail" style='display:none;'>
			                		<div class="bookdetail_btn">
			                			<span>{$vsLang->getWords('hide','Hide')}</span>
			                		</div>
			                	</div>
			                	<p><span>ISBN-10:</span> {$book->getISBN10()}</p>
				                <p><span>ISBN-13:</span> {$book->getISBN()}</p>
				                <p><span>Edition:</span> {$book->getEdition()}</p>
				                <p><span>Pages:</span> {$book->getPage()} pages</p>
				                
				                <p><span>Dimensions:</span> {$book->getDimension()} {$vsLang->getWords('dimension_unit','inches')} (height x width x thickness)</p>
				                <p><span>Weight:</span> {$book->getWeight()} {$vsLang->getWords('weight_unit','pounds')}</p>
			                </div>
		                </div>
		                <div id="sellerinfo">
		                	<if=" $option['seller'] ">
							<foreach=" $option['seller'] as $array ">
							<h3 class="feedfack_title">{$array['title']}</h3>
				           	<div class="listing_table">
				           		<if=" $array['list']['pageList'] ">
				               	<table border="1" width="100%">
				               		<tr>
				                    	<th class="table_span1">Price</th>
				                    	<th class="table_span2">Condition</th>
				                        <th class="table_span3">Seller</th>
				                        <th class="table_span4">Comments</th>
				                        <th class="table_span5">Campus/Location</th>
				                        
				                    </tr>
				                   
				                    <foreach=" $array['list']['pageList'] as $tu "> 
				               		<tr>
				                    	<td class="table_span1">
				                    		<a href="{$tu->getURL($option['obj_title'])}" title="More infomation about this listing">
				                        		{$this->vsLang->getWords('global_curency','$')}
	                        					{$tu->getPrice()}
				                        	</a>
				                        </td>
				                        <td class="table_span2">
				                        	<if=" $option['tbcond'][$tu->getCondition()] ">
				                        		{$option['tbcond'][$tu->getCondition()]->getTitle()}
				                        	</if>
				                        </td>
				                        
				                        <td class="table_span3">
				                        	<a href="{$bw->vars['board_url']}/{$tu->useralias}" title="{$tu->useralias}'s profile" class='profile'>
				                        	{$tu->useralias}
				                        	</a>
				                        </td>
				                        <td class="table_span4">
				                        	{$tu->getComment(100)}
				                        </td>
				                        <td class="table_span5">
				                        	<if=" $option['campusList'][$tu->getCampus()] ">
				                        	{$option['campusList'][$tu->getCampus()]->getTitle()} <br />
				                        	</if>
				                        	{$tu->getLocation()}
				                        </td>
				                    </tr>
				                    </foreach>
									<if=" $array['list']['paging'] ">
									<tr>
				                    	<td colspan="4" align="right">{$array['list']['paging']}</td>
				                    </tr>
				                    </if>
				               	</table>
				               	<else />
				               		<div class='nolisting'>
				               			<span class='price'>Nobody is selling this book</span>
				               			<div class='bookdetail_btn'>
				               			<span name='sellyours' class='sellyours' ref='{$book->getId()}'>Sell yours</span>
				               			</div>
				               			<div class='clear'></div>
				               		</div>
				               	</if>
				           	</div>
							</foreach>
							</if>
		                </div>
		            </div>
	    		</div>
	    	</div>
		    <div class="clear"></div>
		    <div id="callback"></div>
		    
		    <script type="text/javascript">
		    	$(function(){
					setRating('{$book->getStar()}');
				});
            	$(document).ready(function() {
				    $('#close_detail').click(function(){
						$('#detail_tab').toggle("slow");
					});
					
					
					var flag = false;
					$('#displaydetail').click(function(){
						if(flag) $('#displaydetail span').text('Details');
						else $('#displaydetail span').text('Hide Details');
						
						$('#detail_tab').toggle("slow");
						flag = !flag;
					});
					
					$('.sellyours').click(function(){
						location.href="{$bw->vars['board_url']}/textbooks/sell&tb="+$(this).attr('ref');
					});
				});
            </script>
EOF;
		return $BWHTML;
	}
	
	function objForm($obj, $tu, $option){
		global $vsLang, $bw, $vsPrint, $vsUser, $vsTemplate;

		$BWHTML .= <<<EOF
			{$option['leftHTML']}
			<div id="content1">
				{$vsTemplate->global_template->GLOBAL_PARTNER}
		        <div id="content_left">
					<div id="previewContainer"></div>
		           	<div class="sell_textbook">
		           		<h3>Sell your textbook</h3>
		                <form action="{$bw->vars['board_url']}/textbooks/sell/" method="post" enctype="multipart/form-data" id="editForm">
		                	<input type="hidden" value="{$option['cpage']}" name="page" />
		                	<input type="hidden" value="{$tu->getId()}" name="tuId" />
		                	
		                	<input type="hidden" value="{$obj->getId()}" name="bookId" />
		                	<input type="hidden" value="{$obj->getImage()}" name="oldImage" />
		                	
		                	<if=" $option['verify'] ">
		                	<input type="hidden" value="{$option['verify']}" name="direct" />
		                	<else />
		                	<input type="hidden" value="{$option['valid']}" name="direct" />
		                	</if>
		                	
		                	<if=" $obj->getTitle() ">
		                	<input type="hidden" value="{$obj->getTitle()}" name="bookTitle" />
		                	</if>
		                	
		                	<input type="hidden" value="{$obj->getDimension()}" name="bookDimension" />
		                	<input type="hidden" value="{$obj->getDimensionUnit()}" name="bookDimensionUnit" />
		                	<input type="hidden" value="{$obj->getWeight()}" name="bookWeight" />
		                	<input type="hidden" value="{$obj->getWeightUnit()}" name="bookWeightUnit" />
							
		                	
		                	<div class="col_left">
		                    	<label>ISBN 13:</label>
		                    	<input name="bookISBN" id="bookISBN" value="{$obj->getISBN()}" class="readonly" />

								<label>ISBN 10:</label>
		                    	<input name="bookISBN10" id="bookISBN10" value="{$obj->getISBN10()}" class="readonly" />
		                    	
		                    
		                        <label>Title:</label>
		                        <input name="bookTitle" id="bookTitle" value="{$obj->getTitle()}" class="readonly" />
		                     
		                        <label>Author:</label>
		                        <input name="bookAuthor" id="bookAuthor" value="{$obj->getAuthor()}" class="readonly" />
		                        
		                        <label>Edition:</label>
		                        <input name="bookEdition" id="bookEdition" value="{$obj->getEdition()}" class="readonly" />
		                        
		                        <if=" $option['textbookCondition'] ">
		                        <label>Condition:</label>
		                        <div class='radiocontainer' id='conditioncontainer'>
		                        	<foreach=" $option['textbookCondition'] as $cond">
		                        	<input type="radio" value="{$cond->getId()}" name="tuCondition" class='radio'/>
		                        	<span class='radio'>{$cond->getTitle()}</span>
		                        	</foreach>
		                        	<div class='clear'></div>
		                        </div>
		                        </if>
		                        <!--
		                        <if=" $option['textbookType'] ">
		                        <label>Business:</label>
		                        <div class='radiocontainer' id='typecontainer'>
		                        	<foreach=" $option['textbookType'] as $subject">
		                        	<input type="radio" value="{$subject->getId()}" name="tuType" class='radio'/>
		                        	<span class='radio'>{$subject->getTitle()}</span>
		                        	</foreach>
		                        	<div class='clear'></div>
		                        </div>
		                        </if>
		                        -->
		                        
		                        <label>Subjects:</label>
		                        <select id="tuSubject" name="tuSubject">
		                        	<option value="0">{$vsLang->getWords('sell_form_tuSubject','Please select a subject')}</option>
		                        	<if=" $option['subjectList'] ">
		                        		<foreach=" $option['subjectList'] as $subject">
		                        			<option value="{$subject->getId()}">{$subject->getTitle()}</option>
		                        		</foreach>
		                        	</if>
		                        </select>
		                        
		                        <label>Campus:</label>
		                        <select id="tuCampus" name="tuCampus">
		                        	<option value="0">{$vsLang->getWords('sell_form_tuCampus','Please select a campus')}</option>
		                        	<if=" $option['campusList'] ">
		                        		<foreach=" $option['campusList'] as $campus ">
		                        			<option value="{$campus->getId()}">{$campus->getTitle()}</option>
		                        		</foreach>
		                        	</if>
		                        </select>
		                        
		                        <label>Department:</label>
		                        <input name="tuDepartment" id="tuDepartment" value="{$tu->getDepartment()}" />
		                        
		                        <label>Course:</label>
		                    	<input name="tuCourse" id="tuCourse" value="{$tu->getCourse()}" />
		                        
		                        <label>Professor:</label>
		                        <input name="tuProfessor" id="tuProfessor" value="{$tu->getProfessor()}" />
		                    </div>

		                    <div class="col_right">
		                        <label>Price:</label>
		                        <input name="tuPrice" id="tuPrice" value="{$tu->getPrice(false)}" />
		                        <if=" $option['valid'] ">
		                        <label>Image:</label>
		                        <input type="file" class="input_file" size="16" name="bookImage" />
		                        </if>
		                        <if=" $obj->getImage() ">
		                        	<label>&nbsp;</label>
			                        <div class='img'>
			                        	<if=" $obj->getImage() ">
											{$obj->createImageCache($obj->getImage(),85,115)}
										<else />
											<img src="{$bw->vars['img_url']}/noimage.jpg" alt="{$vsLang->getWords('global_no_image','No Imgae')}" width="85" height="115" />
										</if>
									</div>
		                        </if>
		                        
		                        <label>Publisher:</label>
		                        <input name="bookPublisher" id="bookPublisher" value="{$obj->getPublisher()}" class="readonly" />
		                        
		                        <label>Pub. Date:</label>
		                        <input name="bookRelease" id="bookRelease" value="{$obj->getRelease()}" class="readonly" />
		                        
		                        <label>Format:</label>
		                        <input name="bookFormat" id="bookFormat" value="{$obj->getFormat()}" class="readonly" />
		                        
		                        <label># of Page:</label>
		                        <input name="bookPage" id="bookPage" value="{$obj->getPage()}" class="readonly" />
		                        
		                        <label>Language:</label>
		                        <input name="bookLanguage" id="bookLanguage" value="{$obj->getLanguage()}" class="readonly" />
		                        
		                        <label>Location:</label>
		                        <input name="tuLocation" id="tuLocation" value="{$tu->getLocation()}" class="readonly" />
		                    </div>
		                    <div class="clear_left"></div>
		                    
		                    <label style="width: auto;margin-left:15px">Textbook Description:</label>
		                    <textarea id="tuDescription" name="tuDescription">{$tu->getDescription()}</textarea>
		                    
		                    <label style="width: auto;margin-left:15px">Textbook Comments:</label>
		                    <textarea id="tuComment" name="tuComment">{$tu->getComment()}</textarea>
		                    
		                    <input class="input_submit" name="submitForm" type="submit" value="Submit" />
		                    <input id="preview" class="input_button" type="button" value="Preview" />
		                    
		                    <div class="clear_left"></div>
		                </form>
		           </div>
		        </div>
		    </div>
		    <div class="clear"></div>
		    
		    <script type="text/javascript">
		    	jQuery.validator.addMethod(
					"select_required",
				  	function(value, element) {
				    	if (element.value == 0) return false;
				    	return true; 
				  	},
				  	"Please select an option."
				);

		    	$(document).ready(function(){
					$("#editForm").validate({
						rules: {
							bookTitle: {
								required: true
							},
							tuPrice: {
								required: true,
								number: true
							},
							tuCondition: {
								required: true
							},
							tuType:{
								required: true
							},
							tuSubject:{
								select_required: true
							},
							tuCampus: {
								select_required: true
							}
						},
						messages:{
							bookTitle: {
								required: "{$vsLang->getWords('validate_title_require','Provide a title')}"
							},
							tuPrice: {
								required: "{$vsLang->getWords('validate_price_require','Provide a valid price')}",
								number: "{$vsLang->getWords('validate_price_number','Provide a valid price')}"
							},
							tuCondition: {
								required: "{$vsLang->getWords('validate_condition_require',"Provide your textbook's condition")}"
							},
							tuType: {
								required: "{$vsLang->getWords('validate_type_require',"Provide your textbook's type")}"
							},
							tuSubject: {
								select_required: "{$vsLang->getWords('validate_subject_require',"Provide a subject")}"
							},
							tuCampus: {
								select_required: "{$vsLang->getWords('validate_campus_require',"Provide a campus")}"
							}
						},
						
						success: function(label) {
							label.html("&nbsp;").addClass("checked");
						},
						
						errorPlacement: function(error, element) {
							if($(element).attr('name') == "tuCondition"){
								error.insertAfter($('#conditioncontainer'));
							}
							else{
								if($(element).attr('name') == "tuType")
									error.insertAfter($('#typecontainer'));
								else
									error.insertAfter(element);
							}
						},
						
						submitHandler: function(form) {
							$.blockUI({
					        	css: {
					        		border: 'none', 
		            				padding: '50px',
						            backgroundColor: '#C0C0C0',
						            color: '#000',
						            cursor:'progress',
						        },
							});
							<if=" !$option['valid'] ">
					    		enable();
					    	</if>
					    	form.submit();
						}
					});
				});
		    
		    	vsf.jSelect("{$tu->getSubject()}", "tuSubject");
		    	vsf.jRadio("{$tu->getCondition()}", "tuCondition");
//		    	vsf.jSelect("{$tu->getType()}", "tuType");
		    	vsf.jSelect("{$tu->getCampus()}", "tuCampus");
		    	if($('#tuCampus').val() == 0)
		    		vsf.jSelect("{$vsUser->obj->getCampusId()}", "tuCampus");
		    		
		    	<if=" !$option['valid'] ">
		    		disable();
		    	</if>
		    	
		    	$('#preview').click(function(){
		    		if($('#bookTitle').val()==""){
		    			if($("#bookTitle").attr("class") != "error"){
			    			$("#bookTitle").addClass("error");
			    			var element = '<label for="bookTitle" generated="true" class="error">Enter a book title</label>';
			    			$(element).insertAfter("#bookTitle");
			    		}
			    		return false;
		    		}

					$.blockUI({
			        	css: {
			        		border: 'none', 
            				padding: '50px',
				            backgroundColor: '#C0C0C0',
				            color: '#000',
				            cursor:'progress',
				        },
				        message: "<div id='block_message'><img src='{$bw->vars['board_url']}/styles/images/ajax-loader.gif' alt='loading' /><br />{$vsLang->getWords('global_wait','Please wait...')}</div>",
				        fadeIn: 1000
					});
		    	
					<if=" !$option['valid'] ">
		    			enable()
		    		</if>
					
		    		vsf.submitForm($('#editForm'), 'textbooks/preview', 'previewContainer');
		    		
		    		<if=" !$option['valid'] ">
		    			disable();
		    		</if>
		    		return false;
		    	});
		    	$(document).ajaxStop($.unblockUI); 

		    	function disable(){
		    		$('#bookISBN').attr('disabled','true');
		    		$('#bookISBN10').attr('disabled','true');
		    		$('#bookTitle').attr('disabled','true');
		    		$('#bookAuthor').attr('disabled','true');
		    		$('#bookPublisher').attr('disabled','true');
		    		$('#bookRelease').attr('disabled','true');
		    		$('#bookFormat').attr('disabled','true');
		    		$('#bookPage').attr('disabled','true');
		    		$('#bookLanguage').attr('disabled','true');
		    		$('#bookEdition').attr('disabled','true');
		    	}
		    	
		    	function enable(){
		    		$('#bookISBN').removeAttr('disabled');
		    		$('#bookISBN10').removeAttr('disabled');
		    		$('#bookTitle').removeAttr('disabled');
		    		$('#bookAuthor').removeAttr('disabled');
		    		$('#bookPublisher').removeAttr('disabled');
		    		$('#bookRelease').removeAttr('disabled');
		    		$('#bookFormat').removeAttr('disabled');
		    		$('#bookPage').removeAttr('disabled');
		    		$('#bookLanguage').removeAttr('disabled');
		    		$('#bookEdition').removeAttr('disabled');
		    	}
		    	
		    	
		    </script>
EOF;
	}
	
	function detail($tus, $option){
		global $vsLang, $bw, $vsPrint, $vsTemplate;
		$this->vsLang = $vsLang;
		
		$ltArr = array(	
						2=>$vsLang->getWords('status_pending', 'Pending'),
						3=>$vsLang->getWords('status_sold', 'Sold')
					);
					
		$BWHTML .= <<<EOF
			<style>
				.ui-dialog { position: absolute !important;}
				.tabs-nav li{
					margin-right: 0px !important;
				}
				#listing_detail_tab{
					width: 500px !important;
					margin-top: -15px;
				}
			</style>
			
			{$option['leftHTML']}
			<div id="content1">
	        	{$vsTemplate->global_template->GLOBAL_PARTNER}
		        <div id="content_left">
					<div class="book_detail">
		            	<div class="product_img">
		            		{$tus->bookDetail->createImageCache($tus->bookDetail->getImage(), 85, 115, 0, 1)}
		            	</div>
						<div class="product_intro">
                        	<h4>
                        		<a href="{$tus->bookDetail->getListingURL('textbooks')}" title="{$tus->bookDetail->getTitle()}">
                        			{$tus->bookDetail->getTitle()}
                        		</a>
                        	</h4>
                            <p>{$tus->bookDetail->getAuthor()}</p>
							<p>({$tus->bookDetail->getPublisher()}<if="$tus->bookDetail->getRelease()">, {$tus->bookDetail->getRelease()}</if>)</p>
							<div id="condition">
								<span style="font-weight:bold;">Condition</span> {$tus->getCondition()}
								<span style="margin-left: 10px;font-weight:bold;">Seller</span> {$tus->seller->getAlias()}

								<if=" $tus->lt->getStatus() <> 3">
			                        <a class="buy" id="makeanoffer" title="{$vsLang->getWords('global_buy_this_book','Buy this book')}" href="javascript:;" >
			                        	{$vsLang->getWords('global_make_offer','Make an Offer')}
			                        </a>
								</if>
							</div>
							<p class="cost">
								{$vsLang->getWords('global_curency','$')}
								{$tus->getPrice()} {$ltArr[$tus->lt->getStatus()]}
							</p>
                        </div>
                        
                        
		                <div class="clear"></div>
						<div id="ratingdiv" class="vote_img">
							<div id='mainratingdiv'>
                        	<div ref="{$tus->bookDetail->getId()}">
                        		<input type='hidden' id='currate' name='currate' value='{$tus->bookDetail->getStar()}' />
			                	<img id="R1" alt="0" width="18" title="Not at All" src="{$bw->vars['js']}/icampus/rating/images/rate0.png" />
								<img id="R2" alt="1" width="18" title="Somewhat" src="{$bw->vars['js']}/icampus/rating/images/rate0.png" />
								<img id="R3" alt="2" width="18" title="Average" src="{$bw->vars['js']}/icampus/rating/images/rate0.png" />
								<img id="R4" alt="3" width="18" title="Good" src="{$bw->vars['js']}/icampus/rating/images/rate0.png" />
								<img id="R5" alt="4" width="18" title="Very Good" src="{$bw->vars['js']}/icampus/rating/images/rate0.png" />
							</div>
							<div id='confirmrating'></div>
							</div>
		                </div>
						
		               	<div id="listing_detail_tab">
		                	<ul>
		                		<li class="tabitem0">
			                		<a href="#detail" class="bookdetail_btn"><span>Details</span></a>
			                	</li>
			                	<li class="tabitem1">
			                		<a href="#sellerInfo" class="bookdetail_btn"><span>Seller Information</span></a>
			                	</li>
			                	<div class="clear_left"></div>
			                </ul>
			                <div id="detail">
				                <p><span># of page:</span> {$tus->bookDetail->getPage()} pages</p>
				                
				                <p><span>Publisher:</span> {$tus->bookDetail->getPublisher()} <if=" $tus->bookDetail->getRelease() ">({$tus->bookDetail->getRelease()})</if></p>
				                
				                <p><span>Edition:</span> {$tus->bookDetail->getEdition()}</p>
				                
				                <p><span>ISBN-10:</span> {$tus->bookDetail->getISBN10()}</p>
				                
				                <p><span>ISBN-13:</span> {$tus->bookDetail->getISBN()}</p>
				                
				                <p><span>Language:</span> {$tus->bookDetail->getLanguage()}</p>
				                
				                <if=" $tus->getCampus() ">
				                <p><span>Campus:</span> {$tus->getCampus()}</p>
				                </if>
				                
				                <p><span>Professor:</span> {$tus->getProfessor()}</p>
				                
				                <p><span>Course title:</span> {$tus->getCourse()}</p>
				                
				                <p><span>Description:</span></p>
								{$tus->getDescription()}
								
				                <p><span>Comments:</span></p>
				                {$tus->getComment()}
							</div>

							<div id="sellerInfo">
				                <p><span>Username:</span> {$tus->seller->getAlias()}</p>
							</div>

							<div class="clear_left"></div>
			            </div>
			            <div class="clear_left"></div>
		            </div>
		            
		            <if=" $option['other'] ">
		           	<div class="seller_border">
		            	<div class="user_title">
		            		<h3>{$this->vsLang->getWords('seller_other_book', 'More Listings From The Seller')}</h3>
	            		</div>
		                <div class="seller_list">
		                	<foreach=" $option['other'] as $obj">
		                    <div class="seller_item">
		                        <div class="seller_img">
		                        	<a href="{$obj->tu->getURL($obj->getTitle())}" title="{$obj->getTitle()}">
		                        	<if=" $obj->getImage() ">
										{$obj->createImageCache($obj->getImage(),85,115, 0, 1)}
									</if>
									</a>
		                        </div>
		                        <h3 class="bookTitle">
		                        	<a href="{$obj->tu->getURL($obj->getTitle())}" title="{$obj->getTitle()}">
		                        		{$obj->getTitle(50)}
	                        		</a>
	                        	</h3>
	                        	<div class="description">
		                        	<p class='author'>{$obj->getAuthor(25)}</p>
		                        	<if=" $obj->getPublisher() || $obj->getRelease() ">
		                        		<p>(<if="  $obj->getFormat() ">{$obj->getFormat()},</if><if="$obj->getRelease()">{$obj->getRelease()}</if>)</p>
		                        	</if>
		                        </div>
		                        <p class="cost">
		                        		<span class='buyfrom'>Price </span>
		                        		{$this->vsLang->getWords('global_curency','$')}
		                        		{$obj->tu->getPrice()}
		                        </p>
		                    </div>
		                    </foreach>
		                    <div class="clear_left"></div>
		                </div>
		            </div>
           			</if>
	    		</div>
	    	</div>
		    <div class="clear"></div>
		    <div id="callback"></div>
		    <script type="text/javascript">
            	$(document).ready(function() { 
					$(function() {						
						setRating('{$tus->bookDetail->getStar()}');
						
						$('#listing_detail_tab').tabs({ 
							fxFade: true, 
							fxSpeed: 'fast'
						});
					});
					$('#makeanoffer').click(function(){
						var option = {
										title: '{$vsLang->getWords('global_make_offer','Make an Offer')}',
										width: 600,
										height: 600,
										params:{
											mainmod: "textbook",
											seller: "{$tus->getUser()}",
											bookTitle: "{$tus->bookDetail->getTitle()}",
											popupId: "global_formContainer"
										}
									};
						vsf.popupLightGet('messages/popup', 'global_formContainer', option);
					});
				});
            </script>
EOF;
	}
	
	function subject($option){
		global $bw, $vsLang, $vsTemplate;
		$BWHTML .= <<<EOF
			{$option['leftHTML']}
			<div id="content1">
				{$vsTemplate->global_template->GLOBAL_PARTNER}
	        	<div id="content_left">
           
					<div class="navigation1 clear_left">
						<if=" $option['subject'] ">
		            	<a href="#" tilte="{$option['subject']->getTitle()}">
		            		{$option['subject']->getTitle()}
		            	</a>
		            	</if>
		            </div>
		            <div id="pro_tab">
		            	<ul>                
		                	<span class="sort">Sort by:</span>	
		                    <li <if=" !$option['order'] ">class="tabs-selected"</if>><a href="#BEST"><span>Best Selling</span></a></li>
		                	<li <if=" $option['order'] == 'price' ">class="tabs-selected"</if>><a href="#PRICE"><span>Price</span></a></li>
		                    <li <if=" $option['order'] == 'alpha' ">class="tabs-selected"</if>><a href="#ALPHA"><span>Alphabetical</span></a></li>
		                    <li <if=" $option['order'] == 'release' ">class="tabs-selected"</if>><a href="#PUBL"><span>Publication Date</span></a></li>            
		                </ul>
		                <div id="BEST">
		                	<if=" $option['best']['pageList'] ">
		                	<foreach=" $option['best']['pageList'] as $book ">
		                	<div class="product">
		                   		<div class="product_img">
		                   			<a href="{$book->getListingURL('textbooks')}" title="{$book->getTitle()}">
										{$book->createImageCache($book->getImage(),85,115, 0, 1)}
									</a>
								</div>
		                        <div class="product_intro">
		                        	<h4><a href="{$book->getListingURL('textbooks')}" title="{$book->getTitle()}">{$book->getTitle()}</a></h4>
		                            <p>{$book->getAuthor()}</p>
									<p>({$book->getPublisher()}<if="$book->getRelease()">, {$book->getRelease()}</if>)</p>
									<if=" $book->price ">
		                            <p class="cost">
		                        		{$book->price}
		                            </p>
		                            </if>
		                        </div>
		                        <div class="clear_left"></div>
		                   	</div>
		                   	</foreach>
		                   	<else />
		                   		<div class="product">
		                   			<b>No listing in this subject</b>
		                   		</div>
		                   	</if>
		                   
		                   <if=" $option['best']['paging'] ">
		                   <div class="page">
		                   		<span>Browse Pages:</span>
		                   		{$option['best']['paging']}
		                   </div>
		                   </if>
		                </div>
		                <div id="PRICE">
		                	<if=" $option['price']['pageList'] ">
		                	<foreach=" $option['price']['pageList'] as $book ">
		                	<div class="product">
		                   		<div class="product_img">
		                   			<a href="{$book->getListingURL('textbooks')}" title="{$book->getTitle()}">
		                        	<if=" $book->getImage() ">
										{$book->createImageCache($book->getImage(),85,115)}
									<else />
										<img src="{$bw->vars['img_url']}/noimage.jpg" alt="{$vsLang->getWords('global_no_image','No Imgae')}" width="85" height="115" />
									</if>
									</a>
								</div>
		                        <div class="product_intro">
		                        	<h4><a href="{$book->getListingURL('textbooks')}" title="{$book->getTitle()}">{$book->getTitle()}</a></h4>
		                            <p>{$book->getAuthor()}</p>
									<p>({$book->getPublisher()}<if="$book->getRelease()">, {$book->getRelease()}</if>)</p>
		                            <if=" $book->price ">
		                            <p class="cost">
		                        		{$vsLang->getWords('global_curency','$')}
		                        		{$book->price}
		                            </p>
		                            </if>
		                        </div>
		                        <div class="clear_left"></div>
		                   </div>
		                   </foreach>
		                   <else />
		                   		<div class="product">
		                   			<b>No listing in this subject</b>
		                   		</div>
		                   </if>
		                   
		                   <if=" $option['price']['paging'] ">
		                   <div class="page">
		                   		<span>Browse Pages:</span>
		                   		{$option['price']['paging']}
		                   </div>
		                   </if>
		                </div>
		                
		                <div id="ALPHA">
		                	<if=" $option['alpha']['pageList'] ">
		                	<foreach=" $option['alpha']['pageList'] as $book ">
		                	<div class="product">
		                   		<div class="product_img">
		                   			<a href="{$book->getListingURL('textbooks')}" title="{$book->getTitle()}">
		                        	<if=" $book->getImage() ">
										{$book->createImageCache($book->getImage(),85,115)}
									<else />
										<img src="{$bw->vars['img_url']}/noimage.jpg" alt="{$vsLang->getWords('global_no_image','No Imgae')}" width="85" height="115" />
									</if>
									</a>
								</div>
		                        <div class="product_intro">
		                        	<h4><a href="{$book->getListingURL('textbooks')}" title="{$book->getTitle()}">{$book->getTitle()}</a></h4>
		                            <p>{$book->getAuthor()}</p>
									<p>({$book->getPublisher()}<if="$book->getRelease()">, {$book->getRelease()}</if>)</p>
		                            <if=" $book->price ">
		                            <p class="cost">
		                        		{$vsLang->getWords('global_curency','$')}
		                        		{$book->price}
		                            </p>
		                            </if>
		                        </div>
		                        <div class="clear_left"></div>
		                   </div>
		                   </foreach>
		                   <else />
		                   		<div class="product">
		                   			<b>No listing in this subject</b>
		                   		</div>
		                   </if>
		                   
		                   <if=" $option['alpha']['paging'] ">
		                   <div class="page">
		                   		<span>Browse Pages:</span>
		                   		{$option['alpha']['paging']}
		                   </div>
		                   </if>
		                </div>
		                
		                <div id="PUBL">
		                	<if=" $option['release']['pageList'] ">
		                	<foreach=" $option['release']['pageList'] as $book ">
		                	<div class="product">
		                   		<div class="product_img">
		                   			<a href="{$book->getListingURL('textbooks')}" title="{$book->getTitle()}">
		                        	<if=" $book->getImage() ">
										{$book->createImageCache($book->getImage(),85,115)}
									<else />
										<img src="{$bw->vars['img_url']}/noimage.jpg" alt="{$vsLang->getWords('global_no_image','No Imgae')}" width="85" height="115" />
									</if>
									</a>
								</div>
		                        <div class="product_intro">
		                        	<h4><a href="{$book->getListingURL('textbooks')}" title="{$book->getTitle()}">{$book->getTitle()}</a></h4>
		                            <p>{$book->getAuthor()}</p>
									<p>({$book->getPublisher()}<if="$book->getRelease()">, {$book->getRelease()}</if>)</p>
		                           	<if=" $book->price ">
		                            <p class="cost">
		                        		{$vsLang->getWords('global_curency','$')}
		                        		{$book->price}
		                            </p>
		                            </if>
		                        </div>
		                        <div class="clear_left"></div>
		                   </div>
		                   </foreach>
		                   <else />
		                   		<div class="product">
		                   			<b>No listing in this subject</b>
		                   		</div>
		                   </if>
		                   
		                   <if=" $option['release']['paging'] ">
		                   <div class="page">
		                   		<span>Browse Pages:</span>
		                   		{$option['release']['paging']}
		                   </div>
		                   </if>
		                </div>
		            </div>
		        </div>
	    	</div>
	    	<div class="clear"></div>
	    	<script type="text/javascript">
			      $(function() {
			          $('#pro_tab').tabs({ fxFade: true, fxSpeed: 'fast' });
			      });
			</script>
EOF;
		return $BWHTML; 
	}
	
	function preview($tus, $book, $option){
		global $vsLang, $vsUser;
	
		$BWHTML .= <<<EOF
					<style>
						.tabs-nav li{
							margin-right: 0px;
						}
					</style>
					<div class="book_detail" id='bookpreview' style='margin-bottom:10px;'>
		            	<div class="product_img">
		            		{$book->createImageCache($book->getImage(),85,115, 0, 0, 1)}
		            	</div>
						<div class="product_intro">
                        	<h4>
                        		<a href="{$book->getUrl('textbooks')}" title="{$book->getTitle()}">
                        			{$book->getTitle()}
                        		</a>
                        	</h4>
                            <p>{$book->getAuthor()}</p>
							<p>({$book->getPublisher()}<if="$book->getRelease()">, {$book->getRelease()}</if>)</p>
							<div id="condition">
								<span>Condition</span> {$tus->getCondition()}
								<span style="margin-left: 10px">Seller</span> {$vsUser->obj->getAlias()}
							</div>
							<p class="cost">
								{$vsLang->getWords('global_curency','$')}
								{$tus->getPrice()}
							</p>
                        </div>
                        <div class="clear"></div>
                        
		                <a class="buy" id="closepreview" href="javascript:closepreview();" title="{$vsLang->getWords('close_preview','Close this preview')}">
                        	{$vsLang->getWords('global_close','Close')}
                        </a>
		                <div id="detail_tab">
			                <ul>
				                <li>
					                <a href="#detail" class="bookdetail_btn">
					                	<span>{$vsLang->getWords('detail','Details')}</span>
					                </a>
				                </li>

								<li>
					                <a href="#sellerinfo" class="bookdetail_btn">
					                	<span>{$vsLang->getWords('seller_info','Seller Information')}</span>
					                </a>
				                </li>
			                </ul>
			                
			                <div id="detail">
				                <p><span># of page:</span> {$book->getPage()} pages</p>
				                
				                <p><span>Publisher:</span> {$book->getPublisher()} <if=" $book->getRelease() ">({$book->getRelease()})</if></p>
				                
				                <p><span>Edition:</span> {$book->getEdition()}</p>
				                
				                <p><span>ISBN-10:</span> {$book->getISBN10()}</p>
				                
				                <p><span>ISBN-13:</span> {$book->getISBN()}</p>
				                
				                <p><span>Language:</span> {$book->getLanguage()}</p>
				                
				                <if=" $tus->getCampus() ">
				                <p><span>Campus:</span> {$tus->getCampus()}</p>
				                </if>
				                
				                <p><span>Professor:</span> {$tus->getProfessor()}</p>
				                
				                <p><span>Course title:</span> {$tus->getCourse()}</p>
				                
				                <p><span>Description:</span></p>
								{$tus->getDescription()}
								
				                <p><span>Comments:</span></p>
				                {$tus->getComment()}
							</div>
							<div id="sellerinfo">
				                <p><span>Username:</span> {$vsUser->obj->getAlias()}</p>
							</div>
							<div class="clear"></div>
		                </div>
		                <div class="clear"></div>
		            </div>
				    <script type="text/javascript">
		            	$(document).ready(function() { 
							$(function() {
								$('#detail_tab').tabs({ fxFade: true, fxSpeed: 'fast'});
							});
						});
						
						function closepreview(){
							$('#previewContainer').html('');
						}
		            </script>
EOF;
	}
	
	function search($option){
		global $vsLang, $bw, $vsTemplate;
		
		$BWHTML .= <<<EOF
			<div id="searchcontent">
		        <div id="content_left">
		        	<form id='maintbform' method='GET' class="search_form" action="{$bw->input['board_url']}/textbooks/search">
	            		<div class='formtext'>
	            			<span class='title'>Find textbooks</span>
	            			<span id='advance'>Advance search </span>
	            		</div>
	            		<div class="search_form_tt">
			            	<input name='keyword' id='search-keyword' value="{$option['keyword']}" type='text' />
			            </div>
		            	<input type='button' name='submit' value='Find' class='search_btn' id='searchfriend'/>
		            	<div class='clear_left'></div>
		            </form>
		        
		        
		        	<input type='hidden' name='tblist' value='{$option['tblist']}' id='tblist'/>
					<script type="text/javascript">
						$('#maintbform').submit(function(){
							var hidden = '<input type="hidden" name="instant" value="main"/>';
							$(this).append(hidden);
							
							vsf.submitForm($(this), 'textbooks/search', 'main-container');
							
							$(this).find(":hidden").each(function(){
								$(this).remove();
							});
							return false;
						});
						
						$(document).ready(function(){
							var options = {
							    callback:function(){							    	
							    	$('#maintbform').submit();
								},
							    wait:300,
							    highlight:true,
							    captureLength: 2
							}
							$("#search-keyword").typeWatch(options);
						});
					</script>
		            <div class='clear_left'></div>
		            <div id='main-container'>
		            	{$this->mainsearch($option)}
		            </div>
				</div>
	    	<div class="clear"></div>
			</div>
EOF;
		return $BWHTML;
	}
	
	
	function mainsearch($option){
		global $vsLang, $bw;
		$BWHTML .= <<<EOF
			<div id='mainsearch'>
				<if=" $option['tulist'] ">
				<foreach=" $option['tulist'] as $book">
					<div class="result">
						<div class="product_img">
							<a href="{$book['bookListingURL']}" title="{$book['bookTitle']}">
								{$book['bookImage']}
							</a>
						</div>
						<div class="product_intro">
							<h4>
								<a href="{$book['bookListingURL']}" title="{$book['bookTitle']}">
									{$book['bookTitle']}
								</a>
							</h4>
							<p>{$book['bookAuthor']}</p>
							<p>{$book['bookPInfo']}</p>
							<p class="cost">
								{$book['tuPrice']}
								<input name='sellyours' class='sellyours' value='Sell yours' ref='{$book['searchObj']}' type='button'/>
							</p>
						</div>
						<div class="clear_left"></div>
					</div>
				</foreach>
				<else />
				<div class="result">
					<b>Sorry! Nobody is selling your textbook</b>
				</div>
				</if>
				<if=" $option['paging'] ">
					<div class="page">
						<span>Browse Pages:</span>
						{$option['paging']}
					</div>
				</if>
				<script type='text/javascript'>
					$('.sellyours').click(function(){
						location.href="{$bw->vars['board_url']}/textbooks/sell&tb="+$(this).attr('ref');
					});
				</script>
			</div>
EOF;
	}
	
	function loadMore($option){
		global $vsLang, $bw, $vsTemplate;
		
		$BWHTML .= <<<EOF
		{$option['leftHTML']}
		<div id="content1">
	        {$vsTemplate->global_template->GLOBAL_PARTNER}
        
	        <div id="content_left">
	           	{$this->searchForm()}
	            <!-- FIND BOOK BORDER -->
	            
	            <div class="seller_border">
	            	<div class="user_title">
	                	<h3>{$option['moretitle']}</h3>
	                </div>
	                <div id='more-contain'>
	                	<div id='pandog'>{$option['mainmore']}<div>
	                </div>
	            </div>
	        </div>
	        <if=" $option['fbscript'] ">
	        <script type='text/javascript'>
				$('#more-contain').scrollExtend({	
					'target': 'div#pandog',
					'url': '{$option['url']}/&t=load&ajax=1'
				});
			</script>
			</if>
	    </div>
	    <div class="clear"></div>
EOF;
	}
	
	function mainmore($option = array()){
		global $vsLang, $bw, $vsTemplate;
		
		$BWHTML .= <<<EOF
					<if=" $option['pageList'] ">
                	<foreach=" $option['pageList'] as $book ">
	                    <div class="product">
	                   		<div class="product_img">
	                   			<a href="{$book->getListingURL('textbooks')}" title="{$book->getTitle()}">
	                        	<if=" $book->getImage() ">
									{$book->createImageCache($book->getImage(),85,115, 0, 1)}
								</if>
								</a>
							</div>
	                        <div class="product_intro">
	                        	<h4><a href="{$book->getListingURL('textbooks')}" title="{$book->getTitle()}">{$book->getTitle()}</a></h4>
	                            <p>{$book->getAuthor()}</p>
								<p>({$book->getPublisher()}<if="$book->getRelease()">, {$book->getRelease()}</if>)</p>
	                            <p class="cost">
	                            	<if=" $book->price ">
	                            		{$vsLang->getWords('global_curency','$')}
		                        		{$book->price}
		                        	</if>
	                            </p>
	                        </div>
	                        <div class="clear_left"></div>
	                   	</div>
                    </foreach>
                    </if>
EOF;
	}
	
	function userNavigator(){
		$BWHTML .= <<<EOF
				<div class="user_status">
	                <div class="user_title">
	                    <p class="user_nick">David Beckham (Love_Victoria)</p>
	                    <p class="user_status"><strong>Current status</strong> clear</p>
	                </div>
	                <div class="clear"></div>
	                <form>
	                    <input type="text" onfocus="if(this.value=='What are you doing?') this.value='';" onblur="if(this.value=='') this.value='What are you doing?';" value="What are you doing?"  />
	                    <button>Update</button>
	                </form>
	                <div class="user_menu">
	                	<ul>
	                        <li><a href="#" class="active">IM</a></li>
	                        <li><a href="#">Info</a></li>
	                        <li><a href="#">Photos</a></li>
	                        <li><a href="#">My Campus</a></li>                       
	                        <li class="last_li"><a href="#">more >> </a></li>
	                    </ul>
	                </div>
	            </div>
EOF;
	}

	function leftSubject($option = array()){
		global $bw;
		$BWHTML .= <<<EOF
			<div id="sitebar">
		        <div class="subject_list">
		        	<h3>Subjects</h3>
		        	<if=" $option ">
		        	<foreach=" $option as $cat ">
		            <a href="{$cat->subURL}" title="{$cat->getTitle()}">{$cat->getTitle()}</a>
		            </foreach>
		            </if>
		        </div>
		    </div>
EOF;
		return $BWHTML; 
	}

	function searchForm($option = array()){
		global $bw;
		return $BWHTML .= <<<EOF
				<div class="find_book_border1">            	
	                <div class="find_book">
	                	<h3>Find Textbooks</h3>
	                    <form action="{$bw->vars['board_url']}/textbooks/search" method="get" id='textbook-search'>
	                    	<input name='keyword' id='tb-keyword' placeholder="Enter your keyword" value="" />
	                    	<input type="submit" value="search" class="input_sumit">
	                    </form>
	                </div>
	                <div class="sell_book">
	                	<h3>Sell Textbooks</h3>
	                    <form action="{$bw->vars['board_url']}/textbooks/isbn" id="ISBN" method="post">
	                    	<input name="bookISBN" placeholder="Enter your textbook's isbn" />
	                    	<input type="submit" value="sell" class="input_sumit">
	                    </form>
	                </div>
	            </div>
	            <style>
	            	.ac_results ul li{
	            		padding: 10px;
	            	}
	            	.ac_results ul li img{
	            		width: 50px;
	            		float:left;
	            		margin-right: 10px;
	            	}
	            	.ac_results ul li div{
	            		width: 400px;
	            		float:left;
	            	}
	            </style>
				<script type="text/javascript">
					$(document).ready(function() {
						$("#tb-keyword").autocomplete("{$bw->base_url}textbooks/suggest", {
							dataType: 'json',
							width: 521,
							matchContains: true,
							minChars: 4,
							selectFirst: false,
							formatItem: function(row, i, max, term) {
								return row.image +
									   "<div class='ci-title'>"+row.title+"</div>"+
									   "<div class='ci-author'>"+row.author+"</div>"+
									   "<div class='ci-isbn'>ISBN 13: "+row.isbn+"</div>"+
									   "<div class='ci-isbn'>ISBN 10: "+row.isbn10+"</div>"+
									   "<div class='clear'></div>";
							},
							parse: function(data) {
					          var rows = new Array();
					          for(var i=0; i<data.length; i++){
					              rows[i] = {data:data[i], value:data[i].title, result:data[i].title};
					          }
					          return rows;
					      	},
					      	scrollHeight: 300
						}).result(function(event, item){
							location.href = item.url;
						});
					});
				</script>
EOF;
	}

	function objFormPortlet($obj, $tu, $option){
		global $vsLang, $bw, $vsPrint, $vsUser, $vsTemplate;

	
		$BWHTML .= <<<EOF
			<style>
				#closeEditForm{
					float:right;
					margin-right: 10px;
					cursor:pointer;
				}
			</style>
			<div class="sell_textbook">
				<h3>
					<span>Sell your textbook</span>
					<span id='closeEditForm'>X</span>
					<div class='clear'></div>
				</h3>
                <form method="post" enctype="multipart/form-data" id="editForm">
	                <input type="hidden" value="{$tu->getId()}" name="tuId" />
	                
	                <input type="hidden" value="{$obj->getId()}" name="bookId" />
	                <input type="hidden" value="{$obj->getImage()}" name="oldImage" />
	                <input type="hidden" value="{$option['valid']}" name="direct" />
	                <input type="hidden" value="{$obj->getDimension()}" name="bookDimension" />
	                <input type="hidden" value="{$obj->getDimensionUnit()}" name="bookDimensionUnit" />
	                <input type="hidden" value="{$obj->getWeight()}" name="bookWeight" />
	                <input type="hidden" value="{$obj->getWeightUnit()}" name="bookWeightUnit" />
	                <input type="hidden" value="{$obj->getUrl('textbooks')}" name="bookUrl" />
	
	                <div class="col_left">
	                    <label>ISBN 13:</label>
	                    <input name="bookISBN" id="bookISBN" value="{$obj->getISBN()}" class="readonly" />
	
						<label>ISBN 10:</label>
	                    <input name="bookISBN10" id="bookISBN10" value="{$obj->getISBN10()}" class="readonly" />
	                    
						<label>Title:</label>
						<input name="bookTitle" id="bookTitle" value="{$obj->getTitle()}" class="readonly" />
	                        
						<label>Author:</label>
						<input name="bookAuthor" id="bookAuthor" value="{$obj->getAuthor()}" class="readonly" />
	                        
						<label>Edition:</label>
						<input name="bookEdition" id="bookEdition" value="{$obj->getEdition()}" class="readonly" />
	                        
						<if=" $option['textbookCondition'] ">
						<label>Condition:</label>
						<select id="tuCondition" name="tuCondition">
						<foreach=" $option['textbookCondition'] as $subject">
						<option value="{$subject->getId()}">{$subject->getTitle()}</option>
						</foreach>
						</select>
						</if>
	                        
						<if=" $option['textbookType'] ">
						<label>Business:</label>
						<select id="tuType" name="tuType">
						<foreach=" $option['textbookType'] as $subject">
						<option value="{$subject->getId()}">{$subject->getTitle()}</option>
						</foreach>
						</select>
						</if>
	                        
						<label>Subjects:</label>
						<select id="tuSubject" name="tuSubject">
						<if=" $option['subjectList'] ">
						<foreach=" $option['subjectList'] as $subject">
						<option value="{$subject->getId()}">{$subject->getTitle()}</option>
						</foreach>
						</if>
						</select>
	                        
						<label>Campus:</label>
						<select id="tuCampus" name="tuCampus">
						<option value="0">{$vsLang->getWords('campus','Campus')}</option>
						<if=" $option['campusList'] ">
						<foreach=" $option['campusList'] as $campus ">
						<option value="{$campus->getId()}">{$campus->getTitle()}</option>
						</foreach>
						</if>
						</select>
	                        
						<label>Department:</label>
						<input name="tuDepartment" id="tuDepartment" value="{$tu->getDepartment()}" />
	                        
						<label>Course:</label>
	                    <input name="tuCourse" id="tuCourse" value="{$tu->getCourse()}" />
                        
                        <label>Professor:</label>
                        <input name="tuProfessor" id="tuProfessor" value="{$tu->getProfessor()}" />
                    </div>

                    <div class="col_right">
                        <label>Price:</label>
                        <input name="tuPrice" id="tuPrice" value="{$tu->getPrice(false)}" />
                        
                        <if=" $option['valid'] ">
                        <label>Image:</label>
                        <input type="file" class="input_file" size="16" name="bookImage" />
                        </if>
                        
	                        <if=" $obj->getImage() ">
	                        <label>&nbsp;</label>
	                        <div class='img'>
	                        <if=" $obj->getImage() ">
								{$obj->createImageCache($obj->getImage(),85,115)}
							<else />
								<img src="{$bw->vars['img_url']}/noimage.jpg" alt="{$vsLang->getWords('global_no_image','No Imgae')}" width="85" height="115" />
							</if>
					</div>
					</if>
                        
					<label>Publisher:</label>
					<input name="bookPublisher" id="bookPublisher" value="{$obj->getPublisher()}" class="readonly" />
                        
					<label>Pub. Date:</label>
					<input name="bookRelease" id="bookRelease" value="{$obj->getRelease()}" class="readonly" />
                        
					<label>Format:</label>
					<input name="bookFormat" id="bookFormat" value="{$obj->getFormat()}" class="readonly" />
                        
					<label># of Page:</label>
					<input name="bookPage" id="bookPage" value="{$obj->getPage()}" class="readonly" />
                        
					<label>Language:</label>
					<input name="bookLanguage" id="bookLanguage" value="{$obj->getLanguage()}" class="readonly" />
                        
					<label>Location:</label>
					<input name="tuLocation" id="tuLocation" value="{$tu->getLocation()}" class="readonly" />
                    </div>
                    <div class="clear_left"></div>
                    
                    <label style="width: auto;margin-left:15px">Textbook Description:</label>
                    <textarea id="tuDescription" name="tuDescription">{$tu->getDescription()}</textarea>
                    
                    <label style="width: auto;margin-left:15px">Textbook Comments:</label>
                    <textarea id="tuComment" name="tuComment">{$tu->getComment()}</textarea>
                    
                    <input id="submitF" class="input_submit" name="submitF" type="button" value="Submit" />
                    
                    <div class="clear_left"></div>
                </form>
		    </div>
		    <script type="text/javascript">
		    	$(document).ready(function(){
		    		$('#closeEditForm').click(function(){
		    			$('#editForm').toggle("slow", function(){
							$('#rowtemp').remove();
						});
		    		});
		    	
		    		$('#submitF').click(function(){
		    			$('#editForm').prepend('<div id="editFromCallback"></div>');
		    		
		    			var hidden = "<input type='hidden' name='submitForm' value='submit' />";
		    			$('#editForm').append(hidden);

		    			var hidden = "<input type='hidden' name='ltId' value='"+$('#rowtemp').attr('rel')+"' />";
		    			$('#editForm').append(hidden);
		    			
		    			
		    			vsf.submitForm($("#editForm"), 'listings/editlt', 'editFromCallback');
		    			return false;
		    		});
		    		
					$("#editForm").validate({
						rules: {
							bookTitle: {
								required: true
							},
							tuPrice: {
								required: true,
								number: true
							}
						},
						messages:{
							bookTitle: {
								required: "{$vsLang->getWords('validate_title_require','Provide a title')}"
							},
							tuPrice: {
								required: "{$vsLang->getWords('validate_price_require','Provide a valid price')}",
								number: "{$vsLang->getWords('validate_price_number','Provide a valid price')}"
							}
						},
						
						success: function(label) {
							label.html("&nbsp;").addClass("checked");
						},
						
						submitHandler: function(form) {
							$.blockUI({
					        	css: {
					        		border: 'none', 
		            				padding: '50px',
						            backgroundColor: '#C0C0C0',
						            color: '#000',
						            cursor:'progress',
						        },
							});
							<if=" !$option['valid'] ">
					    		enable();
					    	</if>
					    	form.submit();
						}
					});
				});
		    
				vsf.jSelect("{$tu->getSubject()}", "tuSubject");
				
		    	vsf.jSelect("{$tu->getCondition()}", "tuCondition");
		    	vsf.jSelect("{$tu->getType()}", "tuType");
		    	vsf.jSelect("{$tu->getCampus()}", "tuCampus");
		    	
		    	disable();
		    	
		    	$(document).ajaxStop($.unblockUI); 

		    	function disable(){
		    		$('#bookISBN').attr('disabled','true');
		    		$('#bookISBN10').attr('disabled','true');
		    		$('#bookTitle').attr('disabled','true');
		    		$('#bookAuthor').attr('disabled','true');
		    		$('#bookPublisher').attr('disabled','true');
		    		$('#bookRelease').attr('disabled','true');
		    		$('#bookFormat').attr('disabled','true');
		    		$('#bookPage').attr('disabled','true');
		    		$('#bookLanguage').attr('disabled','true');
		    		$('#bookEdition').attr('disabled','true');
		    	}
		    	
		    	function enable(){
		    		$('#bookISBN').removeAttr('disabled');
		    		$('#bookISBN10').removeAttr('disabled');
		    		$('#bookTitle').removeAttr('disabled');
		    		$('#bookAuthor').removeAttr('disabled');
		    		$('#bookPublisher').removeAttr('disabled');
		    		$('#bookRelease').removeAttr('disabled');
		    		$('#bookFormat').removeAttr('disabled');
		    		$('#bookPage').removeAttr('disabled');
		    		$('#bookLanguage').removeAttr('disabled');
		    		$('#bookEdition').removeAttr('disabled');
		    	}
		    </script>
EOF;
	}
	
	
	
	
	
	
	
	function callback($option){
		global $vsLang;
		$BWHTML .= <<<EOF
			<script type='text/javascript'>
				$('#block_message').html('{$option['message']}');
				setTimeout(function() { 
		        	$.unblockUI();
		        	{$option['script']}
		        }, 2000);
			</script>
EOF;
		return $BWHTML;
	}
}
?>