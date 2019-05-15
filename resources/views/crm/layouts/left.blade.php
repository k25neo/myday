<div class="left__container">
  <div class="left__nav">
    <div class="left__nav_item">
      <a href="{{ route('messages.index') }}" class="left__nav_link">
        <span class="title">Сообщения</span>
        <!--<span class="count">1</span>-->
      </a>
    </div>
    <div class="left__nav_item">
      <a href="#" class="left__nav_link">
        <span class="title">Мои задачи</span>
      </a>
    </div>
  </div>
  <div class="left__nav_client">
    <div class="left__nav_client-title"><i class="fa fa-list" aria-hidden="true"></i>
      Клиенты</div>
    @php
      $arGroups = \App\Group::all();
    @endphp

    @forelse($arGroups as $group)
      <div class="left__nav_client-item">
        <a href="{{ route('board.show') }}" class="left__nav_client-link">
          <span class="title">{{ $group->name }}</span>
        </a>
      </div>
    @empty
      <div class="left__nav_client-item">
        <a href="#" class="left__nav_client-link">
          <span class="title">Нет клиентов</span>
        </a>
      </div>
    @endforelse

    <div class="left__nav_client-buttons">
      <div class="left__nav_client-btn">
        <i class="fa fa-plus-circle" aria-hidden="true"></i>
        <span class="title">Добавить</span>
      </div>
    </div>
  </div>
</div>
