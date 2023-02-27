<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'visitor',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted',
    ];


	public function showField()
	{
		return ['id','uuid','name','visitor','created_at','updated_at'];
	}
}
