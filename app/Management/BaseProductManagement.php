<?php

namespace App\Management;

use App\api\BaseProductManagementInterface;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;
use vipnytt\SitemapParser;

class BaseProductManagement implements BaseProductManagementInterface
{
    public function getXml()
    {
        $siteMap1 = new SitemapParser();
        $siteMap1->parse(asset('storage/libraccioSiteMap.xml'));

        $siteMap2 = new SitemapParser();
        $siteMap2->parse(asset('storage/mondatoristoreSitemap.xml'));

        return [$siteMap1->getURLs(), $siteMap2->getURLs()];
    }

    public function saveNext()
    {
        $sitemaps = $this->getXml();

        foreach ($sitemaps as $sitemap) {
            $links = collect($sitemap);
            $store = explode(".", $links->first()['loc'])[1];

            foreach ($links as $link) {
                $crawler = new Crawler(Http::get($link['loc']));
            }
        }
    }
}
