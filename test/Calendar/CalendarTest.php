<?php

namespace Phil\Calendar;

/**
 * Test cases for class Calendar.
 */
class CalendarTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test case to construct object and verify that the object
     * has the expected properties due various ways of constructing
     * it.
     */
    public function testCreateObject()
    {
        $calendar = new Calendar();
        $this->assertInstanceOf("\Phil\Calendar\Calendar", $calendar);
        $this->assertEquals(5, $calendar->month);

        $calendar = new Calendar(6);
        $this->assertInstanceOf("\Phil\Calendar\Calendar", $calendar);
        $this->assertEquals(6, $calendar->month);
        $this->assertEquals(2017, $calendar->year);


        $calendar = new Calendar(7, 2018);
        $this->assertInstanceOf("\Phil\Calendar\Calendar", $calendar);
        $this->assertEquals(7, $calendar->month);
        $this->assertEquals(2018, $calendar->year);
    }


    /**
     * Test case to initiate through re-randomze an object.
     */

    public function testDaysInMonth()
    {
        $calendar = new Calendar();
        $this->assertEquals(31, $calendar->daysInMonth());
    }

    public function testGetDay()
    {
        $calendar = new Calendar();
        $this->assertEquals("Monday", $calendar->getWeekDay(1));
    }
    public function testGetMonth()
    {
        $calendar = new Calendar();
        $this->assertEquals("May", $calendar->getMonthName());
    }

    public function testPreviousDays()
    {
        $calendar = new Calendar();
        $this->assertContainsOnly("string", $calendar->getPreviousDays("Monday"));
        $this->assertContainsOnly("string", $calendar->getPreviousDays("Tuesday"));
        $this->assertContainsOnly("string", $calendar->getPreviousDays("Wednesday"));
        $this->assertContainsOnly("string", $calendar->getPreviousDays("Thursday"));
        $this->assertContainsOnly("string", $calendar->getPreviousDays("Friday"));
        $this->assertContainsOnly("string", $calendar->getPreviousDays("Saturday"));
        $this->assertContainsOnly("string", $calendar->getPreviousDays("Sunday"));
    }

    public function testNextDays()
    {
        $calendar = new Calendar();
        $this->assertContainsOnly("string", $calendar->getNextDays("Monday"));
        $this->assertContainsOnly("string", $calendar->getNextDays("Tuesday"));
        $this->assertContainsOnly("string", $calendar->getNextDays("Wednesday"));
        $this->assertContainsOnly("string", $calendar->getNextDays("Thursday"));
        $this->assertContainsOnly("string", $calendar->getNextDays("Friday"));
        $this->assertContainsOnly("string", $calendar->getNextDays("Saturday"));
        $this->assertContainsOnly("string", $calendar->getNextDays("Sunday"));
    }

    public function testShowCalendar()
    {
        $calendar = new Calendar();
        $this->assertInternalType("string", $calendar->showCalendar());
    }
}
