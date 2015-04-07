<?php
	require('simple_html_dom.php');
	$search_query = $_POST['search'];
	$final_query = str_replace(' ', '+', $search_query);

	$jsonurl = "https://ajax.googleapis.com/ajax/services/search/images?v=1.0&q=".urlencode($search_query)."&imgsz=small|medium|large|xlarge&safe=active";
	//$jsonurl="https://www.google.com/search?site=&tbm=isch&source=hp&biw=1366&bih=667&q=".$final_query."&gs_l=img.3..0l10.3759.4397.0.5022.5.5.0.0.0.0.227.603.0j3j1.4.0....0...1ac.1.45.img..1.4.599.cgBKIvR4gcU&gws_rd=ssl";
                  $result = json_decode(file_get_contents($jsonurl), true);
				  for($i=0;$i<4;$i++){
					  echo "<img height=\"200\" src='{$result['responseData']['results'][$i]['tbUrl']}' />";
					  echo "<br/>";
					  $content = $result['responseData']['results'][$i]['tbUrl'];
					  file_put_contents('grabs/image'.[$i].'.jpg', $content);
				  }
				 
				 // Create DOM from URL or file
				$html = file_get_html($jsonurl);

				// Find all images 
				foreach($html->find('img') as $element) {
						echo $element->src . '<br>';
						$path='grabs/';
						file_put_contents($path,$element->src);
						echo "<img src=".$element->src.">";
						
						}
?> 