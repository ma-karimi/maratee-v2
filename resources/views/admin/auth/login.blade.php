<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>ورود مدیریت</title>
    <meta name="description" content=""/>
    <meta name="author" content="Srico"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="apple-touch-icon" href="/apple-touch-icon.png"/>

    {!! Html::style('assets/admin/css/app.css') !!}
    {!! Html::style('assets/admin/css/rtl.css') !!}


    <link href="/dest-backend/css/app.min.css" rel="stylesheet">
    <link href="/dest-backend/css/app.rtl.min.css" rel="stylesheet">


</head>
<body class="theme-2 backend login_page">

<div class="bg-img"></div>
<section class="main">
    <div id="main-wrapper">
        <h1>به بخش مدیریت وب سایت {{config('app.full_name')}} خوش آمدید</h1>
        <form class="login-form" role="form" method="POST" action="{{ url('/admin') }}">
            {{ csrf_field() }}

            <p class="inputWrapper">
                <label for="email" class="col-md-4 control-label">ایمیل</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                <span>{{ $errors->first('email') }}</span>
            </p>
            <p class="inputWrapper">
                <label for="password" class="col-md-4 control-label">رمز عبور</label>
                <input id="password" type="password" class="form-control" name="password">
                <span>{{ $errors->first('password') }}</span>
            </p>
            <p class="inputWrapper">
                <input type="checkbox"
                       name="remember" {{ old('remember') ? 'checked' : '' }}>
                مرا بخاطر بیاور!
            </p>

            <p>
                {!! Form::submit('ورود') !!}
                <a href="/">بازگشت به صفحه اصلی</a>
            </p>
        </form>
    </div>
</section>
</body>
</html>
