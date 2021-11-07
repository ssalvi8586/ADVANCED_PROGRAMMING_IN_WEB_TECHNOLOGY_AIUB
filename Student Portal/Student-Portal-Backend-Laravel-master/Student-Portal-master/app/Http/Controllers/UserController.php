<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\editRequest;
use App\Models\User;
use App\Models\Slink;
use App\Models\Post;
use App\Models\moderator;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\Admin;
use App\Models\Qualification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function view(Request $req, $uname)
    {
        $tempUser = User::where('uname', $uname)
            ->first();
        $slinks = Slink::where('fr_user_id', $tempUser->id)->get();

        $tempIns = Instructor::where('fr_user_id', $tempUser->id)
            ->first();

        $posts = PostController::all()->where('fr_user_id', $tempUser->id);
        $user = User::with($tempUser->type)->where('uname', $uname)->first();
        //dd($user);
        if (session()->get('type') == 'instructor') {
            $qalifications = Qualification::where('fr_instructor_id', $tempIns->id)->get();
            return view('profile.view')->with('user', $user)
                ->with('type', $tempUser->type)
                ->with('posts', $posts)
                ->with('slinks', $slinks)
                ->with('qualifications', $qalifications);
        } else {
            return view('profile.view')->with('user', $user)
                ->with('type', $tempUser->type)
                ->with('posts', $posts)
                ->with('slinks', $slinks);
        }
    }
    public function apiGetAll()
    {
        $users = User::all();
        return response()->json($users, 200);
    }
    public function apiViewUser($id)
    {
        $tempUser = User::where('id', (int)$id)
            ->first();
        $slinks = Slink::where('fr_user_id', $tempUser->id)->get();

        $tempIns = Instructor::where('fr_user_id', $tempUser->id)
            ->first();

        $qualifications = Qualification::where('fr_instructor_id', $tempUser->id)->get();
        $posts = PostController::all()->where('fr_user_id', $tempUser->id)->values();
        // $post = Post::with('comment', 'vote')->where('fr_user_id', $tempUser->id                           ->get();
        $user = User::with($tempUser->type)->where('id', (int)$id)->first();
        // To prevent different key names for different user types
        $user->details = $user[$tempUser->type];
        unset($user[$tempUser->type]);
        // Sending full url to serve image from api
        $user->details->image = url('/') . '/upload/' . $user->details->image;
        //dd($user);
        return response()->json([
            'user' => $user,
            'type' => $tempUser->type,
            'posts' => $posts,
            'slinks' => $slinks,
            'qualifications' => $qualifications
        ]);
    }
    public function apiDelete($id)
    {
        $user = User::find($id);
        if ($user === null) {
            return response()->json('User not found', 404);
        }
        $userDetails = '';

        if ($user->type === 'admin') {
            $userDetails = Admin::where('fr_user_id', $user->id);
        } else if ($user->type === 'moderator') {
            $userDetails = moderator::where('fr_user_id', $user->id);
        } else if ($user->type === 'instructor') {
            $userDetails = Instructor::where('fr_user_id', $user->id);
        } else if ($user->type === 'student') {
            $userDetails = Student::where('fr_user_id', $user->id);
        }
        $userDetails->delete();
        $user->delete();
        return response()->json($user, 200);
    }
    public function edit(Request $req)
    {
        $tempUser = User::where('uname', $req->session()->get('uname'))
            ->first();
        $slinks = Slink::where('fr_user_id', $tempUser->id)->get();
        $user = User::with($tempUser->type)->where('uname', $req->session()->get('uname'))->first();
        return view('profile.edit')->with('user', $user)
            ->with('type', $tempUser->type)
            ->with('slinks', $slinks);
    }

    public function apiBan($id)
    {
        $user = User::find($id);
        if ($user === null) return response()->json('User not found', 404);
        $user->banned = 1;
        return response()->json($user, 200);
    }
    public function apiUnban($id)
    {
        $user = User::find($id);
        if ($user === null) return response()->json('User not found', 404);
        $user->banned = 0;
        return response()->json($user, 200);
    }
    public function apiToggleBan($id)
    {
        $user = User::find($id);
        if ($user === null) return response()->json('User not found', 404);
        $user->banned = !$user->banned;
        $user->timestamps = false;
        $user->save();
        return response()->json($user, 200);
    }
    // public function update(editRequest $req)
    // {


    //     if ($req->has('form1')) {
    //         $type = $req->session()->get('type');
    //         $req->validate([
    //             'name'      => 'required|min:3',
    //             'email'     => 'required',
    //             'contact'   => 'required|regex:/(01)[0-9]{9}/',
    //             'address'   => 'required'
    //         ]);

    //         if ($type == 'moderator') {
    //             moderator::where('fr_user_id', $req->session()->get('id'))
    //                 ->update([
    //                     'name' => $req->name,
    //                     'email' => $req->email,
    //                     'address' => $req->address,
    //                     'updated_at' => Carbon::now(),
    //                     'contact' => $req->contact
    //                 ]);

    //             $req->session()->flash('msg', 'Update Successful');
    //             return redirect()->route('profile.edit');
    //         } elseif ($type == 'instructor') {
    //             instructor::where('fr_user_id', $req->session()->get('id'))
    //                 ->update([
    //                     'name' => $req->name,
    //                     'email' => $req->email,
    //                     'address' => $req->address,
    //                     'updated_at' => Carbon::now(),
    //                     'contact' => $req->contact
    //                 ]);

    //             $req->session()->flash('msg', 'Update Successful');
    //             return redirect()->route('profile.edit');
    //         } elseif ($type == 'student') {
    //             student::where('fr_user_id', $req->session()->get('id'))
    //                 ->update([
    //                     'name'       => $req->name,
    //                     'email'      => $req->email,
    //                     'address'    => $req->address,
    //                     'updated_at' => Carbon::now(),
    //                     'contact'    => $req->contact
    //                 ]);

    //             $req->session()->flash('msg', 'Update Successful');
    //             return redirect()->route('profile.edit');
    //         }
    //     } elseif ($req->has('form2')) {
    //         $req->validate([
    //             'oldpass'       => 'required',
    //             'newpass'       => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
    //             'confirmpass'   => 'required|same:newpass'
    //         ]);
    //         if ($req->newpass != null) {
    //             if ($req->newpass === $req->confirmpass) {
    //                 $user = User::where('uname', $req->session()->get('uname'))


    //                     ->first();
    //                 $password = $user->password;

    //                 if ($req->oldpass == $password) {
    //                     User::where('uname', $req->session()->get('uname'))
    //                         ->update([
    //                             'password' => $req->newpass
    //                         ]);
    //                     $req->session()->flash('msg', 'Update Successful');
    //                     return redirect()->route('profile.edit');
    //                 } else {
    //                     $req->session()->flash('error', 'Give Old Password');
    //                     return redirect()->route('profile.edit');
    //                 }
    //             } else {
    //                 $req->session()->flash('error', 'Confirm New Password Correctly');
    //                 return redirect()->route('profile.edit');
    //             }
    //         } else {

    //             $req->session()->flash('error', 'Fill All the Fields');
    //             return redirect()->route('profile.edit');
    //         }
    //     }
    // }


    public function changeRole(Request $req)
    {
        $user = User::where('id', (int)$req->input('id'))->with($req->input('prev_type'))->first();
        $user_details = null;
        $new_user = null;
        if ($req->input('prev_type') === 'admin') {
            $user_details = $user->admin;
        } else if ($req->input('prev_type') === 'moderator') {
            $user_details = $user->moderator;
        } else if ($req->input('prev_type') === 'instructor') {
            $user_details = $user->instructor;
        } else if ($req->input('prev_type') === 'student') {
            $user_details = $user->student;
        }

        if ($req->input('type') === 'admin') {
            $new_user = new Admin();
        } else if ($req->input('type') === 'moderator') {
            $new_user = new moderator();
        } else if ($req->input('type') === 'instructor') {
            $new_user = new Instructor();
        } else if ($req->input('type') === 'student') {
            $new_user = new Student();
        }

        $new_user->contact = $user_details->contact;
        $new_user->email = $user_details->email;
        $new_user->name = $user_details->name;
        $new_user->image = $user_details->image;
        $new_user->fr_user_id = $user_details->fr_user_id;
        $new_user->save();
        $user_details->delete();

        $user->type = $req->input('type');
        $user->timestamps = false;
        $user->update();

        return redirect()->route('admin.users.view', ['id' => $req->input('id')]);
    }
    public function apiChangeRole(Request $req)
    {
        $user = User::where('id', (int)$req->input('id'))->with($req->prev_type)->first();

        $user_details = null;
        $new_user = null;
        if ($req->prev_type === 'admin') {
            $user_details = Admin::where('fr_user_id', $req->id)->first();
        } else if ($req->prev_type === 'moderator') {
            $user_details = moderator::where('fr_user_id', $req->id)->first();
        } else if ($req->prev_type === 'instructor') {
            $user_details = Instructor::where('fr_user_id', $req->id)->first();
        } else if ($req->prev_type === 'student') {
            $user_details = Student::where('fr_user_id', $req->id)->first();
        }

        if ($req->type === 'admin') {
            $new_user = new Admin();
        } else if ($req->type === 'moderator') {
            $new_user = new moderator();
        } else if ($req->type === 'instructor') {
            $new_user = new Instructor();
        } else if ($req->type === 'student') {
            $new_user = new Student();
        }

        $new_user->contact = $user_details->contact;
        $new_user->email = $user_details->email;
        $new_user->name = $user_details->name;
        $new_user->image = $user_details->image;
        $new_user->fr_user_id = $user_details->fr_user_id;
        $new_user->save();
        $user_details->delete();

        $user->type = $req->type;
        $user->timestamps = false;
        $user->update();


        return response()->json($user, 200);
    }
    public function apiView(Request $req, $uname)
    {
        $tempUser = User::where('uname', $uname)
            ->first();
        $userProfile = [];
        if ($tempUser->type === 'instructor') {
            $userProfile  = Instructor::where('fr_user_id', $tempUser->id)
                ->first();
        } elseif ($tempUser->type === 'admin') {
            $userProfile  = Admin::where('fr_user_id', $tempUser->id)
                ->first();
        } elseif ($tempUser->type === 'student') {
            $userProfile  = Student::where('fr_user_id', $tempUser->id)
                ->first();
        } else {
            $userProfile  = Moderator::where('fr_user_id', $tempUser->id)
                ->first();
        }

        $slinks = Slink::where('fr_user_id', $tempUser->id)->get();
        $qalifications = [];
        if ($tempUser->type === 'instructor') {
            $tempIns = Instructor::where('fr_user_id', $tempUser->id)
                ->first();
            $qalifications = Qualification::where('fr_instructor_id', $tempIns->id)->get();
        }
        $posts = PostController::all()->where('fr_user_id', $tempUser->id)->values();
        $user = User::with($tempUser->type)->where('uname', $uname)->first();

        return response()->json([
            "user" => $user,
            "posts" => $posts,
            "slinks" => $slinks,
            "profileInfo" => $userProfile,
            "qualifications" => $qalifications
        ], 200);
    }
    // public function apiUpdate(editRequest $req)
    // {
    //     $validator = Validator::make($req->all(), [
    //         'name'      => 'required|min:3',
    //         'email'     => 'required',
    //         'contact'   => 'required|regex:/(01)[0-9]{9}/',
    //         'address'   => 'required'
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json($validator->errors()->getMessages(), 200);
    //     }

    //     $type = $req->user->type;
    //     if ($type == 'moderator') {
    //         moderator::where('fr_user_id', $req->user->id)
    //             ->update([
    //                 'name' => $req->name,
    //                 'email' => $req->email,
    //                 'address' => $req->address,
    //                 'updated_at' => Carbon::now(),
    //                 'contact' => $req->contact
    //             ]);
    //         $req->session()->flash('msg', 'Update Successful');
    //         return redirect()->route('profile.edit');
    //     } elseif ($type == 'instructor') {
    //         instructor::where('fr_user_id', $req->user->id)
    //             ->update([
    //                 'name' => $req->name,
    //                 'email' => $req->email,
    //                 'address' => $req->address,
    //                 'updated_at' => Carbon::now(),
    //                 'contact' => $req->contact
    //             ]);

    //         return response()->json(["msg" => "Update Successful"], 200);
    //     } elseif ($type == 'student') {
    //         student::where('fr_user_id', $req->user->id)
    //             ->update([
    //                 'name' => $req->name,
    //                 'email' => $req->email,
    //                 'address' => $req->address,
    //                 'updated_at' => Carbon::now(),
    //                 'contact' => $req->contact
    //             ]);

    //         return response()->json(["msg" => "Update Successful"], 200);
    //     } elseif ($req->newpass != null) {
    //         if ($req->newpasse === $req->confirmpass) {
    //             $user = User::where('uname', $req->user->uname)
    //                 ->first();
    //             $password = $user->password;

    //             if ($req->oldpass == $password) {
    //                 user::where('fr_user_id', $req->user->id)
    //                     ->update([
    //                         'password' => $req->newpass
    //                     ]);
    //                 return response()->json(["msg" => "Update Successful"], 200);
    //             } else {
    //                 return response()->json(["error" => "Unauthorized Access"], 200);
    //             }
    //         } else {
    //             return response()->json(["error" => "Confirm New Password Correctly"], 200);
    //         }
    //     } else {
    //         return response()->json(["error" => "Check Again"], 200);
    //     }
    // }

    //--------------For Single profile udate
    public function apiProfileUpdate(Request $req, $uname)
    {

        $validator = Validator::make($req->all(), [
            'name'      => 'required|min:3',
            'email'     => 'required',
            'contact'   => 'required|regex:/(01)[0-9]{9}/',
            'address'   => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->getMessages(), 200);
        }
        $userid = User::where('uname', $uname)->first()->id;
        $usertype = User::where('uname', $uname)->first()->type;


        if ($usertype == 'moderator') {
            moderator::where('fr_user_id', $userid)
                ->update([
                    'name' => $req->name,
                    'email' => $req->email,
                    'address' => $req->address,
                    'updated_at' => Carbon::now(),
                    'contact' => $req->contact
                ]);
            return response()->json(["msg" => "Update Successful"], 200);
        } elseif ($usertype == 'instructor') {
            instructor::where('fr_user_id', $userid)
                ->update([
                    'name' => $req->name,
                    'email' => $req->email,
                    'address' => $req->address,
                    'updated_at' => Carbon::now(),
                    'contact' => $req->contact
                ]);
            return response()->json(["msg" => "Update Successful"], 200);
        } elseif ($usertype == 'student') {
            student::where('fr_user_id', $userid)
                ->update([
                    'name' => $req->name,
                    'email' => $req->email,
                    'address' => $req->address,
                    'updated_at' => Carbon::now(),
                    'contact' => $req->contact
                ]);

            return response()->json(["msg" => "Update Successful"], 200);
        } else {
            return response()->json(["error" => "Check Again"], 200);
        }
    }

    public function apiPassUpdate(Request $req, $uname)
    {
        $userid = User::where('uname', $uname)->first()->id;
        if ($req->password != null) {

            if ($req->password === $req->cPassword) {
                $user = User::where('uname', $uname)
                    ->first();
                $password = $user->password;

                if ($req->oldPassword == $password) {

                    user::where('id', $userid)
                        ->update([
                            'updated_at' => Carbon::now(),
                            'password' => $req->password
                        ]);
                    return response()->json(["msg" => "Update Successful"], 200);
                } else {
                    return response()->json(["error" => "Old Password is Incorrect"], 200);
                }
            } else {
                return response()->json(["error" => "Confirm New Password Correctly"], 200);
            }
        }
    }

    public function apiOwnProfileDelete(Request $req, $uname)
    {
        // return $req;
        $userid = User::where('uname', $uname)->first()->id;
        $usertype = User::where('uname', $uname)->first()->type;
        if ($req->deletePassword != null) {
            $user = User::where('uname', $uname)
                ->first();
            $password = $user->password;
            if ($req->deletePassword == $password) {
                if ($usertype == 'moderator') {
                    moderator::where('fr_user_id', $userid)
                        ->delete();
                    return response()->json(["msg" => "Update Successful"], 200);
                } elseif ($usertype == 'instructor') {
                    instructor::where('fr_user_id', $userid)
                        ->delete();
                    return response()->json(["msg" => "Update Successful"], 200);
                } elseif ($usertype == 'student') {
                    student::where('fr_user_id', $userid)
                        ->delete();
                }

                user::where('id', $userid)
                    ->delete();
                return response()->json(["msg" => "Deleted Successful"], 200);
            } else {
                return response()->json(["error" => "Password is Incorrect"], 200);
            }
        } else {
            return response()->json(["error" => "Enter a Password"], 200);
        }
    }


    public function apiSearch($uname)
    {
        $users = User::where('uname', 'LIKE', $uname . '%')->get();
        $user_final = [];
        foreach ($users as $user) {
            $user_details = null;
            $new_user = null;
            if ($user->type === 'admin') {
                $user_details = Admin::where('fr_user_id', $user->id)->first();
            } else if ($user->type === 'moderator') {
                $user_details = moderator::where('fr_user_id', $user->id)->first();
            } else if ($user->type === 'instructor') {
                $user_details = Instructor::where('fr_user_id', $user->id)->first();
            } else if ($user->type === 'student') {
                $user_details = Student::where('fr_user_id', $user->id)->first();
            }
            $user_details->image = url('/') . '/upload/' . $user_details->image;
            array_push($user_final, [
                'user' => $user,
                'details' => $user_details
            ]);
        }

        return response()->json($user_final, 200);
    }
}
