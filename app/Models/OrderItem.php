<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OrderItem extends Model { protected $fillable=['order_id','product_id','product_name','price','qty','subtotal']; protected $casts=['price'=>'integer','qty'=>'integer','subtotal'=>'integer']; public function product(){return $this->belongsTo(Product::class);} }
