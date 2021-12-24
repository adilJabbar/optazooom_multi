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
                        <a href="{{ route('front.indexx') }}">
                            {{ $langg->lang17 }}
                        </a>
                    </li>
                    <li>
                    <a class="a_title" href="#">News Feed Details</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->

     <?php 
            $content = '';
  			if(isset($_GET['link']))
  			{
                if(!isset($_GET['site']))
                {

                    $url = 'https://visionmonday.com/rss/eyecare/';
                    $rss = Feed::loadRss($url);
                    $content = file_get_contents($_GET['link']);

                }
                if(isset($_GET['site']) && $_GET['site']==1 )
                {
                     $url = 'https://www.optometrytimes.com/rss';
                     $rss = Feed::loadRss($url);
                }
                if(isset($_GET['site']) && $_GET['site']==2 )
                {
                    $url = 'https://www.opticianonline.net/site/GetRssFeed/All';
                    $rss = Feed::loadRss($url);
                }
                if(isset($_GET['site']) && $_GET['site']==3 )
                {
                    $url = 'https://www.journalofoptometry.org/en-rss-ultimo';
                    $rss = Feed::loadRss($url);
                }

                if(empty($content))
                {   
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch,CURLOPT_URL,$_GET['link']);
                        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13");
                        $content = curl_exec($ch);
                        curl_close($ch);
                }

          





    foreach ($rss->item as $k => $item ) 
    {
        
      

        if($item->title== $_GET['title'])
        {
       
            $title = $item->title;
            $description = $item->description;
            $pubDate = $item->pubDate;
            break;
        }else{
            $title = '';
            $description = '';
            $pubDate = '';
        }
      
    }

								preg_match_all('/<img[^>]+>/i',$content, $result);
								

              				 	// $content = file_get_contents($item->link);
								// dd($item->link,$content);
								preg_match_all('/<img[^>]+>/i',$content, $result); 
							
								$value = $_GET['title'];
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
	                                     
	                   
	                       <?php 
                       		}else{
                       			?>
                       			
                       		 <?php }
	                        
	                        }else{ 


	                        	?>
								

							<?php       
								}
							



							?>



          <div class="li-main-blog-page li-main-blog-details-page pt-60 pb-60 pb-sm-45 pb-xs-45">
        <div class="container-setting-page-detail">
            <div class="row">
                <!-- Begin Li's Blog Sidebar Area -->
                <div class="col-lg-3 order-lg-2 order-2">
                    <div class="li-blog-sidebar-wrapper">
                  
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
                                            <a href="#"><span><?php echo $pubDate ?> </a>
                                            </span>
                                         
                                        </div>
                                        <div class="li-blog-banner">
                                            <div class="row">
                                                    <div class="col-lg-4">
                                                  <a href="blog-details.html">
                                                <?php if(isset($src)){ ?>
                                                    <img class="img-full-detail" src="https://visionmonday.com{{$src}}" alt="">
                                                <?php }else{ ?>
                                                    <img class="img-full-detail" src="{{asset('assets/images/newsfeed.jpeg')}}" alt="">

                                                <?php } ?>
                                            </a> 
                                            </div>
                                            <div class="col-lg-8">
                                    <p><?php echo  $str = $description;?></p>
                                            </div>
                                            </div>
                                        </div>
               
                                     <!--    <div class="li-blog-sharing d-inline pt-30">
                                            <h4 class="d-inline">share this news feed:</h4>
                                            <a href="https://www.facebook.com/optazoom/"><i class="fa fa-facebook"></i></a>
                                            <a href="https://twitter.com/optazoom?lang=en"><i class="fa fa-twitter"></i></a>
                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                            <a href="#"><i class="fa fa-google-plus"></i></a>
                                        </div> -->
                                        <div class="read_more">
                                             <a class="read-more-blogs" href="{{$_GET['link']}}">Read Original Article</a>
                                        </div>
                                        <br>
                                        <div class="go_back">
                                           <a href="{{url('optanews')}}"> <p class="go-back text-center" style="text-align:center;">Go Back</p></a>
                                        </div>
                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
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