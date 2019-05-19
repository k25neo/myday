<!-- start board-content-component -->
@forelse ($board->groups as $key => $group)
  <div class="board-content-component">
    <div class="board-group">
      <div class="board-group-header">
        <div class="board-group-row">
        <div class="board-group-cell board-group-menu menu-cell-header js-board-group-menu">
          <div class="board-group-menu-box" style="border-color: orange; background-color: orange;">
            <i class="fa fa-caret-down" aria-hidden="true"></i>
          </div>
          <div class="board-group-menu-content">
            <div class="board-group-menu-item">Свернуть группу</div>
            <div class="board-group-menu-item">Выбрать все элементы</div>
            <div class="board-group-menu-hr"></div>
            <div class="board-group-menu-item">Добавить группу</div>
            <div class="board-group-menu-item">Дублировать группу</div>
            <div class="board-group-menu-item">Переместить группу</div>
            <div class="board-group-menu-hr"></div>
            <div class="board-group-menu-item">Переименовать группу</div>
            <div class="board-group-menu-item">Сменить цвет группы</div>
            <div class="board-group-menu-hr"></div>
            <div class="board-group-menu-item">Удалить</div>
          </div>
        </div>
        <div class="board-group-cell name-cell-header" style="color: orange;">
          {{-- form group update --}}
          <form action="{{ route('group.update', [$board->id, $group->id]) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
              @include('crm.board.partials.ds_editable', ['groupName' => $group->name])
          </form>
        </div>
        <div class="board-group-cell person-cell-header">Сотрудник</div>
        <div class="board-group-cell status-cell-header">Статус заявки</div>
        <div class="board-group-cell date-cell-header">Дата</div>
        <div class="board-group-cell sum-cell-header">Стоимость</div>
        </div>
      </div>
      <div class="board-group-body">
        @each('crm.board.partials.board_group_row', $group->tasks, 'task')
      </div>
      <div class="board-group-footer">
        <div class="board-group-row">
          <div class="board-group-cell menu-cell"></div>
          <div class="board-group-cell add-cell" style="border-left:8px solid orange;">
            <div class="add-cell-component">
              <input type="text" name="name" value="" placeholder="+ Добавить" readonly>
              <button class="add-pulse-button">Добавить</button>
            </div>
          </div>
        </div>
        <div class="board-group-row flex-end">
          <div class="board-group-cell total-sum-cell">
            <input type="text" name="total" value="0" readonly title="Сумма">
          </div>
        </div>
      </div>
    </div>
  </div>
@empty
  <div class="message__green">
    Создайте группу
  </div>
@endforelse

<!-- end board-content-component -->