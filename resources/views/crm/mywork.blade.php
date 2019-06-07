@extends('crm.layouts.app')

@section('content')
    <div class="content__wrapper">
      <!-- begin mywork -->
      <div class="personal-assistant-component ">
        <div class="personal-assistant-content-header ">
          <div class="weeks-navigator-container">
            <div class="personal-assistant-weeks-navigator-component">
              {{--  <div class="prev-week-button"><span class="prev-week">Предыдущая неделя / 1</span><i
                  class="fa fa-chevron-left" aria-hidden="true"></i>
              </div>
              <div class="week-indicator-wrapper"><span class="week-indicator">Apr 15 - Apr 21</span></div>
              <div class="next-week-button"><i class="fa fa-chevron-right" aria-hidden="true"></i>
                <span class="next-week">Следующая неделя / 0</span></div>
                --}}
            </div>
          </div>
        </div>
        <div class="personal-assistant-content-view">
          <div class="personal-assistant-content-component">
            <div class="header-container">
              <div class="personal-assistant-header-component"><img src="/img/coffee_team.png" class="image-title">
                <div class="personal-assistant-titles">
                  <div class="first-title"><span>Привет {{ $user->name or $user->login }},</span></div>
                  <div class="second-title">
                    @if (count($tasks) > 0)
                      <span>У вас {{ count($tasks) }} {{ Lang::choice('задание|задания|заданий', count($tasks)) }}</span>
                    @else
                      <span>У вас нет заданий</span>
                    @endunless
                  </div>
                </div>
              </div>
              {{--
              <div class="personal-assistant-filter-wrapper">
                <div class="personal-assistant-filter-component">
                  <div class="person-filter-input-wrapper">
                    <div class="pure-input "><input class="input person-filter-input" placeholder="Filter by person"
                        autocomplete="off" style="border-color: rgb(196, 196, 196);" value=""></div>
                  </div>
                  <div class="person-filter-picker-wrapper">
                    <div class="person-filter ">
                      <div class="person-filter-button-wrapper"><a
                          class="person-filter-button-component ignore-person-filter-onclickoutside"><i
                            class="fa fa-user-circle" aria-hidden="true"></i>
                        </a></div>
                    </div>
                  </div>
                </div>
              </div>
              --}}
            </div>
            <div class="deadlines-tasks-container">

              @foreach ($tasks as $key => $task)
                <div class="deadline-tasks-section-component">
  {{--                <div class="section-type-container"><span class="collapse-icon-wrapper">
                      <div class="collapse-group-toggle-component"><i class="fa fa-minus" aria-hidden="true"></i>
                      </div>
                    </span>
                    <div class="section-type-title-wrapper"><span class="section-type-title">previous weeks</span></div>
                  </div>--}}
                  <div>
                    <div class="deadline-tasks-wrapper" style="display: block;">
                      <a href="{{ route('board.show', $task->group->board->id) }}">
                      <div class="deadline-task-component">
                        <div class="details">
                          <div class="pulse-name-wrapper"><span class="pulse-name-text">
                              <div class="ds-text-component" dir="auto"><span>{{ $task->name }}</span></div>
                            </span></div>
                          <div class="deadline-task-path"><i class="fa fa-list" aria-hidden="true"></i>
                            <span class="board-name">{{ $task->group->board->name }}</span><span> &gt; </span><span
                              class="group-name">{{ $task->group->name }}</span></div>
                        </div>
                        <div class="deadline-task-columns">
                          <div class="persons-wrapper">
                            <div class="overlap-images-component">
                              <div class="overlap-images-wrapper">
                                {{--<div class="overlap-image" style="height: 35px; width: 35px; margin: 0px;"><img
                                    src="/img/profile_img.png" class="inner-image"></div>--}}
                              </div>
                            </div>
                          </div>
                          <div class="deadline-indication merged">
                            <div class="deadline-date-indication-icon-component">{{--<i class="fa fa-info-circle"
                                aria-hidden="true"></i>--}}
                                @php
                                  setlocale(LC_TIME, 'ru_RU.UTF-8');
                                @endphp
                            </div><span class="deadline-time ">
                              @if (!empty($task->date))
                              {{ $task->date->formatLocalized('%d %B %Y') }}
                              @endif
                            </span>
                          </div>
                        </div>
                      </div>
                      </a>
                    </div>
                  </div>
                </div>
              @endforeach


              {{--<div class="deadline-tasks-section-component">
                <div class="section-type-container"><span class="collapse-icon-wrapper">
                    <div class="collapse-group-toggle-component collapsed"><i class="fa fa-plus" aria-hidden="true"></i>
                    </div>
                  </span>
                  <div class="section-type-title-wrapper"><span class="section-type-title">earlier this week</span><span
                      class="number-of-assignmetns"> / 0 assignments</span></div>
                </div>
                <div></div>
              </div>--}}
              {{--
              <div class="deadline-tasks-section-component">
                <div class="section-type-container"><span class="collapse-icon-wrapper">
                    <div class="collapse-group-toggle-component collapsed"><i class="fa fa-plus" aria-hidden="true"></i>
                    </div>
                  </span>
                  <div class="section-type-title-wrapper"><span class="section-type-title">today</span><span
                      class="number-of-assignmetns"> / 0 assignments</span></div>
                </div>
                <div></div>
              </div>
              --}}

              {{--
              <div class="deadline-tasks-section-component">
                <div class="section-type-container"><span class="collapse-icon-wrapper">
                    <div class="collapse-group-toggle-component collapsed"><i class="fa fa-plus" aria-hidden="true"></i>
                    </div>
                  </span>
                  <div class="section-type-title-wrapper"><span class="section-type-title">upcoming</span><span
                      class="number-of-assignmetns"> / 0 assignments</span></div>
                </div>
                <div></div>
              </div>
               --}}

              {{--
              <div class="deadline-tasks-section-component">
                <div class="section-type-container"><span class="collapse-icon-wrapper">
                    <div class="collapse-group-toggle-component collapsed"><i class="fa fa-plus" aria-hidden="true"></i>
                    </div>
                  </span>
                  <div class="section-type-title-wrapper"><span class="section-type-title">done</span><span
                      class="number-of-assignmetns"> / 0 assignments</span></div>
                </div>
                <div></div>
              </div>
              --}}
            </div>
          </div>
        </div>
      </div>
      <!-- end mywork -->
@endsection
