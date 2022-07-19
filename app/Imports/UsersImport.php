<?php

namespace App\Imports;

use App\Models\Membership\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel,WithHeadingRow
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!isset($row['meli_code'])) {
            return null;
        }
        return new User([
            'username'       => '0'.$row['meli_code'],
            'first_name'     => $row['f_name'],
            'last_name'      => $row['l_name'],
            'mobile'         => '0'.$row['mobile'],
            'email'          => $row['email'] ?? '0'.$row['meli_code'].'@gmail.com',
            'password'       => Hash::make($row['password']) ?? Hash::make('0'.$row['f_name']),
            'organization_id'=> 1,
              ]);
    }
}
