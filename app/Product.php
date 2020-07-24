<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    public $fillable = ['name','cate_id','price','short_desc','detail','star','view'];
    public function getCategoryName(){
        $parent = Category::find($this->cate_id);
        if($parent) return $parent->name;
        return null;
    }
}
