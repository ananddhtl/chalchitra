<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\MovieCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movie_categories = ['Love Story', 'Romantic', 'Horror', 'Thirller'];

        $movies = [
            [
                'title' => 'Kabbadi 4',
                'description' => 'Kabbadi Kabbadi Kabbadi Kabbadi',
                'thumbnail' => '/uploads/movies/1793160781466223.jpeg',
                'iframe_link' => 'https://www.youtube.com/watch?v=zOJwj88rQuE',
                'time_duration' => '2 hour 15 min',
                'publish_date' => "2024-03-10",
                'end_date' => "2024-03-20",
            ],
            [
                'title' => 'Yodha',
                'description' => 'Yodha Yodha Yodha Yodha',
                'thumbnail' => '/uploads/movies/1793160781466223.jpeg',
                'iframe_link' => 'https://www.youtube.com/watch?v=3AuB8RTfBJc',
                'time_duration' => '2 hour 05 min',
                'publish_date' => "2024-03-10",
                'end_date' => "2024-03-20",
            ],
            [
                'title' => 'Agastya (Chapter 1)',
                'description' => 'AGASTYA (Chapter 1) || Nepali Movie Trailer || Saugat Malla, Najir Husen, Malika Mahat, Nishcal',
                'thumbnail' => '/uploads/movies/1793160781466223.jpeg',
                'iframe_link' => 'https://www.youtube.com/watch?v=bJZwYj1gOu0',
                'time_duration' => '2 hour 10 min',
                'publish_date' => "2024-03-15",
                'end_date' => "2024-03-22",
            ],
            [
                'title' => 'Agastya (Chapter 1)',
                'description' => 'UPAHAAR || Nepali Movie Official Trailer || Rekha Thapa, Pooja Sharma, Benisha Hamal, Mukun, Sushma',
                'thumbnail' => '/uploads/movies/1793160781466223.jpeg',
                'iframe_link' => 'https://www.youtube.com/watch?v=xejq7hVeRAc',
                'time_duration' => '2 hour 20 min',
                'publish_date' => "2024-03-12",
                'end_date' => "2024-03-19",
            ],
        ];

        foreach ($movie_categories as $mc) {

            MovieCategory::create([
                'title' => $mc
            ]);
        }

        foreach ($movies as $movie) {
            $movie['category'] = rand(1, 4);
            Movie::create($movie);
        }
    }
}
