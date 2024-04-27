<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subcategory;
use Carbon\Carbon;
class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $SubCategory=[
            /////////
            /////////Affiliated with category of Shoes
            //1
            ['name'=>'Men',
            "category_id"=>"1",
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],
            //2
            ['name'=>'Women',
            "category_id"=>'1',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],
            //3
            ['name'=>'Kids',
            "category_id"=>'1',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],
            //4
            ['name'=>'Baby',
            "category_id"=>'1',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],

            /////////
            /////////Affiliated with category of Clothing
            //5
            ['name'=>'Men',
            "category_id"=>'2',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],
            //6
            ['name'=>'Women',
            "category_id"=>'2',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],
            //7
            ['name'=>'Kids',
            "category_id"=>'2',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],
            //8
            ['name'=>'Baby',
            "category_id"=>'2',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],

            /////////
            /////////Affiliated with category of Perfumes
            //9
            ['name'=>'Men',
            "category_id"=>'3',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],
            //10
            ['name'=>'Women',
            "category_id"=>'3',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],
            //11
            ['name'=>'Kids',
            "category_id"=>'3',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],

            /////////
            /////////Affiliated with category of watches
            //12
            ['name'=>'Traditional Watches',
            "category_id"=>'4',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],
            //13
            ['name'=>'Smart Watches',
            "category_id"=>'4',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],
            //14
            ['name'=>'Home Watches',
            "category_id"=>'4',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],

            /////////
            /////////Affiliated with category of Techlonogia
            //15
            ['name'=>' Laptop',
            "category_id"=>'5',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],
            //16
            ['name'=>'Mobile',
            "category_id"=>'5',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],
            //17
            ['name'=>'Video Game',
            "category_id"=>'5',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],
            //18
            ['name'=>'Headphones',
            "category_id"=>'5',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],
            
            /////////
            /////////Affiliated with category of Sport
            //19
            ['name'=>' Sports Equipments',
            "category_id"=>'6',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],
            //20
            ['name'=>'Sport corsets',
            "category_id"=>'6',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],
            //21
            ['name'=>'Sports Supplements',
            "category_id"=>'6',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],
            //22
            ['name'=>'Sports Dumbbells',
            "category_id"=>'6',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()],

    ];
    
    Subcategory::insert($SubCategory);
    }
}
