<?php

namespace App\Http\Controllers;

use App\Http\Requests\modRegistrationRequest;
use App\Http\Requests\studentRegistrationRequest;
use App\Http\Requests\instructorRegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\moderator;
use App\Models\student;
use App\Models\instructor;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;


class RegistrationController extends Controller
{
    public function index(){
        return view('registration.index');
    }
    public function studentindex(){
        return view('registration.student');
    }
    public function instructorindex(){
        return view('registration.instructor');
    }
    public function moderatorindex(){
        return view('registration.moderator');
    }

    // ---------------Student Registration Validation------------------
    public function studentverify(studentRegistrationRequest $req){


        $imgName = $req->uname.'.'.$req->image->getClientOriginalExtension();
        user::insert([
            'uname' => $req->uname,
            'password' => $req->password,
            'type' => 'student',
            'status' => 1,
            'created_at' => Carbon::now()

        ]);
        //Last Id of user table
        $getUser = user::orderby('id', 'desc')->first();
        $lastId = $getUser['id'];
        student::insert([
            'name' => $req->fullName,
            'email' => $req->email,
            'address' => $req->address,
            'created_at' => Carbon::now(),
            'contact' => $req->contact,
            'level' => $req->level,
            'image' => $req->uname.'.'.$req->image->getClientOriginalExtension(),
            'fr_user_id' => $lastId
        ]);

            $file = $req->file('image');
            $file->move('upload',$imgName);

        $req->session()->flash('msg', 'Registration Successful');
        return redirect()->route('login.index');

    }
    public function apiStudentVerify(Request $req){

        $validator = Validator::make($req->all(), [
            'name'  => 'required|min:3',
            'uname'     => 'required|min:5|unique:users',
            'password'  => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$@#%]).*$/',
            'cpassword' => 'required|same:password',
            'email'     => 'required|unique:students',
            'contact'   => 'required|regex:/(01)[0-9]{9}/',
            'address'   => 'required',
            'level'     => 'required',
            'image'     => 'required|mimes:jpeg,jpg,png'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->getMessages(), 200);
        }

        $imgName = time().'.'.$req->image->getClientOriginalExtension();
        user::insert([
            'uname' => $req->uname,
            'password' => $req->password,
            'type' => 'student',
            'status' => 1,
            'created_at' => Carbon::now()

        ]);
        //Last Id of user table
        $getUser = user::orderby('id', 'desc')->first();
        $lastId = $getUser['id'];
        $student = student::insert([
            'name' => $req->name,
            'email' => $req->email,
            'address' => $req->address,
            'created_at' => Carbon::now(),
            'contact' => $req->contact,
            'level' => $req->level,
            'image' => $imgName,
            'fr_user_id' => $lastId
        ]);

        $file = $req->file('image');
        $file->move('upload',$imgName);

        return response()->json($student, 201);

    }


    // ---------------instructor Registration Validation------------------


    public function instructorverify(instructorRegistrationRequest $req){

        $imgName = $req->uname.'.'.$req->image->getClientOriginalExtension();
        user::insert([
            'uname' => $req->uname,
            'password' => $req->password,
            'type' => 'instructor',
            'status' => 4,
            'created_at' => Carbon::now()

        ]);
        //Last Id of user table
        $getUser = user::orderby('id', 'desc')->first();
        $lastId = $getUser['id'];
        instructor::insert([
            'name' => $req->name,
            'email' => $req->email,
            'address' => $req->address,
            'created_at' => Carbon::now(),
            'contact' => $req->contact,
            'image' => $req->uname.'.'.$req->image->getClientOriginalExtension(),
            'fr_user_id' => $lastId
        ]);

            $file = $req->file('image');
            $file->move('upload',$imgName);

        $req->session()->flash('msg', 'Registration Successful');
        return redirect()->route('login.index');
    }
    public function apiInstructorVerify(Request $req){

        $validator = Validator::make($req->all(), [
            'name'  => 'required|min:3',
            'uname'     => 'required|min:5|unique:users',
            'password'  => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#@%]).*$/',
            'cpassword' => 'required|same:password',
            'email'     => 'required|unique:instructors',
            'contact'   => 'required|regex:/(01)[0-9]{9}/',
            'address'   => 'required',
            'image'     => 'required|mimes:jpeg,jpg,png'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->getMessages(), 200);
        }

        $imgName = $req->uname.'.'.$req->image->getClientOriginalExtension();
        user::insert([
            'uname' => $req->uname,
            'password' => $req->password,
            'type' => 'instructor',
            'status' => 4,
            'created_at' => Carbon::now()

        ]);
        //Last Id of user table
        $getUser = user::orderby('id', 'desc')->first();
        $lastId = $getUser['id'];
        $instructor = instructor::insert([
            'name' => $req->name,
            'email' => $req->email,
            'address' => $req->address,
            'created_at' => Carbon::now(),
            'contact' => $req->contact,
            'image' => $req->uname.'.'.$req->image->getClientOriginalExtension(),
            'fr_user_id' => $lastId
        ]);

        $file = $req->file('image');
        $file->move('upload',$imgName);

        return response()->json($instructor, 201);
    }

     // ---------------Moderator Registration Validation------------------
    public function moderatorverify(modRegistrationRequest $req){
        $imgName = $req->uname.'.'.$req->image->getClientOriginalExtension();
        user::insert([
            'uname' => $req->input('uname'),
            'password' => $req->password,
            'type' => 'moderator',
            'status' => 4,
            'created_at' => Carbon::now()

        ]);
        //Last Id of user table
        $getUser = user::orderby('id', 'desc')->first();
        $lastId = $getUser['id'];
        moderator::insert([
            'name' => $req->fullName,
            'email' => $req->email,
            'created_at' => Carbon::now(),
            'contact' => $req->contact,
            'address' => $req->address,
            'image' => $req->uname.'.'.$req->image->getClientOriginalExtension(),

            'fr_user_id' => $lastId
        ]);

            $file = $req->file('image');
            $file->move('upload',$imgName);



        $req->session()->flash('msg', 'Registration Application Successful');
        return redirect()->route('login.index');
    }

    public function apiModeratorVerify(Request $req){

        $validator = Validator::make($req->all(), [
            'name'  => 'required|min:3',
            'uname'     => 'required|min:5|unique:users',
            'password'  => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$@#%]).*$/',
            'cpassword' => 'required|same:password',
            'email'     => 'required|unique:moderators',
            'contact'   => ['required','regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/'],
            'address'   => 'required',
            'image'     => 'required|mimes:jpeg,jpg,png'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->getMessages(), 200);
        }

        $imgName = $req->uname.'.'.$req->image->getClientOriginalExtension();
        user::insert([
            'uname' => $req->input('uname'),
            'password' => $req->password,
            'type' => 'moderator',
            'status' => 4,
            'created_at' => Carbon::now()

        ]);
        //Last Id of user table
        $getUser = user::orderby('id', 'desc')->first();
        $lastId = $getUser['id'];
        $moderator = moderator::insert([
            'name' => $req->fullName,
            'email' => $req->email,
            'created_at' => Carbon::now(),
            'contact' => $req->contact,
            'address' => $req->address,
            'image' => $req->uname.'.'.$req->image->getClientOriginalExtension(),

            'fr_user_id' => $lastId
        ]);

            $file = $req->file('image');
            $file->move('upload',$imgName);

        return response()->json($moderator, 201);
    }
}
