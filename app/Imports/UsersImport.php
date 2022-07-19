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
        if (!isset($row['melicode'])) {
            return null;
        }
        return new User([
            'username'       => '0'.$row['melicode'],
            'first_name'     => $row['name'],
            'last_name'      => $row['family'],
            'mobile'         => '0'.$row['mobile'],
            'email'          => $row['email'] ?? '0'.$row['melicode'].'@gmail.com',
            'password'       => Hash::make($row['password']) ?? Hash::make('0'.$row['name']),
            'organization_id'=> 1,
              ]);
    }
}
