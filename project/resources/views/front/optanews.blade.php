@extends('layouts.front')

@section('content')

	@if($ps->slider == 1)

		@if(count($sliders))
			@include('includes.slider-style')
		@endif
	@endif

<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="pages">
                    <li>
                        <a href="{{ route('front.index') }}">
                            {{ $langg->lang17 }}
                        </a>
                    </li>
                    <li>
                        <a href="#">
                           News Feed 
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->

    <div class="container containeer li-main-blog-page pt-60 pb-55">
        <div class="container containeer">
            <div class="row">
                <!-- Begin Li's Main Content Area -->
                <div class="col-lg-8 order-lg-1 order-1 load_more ">
                    <div class="row li-main-content searched_val optanews_counter ">

<?php 



     if(isset($key) && !empty($key))
     {
        
        foreach ($news_feed as $item ) 
        {  

         $pos = strpos($item->title, $key);
         if($pos)
         { ?>
             <div class="col-lg-12 ">
        <div class="li-blog-single-item mb-30">
            <div class="row ">
                <div class="col-lg-5">
                    <div class="li-blog-banner">
                                         
                    <?php 
                       
                       

                         

                            // dd('aaa');
                            if(isset($item->image) && !empty($item->image))
                            {

                           
                        ?>
                                     
                       <img class="img-full" src="https://visionmonday.com{{$item->file}}" alt="">
                       <?php 
                        }else{
                            ?>
                             <a href="<?php echo $item->link.'" title="'.$item->title  ?> " target="_blank">
                             <img class="img-full" src="{{asset('assets/images/newsfeed.jpeg')}}" alt=""></a>
                         <?php }
                        
                      

                        ?>

                                                        
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="li-blog-content">
                        <div class="li-blog-details">
                            <h3 class="li-blog-heading pt-xs-25 pt-sm-25 text-justify"><a class="a_title" href="<?php echo 'news_feed_detail?title='.$item->title.'&link='.$item->link; ?>">{{$item->title}}</a></h3>
                            <p class="p_news text-justify"><?php echo  $str = substr($item->description, 0, 150) . '...';    ?>
                            </p>
                           <br>
                            <a class="read-more-blogs" href="<?php echo 'news_feed_detail?title='.$item->title.'&link='.$item->link;; ?>" target="_blank">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

         <?php }
        }  
     }else{


			
	foreach ($news_feed as $item ) 
	{  
       
       
	?>

    <div class="col-lg-12 ">
        <div class="li-blog-single-item mb-30">
            <div class="row ">
                <div class="col-lg-5">
                    <div class="li-blog-banner">
                                         
                    <?php 
              		
	                   

							 if(isset($item->file) && !empty($item->file))
                            {

                           
                        ?>
                                     
                       <img class="img-full" src="https://visionmonday.com{{$item->file}}" alt="">
                       <?php 
                        }else{


                            ?>
                             <a href="<?php echo $item->link.'" title="'.$item->title  ?> ">
                             <img class="img-full" src="{{asset('assets/images/newsfeed.jpeg')}}" alt=""></a>
                         <?php }
						?>                               
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="li-blog-content">
                        <div class="li-blog-details">
                            <h3 class="li-blog-heading pt-xs-25 pt-sm-25 text-justify"><a class="a_title" href="<?php echo 'news_feed_detail?title='.$item->title.'&link='.$item->link; ?>">{{$item->title}}</a></h3>
                            <p class="p_news text-justify"><?php echo  $str = substr($item->description, 0, 150) . '...';    ?>
                            </p>
                           <br>
                            <a class="read-more-blogs" href="<?php echo 'news_feed_detail?title='.$item->title.'&link='.$item->link;; ?>" target="_blank">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
    

}
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
                             <form action="{{url('news_feed_search')}}" method="POST">
                                @csrf
                                    <input id="fsearch" type="text"  name="fsearch" value="<?= (isset($key) && !empty($key)) ? $key : ''; ?>" class="li-search-field" placeholder="Search any news here">
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
                <div class="load-more">
            	    <button type="button" id="loadMore">Load More</button>
                                    </div>
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
        var search = '<?= isset($key)?$key:"" ?>';
   

    		   $.ajax({  
                type: "get",
                url: 'get_second_site_data?site='+site+'&search='+search,
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