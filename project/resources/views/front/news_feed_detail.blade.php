@extends('layouts.front')

@section('content')

	@if($ps->slider == 1)

		@if(count($sliders))
			@include('includes.slider-style')
		@endif
	@endif

     <!--Breadcrumb-->
     <div class="">
     <div class="breadcrumb justify-content-center pt-60 pb-60">
        <div>
            <ol class="breadcrumb">
                <h3 class="bread-login">News Feed</h3>
            </ol>
            <ol class="breadcrumb" style="position: relative; ">

                <li class="breadcrumb-item bread-title"><a href="#">Home</a></li>
                <li class="breadcrumb-item bread-title active bread-title" aria-current="page">News Feed Detail</li>
            </ol>
        </div>
    </div>
<?php 
function get_rss_feed_as_htmll($feed_url, $max_item_cnt = 10, $show_date = true, $show_description = true, $max_words = 0, $cache_timeout = 7200, $cache_prefix = "/tmp/rss2html-")
{
    $result = "";
    $resultt = "";
    // get feeds and parse items
    $rss = new DOMDocument();
    $cache_file = $cache_prefix . md5($feed_url);
    // load from file or load content
    // if ($cache_timeout > 0 &&
    //     is_file($cache_file) &&
    //     (filemtime($cache_file) + $cache_timeout > time())) {
    //         $rss->load($cache_file);
    // } else {
    //     $rss->load($feed_url);
    //     if ($cache_timeout > 0) {
    //         $rss->save($cache_file);
    //     }
    // }
    $feed = array();
    foreach ($rss->getElementsByTagName('item') as $node) {
        $item = array (
            'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
            'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
            'content' => $node->getElementsByTagName('description')->item(0)->nodeValue,
            'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
            'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
        );
        $content = $node->getElementsByTagName('encoded'); // <content:encoded>
        if ($content->length > 0) {
            $item['content'] = $content->item(0)->nodeValue;
        }
        array_push($feed, $item);
    }
    // real good count
    if ($max_item_cnt > count($feed)) {
        $max_item_cnt = count($feed);
    }

    for ($x=0;$x<$max_item_cnt;$x++) {
        $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
        $link = $feed[$x]['link'];
        $result .= '<li class="feed-item">';
        $result .= '<div class="feed-title"><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong></div>';
        if ($show_date) {
            $date = date('l F d, Y', strtotime($feed[$x]['date']));
            $result .= '<small class="feed-date"><em>Posted on '.$date.'</em></small>';
        }
        if ($show_description) {
            $description = $feed[$x]['desc'];
            $content = $feed[$x]['content'];
            // find the img
            $has_image = preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $content, $image);
            // no html tags
            $description = strip_tags(preg_replace('/(<(script|style)\b[^>]>).?(<\/\2>)/s', "$1$3", $description), '');
            // whether cut by number of words
            if ($max_words > 0) {
                $arr = explode(' ', $description);
                if ($max_words < count($arr)) {
                    $description = '';
                    $w_cnt = 0;
                    foreach($arr as $w) {
                        $description .= $w . ' ';
                        $w_cnt = $w_cnt + 1;
                        if ($w_cnt == $max_words) {
                            break;
                        }
                    }
                    $description .= " ...";
                }
            }
            // add img if it exists
            if ($has_image == 1) {
                $description = '<img class="feed-item-image" src="' . $image['src'] . '" />' . $description;
            }
            $result .= '<div class="feed-description">' . $description;
            $result .= ' <a href="'.$link.'" title="'.$title.'">Continue Reading &raquo;</a>'.'</div>';
        }
        $result .= '</li>';

        // print_r($_GET['title']);echo "===="; echo "</br>";
        // print_r($title);die;
        if($_GET['title'] == $title)
        { 



         ?>

          <div class="li-main-blog-page li-main-blog-details-page pt-60 pb-60 pb-sm-45 pb-xs-45">
        <div class="container-setting-page-detail">
            <div class="row">
                <!-- Begin Li's Blog Sidebar Area -->
                <div class="col-lg-3 order-lg-2 order-2">
                    <div class="li-blog-sidebar-wrapper">
                    <!--   -->
                      <!--   <div class="li-blog-sidebar pt-25">
                            <h4 class="li-blog-sidebar-title">Categories</h4>
                            <ul class="li-blog-archive">
                                <?php foreach($categories as $cat_k => $cat_v): ?>
                                    <li><a href="<?= base_url('Userproducts?category=').$cat_v['category_id']; ?>"><?= $cat_v['category_name']; ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div> -->
                    </div>
                </div>
            
                <div class="col-lg-9 order-lg-1 order-1">
                    <div class="row li-main-content">
                        <div class="col-lg-12">
                            <div class="li-blog-single-item pb-30">

                                <div class="li-blog-content">
                                    <div class="li-blog-details">
                                        <h2 class="li-blog-heading"><a href="#"><?php echo $title ?></a></h2>
                                        <div class="li-blog-meta">
                                         
                                            <a href="#"><span>Dated: <?= $date ?></a>
                                            </span>
                                         
                                        </div>
                                        <div class="li-blog-banner">
                                            <a href="blog-details.html"><img class="img-full-detail" src="<?= ASSETS_USER; ?>images/blog-banner/newsfeed.jpeg" alt=""></a>
                                        </div>
                                        <p>
                                            

                                            <?php echo  $str = $description;    ?>
                                        </p>
                                        <a class="read-more-blogs" href="<?php echo $link.'" title="'.$title  ?>" target="_blank">Read Original Article</a>
                                     <!--    <div class="li-blog-sharing d-inline pt-30">
                                            <h4 class="d-inline">share this news feed:</h4>
                                            <a href="https://www.facebook.com/optazoom/"><i class="fa fa-facebook"></i></a>
                                            <a href="https://twitter.com/optazoom?lang=en"><i class="fa fa-twitter"></i></a>
                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                            <a href="#"><i class="fa fa-google-plus"></i></a>
                                        </div> -->
                                        <div class="pt-100">
                                           <a href="<?= base_url('Home/news_feed'); ?>"> <p class="go-back text-center">Go BACK</p></a>
                                        </div>
                                       <!--  <div class="latest-heading">
                                            <h4>LATEST FROM OPTANEWS</h4>
                                        </div>
 -->
                                        <!-- <div class="row"> -->
                                            <?php foreach($all_news_feed as $all_k => $all_v) { ?>

                                       <!--      <div class="col-lg-4">
                                                <img src="<?php echo $this->crud_model->file_view('membership',$all_v['id'],'100','','thumb','src','','','.png') ?>" class="recent-blog-image" height="200" width="280">
                                                <h6 class="recent-blog-desc"><?=  $all_v['description']; ?></h6>
                                            </div> -->

                                        <?php } ?>
                                          
                                        <!-- </div> -->


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>

        </div>
    </div>







       <?php  }




    }


}



function output_rss_feedd($feed_url, $max_item_cnt = 10, $show_date = true, $show_description = true, $max_words = 0)
{
    echo get_rss_feed_as_htmll($feed_url, $max_item_cnt, $show_date, $show_description, $max_words);
}
if( Request::segment(3) < 4)
{
    output_rss_feedd('https://visionmonday.com/rss/eyecare/', 20, true, true, 200);
}
else if(Request::segment(3) == 4)
{
    output_rss_feedd('https://www.optometrytimes.com/rss', 20, true, true, 200);
}else if(Request::segment(3) == 8)
{
      output_rss_feedd('https://www.opticianonline.net/site/GetRssFeed/All', 20, true, true, 200);
  }else{
      output_rss_feedd('https://www.journalofoptometry.org/en-rss-ultimo', 20, true, true, 200);

  }



 ?>


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