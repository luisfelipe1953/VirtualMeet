<?php

namespace App\Models;

use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Record extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    const ONE = 1;
    const TWO = 2;
    const TREE = 3;
    const ZERO = 4;


    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'events_records', 'record_id', 'event_id');
    }
}
