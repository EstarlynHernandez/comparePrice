<?php

namespace App\Models;

use App\api\data\BaseProductInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class baseProduct extends Model implements BaseProductInterface
{
    use HasFactory;

    protected $fillable = [
        'isbn',
        'title',
        'price',
        'store'
    ];
}
