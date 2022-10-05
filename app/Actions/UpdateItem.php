<?php

namespace App\Actions;

use App\Models\Item;
 
class UpdateItem
{
    public function handle(array $itemData, Item $item): bool
    {
        return $item->update([
            'name' => $itemData['name'],
            'price' => $itemData['price'],
            'url' => $itemData['url'],
            'description' => $this->converter->convert($itemData['description'])->getContent(),
        ]);
    }
}
