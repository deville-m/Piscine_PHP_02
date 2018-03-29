#!/usr/bin/php
<?php
    if ($argc != 2)
        return ;
    if (($file = file_get_contents($argv[1])) == false)
        exit ;
    $result = preg_replace_callback("|(<a )(.*?)(>)(.*?)(</a>)|si",
        function ($match)
        {
            $match[0] = preg_replace_callback('|(title=")(.*?)(")|si',
                function ($match_sub)
                {
                    return ($match_sub[1].strtoupper($match_sub[2]).$match_sub[3]);
                }, $match[0]);
            $match[0] = preg_replace_callback('|(alt=")(.*?)(")|si',
                function ($match_sub)
                {
                    return ($match_sub[1].strtoupper($match_sub[2]).$match_sub[3]);
                }, $match[0]);
            $match[0] = preg_replace_callback('|(>)(.*?)(<)|si',
                function ($match_sub)
                {
                    return $match_sub[1].strtoupper($match_sub[2]).$match_sub[3];
                }, $match[0]);
            return ($match[0]);
        }, $file);
    echo ($result);

?>
