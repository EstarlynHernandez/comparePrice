<?php

namespace App\Management;

use App\api\BaseProductManagementInterface;
use vipnytt\SitemapParser;
use Illuminate\Support\Facades\Storage;

class BaseProductManagement implements BaseProductManagementInterface
{
    public function getXml()
    {
    }

    public function saveNext()
    {
        // TODO: Implement saveNext() method.
    }
}
