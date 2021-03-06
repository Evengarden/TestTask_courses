<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class CourseUser extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id', 'course_id', 'percentage_passing'
    ];

    protected static function booted()
    {
        static::created(function ($courseUser) {
            $lessons = Lesson::where('course_id', $courseUser->course_id)->get();
            foreach ($lessons as $lesson) {
                LessonUser::create([
                    'user_id' => $courseUser->user_id,
                    'lesson_id' => $lesson->id
                ]);
            }
        });
    }
}
