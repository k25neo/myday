<?php

namespace App\Http\Controllers\CRM;

use App\Task;
use App\Group;
use App\Board;
use App\User;
use App\Comment;
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
      $allRequest['date_to'] = Carbon::parse($request->date_to);
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

    /**
     * get task users & all users array
     */
     public function users(Request $request, Task $task)
     {
       $arResult['task_users'] = $task->users;
       $arResult['all_users'] = User::all();
       return json_encode($arResult);
     }

     /**
      * users sync
      */
      public function usersSync(Request $request, Task $task)
      {
        $arRequest = $request->all();
        if(!empty($arRequest['users'])){
          $task->users()->sync(explode(',',$arRequest['users']));
        }else{
          $task->users()->detach();
        }
      }

      /**
       * get task comments
       */
       public function comments(Request $request, Task $task)
       {
         $arResult['comments'] = $task->comments()->with('user')->get();
         return json_encode($arResult);
       }

       public function commentsStore(Request $request, Task $task)
       {
         $arRequest = $request->all();
         $arRequest['user_id'] = \Auth::id();
         $comment = new Comment($arRequest);
         $model = $task->comments()->save($comment);
         $model['user'] = \Auth::user();
         $arResult['comments'][] = $model;
         return json_encode($arResult);
       }

       /**
       * mywork
       */
       public function mywork()
       {
         $user = User::find(\Auth::id());
         $tasks = $user->belongsToMany('App\Task')
         ->orderBy('created_at', 'desc')
         ->paginate(50);
         return view('crm.mywork', [
           'tasks' => $tasks, 'user' => \Auth::user()
         ]);
       }
}
