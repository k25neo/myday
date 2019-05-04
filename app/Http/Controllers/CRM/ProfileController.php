<?php

namespace App\Http\Controllers\CRM;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
      $userTimezone = is_null(auth()->user()->timezone)? '292' : auth()->user()->timezone;
      $birthday = new \DateTime(auth()->user()->birthday);
      $birthday = $birthday->format('d.m.Y');
        return view('crm.profile',
        ['selectTimezone'=>$this->select_Timezone($userTimezone),
        'nameTimezone'=>$this->name_Timezone(),
        'birthday'=>$birthday
      ]);
    }

    public function update(Request $request, $id){
      $arAll = $request->all();

      if(!empty($request->birthday)){
        $date = \DateTime::createFromFormat('d.m.Y', $request->birthday);
        $arAll['birthday'] = $date->format('Y-m-d H:i:s');

      }

      if($request->file('image')){
              $path = $request->file('image')->store('uploads','public');
              $arAll['image'] = $path;
      }

      $model = User::findOrFail($id)->update($arAll);
      return redirect()->back();
    }

    public function name_Timezone(){
      $timezoneIdList = timezone_identifiers_list();
      if(isset(auth()->user()->timezone)){
        return $timezoneIdList[auth()->user()->timezone];
      }else{

        return '';

      }
    }

    public function select_Timezone($selected = '') {
      $timezoneIdList = timezone_identifiers_list();
      $select= '<select name="timezone" class="form-control fullwidth search">';
      foreach($timezoneIdList as $key => $row){
        $select .='<option value="'.$key.'"';
        $select .= ($key == $selected ? ' selected' : '');
        $select .= '>'.$row.'</option>';
      }
      $select.='</select>';
      return $select;
    }
}
