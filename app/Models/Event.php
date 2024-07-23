<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Event extends Model
{
    use SoftDeletes;

    const TYPE = [
        'news' => 'News',
        'event' => 'Events',
    ];

    protected static $rows = [
        'hello-smile-hk-x-chickensoup-foundation-2' => [
            'name' => 'Hello Smile HK x ChickenSoup Foundation',
            'type' => 'news',
            'banner' => 'assets/web/assets/img/event/post-img-1.png',
            'date' => '2023/03/11'
        ],
        'hello-smile-hk-x-faith-in-love-foundation' => [
            'name' => 'Hello Smile HK x Faith in Love Foundation',
            'type' => 'event',
            'banner' => 'assets/web/assets/img/event/post-img-2.png',
            'date' => '2022/11/20'
        ],
        'hello-smile-hk-x-soco' => [
            'name' => 'Hello Smile HK x SoCo',
            'type' => 'news',
            'banner' => 'assets/web/assets/img/event/post-img-3.png',
            'date' => '2022/10/15',
        ],
        'hello-smile-hk-x-chickensoup-foundation' => [
            'name' => 'Hello Smile Hk x ChickenSoup Foundation',
            'banner' => 'assets/web/assets/img/event/post-img-4.png',
            'type' => 'news',
            'date' => '2022/09/03'
        ],
    ];

    public static function getAllEvents()
    {
        $events = self::$rows;
        foreach ($events as $slug => &$event) {
            $event['banner'] = url($event['banner']);
            $event['slug'] = $slug;
        }
        return $events;
    }

    public static function getLatestEvents($limit, $type = null)
    {
        $events = self::getAllEvents();

        foreach ($events as $slug => &$event) {
            $event['date'] = Carbon::createFromFormat('Y/m/d', $event['date']);
        }
        
        if ($type) {
            $events = array_filter($events, function ($event) use ($type) {
                return $event['type'] === $type;
            });
        }

        usort($events, function ($a, $b) {
            return $b['date']->timestamp - $a['date']->timestamp;
        });

        return array_slice($events, 0, $limit);
    }

    public static function getEventBySlug($slug)
    {
        return self::$rows[$slug] ?? null;
    }
}
