<?php

use App\Team;
use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createTeam('account', '#8A2BE2');
        $this->createTeam('design', '#5F9EA0');
    }

    private function createTeam($name, $color) {
      $team = new Team();
      $team->name = $name;
      $team->color = $color;
      $team->save();
    }
}
