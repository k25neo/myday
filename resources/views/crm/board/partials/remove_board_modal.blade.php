@section('remove_board_modal')
  <!-- start modals -->
  <div id="remove_board_modal" class="ReactModalPortal">
    <div class="ReactModal__Overlay ReactModal__Overlay--after-open"
      style="position: fixed; inset: 0; background-color: rgba(255, 255, 255, 0.75);">
      <div
        style="position: absolute; border: 1px solid rgb(204, 204, 204); background: rgb(255, 255, 255) none repeat scroll 0 0; overflow: visible; border-radius: 4px; outline: currentcolor none medium; padding: 0;"
        class="ReactModal__Content ReactModal__Content--after-open" tabindex="-1" role="dialog"
        aria-label="UserProfilePersonalInfoModal">
        <div class="react_popup_wrapper ">
          <div class="close_button"></div>
          <div>
            <form action="{{ route( 'board.destroy', $board->id ) }}" method="post">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              {{-- name --}}
              <div class="form__input_container" data-id="name">
                <div class="form_title"><label>Вы подтверждаете удаление доски?</label></div>
                <div class="inline_form">
                  <div class="form_line_container">
                    <div class="column">
                      <div class="ds-btn ds-btn-primary" role="yes_button" >
                        Да
                      </div>
                    </div>
                    <div class="column">
                      <div class="ds-btn ds-btn-primary" role="close_button" >
                        Нет
                      </div>
                    </div>
                  </div>
                </div>
              </div>

{{--              <div class="action_button_container">
                <button type="submit" class="ds-btn ds-btn-primary">Отправить</button>
              </div>
  --}}
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end modals -->
@endsection
