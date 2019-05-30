<?php

namespace App\Http\Controllers\CRM;

use App\Task;
use App\Group;
use App\Board;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Board $board, Group $group)
    {
      $arRequest = $request->all();
      $keys = array_keys(Task::$status);
      $firstKey = $keys[0];
      $arRequest['status'] = $firstKey;
      $task = new Task($arRequest);
      $group->tasks()->save($task);
      return redirect()->route('board.show', $board->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Board $board, Group $group, Task $task)
    {
      $allRequest = $request->all();
      $allRequest['group_id'] = $group->id;
      // $date = \DateTime::createFromFormat('d.m.Y', $request->date);
      // $usableDate = $date->format('Y-m-d');
      $allRequest['date'] = Carbon::parse($request->date);
      $task->update($allRequest);
      return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
