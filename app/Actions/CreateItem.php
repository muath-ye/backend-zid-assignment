<?php

namespace App\Actions;

use App\Models\Item;
 
class CreateItem
{
    public function handle(array $itemData): Item
    {
        return Item::create([
            'name' => $itemData['name'],
            'price' => $itemData['price'],
            'url' => $itemData['url'],
            'description' => $this->converter->convert($itemData['description'])->getContent(),
        ]);
    }
}
