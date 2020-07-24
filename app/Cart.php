<?php

// namespace App;

// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Cookie;

// class Cart 
// {
//     public $items = [];
//     public $total_Price = 0;
//     public $total_Quantity = 0;

//     public function __construct()
//     {
//       // $this->items = $_COOKIE['pro'] ? $_COOKIE['pro'] : [];
//        $this->total_Price = $this->get_total_price();
//        $this->total_Quantity = $this->get_total_quantity();
        
//     }
//     public function add($product, $quantity = 1){
       
//         $item = [
//             'id' => $product->id,
//             'name' => $product->name,
//             'price' => $product->price,
//             'image' => $product->image,
//             'quantity' => $quantity
//         ];
//         $this->items[$product->id] = $item;
//         //dd($this->items);
//         $array_json=json_encode($this->items);
//         cookie('pro', $array_json);
//     }

//     public function remove($id){

//     }

//     public function update($id, $quantity = 1){

//     }

//     public function clear(){

//     }

//     public function get_total_price(){
//         // $t = 0;

//         // foreach($this->items as $item){
//         //     $t += $item['price'] * $item['quantity'];
//         // }
//         // return $t;
//     }
//     public function get_total_quantity(){
//         // $t = 0;

//         // foreach($this->items as $item){
//         //     $t += $item['quantity'];
//         // }
//         // return $t;
//     }


//}
