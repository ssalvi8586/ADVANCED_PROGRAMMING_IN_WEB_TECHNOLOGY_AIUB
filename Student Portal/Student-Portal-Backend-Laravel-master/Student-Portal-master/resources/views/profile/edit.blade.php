@include('header')
@if (session()->get('uname') !== null)
    @yield('header-main-logged')
@else
    @yield('header-main')
@endif

<body class="bg-light">
    <div class="container edit-profile-container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-start my-4">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                      <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</button>
                      <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Basic Info</button>
                      <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</button>
                      <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Change Password</button>
                      <button class="nav-link" id="v-pills-delete-account-tab" data-bs-toggle="pill" data-bs-target="#v-pills-delete-account" type="button" role="tab" aria-controls="v-pills-delete-account" aria-selected="false">Delete Account</button>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">Welcome To Profile Settings</div>
                      <div class="tab-pane fade my-3 ms-2" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        
                        
                        
                        <form action="" method="post">
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Full Name:</label>
                              <input type="text" name="name" value="{{$user->$type->name}}" class="form-control">
                            </div>
                            @if ($errors->get('name') !=null)
                                  <br>
                                  <div class="alert alert-danger p-0 mt-1 ps-2" role="alert">
                                      @foreach ($errors->get('name') as $error)
                                      <li>{{$error}}</li>
                                      @endforeach


                                  </div>

                            @endif
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Email address:</label>
                              <input type="text" name="email" value="{{$user->$type->email}}" class="form-control">
                            </div>
                            @if ($errors->get('email') != null)
                                <br>
                                <div class="alert alert-danger p-0 mt-1 ps-2" role="alert">
                                    @foreach ($errors->get('email') as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                </div>
                            @endif
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Phone:</label>
                              <input type="text" name="contact" value="{{$user->$type->contact}}" class="form-control">
                            </div>

                            @if ($errors->get('contact') != null)
                                <br>
                                <div class="alert alert-danger p-0 mt-1 ps-2" role="alert">
                                    @foreach ($errors->get('contact') as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                </div>
                            @endif
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Address:</label>
                              <input type="text" name="address" value="{{$user->$type->address}}" class="form-control">
                            </div>

                            @if ($errors->get('address') != null)
                                <br>
                                <div class="alert alert-danger p-0 mt-1 ps-2" role="alert">
                                    @foreach ($errors->get('address') as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                </div>
                            @endif

                            <button type="submit" name="form1" class="btn btn-primary">Submit</button>

                            @if (session('msg')!= null)
                                <div class="alert alert-success d-flex justify-content-center my-2" role="alert">
                                    {{session('msg')}}
                                </div>
                            @endif

                          </form>


                    </div>
                    
                   
                      
                      <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">ghdfdfsd</div>

                      
                      <div class="tab-pane fade ms-4 mt-4" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <form action="" method="post">
                           <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Old Password:</label>
                                <input type="password" name="oldpass" class="form-control">
                            </div>
                            @if ($errors->get('oldpass') != null)
                                
                                <div class="alert alert-danger p-0 mt-1 ps-2" role="alert">
                                    @foreach ($errors->get('oldpass') as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">New Password:</label>
                                <input type="password" name="newpass" class="form-control">
                            </div>
                            @if ($errors->get('newpass') != null)
                                
                                <div class="alert alert-danger p-0 mt-1 ps-2" role="alert">
                                    @foreach ($errors->get('newpass') as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                </div>
                            @endif


                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Confirm Password:</label>
                                <input type="password" name="confirmpass" class="form-control">
                            </div>
                            @if ($errors->get('confirmpass') != null)
                                
                                <div class="alert alert-danger p-0 mt-1 ps-2" role="alert">
                                    @foreach ($errors->get('confirmpass') as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                </div>
                            @endif



                            <button type="submit" name="form2" class="btn btn-primary">Submit</button>
                            @if (session('msg')!= null)
                                <div class="alert alert-success d-flex justify-content-center my-2" role="alert">
                                    {{session('msg')}}
                                </div>
                            @endif

                    @if (session('error')!= null)
                        <div class="alert alert-warning" role="alert">
                                 {{session('error')}}
                        </div>
                    @endif
                  
                  </form>
                
                      </div>




                      <div class="tab-pane fade" id="v-pills-delete-account" role="tabpanel" aria-labelledby="v-pills-delete-account">
                        <div>
                          Are you sure that you want to delete your profile?<br>You will no longer be able to access.<br>
                         </div>

                         <form action="" method="post">
                         <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><br><b>Confirm Password:</b></label>
                            <input type="password" name="confirmpass" class="form-control">
                        </div>
                        @if ($errors->get('confirmpass') != null)
                            
                            <div class="alert alert-danger p-0 mt-1 ps-2" role="alert">
                                @foreach ($errors->get('confirmpass') as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </div>
                        @endif


                        
                        <button type="submit" name="delete" class="btn btn-danger">Delete!!!</button>

                        @if (session('msg')!= null)
                                <div class="alert alert-success d-flex justify-content-center my-2" role="alert">
                                    {{session('msg')}}
                                </div>
                            @endif

                    @if (session('error')!= null)
                        <div class="alert alert-warning" role="alert">
                                 {{session('error')}}
                        </div>
                    @endif

                </form>
                    
                    </div>






                    </div>




                    
                    

                    

                  </div>
            </div>
        </div>
    </div>

    @include('footer')
