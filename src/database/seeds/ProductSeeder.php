<?php

use Illuminate\Database\Seeder;
use App\Models\Ecommerce\Products;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Products::class, 500)->create();
    }
}
