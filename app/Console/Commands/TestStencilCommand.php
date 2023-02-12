<?php

namespace App\Console\Commands;

use App\Services\StencilService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestStencilCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stencil:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $test=  StencilService::generateFeaturedImage("1", 'test', 'test')["image_url"];

       // download the image and save it to the public folder

         $image = file_get_contents($test);

            file_put_contents(public_path('images/test.png'), $image);
    }
}
