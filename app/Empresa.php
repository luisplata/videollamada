<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model {

    //
    protected $hidden = [
        'pass'
    ];

    public static function getByToken($token) {
        return Empresa::where("token", $token)->first();
    }

}
