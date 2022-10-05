<?php

namespace App\Actions;

use App\Models\Item;
use League\CommonMark\CommonMarkConverter;

class UpdateItem
{
    public function handle(array $itemData, Item $item): bool
    {
        $converter = new CommonMarkConverter(['html_input' => 'escape', 'allow_unsafe_links' => false]);

        return $item->update([
            'name' => $itemData['name'],
            'price' => $itemData['price'],
            'url' => $itemData['url'],
            'description' => $converter->convert($itemData['description'])->getContent(),
        ]);
    }
}
