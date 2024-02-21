<?php

declare(strict_types = 1);

namespace App\Services;

use \DateTime;

class TimeService
{
    public function __construct(private DateTime $dateTime)
    {
        $this->dateTime = $dateTime;

    }

    public function getCurrentDate(): string
    {

        return $this->dateTime->format('d-m-Y');
    }
}