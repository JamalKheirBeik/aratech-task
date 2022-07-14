<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{

    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id' => Author::all()->random()->id,
            'title' => $this->faker->unique()->sentence(4),
            'description' => $this->faker->paragraph(10),
            'cover' => $this->faker->text(60),
            'likes' => $this->faker->numberBetween(0, 1000000),
            'dislikes' => $this->faker->numberBetween(0, 1000000),
        ];
    }
}
