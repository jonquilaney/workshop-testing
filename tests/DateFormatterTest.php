<?php declare(strict_types=1);

namespace IW\Tests\Workshop;

use DateTime;
use IW\Workshop\DateFormatter;
use PHPUnit\Framework\TestCase;


class DateFormatterTest extends TestCase
{

    /**
     * @dataProvider partOfDayDataProvider
     */
    public function testGetPartOfDay(string $time, string $expectedResult)
    {
        $dateFormatter = new DateFormatter();

        $result = $dateFormatter->getPartOfDay(new DateTime($time));

        $this->assertEquals($expectedResult, $result);
    }


    public function partOfDayDataProvider()
    {
        return [
            ['00:00:00', 'Night'],
            ['05:59:59', 'Night'],
            ['06:00:00', 'Morning'],
            ['11:59:59', 'Morning'],
            ['12:00:00', 'Afternoon'],
            ['17:59:59', 'Afternoon'],
            ['18:00:00', 'Evening'],
            ['23:59:59', 'Evening'],
        ];
    }

}
