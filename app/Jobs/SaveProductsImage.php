<?php

namespace App\Jobs;

use App\Models\Images\ProductImage;
use Illuminate\Bus\Queueable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SaveProductsImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var
     */
    private $products;
    /**
     * @var
     */
    private $images;

    /**
     * Create a new job instance.
     *
     * @param $products
     * @param $images
     */
    public function __construct($products, $images)
    {
        $this->products = $products;
        $this->images = collect($images);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->images = $this->sanitizeImages();

        foreach ($this->images as $index => $image) {
            $imageAttributes = [
                'product_id' => $this->products[$index]->id,
                'alt' => $this->products[$index]->name,
            ];

            (new ProductImage($imageAttributes, $image))->save();
        }
    }

    private function sanitizeImages()
    {
        $images = collect();
        foreach ($this->images as $key => $image) {
            if (!($image instanceof UploadedFile)) {
                $image = urlToUploadedFile($image);
            }

            $images->push($image);
        }

        return $images;
    }
}
