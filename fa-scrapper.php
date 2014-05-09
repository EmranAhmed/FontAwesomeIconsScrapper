<?php


$faSiteURL = file_get_contents('http://fontawesome.io/cheatsheet/');


$prefix = 'fa '; 


$doc = new DOMDocument();
@$doc->loadHTML( $faSiteURL  );
$XPath = new DOMXPath($doc);

$rows = $XPath->query('//*[@id="wrap"]/div[@class="container"]/div[@class="row"]/div');

// right click inspect and copy xpath ;)


// writing array

$content = '<?php

$fontawesome_icons = array(' . "\n\n";

$iconsArray = array();

foreach( $rows as $row ){

	$iconNode = $row->nodeValue;

	preg_match('/(?P<icon>[a-z0-9\-]+)/', $iconNode, $matches);

	$arr_index = $prefix . trim($matches['icon']);
	$arr_value = trim($matches['icon']);


	$iconsArray[] = "\t'". $arr_index . "'=>'" . $arr_value . "'"; 
}

$content .= implode(','."\n", $iconsArray);
$content .= "\n".');';

?>

<h1>Total: <?php echo count($iconsArray) ?> Icons :)</h1>

<textarea style="width: 900px; height: 400px; font-family: monospace; font-size: large;"><?php echo $content ?></textarea>

