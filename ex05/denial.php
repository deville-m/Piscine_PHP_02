#!/usr/bin/php
<?php

if ($argc != 3)
	exit();

if (($fd = fopen($argv[1], 'r')) === FALSE || ($keys = fgetcsv($fd, 0, ";")) === FALSE || !in_array($argv[2], $keys))
	exit();
foreach ($keys as $value) {
	${$value} = array();
}
while (($line = fgetcsv($fd, 0, ";")) !== FALSE) {
	if (count($keys) > count($line))
		exit();
	for($i = 0; $i < count($keys); $i++) {
		$index = array_search($argv[2], $keys);
		${$keys[$i]}[$line[$index]] = $line[$i];
	}
}
fclose($fd);
if (fopen("php://stdin", "r") === FALSE)
	exit();
while (true)
{
	echo "Enter your command: ";
	$out = fgets(STDIN);
	if (feof(STDIN))
		exit(0);
	eval($out);
}
?>