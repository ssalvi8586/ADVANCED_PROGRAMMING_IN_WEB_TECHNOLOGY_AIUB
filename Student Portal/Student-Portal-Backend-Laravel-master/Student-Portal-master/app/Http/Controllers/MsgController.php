<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;

class MsgController extends Controller
{
    public function index($rcv){
        $tempUser = User::where('uname', $rcv)
            ->first();
        $msgs = Message::with('reciver','sender')->where('fr_reciver_id','=',$tempUser->id)
                                                    ->where('fr_sender_id','=',session()->get('id'))
                                                    ->get();

        return view('message.index')->with('msgs',$msgs);
    }
}
