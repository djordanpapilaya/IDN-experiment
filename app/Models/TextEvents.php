<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextEvents extends Model
{
	use HasFactory;

	protected $primaryKey = 'id';

	protected $table = 'text_events';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'session_id',
		'resource_id',
		'user_id',
		'page_visit',
	];
}
