<?php
/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace EncoreDigitalGroup\BusinessHours\Support\Config;

use Illuminate\Support\Collection;

class DayConfig
{
    private Collection $hours;

    public function __construct(){
        $this->hours = new Collection;
    }

    public function addHours(string $open, string $close): self
    {
        $this->hours->add($open . "-" . $close);

        return $this;
    }

    public function getHours(): Collection
    {
        return $this->hours;
    }
}