<?php

use Illuminate\Database\Seeder;

class DeliveryDaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delivery_days')->insert([[
                'tarif_id' => '1',
                'day' => '1',
            ], [
                'tarif_id' => '1',
                'day' => '3',
            ], [
                'tarif_id' => '1',
                'day' => '5',
            ], [
                'tarif_id' => '2',
                'day' => '2',
            ], [
                'tarif_id' => '2',
                'day' => '3',
            ], [
                'tarif_id' => '2',
                'day' => '4',
            ], [
                'tarif_id' => '3',
                'day' => '1',
            ], [
                'tarif_id' => '3',
                'day' => '6',
            ], [
                'tarif_id' => '3',
                'day' => '7',
            ]]
        );
    }
}
