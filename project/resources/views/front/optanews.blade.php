@extends('layouts.front')

@section('content')

	@if($ps->slider == 1)

		@if(count($sliders))
			@include('includes.slider-style')
		@endif
	@endif

	
    <style type="text/css">
    .pagination li:last-child a {
        font-size: 14px; 
    }
    .page-link {
       padding: 0;
    }
    .page-item > .active{
        padding: .5rem .75rem;
    }

    .page-link > a {     
       display: inline-block;     
       position: relative;    
       z-index: 1;
       padding: .5rem .75rem;
       margin: 0px;
    }
    .a_title{
            font-size: 17px;
            line-height: 0px;
           
    }
    .p_news{
        line-height: 24px !important;
        padding-top: 15px !important;
       
    }
    .containeer{
    max-width: 100%;
    padding-left: 20px;
    padding-right: 77px;
    }


</style>
<!--Breadcrumb-->
<div class="breadcrumb justify-content-center pt-60 pb-60">
    <div>
        <ol class="breadcrumb">
            <h3 class="bread-login">News Feed</h3>
        </ol>
        <ol class="breadcrumb" style="position: relative; left: 3px;">

            <li class="breadcrumb-item bread-title"><a href="#">Home</a></li>
            <li class="breadcrumb-item bread-title active bread-title" aria-current="page">News Feed</li>
        </ol>
    </div>
</div>

<!--Breadcrumb end-->

    <div class="container containeer li-main-blog-page pt-60 pb-55">
        <div class="container containeer">
            <div class="row">
                <!-- Begin Li's Main Content Area -->
                <div class="col-lg-8 order-lg-1 order-1">
                    <div class="row li-main-content searched_val">



 <?php 
 


  
 $url = 'https://visionmonday.com/rss/eyecare/';
 $rss = Feed::loadRss($url);

 $url = 'https://www.optometrytimes.com/rss';
 $rss1 = Feed::loadRss($url);

 $url = 'https://www.opticianonline.net/site/GetRssFeed/All';
 $rss2 = Feed::loadRss($url);

 $url = 'https://www.journalofoptometry.org/en-rss-ultimo';
 $rss3 = Feed::loadRss($url);



$httpClient = new \GuzzleHttp\Client();
$response = $httpClient->get('https://www.visionmonday.com/eyecare/article/alcon-reports-15-percent-increase-in-third-quarter-2021-sales/');
$htmlString = (string) $response->getBody();
//add this line to suppress any warnings
libxml_use_internal_errors(true);
$doc = new DOMDocument();
$doc->loadHTML($htmlString);






$xpath = new \DOMXpath($doc);
  $articles = $xpath->query('//div');
dd($articles);
  // all links in h2's in .blogArticle
  $links = [];
  dd($xpath->query('img'));
  foreach($articles as $container) {
  	dd($container,'aaa');
    $arr = $container->getElementsByTagName("a");
    foreach($arr as $item) {
      if($item->parentNode->tagName == "h2") {
        $href =  $item->getAttribute("img");
        $text = trim(preg_replace("/[\r\n]+/", " ", $item->nodeValue));
        $links[] = [
          'img' => $href,
          'text' => $text
        ];
      }
    }
  }



// $xpath = new DOMXPath($doc);
//   $arr = $doc->getElementsByTagName("img");

// dd($links);

// $ch = curl_init();
// 	curl_setopt($ch, CURLOPT_URL, 'https://www.visionmonday.com/eyecare/article/alcon-reports-15-percent-increase-in-third-quarter-2021-sales/');
// 	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 	$response = curl_exec($ch);
// 	curl_close($ch);
// 	$html = new simple_html_dom();
// 	$html->load($response);
//  dd($html);	


dd($rss1 ,$rss2 ,$rss3 ,$rss );
    foreach ($rss->item as $item ) {

 ?>

                        <div class="col-lg-12">
                            <div class="li-blog-single-item mb-30">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="li-blog-banner">
                                         
                                                <?php 

                                                 if (isset($has_image) && $has_image == 1) {

                                                    ?>
                                       <a href="<?php echo $link.'" title="'.$title  ?>"><?= $title ?>">
                                        <img class="img-full" src="<?=  $image['src']; ?>" alt=""></a>

          

                             <?php 
                                 }else{ ?>



  <a href="<?php echo $item->url.'" title="'.$item->title  ?> " target="_blank">

 <img class="img-full" src="" alt=""></a>

     <?php       }
         ?>

                                                        
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="li-blog-content">
                                                    <div class="li-blog-details">
                                                        <h3 class="li-blog-heading pt-xs-25 pt-sm-25 text-justify"><a class="a_title" href="<?php echo 'Home/news_feed_detail?title='.$item->title; ?>">{{$item->title}}aaa</a></h3>
                                                        <p class="p_news text-justify"><?php echo  $str = substr($item->description, 0, 150) . '...';    ?>
                                                        </p>
                                                       
                                                        <a class="read-more-blogs" href="<?php echo 'Home/news_feed_detail?title='.$item->title; ?>" target="_blank">Read more</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


<?php
    }

 ?>

                        <!-- Begin Li's Pagination Area -->

                        <!-- Li's Pagination End Here Area -->
                    </div>
                </div>

                <!-- Li's Main Content Area End Here -->
                <!-- Begin Li's Blog Sidebar Area -->
                <div class="col-lg-3 offset-lg-1 order-lg-2 order-2">
                    <div class="li-blog-sidebar-wrapper">
                        <div class="li-blog-sidebar">
                            <h4 class="li-blog-sidebar-title">Search</h4>
                            <div class="li-sidebar-search-form pt-xs-30 pt-sm-30">
                             <form id="get_rss_search">
                                    <input id="fsearch" type="text"  name="fsearch" value="<?= (isset($fsearch) && !empty($fsearch)) ? $fsearch : ''; ?>" class="li-search-field" placeholder="Search any news here">
                                    <input id="uri_seg" type="hidden" name="uri_seg" value="<?php echo Request::segment(3)?Request::segment(3):0; ?>">
                                    <?php if (isset($_GET['category'])) { ?>
                                        <input type="hidden" name="category" value="<?= $_GET['category']; ?>" class="li-search-field" placeholder="Search any news here">
                                    <?php } ?>
                                    <button id="btn" type="button" class="li-search-btn"><i class="fa fa-search"></i></button>
                             </form>
                            </div>
                        </div>
                   
                    </div>
                </div>
                <!-- Li's Blog Sidebar Area End Here -->
            </div>

            <div class="col-lg-12">
                <?php if(isset($pagination_links) && !empty($pagination_links)) : ?>
                    <div class="container Page navigation">
                        <nav aria-label="Page navigation example">
                            <?= $pagination_links;  ?>
                        </nav>
                    </div>
                <?php  endif;  ?>
            </div>
        </div>
    </div>


    <script type="text/javascript">
    
        $('#get_rss_search').on('click',function(){
             $.ajax({
                
                type: "get",
                success:function(data)
                {
                    var data = jQuery.parseJSON(data);
                    console.log(data);
                    if(data.success == "true")
                    {
                        $('.searched_val').html(data.view);
                      
                    } 
                }
            });
 })
 
    </script>
	




	


@endsection


@section('scripts')
	<script>
        $(window).on('load',function() {

            setTimeout(function(){

                // $('#extraData').load('{{route('front.extraIndex')}}');

            }, 500);
        });

	</script>
@endsection