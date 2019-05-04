@extends('crm.layouts.app')

@section('content')
  <!-- begin personal info -->
  <div class="user__profile_container" id="user__profile_container">
    <div class="user__profile">
      <div class="user__profile_top-container">
        <div class="user__profile_top">
          <div class="user__profile_image-component">
            @if ( !empty(Auth::user()->image) )
              <div class="hover-wrapper" style="background:center / cover
              no-repeat url('{{ asset('/storage/'.Auth::user()->image) }}')
              ">
                <div class="profile-image hover"></div>
            @else
              <div class="hover-wrapper">
                <div class="profile-image-text">
                  @php
                    echo substr(Auth::user()->login, 0, 2);
                  @endphp
                </div>
              @endif
              <form action="{{ route('profile.update', Auth::user()->id) }}"
                method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="file" name="image" style="display:none">
              </form>
              <div class="change-picture-hover js-changePicture">
                <i class="fa fa-user-plus" aria-hidden="true"></i>
                <div class="change-picture-text">Сменить фото</div>
              </div>
            </div>
          </div>
          <div class="user__profile_name js-profileModal" data-id="name">
              {{ isset(Auth::user()->name) ?  Auth::user()->name : 'Задать имя' }}
              <div class="edit_icon_container"><i class="fa fa-pencil" aria-hidden="true"></i></div>
          </div>
        </div>
        <div class="user__profile_menu-container">
          <div class="user__profile_menu">
            <ul class="pulse-tabs ">
              <li class="is-selected" data-tab="contact_information">Персональная информация</li>
              <li data-tab="change_password">Пароль</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="user__profile_middle-container">
        <div class="user__profile_inner-container">
          <div id="contact_information" class="contact_information pulse-tabs-data open">
            <div class="contact_information_container">
              <h2>Данные</h2>
              <div class="profile_get_in_touch_el">
                <div class="icon_container">
                  <div><i class="fa fa-user" aria-hidden="true"></i></div>
                </div>
                <div class="data_container popup_edit_link">
                  <div class="data_row_container">
                    <div class="profile-field-title">
                      <div class="ds-text-component" dir="auto"><span>Должность:</span></div>
                    </div>
                    <div class="profile-field-content js-profileModal" data-id="position" >

                      @if ( !empty(Auth::user()->position) )
                        <span class="profile-field-value">
                            {{ Auth::user()->position }}
                        </span>
                      @else
                        <span class="profile-field-value missing">Добавить</span>
                      @endif

                      <div class="edit_icon_container"><i class="fa fa-pencil" aria-hidden="true"></i></div>

                    </div>
                  </div>
                </div>
              </div>
              <div class="profile_get_in_touch_el">
                <div class="icon_container">
                  <div><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                </div>
                <div class="data_container popup_edit_link">
                  <div class="data_row_container">
                    <div class="profile-field-title">
                      <div class="ds-text-component" dir="auto"><span>Email:</span></div>
                    </div>
                    <div class="profile-field-content js-profileModal" data-id="email">

                      @if ( !empty(Auth::user()->email) )
                        <span class="profile-field-value">
                            {{ Auth::user()->email }}
                        </span>
                      @else
                        <span class="profile-field-value missing">Добавить</span>
                      @endif

                      <div class="edit_icon_container"><i class="fa fa-pencil" aria-hidden="true"></i></div>

                    </div>
                  </div>
                </div>
              </div>
              <div class="profile_get_in_touch_el">
                <div class="icon_container">
                  <div><i class="fa fa-phone" aria-hidden="true"></i></div>
                </div>
                <div class="data_container popup_edit_link">
                  <div class="data_row_container">
                    <div class="profile-field-title">
                      <div class="ds-text-component" dir="auto"><span>Телефон:</span></div>
                    </div>
                    <div class="profile-field-content js-profileModal" data-id="phone">

                      @if ( !empty(Auth::user()->phone) )
                        <span class="profile-field-value">
                            {{ Auth::user()->phone }}
                        </span>
                      @else
                        <span class="profile-field-value missing">Добавить</span>
                      @endif

                      <div class="edit_icon_container"><i class="fa fa-pencil" aria-hidden="true"></i></div>

                    </div>
                  </div>
                </div>
              </div>
              <div class="profile_get_in_touch_el">
                <div class="icon_container">
                  <div><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                </div>
                <div class="data_container popup_edit_link">
                  <div class="data_row_container">
                    <div class="profile-field-title">
                      <div class="ds-text-component" dir="auto"><span>Часовой пояс:</span></div>
                    </div>
                    <div class="profile-field-content js-profileModal" data-id="timezone">

                      @if ( !empty($nameTimezone) )
                        <span class="profile-field-value">
                            {{ $nameTimezone }}
                        </span>
                      @else
                        <span class="profile-field-value missing">Добавить</span>
                      @endif

                      <div class="edit_icon_container"><i class="fa fa-pencil" aria-hidden="true"></i></div>

                    </div>
                  </div>
                </div>
              </div>
              <div class="profile_get_in_touch_el">
                <div class="icon_container">
                  <div><i class="fa fa-birthday-cake" aria-hidden="true"></i></div>
                </div>
                <div class="data_container popup_edit_link">
                  <div class="data_row_container">
                    <div class="profile-field-title">
                      <div class="ds-text-component" dir="auto"><span>День рождения:</span></div>
                    </div>
                    <div class="profile-field-content js-profileModal" data-id="birthday">

                      @if ( !empty($birthday) )
                        <span class="profile-field-value ">
                            {{ $birthday }}
                        </span>
                      @else
                        <span class="profile-field-value missing">Добавить</span>
                      @endif

                      <div class="edit_icon_container"><i class="fa fa-pencil" aria-hidden="true"></i></div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="change_password" class="change_password pulse-tabs-data">
            <section class="user_profile_bottom_container">
              <div class="user_inner_container change_password">
                <h1>Смена пароля</h1>

                <form action="{{ route('profile.changepass', Auth::user()->id) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                  <div class="input_container">
                    <div class="label"><label for="current_password">Текущий пароль</label></div>
                    <div class="input">
                      <input type="password" class="form-control"
                      id="current_password" name="current_password">
                    </div>
                  </div>
                  <div class="input_container">
                    <div class="label"><label for="new_password">Новый пароль</label></div>
                    <div class="input password_status_empty">
                      <input type="password" class="form-control"
                        id="new_password" name="new_password">
                      <div class="progress">
                        <div class="progress-bar"></div>
                      </div><span class="password-verdict"></span>
                    </div>
                  </div>
                  <div></div>
                  <div class="input_container">
                    <div class="label"><label for="password_confirmation">Подтвердить новый пароль</label></div>
                    <div class="input">
                      <input type="password" class="form-control"
                        id="new_password_confirmation" name="new_password_confirmation">
                    </div>
                  </div>
                  <div></div>
                  <div class="separetor_line"></div>
                  <div class="action_button_container"><button type="submit"
                      class="ds-btn ds-btn-primary">Сохранить</button></div>
                </form>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>


  </div>
  <!-- end personal info -->
@endsection

@if (session('status'))
  @section('message_modal')
    <!-- start modals -->
    <div class="ReactModalPortal open">
      <div class="ReactModal__Overlay ReactModal__Overlay--after-open"
        style="position: fixed; inset: 0; background-color: rgba(255, 255, 255, 0.75);">
        <div
          style="position: absolute; border: 1px solid rgb(204, 204, 204); background: rgb(255, 255, 255) none repeat scroll 0 0; overflow: visible; border-radius: 4px; outline: currentcolor none medium; padding: 0;"
          class="ReactModal__Content ReactModal__Content--after-open" tabindex="-1" role="dialog"
          aria-label="UserProfilePersonalInfoModal">
          <div class="react_popup_wrapper ">
            <div class="close_button"></div>
            <div>
              <div class="form_title"><label>Сообщение</label></div>
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endsection
@endif

@if (count($errors) > 0)
  @section('error_modal')
    <!-- start modals -->
    <div class="ReactModalPortal open">
      <div class="ReactModal__Overlay ReactModal__Overlay--after-open"
        style="position: fixed; inset: 0; background-color: rgba(255, 255, 255, 0.75);">
        <div
          style="position: absolute; border: 1px solid rgb(204, 204, 204); background: rgb(255, 255, 255) none repeat scroll 0 0; overflow: visible; border-radius: 4px; outline: currentcolor none medium; padding: 0;"
          class="ReactModal__Content ReactModal__Content--after-open" tabindex="-1" role="dialog"
          aria-label="UserProfilePersonalInfoModal">
          <div class="react_popup_wrapper ">
            <div class="close_button"></div>
            <div>
              <div class="form_title"><label>Ошибка</label></div>
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endsection

@endif

@section('profile_modal')
  <!-- start modals -->
  <div id="profile_modal" class="ReactModalPortal">
    <div class="ReactModal__Overlay ReactModal__Overlay--after-open"
      style="position: fixed; inset: 0; background-color: rgba(255, 255, 255, 0.75);">
      <div
        style="position: absolute; border: 1px solid rgb(204, 204, 204); background: rgb(255, 255, 255) none repeat scroll 0 0; overflow: visible; border-radius: 4px; outline: currentcolor none medium; padding: 0;"
        class="ReactModal__Content ReactModal__Content--after-open" tabindex="-1" role="dialog"
        aria-label="UserProfilePersonalInfoModal">
        <div class="react_popup_wrapper ">
          <div class="close_button"></div>
          <div>
            <form action="{{ route('profile.update', Auth::user()->id) }}" method="post">
              {{ csrf_field() }}
              {{ method_field('PUT') }}

              {{-- name --}}
              <div class="form__input_container" data-id="name">
                <div class="form_title"><label>Имя</label></div>
                <div class="inline_form">
                  <div class="form_line_container">
                    <input class="form-control fullwidth" name="name"
                    value="{{ isset(Auth::user()->name) ?  Auth::user()->name : '' }}">
                  </div>
                </div>
              </div>
              {{-- position --}}
              <div class="form__input_container" data-id="position">
                <div class="form_title"><label>Должность</label></div>
                <div class="inline_form">
                  <div class="form_line_container">
                    <input class="form-control fullwidth" name="position"
                    value="{{ isset(Auth::user()->position) ?  Auth::user()->position : '' }}">
                  </div>
                </div>
              </div>
              {{-- Email --}}
              <div class="form__input_container" data-id="email">
                <div class="form_title"><label>Email</label></div>
                <div class="inline_form">
                  <div class="form_line_container">
                    <input class="form-control fullwidth" name="email"
                    value="{{ isset(Auth::user()->email) ?  Auth::user()->email : '' }}">
                  </div>
                </div>
              </div>
              {{-- phone --}}
              <div class="form__input_container" data-id="phone">
                <div class="form_title"><label>Телефон</label></div>
                <div class="inline_form">
                  <div class="form_line_container">
                    <input class="form-control fullwidth" name="phone" placeholder="+7(___) ___-__-__"
                    value="{{ isset(Auth::user()->phone) ?  Auth::user()->phone : '' }}">
                  </div>
                </div>
              </div>
              {{-- timezone --}}
              <div class="form__input_container" data-id="timezone">
                <div class="form_title"><label>Часовой пояс</label></div>
                <div class="inline_form">
                  <div class="form_line_container">
                    {!! $selectTimezone !!}
                  </div>
                </div>
              </div>
              {{-- birthday --}}
              <div class="form__input_container" data-id="birthday">
                <div class="form_title"><label>День рождения</label></div>
                <div class="inline_form">
                  <div class="form_line_container">
                    <input class="form-control fullwidth datepicker-here"
                    name="birthday"
                    data-startDate="{{ isset($birthday) ?  $birthday : '' }}"
                    value="{{ isset($birthday) ?  $birthday : '' }}">
                  </div>
                </div>
              </div>

              <div class="action_button_container">
                <button type="submit" class="ds-btn ds-btn-primary">Сохранить</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end modals -->
@endsection
