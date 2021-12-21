@extends('layouts.front')

@section('content')

	@if($ps->slider == 1)

		@if(count($sliders))
			@include('includes.slider-style')
		@endif
	@endif

<!-- Breadcrumb Area Start -->
<style type="text/css">
    #loading-img {
    background: url("https://boomopti.com/assets/images/1638444758Rolling-1s-57px(1).gif") center center no-repeat;
    display: none;
    height: 100px;
    width: 100px;
    position: fixed;
    top: 33%;
    left: 1%;
    right: 1%;
    margin: auto;
 
}




#cover-spin {
    position:fixed;
    width:100%;
    left:0;right:0;top:0;bottom:0;
    background-color: rgba(255,255,255,0.7);
    z-index:9999;
    display:none;
}



</style>
<div id="cover-spin"></div>


  <div id="loading-img"></div>
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
                        <a href="{{ route('user.optanews')}}">
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
    <div class="col-lg-9">
            <?php 

     if(isset($key) && !empty($key))
     {

        foreach ($news_feed as $item ) 
        {  

         $pos = strpos($item->title, $key);
         $pubDate = $item->pubDate;
         if($pos)
         { ?>
         <div class="col-lg-12 ">
        <div class="li-blog-single-item mb-30">
            <div class="row ">
 
                <div class="col-lg-12">
                    <div class="li-blog-content">
                        <div class="li-blog-details">
                            <h3 class="li-blog-heading pt-xs-25 pt-sm-25 text-justify"><a class="a_title" href="<?php echo 'news_feed_detail?title='.$item->title.'&link='.$item->link; ?>">{{$item->title}}</a></h3>         <?php
                                           

                                             echo  date("D M j Y", strtotime($item->pubDate)) ?>
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
 
                <div class="col-lg-12">
                    <div class="li-blog-content">
                        <div class="li-blog-details">
                            <h3 class="li-blog-heading pt-xs-25 pt-sm-25 text-justify"><a class="a_title" href="<?php echo 'news_feed_detail?title='.$item->title.'&link='.$item->link; ?>">{{$item->title}}</a></h3>         <?php
                                           

                                             echo  date("D M j Y", strtotime($item->pubDate)) ?>
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
                 <div class="col-lg-3">
                <!-- Li's Main Content Area End Here -->
                <!-- Begin Li's Blog Sidebar Area -->
                <div>
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
            </div>

                <!-- Li's Blog Sidebar Area End Here -->
         
            <br>
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
                 beforeSend: function() {
                    $('#cover-spin').show(0);
                    $('#loading-img').show();
              
                },
                success:function(data)
                {
                      $('#cover-spin').hide(0);
                    $('#loading-img').hide();
                 var data = jQuery.parseJSON( data );
                  console.log(data);
                    $('.load_more').append(data);
                }
            });

    });
});




	</script>
@endsection