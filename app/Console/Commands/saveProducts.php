<?php

namespace App\Console\Commands;

use App\Management\BaseProductManagement;
use Illuminate\Console\Command;

class saveProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:save-products';

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
        $management->saveNext();
    }
}
