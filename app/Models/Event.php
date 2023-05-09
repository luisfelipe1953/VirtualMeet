<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;


    public $guarded = [];
  
    

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function time(): BelongsTo
    {
        return $this->belongsTo(Time::class);
    }

    public function speaker(): BelongsTo
    {
        return $this->belongsTo(Speaker::class);
    }

    public function day(): BelongsTo
    {
        return $this->belongsTo(Day::class);
    }

    public function record(): BelongsToMany
    {
        return $this->belongsToMany(Record::class, 'events_records', 'record_id', 'event_id');
    }

}
