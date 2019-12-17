<?php

namespace App\Http\Controllers\Admin;

use Facades\App\Helpers\Json;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return view('admin.users.index');
        $name_email = '%' . $request->input('name_email') . '%';

        $orderby =  $request->input('sortby') == '' ? 'id' : $request->input('sortby');

        $request->flash();

        $users = User::orderByRaw($orderby)
            ->latest()
            ->where('name', 'like', $name_email)
            ->Orwhere('email', 'like', $name_email)
            ->paginate(12);

        $result = compact('users');
        Json::dump($result);

        return view('admin.users.index', $result);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return redirect('admin/users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $result = compact('user');
        Json::dump($result);
        return view('admin.users.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            'name' => 'required|min:3|unique:users,name,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->active = $request->has('inlineActive');
        $user->admin = $request->has('inlineAdmin');

        $user->save();
        session()->flash('success', 'The User has been updated');
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(auth()->id() != $user->id){
            $user->delete();
            session()->flash('success', "The user <b>$user->name</b> has been deleted");
        }else{
            session()->flash('danger', "In order not to exclude yourself from (the admin section of) the application, you cannot delete your own profile.");

        }

        return redirect('admin/users');
    }
}
