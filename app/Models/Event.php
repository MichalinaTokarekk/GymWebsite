<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Tariff;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $fillable = [
		'title', 
		'start',
		'end',
		'trainer_id',
		'max_participants',
		'current_participants',
		'status'
	];

	public function users()
	{
		return $this->belongsToMany(User::class);
	}

	public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

	public static function getUpcomingEvents()
    {
        $currentDate = Carbon::now();
        $tomorrowDate = $currentDate->copy()->addDay();

        return self::where('start', '>=', $tomorrowDate)->get();
    }


}
