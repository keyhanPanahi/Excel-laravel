<?php

namespace Database\Seeders\Payment;

use App\Models\Admin\Payment\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            ['persian_name' => 'سداد','english_name'=>'sedad','status' => 1],
            ['persian_name' => 'به پرداخت','english_name'=>'behpardakht','status' => 1],
            ['persian_name' => 'سامان','english_name'=>'saman','status' => 1],
            ['persian_name' => 'پارسیان','english_name'=>'parsian','status' => 1],
            ['persian_name' => 'سپهر','english_name'=>'sepehr','status' => 1],
            ['persian_name' => 'آسان پرداخت','english_name'=>'asanpardakht','status' => 1],
            ['persian_name' => 'پارسارگاد','english_name'=>'pasargad','status' => 1],
            ['persian_name' => 'زرین پال','english_name'=>'zarinpal','status' => 1],

        ];

        foreach($banks as $bank){
            Bank::create($bank);
        }
    }
}
