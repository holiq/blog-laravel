<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
			'name' => 'create user',
		]);
        Permission::create([
			'name' => 'edit user',
		]);
        Permission::create([
			'name' => 'delete user',
		]);
        Permission::create([
			'name' => 'create permission',
		]);
        Permission::create([
			'name' => 'edit permission',
		]);
        Permission::create([
			'name' => 'delete permission',
		]);
        Permission::create([
			'name' => 'set permission user',
		]);
        Permission::create([
			'name' => 'create role',
		]);
        Permission::create([
			'name' => 'edit role',
		]);
        Permission::create([
			'name' => 'delete role',
		]);
        Permission::create([
			'name' => 'create post',
		]);
        Permission::create([
			'name' => 'edit post',
		]);
        Permission::create([
			'name' => 'delete post',
		]);
        Permission::create([
			'name' => 'delete comment',
		]);
    }
}
