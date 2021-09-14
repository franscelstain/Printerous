<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountManager extends Model
{
    protected $table    = 'users';
    protected $guarded  = ['id', 'created_at', 'updated_at'];

    public static function rules()
    {
        return [
            'name'  => 'required',
            'email' => 'required|email'
        ];
    }
}
