<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;
    public $timestamps=true;
    protected $fillable=[
        'otp',
        'phone_number',
    ];
}
