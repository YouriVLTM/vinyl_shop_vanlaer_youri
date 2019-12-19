<?php

namespace App\Http\Controllers\User;

use App\Order;
use App\Orderline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Facades\App\Helpers\Json;

class orderHistoryController extends Controller
{
    public function index()
    {
        return view('user.orderhistory.index');
    }


    public function get_ordersAndLines(Request $request)
    {
        // get userId
        $userid = $request->input("userid");

        // all orders van userid
        $orders = Order::where('user_id',$userid)->get();


        // push all orderlines into orders
        foreach($orders as $order){
            $orderlines = Orderline::where('order_id',$order->id)
                ->get();
            $order['orderlines'] = $orderlines;
        }

        return Datatables::of(
            $orders



        )
            ->addColumn('action', function($user){
                $result = compact('user');
                return view('admin.orders.attribute.action',$result);
            })
            ->make(true);

    }

    public function get_orderlines(Request $request)
    {
        // get userId
        $order = $request->input("orderid");


        $orderlines = Orderline::where('order_id',$order)
            ->get();

        $result = compact('orderlines');
        Json::dump($result);

        return view('user.orderhistory.orderlineGUI', $result);



    }

    public function get_orders(Request $request)
    {
        // get userId
        $userid = $request->input("userid");

        return Datatables::of(
            Order::where('user_id',$userid)
                ->orderBy('created_at')
                ->get()



        )
            ->addColumn('action', function($user){
                $result = compact('user');
                return view('user.orderhistory.attribute.action',$result);
            })
            ->make(true);

    }
}
