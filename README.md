# Relative date
Relative date php-helper.

## Install

```console
composer require zhukmax/relative-date
```

## Usage

```php
<?php

echo $relativeDate = RelativeDate::get(mktime(0, 0, 0, 2, 1, 2015), 'ru_Ru');

echo $relativeDate2 = RelativeDate::get(mktime(0, 0, 0, 2, 1, 2015));
```

You can use your language array.

## Licence

The Apache License Version 2.0. Please see [License File](license) for more information.

