#!/usr/bin/php
<?PHP
	if ($argc != 2)
		return ;
	function valid_day($day)
	{
		if (preg_match("/[Ll]undi/", $day))
			return 1;
		else if (preg_match("/[Mm]ardi/", $day))
			return 2;
		else if (preg_match("/[Mm]ercredi/", $day))
			return 3;
		else if (preg_match("/[Jj]eudi/", $day))
			return 4;
		else if (preg_match("/[Vv]endredi/", $day))
			return 5;
		else if (preg_match("/[Ss]amedi/", $day))
			return 6;
		else if (preg_match("/[Dd]imanche/", $day))
			return 0;
		else
			return false;
	}
	function valid_day_num($day_num)
	{
		if (!is_numeric($day_num))
			return false;
		$len = strlen($day_num);
		if ($len < 1 || 2 < $len)
			return false;
		return true;
	}
	function valid_month($month)
	{
		if (preg_match("/[Jj]anvier/", $month))
			return 1;
		else if (preg_match("/[Ff]évrier/", $month))
			return 2;
		else if (preg_match("/[Mm]ars/", $month))
			return 3;
		else if (preg_match("/[Aa]vril/", $month))
			return 4;
		else if (preg_match("/[Mm]ai/", $month))
			return 5;
		else if (preg_match("/[Jj]uin/", $month))
			return 6;
		else if (preg_match("/[Jj]uillet/", $month))
			return 7;
		else if (preg_match("/[Aa]oût/", $month))
			return 8;
		else if (preg_match("/[Ss]eptembre/", $month))
			return 9;
		else if (preg_match("/[Oo]ctobre/", $month))
			return 10;
		else if (preg_match("/[Nn]ovembre/", $month))
			return 11;
		else if (preg_match("/[Dd]écembre/", $month))
			return 12;
		else
			return false;
	}
	function valid_year($year)
	{
		if (!is_numeric($year) || strlen($year) != 4)
			return false;
		return true;
	}
	function valid_hour($hour)
	{
		if (!preg_match("/[0-9]{2}:[0-9]{2}:[0-9]{2}/", $hour))
			return false;
		$tmp = preg_split("/:/", $hour);
		if (count($tmp) != 3)
			return false;
		foreach ($tmp as $num)
		{
			if (!is_numeric($num) || strlen($num) != 2)
				return false;
			if ($num < 0 || 59 < $num)
				return false;
		}
		if (23 < $tmp[0])
			return false;
		return true;
	}
	function valid_date($date)
	{
		if (count($date) != 5)
			return false;
		if (!valid_day_num($date[1]))
			return false;
		if (($num_month = valid_month($date[2])) === false)
			return false;
		if (!valid_year($date[3]))
			return false;
		if (!checkdate($num_month, $date[1], $date[3]))
			return false;
		if (!valid_hour($date[4]))
			return false;
		if (($day_num = valid_day($date[0])) === false || $day_num != intval(date('w', strtotime("$num_month/$date[1]/$date[3] $date[4]"))))
			return false;
		return strtotime("$num_month/$date[1]/$date[3] $date[4]");
	}
	$data = preg_split("/( )/", $argv[1], -1, PREG_SPLIT_DELIM_CAPTURE);

	if (count($data) != 9)
		exit("Wrong Format\n");
	$tmp = $data;
	$data = array();
	foreach ($tmp as $value) {
		if ($value !== " ")
			array_push($data, $value);
	}

	date_default_timezone_set('Europe/Paris');
	if (($timestamp = valid_date($data)) !== false)
		echo $timestamp."\n";
	else
		exit("Wrong Format\n");
