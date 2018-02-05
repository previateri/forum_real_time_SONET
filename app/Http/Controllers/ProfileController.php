<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(){
        $user = \Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request){
        $user = \Auth::user();

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,email,{$user->id}",
        ]);

        $user->name = $request->input('name');
        $user->avatar = $request->file('avatar');
        $user->email = $request->input('email');

        if($request->input('password')):
            $this->validate($request, ['password' => 'string|min:6|confirmed']);
            $user->password = bcrypt($request['password']);
        endif;

        $user->save();

        return redirect()->to('/profile');
    }
}
