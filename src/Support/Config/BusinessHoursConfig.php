<?php
/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace EncoreDigitalGroup\BusinessHours\Support\Config;

use EncoreDigitalGroup\StdLib\Objects\Calendar\DayOfWeek;
use EncoreDigitalGroup\StdLib\Objects\Support\Types\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Spatie\OpeningHours\OpeningHours;

class BusinessHoursConfig
{
    private DayConfig $sunday;
    private DayConfig $monday;
    private DayConfig $tuesday;
    private DayConfig $wednesday;
    private DayConfig $thursday;
    private DayConfig $friday;
    private DayConfig $saturday;
    private ExceptionConfig $exceptions;
    private OpeningHours $hours;
    private array $hoursArray = [];
    private HolidayConfig $holidays;

    public function __construct()
    {
        $this->sunday = new DayConfig;
        $this->monday = new DayConfig;
        $this->tuesday = new DayConfig;
        $this->wednesday = new DayConfig;
        $this->thursday = new DayConfig;
        $this->friday = new DayConfig;
        $this->saturday = new DayConfig;
        $this->exceptions = new ExceptionConfig;
        $this->holidays = new HolidayConfig;
    }

    public function day(DayOfWeek $day): DayConfig
    {
        return match ($day) {
            DayOfWeek::Sunday => $this->sunday,
            DayOfWeek::Monday => $this->monday,
            DayOfWeek::Tuesday => $this->tuesday,
            DayOfWeek::Wednesday => $this->wednesday,
            DayOfWeek::Thursday => $this->thursday,
            DayOfWeek::Friday => $this->friday,
            DayOfWeek::Saturday => $this->saturday,
        };
    }

    public function exceptions(): ExceptionConfig
    {
        return $this->exceptions;
    }

    public function hours(): OpeningHours
    {
        if (!isset($this->hours)) {
            $this->hours = OpeningHours::create(Arr::empty());
        }

        return $this->hours;
    }

    public function hoursAsArray(): array
    {
        return $this->hoursArray;
    }

    public function holidays(): HolidayConfig
    {
        return $this->holidays;
    }

    public function commit(): void
    {
        $this->hoursArray = [
            DayOfWeek::Sunday->value => $this->sunday->getHours()->toArray(),
            DayOfWeek::Monday->value => $this->monday->getHours()->toArray(),
            DayOfWeek::Tuesday->value => $this->tuesday->getHours()->toArray(),
            DayOfWeek::Wednesday->value => $this->wednesday->getHours()->toArray(),
            DayOfWeek::Thursday->value => $this->thursday->getHours()->toArray(),
            DayOfWeek::Friday->value => $this->friday->getHours()->toArray(),
            DayOfWeek::Saturday->value => $this->saturday->getHours()->toArray(),
            "exceptions" => $this->exceptions->get()->toArray(),
        ];

        $this->hours = OpeningHours::create($this->hoursArray);
    }
}