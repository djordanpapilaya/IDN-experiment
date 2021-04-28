<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioEvents extends Model
{
	use HasFactory;

	protected $primaryKey = 'id';

	protected $table = 'audio_events';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'session_id',
		'resource_id',
		'user_id',
		'start_time',
		'end_time',
		'sequence_time',
	];
}
