<?php

namespace App\Http\Controllers\CRM;

use App\Client;
use App\Board;
use App\Group;
use App\Task;
use App\Imports\GroupsImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

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
   * import Excel.
   *
   * @param  \Illuminate\Http\Request  $request
   *
   */
  public function importExcel(Request $request, Board $board){
    if(!empty($request->file('file'))) {
        $lists = Excel::toArray(new GroupsImport, $request->file('file'));

        $data = [];
        $groupName = '';
        // Проходимся по страницам в excel
            foreach ($lists as $listKey => $list) {
              foreach ($list as $key => $item) {
                  if ( empty(trim($item[0])) && empty(trim($item[1])) ) {
                    continue;
                  }
                  if ( $item[0] != $groupName && !empty(trim($item[0])) ) {
                    $groupName = $item[0];
                  }
                  $data[$groupName][] = $item[1];

              }
            }
            $keys = array_keys(Task::$status);
            $firstKey = $keys[0];
            foreach ($data as $group => $tasks) {
              $newGroup = $board->groups()->save( new Group(['name'=>$group]) );
              foreach ($tasks as $key => $task) {
                $newGroup->tasks()->save( new Task([
                  'name'=>$task,
                  'status'=>$firstKey
                  ]) );
              }
            }

    }

    return redirect()->back();
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
          'client' => Client::find($board->client_id),
          'board' => $board,
          'groups' => $groups,
          'statuses' => Task::$status,
          'criticals' => Task::$critical,
          'work_types' => Task::$work_type
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
