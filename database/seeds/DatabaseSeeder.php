<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(NamesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(MembersTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(WeeksTableSeeder::class);
        $this->call(TasksTableSeeder::class);
        $this->call(HistoriesTableSeeder::class);
    }
}
