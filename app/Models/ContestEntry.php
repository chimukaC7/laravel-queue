<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\NewEntryReceivedEvent;

class ContestEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
    ];

    protected static function booted() {
        static::created(function ($contestEntry) {
            NewEntryReceivedEvent::dispatch();
        });
    }
}
