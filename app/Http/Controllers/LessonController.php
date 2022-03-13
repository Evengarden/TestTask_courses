<?php

namespace App\Http\Controllers;

use App\Models\Lesson;

class LessonController extends Controller
{
    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Lesson::findOrFail($id);
    }
}