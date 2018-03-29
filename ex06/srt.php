#!/usr/bin/php
<?php

define("TIME", "\d{2}:\d{2}:\d{2},\d{3}");

function srttime($s1, $s2)
{
	preg_match("/" . TIME . "/", $s1, $s1_ex);
	preg_match("/" . TIME . "/", $s2, $s2_ex);

	return (strcmp($s1_ex[0], $s2_ex[0]));
}

if ($argc != 2 || ($fd = fopen($argv[1], "r")) === FALSE)
	exit();

$file = "";
while (($line = fgets($fd)) !== FALSE) {
	$file .= $line;
}

if (!preg_match_all("#\d\n" . TIME . " --> " . TIME . "\n[a-zA-Z].*\n\n?#", $file, $matches))
	exit();
$matches = $matches[0];
usort($matches, 'srttime');
$i = 1;
foreach ($matches as $match) {
	$match = preg_split("/\n/", $match, -1, PREG_SPLIT_NO_EMPTY);
	if ($i != count($matches))
		echo $i . "\n" . $match[1] . "\n" . $match[2] . "\n\n";
	else
		echo $i . "\n" . $match[1] . "\n" . $match[2] . "\n";
	$i++;
}

?>