<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EventCard extends Component
{
    public $eventId;
    public $title;
    public $timer;
    public $image;

    /**
     * Create a new component instance.
     */
    public function __construct($eventId, $title, $timer, $image = null)
    {
        $this->eventId = $eventId;
        $this->title = $title;
        $this->timer = $timer;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.event-card');
    }
}
