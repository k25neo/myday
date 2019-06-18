<!-- start modals -->
<div id="add_board_modal" class="ReactModalPortal">
  <div class="ReactModal__Overlay ReactModal__Overlay--after-open"
    style="position: fixed; inset: 0; background-color: rgba(255, 255, 255, 0.75);">
    <div
      style="position: absolute; border: 1px solid rgb(204, 204, 204); background: rgb(255, 255, 255) none repeat scroll 0 0; overflow: visible; border-radius: 4px; outline: currentcolor none medium; padding: 0;"
      class="ReactModal__Content ReactModal__Content--after-open" tabindex="-1" role="dialog"
      aria-label="UserProfilePersonalInfoModal">
      <div class="react_popup_wrapper ">
        <div class="close_button"></div>
        <div>
          <form action="{{ route('board.store') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="client_id" value="">
            {{-- name --}}
            <div class="form__input_container">
              <div class="form_title"><label>Название</label></div>
              <div class="inline_form">
                <div class="form_line_container">
                  <input class="form-control fullwidth" name="name"
                  value="" required>
                </div>
              </div>
            </div>
            {{-- description --}}
            <div class="form__input_container">
              <div class="form_title"><label>Описание</label></div>
              <div class="inline_form">
                <div class="form_line_container">
                  <input class="form-control fullwidth" name="description"
                  value="" required>
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
