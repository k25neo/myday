<div class="left__container">
  {{-- left__nav --}}
  <div class="left__nav">
    <div class="left__nav_item">
      <a href="{{ route('messages.index') }}" class="left__nav_link">
        <span class="title">Сообщения</span>
        <!--<span class="count">1</span>-->
      </a>
    </div>
    <div class="left__nav_item">
      <a href="{{ route('mywork') }}" class="left__nav_link">
        <span class="title">Мои задачи</span>
      </a>
    </div>
    <div class="left__nav_title">
        Клиенты
        <div class="btn__add_client_modal js-open-add-client"><img src="/img/add-contacts.svg"></div>
    </div>
  </div>
  {{-- end left__nav --}}
  @php
    $arClients = \App\Client::with('boards')->get();
  @endphp
  <div class="left__nav_client">

    @foreach ($arClients as $client)
      <div class="left__nav_client-title"><i class="fa fa-list" aria-hidden="true"></i>
        <div class="nav_client_name">{{ $client->name }}</div>
        <div class="btn__add_board_modal js-open-add-board"
          data-clientid="{{ $client->id }}"><img src="/img/add-folder.svg"></div>
      </div>
      {{-- dd( $client->boards ) --}}
      @foreach($client->boards as $board)
        <div class="left__nav_client-item">
          <a href="{{ route('board.show', $board->id) }}" class="left__nav_client-link">
            <span class="title">{{ $board->name }}</span>
          </a>
        </div>
      @endforeach
    @endforeach

{{--
    <div class="left__nav_client-buttons">
      <div class="left__nav_client-btn">
        <i class="fa fa-plus-circle" aria-hidden="true"></i>
        <span class="title js-open-add-board">Добавить</span>
      </div>
    </div>
      --}}

  </div>
  {{-- end left__nav_client --}}
</div>
