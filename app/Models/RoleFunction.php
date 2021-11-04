<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleFunction extends Model
{
    use HasFactory;

    protected $fillable = [
        'module',
        'display_name',
        'description',
        'function',
        'uri',
    ];
}
