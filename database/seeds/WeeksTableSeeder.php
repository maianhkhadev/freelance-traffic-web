<?php

use App\Week;
use Carbon\Carbon;
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
      for($i = 0; $i < 52; $i++) {
        $this->createWeek(2019, $i + 1);
      }

      for($i = 0; $i < 53; $i++) {
        $this->createWeek(2020, $i + 1);
      }

      for($i = 0; $i < 52; $i++) {
        $this->createWeek(2021, $i + 1);
      }
    }

    private function createWeek($year, $week_numner) {
      $week = new Week();
      $week->name = 'week-'.$week_numner.'-'.$year;

      $date = Carbon::now();
      $date->setISODate($year, $week_numner);

      $week->start_date = $date->startOfWeek()->format('Y-m-d');
      $week->end_date = $date->endOfWeek()->format('Y-m-d');

      $week->save();
    }
}
