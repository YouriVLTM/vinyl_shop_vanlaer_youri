<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class User3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.users3.index');
    }

    public function get_datatable()
    {

        return Datatables::of(
            User::query()

        )

        ->addColumn('action', function($user){
            $result = compact('user');
            return view('admin.users3.attribute.action',$result);
        })
        ->addColumn('currentuser', function($user){
            if(auth()->id() == $user->id){
                return 'true';
            }else{
                return "false";
            }
        })
        ->make(true);

    }

    public function fetchdata(Request $request){
        $id = $request->input("id");
        $user = User::find($id);
        return $user;
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
        return $user;
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
