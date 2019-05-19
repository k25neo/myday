<?php

namespace App\Http\Controllers\CRM;

use App\Board;
use App\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, $board_id)
  {
    $allRequest = $request->all();
    $allRequest['board_id'] = $board_id;
    $model = Group::create($allRequest);
    //TODO: create empty task

    return redirect()->route('board.show', $board_id);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      return view('crm.board.show', ['board' => Board::findOrFail($id)]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Board $board, Group $group)
  {
      $group->update($request->all());
      return redirect()->back();
  }

}
