<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Models\User;

class BroadcastUserCreated
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
    * @param  object  $event
    * @return void
    */
   public function handle(User $event)
   {
      broadcast(new UserCreated($event->user));
   }
}
