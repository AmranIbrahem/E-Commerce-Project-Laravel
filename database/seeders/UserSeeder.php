<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user=[
            //1
            ['full_name'=>'Amran Ibrahem',
            'email'=>'amranibrahem@gmail.com',
            'password'=>Hash::make('123456789'),
            'recovery_code'=> mt_rand(5000,500000),
                'role'=>'owner',
                'email_verified_at'=>Carbon::now()->addDays(rand(1, 30)),
            'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
            'updated_at'=>Carbon::now()->addDays(rand(1, 30))],
            //2
            ['full_name'=>'Mahmoud Ali',
            'email'=>'mahmoudali@gmail.com',
            'password'=>Hash::make('123456789'),
                'role'=>'admin',
                'recovery_code'=> mt_rand(5000,500000),
                'email_verified_at'=>Carbon::now()->addDays(rand(1, 30)),
            'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
            'updated_at'=>Carbon::now()->addDays(rand(1, 30))],
            //3
            ['full_name'=>'Dalla Ibrahem',
            'email'=>'dallaibrahem@gmail.com',
            'password'=>Hash::make('123456789'),
            'recovery_code'=> mt_rand(5000,500000),
                'role'=>'admin',
                'email_verified_at'=>Carbon::now()->addDays(rand(1, 30)),
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
            'updated_at'=>Carbon::now()->addDays(rand(1, 30))],
            //4
            ['full_name'=>'Ahmad Abbas',
            'email'=>'ahmadabbas@gmail.com',
            'password'=>Hash::make('123456789'),
            'recovery_code'=> mt_rand(5000,500000),
                'role'=>'',
                'email_verified_at'=>Carbon::now()->addDays(rand(1, 30)),
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
            'updated_at'=>Carbon::now()->addDays(rand(1, 30))],
            //5
            ['full_name'=>'Zein Isamil',
            'email'=>'zeinisamil@gmail.com',
            'password'=>Hash::make('123456789'),
            'recovery_code'=> mt_rand(5000,500000),
                'role'=>'',
                'email_verified_at'=>Carbon::now()->addDays(rand(1, 30)),

                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
            'updated_at'=>Carbon::now()->addDays(rand(1, 30))],
            //6
            ['full_name'=>'Alaa Khaddour',
            'email'=>'alaakhaddour@gmail.com',
            'password'=>Hash::make('123456789'),
            'recovery_code'=> mt_rand(5000,500000),
                'role'=>'',
                'email_verified_at'=>Carbon::now()->addDays(rand(1, 30)),
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
            'updated_at'=>Carbon::now()->addDays(rand(1, 30))],
            //7
            ['full_name'=>'Zein Saleh',
            'email'=>'zeinsaleh@gmail.com',
            'password'=>Hash::make('123456789'),
            'recovery_code'=> mt_rand(5000,500000),
                'role'=>'',
                'email_verified_at'=>Carbon::now()->addDays(rand(1, 30)),
                'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
            'updated_at'=>Carbon::now()->addDays(rand(1, 30))],
            //8
            ['full_name'=>'Osama Ali',
            'email'=>'osamaali@gmail.com',
            'password'=>Hash::make('123456789'),
                'role'=>'',
                'email_verified_at'=>Carbon::now()->addDays(rand(1, 30)),
                'recovery_code'=> mt_rand(5000,500000),
            'created_at'=>Carbon::now()->subDays(rand(1, 30))->startOfDay()->setTime(rand(0,24),rand(0,60), rand(0,60)),
            'updated_at'=>Carbon::now()->addDays(rand(1, 30))],

        ];

        User::insert($user);

    }
}
