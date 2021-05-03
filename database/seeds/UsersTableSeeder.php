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
        DB::table('relations')->insert([
            'name' => 'Father'
        ]);

        DB::table('relations')->insert([
            'name' => 'Mother'
        ]);

        DB::table('relations')->insert([
            'name' => 'Sister'
        ]);

        DB::table('relations')->insert([
            'name' => 'Other'
        ]);
        DB::table('relations')->insert([
            'name' => 'Brother'
        ]);
    }
}
