<?php

namespace App\Management;

use App\api\BaseProductManagementInterface;
use App\api\BaseProductRepositoryInterface;
use App\Models\baseProduct;
use App\Repository\BaseProductRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;
use vipnytt\SitemapParser;

class BaseProductManagement implements BaseProductManagementInterface
{
    private BaseProductRepositoryInterface $repository;

    public function __construct(BaseProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function saveNext()
    {
        $sitemaps = $this->getXml();

        foreach ($sitemaps as $sitemap) {
            $links = collect($sitemap);
            $store = explode(".", $links->first()['loc'])[1];
            $skip = Cache::remember($store . "LastProducts", now()->addWeek(), fn() => 0);
            $links = $links->skip($skip)->take(2);

            foreach ($links as $link) {
                $crawler = new Crawler(Http::get($link['loc']));
                if ($store == 'libraccio') {
                    $product = $this->Libraccio($crawler);
                } elseif ($store = 'mondadoristore') {
                    $product = $this->Mondatori($crawler);
                }

                if (isset($product)) {
                    $product->link = $link['loc'];
                    Cache::set($store . "LastProducts", ($skip + 1), now()->addWeek());
                    $this->repository->save($product);
                }
            }
        }
    }

    public function getXml()
    {
        $libraccio = new SitemapParser();
        $libraccio->parse(asset('storage/libraccioSiteMap.xml'));

        $mondatori = new SitemapParser();
        $mondatori->parse(asset('storage/mondatoristoreSitemap.xml'));

        return ['libraccio' => $libraccio->getURLs(), 'mondatori' => $mondatori->getURLs()];
    }

    public function Libraccio($crawler)
    {
        $ean = $crawler->filter('.valueColumn')->reduce(function ($node) {
            return str_contains($node->siblings()->text(), 'EAN');
        })->first()->text();

        $price = $crawler->filter('.currentprice')->text();
        $title = $crawler->filter('.book-title')->text();
        $price = (float)str_replace(['€ ', ','], ['', '.'], $price);

        if ($ean != null) {
            $product = baseProduct::factory()->make([
                'isbn' => $ean,
                'title' => $title,
                'price' => $price,
                'store' => "libraccio"
            ]);
        }

        return $product;
    }

    public function Mondatori($crawler)
    {
        $price = (float)$crawler->filter('.new-detail-price')->attr('content');
        $title = $crawler->filter('.intestation-new > .title')->text();

        $isbn = $crawler->filter('.detail')->reduce(function ($node) {
            return $node->attr('content') != null;
        })->first()->text();

        if ($isbn != null) {
            $product = baseProduct::factory()->make([
                'isbn' => $isbn,
                'title' => $title,
                'price' => $price,
                'store' => "mondadoristore"
            ]);
        }

        return $product;
    }
}
