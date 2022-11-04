<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',	
        'description',	
        'price',	
        'sale_price',	
        'quantity',	
        'category',	
        'type',	
        'image',	
        'image1',	
        'image2'];
}
