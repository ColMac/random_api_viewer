<?php

$target_url = 'http://developer.android.com/reference/classes.html';
$userAgent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13';
$base_url= 'http://developer.android.com';
//curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

 $ch = curl_init();
 curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
 curl_setopt($ch, CURLOPT_URL,$target_url);
 curl_setopt($ch, CURLOPT_FAILONERROR, true);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
 curl_setopt($ch, CURLOPT_AUTOREFERER, true);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
 curl_setopt($ch, CURLOPT_TIMEOUT, 10);
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

     // Do what you want with the link, print it out:
 	$split_array = explode('/', $link);
 	if ($split_array[1] == 'reference') {
     //echo  $link . ' -- > ' . $text . '<br>';

 	}

    // Or save this in an array for later processing..
    if (explode('/', $link)[1] == 'reference') {
    	$links[$i]['href'] = $link;
    	$links[$i]['text'] = $text;                

    }       
} 
//echo $base_url . $links[rand(0, sizeof($links))]['href']; // spit out random url.

echo $base_url . $links[rand(0, sizeof($links))]['href'];
?>