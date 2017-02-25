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
     * @param $date
     * @param array $lang
     * @return mixed|string
     */
    public static function get($date, $lang = [])
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        $date = self::$instance->getDate($date);

        if ($date) {
            $lang = self::$instance->getLang($lang);
            return self::$instance->date($date, $lang);
        } else {
            return false;
        }
    }

    /**
     * @param $date
     * @return bool|int
     */
    private function getDate($date)
    {
        if (is_string($date)) {
            if (($timestamp = strtotime($date)) !== false) {
                $timeDifference = time() - $timestamp;
            } else {
                return false;
            }
        } else {
            $timeDifference = time() - (int)$date;
        }

        return $timeDifference;
    }

    /**
     * @param $lang
     * @return array
     */
    private function getLang($lang){
        if (!is_array($lang) && is_file($lang . '.ini')) {
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
		foreach ($this->formats as $key => $val) {
			if ($date < (int)$val) {
			    break;
            } else {
			    $outKey = $key;
            }
		}
		$phrase = $lang[$outKey];

		switch ($outKey) {
			case 2:
				$output = round($date / $this->minute) ." ". $phrase;
				break;
			case 4:
				$output = round($date / $this->hour) ." ". $phrase;
				break;
			case 6:
				$output = round($date / $this->day) ." ". $phrase;
				break;
			case 8:
				$output = round($date / $this->week) ." ". $phrase;
				break;
			case 10:
				$output = round($date / $this->month) ." ". $phrase;
				break;
			case 13:
				$output = round($date / $this->year) ." ". $phrase;
				break;
            default:
                $output = $phrase;
		}

		return $output;
	}
}
