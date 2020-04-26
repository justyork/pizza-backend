<?php

use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(\App\Delivery::class)->createMany([
            ['title' => 'Take away', 'price' => 0, 'free_from' => 0],
            ['title' => 'Standart delivery', 'price' => 150, 'free_from' => 1000,]
        ]);
    }
}
