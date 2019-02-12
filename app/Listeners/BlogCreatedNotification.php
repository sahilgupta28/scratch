<?php

namespace App\Listeners;

use App\Events\BlogDeleted;
use App\Mail\BlogDeleted as BlogDeletedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class BlogCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BlogDeleted  $event
     * @return void
     */
    public function handle(BlogDeleted $event)
    {
        Mail::to($event->blog->owner->email)->send(new BlogDeletedMail($event->blog));
    }
}
