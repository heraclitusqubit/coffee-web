<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'name'=>'Starburst Blend 200gr',
                'description'=>'Blend 200gr Starburst',
                'price'=>150000,
                'stock'=>5,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Ethiopia Danche 200gr',
                'description'=>'Single Origin Ethiopia Danche Natural',
                'price'=>180000,
                'stock'=>5,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Espresso Blend 1kg - The Usual Suspect',
                'description'=>'Espresso Blend 1kg',
                'price'=>340000,
                'stock'=>5,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
        ]);
    }
}
