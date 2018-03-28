#!/usr/bin/php
<?php
    date_default_timezone_set('Europe/Paris');
    $file = fopen("/var/run/utmpx", "r");
    while ($utmpx = fread($file, 628)){
        $unpack = unpack("a256a/a4b/a32c/id/ie/I2f", $utmpx);
        $array[$unpack['c']] = $unpack;
    }
    ksort($array);
   	$array = array_slice($array, 1);
    foreach ($array as $entry){
    	if ($entry['e'] == 7)
    		printf("%-8s %-8s  %s \n",
    				substr(trim($entry['a'])), 0, 8),
    				substr(trim($entry['c'])), 0, 8),
    				date("M j H:i", $entry['f1']));
    }
?>