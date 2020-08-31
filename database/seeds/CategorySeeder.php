<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
        	'name' => 'Fashion',
        	'slug' => 'fashion',
        ]);
        Category::create([
        	'name' => 'Programming',
        	'slug' => 'programming',
        ]);
        Category::create([
        	'name' => 'Hardware',
        	'slug' => 'hardware',
        ]);
        Category::create([
        	'name' => 'Designer',
        	'slug' => 'designer',
        ]);
        Category::create([
        	'name' => 'Hacking',
        	'slug' => 'hacking',
        ]);
    }
}
