<?php

/**
 * Class RelativeDate
 */
class RelativeDate
{
    /**
     * @var RelativeDate
     */
    private static $instance;

    /**
     * @var int
     */
	private $minute;

    /**
     * @var int
     */
	private $hour;

    /**
     * @var int
     */
	private $day;

    /**
     * @var int
     */
	private $week;

    /**
     * @var float|int
     */
    private $month;

    /**
     * @var int
     */
	private $year;

    /**
     * @var array
     */
	private $en_US;

    /**
     * RelativeDate constructor.
     */
	private function __construct()
    {
        $this->minute = 60;
		$this->hour   = 60 * $this->minute;
		$this->day    = 24 * $this->hour;
		$this->week   = 7 * $this->day;
		$this->year   = 365 * $this->day;
		$this->month  = $this->year / 12;

		$this->formats = array(
			0,
			$this->minute * 0.7,
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
		$this->en_US = parse_ini_file('en_US.ini');
    }

    /**
     * Get instance of RelativeDate class,
     * return result of function date.
     *
     * @param int $date
     * @param array $lang
     * @return mixed|string
     */
    public static function get($date, $lang = [])
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance->date($date, self::$instance->getLang($lang));
    }

    /**
     * @param $lang
     * @return array
     */
    private function getLang($lang){
        if (!is_array($lang)) {
            $lang = parse_ini_file($lang . '.ini');
        }
        if (count($lang) != count($this->en_US)) {
            $lang = $this->en_US;
        }

        return $lang;
    }

    /**
     * @param int $date
     * @param array $lang
     * @return string
     */
	private function date($date, $lang)
	{
		$outKey = 0;
	    $timeDifference = time() - (int)$date;

		foreach ($this->formats as $key => $val) {
			if ($timeDifference < (int)$val) {
			    break;
            } else {
			    $outKey = $key;
            }
		}

		switch ($outKey) {
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
            default:
                $output = $lang[$outKey];
		}

		return $output;
	}
}
?>
