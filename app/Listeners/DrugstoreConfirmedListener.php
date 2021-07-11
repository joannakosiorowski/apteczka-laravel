<?php

namespace App\Listeners;

use App\Events\DrugstoreConfirmedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\{Drugstore, Notification};
use Illuminate\Http\Request;

class DrugstoreConfirmedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Drugstore $newdrugstore)
    {
        $this->newdrugstore = $newdrugstore;
    }

    /**
     * Handle the event.
     *
     * @param  DrugstoreConfirmedEvent  $event
     * @return void
     */
    public function handle(DrugstoreConfirmedEvent $event)
    {
        Notification::create([
            'user_id' => $id = $event->newdrugstore->user_id,
            'content' => 'Została utworzona nowa apteczka',
            'status' => 0


        ]);

              //trzeba stworzyc klucz w pamieci ram dzieki ktoremu bedzie mozna wyjsc z petli while
              $memcache = new \Memcache();
              $memcache->addServer('localhost', 11211) or die("Could not connect");
              $memcache->set('userid_'.$id.'_notification_timestamp', time());
  
    }
}
