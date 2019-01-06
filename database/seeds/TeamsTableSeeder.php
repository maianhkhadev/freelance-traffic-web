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
        $this->createTeam('account');
        $this->createTeam('design');
    }

    private function createTeam($name) {
      $team = new Team();
      $team->name = $name;
      $team->save();
    }
}
