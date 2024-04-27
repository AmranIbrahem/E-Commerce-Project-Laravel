<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $products=[
            //1
            ['name'=>'Shoes Adidas',
             'brand_id'=> '1' , 'category_id'=> '1', 'sub_category_id'=> '1' ,'price'=>'40',
            'details'=>"adidas mens Lite Racer BYD Athletic Running Shoes, Core Black/Cloud White, 8.5 U" ,
             'quantity'=> "250" , 'status'=>"available",
            'main_image'=>'shose.jpg',
            'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay(),
            'updated_at'=>Carbon::now()],
            //2
            ['name'=>'iphone 13 pro',
                'brand_id'=> '2' , 'category_id'=> '5', 'sub_category_id'=> '16' ,'price'=>'400',
                'details'=>"iphone 13 pro 128GB Ram 6 GB Camera 20MB " ,
                'quantity'=> "25" , 'status'=>"available",
                'main_image'=>'shose.jpg',
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at'=>Carbon::now()],
            //3
            ['name'=>'Acer Nitro 5 Gaming',
                'brand_id'=> '3' , 'category_id'=> '5', 'sub_category_id'=> '15' ,'price'=>'700',
                'details'=>"Acer Nitro 5 Gaming Gtx 1650 Ram 16 GB SSD 1 TB " ,
                'quantity'=> "8" , 'status'=>"available",
                'main_image'=>'shose.jpg',
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at'=>Carbon::now()],
            //4
            ['name'=>'Asus Tuf Gaming Fx517 RC',
                'brand_id'=> '4' , 'category_id'=> '5', 'sub_category_id'=> '15' ,'price'=>'1200',
                'details'=>"Asus Tuf Gaming FX 517 RC RTX 3050TI RAm 32 GB SSD 2 TB" ,
                'quantity'=> "4" , 'status'=>"available",
                'main_image'=>'shose.jpg',
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at'=>Carbon::now()],
            //5
            ['name'=>'Azzaro Perfumes ',
                'brand_id'=> '5' , 'category_id'=> '3', 'sub_category_id'=> '9' ,'price'=>'30',
                'details'=>"Azzaro Perfumes For Man" ,
                'quantity'=> "29" , 'status'=>"available",
                'main_image'=>'shose.jpg',
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at'=>Carbon::now()],
            //6
            ['name'=>'Casio Watch Classic ',
                'brand_id'=> '6' , 'category_id'=> '4', 'sub_category_id'=> '12' ,'price'=>'450',
                'details'=>"Casio Watch Classis Made in Itaya By Amran Ibrahem im 1985" ,
                'quantity'=> "6" , 'status'=>"available",
                'main_image'=>'shose.jpg',
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at'=>Carbon::now()],
            //7
            ['name'=>'Puma Baracalona 2015',
                'brand_id'=> '7' , 'category_id'=> '2', 'sub_category_id'=> '5' ,'price'=>'120',
                'details'=>"FCB 2015 Puma made in Chaina" ,
                'quantity'=> "60" , 'status'=>"available",
                'main_image'=>'shose.jpg',
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at'=>Carbon::now()],
            //8
            ['name'=>'Lacost Perfumes',
                'brand_id'=> '8' , 'category_id'=> '3', 'sub_category_id'=> '9' ,'price'=>'60',
                'details'=>"Lacost Perfumes for man" ,
                'quantity'=> "80" , 'status'=>"available",
                'main_image'=>'shose.jpg',
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at'=>Carbon::now()],
            //9
            ['name'=>'Rolex Watch',
                'brand_id'=> '9' , 'category_id'=> '4', 'sub_category_id'=> '12' ,'price'=>'600',
                'details'=>"Rolex Traditional Watches" ,
                'quantity'=> "80" , 'status'=>"available",
                'main_image'=>'shose.jpg',
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at'=>Carbon::now()],
            //10
            ['name'=>'Macbook Laptop',
                'brand_id'=> '10' , 'category_id'=> '5', 'sub_category_id'=> '15' ,'price'=>'1500',
                'details'=>"Macbook Laptop RAM 16 SSD 1 TB" ,
                'quantity'=> "41" , 'status'=>"available",
                'main_image'=>'shose.jpg',
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at'=>Carbon::now()],


    ];

        foreach ($products as $product) {
            $imagePath = 'public/images/products/' . $product['main_image'];

            $fileExists = File::exists($imagePath);
            if (!$fileExists) {
                continue;
            }

            $imageName =basename($imagePath);

            Product::insert([
                'name' => $product['name'],
                'brand_id'=>$product['brand_id'],
                'category_id'=>$product['category_id'],
                'sub_category_id'=>$product['sub_category_id'],
                'details'=>$product['details'],
                'quantity'=>$product['quantity'],
                'status'=>$product['status'],
                'price'=>$product['price'],
                'main_image' => "images/products/$imageName",
                'created_at'=>$product['created_at'],
                'updated_at'=>$product['updated_at'],
            ]);


//                $destinationPath = storage_path('app/public/images/companies');
//                File::copy($imagePath, $destinationPath . '/' . $imageName);
        }



    }
}
