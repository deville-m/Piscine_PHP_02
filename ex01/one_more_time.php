#! /usr/bin/php
<?php

define("LUNDI", "/[lL]undi/");
define("MARDI", "/[mM]ardi/");
define("MERCREDI", "/[mM]ercredi/");
define("JEUDI", "/[jJ]eudi/");
define("VENDREDI", "/[vV]endredi/");
define("SAMEDI", "/[sS]amedi/");
define("LUNDI", "/[dD]imanche/");
define("JOUR", "([lL]undi|[mM]ardi|[mM]ercredi|[jJ]eudi|[vV]endredi|[sS]amedi|[dD]imanche)");

define("JANVIER", "/[jJ]anvier/");
define("FEVRIER", "/[fF](?:évrier|evrier)/");
define("MARS", "/[mM]ars/");
define("AVRIL", "/[aA]vril/");
define("MAI", "/[mM]ai/");
define("JUIN", "/[jJ]uin/");
define("JUILLET", "/[jJ]uillet/");
define("AOUT", "/[aA](?:oût|out)/");
define("SEPTEMBRE", "/[sS]eptembre/");
define("OCTOBRE", "/[oO]ctobre/");
define("NOVEMBRE", "/[nN]ovembre/");
define("DECEMBRE", "/[dD](?:écembre|ecembre)/");
define("MOIS", "([jJ]anvier|[fF](?:évrier|evrier)|[mM]ars|[aA]vril|[mM]ai|[jJ]uin|[jJ]uillet|[aA](?:oût|out)|[sS]eptembre|[nN]ovembre|[dD](?:écembre|ecembre))");

define("DATE_REGEX", "/" . JOUR . " (\d{1,2}) " . MOIS . " (\d{4}) (\d{2}):(\d{2}):(\d{2})/");

if ($argc != 2)
	exit("Wrong Format\n");
if (!preg_match(DATE_REGEX, $argv[1], $res))
	exit("Wrong Format\n");
$res = array_slice($res, 1);
$day_pattern = array("");
print_r($res);
?>