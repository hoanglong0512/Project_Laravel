<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $talbe = "categories";
    protected $fillable= ['name', 'slug','show_menu', 'desc'];
    public function Products()
    {
        return $this->hasMany('App\Product', 'cate_id');
    }
}
