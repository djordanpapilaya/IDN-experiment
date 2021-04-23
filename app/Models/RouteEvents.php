<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteEvents extends Model
{
	use HasFactory;

	protected $primaryKey = 'id';

	protected $table = 'route_events';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'session_id',
		'resource_id',
		'user_id',
		'user_id',
	];
}
