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

        <h3 class=" text-secondary text-center fw-bold mb-5 " style="padding-top:15px"><i class="mx-2 fas fa-user-plus"></i>Registration</h3>


            <div class="d-flex justify-content-center my-4 ">
                <a class="btn btn-lg btn-success px-sm-4" href="{{route('student.registration.index')}}">Register as Student</a>
            </div>
            <div class="d-flex justify-content-center text-secondary ">
              -or-
            </div>
            <div class="d-flex justify-content-center my-4 ">
                <a class="btn btn-lg btn-primary px-sm-4" href="{{route('instructor.registration.index')}}">Register as Instructor</a>
            </div>
            <div class="d-flex justify-content-center text-secondary ">
              -or-
            </div>
            <div class="d-flex justify-content-center my-4 ">
                <a class="btn btn-lg btn-danger px-sm-4" href="{{route('moderator.registration.index')}}">Register as Moderator</a>
            </div>

            <div class="text-start mx-5 my-3 d-flex justify-content-center">
                <a class="link-info " href="{{route('login.index')}}">Already Registered?</a>
            </div>


            @if (session('error')!= null)
            <div class="alert alert-warning" role="alert">
                 {{session('error')}}
            </div>
        @endif

    </div>





























    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js " integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ==" crossorigin=" anonymous " referrerpolicy="no-referrer "></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js " integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p " crossorigin="anonymous "></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js " integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT " crossorigin="anonymous "></script>


</body>

</html>
