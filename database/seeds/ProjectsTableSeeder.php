<?php

use App\Project;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createProject('samsung', '#004ba2');
        $this->createProject('omo', '#ea0000');
        $this->createProject('popeyes', '#fe7900');
        $this->createProject('organist', '#002310');
        $this->createProject('the glenlivet', '#4f2a38');
    }

    private function createProject($name, $color) {
      $project = new Project();
      $project->name = $name;
      $project->color = $color;
      $project->save();
    }
}
