<?php

use Illuminate\Database\Seeder;
use Spatie\Tags\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'name' => 'Viral',
        ]);
        Tag::create([
            'name' => 'Baru',
        ]);
        Tag::create([
            'name' => 'Notification',
        ]);
        Tag::create([
            'name' => 'Seeder',
        ]);
        Tag::create([
            'name' => 'Dashboard',
        ]);
        Tag::create([
            'name' => 'Landing Page',
        ]);
        Tag::create([
            'name' => 'Portfolio',
        ]);
    }
}
