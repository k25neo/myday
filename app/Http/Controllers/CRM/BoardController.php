<?php

namespace App\Http\Controllers\CRM;

use App\Group;
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
    $model = Group::create($allRequest);

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
      //
  }
}
