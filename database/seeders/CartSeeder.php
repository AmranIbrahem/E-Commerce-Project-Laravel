<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $carts=[
            //1
            [
                "quantity"=> 1,
                "product_id"=>1,
                "user_id"=>1,
                "price"=> 40
            ],
            //2
            [
                "quantity"=> 2,
                "product_id"=>3,
                "user_id"=>1,
                "price"=> 700
            ],
            //3
            [
                "quantity"=> 2,
                "product_id"=>3,
                "user_id"=>2,
                "price"=> 700
            ],
            //4
            [
                "quantity"=> 2,
                "product_id"=>3,
                "user_id"=>2,
                "price"=> 700
            ],
            //5
            [
                "quantity"=> 2,
                "product_id"=>3,
                "user_id"=>3,
                "price"=> 700
            ],
            //6
            [
                "quantity"=> 2,
                "product_id"=>3,
                "user_id"=>4,
                "price"=> 700
            ],

        ];

        Cart::insert($carts);


    }
}
