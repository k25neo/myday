<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name', 'AHT') }}</title>
  <link href="//fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,500,500italic;subset=cyrillic"
    rel="stylesheet"
    type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/main.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script defer src="https://code.jquery.com/jquery-3.4.0.min.js"
    integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script defer src="{{ asset('js/vendors/vanillaTextMask.js') }}"></script>

    <!-- Scripts -->
    <link href="{{ asset('js/vendors/air-datepicker/datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <script defer src="{{ asset('/js/vendors/air-datepicker/datepicker.min.js') }}"></script>
    <script defer src="{{ asset('/js/vendors/tinymce/tinymce.min.js') }}"></script>
    <script defer src="{{ asset('js/main.js') }}"></script>
</head>

<body>
  @include('crm.layouts.header')
  <div class="main__container">
    @include('crm.layouts.left')
    <div class="content__wrapper">
      @yield('content')
    </div>
  </div>

@include('crm.layouts.partials.modal_add_board')
@yield('comments_modal')
@yield('profile_modal')
@yield('message_modal')
@yield('add_group_modal')
@yield('error_modal')

</body>

</html>
