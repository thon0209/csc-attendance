<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;


class ProfileController extends Controller
{

    public function index(Request $request)
    {
        return view('profile.index');
    }
  
    public function edit($id)
    {
        $user = User::findOrFail($id);
  
        return view('profile.changepassword', compact('user'));
    }
  
    public function update(Request $request, $id)
    {
  
      $user = User::findOrFail($id);
      $requestData = $request->only(['password']);
      $user->fill($requestData)->save();
  
     return redirect('/profile')->with('flash_message', 'Password updated!');
    }    
    

}
