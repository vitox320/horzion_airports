<?php

namespace Tests\Unit;

use App\Helpers\DateGenerator;
use PHPUnit\Framework\TestCase;

class DateGeneratorTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testIfDifferenceBetweenTwoDatesIsEqualToFive(): void
    {
        $departureDate = \DateTime::createFromFormat('d/m/Y H:i', '25/11/2023 17:00');
        $currentDate = \DateTime::createFromFormat('d/m/Y H:i', '25/11/2023 12:00');
        $dateGenerator = new DateGenerator();
        $this->assertEquals(5, $dateGenerator->getHoursDiff($departureDate, $currentDate));
    }
}
