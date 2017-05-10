<?php

namespace Phil\Calendar;

/**
 * Guess Class
 */
class Calendar implements \Anax\Common\ConfigureInterface
{
    use \Anax\Common\ConfigureTrait;
    public $month;
    public $year;

    private $weekdays = array("Monday",
                              "Tuesday",
                              "Wednesday",
                              "Thirsday",
                              "Friday",
                              "Saturday",
                              "Sunday");


    /**
    * Constructor
    * @param string $name (optional) The name of the session
    * @return void
    */
    public function __construct($month = 5, $year = 2017)
    {
        $this->month = $month;
        $this->year = $year;
    }


    public function daysInMonth()
    {
        return cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
    }

    public function getWeekDay($day)
    {
        return strftime("%A", strtotime("$this->year-$this->month-$day"));
    }

    public function getMonthName()
    {
        return date('F', strtotime("$this->year-$this->month-01"));
    }

    public function getPreviousDays($firstday)
    {
        $daysToReturn = 0;
        $days = array();
        switch ($firstday) {
            case 'Tuesday':
                $daysToReturn = 1;
                break;
            case 'Wednesday':
                $daysToReturn = 2;
                break;
            case 'Thursday':
                $daysToReturn = 3;
                break;
            case 'Friday':
                $daysToReturn = 4;
                break;
            case 'Saturday':
                $daysToReturn = 5;
                break;
            case 'Sunday':
                $daysToReturn = 6;
                break;
            default:
                $daysToReturn = 0;
                break;
        }
        if ($daysToReturn != 0) {
            $daysInPreviousMonth = $this->daysInMonth($this->month - 1, $this->year);
            for ($i=0; $i < $daysToReturn; $i++) {
                $days[] =  "<div class='day otherday'><p>$daysInPreviousMonth</p></div>";
                $daysInPreviousMonth--;
            }
        }
        return array_reverse($days);
    }

    public function getNextDays($lastday)
    {
        $daysToReturn = 0;
        $days = array();
        switch ($lastday) {
            case 'Monday':
                $daysToReturn = 6;
                break;
            case 'Tuesday':
                $daysToReturn = 5;
                break;
            case 'Wednesday':
                $daysToReturn = 4;
                break;
            case 'Thursday':
                $daysToReturn = 3;
                break;
            case 'Friday':
                $daysToReturn = 2;
                break;
            case 'Saturday':
                $daysToReturn = 1;
                break;
            default:
                $daysToReturn = 0;
                break;
        }
        if ($daysToReturn != 0) {
            for ($i=1; $i <= $daysToReturn; $i++) {
                $days[] =  "<div class='day otherday'><p>$i</p></div>";
            }
        }
        return $days;
    }

    public function showCalendar()
    {
        $days = $this->daysInMonth();
        $previousDays = $this->getPreviousDays($this->getWeekDay(1));
        $nextDays = $this->getNextDays($this->getWeekDay($days));

        $thisDays = array();
        for ($i=1; $i <= $days; $i++) {
            $day = $this->getWeekDay($i);
            if ($day == "Sunday") {
                $thisDays[] = "<div class='day redday'><p>$i</p></div>";
            } else {
                  $thisDays[] = "<div class='day'><p>$i</p></div>";
            }
        }
        $nameOfDays = array();
        foreach ($this->weekdays as $key => $value) {
            $nameOfDays[] = "<div class='day nameOfDay'><p>$value</p></div>";
        }
          $showDays = array_merge($nameOfDays, $previousDays, $thisDays, $nextDays);

          $html = "";

        foreach ($showDays as $key => $value) {
              $html.= $value;
        }

        return $html;
    }
}
