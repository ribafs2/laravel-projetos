<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
		$products = [
			[
				'name' => 'Mangas',
				'inventory_min' => 10,
				'inventory_max' => 100,
			],
			[    'name' => 'Bananas',
				'inventory_min' => 20,
				'inventory_max' => 200,
			]		
		];
		
		// Looping and Inserting Array's Users into User Table
		foreach($products as $product){
		    Product::create($product);
		}		
    }
}

