<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "invoices";
    public $fillable = ['FistName', 'LastName', 'Country', 'Address', 'Town_City', 'Country_State', 'Postcode', 'Phone', 'email'];
}
