@extends('crm.layouts.app')

@section('content')
  <!-- begin board -->
<div class="board-wrapper">
<div id="board-header" class="board-header ">
<div class="board-header-top">
</div>
<div class="board-header-content-wrapper">
  {{-- form board update --}}
  <form action="{{ route('board.update', $board->id) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="board-header-main">
      <div class="board-header-left">
        <div class="board-name">
          <div class="ds-editable-component js-editable-component" style="width: auto; height: auto;">
            <div class="ds-text-component" >
              <input class="form-control fullwidth" name="name"
                value="{{ $board->name or '' }}" readonly>
              <div class="edit_icon_container"><i class="fa fa-pencil" aria-hidden="true"></i></div>
              <div class="edit-btn__container">
                <div class="edit-btn edit-btn__apply js-edit-btn-apply">
                  <i class="fa fa-check-circle" aria-hidden="true"></i>
                </div>
                <div class="edit-btn edit-btn__cancel js-edit-btn-cancel">
                  <i class="fa fa-times-circle" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="board-description can-edit">
          <div class="ds-editable-component js-editable-component" style="width: auto; height: auto;">
            <div class="ds-text-component description-content">
              <input class="form-control fullwidth" name="description"
                value="{{ $board->description or '' }}" readonly>
              <div class="edit_icon_container"><i class="fa fa-pencil" aria-hidden="true"></i></div>
              <div class="edit-btn__container">
                <div class="edit-btn edit-btn__apply js-edit-btn-apply">
                  <i class="fa fa-check-circle" aria-hidden="true"></i>
                </div>
                <div class="edit-btn edit-btn__cancel js-edit-btn-cancel">
                  <i class="fa fa-times-circle" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</form>
  {{-- end form board update --}}
  {{-- begin buttons panel --}}
  <div class="board-filter board-entity-button">
    <div class="collapse-all-groups ">
      <div class="collapse-group-toggle-component" title="Свернуть/развернуть группы">
        <i class="fa fa-compress" aria-hidden="true"></i>
      </div>
    </div>
    <div class="add-board-entity-button-wrapper">
      <div class="ds-menu-button-container ds-menu-button-old">
        <div class="add-board-entity-button-component">
          <button class="ds-btn ds-btn-primary ds-btn-md js-add-group-modal">
            <div class="add-icon">+</div>Добавить группу
          </button>
          <button class="ds-btn ds-btn-primary ds-btn-md js-add-excell-modal">
            Добавить список
          </button>
          <button class="ds-btn ds-btn-primary ds-btn-md js-remove-board-modal">
            Удалить доску
          </button>
        </div>
      </div>
    </div>
    <div class="board-filter-input-container">
      <form class="" action="{{ route('board.show', $board->id) }}" method="get">
        <div class="board-filter-input-wrapper_v2">
          <div class="icon-and-input-wrapper">
            <input placeholder="Поиск" value="{{ $search or '' }}" name="q">
            @if (!empty($search))
              <div class="cancel-search-btn js-cancel-search-btn"></div>
            @endif
          </div>
        </div>
      </form>
    </div>
  </div>
  {{-- end buttons panel --}}
  @if (!empty($search))
    <div class="search-query-message">
      <span>Выполнен поиск по: "{{ $search }}"</span>
    </div>
  @endif
</div>
</div>
<!-- start board-content-component -->
@include('crm.board.partials.group')
@endsection

@include('crm.board.partials.comments_modal')
@include('crm.board.partials.add_group_modal')
@include('crm.board.partials.remove_board_modal')
@include('crm.board.partials.add_excel_modal')
