<?php

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
     
      DB::table('sites')->insert([
            'name' => 'BSGE']);
      
      DB::table('users')->insert([
            'firstName' => 'Lucas',
            'lastName' => 'Sheridan',
            'email' => 'lucas_sheridan@me.com',
            'password' => bcrypt('2ucySh3ridan')]);

      DB::table('roles')->insert([
            'id' => 1,
            'name' => 'student',
            'label' => 'Student Account']);

      DB::table('roles')->insert([
            'id' => 2,
            'name' => 'teacher',
            'label' => 'Teacher Account']);

      DB::table('roles')->insert([
            'id' => 3,
            'name' => 'admin',
            'label' => 'Admin Account']);

      DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 3]);

      DB::table('site_user')->insert([
            'site_id' => 1,
            'user_id' => 1]);
    }
}