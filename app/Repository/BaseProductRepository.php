<?php

namespace App\Repository;

use App\api\BaseProductRepositoryInterface;
use App\api\data\BaseProductInterface;
use App\Models\Product;

class BaseProductRepository implements BaseProductRepositoryInterface
{
    public function save(BaseProductInterface $product)
    {
        return $product->save();
    }

    public function delete(BaseProductInterface $product)
    {
        return $product->delete();
    }

    public function update(BaseProductInterface $product)
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
