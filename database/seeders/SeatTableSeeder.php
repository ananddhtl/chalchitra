<?php

namespace Database\Seeders;

use App\Models\Seat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $letters = range('A', 'T');

        foreach ($letters as $letter) {
            DB::table('seats')->updateOrInsert(
                [
                    'seat_title' => $letter,
                ],
                ['status' => 'available']
            );
        }
    }
}
