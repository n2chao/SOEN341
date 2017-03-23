<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Traits\weekTraits;


class weekTest extends TestCase
{
    
	use weekTraits;
    public function testToday()
    {
    	date_default_timezone_set("America/New_York");

    	$date = strtotime("tomorrow");
    	
    	$this->call('GET', '/choosetime', ['prevWeek'=> null, 'nextWeek' => null]);
    	$week = $this->week();

    	$this->assertEquals($date, $week[0]); 
    }

    public function testNextWeekStart()
    {
    	date_default_timezone_set("America/New_York");

    	$date = strtotime("next Sunday");
    	$oldWeekStart = strtotime("tomorrow");
    	$oldWeekEnd = strtotime("next Saturday");

    	$this->call('GET', '/choosetime', ['prevWeek'=> null, 'nextWeek' => 'nextWeek', 'weekStart' => $oldWeekStart, 'weekEnd' => $oldWeekEnd]);
    	$week = $this->week();

    	$this->assertEquals($date, $week[0]);
    }

    public function testNextWeekEnd()
    {
    	date_default_timezone_set("America/New_York");

    	$date = strtotime("next Sunday +6 days");
    	$oldWeekStart = strtotime("today");
    	$oldWeekEnd = strtotime("next Saturday");

    	$this->call('GET', '/choosetime', ['prevWeek'=> null, 'nextWeek' => 'nextWeek', 'weekStart' => $oldWeekStart, 'weekEnd' => $oldWeekEnd]);
    	$week = $this->week();

    	$this->assertEquals($date, $week[1]);
    }

    public function testPrevWeekLimit()
    {
    	date_default_timezone_set("America/New_York");

    	$date = strtotime("tomorrow");
    	
    	$this->call('GET', '/choosetime', ['prevWeek'=> 'prevWeek', 'nextWeek' => null]);
    	$week = $this->week();

    	$this->assertGreaterThanOrEqual($week[0], $date);
    }

    public function testPrevWeekStart()
    {
    	date_default_timezone_set("America/New_York");

    	$date = strtotime("tomorrow");
    	$oldWeekStart = strtotime("tomorrow");
    	$oldWeekEnd = strtotime("Saturday");

    	$this->call('GET', '/choosetime', ['prevWeek'=> null, 'nextWeek' => 'nextWeek', 'weekStart' => $oldWeekStart, 'weekEnd' => $oldWeekEnd]);
    	$week = $this->week();
    	$this->call('GET',' /choosetime', ['prevWeek'=> 'prevWeek', 'nextWeek' => null, 'weekStart' => $week[0], 'weekEnd' => $week[1]]);
    	$prevWeek  = $this->week();

    	$this->assertEquals($date, $prevWeek[0]);
    }

    public function testPrevWeekEnd()
    {
    	date_default_timezone_set("America/New_York");

    	$date = strtotime("Saturday");
    	$oldWeekStart = strtotime("tomorrow");
    	$oldWeekEnd = strtotime("Saturday");

    	$this->call('GET', '/choosetime', ['prevWeek'=> null, 'nextWeek' => 'nextWeek', 'weekStart' => $oldWeekStart, 'weekEnd' => $oldWeekEnd]);
    	$week = $this->week();
    	$this->call('GET',' /choosetime', ['prevWeek'=> 'prevWeek', 'nextWeek' => null, 'weekStart' => $week[0], 'weekEnd' => $week[1]]);
    	$prevWeek  = $this->week();

    	$this->assertEquals($date, $prevWeek[1]);
    }
}
