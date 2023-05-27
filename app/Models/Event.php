<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Workshop;

class Event extends Model
{

    public function workshops(){
        return $this->hasMany(Workshop::class);
    }

    public function scopeNotStarted($query){
        return $query->joinSub(Workshop::getEventStartDates(), 'ws', function ($join) {
            $join->on('events.id', '=', 'ws.event_id');
        })->where('ws.start', '>', \DB::raw('CURRENT_TIMESTAMP'));
    }

}
