<?php

namespace App\Helpers;

use DateTime;

class DateGenerator
{

    public function getHoursDiff(DateTime $departureDate, DateTime $currentDate): int
    {
        return (int)$currentDate->diff($departureDate)->format('%H');
    }

    /**
     * @param $departure_date
     * @return string
     */
    public function getDateTimeFormat($departure_date): string
    {
        $dateTimeFormat = DateTime::createFromFormat('d/m/Y H:i', $departure_date);
        if (!$dateTimeFormat) {
            throw new \DomainException('O formato de data inserido é inválido');
        }
        return $dateTimeFormat->format('Y-m-d H:i:s');
    }

    /**
     * @param $departure_date
     * @return string
     */
    public function getDateFormat($departure_date): string
    {
        $dateTimeFormat = DateTime::createFromFormat('d/m/Y', $departure_date);
        if (!$dateTimeFormat) {
            throw new \DomainException('O formato de data inserido é inválido');
        }
        return $dateTimeFormat->format('Y-m-d');
    }
}
