# Relative date
Relative date php-helper.

## Install

```console
composer require zhukmax/relative-date
```

## Usage

```php
<?php

// Russian date
$relativeDate = RelativeDate::get(mktime(0, 0, 0, 2, 1, 2015), 'ru');

// English is default
$relativeDate = RelativeDate::get(mktime(0, 0, 0, 2, 1, 2015));

// Use string date
$relativeDate = RelativeDate::get('10 September 2000');
```

## Languages
This package has some languages:
* English (default)
* Russian
* French

You can use your language array.

## Licence

The Apache License Version 2.0. Please see [License File](license) for more information.

