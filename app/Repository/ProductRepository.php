<?php

namespace App\Repository;

use App\api\data\ProductInterface;
use App\api\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{

    public function save(ProductInterface $product)
    {
        return $product->save();
    }

    public function delete(ProductInterface $product)
    {
        return $product->delete();
    }

    public function update(ProductInterface $product)
    {
        return $product->save();
    }

    public function find($id)
    {
        return Product::find($id);
    }

    public function all()
    {
        return Product::all();
    }
}
