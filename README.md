# Relative date
Relative date php-helper.

## Install

```console
composer require zhukmax/relative-date
```

## Usage

```php
<?php

$ru_Ru = array(
	'',
	'',
	'',
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
echo $relativeDate = RelativeDate::get(mktime(0, 0, 0, 2, 1, 2015), $ru_Ru);

echo $relativeDate2 = RelativeDate::get(mktime(0, 0, 0, 2, 1, 2015));
```
