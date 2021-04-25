<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    use HasFactory;

	protected $primaryKey = 'id';

	protected $fillable = [
		'user_id',
		'ip_address',
		'user_agent',
		'payload',
		'start_time',
		'end_time',
	];

}
