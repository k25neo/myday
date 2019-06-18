<?php

namespace App\Http\Controllers\CRM;

use App\Board;
use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function store(Request $request){
      Client::create($request->all());
      return redirect()->back();
    }
}
