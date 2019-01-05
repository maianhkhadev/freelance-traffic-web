<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->createUser('Mai Anh Kha', 'maianhkha.dev@gmail.com', bcrypt('anhkha1811'));
      $this->createUser('Focus Asia Admin', 'admin@focus-asia.com', bcrypt('admin123'));
    }

    private function createUser($name, $email, $password) {
      $user = new User();
      $user->name = $name;
      $user->email = $email;
      $user->email_verified_at = now();
      $user->password = $password;
      $user->remember_token = str_random(10);
      $user->save();
    }
}
