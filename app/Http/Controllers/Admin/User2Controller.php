<?php

namespace App\Http\Controllers\Admin;

use Facades\App\Helpers\Json;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class User2Controller extends Controller
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
            ->where('name', 'like', $name_email)
            ->Orwhere('email', 'like', $name_email)
            ->paginate(12);

        $result = compact('users');
        Json::dump($result);

        return view('admin.users2.index', $result);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
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
        return response()->json([
            'type' => 'success',
            'text' => "The User <b>$user->name</b> has been updated",
            'user' => $user
        ]);
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

            return response()->json([
                'type' => 'success',
                'text' => "The user <b>$user->name</b> has been deleted"
            ]);
        }else{
            return response()->json([
                'type' => 'error',
                'text' => "In order not to exclude yourself from (the admin section of) the application, you cannot delete your own profile."
            ]);

        }

    }
}
