<?php
/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Rights Reserved.
 */

use EncoreDigitalGroup\BusinessHours\Support\Config\BusinessHoursConfig;
use EncoreDigitalGroup\BusinessHours\Support\Config\DayConfig;
use EncoreDigitalGroup\BusinessHours\Support\Config\ExceptionConfig;
use EncoreDigitalGroup\StdLib\Objects\Calendar\DayOfWeek;
use Illuminate\Support\Carbon;

describe("BusinessHoursConfig", function () {
    it("builds arrays with correct shape for daily hours", function () {
        $config = new BusinessHoursConfig();
        $config->day(DayOfWeek::Monday)->addHours("09:00", "17:00");
        $config->day(DayOfWeek::Tuesday)->addHours("10:00", "16:00");
        $config->commit();

        $reflection = new ReflectionClass($config);
        $property = $reflection->getProperty("hoursArray");
        $property->setAccessible(true);
        $hours = $property->getValue($config);

        expect($hours)->toHaveKey("monday")
            ->and($hours["monday"])->toBeArray()
            ->and($hours["monday"][0])->toBe("09:00-17:00")
            ->and($hours)->toHaveKey("tuesday")
            ->and($hours["tuesday"][0])->toBe("10:00-16:00");
    });

    it("builds arrays with correct shape for exceptions", function () {
        $config = new BusinessHoursConfig();
        $date = Carbon::create(2025, 8, 13);
        $config->exceptions()->add($date, "12:00", "15:00");
        $config->commit();

        $reflection = new ReflectionClass($config);
        $property = $reflection->getProperty("hoursArray");
        $property->setAccessible(true);
        $hours = $property->getValue($config);

        //        dd($hours["exceptions"]);

        expect($hours)->toHaveKey("exceptions")
            ->and($hours["exceptions"])->toBeArray()
            ->and(array_keys($hours["exceptions"]))->toContain("2025-08-13")
            ->and($hours["exceptions"]["2025-08-13"]["hours"][0])->toBe("12:00-15:00");
    });

    it("recursively transforms nested collections to arrays", function () {
        $config = new BusinessHoursConfig();
        $config->day(DayOfWeek::Wednesday)->addHours("08:00", "12:00");
        $config->day(DayOfWeek::Wednesday)->addHours("13:00", "17:00");
        $config->commit();

        $reflection = new ReflectionClass($config);
        $property = $reflection->getProperty("hoursArray");
        $property->setAccessible(true);
        $hours = $property->getValue($config);

        expect($hours["wednesday"])->toBeArray()
            ->and($hours["wednesday"][0])->toBe("08:00-12:00")
            ->and($hours["wednesday"][1])->toBe("13:00-17:00");
    });
});

