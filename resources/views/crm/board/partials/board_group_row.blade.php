  <form class="" action="{{ route('task.update', [$board->id, $group->id, $task->id]) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
  <div class="board-group-row">
    <div class="board-group-cell menu-cell">{{ $tk+1 }}</div>
    <div class="board-group-cell checkbox-cell"></div>
    <div class="board-group-cell"></div>
    <div class="board-group-cell name-cell" style="border-left:8px solid orange;">
      <input class="input-cell" type="text" name="name" value="{{ $task->name }}" readonly>
      <div class="comment-open-icon
      @if ($comments > 0)
        no-empty
      @endif
      js-comment-open" data-task="{{ $task->id }}">
        <i class="fa fa-comment-o" aria-hidden="true"></i>
        @if ( $comments > 0 )
          <div class="comment-open-icon-count">{{ $comments }}</div>
        @endif
      </div>
    </div>
    <div class="board-group-cell person-cell">
      {{-- user-select --}}
      <div class="person-cell-component js-user-select" data-task="{{ $task->id }}">
        <input type="hidden" name="users" value="{{ $users->keys() }}" >
        <div class="person-image-wrapper">
          @forelse ($users as $key => $user)
            <img style="margin:0 -{{ $users->count() }}px" data-id="{{ $user->id }}" src="
            @if ( !empty($user->image) )
              {{ asset('/storage/'.$user->image) }}
            @else
              /img/person_noimage.svg
            @endif
            " class="person-bullet-image person-bullet-component inline-image" title="{{ $user->name or $user->login }}" alt="{{ $user->name or $user->login }}">
          @empty
            {{-- <img src="/img/person_noimage.svg" class="person-bullet-image person-bullet-component inline-image" title="" alt="">  --}}
          @endforelse
        </div>
      </div>
      {{-- end user-select  --}}
    </div>
    <div class="board-group-cell status-cell">
      {{-- custom select --}}
      <div class="custom-select color js-custom-select" style="background-color: orange;">
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
    {{-- critical --}}
    <div class="board-group-cell status-cell">
      {{-- custom select --}}
      <div class="custom-select js-custom-select">
        <select name="critical">
          @foreach ($criticals as $key => $value)
            <option value="{{ $key }}"
            @if ($key == $task->critical)
              selected="selected"
            @endif
            >{{ $value }}</option>
          @endforeach
        </select>
      </div>
      {{-- end custom select --}}
    </div>
    {{-- work_type --}}
    <div class="board-group-cell status-cell">
      {{-- custom select --}}
      <div class="custom-select js-custom-select">
        <select name="work_type">
          @foreach ($work_types as $key => $value)
            <option value="{{ $key }}"
            @if ($key == $task->work_type)
              selected="selected"
            @endif
            >{{ $value }}</option>
          @endforeach
        </select>
      </div>
      {{-- end custom select --}}
    </div>
    {{-- date from --}}
    <div class="board-group-cell date-cell">
      @php
        $task_date = '';
        if(!empty($task->date)){
          $task_date = $task->date->format('d.m.Y');
        }
      @endphp
      <input type="text" name="date" value="{{ $task_date }}" class='input-cell center js-datepicker' readonly>
    </div>
    {{-- date to  --}}
    <div class="board-group-cell date-cell">
      @php
        $task_date = '';
        if(!empty($task->date_to)){
          $task_date = $task->date_to->format('d.m.Y');
        }
      @endphp
      <input type="text" name="date_to" value="{{ $task_date }}" class='input-cell center js-datepicker' readonly>
    </div>
    {{-- --}}
    <div class="board-group-cell sum-cell">
      <input class="input-cell number" type="text" pattern="\d+(\.\d{2})?"
        name="sum" value="{{ $task->sum }}" readonly>
    </div>
    <div class="board-group-cell btn-cell">
      <button class="btn btn-row-update">ok</button>
    </div>

  </div>
  </form>
