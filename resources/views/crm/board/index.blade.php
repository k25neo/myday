@extends('crm.layouts.app')

@section('content')
  <div class="content__container">
    <div class="content__header">
      <h1>Клиенты</h1>
    </div>
  </div>
<div class="content__container">
  <div class="content__main">
    <!-- begin board list -->

<div class="board__list">
  <div class="board__list_header">
    <div class="board__list_cell">Название:</div>
    <div class="board__list_cell">Описание:</div>
    <div class="board__list_cell">Действия:</div>
  </div>
    @forelse ($boards as $board)
    <div class="board__list_row">
      <div class="board__list_cell">
        <a href="{{ route('board.show', $board->id) }}">{{ $board->name }}</a>
      </div>
      <div class="board__list_cell">
        {{ $board->description }}
      </div>
      <div class="board__list_cell">
        <form action="{{ route( 'board.destroy', $board->id ) }}" method="post">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <button><i class="fa fa-trash" aria-hidden="true"></i></button>
        </form>
      </div>
    </div>
    @empty
      <div class="message__green">
        Создайте клиента
      </div>
    @endforelse
</div><!-- end board list -->

</div><!--content__main-->
</div><!--content__container-->


@endsection
