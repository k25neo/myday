<div class="header">
  <div class="leftnav">
    <a href="/" class="logo"></a>
  </div>
  <div class="content">
    <div class="header__search">
      <form action="#" id="top_project_finder">
        <div class="form__control_block">
          <input type="text" class="search form__control">
          <div class="btn__search"><i class="fa fa-search" aria-hidden="true"></i> </div>
        </div>
      </form>
    </div>
    <div class="header__profile popup_menu" data-menu="profile-menu">
      <div class="header__profile_block">
        <div class="header__profile_image">

          @if ( !empty(Auth::user()->image) )
          <div class="header__profile_pic img-circle" style="background:center / cover
          no-repeat url('{{ asset('/storage/'.Auth::user()->image) }}')
          ">        </div>
          @else
          <div class="header__profile_pic img-circle">
            <div class="profile-image-text">
              @php
                echo substr(Auth::user()->login, 0, 2);
              @endphp
            </div>
          </div>
          @endif
        </div>

        <div class="header__profile_btn">
          <span class="header__profile_arrow-circle">
            <i class="fa fa-caret-down header__profile_arrow-icon"></i>
          </span>
        </div>
      </div>
      <div class="header__profile_menu popup_menu_data" id="profile-menu">
        <ul id="top-user-menu" class="pulse_menu_options">
          <li><a class="your_profile" href="{{ route('profile') }}"><i class="fa fa-user"></i>Профиль</a></li>
          <li>
            <a href="{{ route('logout') }}" class="logout_btn"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>Выход</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
