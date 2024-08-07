<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use SoftDeletes;

    public const STATUS = [
        'ACTIVE' => 1,
        'INACTIVE' => 0,
    ];

    public const TYPE = [
        'News' => 'news',
        'Event' => 'events',
    ];

    protected $table = 'event';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'name',
        'status',
        'sort',
        'published_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date('Y-m-d H:i:s', strtotime($value)),
        );
    }

    protected function eventDescription(): HasMany
    {
        return $this->hasMany(EventDescription::class);
    }

    public function eventGallery(): HasMany
    {
        return $this->hasMany(EventGallery::class);
    }

    public function publishedDate()
    {
        return Carbon::parse($this->published_at)->format('Y/m/d');
    }

    // protected static $rows = [
    //     'hello-smile-hk-x-chickensoup-foundation-2' => [
    //         'name' => 'Hello Smile HK x ChickenSoup Foundation',
    //         'type' => 'news',
    //         'banner' => 'assets/web/assets/img/event/post-img-1.png',
    //         'date' => '2023/03/11'
    //     ],
    //     'hello-smile-hk-x-faith-in-love-foundation' => [
    //         'name' => 'Hello Smile HK x Faith in Love Foundation',
    //         'type' => 'event',
    //         'banner' => 'assets/web/assets/img/event/post-img-2.png',
    //         'date' => '2022/11/20'
    //     ],
    //     'hello-smile-hk-x-soco' => [
    //         'name' => 'Hello Smile HK x SoCo',
    //         'type' => 'news',
    //         'banner' => 'assets/web/assets/img/event/post-img-3.png',
    //         'date' => '2022/10/15',
    //     ],
    //     'hello-smile-hk-x-chickensoup-foundation' => [
    //         'name' => 'Hello Smile Hk x ChickenSoup Foundation',
    //         'banner' => 'assets/web/assets/img/event/post-img-4.png',
    //         'type' => 'news',
    //         'date' => '2022/09/03'
    //     ],
    // ];

    // public static function getAllEvents()
    // {
    //     $events = self::$rows;
    //     foreach ($events as $slug => &$event) {
    //         $event['banner'] = url($event['banner']);
    //         $event['slug'] = $slug;
    //     }
    //     return $events;
    // }

    // public static function getLatestEvents($limit, $type = null)
    // {
    //     $events = self::getAllEvents();

    //     foreach ($events as $slug => &$event) {
    //         $event['date'] = Carbon::createFromFormat('Y/m/d', $event['date']);
    //     }
        
    //     if ($type) {
    //         $events = array_filter($events, function ($event) use ($type) {
    //             return $event['type'] === $type;
    //         });
    //     }

    //     usort($events, function ($a, $b) {
    //         return $b['date']->timestamp - $a['date']->timestamp;
    //     });

    //     return array_slice($events, 0, $limit);
    // }

    // public static function getEventBySlug($slug)
    // {
    //     return self::$rows[$slug] ?? null;
    // }

    public function getParameters(string $params, string $column = null)
    {
        $language = $this->eventDescription->where('language', $params)->first();
        if (!$language || ($column && !$language->$column)) {
            $language = $this->eventDescription->where('language', 'en')->first();
        }

        return $column ? $language->$column : $language;
    }
}
