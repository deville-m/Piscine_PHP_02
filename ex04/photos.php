#!/usr/bin/php
<?php

if ($argc != 2 || ($ch = curl_init()) == FALSE || filter_var($argv[1], FILTER_VALIDATE_URL) == FALSE)
	exit();

curl_setopt($ch, CURLOPT_URL, $argv[1]);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_FRESH_CONNECT, 5);

if (($data = curl_exec($ch)) == false)
	exit();
curl_close($ch);

$dom = new DOMDocument();
@$dom->loadHTML($data);
$url = parse_url($argv[1]);
@mkdir($url['host']);
$images = $dom->getElementsByTagName('img');
foreach ($images as $image) {
	$ref = $image->getAttribute('src');
	if (filter_var($ref, FILTER_VALIDATE_URL) == FALSE) {
		@copy($argv[1].$ref, $url['host'] . "/" . basename($ref));
	}
	else {
		@copy($ref, $url['host'] . "/" . basename($ref));
	}
}
?>