<?php
class skin_textbooks{

//===========================================================================
// <vsf:isbnBooks:desc::trigger:>
//===========================================================================
function isbnBooks($option="") {global $vsLang, $bw, $vsPrint, $vsTemplate;

//--starthtml--//
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
                
EOF;
if( $option['pageList'] ) {
$BWHTML .= <<<EOF

                {$this->__foreach_loop__id_503f80fc3fc50($option)}
                   
EOF;
}

$BWHTML .= <<<EOF

                   
                   
EOF;
if( $option['paging'] ) {
$BWHTML .= <<<EOF

                   <div class="page">
                   <span>Browse Pages:</span>
                   {$option['paging']}
                   </div>
                   
EOF;
}

$BWHTML .= <<<EOF

                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc3fc50($option="")
{
global $vsLang, $bw, $vsPrint, $vsTemplate;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['pageList'] as $book  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <div class="product">
                   <div class="product_img">
                   <a href="{$bw->vars['board_url']}/textbooks/sell&tb=
EOF;
if($book->amazon) {
$BWHTML .= <<<EOF
{$book->stt}&isbn={$book->key}
EOF;
}

else {
$BWHTML .= <<<EOF
{$book->getId()}
EOF;
}
$BWHTML .= <<<EOF
" title="{$book->getTitle()}">
                        
EOF;
if( $book->getImage() ) {
$BWHTML .= <<<EOF

{$book->createImageCache($book->getImage(),85,115)}

EOF;
}

else {
$BWHTML .= <<<EOF

<img src="{$bw->vars['img_url']}/noimage.jpg" alt="{$vsLang->getWords('global_no_image','No Imgae')}" width="85" height="115" />

EOF;
}
$BWHTML .= <<<EOF

</a>
</div>
                        <div class="product_intro">
                        <h4><a href="{$bw->vars['board_url']}/textbooks/sell&tb=
EOF;
if($book->amazon) {
$BWHTML .= <<<EOF
{$book->stt}&isbn={$book->key}&time={$option['cachetime']}
EOF;
}

else {
$BWHTML .= <<<EOF
{$book->getId()}
EOF;
}
$BWHTML .= <<<EOF
" title="{$book->getTitle()}">{$book->getTitle()}</a></h4>
                            <p>{$book->getAuthor()}</p>
                            <p>
                            
EOF;
if($book->getISBN()) {
$BWHTML .= <<<EOF

                            <span><b>ISBN 13</b>: {$book->getISBN()}</span>
                            
EOF;
}

$BWHTML .= <<<EOF

                            
                            
EOF;
if($book->getISBN10()) {
$BWHTML .= <<<EOF

                            <span><b>ISBN 10</b>: {$book->getISBN10()}</span>
                            
EOF;
}

$BWHTML .= <<<EOF

                            </p>
<p>
<span><b>Publisher</b>: {$book->getPublisher()}</span>
<span><b>Edition</b>: {$book->getEdition()}</span>
</p>
                        <p>
<span><b>Publication date</b>: {$book->getRelease()}</span>

EOF;
if( $book->getPage() ) {
$BWHTML .= <<<EOF

<span>{$book->getPage()} <b>pages</b></span>

EOF;
}

$BWHTML .= <<<EOF

</p>
                            <p>
                        <span><b>Language</b>: {$book->getLanguage()}</span>
                            </p>
                        </div>
                        <div class="clear_left"></div>
                   </div>
                   
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:loadMain:desc::trigger:>
//===========================================================================
function loadMain($option="") {global $vsLang, $bw, $vsTemplate;

//--starthtml--//
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
                
EOF;
if( $option['newBooks'] ) {
$BWHTML .= <<<EOF

                {$this->__foreach_loop__id_503f80fc40bb1($option)}
                    
EOF;
}

$BWHTML .= <<<EOF

                    <div class="clear_left"></div>
                </div>
            </div>
           
           
           
EOF;
if( $option['bestSellBooks'] ) {
$BWHTML .= <<<EOF

           <div class="seller_border">
            <div class="user_title">
                    <h3>{$vsLang->getWords('global_best_selling','Best Selling')}</h3>
                    <a href="{$bw->vars['board_url']}/textbooks/more/2" title="{$vsLang->getWords('global_best_selling','Best Selling')}">
                    {$vsLang->getWords('global_more','more')}
                    </a>
                </div>
                <div class="seller_list">
                    
                {$this->__foreach_loop__id_503f80fc410ac($option)}
                    
                    <div class="clear_left"></div>
                </div>
            </div>
            
EOF;
}

$BWHTML .= <<<EOF

            
            
EOF;
if( $option['campusBooks'] ) {
$BWHTML .= <<<EOF

            <div class="seller_border">
            <div class="user_title">
                    <h3>{$vsLang->getWords('global_most_recommended','Most Recommended')}</h3>
                    <a href="{$bw->vars['board_url']}/textbooks/more/3" title="{$vsLang->getWords('global_most_recommended','Most Recommended')}">
                    {$vsLang->getWords('global_more','more')}
                    </a>
                </div>
                <div class="seller_list">
                {$this->__foreach_loop__id_503f80fc41653($option)}
                    <div class="clear_left"></div>
                </div>
            </div>
            
EOF;
}

$BWHTML .= <<<EOF

        </div>
    </div>
    <div class="clear"></div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc40bb1($option="")
{
global $vsLang, $bw, $vsTemplate;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['newBooks'] as $new  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
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
                        
EOF;
if( $new->getPublisher() || $new->getRelease() ) {
$BWHTML .= <<<EOF

                        <p>(
EOF;
if(  $new->getFormat() ) {
$BWHTML .= <<<EOF
{$new->getFormat()},
EOF;
}

$BWHTML .= <<<EOF

EOF;
if($new->getRelease()) {
$BWHTML .= <<<EOF
{$new->getRelease()}
EOF;
}

$BWHTML .= <<<EOF
)</p>
                        
EOF;
}

$BWHTML .= <<<EOF

                        </div>
                        <p class="cost">
                        
EOF;
if( $new->price ) {
$BWHTML .= <<<EOF

                        <span class='buyfrom'>{$vsLang->getWords('global_buy_from','Buy from')}</span>
                        {$vsLang->getWords('global_curency','$')}{$new->price}
                        
EOF;
}

$BWHTML .= <<<EOF

                        </p>
                    </div>
                    
EOF;
if( $new->begingroup ) {
$BWHTML .= <<<EOF

                    <div class="clear_left"></div>
                    <div class='seperate'></div>
                    
EOF;
}

$BWHTML .= <<<EOF

                    
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc410ac($option="")
{
global $vsLang, $bw, $vsTemplate;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['bestSellBooks'] as $best  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                    <div class="seller_item">
                        <div class="seller_img">
                        <a href="{$best->getListingURL('textbooks')}" title="{$best->getTitle()}">
                        
EOF;
if( $best->getImage() ) {
$BWHTML .= <<<EOF

{$best->createImageCache($best->getImage(),85,115)}

EOF;
}

else {
$BWHTML .= <<<EOF

<img src="{$bw->vars['img_url']}/noimage.jpg" alt="{$vsLang->getWords('global_no_image','No Imgae')}" width="85" height="115" />

EOF;
}
$BWHTML .= <<<EOF

</a>
                        </div>
                        <h3 class="bookTitle">
                        <a href="{$best->getListingURL('textbooks')}" title="{$best->getTitle()}">
                        {$best->getTitle(50)}
                        </a>
                        </h3>
                        <div class="description">
                        <p class='author'>{$best->getAuthor(25)}</p>
                        
EOF;
if( $best->getFormat() || $best->getRelease() ) {
$BWHTML .= <<<EOF

                        <p>(
                        
EOF;
if(  $best->getFormat() ) {
$BWHTML .= <<<EOF

                        {$best->getFormat()}, 
                        
EOF;
}

$BWHTML .= <<<EOF

                        
EOF;
if($best->getRelease()) {
$BWHTML .= <<<EOF

                        {$best->getRelease()}
                        
EOF;
}

$BWHTML .= <<<EOF

                        )
                        </p>
                        
EOF;
}

$BWHTML .= <<<EOF

                        </div>
                        <p class="cost">
                        
EOF;
if( $best->price ) {
$BWHTML .= <<<EOF

                        <span class='buyfrom'>{$vsLang->getWords('global_buy_from','Buy from')}</span>
                        {$vsLang->getWords('global_curency','$')}{$best->price}
                        
EOF;
}

$BWHTML .= <<<EOF

                        </p>
                    </div>
                    
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc41653($option="")
{
global $vsLang, $bw, $vsTemplate;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['campusBooks'] as $campus  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                    <div class="seller_item">
                        <div class="seller_img">
                        <a href="{$campus->getUrl('textbooks')}" title="{$campus->getTitle()}">
                        
EOF;
if( $campus->getImage() ) {
$BWHTML .= <<<EOF

{$campus->createImageCache($campus->getImage(),85,115)}

EOF;
}

else {
$BWHTML .= <<<EOF

<img src="{$bw->vars['img_url']}/noimage.jpg" alt="{$vsLang->getWords('global_no_image','No Imgae')}" width="85" height="115" />

EOF;
}
$BWHTML .= <<<EOF

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
                        
EOF;
if(  $best->getFormat() ) {
$BWHTML .= <<<EOF

                        {$best->getFormat()}, 
                        
EOF;
}

$BWHTML .= <<<EOF

                        
EOF;
if($best->getRelease()) {
$BWHTML .= <<<EOF

                        {$best->getRelease()}
                        
EOF;
}

$BWHTML .= <<<EOF

                        )
                        </p>
                        </div>
                        <p class="cost">
                        
EOF;
if( $campus->price ) {
$BWHTML .= <<<EOF

                        <span class='buyfrom'>{$vsLang->getWords('global_buy_from','Buy from')}</span>
                        {$vsLang->getWords('global_curency','$')}
                        {$campus->price}
                        
EOF;
}

$BWHTML .= <<<EOF

                        </p>
                    </div>
                    
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:listing:desc::trigger:>
//===========================================================================
function listing($book="",$option="") {global $vsLang, $bw, $vsPrint;
$this->vsLang = $vsLang;
$option['obj_title'] = $book->getTitle();

//--starthtml--//
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
<p>({$book->getFormat()}
EOF;
if($book->getRelease(1)) {
$BWHTML .= <<<EOF
, {$book->getRelease(0, 1)}
EOF;
}

$BWHTML .= <<<EOF
)</p>
<p style="margin-bottom: 10px;">
<b>Publisher:</b> {$book->getPublisher()}
</p>

EOF;
if( $option['bestprice'] ) {
$BWHTML .= <<<EOF

{$this->__foreach_loop__id_503f80fc420ff($book,$option)}
                
EOF;
}

$BWHTML .= <<<EOF

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
                
EOF;
if( $option['seller'] ) {
$BWHTML .= <<<EOF

{$this->__foreach_loop__id_503f80fc426db($book,$option)}

EOF;
}

$BWHTML .= <<<EOF

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
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc420ff($book="",$option="")
{
global $vsLang, $bw, $vsPrint;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['bestprice'] as $key => $bestprice  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <p class='cost'>
                <span class='buyfrom'>{$option['seller'][$key]['from']} from </span> {$this->vsLang->getWords('global_curency','$')}{$bestprice}
                </p>
                
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc4237f($book="",$option="",$array='')
{
;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $array['list']['pageList'] as $tu  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
         
               <tr>
                    <td class="table_span1">
                    <a href="{$tu->getURL($option['obj_title'])}" title="More infomation about this listing">
                        {$this->vsLang->getWords('global_curency','$')}
                        {$tu->getPrice()}
                        </a>
                        </td>
                        <td class="table_span2">
                        
EOF;
if( $option['tbcond'][$tu->getCondition()] ) {
$BWHTML .= <<<EOF

                        {$option['tbcond'][$tu->getCondition()]->getTitle()}
                        
EOF;
}

$BWHTML .= <<<EOF

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
                        
EOF;
if( $option['campusList'][$tu->getCampus()] ) {
$BWHTML .= <<<EOF

                        {$option['campusList'][$tu->getCampus()]->getTitle()} <br />
                        
EOF;
}

$BWHTML .= <<<EOF

                        {$tu->getLocation()}
                        </td>
                    </tr>
                    
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc426db($book="",$option="")
{
global $vsLang, $bw, $vsPrint;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['seller'] as $array  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<h3 class="feedfack_title">{$array['title']}</h3>
           <div class="listing_table">
           
EOF;
if( $array['list']['pageList'] ) {
$BWHTML .= <<<EOF

               <table border="1" width="100%">
               <tr>
                    <th class="table_span1">Price</th>
                    <th class="table_span2">Condition</th>
                        <th class="table_span3">Seller</th>
                        <th class="table_span4">Comments</th>
                        <th class="table_span5">Campus/Location</th>
                        
                    </tr>
                   
                    {$this->__foreach_loop__id_503f80fc4237f($book,$option,$array)}

EOF;
if( $array['list']['paging'] ) {
$BWHTML .= <<<EOF

<tr>
                    <td colspan="4" align="right">{$array['list']['paging']}</td>
                    </tr>
                    
EOF;
}

$BWHTML .= <<<EOF

               </table>
               
EOF;
}

else {
$BWHTML .= <<<EOF

               <div class='nolisting'>
               <span class='price'>Nobody is selling this book</span>
               <div class='bookdetail_btn'>
               <span name='sellyours' class='sellyours' ref='{$book->getId()}'>Sell yours</span>
               </div>
               <div class='clear'></div>
               </div>
               
EOF;
}
$BWHTML .= <<<EOF

           </div>

EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:objForm:desc::trigger:>
//===========================================================================
function objForm($obj="",$tu="",$option="") {global $vsLang, $bw, $vsPrint, $vsUser, $vsTemplate;

//--starthtml--//
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
                
                
EOF;
if( $option['verify'] ) {
$BWHTML .= <<<EOF

                <input type="hidden" value="{$option['verify']}" name="direct" />
                
EOF;
}

else {
$BWHTML .= <<<EOF

                <input type="hidden" value="{$option['valid']}" name="direct" />
                
EOF;
}
$BWHTML .= <<<EOF

                
                
EOF;
if( $obj->getTitle() ) {
$BWHTML .= <<<EOF

                <input type="hidden" value="{$obj->getTitle()}" name="bookTitle" />
                
EOF;
}

$BWHTML .= <<<EOF

                
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
                        
                        
EOF;
if( $option['textbookCondition'] ) {
$BWHTML .= <<<EOF

                        <label>Condition:</label>
                        <div class='radiocontainer' id='conditioncontainer'>
                        {$this->__foreach_loop__id_503f80fc432d6($obj,$tu,$option)}
                        <div class='clear'></div>
                        </div>
                        
EOF;
}

$BWHTML .= <<<EOF

                        <!--
                        
EOF;
if( $option['textbookType'] ) {
$BWHTML .= <<<EOF

                        <label>Business:</label>
                        <div class='radiocontainer' id='typecontainer'>
                        {$this->__foreach_loop__id_503f80fc43449($obj,$tu,$option)}
                        <div class='clear'></div>
                        </div>
                        
EOF;
}

$BWHTML .= <<<EOF

                        -->
                        
                        <label>Subjects:</label>
                        <select id="tuSubject" name="tuSubject">
                        <option value="0">{$vsLang->getWords('sell_form_tuSubject','Please select a subject')}</option>
                        
EOF;
if( $option['subjectList'] ) {
$BWHTML .= <<<EOF

                        {$this->__foreach_loop__id_503f80fc435b7($obj,$tu,$option)}
                        
EOF;
}

$BWHTML .= <<<EOF

                        </select>
                        
                        <label>Campus:</label>
                        <select id="tuCampus" name="tuCampus">
                        <option value="0">{$vsLang->getWords('sell_form_tuCampus','Please select a campus')}</option>
                        
EOF;
if( $option['campusList'] ) {
$BWHTML .= <<<EOF

                        {$this->__foreach_loop__id_503f80fc43762($obj,$tu,$option)}
                        
EOF;
}

$BWHTML .= <<<EOF

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
                        
EOF;
if( $option['valid'] ) {
$BWHTML .= <<<EOF

                        <label>Image:</label>
                        <input type="file" class="input_file" size="16" name="bookImage" />
                        
EOF;
}

$BWHTML .= <<<EOF

                        
EOF;
if( $obj->getImage() ) {
$BWHTML .= <<<EOF

                        <label>&nbsp;</label>
                        <div class='img'>
                        
EOF;
if( $obj->getImage() ) {
$BWHTML .= <<<EOF

{$obj->createImageCache($obj->getImage(),85,115)}

EOF;
}

else {
$BWHTML .= <<<EOF

<img src="{$bw->vars['img_url']}/noimage.jpg" alt="{$vsLang->getWords('global_no_image','No Imgae')}" width="85" height="115" />

EOF;
}
$BWHTML .= <<<EOF

</div>
                        
EOF;
}

$BWHTML .= <<<EOF

                        
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

EOF;
if( !$option['valid'] ) {
$BWHTML .= <<<EOF

    enable();
    
EOF;
}

$BWHTML .= <<<EOF

    form.submit();
}
});
});
    
    vsf.jSelect("{$tu->getSubject()}", "tuSubject");
    vsf.jRadio("{$tu->getCondition()}", "tuCondition");
//    vsf.jSelect("{$tu->getType()}", "tuType");
    vsf.jSelect("{$tu->getCampus()}", "tuCampus");
    if($('#tuCampus').val() == 0)
    vsf.jSelect("{$vsUser->obj->getCampusId()}", "tuCampus");
    
    
EOF;
if( !$option['valid'] ) {
$BWHTML .= <<<EOF

    disable();
    
EOF;
}

$BWHTML .= <<<EOF

    
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
    

EOF;
if( !$option['valid'] ) {
$BWHTML .= <<<EOF

    enable()
    
EOF;
}

$BWHTML .= <<<EOF

    vsf.submitForm($('#editForm'), 'textbooks/preview', 'previewContainer');
    
    
EOF;
if( !$option['valid'] ) {
$BWHTML .= <<<EOF

    disable();
    
EOF;
}

$BWHTML .= <<<EOF

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
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc432d6($obj="",$tu="",$option="")
{
global $vsLang, $bw, $vsPrint, $vsUser, $vsTemplate;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['textbookCondition'] as $cond )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                        <input type="radio" value="{$cond->getId()}" name="tuCondition" class='radio'/>
                        <span class='radio'>{$cond->getTitle()}</span>
                        
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc43449($obj="",$tu="",$option="")
{
global $vsLang, $bw, $vsPrint, $vsUser, $vsTemplate;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['textbookType'] as $subject )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                        <input type="radio" value="{$subject->getId()}" name="tuType" class='radio'/>
                        <span class='radio'>{$subject->getTitle()}</span>
                        
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc435b7($obj="",$tu="",$option="")
{
global $vsLang, $bw, $vsPrint, $vsUser, $vsTemplate;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['subjectList'] as $subject )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                        <option value="{$subject->getId()}">{$subject->getTitle()}</option>
                        
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc43762($obj="",$tu="",$option="")
{
global $vsLang, $bw, $vsPrint, $vsUser, $vsTemplate;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['campusList'] as $campus  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                        <option value="{$campus->getId()}">{$campus->getTitle()}</option>
                        
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:detail:desc::trigger:>
//===========================================================================
function detail($tus="",$option="") {global $vsLang, $bw, $vsPrint, $vsTemplate;
$this->vsLang = $vsLang;
$ltArr = array(
2=>$vsLang->getWords('status_pending', 'Pending'),
3=>$vsLang->getWords('status_sold', 'Sold')
);

//--starthtml--//
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
<p>({$tus->bookDetail->getPublisher()}
EOF;
if($tus->bookDetail->getRelease()) {
$BWHTML .= <<<EOF
, {$tus->bookDetail->getRelease()}
EOF;
}

$BWHTML .= <<<EOF
)</p>
<div id="condition">
<span style="font-weight:bold;">Condition</span> {$tus->getCondition()}
<span style="margin-left: 10px;font-weight:bold;">Seller</span> {$tus->seller->getAlias()}

EOF;
if( $tus->lt->getStatus() <> 3) {
$BWHTML .= <<<EOF

                        <a class="buy" id="makeanoffer" title="{$vsLang->getWords('global_buy_this_book','Buy this book')}" href="javascript:;" >
                        {$vsLang->getWords('global_make_offer','Make an Offer')}
                        </a>

EOF;
}

$BWHTML .= <<<EOF

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
                
                <p><span>Publisher:</span> {$tus->bookDetail->getPublisher()} 
EOF;
if( $tus->bookDetail->getRelease() ) {
$BWHTML .= <<<EOF
({$tus->bookDetail->getRelease()})
EOF;
}

$BWHTML .= <<<EOF
</p>
                
                <p><span>Edition:</span> {$tus->bookDetail->getEdition()}</p>
                
                <p><span>ISBN-10:</span> {$tus->bookDetail->getISBN10()}</p>
                
                <p><span>ISBN-13:</span> {$tus->bookDetail->getISBN()}</p>
                
                <p><span>Language:</span> {$tus->bookDetail->getLanguage()}</p>
                
                
EOF;
if( $tus->getCampus() ) {
$BWHTML .= <<<EOF

                <p><span>Campus:</span> {$tus->getCampus()}</p>
                
EOF;
}

$BWHTML .= <<<EOF

                
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
            
            
EOF;
if( $option['other'] ) {
$BWHTML .= <<<EOF

           <div class="seller_border">
            <div class="user_title">
            <h3>{$this->vsLang->getWords('seller_other_book', 'More Listings From The Seller')}</h3>
            </div>
                <div class="seller_list">
                {$this->__foreach_loop__id_503f80fc44920($tus,$option)}
                    <div class="clear_left"></div>
                </div>
            </div>
           
EOF;
}

$BWHTML .= <<<EOF

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
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc44920($tus="",$option="")
{
global $vsLang, $bw, $vsPrint, $vsTemplate;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['other'] as $obj )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                    <div class="seller_item">
                        <div class="seller_img">
                        <a href="{$obj->tu->getURL($obj->getTitle())}" title="{$obj->getTitle()}">
                        
EOF;
if( $obj->getImage() ) {
$BWHTML .= <<<EOF

{$obj->createImageCache($obj->getImage(),85,115, 0, 1)}

EOF;
}

$BWHTML .= <<<EOF

</a>
                        </div>
                        <h3 class="bookTitle">
                        <a href="{$obj->tu->getURL($obj->getTitle())}" title="{$obj->getTitle()}">
                        {$obj->getTitle(50)}
                        </a>
                        </h3>
                        <div class="description">
                        <p class='author'>{$obj->getAuthor(25)}</p>
                        
EOF;
if( $obj->getPublisher() || $obj->getRelease() ) {
$BWHTML .= <<<EOF

                        <p>(
EOF;
if(  $obj->getFormat() ) {
$BWHTML .= <<<EOF
{$obj->getFormat()},
EOF;
}

$BWHTML .= <<<EOF

EOF;
if($obj->getRelease()) {
$BWHTML .= <<<EOF
{$obj->getRelease()}
EOF;
}

$BWHTML .= <<<EOF
)</p>
                        
EOF;
}

$BWHTML .= <<<EOF

                        </div>
                        <p class="cost">
                        <span class='buyfrom'>Price </span>
                        {$this->vsLang->getWords('global_curency','$')}
                        {$obj->tu->getPrice()}
                        </p>
                    </div>
                    
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:subject:desc::trigger:>
//===========================================================================
function subject($option="") {global $bw, $vsLang, $vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
        {$option['leftHTML']}
<div id="content1">
{$vsTemplate->global_template->GLOBAL_PARTNER}
        <div id="content_left">
           
<div class="navigation1 clear_left">

EOF;
if( $option['subject'] ) {
$BWHTML .= <<<EOF

            <a href="#" tilte="{$option['subject']->getTitle()}">
            {$option['subject']->getTitle()}
            </a>
            
EOF;
}

$BWHTML .= <<<EOF

            </div>
            <div id="pro_tab">
            <ul>                
                <span class="sort">Sort by:</span>
                    <li 
EOF;
if( !$option['order'] ) {
$BWHTML .= <<<EOF
class="tabs-selected"
EOF;
}

$BWHTML .= <<<EOF
><a href="#BEST"><span>Best Selling</span></a></li>
                <li 
EOF;
if( $option['order'] == 'price' ) {
$BWHTML .= <<<EOF
class="tabs-selected"
EOF;
}

$BWHTML .= <<<EOF
><a href="#PRICE"><span>Price</span></a></li>
                    <li 
EOF;
if( $option['order'] == 'alpha' ) {
$BWHTML .= <<<EOF
class="tabs-selected"
EOF;
}

$BWHTML .= <<<EOF
><a href="#ALPHA"><span>Alphabetical</span></a></li>
                    <li 
EOF;
if( $option['order'] == 'release' ) {
$BWHTML .= <<<EOF
class="tabs-selected"
EOF;
}

$BWHTML .= <<<EOF
><a href="#PUBL"><span>Publication Date</span></a></li>            
                </ul>
                <div id="BEST">
                
EOF;
if( $option['best']['pageList'] ) {
$BWHTML .= <<<EOF

                {$this->__foreach_loop__id_503f80fc45603($option)}
                   
EOF;
}

else {
$BWHTML .= <<<EOF

                   <div class="product">
                   <b>No listing in this subject</b>
                   </div>
                   
EOF;
}
$BWHTML .= <<<EOF

                   
                   
EOF;
if( $option['best']['paging'] ) {
$BWHTML .= <<<EOF

                   <div class="page">
                   <span>Browse Pages:</span>
                   {$option['best']['paging']}
                   </div>
                   
EOF;
}

$BWHTML .= <<<EOF

                </div>
                <div id="PRICE">
                
EOF;
if( $option['price']['pageList'] ) {
$BWHTML .= <<<EOF

                {$this->__foreach_loop__id_503f80fc45a41($option)}
                   
EOF;
}

else {
$BWHTML .= <<<EOF

                   <div class="product">
                   <b>No listing in this subject</b>
                   </div>
                   
EOF;
}
$BWHTML .= <<<EOF

                   
                   
EOF;
if( $option['price']['paging'] ) {
$BWHTML .= <<<EOF

                   <div class="page">
                   <span>Browse Pages:</span>
                   {$option['price']['paging']}
                   </div>
                   
EOF;
}

$BWHTML .= <<<EOF

                </div>
                
                <div id="ALPHA">
                
EOF;
if( $option['alpha']['pageList'] ) {
$BWHTML .= <<<EOF

                {$this->__foreach_loop__id_503f80fc45e23($option)}
                   
EOF;
}

else {
$BWHTML .= <<<EOF

                   <div class="product">
                   <b>No listing in this subject</b>
                   </div>
                   
EOF;
}
$BWHTML .= <<<EOF

                   
                   
EOF;
if( $option['alpha']['paging'] ) {
$BWHTML .= <<<EOF

                   <div class="page">
                   <span>Browse Pages:</span>
                   {$option['alpha']['paging']}
                   </div>
                   
EOF;
}

$BWHTML .= <<<EOF

                </div>
                
                <div id="PUBL">
                
EOF;
if( $option['release']['pageList'] ) {
$BWHTML .= <<<EOF

                {$this->__foreach_loop__id_503f80fc461cf($option)}
                   
EOF;
}

else {
$BWHTML .= <<<EOF

                   <div class="product">
                   <b>No listing in this subject</b>
                   </div>
                   
EOF;
}
$BWHTML .= <<<EOF

                   
                   
EOF;
if( $option['release']['paging'] ) {
$BWHTML .= <<<EOF

                   <div class="page">
                   <span>Browse Pages:</span>
                   {$option['release']['paging']}
                   </div>
                   
EOF;
}

$BWHTML .= <<<EOF

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
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc45603($option="")
{
global $bw, $vsLang, $vsTemplate;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['best']['pageList'] as $book  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <div class="product">
                   <div class="product_img">
                   <a href="{$book->getListingURL('textbooks')}" title="{$book->getTitle()}">
{$book->createImageCache($book->getImage(),85,115, 0, 1)}
</a>
</div>
                        <div class="product_intro">
                        <h4><a href="{$book->getListingURL('textbooks')}" title="{$book->getTitle()}">{$book->getTitle()}</a></h4>
                            <p>{$book->getAuthor()}</p>
<p>({$book->getPublisher()}
EOF;
if($book->getRelease()) {
$BWHTML .= <<<EOF
, {$book->getRelease()}
EOF;
}

$BWHTML .= <<<EOF
)</p>

EOF;
if( $book->price ) {
$BWHTML .= <<<EOF

                            <p class="cost">
                        {$book->price}
                            </p>
                            
EOF;
}

$BWHTML .= <<<EOF

                        </div>
                        <div class="clear_left"></div>
                   </div>
                   
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc45a41($option="")
{
global $bw, $vsLang, $vsTemplate;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['price']['pageList'] as $book  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <div class="product">
                   <div class="product_img">
                   <a href="{$book->getListingURL('textbooks')}" title="{$book->getTitle()}">
                        
EOF;
if( $book->getImage() ) {
$BWHTML .= <<<EOF

{$book->createImageCache($book->getImage(),85,115)}

EOF;
}

else {
$BWHTML .= <<<EOF

<img src="{$bw->vars['img_url']}/noimage.jpg" alt="{$vsLang->getWords('global_no_image','No Imgae')}" width="85" height="115" />

EOF;
}
$BWHTML .= <<<EOF

</a>
</div>
                        <div class="product_intro">
                        <h4><a href="{$book->getListingURL('textbooks')}" title="{$book->getTitle()}">{$book->getTitle()}</a></h4>
                            <p>{$book->getAuthor()}</p>
<p>({$book->getPublisher()}
EOF;
if($book->getRelease()) {
$BWHTML .= <<<EOF
, {$book->getRelease()}
EOF;
}

$BWHTML .= <<<EOF
)</p>
                            
EOF;
if( $book->price ) {
$BWHTML .= <<<EOF

                            <p class="cost">
                        {$vsLang->getWords('global_curency','$')}
                        {$book->price}
                            </p>
                            
EOF;
}

$BWHTML .= <<<EOF

                        </div>
                        <div class="clear_left"></div>
                   </div>
                   
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc45e23($option="")
{
global $bw, $vsLang, $vsTemplate;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['alpha']['pageList'] as $book  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <div class="product">
                   <div class="product_img">
                   <a href="{$book->getListingURL('textbooks')}" title="{$book->getTitle()}">
                        
EOF;
if( $book->getImage() ) {
$BWHTML .= <<<EOF

{$book->createImageCache($book->getImage(),85,115)}

EOF;
}

else {
$BWHTML .= <<<EOF

<img src="{$bw->vars['img_url']}/noimage.jpg" alt="{$vsLang->getWords('global_no_image','No Imgae')}" width="85" height="115" />

EOF;
}
$BWHTML .= <<<EOF

</a>
</div>
                        <div class="product_intro">
                        <h4><a href="{$book->getListingURL('textbooks')}" title="{$book->getTitle()}">{$book->getTitle()}</a></h4>
                            <p>{$book->getAuthor()}</p>
<p>({$book->getPublisher()}
EOF;
if($book->getRelease()) {
$BWHTML .= <<<EOF
, {$book->getRelease()}
EOF;
}

$BWHTML .= <<<EOF
)</p>
                            
EOF;
if( $book->price ) {
$BWHTML .= <<<EOF

                            <p class="cost">
                        {$vsLang->getWords('global_curency','$')}
                        {$book->price}
                            </p>
                            
EOF;
}

$BWHTML .= <<<EOF

                        </div>
                        <div class="clear_left"></div>
                   </div>
                   
EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc461cf($option="")
{
global $bw, $vsLang, $vsTemplate;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['release']['pageList'] as $book  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                <div class="product">
                   <div class="product_img">
                   <a href="{$book->getListingURL('textbooks')}" title="{$book->getTitle()}">
                        
EOF;
if( $book->getImage() ) {
$BWHTML .= <<<EOF

{$book->createImageCache($book->getImage(),85,115)}

EOF;
}

else {
$BWHTML .= <<<EOF

<img src="{$bw->vars['img_url']}/noimage.jpg" alt="{$vsLang->getWords('global_no_image','No Imgae')}" width="85" height="115" />

EOF;
}
$BWHTML .= <<<EOF

</a>
</div>
                        <div class="product_intro">
                        <h4><a href="{$book->getListingURL('textbooks')}" title="{$book->getTitle()}">{$book->getTitle()}</a></h4>
                            <p>{$book->getAuthor()}</p>
<p>({$book->getPublisher()}
EOF;
if($book->getRelease()) {
$BWHTML .= <<<EOF
, {$book->getRelease()}
EOF;
}

$BWHTML .= <<<EOF
)</p>
                           
EOF;
if( $book->price ) {
$BWHTML .= <<<EOF

                            <p class="cost">
                        {$vsLang->getWords('global_curency','$')}
                        {$book->price}
                            </p>
                            
EOF;
}

$BWHTML .= <<<EOF

                        </div>
                        <div class="clear_left"></div>
                   </div>
                   
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:preview:desc::trigger:>
//===========================================================================
function preview($tus="",$book="",$option="") {global $vsLang, $vsUser;

//--starthtml--//
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
<p>({$book->getPublisher()}
EOF;
if($book->getRelease()) {
$BWHTML .= <<<EOF
, {$book->getRelease()}
EOF;
}

$BWHTML .= <<<EOF
)</p>
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
                
                <p><span>Publisher:</span> {$book->getPublisher()} 
EOF;
if( $book->getRelease() ) {
$BWHTML .= <<<EOF
({$book->getRelease()})
EOF;
}

$BWHTML .= <<<EOF
</p>
                
                <p><span>Edition:</span> {$book->getEdition()}</p>
                
                <p><span>ISBN-10:</span> {$book->getISBN10()}</p>
                
                <p><span>ISBN-13:</span> {$book->getISBN()}</p>
                
                <p><span>Language:</span> {$book->getLanguage()}</p>
                
                
EOF;
if( $tus->getCampus() ) {
$BWHTML .= <<<EOF

                <p><span>Campus:</span> {$tus->getCampus()}</p>
                
EOF;
}

$BWHTML .= <<<EOF

                
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
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:search:desc::trigger:>
//===========================================================================
function search($option="") {global $vsLang, $bw, $vsTemplate;

//--starthtml--//
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
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:mainsearch:desc::trigger:>
//===========================================================================
function mainsearch($option="") {global $vsLang, $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id='mainsearch'>

EOF;
if( $option['tulist'] ) {
$BWHTML .= <<<EOF

{$this->__foreach_loop__id_503f80fc479e6($option)}

EOF;
}

else {
$BWHTML .= <<<EOF

<div class="result">
<b>Sorry! Nobody is selling your textbook</b>
</div>

EOF;
}
$BWHTML .= <<<EOF


EOF;
if( $option['paging'] ) {
$BWHTML .= <<<EOF

<div class="page">
<span>Browse Pages:</span>
{$option['paging']}
</div>

EOF;
}

$BWHTML .= <<<EOF

<script type='text/javascript'>
$('.sellyours').click(function(){
location.href="{$bw->vars['board_url']}/textbooks/sell&tb="+$(this).attr('ref');
});
</script>
</div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc479e6($option="")
{
global $vsLang, $bw;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['tulist'] as $book )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
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

EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:loadMore:desc::trigger:>
//===========================================================================
function loadMore($option="") {global $vsLang, $bw, $vsTemplate;

//--starthtml--//
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
        
EOF;
if( $option['fbscript'] ) {
$BWHTML .= <<<EOF

        <script type='text/javascript'>
$('#more-contain').scrollExtend({
'target': 'div#pandog',
'url': '{$option['url']}/&t=load&ajax=1'
});
</script>

EOF;
}

$BWHTML .= <<<EOF

    </div>
    <div class="clear"></div>
EOF;
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:mainmore:desc::trigger:>
//===========================================================================
function mainmore($option=array()) {global $vsLang, $bw, $vsTemplate;

//--starthtml--//
$BWHTML .= <<<EOF
        
EOF;
if( $option['pageList'] ) {
$BWHTML .= <<<EOF

                {$this->__foreach_loop__id_503f80fc481f5($option)}
                    
EOF;
}

$BWHTML .= <<<EOF

EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc481f5($option=array())
{
global $vsLang, $bw, $vsTemplate;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['pageList'] as $book  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
                    <div class="product">
                   <div class="product_img">
                   <a href="{$book->getListingURL('textbooks')}" title="{$book->getTitle()}">
                        
EOF;
if( $book->getImage() ) {
$BWHTML .= <<<EOF

{$book->createImageCache($book->getImage(),85,115, 0, 1)}

EOF;
}

$BWHTML .= <<<EOF

</a>
</div>
                        <div class="product_intro">
                        <h4><a href="{$book->getListingURL('textbooks')}" title="{$book->getTitle()}">{$book->getTitle()}</a></h4>
                            <p>{$book->getAuthor()}</p>
<p>({$book->getPublisher()}
EOF;
if($book->getRelease()) {
$BWHTML .= <<<EOF
, {$book->getRelease()}
EOF;
}

$BWHTML .= <<<EOF
)</p>
                            <p class="cost">
                            
EOF;
if( $book->price ) {
$BWHTML .= <<<EOF

                            {$vsLang->getWords('global_curency','$')}
                        {$book->price}
                        
EOF;
}

$BWHTML .= <<<EOF

                            </p>
                        </div>
                        <div class="clear_left"></div>
                   </div>
                    
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:userNavigator:desc::trigger:>
//===========================================================================
function userNavigator() {
//--starthtml--//
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
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:leftSubject:desc::trigger:>
//===========================================================================
function leftSubject($option=array()) {global $bw;

//--starthtml--//
$BWHTML .= <<<EOF
        <div id="sitebar">
        <div class="subject_list">
        <h3>Subjects</h3>
        
EOF;
if( $option ) {
$BWHTML .= <<<EOF

        {$this->__foreach_loop__id_503f80fc5914e($option)}
            
EOF;
}

$BWHTML .= <<<EOF

        </div>
    </div>
EOF;
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc5914e($option=array())
{
global $bw;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option as $cat  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
            <a href="{$cat->subURL}" title="{$cat->getTitle()}">{$cat->getTitle()}</a>
            
EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:searchForm:desc::trigger:>
//===========================================================================
function searchForm($option=array()) {global $bw;
return 
//--starthtml--//
$BWHTML .= <<<EOF
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
//--endhtml--//
return $BWHTML;
}
//===========================================================================
// <vsf:objFormPortlet:desc::trigger:>
//===========================================================================
function objFormPortlet($obj="",$tu="",$option="") {global $vsLang, $bw, $vsPrint, $vsUser, $vsTemplate;


//--starthtml--//
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
                        

EOF;
if( $option['textbookCondition'] ) {
$BWHTML .= <<<EOF

<label>Condition:</label>
<select id="tuCondition" name="tuCondition">
{$this->__foreach_loop__id_503f80fc59d82($obj,$tu,$option)}
</select>

EOF;
}

$BWHTML .= <<<EOF

                        

EOF;
if( $option['textbookType'] ) {
$BWHTML .= <<<EOF

<label>Business:</label>
<select id="tuType" name="tuType">
{$this->__foreach_loop__id_503f80fc59eee($obj,$tu,$option)}
</select>

EOF;
}

$BWHTML .= <<<EOF

                        
<label>Subjects:</label>
<select id="tuSubject" name="tuSubject">

EOF;
if( $option['subjectList'] ) {
$BWHTML .= <<<EOF

{$this->__foreach_loop__id_503f80fc5a04f($obj,$tu,$option)}

EOF;
}

$BWHTML .= <<<EOF

</select>
                        
<label>Campus:</label>
<select id="tuCampus" name="tuCampus">
<option value="0">{$vsLang->getWords('campus','Campus')}</option>

EOF;
if( $option['campusList'] ) {
$BWHTML .= <<<EOF

{$this->__foreach_loop__id_503f80fc5a1b3($obj,$tu,$option)}

EOF;
}

$BWHTML .= <<<EOF

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
                        
                        
EOF;
if( $option['valid'] ) {
$BWHTML .= <<<EOF

                        <label>Image:</label>
                        <input type="file" class="input_file" size="16" name="bookImage" />
                        
EOF;
}

$BWHTML .= <<<EOF

                        
                        
EOF;
if( $obj->getImage() ) {
$BWHTML .= <<<EOF

                        <label>&nbsp;</label>
                        <div class='img'>
                        
EOF;
if( $obj->getImage() ) {
$BWHTML .= <<<EOF

{$obj->createImageCache($obj->getImage(),85,115)}

EOF;
}

else {
$BWHTML .= <<<EOF

<img src="{$bw->vars['img_url']}/noimage.jpg" alt="{$vsLang->getWords('global_no_image','No Imgae')}" width="85" height="115" />

EOF;
}
$BWHTML .= <<<EOF

</div>

EOF;
}

$BWHTML .= <<<EOF

                        
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

EOF;
if( !$option['valid'] ) {
$BWHTML .= <<<EOF

    enable();
    
EOF;
}

$BWHTML .= <<<EOF

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
//--endhtml--//
return $BWHTML;
}

//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc59d82($obj="",$tu="",$option="")
{
global $vsLang, $bw, $vsPrint, $vsUser, $vsTemplate;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['textbookCondition'] as $subject )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<option value="{$subject->getId()}">{$subject->getTitle()}</option>

EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc59eee($obj="",$tu="",$option="")
{
global $vsLang, $bw, $vsPrint, $vsUser, $vsTemplate;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['textbookType'] as $subject )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<option value="{$subject->getId()}">{$subject->getTitle()}</option>

EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc5a04f($obj="",$tu="",$option="")
{
global $vsLang, $bw, $vsPrint, $vsUser, $vsTemplate;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['subjectList'] as $subject )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<option value="{$subject->getId()}">{$subject->getTitle()}</option>

EOF;
$vsf_count++;
    }
    return $BWHTML;
}


//===========================================================================
// Foreach loop function
//===========================================================================
function __foreach_loop__id_503f80fc5a1b3($obj="",$tu="",$option="")
{
global $vsLang, $bw, $vsPrint, $vsUser, $vsTemplate;
    $BWHTML = '';
    $vsf_count = 0;
    $vsf_class = '';
    foreach(  $option['campusList'] as $campus  )
    {
        $vsf_class = $vsf_count%2?'odd':'even';
    $BWHTML .= <<<EOF
        
<option value="{$campus->getId()}">{$campus->getTitle()}</option>

EOF;
$vsf_count++;
    }
    return $BWHTML;
}
//===========================================================================
// <vsf:callback:desc::trigger:>
//===========================================================================
function callback($option="") {global $vsLang;

//--starthtml--//
$BWHTML .= <<<EOF
        <script type='text/javascript'>
$('#block_message').html('{$option['message']}');
setTimeout(function() { 
        $.unblockUI();
        {$option['script']}
        }, 2000);
</script>
EOF;
//--endhtml--//
return $BWHTML;
}


}?>