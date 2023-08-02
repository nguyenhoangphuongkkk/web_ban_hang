<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,
    SoftDeletes;
    protected $table = "products";
    protected $fillable = ['id','product_name','category_id','price','image','description','stock_quantity'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
