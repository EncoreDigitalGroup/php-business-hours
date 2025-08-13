<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Rights Reserved.
 */

use Carbon\Carbon;
use EncoreDigitalGroup\BusinessHours\Support\Config\HolidayConfig;

describe("HolidayConfig", function () {
    test("can set region", function () {
        $config = new HolidayConfig;

        $config->region("us-national");

        $reflection = new ReflectionClass($config);
        $prop = $reflection->getProperty("region");
        $prop->setAccessible(true);

        expect($prop->getValue($config))->toBe("us-national");
    });

    test("supports method chaining", function () {
        $config = new HolidayConfig;

        $result = $config->region("us-national")->add(Carbon::parse("2025-01-01"), "new_year");

        expect($result)->toBeInstanceOf(HolidayConfig::class);
    });

    test("custom date is holiday", function () {
        $config = new HolidayConfig;
        $holiday = Carbon::parse("2025-1-14");

        $config->region("us-national")->add($holiday, "custom_holiday");

        expect($holiday->isHoliday())->toBeTrue();
    });
});
