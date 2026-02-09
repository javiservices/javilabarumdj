<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'event_date',
        'location',
        'booking_url',
        'image',
        'is_active',
        'google_event_id',
        'synced_at',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'is_active' => 'boolean',
        'synced_at' => 'datetime',
    ];
    
    /**
     * Boot method to generate slug automatically
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = static::generateUniqueSlug($event->title);
            }
        });
        
        static::updating(function ($event) {
            if ($event->isDirty('title') && empty($event->slug)) {
                $event->slug = static::generateUniqueSlug($event->title);
            }
        });
    }
    
    /**
     * Generate a unique slug from title
     */
    public static function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = static::where('slug', 'LIKE', "{$slug}%")->count();
        
        return $count ? "{$slug}-{$count}" : $slug;
    }
    
    /**
     * Get the route key name for Laravel routing
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
