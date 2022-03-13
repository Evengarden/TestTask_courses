<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Course::findOrFail($id);
    }
}