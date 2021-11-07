<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LogoutController extends Controller
{
    public function index(Request $req){

        $req->session()->flush();
        return redirect()->route('login.index');
    }
    public function apiLogout(Request $req) {
        $user = User::find($req->header('id'));
        $user->token = null;
        $user->timestamps = false;
        $user->save();

        return response()->json('Successfully Logged out', 200);
    }
}
