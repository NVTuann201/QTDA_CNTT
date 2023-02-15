<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GroupProduct;
use App\Models\Review;
class Product extends Model
{
    use HasFactory;
    protected $table='products';
    protected $fillable=['name','description','import_price','export_price','image','group_image','status','priority','group_product_id'];

    public function groupproduct(){
        return GroupProduct::find($this->group_product_id);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class,'product_id');//collection

    }
}
