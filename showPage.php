<?php

include("simple_html_dom.php");
$url = $_GET['url'];
$start_url = $_GET['start_url'];
$html = file_get_html($url);






/*foreach($html->find('#api-info-block') as $article) {
    $item['title']   = $article->find('div.sum-details-links', 0)->outertext;
    $item['intro']   = $article->find('div.api-level', 0)->plaintext;
    $item['details'] = $article->find('div.api-level', 1)->plaintext;
    $item['content'] = $article->find('div#jd-content', 0)->outertext;
    $item['test2'] =$article->first_child()->outertext;
    $articles[] = $item;
}*/


foreach($html->find('div#footer') as $script) {
	$script->outertext='';
	$html->load($html->save());
}


//print_r($articles); 
foreach($html->find('#api-info-block') as $article) {
	foreach($article->find('div') as $div) {
		echo strip_tags($div->outertext, '<p><br><div><table><span><h4><td><tr><h1><ul>');
	}
}

foreach ($html->find('div#jd-header') as $header) {
	
		echo strip_tags($header->outertext, '<p><br><div><table><span><h4><td><tr><h1><ul>');
	
}

foreach ($html->find('div#jd-content') as $content) {

	foreach ($content->find('div') as $div) {
		
		echo strip_tags($div->outertext, '<p><br><div><table><span><h4><td><tr><h1><ul>');
		
	}
	//echo $content->outertext;
}


?>