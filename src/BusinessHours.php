<?php
/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace EncoreDigitalGroup\BusinessHours;

use Carbon\Carbon;
use Cmixin\BusinessDay;
use EncoreDigitalGroup\BusinessHours\Support\Config\BusinessHoursConfig;
use Illuminate\Support\Carbon as IlluminateCarbon;

class BusinessHours
{
    private static self $instance;

    protected BusinessHoursConfig $config;

    public static function make(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __construct()
    {
        $this->config = new BusinessHoursConfig;
    }

    public static function config(): BusinessHoursConfig
    {
        return self::make()->config;
    }
}