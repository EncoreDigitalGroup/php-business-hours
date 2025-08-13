# Business Hours

Business Hours is a PHP library that provides a type-safe wrapper around [spatie/opening-hours](https://github.com/spatie/opening-hours)
and [cmixin/business-day](https://github.com/kylekatarnls/business-day).
It allows you to manage business hours, holidays, and exceptions in a robust, object-oriented way.

## Features

- Type-safe configuration of business hours for each day of the week
- Support for holidays and exceptions
- Integration with Spatie OpeningHours and BusinessDay for advanced time calculations
- PSR-12 and Laravel-style code conventions

## Requirements

- PHP 8.3 or higher

## Installation

Install via Composer:

```bash
composer require encoredigitalgroup/business-hours
```

## Usage

### Basic Setup

```php
use EncoreDigitalGroup\BusinessHours\BusinessHours;

$config = BusinessHours::config();
```

### Configuring Business Hours

Below is an example of how to set business hours and how to set exceptions to those business hours.
When setting an exception, the library will automatically register the date as a holiday.

```php
use EncoreDigitalGroup\StdLib\Objects\Calendar\DayOfWeek;
use Carbon\Carbon; #You can also use Illuminate\Support\Carbon

// Set Monday hours
$config->day(DayOfWeek::Monday)->addHours("09:00", "17:00");

// Set exceptions
$config->exceptions()->adjustedHours(Carbon::parse("2025-07-04"), "08:00", "14:00:", "4th of July");
$config->exceptions()->closed(Carbon::parse("2025-12-25"), "Christmas Day");
```

### Adding Holidays

Below is an example of how to create and configure a holiday.
When creating the holiday, the library will automatically register the date as a closed exception.

```php
use Carbon\Carbon;

$config->holidays()->region("global")->add(Carbon::parse("2025-12-25"), "christmas", "Christmas Day", true);
```

### Checking If a Date Is a Holiday

```php
use Carbon\Carbon;

Carbon::parse("2025-12-25")->isHoliday(); // true
```

## Testing

This project uses [PestPHP](https://pestphp.com/) for testing. To run the test suite:

```bash
vendor/bin/pest
```

## Contributing

Contributions are welcome! Please submit pull requests and ensure all tests pass.

## License

License information can be found in the [LICENSE.md](LICENSE.md) file.

