@section('comments_modal')
  <div class="comments_modal" id="comments_modal">
    <div class="comments_modal__close"></div>
    <h2 class="task-name"></h2>
    <div class="task-comments"></div>
    <div class="form">
      <div>Комментарий</div>
      <textarea class="form__textarea"></textarea>
      <div class="btn btn-default js-comments-save">Отправить</div>
    </div>
  </div>
@endsection
