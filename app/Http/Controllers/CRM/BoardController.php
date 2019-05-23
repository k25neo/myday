<?php

namespace App\Http\Controllers\CRM;

use App\Board;
use App\Group;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoardController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('crm.board.index', [
        'boards' => Board::orderBy('created_at', 'desc')->paginate(50)
      ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $allRequest = $request->all();
    $model = Board::create($allRequest);
    // create empty group
    $group = new Group(['name'=>'Новая группа']);
    $newGroup = $model->groups()->save($group);
    // create empty task
    $task = new Task(['name'=>'Новая задача']);
    $newGroup->tasks()->save($task);
    return redirect()->route('board.show', $model->id);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $board = Board::find($id);
    if (!$board) {
       return redirect()->route('board.index');
    }else{
      return view('crm.board.show', [
          'board' => $board
      ]);
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Board $board)
  {
      $board->update($request->all());
      return redirect()->back();
  }

  public function destroy(Request $request, Board $board)
  {
    $board->tasks()->delete();
    $board->groups()->delete();
    $board->delete();
    return redirect()->back();
  }

}
