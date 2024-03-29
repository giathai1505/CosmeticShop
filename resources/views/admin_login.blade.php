<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login to your account</title>

    <!-- Bootstrap -->
    <link href="{{('public/backEnd/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{('public/backEnd/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <!-- NProgress -->
    <link href="{{asset('public/backEnd/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('public/backEnd/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('public/backEnd/build/css/custom.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/backEnd/build/css/style.css')}}" rel="stylesheet">



  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST" action="{{URL::to('/admin-dashboard')}}">
           {{ csrf_field() }}
              <h1>Login Form</h1>

              <?php
                $message = Session::get('ErrorMessage');
                if ($message)
                {
                  ?>
                      <p class="errMessage">Tên đăng nhập hoặc mật khẩu không đúng, kiểm tra lại</p>
                  <?php
                  Session::put('ErrorMessage','');
                }
              ?>
             
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" name="txtUserName"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="txtPass"/>
              </div>
              <div>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>
              <input type="submit" value="Đăng nhập" name="login" class="btn-primary">
              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
