<?php

use App\Week;
use Illuminate\Database\Seeder;

class WeeksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createWeek('week-01', now());
    }

    private function createWeek($name, $start_date) {
      $team = new Week();
      $team->name = $name;
      $team->start_date = $start_date;
      $team->save();
    }
}
