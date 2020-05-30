<?php

use Illuminate\Database\Seeder;

class TestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tests')->truncate();
        DB::table('tests')->insert([
            ['title' => 'Test 1', 'content' => 'Nội dung test 1'],
            ['title' => 'Test 2', 'content' => 'Nội dung test 2'],
        ]);
    }
}
