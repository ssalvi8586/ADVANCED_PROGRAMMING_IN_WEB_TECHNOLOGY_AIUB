<?php

namespace App\Http\Controllers;

use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function Index()
    {
        return view('login.index');
    }
    public function Verify(Request $req)
    {

        $user = User::where('uname', $req->input('uname'))
            ->first();
        $password = $req->input('password');
        // $type = $user->type;
        // $name = User::with($type)->where('uname',$req->input('uname'))->first();
        // dd($user);

        if ($user !== null) {
            $type = $user->type;
            $name = User::with($type)->where('uname', $req->input('uname'))->first();

            if ($user->password === $password) {
                // if(Hash::check($req->input('password'))){
                if($user->status === -1) {
                    session()->flash('decline', 'Your Moderator account request has been declined by admin');
                    return redirect()->route('home');
                }

                if ($user->status === -1) {
                    session()->flash('decline', 'Your' . $user->type . 'account request has been declined by admin');
                    return redirect()->route('home');
                }
                elseif($user->status === 4) {
                    session()->flash('msg', 'Your ' . $user->type . ' account request pending by moderator');
                    return redirect()->route('login.index');
                }

                $req->session()->put('uname', $user->uname);
                $req->session()->put('id', $user->id);
                $req->session()->put('type', $user->type);
                $req->session()->put('status', $user->status);
                $req->session()->put('name', $name->$type->name);
                return redirect()->route('home');

                // }
            } else {

                $req->session()->flash('error', 'Invalid username or password!');
                // return redirect('/login');
                return redirect()->route('login.index');
            }
        } else {
            $req->session()->flash('error', 'Invalid username or password!');
            // return redirect('/login');
            return redirect()->route('login.index');
        }

    }
    public function apiVerify(Request $req)
    {

        $user = User::where('uname', $req->input('uname'))->first();
        $password = $req->input('password');
        $error = [];
        if ($user !== null) {
            $type = $user->type;
            $name = User::with($type)->where('uname', $req->input('uname'))->first();
            if ($user->password === $password) {
                if($user->status === -1) {
                    $error['error'] = 'Your Moderator account request has been declined by admin';
                    return $error;
                }

                if ($user->status === -1) {
                    $error['error'] = 'Your' . $user->type . 'account request has been declined by admin';
                    return $error;
                }
                else if($user->status === 4) {
                    $error['msg'] = 'Your ' . $user->type . ' account request pending by moderator';
                    return $error;
                }
                $user->token = Hash::make(Str::random(60));
                $user->timestamps = false;
                $user->save();
                return response()->json([
                    "token" => $user->token,
                    "id" => $user->id,
                    "uname" => $user->uname,
                    "type" => $user->type
                ]);

            } else {
                $error['error'] = 'Invalid username or password!';
                return $error;
            }
        } else {
            $error['error'] = 'Invalid username or password!';
            return $error;
        }

    }
}
