<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
</head>

<body style="background-color: rgb(216, 219, 221);">

    <div class=" container rounded-3 bg-light mt-5 p-4 shadow " style="width: 500px ">

        <h3 class=" text-secondary text-center fw-bold mb-5 " style="padding-top:15px"><i class="fas fa-graduation-cap"></i>  Student Registration</h3>

        <form action=" " method="post" enctype="multipart/form-data">
            @csrf
            <!-- Full Name section -->
            <div class="mx-5 my-4 ">
                <label for="fullName " class="form-label fw-bold ">Full Name:</label>
                <div class="input-group ">
                    <span class="input-group-text "> <i class="fas fa-user "></i></span>
                    <input type="text " name="fullName" class="form-control rounded-end " id="fullName " placeholder="Enter Your Full Name" value="{{ old('fullName')}}">
                </div>
                @if ($errors->get('fullName') !=null)
                    <br>
                    <div class="alert alert-danger p-0 mt-1 ps-2" role="alert">
                        @foreach ($errors->get('fullName') as $error)
                        <li>{{$error}}</li>
                        @endforeach


                    </div>

                @endif
            </div>
            <!-- User name section -->
            <div class="mx-5 my-4 ">
                <label for="uname " class="form-label fw-bold ">Username:</label>
                <div class="input-group ">
                    <span class="input-group-text "> <i class="fas fa-at "></i></span>
                    <input type="text " name="uname" class="form-control rounded-end " id="uname " placeholder="Enter a Username " value="{{ old('uname')}}">
                </div>
                @if ($errors->get('uname') != null)
                    <br>
                    <div class="alert alert-danger p-0 mt-1 ps-2" role="alert">
                        @foreach ($errors->get('uname') as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Password section -->
            <div class="mx-5 my-4 ">
                <label for="password " class="form-label fw-bold ">Password:</label>
                <div class="input-group ">
                    <span class="input-group-text "> <i class="fas fa-key "></i></span>
                    <input type="password" name="password" class="form-control rounded-end " id="password " placeholder="Enter a Password ">
                </div>
                @if ($errors->get('password') != null)
                    <br>
                    <div class="alert alert-danger p-0 mt-1 ps-2" role="alert">
                        @foreach ($errors->get('password') as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif
            </div>
            <!-- Confirm Password section -->
            <div class="mx-5 my-4 ">
                <label for="cpassword" class="form-label fw-bold ">Confirm Password:</label>
                <div class="input-group ">
                    <span class="input-group-text "> <i class="fas fa-key "></i></span>
                    <input type="password" name="cpassword" class="form-control rounded-end " id="cpassword " placeholder="Confirm Password ">
                </div>
                @if ($errors->get('cpassword') != null)
                    <br>
                    <div class="alert alert-danger p-0 mt-1 ps-2" role="alert">
                        @foreach ($errors->get('cpassword') as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif
            </div>
            <!-- Email section -->
            <div class="mx-5 my-4 ">
                <label for="email " class="form-label fw-bold ">Email:</label>
                <div class="input-group ">
                    <span class="input-group-text "> <i class="fas fa-envelope "></i></span>
                    <input type="email" name="email" class="form-control rounded-end " id="email " placeholder="Enter Your Email " value="{{ old('email')}}">
                </div>
                @if ($errors->get('email') != null)
                    <br>
                    <div class="alert alert-danger p-0 mt-1 ps-2" role="alert">
                        @foreach ($errors->get('email') as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif
            </div>
            <!-- Contact section -->
            <div class="mx-5 my-4 ">
                <label for="contact " class="form-label fw-bold ">Contact Number:</label>
                <div class="input-group ">
                    <span class="input-group-text "> <i class="fas fa-phone "></i></span>
                    <input type="text " name="contact" class="form-control rounded-end " id="contact " placeholder="Enter Your Contact Number " value="{{ old('contact')}}">
                </div>
                @if ($errors->get('contact') != null)
                    <br>
                    <div class="alert alert-danger p-0 mt-1 ps-2" role="alert">
                        @foreach ($errors->get('contact') as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif
            </div>
            <!-- Address section -->
            <div class="mx-5 my-4 ">
                <label for="address " class="form-label fw-bold ">Address:</label>
                <div class="input-group ">
                    <span class="input-group-text "> <i class="fas fa-address-card"></i></span>
                    <input type="text " name="address" class="form-control rounded-end " id="address " placeholder="Enter Your Address " value="{{ old('address')}}">
                </div>
                @if ($errors->get('address') != null)
                    <br>
                    <div class="alert alert-danger p-0 mt-1 ps-2" role="alert">
                        @foreach ($errors->get('address') as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Level section -->
            <div class="mx-5 my-4 ">
                <label for="level" class="form-label fw-bold ">Class:</label>
                <div class="input-group ">
                    <span class="input-group-text "> <i class="fas fa-landmark"></i></span>
                    <input type="text" name="level" class="form-control rounded-end " id="address " placeholder="Eg: BSc. 3rd Year" value="{{ old('level')}}">
                </div>
                @if ($errors->get('level') != null)
                    <br>
                    <div class="alert alert-danger p-0 mt-1 ps-2" role="alert">
                        @foreach ($errors->get('level') as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Image Upload --}}

            <div class="mx-5 my-4 ">
                <label for="image " class="form-label fw-bold ">Profile Picture:</label>
                <div class="input-group ">
                    <span class="input-group-text "> <i class="fas fa-camera"></i></span>
                    <input type="file" class="form-control" id="customFile" name="image" multiple="multiple"/>
                </div>
                @if ($errors->get('image') != null)
                    <br>
                    <div class="alert alert-danger p-0 mt-1 ps-2" role="alert">
                        @foreach ($errors->get('image') as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Registration -->
            <div class="d-flex justify-content-center my-2 ">
                <button type="submit " name="Submit" class="btn btn-lg btn-success px-sm-4 ">Register</button>
            </div>

            <div class="text-start mx-5 my-3 d-flex justify-content-center">
                <a class="link-info " href="/login">Already Registered?</a>
            </div>
         </form>

    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js " integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ==" crossorigin=" anonymous " referrerpolicy="no-referrer "></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js " integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p " crossorigin="anonymous "></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js " integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT " crossorigin="anonymous "></script>


</body>

</html>
