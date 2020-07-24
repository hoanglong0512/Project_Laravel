<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Category;
use App\InvoicesDetail;
use App\Order;
use App\Posts;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller

{
    public function home()
    {
        $categories = Category::all();
        $product = Product::all();
        $posts = Posts::all();
        //dd($categories);
        return view('client.home-page', [
            'products' => $product,
            'cates' => $categories,
            'posts' => $posts
        ]);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }



    public function search(Request $request)
    {
        // $tim = $request->search;
        // dd($tim);

        if ($request->ajax()) {
            // dd($request->search);
            if (isset($request->search)) {
                $output = "";
                $product = DB::table('products')->where('name', 'like', '%' . $request->search . '%')->get();

                if ($product) {
                    foreach ($product as $key => $pro) {
                        $output .= '
                        
                           <a href="detail?id=' . $pro->id . '" class="nav-link text-success" >' . $pro->name . '</a>
                        
                       ';
                    }
                    //dd($output);
                    return Response($output);
                }
            }
            $output = null;
        }
    }



    // public function login(){
    //     $this->middleware('auth');
    //     if (Auth::check()) {
    //     $user = Auth::user();   
    //     dd($user); 
    //     return view('auth.login',[
    //         'user' => $user 
    //     ]);
    // }else{
    //     return view('login');
    // }
    // }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function blogDetails()
    {
        return view('blog-details');
    }
    public function blog()
    {
        return view('blog');
    }
    public function checkOut()
    {
        $carts = json_decode(Cookie::get('cartId'), true);
        //dd($data);
        $cates = Category::all();
        //dd($data);
        if ($carts == "") {
            $carts = [];
        }
        return view('checkout', compact('cates', 'carts'));
    }

    public function saveInvoices(Request $request)
    {

        $carts = json_decode(Cookie::get('cartId'), true);

        $arrayProducts = collect();
        $quantityProducts = collect();
        $priceProduct = collect();
        $total = 0;
        foreach ($carts as $key => $cart) {
            $total += $cart['price'] * $cart['quantity'];
            $arrayProducts->push($cart['id']);
            $quantityProducts->push($cart['quantity']);
            $priceProduct->push($cart['price'] * $cart['quantity']);
            $products = Product::where('name', $cart['name'])->first();
            $orderItem = new InvoicesDetail([
                'product_id'    =>  $products->id,
                'quantity'      =>  $cart->quantity,
                'price'         =>  $priceProduct
            ]);

            $cart->items()->save($orderItem);
        }
        dd($carts);
        $model = new Order();
        $model->fill($request->all());
        $model->total_price = $total;
        $model->save();
        if (Cookie::has('cartId')) {
            Cookie::queue(
                Cookie::forget('cartId')
            );
        }
        return redirect()->route('shoping.cart', 'msg=Mua Hàng Thành Công');
    }
    public function contact()
    {
        return view('contact');
    }
    public function main()
    {
        return view('main');
    }

    public function shopCart()
    {
        return view('shoping-cart');
    }
}
