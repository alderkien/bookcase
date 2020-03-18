<?php

use Illuminate\Database\Seeder;

class BookCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Author::class, 10)->create();
        factory(App\Book::class, 50)->create();

        $authors = App\Author::all();

        App\Book::all()->each(function ($book) use ($authors) { 
            $book->authors()->attach(
                $authors->random(rand(1, 3))->pluck('id')->toArray()
            ); 
        });
    }
}
