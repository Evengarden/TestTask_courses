<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class LessonUser extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

     
    protected $fillable = [
        'user_id', 'lesson_id', 'is_passed'
    ];

    protected static function booted()
    {
        static::updated(function ($lessonUser) {
            $lesson = Lesson::find($lessonUser->lesson_id);
            $course = Course::find($lesson->course_id);
            $courseUser = CourseUser::where([['user_id',$lessonUser->user_id],['course_id',$course->id]])->first();
            $courseLessons = Lesson::where('course_id',$course->id)->get();
            $courseLessonsCount = $courseLessons->count();
            $lessonsIds =array(); 
            foreach ($courseLessons as $courseLesson) {
               $lessonsIds[] = $courseLesson->id;
            }
            $completedLessonsCount = LessonUser::whereIn('lesson_id',$lessonsIds)->where('is_passed',true)->count();
            $lessonUser->user_id = $courseLessonsCount;
            $lessonUser->lesson_id = $completedLessonsCount;
            $percentageCompleted = $completedLessonsCount / $courseLessonsCount * 100;
            $courseUser->percentage_passing = round($percentageCompleted,0);
            $courseUser->save();
        });
    }
}
