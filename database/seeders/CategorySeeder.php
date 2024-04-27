<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Carbon\Carbon;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $catgorys=[
                //1
                ['name'=>'Shoes',
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at'=>Carbon::now()],
                //2
                ['name'=>'Clothing',
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at'=>Carbon::now()],
                //3
                ['name'=>'Perfumes',
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at'=>Carbon::now()],
                //4
                ['name'=>'watches',
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at'=>Carbon::now()],
                //5
                ['name'=>'Techlonogia',
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at'=>Carbon::now()],
                //6
                ['name'=>'Sport',
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay(),
                'updated_at'=>Carbon::now()],

        ];
        
        Category::insert($catgorys);

    }
}
