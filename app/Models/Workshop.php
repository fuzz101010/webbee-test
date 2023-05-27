<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use App\Models\Event;

class Workshop extends Model
{
    public function event(){
        return $this->belongsTo(Event::class);
    }

    public static function getEventStartDates()
    {
        return static::select('event_id', \DB::raw('MIN(start) as start'))
            ->groupBy('event_id');
    }
}
