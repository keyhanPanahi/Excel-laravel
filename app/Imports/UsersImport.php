<?php

namespace App\Imports;

use App\Models\Membership\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class UsersImport implements ToCollection,WithHeadingRow,WithValidation,SkipsOnFailure,SkipsOnError
{
        use Importable,SkipsFailures,SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
//            if (!isset($row['meli_code'])) {
//                return null;
//            }
            $user = User::create([
                'username'       => $row['meli_code'],
                'first_name'     => $row['f_name'],
                'last_name'      => $row['l_name'],
                'mobile'         => $row['mobile'],
                'email'          => $row['email'] ?? $row['meli_code'].'@gmail.com',
                'password'       => Hash::make($row['password']) ?? Hash::make($row['f_name']),
                'organization_id'=> 1,
            ]);
            $user->syncRoles([$row['role']]);
        }


    }
//    public function uniqueBy()
//    {
//        return ['username', 'mobile','email'];
//    }
    public function rules(): array
    {
        return [
            'meli_code' => ['unique:users,username','max:10','min:10'],
            'mobile' => ['unique:users,mobile','max:11','min:11'],
            'email' => ['unique:users','email'],
            'role' => ['in:4,5,7,8'],
        ];
    }
    public function customValidationMessages()
    {
        return [
            'mobile.unique' => 'شماره موبایل قبلا انتخاب شده است!',
            'mobile.max' => 'شماره موبایل نباید بیشتر از 11 رقم باشد!',
            'mobile.min' => 'شماره موبایل نباید کمتر از 11 رقم باشد!',
            'email.unique' => 'ایمیل قبلا انتخاب شده است!',
            'email.email' => 'فرمت ایمیل اشتباه است!',
            'meli_code.unique' => 'کدملی قبلا انتخاب شده است!',
            'meli_code.max' => 'کدملی نباید بیشتر از 10 رقم باشد!',
            'meli_code.min' => 'کدملی نباید کمتر از 10 رقم باشد!',
            'role.in' => 'کد نقش صحیح نمی باشد! (فرمت صحیح: 4,5,7,8)',
        ];
    }





}
