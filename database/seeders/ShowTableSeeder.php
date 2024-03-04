<?php

namespace Database\Seeders;

use App\Models\Show;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $showTimes = [
            '6:00 AM',
            '7:00 AM',
            '9:00 AM',
            '11:00 AM',
            '12:30 PM',
            '1:10 PM',
            '3:30 PM',
            '5:30 PM',
            '6:30 PM',
            '7:30 PM',
            '8:30 PM',
        ];

        foreach ($showTimes as $showTime) {
            Show::firstOrCreate(['show_time' => $showTime]);
        }
    }
}
