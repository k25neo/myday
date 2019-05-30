  <form class="" action="{{ route('task.update', [$board->id, $group->id, $task->id]) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
  <div class="board-group-row">
    <div class="board-group-cell menu-cell"></div>
    <div class="board-group-cell checkbox-cell"></div>
    <div class="board-group-cell name-cell" style="border-left:8px solid orange;">
      <input type="text" name="name" value="{{ $task->name }}" readonly>
    </div>
    <div class="board-group-cell person-cell">
      <input type="hidden" name="person" value="1" readonly>
      <div class="person-cell-component">
        <div class="person-image-wrapper">
          <img src="/img/person_noimage.svg" class="person-bullet-image person-bullet-component inline-image" title="" alt="">
        </div>
      </div>
    </div>
    <div class="board-group-cell status-cell">
      {{-- custom select --}}
      <div class="custom-select js-custom-select" style="background-color: orange;">
        <select name="status">
          @foreach ($statuses as $key => $value)
            <option value="{{ $key }}"
            @if ($key == $task->status)
              selected="selected"
            @endif
            >{{ $value }}</option>
          @endforeach
        </select>
      </div>
      {{-- end custom select --}}
    </div>
    <div class="board-group-cell date-cell">
      <input type="text" name="date" value="
      @if (!empty($task->date))
        {{ $task->date->format('d.m.Y') }}
      @endif" class='datepicker-here' readonly>
    </div>
    <div class="board-group-cell sum-cell">
      <input type="text" name="sum" value="{{ $task->sum }}" readonly>
    </div>
    <div class="board-group-cell btn-cell">
      <button class="btn btn-row-update"><i class="fa fa-check-circle" aria-hidden="true"></i></button>
    </div>

  </div>
  </form>
