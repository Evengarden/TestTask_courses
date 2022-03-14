<?php

namespace App\Events;

use App\Models\Course;

class AddUserOnCourse extends Event
{
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $course;
    public $request;
    public function __construct(Course $course, $request)
    {
        $this->course = $course;
        $this->request = $request;
    }
}
