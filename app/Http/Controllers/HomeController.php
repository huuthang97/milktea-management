<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index() 
    {
        $stores = DB::table('stores')->get();
        if ( count($stores) > 0)
        {
            $firstStore = $stores->first()->id;
            $products = DB::table('products')->select('products.*', 'store_product.store_id')
                        ->join('store_product', 'products.id', '=', 'store_product.product_id')
                        ->join('stores', 'store_product.store_id', '=', 'stores.id')
                        ->where('store_id', $firstStore)
                        ->orderBy('products.name', 'ASC')
                        ->get();
            $toppings = DB::table('products')->get()->groupBy('toppings');
            $toppingsHandled = [];
            foreach($toppings as $topping => $value) {
                $arrTopping = explode(",", $topping);
                foreach ($arrTopping as $value) {
                    $value2 = strtolower(trim($value));
                    if (!in_array($value2, $toppingsHandled)) {
                        $toppingsHandled[] = $value2;
                    }
                }
            }
            return view('home', compact('firstStore', 'stores', 'products', 'toppingsHandled'));
        }
        
    }

    public function getByTopping(Request $request) {
        $store_id = $request->store_id;
        $toppings = $request->toppings;
        $sort = $request->sort;
        $products = DB::table('products')->select('products.*', 'store_product.store_id')
                        ->join('store_product', 'products.id', '=', 'store_product.product_id')
                        ->join('stores', 'store_product.store_id', '=', 'stores.id');
                        
        if ( !empty($toppings) ) {
                $products->Where(function ($query) use ($toppings) {
                    foreach ($toppings as $topping) {
                        $query->orWhere('toppings', 'LIKE', $topping)
                            ->orWhere('toppings', 'LIKE', "%, $topping")
                            ->orWhere('toppings', 'LIKE', "%,$topping")
                            ->orWhere('toppings', 'LIKE', "$topping,%")
                            ->orWhere('toppings', 'LIKE', "$topping ,%");
                    }
                });
        }         
        
        if ( $sort === "name_asc") {
            $products->orderBy('products.name', 'ASC');
        }
        else if ( $sort === "name_desc") {
            $products->orderBy('products.name', 'DESC');
        }
        else if ( $sort === "price_asc") {
            $products->orderBy('price', 'ASC');
        }
        else if ( $sort === "price_desc") {
            $products->orderBy('price', 'DESC');
        }
        
        $data = $products->where('stores.id', $store_id)->get();

        return response()->json($data);

    }
}
