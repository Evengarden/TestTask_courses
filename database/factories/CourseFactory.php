<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text,
            'student_capacity' => $this->faker->randomDigit,
            'start_date' =>  $this->faker->date,
            'end_date' =>  $this->faker->date,
            'has_certificate' =>  true
        ];
    }
}
