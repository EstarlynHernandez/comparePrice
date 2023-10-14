<?php

namespace App\api;

interface ProductManagementInterface
{
    public function getProducts();
    public function saveNextProduct();
}
