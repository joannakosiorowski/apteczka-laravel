<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Notification};

class NotificationController extends Controller
{
    


    /* Lecture 50 */
    public function ajaxSetReadNotification(Request $request)
    {
  
        return Notification::where('id',$request->input('id'))->update(['status'=>1]); //po kliknieciu w powiadomienie w DB ma zmienic sie statuss
    }
    
    
    /* Lecture 51 */
    public function ajaxGetNotShownNotifications(Request $request)
    {

      /*  set_time_limit(0);
    
        $memcache = new \Memcache();

        $memcache->addServer('localhost', 11211) or die("Could not connect");

        $currentmodif = (int) $memcache->get('userid_' . $request->user()->id . '_notification_timestamp');

        $lastmodif = $request->input('timestamp') ?? 0;

        $start = microtime(true);

        $response = array();


        while ($currentmodif <= $lastmodif)
        {

            if ( (microtime(true) - $start) > 10)
            {
               json_encode($response);
            }


            sleep(0.1);
            $currentmodif = (int) $memcache->get('userid_' . $request->user()->id . '_notification_timestamp'); //pobranie klucza

        }
        
        
     

        // executed if while loop ends
        $response['notifications'] = Notification::where('user_id',$request->user()->id)->where('shown', 0)->get();
        $response['timestamp'] = $currentmodif;

        return json_encode($response);*/
    }

    public function ajaxSetShownNotifications(Request $request)
    {
        return Notification::whereIn('id', $request->input('idsOfNotShownNotifications'))->update(['shown'=>1]); //whereIn gdzie wszystkie, ids to tablica

    }

}
