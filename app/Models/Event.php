<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'image',
        'status',
        'start_time',
        'end_time',
        'is_active'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Accessor for image URL
    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->image) {
                    return null;
                }

                // If image starts with http, return as-is (external URL)
                if (str_starts_with($this->image, 'http')) {
                    return $this->image;
                }

                // Otherwise, return storage URL
                return asset('storage/' . $this->image);
            }
        );
    }

    // Accessor for formatted time remaining
    protected function timeRemaining(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->end_time) {
                    return null;
                }

                $now = Carbon::now();
                $endTime = Carbon::parse($this->end_time);

                if ($endTime->isPast()) {
                    return '已结束';
                }

                $diff = $now->diff($endTime);
                
                if ($diff->days > 0) {
                    return sprintf('%d天 %02d小时 %02d分', $diff->days, $diff->h, $diff->i);
                } else {
                    return sprintf('%02d小时 %02d分', $diff->h, $diff->i);
                }
            }
        );
    }

    // Scope for active events
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for events by status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Check if event is ongoing
    public function isOngoing()
    {
        $now = Carbon::now();
        return $this->start_time && $this->end_time && 
               $now->between($this->start_time, $this->end_time);
    }

    // Check if event is upcoming
    public function isUpcoming()
    {
        return $this->start_time && Carbon::now()->lt($this->start_time);
    }

    // Check if event has ended
    public function hasEnded()
    {
        return $this->end_time && Carbon::now()->gt($this->end_time);
    }
}
