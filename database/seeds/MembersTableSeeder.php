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
        $this->createMember(1, 'member-06', 'member-06@gmail.com');
        $this->createMember(2, 'member-07', 'member-07@gmail.com');
        $this->createMember(1, 'member-08', 'member-08@gmail.com');
        $this->createMember(2, 'member-09', 'member-09@gmail.com');
        $this->createMember(1, 'member-10', 'member-10@gmail.com');
        $this->createMember(1, 'member-11', 'member-11@gmail.com');
        $this->createMember(2, 'member-12', 'member-12@gmail.com');
        $this->createMember(1, 'member-13', 'member-13@gmail.com');
        $this->createMember(2, 'member-14', 'member-14@gmail.com');
        $this->createMember(1, 'member-15', 'member-15@gmail.com');
        $this->createMember(1, 'member-16', 'member-16@gmail.com');
        $this->createMember(2, 'member-17', 'member-17@gmail.com');
        $this->createMember(1, 'member-18', 'member-18@gmail.com');
        $this->createMember(2, 'member-19', 'member-19@gmail.com');
        $this->createMember(1, 'member-20', 'member-20@gmail.com');
    }

    private function createMember($team_id, $name, $email) {
      $member = new Member();
      $member->team_id = $team_id;
      $member->name = $name;
      $member->email = $email;
      $member->save();
    }
}
