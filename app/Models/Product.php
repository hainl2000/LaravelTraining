<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_id',
        'product_name',
        'product_image',
        'product_price',
        'product_description',
        'product_quantity'
    ];

    public $timestamps = false;

    public function users(){
        return $this->belongsToMany(User::class,'orders','product_id','user_id')
            ->withPivot('price')
            ->withTimestamps();
    }


}
