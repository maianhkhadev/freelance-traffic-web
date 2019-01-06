<?php

use App\Member;
use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createMember(1, 'member-01', 'member-01@gmail.com');
        $this->createMember(2, 'member-02', 'member-02@gmail.com');
        $this->createMember(1, 'member-03', 'member-03@gmail.com');
        $this->createMember(2, 'member-04', 'member-04@gmail.com');
        $this->createMember(1, 'member-05', 'member-05@gmail.com');
    }

    private function createMember($team_id, $name, $email) {
      $member = new Member();
      $member->team_id = $team_id;
      $member->name = $name;
      $member->email = $email;
      $member->save();
    }
}
