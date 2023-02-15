<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupProduct extends Model
{
    use HasFactory;
    protected $table='group_products';
    protected $fillable=['name', 'status', 'priority'];

    public function products(){
        return $this->hasMany(Product::class, 'group_product_id','id');
    }
}
