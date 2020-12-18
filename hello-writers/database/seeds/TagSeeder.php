<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tags = ['food', 'lifestyle', 'travel', 'health', 'beauty', 'bloggerstyle', 'technical', 'democracy'];

        foreach ($tags as $tag) {
            DB::table('tags')->insert(['name' => $tag]);
        }
    }
}
