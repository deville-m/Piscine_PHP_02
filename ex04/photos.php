#!/usr/bin/php
<?php

if ($argc != 2 || ($ch = curl_init()) === FALSE || filter_var($argv[1], FILTER_VALIDATE_URL) === FALSE)
	exit();

curl_setopt($ch, CURLOPT_URL, $argv[1]) or die();
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true) or die();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) or die();
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) or die();
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5) or die();
curl_setopt($ch, CURLOPT_FRESH_CONNECT, 5) or die();

if (($data = curl_exec($ch)) === FALSE)
	exit();
curl_close($ch);

$dom = new DOMDocument();
@$dom->loadHTML($data);
$url = parse_url($argv[1]);
@mkdir($url['host']);
$images = $dom->getElementsByTagName('img');
foreach ($images as $image) {
	$ref = $image->getAttribute('src');
	if (filter_var($ref, FILTER_VALIDATE_URL) === FALSE) {
		@copy($argv[1].$ref, $url['host'] . "/" . basename($ref));
	}
	else {
		@copy($ref, $url['host'] . "/" . basename($ref));
	}
}
?>