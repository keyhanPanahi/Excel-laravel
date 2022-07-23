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

class UsersImport implements ToCollection,WithHeadingRow,WithValidation,SkipsOnFailure,SkipsOnError,WithUpserts
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
            if (!isset($row['meli_code'])) {
                return null;
            }
            $user = User::create([
                'username'       => '0'.$row['meli_code'],
                'first_name'     => $row['f_name'],
                'last_name'      => $row['l_name'],
                'mobile'         => '0'.$row['mobile'],
                'email'          => $row['email'] ?? '0'.$row['meli_code'].'@gmail.com',
                'password'       => Hash::make($row['password']) ?? Hash::make('0'.$row['f_name']),
                'organization_id'=> 1,
            ]);
            $user->syncRoles([$row['role']]);
        }


    }
    public function uniqueBy()
    {
        return ['username', 'mobile','email'];
    }
    public function rules(): array
    {
        return [
            'username' => ['unique:users,username','max:10','min:10'],
            'mobile' => ['unique:users,mobile'],
            'email' => ['unique:users,email'],
        ];
    }
    public function customValidationMessages()
    {
        return [
            'mobile.unique' => 'شماره موبایل قبلا انتخاب شده است!',
            'email.unique' => 'ایمیل قبلا انتخاب شده است!',
            'username.unique' => 'کدملی قبلا انتخاب شده است!',
            'username.max' => 'کدملی نباید بیشتر نباید ده رقم باشد!',
            'username.min' => 'کدملی نباید کمتر نباید ده رقم باشد!',
        ];
    }





}
