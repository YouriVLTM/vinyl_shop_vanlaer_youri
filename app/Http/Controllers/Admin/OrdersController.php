<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Orderline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class OrdersController extends Controller
{

    public function index()
    {
        return view('admin.orders.index');
    }

    public function get_orders()
    {

        return Datatables::of(
            Order::with('user')
                ->get()
                ->transform(function ($item, $key) {
                    $item->username = ucfirst($item->user->name);
                    $item->useremail = ucfirst($item->user->email);
                    // Remove all fields that you don't use inside the view
                    unset($item->updated_at, $item->user_id,$item->user);
                    return $item;
                })

        )
        ->addColumn('action', function($user){
            $result = compact('user');
            return view('admin.orders.attribute.action',$result);
        })
        ->make(true);

    }

    public function get_orderlines(Request $request){

        $id = $request->input("id");
        return Datatables::of(
            Orderline::where('id', $id)
            ->get()


        )
            ->addColumn('action', function($user){
                $result = compact('user');
                //return view('admin.orderlines.attribute.action',$result);

            })
            ->make(true);
    }

    public function show($id)
    {
        $result = compact('id');
        return view('admin.orderlines.index', $result);
    }
}
