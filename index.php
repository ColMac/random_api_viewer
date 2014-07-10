<?php


function getUrl() {

	$target_url = 'http://developer.android.com/reference/classes.html';
	$userAgent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13';
	$base_url= 'http://developer.android.com';

 	$ch = curl_init();
 	curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
 	curl_setopt($ch, CURLOPT_URL,$target_url);
 	curl_setopt($ch, CURLOPT_FAILONERROR, true);
 	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
 	curl_setopt($ch, CURLOPT_AUTOREFERER, true);
 	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
 	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
 	$html = curl_exec($ch);
 	if (!$html) {
		echo "<br />cURL error number:" .curl_errno($ch);
		echo "<br />cURL error:" . curl_error($ch);
		exit;
 	}

 	$dom = new DOMDocument();
	@$dom->loadHTML($html);

	$xpath = new DOMXPath($dom);
	$hrefs = $xpath->evaluate("/html/body//a");

	$links = null;

	for ($i = 0; $i < $hrefs->length; $i++) {
 		$href = $hrefs->item($i);
 		$link = $href->getAttribute('href');
 		$text = $href->nodeValue;

    	if (explode('/', $link)[1] == 'reference') {
    		$links[$i]['href'] = $link;
    		$links[$i]['text'] = $text;                
    	}       
	} 

	echo $base_url . $links[rand(0, sizeof($links))]['href'] . " " . rand(0, 10);
}

	

?>
<html>
	<head>
	
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/default.css">

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script type="text/javascript">
	

	function loadContent() {
		var url = "<?php echo getUrl(); ?>";
		$.ajax({
  			url: "showPage.php?url=" + url;
			}).done(function(data) { // data what is sent back by the php page
  				$('#content').html(data); // display data
			});
		}
		
	

	
	</script>
	</head>
	<body>
	<div id="header">
	
	<input id="re-roll" type="button" value="Re-Roll" onclick="loadContent();" />
	</div>

	<div id="content">
	

	</div>
	</body>	
</html>