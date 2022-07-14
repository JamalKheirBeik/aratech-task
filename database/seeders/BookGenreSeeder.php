<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            $randomBook = Book::all()->random(1)[0];
            $randomGenre = Genre::all()->random(1)[0];

            DB::table('book_genre')->insert([
                'book_id' => $randomBook->id,
                'genre_id' => $randomGenre->id
            ]);
        }
    }
}
