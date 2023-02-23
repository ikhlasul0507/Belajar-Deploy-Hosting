<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'uuid',
        'name',
        'visitor',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted',
        'updated_at',
    ];
}
