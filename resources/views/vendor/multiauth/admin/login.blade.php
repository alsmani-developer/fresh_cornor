

<!DOCTYPE html>
<html lang="ar">
<head>
    <title>لوحه تحكم </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
    <link rel="icon" type="image/png" href="{{asset('Login_page/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('Login_page/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('Login_page/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('Login_page/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
    <link rel="stylesheet" type="text/css" href="{{asset('Login_page/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('Login_page/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('Login_page/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Login_page/css/Loginmain.css')}}">
<!--===============================================================================================-->
<link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
<style>
body{
font-family: 'Cairo', sans-serif;
}
</style>
</head>
<body>
    
    <div class="limiter">

    
        <div class="container-login100">
            <div class="wrap-login100">
            
                <div class="login100-pic js-tilt" data-tilt style="margin-top:2%;">
                    <img src="{{asset('profile/logo.jpg')}}" alt=" Logo" >
                </div>

                <form class="login100-form validate-form"  method="POST" action="{{ route('admin.login') }}">
                {{ csrf_field() }}
                    <span class="login100-form-title">
                        <h2><b style="font-family: 'Cairo', sans-serif;"> لـوحـة تحكم  </b></h2>
                    
                    </span>
                   
                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                  
                        <input class="input100" name="email" id="email" type="text" style="font-family: 'Cairo', sans-serif;" placeholder="  رقم الجوال"  value="{{ old('email') }}"  required autofocus>
                        <div class="col-md-6">
                            
                            @if ($errors->has('email'))
                       <span class="invalid-feedback" role="alert">
                               <strong>{{ $errors->first('email') }}</strong>
                           </span> @endif
                   </div>
                                  
                        
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    
                        <input class="input100"   id="password" type="password" style="font-family: 'Cairo', sans-serif;"  name="password"  placeholder="كلـمـة المـرور" required>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                         </span>
                     @endif
                             
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    
                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                        <h4 style="font-family: 'Cairo', sans-serif;">	دخـول </h4>
                        </button>

                        
                    </div>
                    <br> 
                    @if ($errors->has('password'))
                    <div class="alert alert-danger">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </div>
                                    @endif

                                    @if ($errors->has('email'))
                                    <div class="alert alert-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif
                    <br> <br>
                </form>
            </div>
        </div>
    </div>
    
    

    
    
<!--===============================================================================================-->	
<script src="{{asset('Login_page/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    
    <!--===============================================================================================-->
         <script src="{{asset('Login_page/vendor/bootstrap/js/popper.js')}}"></script>
         
          <script src="{{asset('Login_page/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--===============================================================================================-->
        
          <script src="{{asset('Login_page/vendor/select2/select2.min.js')}}"></script>
    <!--===============================================================================================-->
        
          <script src="{{asset('Login_page/vendor/tilt/tilt.jquery.min.js')}}"></script>

        <script >
            $('.js-tilt').tilt({
                scale: 1.1
            })
        </script>
    <!--===============================================================================================-->
    
          <script src="{{asset('js/Loginmain.js')}}"></script>

    </body>
    </html>
