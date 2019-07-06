<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
use Auth;


class UsersController extends Controller
{

    public function __construct(){

        $this->middleware('auth',['except'=>['show']]);
    }


    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }


    public function edit(User $user){
        $this->authorize('update',$user);

    	return view('users.edit',compact('user'));
    }


    public function update(UserRequest $request, User $user , ImageUploadHandler $uploads){
        $this->authorize('update',$user);
        $data = $request->all();

        if ($request->avatar) {
            $refault = $uploads->save($request->avatar , 'avatars' , Auth::id(), 416);
            if ($refault) {
                $data['avatar'] = $refault['path'];
            }
        }

        $user->update($data);

    	return redirect()->route('users.show',$user)->with('success','个人资料更新成功！');
    }




}
