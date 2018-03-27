#! /usr/bin/php
<?php

if ($argc < 2)
	exit(0);
$split = preg_split("/[ \t]/", $argv[1], -1, PREG_SPLIT_NO_EMPTY);
$merged = implode(' ', $split);
if ($merged != "")
	printf("%s\n", $merged);

?>