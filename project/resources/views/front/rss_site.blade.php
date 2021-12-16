  <div class="row li-main-content searched_val optanews_counter ">
<?php
if(isset($_GET['search']) && !empty($_GET['search']))
{
	   foreach ($rss->item as $item ) 
        {  
	   		$pos = strpos($item->title, $_GET['search']);
   		   if($pos)
   		   { ?>
   		   	 <div class="col-lg-12 ">
	        <div class="li-blog-single-item mb-30">
	            <div class="row ">
	                <!-- <div class="col-lg-5">
	                    <div class="li-blog-banner">
	                                         
	                    <?php 
	              			if(isset($item->link))
	              			{

	              				$ch = curl_init();
								curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
								curl_setopt($ch,CURLOPT_URL,$item->link);
								curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
								curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13");
								$content = curl_exec($ch);
								curl_close($ch);
							
	              				 // $content = file_get_contents($item->link);

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
	                </div> -->
	                <div>
	                    <div class="li-blog-content">
	                        <div class="li-blog-details">
	                            <h3 class="li-blog-heading pt-xs-25 pt-sm-25 text-justify"><a class="a_title" href="<?php echo 'news_feed_detail?title='.$item->title.'&link='.$item->link.'&site='.$site; ?>">{{$item->title}}</a></h3>
	                            <p class="p_news text-justify"><?php echo  $str = substr($item->description, 0, 150) . '...';    ?>
	                            </p>
	                           
	                            <a class="read-more-blogs" href="<?php echo 'news_feed_detail?title='.$item->title.'&link='.$item->link.'&site='.$site; ?>" target="_blank">Read more</a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>


   		  <?php }	
		}
}else{
	foreach ($rss->item as $item ) 
				{

				?>

	    <div class="col-lg-12 ">
	        <div class="li-blog-single-item mb-30">
	            <div class="row ">
	                <!-- <div class="col-lg-5">
	                    <div class="li-blog-banner">
	                                         
	                    <?php 
	              			if(isset($item->link))
	              			{

	              				$ch = curl_init();
								curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
								curl_setopt($ch,CURLOPT_URL,$item->link);
								curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
								curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13");
								$content = curl_exec($ch);
								curl_close($ch);
							
	              				 // $content = file_get_contents($item->link);

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
	                </div> -->
	                <div>
	                    <div class="li-blog-content">
	                        <div class="li-blog-details">
	                            <h3 class="li-blog-heading pt-xs-25 pt-sm-25 text-justify"><a class="a_title" href="<?php echo 'news_feed_detail?title='.$item->title.'&link='.$item->link.'&site='.$site; ?>">{{$item->title}}</a></h3>
	                            <p class="p_news text-justify"><?php echo  $str = substr($item->description, 0, 150) . '...';    ?>
	                            </p>
	                           
	                            <a class="read-more-blogs" href="<?php echo 'news_feed_detail?title='.$item->title.'&link='.$item->link.'&site='.$site; ?>" target="_blank">Read more</a>
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