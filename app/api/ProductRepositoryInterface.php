<?php

namespace App\api;

use App\api\data\ProductInterface;

interface ProductRepositoryInterface
{
    public function save(ProductInterface $product);
    public function delete(ProductInterface $product);
    public function update(ProductInterface $product);
    public function find($id);
    public function all();
}
