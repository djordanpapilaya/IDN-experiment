<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeEvents extends Model
{
	use HasFactory;

	protected $primaryKey = 'id';

	protected $table = 'time_events';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'session_id',
		'resource_id',
		'user_id',
		'time_started',
		'time_ended',
		'total_time',
	];
}
