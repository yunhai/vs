<?php
class skin_textbooks{
	
	function MainPage() {
		global $bw, $vsLang;
		$BWHTML .= <<<EOF
			<div id="page_tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all-top">
				<ul id="tabs_nav" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-corner-all-inner">
				
					<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active">
			        	<a href="{$bw->base_url}textbooks/display-textbook-tab/&ajax=1">
			        		<span>{$vsLang->getWords('tab_textbook_obj','Textbook')}</span>
		        		</a>
			        </li>
			        
			        <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active">
			        	<a href="{$bw->base_url}textbooks/display-textbook-tab/&type=verify&ajax=1">
			        		<span>{$vsLang->getWords('tab_verify_textbook_obj','Verify Textbook')}</span>
		        		</a>
			        </li>

					<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active">
			        	<a href="{$bw->base_url}menus/display-category-tab/textbooks/&ajax=1">
			        		<span>{$vsLang->getWords('tab_book_category','Subject')}</span>
		        		</a>
			        </li>
			        
			        <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active">
			        	<a href="{$bw->base_url}menus/display-category-tab/condition/&ajax=1">
			        		<span>{$vsLang->getWords('tab_textbook_condition','Textbook Condition')}</span>
		        		</a>
			        </li>

			        <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active">
			        	<a href="{$bw->base_url}menus/display-category-tab/type/&ajax=1">
			        		<span>{$vsLang->getWords('tab_textbook_business','Business type')}</span>
		        		</a>
			        </li>
				</ul>
			</div>
EOF;
		return $BWHTML;
	}
	
	function displayBookTab($option=array()){
		global $vsLang, $bw;
		$BWHTML = <<<EOF
			<div id='TabContainer'>
				<div id="mainContainer{$option['textbooktype']}" class='right-cell' style='width:100%;'>
					{$option['listHTML']}
				</div>
				<div class="clear"></div>
			</div>
EOF;
		return $BWHTML;
	}

	function objListHtml($option=array()){
		global $vsLang, $bw;
		$BWHTML = "";
		$message = $vsLang->getWords('deleteConfirm_NoItem', "You haven't choose any items!");
	
		$BWHTML .= <<<EOF
			<div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
			    <div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
			        <span class="ui-icon ui-icon-triangle-1-e"></span>
			        <span class="ui-dialog-title">{$vsLang->getWords('listobj','List of Campus')}</span>
			    </div>
			    
			    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-corner-all-inner ui-widget-header">
		    		<li class="ui-state-default ui-corner-top">
			        	<a id="deletePage" title="{$vsLang->getWords('delete_obj','Delete')}" onclick="deleteBook();" href="#">
							{$vsLang->getWords('global_delete','Delete')}
						</a>
					</li>
			    </ul>
				    
				<table cellspacing="1" cellpadding="1" id='productListTable' width="100%">
					<thead>
					    <tr>
					        <th style='text-align:center;' width="15"><input type="checkbox" onclick="checkAll()" name="all" /></th>
					        <th style='text-align:center;' width="20">{$vsLang->getWords('labelStatus', 'Status')}</th>
					        <th style='text-align:center;' width="">{$vsLang->getWords('labelTitle', 'Title')}</td>
					        <th style='text-align:center;' width="125">{$vsLang->getWords('labelISBN', 'ISBN')}</th>
					    </tr>
					</thead>
					<tbody>
						<if=" count($option['pageList'])">
						<foreach="$option['pageList'] as $obj">
							<tr>
								<td align="center" width="20">
									<input type="checkbox" name="obj_{$obj->getId()}" value="{$obj->getId()}" class="myCheckbox{$option['textbooktype']}" />
								</td>
								<td style='text-align:center' width="20">{$obj->getStatus('image')}</td>
								<td>
									<a href="javascript:;" onclick="editObj('{$obj->getId()}')" title='Author: {$obj->getAuthor()}, Publisher: {$obj->getAuthor()}' class="title">
										{$obj->getTitle()}
									</a>
								</td>
								<td>{$obj->getISBN()} <br /> {$obj->getISBN10()}</td>
							</tr>
						</foreach>
						</if>
					</tbody>
					<tfoot>
						<tr>
							<th colspan='4' align='right'>
								{$option['paging']}
							</th>
						</tr>
					</tfoot>
				</table>
			</div>
			<script type="text/javascript">
				function deleteBook(){
					jConfirm(
						'{$vsLang->getWords("deleteConfirm","Are you sure to delete these information?")}', 
						'{$bw->vars['global_websitename']} Dialog', 
						function(r){
							if(r){
								var flag=true; var jsonStr = "";
								$("input[type=checkbox]").each(function(){
									if($(this).hasClass('myCheckbox{$option['textbooktype']}')){
										flag=false;
										if(this.checked) jsonStr += $(this).val()+',';
									}
								});
								if(flag){
									jAlert(
										"{$message}",
										"{$bw->vars['global_websitename']} Dialog"
									);
									return false;
								}
								jsonStr = jsonStr.substr(0,jsonStr.lastIndexOf(','));								
								vsf.get('textbooks/delete/'+jsonStr+'/'<if=" $option['textbooktype'] ">+'&type={$option['textbooktype']}'</if>,'mainContainer{$option['textbooktype']}');
							}
						});
				}
				
				function editObj(id){
					vsf.get('textbooks/editForm/'+id <if=" $option['textbooktype'] ">+'&type={$option['textbooktype']}'</if>, 'mainContainer{$option['textbooktype']}');
					return false;
				}
				
				function checkAll() {
					var checked_status = $("input[name=all]:checked").length;
					var checkedString = '';
					$("input[type=checkbox]").each(function(){
						if($(this).hasClass('myCheckbox{$option['textbooktype']}')){
							this.checked = checked_status;
						}
					});
				}
			</script>
EOF;
		return $BWHTML;
	}

	function editForm($obj, $option){
		global $vsLang;
		$BWHTML .= <<<EOF
			<div class='ui-dialog ui-widget ui-widget-content ui-corner-all'>
			    <div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-all-inner">
			        <span class="ui-icon ui-icon-triangle-1-e"></span>
			        <span class="ui-dialog-title">{$option['formTitle']}</span>
			    </div>
			    <div class='clear'></div>
			    <form id="editForm" method="post">
					<table cellpadding="1" cellspacing="1" border="0" class="ui-dialog-content ui-widget-content" style="width:80%;">
						<tr class='smalltitle'>
		        			<td width="100">
		        				{$vsLang->getWords('ISBN13','ISBN 13')}
		        			</td>
		            		<td colspan="2" height="15">
		            			<input id='bookISBN' name="bookISBN" value="{$obj->getISBN()}" style="width:100%;">
		        			</td>
		        		</tr>
		        		
		        		<tr class='smalltitle'>
		        			<td >
		        				{$vsLang->getWords('ISBN10','ISBN 10')}
		        			</td>
		            		<td colspan="2" height="15">
		            			<input id='bookISBN10' name="bookISBN10" value="{$obj->getISBN10()}" style="width:100%;">
		        			</td>
		        		</tr>
		        		
		        		<tr class='smalltitle'>
		        			<td >
		        				{$vsLang->getWords('title','Title')}
		        			</td>
		            		<td colspan="2" height="15">
		            			<input id='bookTitle' name="bookTitle" value="{$obj->getTitle()}" style="width:100%;">
		        			</td>
		        		</tr>
		        		
		        		<tr class='smalltitle'>
		        			<td >
		        				{$vsLang->getWords('author','Author')}
		        			</td>
		            		<td colspan="2" height="15">
		            			<input name="bookAuthor" id="bookAuthor" value="{$obj->getAuthor()}" style="width:100%;" />
		        			</td>
		        		</tr>
		        		
		        		<tr class='smalltitle'>
		        			<td >
		        				{$vsLang->getWords('edition','Edition')}
		        			</td>
		            		<td colspan="2" height="15">
		            			<input id='bookEdition' name="bookEdition" value="{$obj->getEdition()}" style="width:100%;">
		        			</td>
		        		</tr>
		        		
		        		<tr class='smalltitle'>
		        			<td >
		        				{$vsLang->getWords('publisher','Publisher')}
		        			</td>
		            		<td colspan="2" height="15">
		            			<input name="bookPublisher" id="bookPublisher" value="{$obj->getPublisher()}" style="width:100%;" />
		        			</td>
		        		</tr>
		        		
		        		<tr class='smalltitle'>
		        			<td >
		        				{$vsLang->getWords('publication_date','Publication Date')}
		        			</td>
		            		<td colspan="2" height="15">
		            			<input name="bookRelease" id="bookRelease" value="{$obj->getRelease()}" style="width:100%;" />
		        			</td>
		        		</tr>
		        		
		        		<tr class='smalltitle'>
		        			<td >
		        				{$vsLang->getWords('format','Format')}
		        			</td>
		            		<td colspan="2" height="15">
		            			<input name="bookFormat" id="bookFormat" value="{$obj->getFormat()}" style="width:100%;" />
		        			</td>
		        		</tr>
		        		
		        		<tr class='smalltitle'>
		        			<td >
		        				{$vsLang->getWords('page','# of Page')}
		        			</td>
		            		<td colspan="2" height="15">
		            			<input name="bookPage" id="bookPage" value="{$obj->getPage()}" style="width:100%;" />
		        			</td>
		        		</tr>
		        		
		        		
		        		<tr class='smalltitle'>
		        			<td >
		        				{$vsLang->getWords('language','Language')}
		        			</td>
		            		<td colspan="2" height="15">
		            			<input name="bookLanguage" id="bookLanguage" value="{$obj->getLanguage()}" style="width:100%;" />
		        			</td>
		        		</tr>
		        		
		        		<tr class='smalltitle'>
		        			<td>
		        				{$vsLang->getWords('image','Image')}
		        			</td>
							<td>
		            			<input type='file' name='bookImage' id='bookImage' />
							</td>
							<td rowspan="2">
								<if=" $obj->getImage() ">
		        					{$obj->createImageCache($obj->getImage(),85,115)}
								</if>
							</td>
						</tr>
						
		        		
		        		<tr class='smalltitle ui-dialog-buttonpanel'>
		        			<td>
		        				{$vsLang->getWords('status','Type')}
		        			</td>
							<td>
		            			<input name="bookStatus" value="0" type="radio" class="checkbox" /> {$vsLang->getWords('status_no','Verfiy')}
		            			<input name="bookStatus" value="1" type="radio" class="checkbox" /> {$vsLang->getWords('status_yes','Normal')}
							</td>
						</tr>
		        		
						<tr class='smalltitle ui-dialog-buttonpanel'>
							<td colspan="3" align="center" valign="top">
								<input type="submit" value="{$option['submitValue']}" />
							</td>
						</tr>
					</table>
					
					<input type="hidden" name="bookId" value="{$obj->getId()}">
					<input type="hidden" name="type" value="{$option['textbooktype']}">
				</form>
			</div>
			<div id="result"></div>
			<script type="text/javascript">
				$(document).ready(function(){
					vsf.jRadio('{$obj->getStatus()}', 'bookStatus');

					$('#editForm').submit(function(){
						vsf.uploadFile('editForm', 'textbooks', 'editObj', 'mainContainer{$option['textbooktype']}', 'textbooks');
		        		return false;
		        	});
				});
			</script>
EOF;
	}
}
?>