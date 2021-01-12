<?php

namespace App\Jobs;

use Spatie\Image\Image;
use Spatie\Image\Manipulations;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ApplyWatermarkImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $filePath;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $srcPath = storage_path() . '/app/' . $this->filePath;
        $spatie_image = Image::load($srcPath);
        $spatie_image->watermark('public/images/watermark.png')
                     ->watermarkOpacity(50)
                     ->watermarkPadding(10, 10, Manipulations::UNIT_PERCENT)
                     ->save();
    }
}
