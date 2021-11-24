<?php 
    $url = 'https://visionmonday.com/rss/eyecare/';
    $rss = Feed::loadRss($url);
    \DB::table('news_feed')->where('site',1)->delete();
    foreach ($rss->item as $item ) 
    {  
       
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
                
            }else{
                $src = '';
                }
            
            }else{ 


                   
                }
            $data = array('title'=>$item->title,
                'description' => $item->description,
                'link' => $item->link,
                'file'=>$src,
                'site' =>1);
                \DB::table('news_feed')->insert($data);        

        }