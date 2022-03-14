<?php

namespace App\Http\Controllers;

use App\Events\AddUserOnCourse;
use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\LessonUser;
use App\Models\Lesson;

class CourseController extends Controller
{
    public function showAll()
    {
        return response()->json(Course::with('lessons')->get());
    }

    public function createCourse(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'student_capacity' => 'required|integer',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'date|after:start_date',
            'has_certificate' => 'required|boolean',
        ]);
        return response()->json(Course::create($request->all()));
    }

    public function addUserOnCourse(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|integer|exists:users,id',
            'course_id' => 'required|integer|exists:courses,id'
        ]);
        $course = Course::find($request->course_id);
        return event(new AddUserOnCourse($course, $request->all()));
    }

    public function getCourseLessons($id)
    {
        $course = Course::find($id);
        return response()->json($course->lessons);
    }

    public function completeLesson(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'lesson_id' => 'required|exists:lessons,id'
        ]);
        $lessonUser = LessonUser::where([['lesson_id', $request->lesson_id], ['user_id', $request->user_id]])->first();
        $lessonUser->is_passed = true;
        $lessonUser->save();
        return response()->json($lessonUser);
    }
}
