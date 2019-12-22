<?php

namespace App\Http\Controllers\Admin;

use App\Genre;
use App\Record;
use App\User;
use Facades\App\Helpers\Json;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::selectRaw('count(*) count')
                 ->get()
                 ->first();

        $records = Record::selectRaw('count(*) count')
            ->get()
            ->first();

        $genres = Genre::selectRaw('count(*) count')
            ->get()
            ->first();

        $orders = Order::selectRaw('count(*) count')
            ->get()
            ->first();



        $result = compact('users','records','genres','orders');
        Json::dump($result);
        return view('admin.dashboard.index',$result);
    }

    public function getOrders(){

        $data = [];
        $month = [];

        $orders = Order::selectRaw('year(created_at) year, monthname(created_at) month, count(*) count')
                ->groupby('year','month')
                ->orderBy('year', 'ASC')
                ->get();

        foreach( $orders as $order){
            array_push($data,$order->count);
            array_push($month,strval($order->month));
        }

        $result = compact('data','month');

        Json::dump($result);

        return $result;
    }


    public function getUsersFunctionCount(){

        $usercount = [];
        $functions = ["admin","active","nonactive"];

        $test = User::get();

        $admin = User::selectRaw('count(*) count')
                ->where('admin','1')
                ->get()
                ->first();

        $active = User::selectRaw('count(*) count')
            ->where('active','1')
            ->get()
            ->first();

        $nonactive = User::selectRaw('count(*) count')
            ->where('active','0')
            ->get()
            ->first();


        //get in array
        array_push($usercount,$admin->count);
        array_push($usercount,$active->count);
        array_push($usercount,$nonactive->count);






        $result = compact('usercount','functions');
        Json::dump($result);

        return $result;
    }
}
