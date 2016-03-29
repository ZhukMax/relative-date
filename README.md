# relative-date
Relative date php

## Usage

```php
<?php
include "relative-date.php";

class Test {
	use RelativeDateTrait;
	
	public function a()
	{
		$b = rand(-20, -1);
		return $this->relativeDate(strtotime($b." week"));
	}
}
$ru_Ru = array(
	'только что',
	'минуту назад',
	'минут назад',
	'час назад',
	'часов назад',
	'вчера',
	'дней назад',
	'неделю назад',
	'недель назад',
	'месяц назад',
	'месяц(a/ев) назад',
	'год назад',
	'более года тому назад',
	'лет тому назад'
);
$test = new Test;
echo $str = $test->relativeDate(mktime(0, 0, 0, 2, 1, 2015), $ru_Ru);
// => год назад

echo $str2 = $test->relativeDate(mktime(0, 0, 0, 2, 1, 2016));
// => 2 months ago

echo $str3 = $test->a();
```
