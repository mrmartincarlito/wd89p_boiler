<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * This function implies to have a checkout counter functionalities
     *
     * @return void
     */
    public function checkoutCounter(Request $request)
    {
        $cart = json_decode($request->cart);
        $refNo = strtoupper(uniqid("COFFEE_"));
        foreach ($cart as $itemsInCart) {
            $item = new Items();

            if ($itemsInCart->qty <= 0) {
                return response()->json(["data" => $itemsInCart->name . " is 0 in qty!!!!!!"]);
            }

            $item->name = $itemsInCart->name;
            $item->qty = $itemsInCart->qty;
            $item->price = $itemsInCart->price;
            $item->uom = $itemsInCart->uom;
            $item->total_amount = $item->qty * $item->price;
            $item->order_ref_no = $refNo;
            
            $item->save();
        }

        return response()->json(["data" => "Successfully checkout your cart!!", "reference" => $refNo]);
    }

    public function trackOrder(Request $request)
    {
        $orderRefNo = $request->order_ref_no;
        //Select * from items where order_ref_no = ?
        $items = Items::where("order_ref_no", "=", $orderRefNo)->get();
        return response()->json(["data" => $items, "reference" => $orderRefNo]);
    }
}
