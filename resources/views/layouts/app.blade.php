<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name', 'Myday') }}</title>

  <link href="//fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,500,500italic;subset=cyrillic"
    rel="stylesheet"
    type="text/css">
  <!-- Styles -->
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script defer src="https://code.jquery.com/jquery-3.4.0.min.js"
    integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
  <!-- Scripts -->
  <script src="{{ asset('js/main.js') }}" defer></script>
</head>

<body id="login_signup">

  <div class="login_signup_header">
    <div class="account_logo">
      <a href="#" class="logo"
        style="background-image:url(); background-size: 180px 44px;"
        tabindex="-1"></a>
    </div>
  </div>

<div class="page_content">

  <div class="content    ">

    @yield('content')

  </div>


</div>

</body>

</html>
