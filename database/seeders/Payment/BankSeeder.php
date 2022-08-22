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
            ['name' => 'سداد','status' => 1],
            ['name' => 'به پرداخت','status' => 1],
            ['name' => 'سامان','status' => 1],
            ['name' => 'پارسیان','status' => 1],
            ['name' => 'سپهر','status' => 1],
            ['name' => 'آسان پرداخت','status' => 1],
            ['name' => 'پارسارگاد','status' => 1],
            ['name' => 'زرین پال','status' => 1],

        ];

        foreach($banks as $bank){
            Bank::create($bank);
        }
    }
}
