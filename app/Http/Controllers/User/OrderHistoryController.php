<?php

namespace App\Http\Controllers\User;

use App\Order;
use App\Orderline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class orderHistoryController extends Controller
{
    public function index()
    {
        return view('user.orderhistory.index');
    }

    public function get_orders(Request $request)
    {

        $userid = $request->input("userid");


        return Datatables::of(

            Orderline::with('order')
                ->get()

        )
            ->addColumn('action', function($user){
                $result = compact('user');
                return view('admin.orders.attribute.action',$result);
            })
            ->make(true);

    }
}
