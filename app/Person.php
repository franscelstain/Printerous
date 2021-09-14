<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table    = 'persons';
    protected $guarded  = ['id', 'created_at', 'updated_at'];

    public static function rules()
    {
        return [
            'person_name'   => 'required',
            'email'         => 'required|email'
        ];
    }
}
