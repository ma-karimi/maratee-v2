<?php

namespace App\Observers;


use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductObserver
{
    /**
     * Handle the protection "created" event.
     *
     * @param Product $product
     * @return void
     */
    public function created(Product $product)
    {
        $this->setCache($product);
    }

    /**
     * @param Product $product
     */
    private function setCache(Product $product): void
    {
        Cache::put('products', $product->all(), now()->addDays(10));
    }

    /**
     * Handle the protection "updated" event.
     *
     * @param Product $product
     * @return void
     */
    public function updated(Product $product)
    {
        $this->setCache($product);
    }

    /**
     * Handle the protection "deleted" event.
     *
     * @param Product $product
     * @return void
     */
    public function deleted(Product $product)
    {
        $this->setCache($product);
    }

    /**
     * Handle the protection "restored" event.
     *
     * @param Product $product
     * @return void
     */
    public function restored(Product $product)
    {
        $this->setCache($product);
    }

    /**
     * Handle the protection "force deleted" event.
     *
     * @param Product $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        $this->setCache($product);
    }

    public function saved(Product $product)
    {
        $this->setCache($product);
    }
}
