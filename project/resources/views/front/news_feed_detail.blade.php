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
	              			if(isset($_GET['link']))
	              			{

	              				 $content = file_get_contents($_GET['link']);

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
                                        <h2 class="li-blog-heading"><a href="#"><?php //echo $title ?></a></h2>
                                        <div class="li-blog-meta">
                                         
                                            <a href="#"><span>Dated: </a>
                                            </span>
                                         
                                        </div>
                                        <div class="li-blog-banner">
                                            <a href="blog-details.html"><img class="img-full-detail" src="https://visionmonday.com{{$src}}" alt=""></a>
                                        </div>
                                        <p>
                                            

                                            <?php //echo  $str = $description;    ?>
                                        </p>
                                        <a class="read-more-blogs" href="{{$_GET['link']}}" target="_blank">Read Original Article</a>
                                     <!--    <div class="li-blog-sharing d-inline pt-30">
                                            <h4 class="d-inline">share this news feed:</h4>
                                            <a href="https://www.facebook.com/optazoom/"><i class="fa fa-facebook"></i></a>
                                            <a href="https://twitter.com/optazoom?lang=en"><i class="fa fa-twitter"></i></a>
                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                            <a href="#"><i class="fa fa-google-plus"></i></a>
                                        </div> -->
                                        <div class="pt-100">
                                           <a href=""> <p class="go-back text-center">Go BACK</p></a>
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