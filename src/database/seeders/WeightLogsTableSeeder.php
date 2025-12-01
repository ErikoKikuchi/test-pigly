<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeightLogs;

class WeightLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WeightLogs::factory()->count(35)->create();
    }
}
