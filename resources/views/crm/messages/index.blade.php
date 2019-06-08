@extends('crm.layouts.app')

@section('content')

<div class="user__messages_container">
  <div class="user__messages_header">
    <h1>Сообщения</h1>
  </div>
  <div class="user__messages_inner-container">
    <div class="user__messages_content">
      @forelse ($messages as $item)
        <div class="user__messages_item">
          <div class="user__messages_content-header">
            <div class="user__messages_avatar">
              <div class="header__profile_image">
                @if ( !empty($item->user->image) )
                <div class="header__profile_pic img-circle"
                  style="background:center / cover
                  no-repeat url('{{ asset('/storage/'.$item->user->image) }}')
                  ">
                </div>
                @else
                <div class="header__profile_pic img-circle">
                  <div class="profile-image-text">
                    @php
                      echo substr($item->user->login, 0, 2);
                    @endphp
                  </div>
                </div>
                @endif
              </div>
            </div>
            <div class="user__messages_name">
              @if ( !empty( $item->user->name ) )
                {{ $item->user->name }}
              @else
                {{ $item->user->login }}
              @endif
            </div>
            <div class="user__messages_date">
              {{ $item->created_at }}
            </div>
          </div>
          <div class="user__messages_content-main">
            {!! $item->message !!}
          </div>

        </div>
      @empty
        <div class="user__messages_content-main">
          Сообщения отсутствуют.
        </div>
      @endforelse
      <ul class="pagination pull-right">
        {{ $messages->links() }}
      </ul>
    </div>
  </div>
  <div class="user__messages_footer">
      <div class="btn btn-default js-open-write-message">Написать сообщение</div>
      <div class="write-message">
        <form class="write-message-form"
        action="{{ route('messages.store') }}" method="post">
          {{ csrf_field() }}
          <label for="">Сообщение</label>
          <textarea class="form-control tinymce" name="message"></textarea>

          <hr>

          <input class="btn btn-default" type="submit" value="Отправить">
          <div class="btn btn-default float-right js-close-write-message">Отмена</div>
        </form>
      </div>
  </div>
</div>

@endsection
