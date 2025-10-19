<?php

namespace App\Spiders\Pipeline;

use App\Models\Beer;
use Illuminate\Support\Arr;
use RoachPHP\ItemPipeline\ItemInterface;
use RoachPHP\ItemPipeline\Processors\ItemProcessorInterface;
use RoachPHP\Support\Configurable;

class StoreProcessor implements ItemProcessorInterface
{
    use Configurable;

    public function processItem(ItemInterface $item): ItemInterface
    {
        $null = collect($item->all())->filter(fn ($value) => is_null($value));

        if ($null->isNotEmpty()) {
            $message = 'Beer '.$item->get('url').' missing data: ' . $null->keys()->implode(', ');
            return $item->drop($message);
        }

        $beer = Beer::firstOrNew(['url' => $item->get('url')])->forceFill(Arr::only($item->all(), [
            'url',
            'name',
            'description',
            'brewery',
            'style',
            'abv',
            'price',
            'stock',
            'size',
            'tags',
            'hops',
            'published_at',
            'modified_at',
        ]))->save();

//        $beer->addMediaFromUrl($item->get('src'))->toMediaCollection('product');

        return $item;
    }
}
