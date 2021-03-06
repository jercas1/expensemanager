<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'role_function_id',
    ];
}
