<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Resource extends Model
{
	use HasFactory;

	protected $primaryKey = 'id';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'uuid',
		'type',
		'path',
		'title',
		'copy',
		'image_path',
	];

	protected $hidden = [
		'id'
	];

	public $timestamps = true;

	protected $appends = [
		'watched'
	];

	protected static function boot()
	{
		parent::boot();

		static::creating(function( $query ) {

			$query->uuid = Str::uuid()->toString();

		});

	}

	public function getRouteKeyName()
	{
		return 'uuid';
	}

	public function getWatchedAttribute()
	{
		if ($this->routeevents() !== null) {
			$count = $this->routeevents()->count();

			if ($count > 0) {
				return true;
			}
		}

		return false;
	}

	public function routeevents()
	{
		if (\Auth::user()) {
			$user_id = \Auth::user()->id;

			return $this->hasMany('\App\Models\RouteEvents', 'resource_id', 'id')
				->where('user_id', $user_id);
		}

		return null;
	}
}
