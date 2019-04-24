<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TarifsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tarifs')->insert([
            [
                'name' => 'Fit',
                'price' => '100',
            ], [
                'name' => 'Daily',
                'price' => '200',
            ], [
                'name' => 'Balance',
                'price' => '300',
            ]
        ]);
    }
}
