<?php

namespace Database\Seeders\Payment;

use App\Models\Admin\Payment\PaymentSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments = [
            ['name' => 'سداد','status' => 3],
            ['name' => 'به پرداخت'],
            ['name' => 'سامان'],
            ['name' => 'پارسیان'],
            ['name' => 'زرین پال'],
            ['name' => 'سپهر'],
            ['name' => 'آسان پرداخت'],
            ['name' => 'پارسارگاد'],

        ];

        foreach($payments as $payment){
            PaymentSetting::create($payment);
        }
    }
}
