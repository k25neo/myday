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
    $keys = array_keys(Task::$status);
    $firstKey = $keys[0];
    $task = new Task([
      'name'=>'Новая задача',
      'status'=>$firstKey
    ]);
    $newGroup->tasks()->save($task);
    return redirect()->route('board.show', $model->id);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request, $id)
  {
    $arParams = [];
      //get board with id
      $board = Board::find($id) ? Board::find($id) : Board::first();
      if (!$board) {
         return redirect()->route('messages.index');
      }else{

        if(!empty($request->q)){
          $search = $request->q;
          $arParams['search'] = $search;
          $groups = $board->groups()->whereHas('tasks', function($query) use($search){
            $query->where('groups.name', 'like', '%'.$search.'%')
            ->orWhere('tasks.name', 'like', '%'.$search.'%');
          })->get();

        }else{
          $groups = $board->groups;
        }
        $arParams = array_merge($arParams, [
          'board' => $board,
          'groups' => $groups,
          'statuses' => Task::$status
        ]);

        return view('crm.board.show', $arParams);
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
