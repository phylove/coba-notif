<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\TestNotif;

class NotifController extends Controller
{
    public function push(Request $request)
    {
        if($request->has('message')){
            $message = $request->message;
            // if($message!=''){
                event(new TestNotif($message));
            // }

        }
    }
}
