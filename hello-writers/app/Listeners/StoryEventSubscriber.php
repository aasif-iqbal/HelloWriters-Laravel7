<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;

class StoryEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function handleStoryCreated($event)
    {
        Log::info('[inside subscriber]A Story with title `' . $event->title . '` was Added.');
    }

    /**
     * Handle user logout events.
     */
    public function handleStoryEdited($event)
    {
        Log::info('[inside subscriber]A Story with title `' . $event->title . '` was Edited.');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\StoryCreated',
            'App\Listeners\StoryEventSubscriber@handleStoryCreated'
        );

        $events->listen(
            'App\Events\StoryEdited',
            'App\Listeners\StoryEventSubscriber@handleStoryEdited'
        );
    }
}
