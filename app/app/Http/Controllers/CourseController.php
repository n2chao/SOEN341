<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Returns search results for Courses.
     */
    public function search(){
        $query = request('q');
        if(!$query && $query == '') return \Response::json(array(), 400);

        $courses = \App\Course::where('code','like','%'.$query.'%')
            ->take(10)
			->get(array('code', 'name'))
			->toArray();

            return \Response::json(array(
                'data'=>$courses
            ));
    }

    /*
    * Responds to GET /courses/{course}
    */
    public function show(Course $course)
    {
        return $course;
    }
}
