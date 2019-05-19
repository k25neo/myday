<?php

namespace App\Http\Controllers\CRM;

use App\Board;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoardController extends Controller
{
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
      return view('crm.board.show', [
          'board' => Board::findOrFail($id)
      ]);
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

}
