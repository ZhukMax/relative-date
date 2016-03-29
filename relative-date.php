<?php
trait RelativeDateTrait
{
	public function __construct()
  {
    $this->minute = 60;
		$this->hour = 60 * $this->minute;
		$this->day = 24 * $this->hour;
		$this->week = 7 * $this->day;
		$this->year = 365 * $this->day;
		$this->month = $this->year / 12;

		$this->formats = array(
			0, $this->minute * 0.7,
			$this->minute * 1.5,
			$this->minute * 59.4,
			$this->hour * 1.5,
			$this->hour * 23,
			$this->day * 2,
			$this->day * 7,
			$this->week * 1.5,
			$this->week * 4,
			$this->month * 1.5,
			$this->month * 11.5,
			$this->year * 1.2,
			$this->year * 2
		);
		$this->en_US = array(
			'just now',
			'a minute ago',
			'minutes ago',
			'an hour ago',
			'hours ago',
			'yesterday',
			'days ago',
			'a week ago',
			'weeks ago',
			'a month ago',
			'months ago',
			'a year ago',
			'over a year ago',
			'years ago'
		);
  }

	public function relativeDate($date, $lang)
	{
		if (!$lang || !is_array($lang)) $lang = $this->en_US;
		if (!$date) return $lang[0];
		$timeDifference = time() - (int)$date;
		$output = $lang[0];

		foreach ($this->formats as $key => $val)
		{
			if ($timeDifference < (int)$val) break;
			else $outKey = $key;
		}

		switch ($outKey)
		{
			case 2:
				$output = round($timeDifference / $this->minute) ." ". $lang[$outKey];
				break;
			case 4:
				$output = round($timeDifference / $this->hour) ." ". $lang[$outKey];
				break;
			case 6:
				$output = round($timeDifference / $this->day) ." ". $lang[$outKey];
				break;
			case 8:
				$output = round($timeDifference / $this->week) ." ". $lang[$outKey];
				break;
			case 10:
				$output = round($timeDifference / $this->month) ." ". $lang[$outKey];
				break;
			case 13:
				$output = round($timeDifference / $this->year) ." ". $lang[$outKey];
				break;
		}

		return $output;
	}
}
?>
