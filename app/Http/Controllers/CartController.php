<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;
use App\Category;
use Illuminate\Support\Arr;




class CartController extends Controller
{


    function addToCart($id)
    {
        $products = Product::find($id);

        $cookie = Cookie::get('cartId');

        $cart = json_decode($cookie, true);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] =   $cart[$id]['quantity'] + 1;
        } else {
            $cart[$id] = [
                'id' => $products->id,
                'name' => $products->name,
                'price' => $products->price,
                'image' => $products->image,
                'quantity' => 1
            ];
        }
        $array_json = json_encode($cart);
        Cookie::queue('cartId', $array_json);
        $cartCount = view('layouts._share.header-home', compact('cart'));
        return response()->json([
            'cartCount' => $cartCount,
            'code' => 200,
            'message' => 'success'
        ], 200);
    }
    public function shopCart()
    {
        $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
        $carts = json_decode(Cookie::get('cartId'), true);
        $cates = Category::all();
        //dd($data);
        // dd($carts);
        if ($carts == "") {
            $carts = [];
        }
        return view('shoping-cart', compact('carts', 'cates', 'msg'));
    }

    public function update(Request $request)
    {
        $count = count($request->id);
        $dataQuantity = collect($request->quantity);
        $idProducts = collect($request->id);
        $carts =  json_decode(Cookie::get('cartId'), true);

        if ($request->id && $request->quantity) {
            for ($i = 0; $i < $count; $i++) {
                $carts[$idProducts[$i]]['quantity'] = $dataQuantity[$i];
                $array_json = json_encode($carts);
                Cookie::queue('cartId', $array_json);
            }
            // echo "<pre>";
            // print_r($carts);
            // die;
            $cart_components = view('components.cart-components', compact('carts'))->render();
            return response()->json([
                'cart_components' => $cart_components,
                'code'  => 200
            ], 200);
        }
    }
    public function remove(Request $request)
    {

        if ($request->id) {
            $carts =  json_decode(Cookie::get('cartId'), true);
            unset($carts[$request->id]);

            $array_json = json_encode($carts);

            Cookie::queue('cartId', $array_json);

            // echo "<pre>";
            // print_r($carts);
            // die;
            $cart_components = view('components.cart-components', compact('carts'))->render();

            return response()->json([
                'cart_components' => $cart_components,
                'code' => 200
            ], 200);
        }
    }
}
