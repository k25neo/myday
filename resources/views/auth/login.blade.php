@extends('layouts.app')

@section('content')
  <div class="login_wrapper" id="login_page">
    <div class="main_box">

      <form accept-charset="UTF-8" action="{{ route('login') }}" class="login-form" id="new_user" method="post"
        parsley-focus="first" parsley-validate="">

        @csrf

        <div class="account_name">
          <h1><b>Авторизация</b></h1>
          <br>
        </div>
        <div class="form_inner tight_form">
          <div class="email_password_wrapper">
            <div class="form-group flat">
              <input class="form-control with_pop_label with_value parsley-validated {{ $errors->has('email') ? ' is-invalid' : '' }}" id="user_email"
                name="email" value="{{ old('email') }}" placeholder="Email"
                size="30" tabindex="1" type="email" required autofocus >
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              <span class="pop_label" style="right: 310px;">Email</span>
            </div>
            <div class="form-group flat">
              <input class="form-control with_pop_label with_value parsley-validated {{ $errors->has('password') ? ' is-invalid' : '' }}" id="user_password"
                name="password"  placeholder="Пароль"
                size="30" tabindex="1" type="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              <span class="pop_label" style="right: 280px;">Пароль</span>
            </div>
          </div>

          <div class="help_wrapper forgot_password_wrapper">
            <a href="{{ route('register') }}"
              class="help" tabindex="3">Регистрация</a>
          </div>


          <div class="login_button-wrapper">
            <button class="ladda-button submit_button btn btn-primary" data-style="expand-left" tabindex="2"><span
                class="ladda-label">Войти <i class="fa fa-arrow-right"></i></span><span
                class="ladda-spinner"></span></button>
          </div>


        </div>



      </form>
    </div>
  </div>
  
@endsection
