<?php

namespace Database\Seeders;
use App\Models\Brand;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

// use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\File;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

            $companies = [
                [
                    'name' => 'Adidas',
                    'image' => 'Adidas.png',
                    'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
                    'updated_at'=>Carbon::now()->addDays(rand(1, 30))
                ],
                [
                    'name' => 'Apple',
                    'image' => 'apple.png',
                    'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
                    'updated_at'=>Carbon::now()->addDays(rand(1, 30))
                ],
                [
                    'name' => 'Acer',
                    'image' => 'Acer.png',
                    'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
                    'updated_at'=>Carbon::now()->addDays(rand(1, 30))
                ],
                [
                    'name' => 'Acer',
                    'image' => 'Asus.png',
                    'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
                    'updated_at'=>Carbon::now()->addDays(rand(1, 30))
                ],
                [
                    'name' => 'Azzaro',
                    'image' => 'azzaro.png',
                    'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
                    'updated_at'=>Carbon::now()->addDays(rand(1, 30))
                ],
                [
                    'name' => 'Casio',
                    'image' => 'casio.png',
                    'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
                    'updated_at'=>Carbon::now()->addDays(rand(1, 30))
                ],
                [
                    'name' => 'Puma',
                    'image' => 'puma.png',
                    'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
                    'updated_at'=>Carbon::now()->addDays(rand(1, 30))
                ],
                [
                    'name' => 'Lacost',
                    'image' => 'lacost.jpg',
                    'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
                    'updated_at'=>Carbon::now()->addDays(rand(1, 30))
                ],
                [
                    'name' => 'Rolex',
                    'image' => 'rolex.png',
                    'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
                    'updated_at'=>Carbon::now()->addDays(rand(1, 30))
                ],
                [
                    'name' => 'Macbook',
                    'image' => 'Macbook1.png',
                    'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
                    'updated_at'=>Carbon::now()->addDays(rand(1, 30))
                ],
                [
                    'name' => 'Samasung',
                    'image' => 'samasung.png',
                    'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
                    'updated_at'=>Carbon::now()->addDays(rand(1, 30))
                ],
                [
                    'name' => 'Malizia',
                    'image' => 'malizia.png',
                    'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
                    'updated_at'=>Carbon::now()->addDays(rand(1, 30))
                ],
                [
                    'name' => 'Tudor',
                    'image' => 'tudor.png',
                    'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
                    'updated_at'=>Carbon::now()->addDays(rand(1, 30))
                ],
                [
                    'name' => 'Nike',
                    'image' => 'Nike.png',
                    'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
                    'updated_at'=>Carbon::now()->addDays(rand(1, 30))
                ],
                [
                    'name' => 'Xiaomi',
                    'image' => 'xiaomi.png',
                    'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
                    'updated_at'=>Carbon::now()->addDays(rand(1, 30)),
                ],


            ];

            foreach ($companies as $company) {
                $imagePath = 'public/images/brands/' . $company['image'];

                $fileExists = File::exists($imagePath);
                if (!$fileExists) {
                    continue;
                }

                $imageName =basename($imagePath);

                Brand::insert([
                    'name' => $company['name'],
                    'image' => "images/brands/$imageName",
                ]);

//                $destinationPath = storage_path('app/public/images/companies');
//                File::copy($imagePath, $destinationPath . '/' . $imageName);
            }

    }
}
