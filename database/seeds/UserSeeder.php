<?php

use Illuminate\Database\Seeder;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		for ($x = 0; $x <= 50; $x++) {
		$name = Str::random(10);
		User::create([
			'name' => $name,
			'slug' => Str::slug($name, '-'),
			'email' => Str::random(10).'@gmail.com',
			'status' => true,
            'password' => Hash::make(Str::random(10)),
		])->assignRole('user');
		}
		
		User::create([
			'name' => 'Holiq',
			'slug' => 'holiq',
			'email' => 'holiq@gmail.com',
			'status' => true,
            'password' => Hash::make('11111111'),
		])->assignRole('writer');
		
		User::create([
			'name' => 'Holiq Ibrahim',
			'slug' => 'holiq-ibrahim',
			'email' => 'holiq.ibrahim376@gmail.com',
			'status' => true,
            'password' => Hash::make('11111111'),
		])->assignRole('admin');
	}
}
