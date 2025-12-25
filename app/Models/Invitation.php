<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'category',
    ];

    const CATEGORY_VIP = 'vip';
    const CATEGORY_REGULAR = 'regular';
}
