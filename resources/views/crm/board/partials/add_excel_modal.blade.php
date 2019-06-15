@section('add_excel_modal')
  <!-- start modals -->
  <div id="add_excel_modal" class="ReactModalPortal">
    <div class="ReactModal__Overlay ReactModal__Overlay--after-open"
      style="position: fixed; inset: 0; background-color: rgba(255, 255, 255, 0.75);">
      <div
        style="position: absolute; border: 1px solid rgb(204, 204, 204); background: rgb(255, 255, 255) none repeat scroll 0 0; overflow: visible; border-radius: 4px; outline: currentcolor none medium; padding: 0;"
        class="ReactModal__Content ReactModal__Content--after-open" tabindex="-1" role="dialog"
        aria-label="UserProfilePersonalInfoModal">
        <div class="react_popup_wrapper ">
          <div class="close_button"></div>
          <div>
            <form action="{{ route('importExcel', $board->id) }}" method="post"
              enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('PUT') }}

              {{-- name --}}
              <div class="form__input_container" data-id="name">
                <div class="form_title"><label>Выберите файл excel</label></div>
                <div class="inline_form">
                  <div class="form_line_container">
                    <label>
                      <input type="file" class="form-control inputfile" name="file" required>
                      <div class="inputfile-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
              						<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path>
              					</svg>
                        <span>Выберите файл...</span>
                      </div>
                    </label>
                  </div>
                </div>
              </div>

              <div class="action_button_container">
                <button type="submit" class="ds-btn ds-btn-primary">Отправить</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end modals -->
@endsection
