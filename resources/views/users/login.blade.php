<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="{{url('public/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{url('public/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{url('public/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{url('public/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{url('public/build/css/custom.min.css')}}" rel="stylesheet">
    <link href="{{url('public/vendor/jquery/dist/jquery.js')}}">
    <link href="{{url('public/css/toastr.min.css')}}" rel="stylesheet">
    <script src="{{url('public/vendors/jquery/dist/jquery.js')}}"></script>
    <script src="{{url('public/js/toastr.min.js')}}"></script>
</head>

<body class="login">
<div>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form action="{{route('user.get_login')}}" method="post">
                    {{csrf_field()}}
                    <h1>Login Form</h1>
                    <div class="pull-left">
                        <div class="col-md-12">
                            <ul class="text-danger">
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>

                                    @endforeach
                                        <hr>
                                @endif
                            </ul>
                            <ul>
                                @if(Session::has('msg'))
                                    <li>{{Session::pull('msg')}}</li>
                                    <hr>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div>
                        <span class="pull-left col-md-offset-1 text-danger">
                            @if($errors->has('email'))
                                {{$errors->first('email')}}
                            @endif
                        </span>
                        <input type="email" name="email" class="form-control" placeholder="Email" />

                    </div>

                    <div class="form-group">
                        <span class="pull-left col-md-offset-1 text-danger">
                            @if($errors->has('password'))
                                {{$errors->first('password')}}
                            @endif
                        </span>
                        <input type="password" name="password" class="form-control" placeholder="Password" />
                    </div>
                    <div class="row form-group" >
                        <input type="submit" style="margin-left:150px;" class="btn btn-primary col-md-offset-4" value="Login">
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">

                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i> TechCodeX</h1>
                            <p>©2016 All Rights Reserved. TechCodeX Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
<script>
    @if(Session::has('success'))
        toastr.success("{{Session::pull('success')}}");
    @endif

    @if(Session::has('error'))
        toastr.error("{{Session::pull('error')}}");
    @endif
</script>
</html>
