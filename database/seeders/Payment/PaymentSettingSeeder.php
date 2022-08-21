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
            ['name' => 'سداد','detail' => json_encode(['title' => 'sadad','merchantId' => null,'key' => null,'terminalId' => null, 'PaymentIdentity' => null]),'status' => 1],
            ['name' => 'به پرداخت','detail' => json_encode(['title' => 'behpardakht','terminalId' => null,'username' => null,'password' => null]),'status' => 1],
            ['name' => 'سامان','detail' => json_encode(['title' => 'saman','merchantId' => null]),'status' => 1],
            ['name' => 'پارسیان','detail' => json_encode(['title' => 'parsian','merchantId' => null]),'status' => 1],
            ['name' => 'سپهر','detail' => json_encode(['title' => 'sepehr','terminalId' => null]),'status' => 1],
            ['name' => 'آسان پرداخت','detail' => json_encode(['title' => 'asanpardakht','merchantConfigID' => null,'username' => null,'password' => null]),'status' => 1],
            ['name' => 'پارسارگاد','detail' => json_encode(['title' => 'pasargad','merchantId' => null,'terminalCode' => null,]),'status' => 1],
            ['name' => 'زرین پال','detail' => json_encode(['title' => 'zarinpal','merchantId' => null ]),'status' => 1],

        ];

        foreach($payments as $payment){
            PaymentSetting::create($payment);
        }
    }
}
