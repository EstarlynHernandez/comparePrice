<?php

namespace App\Console\Commands;

use App\Management\BaseProductManagement;
use App\Models\baseProduct;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(BaseProductManagement $management)
    {
        $products = BaseProduct::all();

        $products = $products->groupBy('isbn');

        foreach ($products as $product) {
            echo $product->count();
        }
//        $links = collect($management->getXml()['mondatori']);
//        echo $links->count() . "\n";
//        $links = $links->filter(fn ($link) => $products->contains('link', $link['loc']));
//        echo $links->count();

//        $storage = Storage::disk('ftp');
//        $storage->put('data', 'test');
    }
}
