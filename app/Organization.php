<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public static function rules()
    {
        return [
            'org_name'  => 'required',
            'email'     => 'required|email'
        ];
    }
}
