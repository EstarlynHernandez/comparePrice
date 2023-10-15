<?php

namespace App\api;

use App\api\data\BaseProductInterface;

interface BaseProductRepositoryInterface
{
    public function save(BaseProductInterface $product);
    public function delete(BaseProductInterface $product);
    public function update(BaseProductInterface $product);
    public function find($id);
    public function all();
}
