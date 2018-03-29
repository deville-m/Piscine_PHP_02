#!/usr/bin/php
<?php

define("TIME", "\d{2}:\d{2}:\d{2},\d{3}");

function srttime($s1, $s2)
{
	preg_match("/" . TIME . "/", $s1, $s1_ex);
	preg_match("/" . TIME . "/", $s2, $s2_ex);

	return (strcmp($s1_ex[0], $s2_ex[0]));
}

if ($argc != 2 || ($fd = fopen($argv[1], "rb")) === FALSE)
	exit();

$file = "";
while (($line = fgets($fd)) !== FALSE) {
	$file .= $line;
}

//if (!preg_match_all("#\d+\n" . TIME . " --> " . TIME . "\n(?:(?:.*?)\n){0,2}(?![^\n])\n?#", $file, $matches))
if (!preg_match_all("#\d+(?:\r\n|\n)" . TIME . " --> " . TIME . "(?:\r\n|\n)(?:(?:.*?)(?:\r\n|\n)){0,2}(?![^(?:\r\n|\n)])(?:\r\n|\n)?#", $file, $matches))
	exit("Wrong Format\n");
$matches = $matches[0];
usort($matches, 'srttime');
$i = 1;
foreach ($matches as $match)
{
	$match = preg_split("|[\r\n]|", $match, -1, PREG_SPLIT_NO_EMPTY);
	$len = count($match);
	if ($i != count($matches))
	{
		echo $i . "\n";
		for ($j = 1; $j < $len; $j++)
			echo $match[$j] . "\n";
		echo "\n";
	}
	else
	{
		echo $i . "\n";
		for ($j = 1; $j < $len; $j++)
			echo $match[$j] . "\n";
	}
	$i++;
}

?>