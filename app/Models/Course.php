<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Course extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title', 'student_capacity', 'start_date', 'end_date', 'has_certificate'
    ];

    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson', 'course_id');
    }
    public function users()
    {
        return $this->hasMany('App\Models\CourseUser', 'course_id');
    }
}
