<?php

namespace App\Http\Controllers;

use App\Record;
use Facades\App\Helpers\Json;
use Illuminate\Http\Request;

class BasketController extends Controller
{

    public function index(){

        $cart = session()->get('cart');
        $totalprice = $this->totalprice();

        $result = compact('cart','totalprice');
        Json::dump($result);
        return view('basket.index',$result);
    }


    public function dropdown(){
        return view('basket.dropdown');
    }


    public function addToCard(Request $request){

        $records_id = $request->input('recordsid');
        $record = Record::where('id',$records_id)->get()->first();

        //kijken of het record bestaat
        if(!$record){
            abort(404);
        }


        // all items ophalen
        $cartItems = session()->get('cart');

        if($cartItems != null){
            // kijken in de lijst
            $exist = array_search($records_id, array_column($cartItems, 'recordid'));

        }else{
            $exist = false;
        }



        if($exist !== false){
            //bestaat al wel!
            $cartItems[$exist]["quantity"] +=1;
            session()->put('cart', $cartItems);


        }else{
            //bestaat nog niet
            $cart = [
                "recordid" => $record->id,
                "artist" => $record->artist,
                "title" => $record->title,
                "price" => $record->price,
                "cover" => $record->cover ?? "https://coverartarchive.org/release/$record->title_mbid/front-250.jpg",
                "quantity" => 1
            ];

            session()->push('cart', $cart);
        }

        return response()->json([
            'type' => 'success',
            'text' => "The item <b>$record->artist</b> has been add to cart",
            'counter' => count(session()->get('cart'))
        ]);

    }

    public function totalprice(){
        $cartItems = session()->get('cart');
        $totalPrice = 0;

        if($cartItems != null) {

            foreach ($cartItems as $item) {
                $totalPrice = $totalPrice + ($item["price"] * $item["quantity"]);
            }
        }else{
            return false;
        }

        return round($totalPrice,2);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        $cartItems = session()->get('cart');


        $exist = array_search($record->records_id, array_column($cartItems, 'recordid'));

        return response()->json([
            'type' => 'success',
            'text' => "Record has been deleted"
        ]);
    }

}
