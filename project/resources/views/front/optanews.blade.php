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
                <div class="col-lg-8 order-lg-1 order-1 load_more ">
                    <div class="row li-main-content searched_val optanews_counter ">

<?php 

	$url = 'https://visionmonday.com/rss/eyecare/';
	$rss = Feed::loadRss($url);

			
	foreach ($rss->item as $item ) 
	{

	?>

    <div class="col-lg-12 ">
        <div class="li-blog-single-item mb-30">
            <div class="row ">
                <div class="col-lg-5">
                    <div class="li-blog-banner">
                                         
                    <?php 
              			if(isset($item->link))
              			{

              				 $content = file_get_contents($item->link);

							preg_match_all('/<img[^>]+>/i',$content, $result);
						

          				 	// $content = file_get_contents($item->link);
							// dd($item->link,$content);
							preg_match_all('/<img[^>]+>/i',$content, $result); 
						
							$value = $item->title;
							$first = strtok($value, " ");


              			}
	                   

							if(isset($result[0]))
							{

							foreach($result[0] as $re_k => $re_v)
							{
							
								$pos = strpos($re_v, $first);
								// $pos = strpos($re_v, 'eonie');
						
								if($pos)
								{
									$image = $re_v;
									break;
								}else{
									$image = '';
								}
							}
							
							// dd('aaa');
							if(isset($image) && !empty($image))
							{

				    		$html = $image;
							$doc = new DOMDocument();
							$doc->loadHTML($html);
							$xpath = new DOMXPath($doc);
							$src = $xpath->evaluate("string(//img/@src)"); # "/images/image.jpg"
                    	?>
                                     
                       <img class="img-full" src="https://visionmonday.com{{$src}}" alt="">
                       <?php 
                   		}else{
                   			?>
                   			 <a href="<?php echo $item->url.'" title="'.$item->title  ?> " target="_blank">
							 <img class="img-full" src="{{asset('assets/images/newsfeed.jpeg')}}" alt=""></a>
                   		 <?php }
                        
                        }else{ 


                        	?>
							  <a href="<?php echo $item->url.'" title="'.$item->title  ?> " target="_blank">
							 <img class="img-full" src="{{asset('assets/images/newsfeed.jpeg')}}" alt=""></a>

						<?php       
							}
						



						?>

                                                        
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="li-blog-content">
                        <div class="li-blog-details">
                            <h3 class="li-blog-heading pt-xs-25 pt-sm-25 text-justify"><a class="a_title" href="<?php echo 'news_feed_detail?title='.$item->title.'&link='.$item->link; ?>">{{$item->title}}</a></h3>
                            <p class="p_news text-justify"><?php echo  $str = substr($item->description, 0, 150) . '...';    ?>
                            </p>
                           
                            <a class="read-more-blogs" href="<?php echo 'news_feed_detail?title='.$item->title.'&link='.$item->link;; ?>" target="_blank">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
    }
?>


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


<style type="text/css">
	#loadMore {
    padding: 10px;
    text-align: center;
    background-color: #33739E;
    color: #fff;
    border-width: 0 1px 1px 0;
    border-style: solid;
    border-color: #fff;
    box-shadow: 0 1px 1px #ccc;
    transition: all 600ms ease-in-out;
    -webkit-transition: all 600ms ease-in-out;
    -moz-transition: all 600ms ease-in-out;
    -o-transition: all 600ms ease-in-out;
}
#loadMore:hover {
    background-color: #fff;
    color: #33739E;
}
</style>
            <div class="col-lg-12">

            	<button type="button" id="loadMore">Load More</button>
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




 
    </script>
	




	


@endsection


@section('scripts')
	<script>

$(function () {
    $("div").slice(0, 4).show();
    $("#loadMore").on('click', function (e) {


    	if($('.optanews_counter').length == 1)
    	{
    		site = 1;
    	}else if($('.optanews_counter').length == 2){
    		site = 2;
    	}else{
    		site = 3;
    		$('#loadMore').hide();

    	}
    	

    		   $.ajax({  
                type: "get",
                url: 'get_second_site_data?site='+site,
                success:function(data)
                {
                 var data = jQuery.parseJSON( data );
                  console.log(data);
                    $('.load_more').append(data);
                }
            });

    });
});




	</script>
@endsection