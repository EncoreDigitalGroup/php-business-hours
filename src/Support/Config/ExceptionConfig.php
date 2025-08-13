<?php
/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace EncoreDigitalGroup\BusinessHours\Support\Config;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class ExceptionConfig
{
    private Collection $exceptions;

    public function __construct()
    {
        $this->exceptions = new Collection;
    }

    public function add(Carbon $date, string $open, string $close, ?string $reason = null): self
    {
        $dateString = $date->format('Y-m-d');
        $currentExceptions = $this->exceptions->get($dateString);

        if (is_null($currentExceptions)) {
            $currentExceptions = $this->createException($open, $close, $reason);
        } elseif (is_array($currentExceptions)) {
            $currentExceptions = $this->newException($currentExceptions, $open, $close);
        } else {
            $currentExceptions = [
                "hours" => [$open . "-" . $close],
            ];
        }

        $currentExceptions["data"] = $reason;

        $this->exceptions->put($dateString, $currentExceptions);

        return $this;
    }

    public function get(): Collection
    {
        return $this->exceptions;
    }

    private function createException(string $open, string $close, ?string $reason = null): array
    {
        return [
            "hours" => [$open . "-" . $close],
            "data" => $reason,
        ];
    }

    private function newException(array $exceptions, string $open, string $close): array
    {
        $exceptions["hours"][] = $open . "-" . $close;

        return $exceptions;
    }
}