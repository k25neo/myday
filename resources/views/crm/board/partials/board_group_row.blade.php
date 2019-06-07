  <form class="" action="{{ route('task.update', [$board->id, $group->id, $task->id]) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
  <div class="board-group-row">
    <div class="board-group-cell menu-cell"></div>
    <div class="board-group-cell checkbox-cell"></div>
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
      @endif" class='input-cell datepicker-here' readonly>
    </div>
    <div class="board-group-cell sum-cell">
      <input class="input-cell" type="text" name="sum" value="{{ $task->sum }}" readonly>
    </div>
    <div class="board-group-cell btn-cell">
      <button class="btn btn-row-update">ok</button>
    </div>

  </div>
  </form>
