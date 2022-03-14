<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'api'], function () use ($router) {

  $router->get('migrate',  ['uses' => 'UserController@migrate']);

  //User
  $router->get('users',  ['uses' => 'UserController@showAll']);

  $router->post('users/register', ['uses' => 'UserController@register']);

  $router->put('users/{id}', ['uses' => 'UserController@update']);

  $router->delete('users/{id}', ['uses' => 'UserController@delete']);

  $router->post('login', ['uses' => 'UserController@login']);

  //Courses
  $router->get('courses',  ['uses' => 'CourseController@showAll']);

  $router->post('courses', ['uses' => 'CourseController@createCourse']);

  $router->post('course_users', ['uses' => 'CourseController@addUserOnCourse']);

  $router->get('course_lessons/{id}',  ['uses' => 'CourseController@getCourseLessons']);

  $router->put('course_lesson_users', ['uses' => 'CourseController@completeLesson']);
});
