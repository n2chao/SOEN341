<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Traits\stringToDatesTraits;


class stringToDatesTest extends TestCase
{
    
    use stringToDatesTraits;
    //Testing two random times
    public function testStringToDates()
    {
       
       $dates = array();
       $freeTime = array();

       for($i = 0; $i<168; $i++) {
            $dates[$i] = 0;
       }

       //Picking times to make available (Sunday Midnight being hour 0):
       //Monday 5 pm: hour 41
       //Friday 2 am: hour 122

       $dates[41] = 1;
       $dates[122] = 1;

       $freeTime = $this->stringToDates($dates);
       

       $this->assertEquals($freeTime[41], "Monday 05 PM");
       $this->assertEquals($freeTime[122], "Friday 02 AM");
    }


    //Testing Edge partition (0 and 168)
    public function testEdgePartitionDates()
    {
       
       $dates = array();
       $freeTime = array();

       for($i = 0; $i<168; $i++) {
            $dates[$i] = 0;
       }

       //Picking times to make available (Sunday Midnight being hour 0):
       //Satruday 11 pm: hour 0
       //Sunday 12 am: hour 168

       $dates[0] = 1;
       $dates[167] = 1;

       $freeTime = $this->stringToDates($dates);
       

       $this->assertEquals($freeTime[0], "Sunday 12 AM");
       $this->assertEquals($freeTime[167], "Saturday 11 PM");
    }
}
