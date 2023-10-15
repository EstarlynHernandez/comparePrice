<?php

namespace App\Models;

use App\api\data\ProductInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements ProductInterface
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'winner_store',
        'isbn'
    ];
}
