<?php

use Illuminate\Database\Seeder;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
	        'name'  => 'Khaeruddin Asdar',
	        'email' => 'khaeruddinasdar12@gmail.com',
	        'role' => 'superadmin',
	        'phone' => '082344949500',
	        'password'  => bcrypt('12345678')
		]);

		DB::table('users')->insert([
	        'name'  => 'Muhammad Fattah',
	        'email' => 'fattah@gmail.com',
	        'role' => 'admin',
	        'phone' => '082344949501',
	        'password'  => bcrypt('12345678')
		]);

		DB::table('users')->insert([
	        'name'  => 'Milea',
	        'email' => 'milea@gmail.com',
	        'role' => 'kasir',
	        'phone' => '082344949502',
	        'password'  => bcrypt('12345678')
		]);
    }
}
