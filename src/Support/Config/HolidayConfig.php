<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace EncoreDigitalGroup\BusinessHours\Support\Config;

use Carbon\Carbon;
use Cmixin\BusinessDay;
use EncoreDigitalGroup\BusinessHours\BusinessHours;
use Illuminate\Support\Carbon as IlluminateCarbon;

class HolidayConfig
{
    private string $region = "global";

    public function __construct()
    {
        BusinessDay::enable([IlluminateCarbon::class, Carbon::class]);
    }

    public function region(string $region): self
    {
        $this->region = $region;

        /** @phpstan-ignore-next-line */
        Carbon::setHolidaysRegion($this->region);

        return $this;
    }

    public function add(Carbon $date, string $key, ?string $name = null, ?bool $observed = null): self
    {
        /** @phpstan-ignore-next-line */
        Carbon::addHoliday($this->region, $date->format("Y-m-d"), $key, $name, $observed);

        BusinessHours::config()
            ->exceptions()
            ->closed($date, $name);

        return $this;
    }
}