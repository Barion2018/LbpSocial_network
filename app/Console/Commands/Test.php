<?php

namespace App\Console\Commands;

use App\Models\PostImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class Test extends Command
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
    public function handle(): void
    {
        $images = PostImage::get();
        foreach ($images as $image) {
            $image->delete();
        }
        //$postImage->delete();
        //dump($postImage[0]->path);
        //Storage::disk('public')->delete($postImage[0]->path);
        //dd($postImage->path);
        dd($images);
    }
}
