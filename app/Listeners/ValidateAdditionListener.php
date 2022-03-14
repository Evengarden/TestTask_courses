<?php

namespace App\Listeners;

use App\Events\AddUserOnCourse;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\CourseUser;
use App\Models\Lesson;
use Illuminate\Queue\InteractsWithQueue;

class ValidateAdditionListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\AddUserOnCourse  $event
     * @return void
     */
    public function handle(AddUserOnCourse $event)
    {
        $userCourses = CourseUser::where([['user_id', $event->request['user_id'],['course_id', $event->request['course_id']]]])->get()->count();
        $usersOnCourseCount = CourseUser::where('course_id', $event->request['course_id'])->get()->count();
        if ($userCourses == 0 && $usersOnCourseCount < $event->course->student_capacity) {
            return response()->json(CourseUser::create($event->request));
        }
        abort(404);
    }
}
